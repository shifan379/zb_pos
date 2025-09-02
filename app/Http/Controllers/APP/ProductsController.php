<?php

namespace App\Http\Controllers\APP;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Mail\LowstockProductListMail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Location;
use App\Models\product as Product;
use App\Models\Service;
use App\Models\Stocks;
use App\Models\Unit;
use App\Models\Variant;
use App\Models\Warranty;

use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\isEmpty;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('cate')->with('supply')->latest()->get();
        $catgeories = Category::latest()->get();
        $location = Location::latest()->get();

        return view("app.products.list", compact("products", "catgeories", "location"));
    }

    // Product Fillter function
    public function filterByCategory(Request $request)
    {
        $categoryName = $request->category;
        $category = Category::where('category', $categoryName)->first();

        $products = [];
        if ($category) {
            $products = Product::with('cate', 'supply')
                ->where('category', $category->id)
                ->latest()
                ->get();
        }

        // Return only the table rows as HTML
        $html = view('app.products.table', compact('products'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $categories = Category::where('status', 1)
            ->orderBy('category')
            ->get();

        $units = Unit::all();

        $locations = Location::where('status', 1)
            ->orderBy('name')
            ->get();

        $brands = Brand::where('status', 1)->orderBy('name')->get();
        $variants = Variant::all(['id', 'name', 'values']);
        $warrentys = Warranty::latest()->get(['id', 'warranty', 'duration', 'period']);
        return view('app.products.create', compact('categories', 'units', 'locations', 'variants', 'warrentys', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Handle image upload and get URLs

        //  return $request;
        $imagePaths = [];

        if ($request->hasFile('images')) {
            $uploadDir = public_path('storage/products');
            File::ensureDirectoryExists($uploadDir, 0755, true);

            $images = Arr::wrap($request->file('images'));
            foreach ($images as $image) {
                if ($image && $image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $baseName = Str::slug($request->product_name ?? 'product');
                    $filename = sprintf(
                        '%s_%s_%s.%s',
                        $baseName,

                        time(),
                        Str::random(6),
                        $extension
                    );
                    $image->move($uploadDir, $filename);
                    $imagePaths[] = asset('storage/products/' . $filename);
                }
            }
        }

        $imagesJson = $imagePaths ? json_encode($imagePaths) : null;

        // Helper: format date
        $formatDate = fn($date) => $date
            ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d')
            : null;

        // Common fields for both single and variants
        $baseData = [
            'item_code' => $request->item_code,
            'product_name' => $request->product_name,
            'slug' => $request->slug,
            'brand' => $request->brand,
            'selling_type' => $request->selling_type,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'quantity_alert' => $request->quantity_alert,
            'wholesale_price' => $request->wholesale_price ?? 0.00,
            'online_price' => $request->online_price ?? 0.00,
            'manufacturer' => $request->manufacturer,
            'manufacturer_date' => $formatDate($request->manufacturer_date),
            'expiry_date' => $formatDate($request->expiry_date),
            'location' => $request->location,

            'unit' => $request->unit,
            'product_description' => $request->product_description,
            'warranty' => $request->warranty,
            'images' => $imagesJson,
            // Custome Fileds
            'serial_number1' => $request->serial_number1 ?? '',
            'serial_number2' => $request->serial_number2 ?? '',
            'free_service_count' => $request->free_service_count ?? null,
            'free_service_duration' => $request->free_service_duration ?? null,
        ];


        // If no specialist => single product
        if (empty($request->specialist)) {
            $productData = array_merge($baseData, [
                'product_type' => 1,
                'quantity' => is_array($request->quantity) ? $request->quantity[0] : $request->quantity,
                'buying_price' => is_array($request->buying_price) ? $request->buying_price[0] : $request->buying_price,
                'average_cost_price' => is_array($request->buying_price) ? $request->buying_price[0] : $request->buying_price,
                'selling_price' => is_array($request->selling_price) ? $request->selling_price[0] : $request->selling_price,
                'discount_amount' => is_array($request->discount_amount) ? $request->discount_amount[0] : $request->discount_amount,
                'discount_percentage' => is_array($request->discount_percentage) ? $request->discount_percentage[0] : $request->discount_percentage,
                'mark' => is_array($request->mark) ? $request->mark[0] : $request->mark,

            ]);

            $product = Product::create($productData);

            // product::create($productData);

            // 🔄 Add to stock table
            Stocks::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'location_id' => $request->location,
                    // 'location_id' => $locationId = \App\Models\Location::where('name', trim($request->location))->value('id'),
                ],
                [
                    'product_id' => $product->id,
                    'location_id' => $request->location,
                    'stock' => $product->quantity,
                ]
            );


            if ($request->free_service_count) {
                Service::updateOrCreate(
                    [
                        'product_id' => $product->id,
                    ],
                    [
                        'free_service_count' => $request->free_service_count,
                        'validity_days' => $request->free_service_duration,
                    ]
                );
            }
        } else {
            // Variants
            $count = count($request->quantity ?? []);
            for ($i = 0; $i < $count; $i++) {
                $variantData = array_merge($baseData, [
                    'product_type' => 0,
                    'quantity' => $request->quantity[$i] ?? 0,
                    'buying_price' => $request->buying_price[$i] ?? 0.00,
                    'average_cost_price' => $request->buying_price[$i] ?? 0.00,
                    'selling_price' => $request->selling_price[$i] ?? 0.00,
                    'discount_amount' => $request->discount_amount[$i] ?? 0,
                    'discount_percentage' => $request->discount_percentage[$i] ?? 0,
                    'mark' => $request->mark[$i] ?? null,
                    'variantion_name' => $request->variantion_name[$i] ?? null,
                    'variantion_value' => $request->variantion_value[$i] ?? null,

                ]);
                $variant = Product::create($variantData);

                // product::create($variantData);

                // 🔄 Add each variant to stock table
                Stocks::updateOrCreate(
                    [
                        'product_id' => $variant->id,
                        'location_id' => $request->location,

                    ],
                    [
                        'product_id' => $variant->id,
                        'location_id' => $request->location,
                        'stock' => $variant->quantity,
                    ]
                );
            }
        }


        return redirect()
            ->route('product.index')
            ->with('success', 'Product(s) added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::with(['cate', 'warranty_item'])->findOrFail($id);
        $generator = new BarcodeGeneratorHTML();
        return view('app.products.view', compact('product', 'generator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::with(['cate', 'warranty_item'])->with('supply')->findOrFail($id);
        $categories = Category::all();
        $units = Unit::all();
        $locations = Location::all();
        $brands = Brand::where('status', 1)->orderBy('name')->get();
        $variants = Variant::all(['id', 'name', 'values']);
        $warrentys = Warranty::latest()->get(['id', 'warranty', 'duration', 'period']);
        return view('app.products.edit', compact('categories', 'units', 'locations', 'variants', 'product', 'warrentys', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        // Format date helper
        $formatDate = function ($date) {
            return $date ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') : null;
        };

        // Initialize images array
        $imagePaths = [];

        // Handle images if any
        if ($request->hasFile('images')) {
            $uploadDir = public_path('storage/products');

            if (!File::exists($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true);
            }

            foreach ((array) $request->file('images') as $image) {
                if ($image && $image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $baseName = Str::slug($request->product_name ?? 'product');
                    $filename = $baseName . '_' . time() . '_' . Str::random(6) . '.' . $extension;

                    $path = $image->move($uploadDir, $filename);
                    $imagePaths[] = asset('storage/products/' . $filename);
                }
            }
        }


        $commonData = [
            'item_code' => $request->item_code,
            'product_name' => $request->product_name,
            'slug' => $request->slug,
            'brand' => $request->brand,
            'selling_type' => $request->selling_type,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'quantity_alert' => $request->quantity_alert,
            'wholesale_price' => $request->wholesale_price ?? 0.00,
            'online_price' => $request->online_price ?? 0.00,
            'product_type' => 1,
            'manufacturer' => $request->manufacturer,
            'manufacturer_date' => $formatDate($request->manufacturer_date),
            'expiry_date' => $formatDate($request->expiry_date),
            'location' => $request->location,

            'unit' => $request->unit,
            'product_description' => $request->product_description,
            'warranty' => $request->warranty,
            'quantity' => Arr::get($request->quantity, 0, $request->quantity),
            'buying_price' => Arr::get($request->buying_price, 0, $request->buying_price),
            'average_cost_price' => Arr::get($request->buying_price, 0, $request->buying_price),
            'selling_price' => Arr::get($request->selling_price, 0, $request->selling_price),
            'discount_amount' => Arr::get($request->discount_amount, 0, $request->discount_amount),
            'discount_percentage' => Arr::get($request->discount_percentage, 0, $request->discount_percentage),
            'mark' => Arr::get($request->mark, 0, $request->mark),
            'images' => !empty($imagePaths) ? json_encode($imagePaths) : $product->images,
            'serial_number1' => $request->serial_number1 ?? '',
            'serial_number2' => $request->serial_number2 ?? '',
            'free_service_count' => $request->free_service_count ?? null,
            'free_service_duration' => $request->free_service_duration ?? null,
        ];

        $product->update($commonData);

        // 🔄 Update or Create Stock record

        if ($request->free_service_count) {
            Service::updateOrCreate(
                [
                    'product_id' => $product->id,
                ],
                [
                    'free_service_count' => $request->free_service_count,
                    'validity_days' => $request->free_service_duration,
                ]
            );
        }

        Stocks::updateOrCreate(
            [
                'product_id' => $product->id,
                'location_id' => $product->location,
            ],
            [
                'stock' => $product->quantity,
            ]
        );

        return redirect()
            ->route('product.index')
            ->with('success', 'Product updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $product = Product::findOrFail($request->id);
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }


    // custome

    public function nextItemCode()
    {
        $lastProduct = Product::orderBy('id', 'desc')->first();
        $nextId = $lastProduct ? $lastProduct->id + 1 : 1;
        $autoItemCode = 'ITM' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        return response()->json(['code' => $autoItemCode]);
    }

    // AI Image GEN
    public function generateAiImage(Request $request)
    {
        try {
            $response = Http::post(config('python.url') . '/generate', [
                'prompt' => "Product photo: " . $request->input('product_name'),
                'negative_prompt' => 'blurry, low quality, text, watermark',
                'width' => 512,
                'height' => 512
            ]);

            if ($response->successful()) {
                $imageData = $response->json()['image'];
                // Save image to storage
                $path = 'products/' . time() . '.png';
                Storage::put($path, base64_decode($imageData));

                return response()->json(['path' => $path]);
            }

            return response()->json(['error' => 'Generation failed'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Export to excel
    public function exportSelected(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No products selected.');
        }

        return Excel::download(new ProductsExport($ids), 'products_lists.xlsx');
    }


    public function exportSelectedPdf(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No products selected.');
        }

        $products = Product::whereIn('id', $ids)->get();

        $pdf = Pdf::loadView('export.products_pdf', compact('products'));
        return $pdf->download('Products-list.pdf');
    }


    // Expired Product List
    public function expiredProducts()
    {

        $products = Product::with('cate')->with('supply')->where('expiry_date', '<', Carbon::today())->latest()->get();
        $catgeories = Category::latest()->get();
        $location = Location::latest()->get();

        return view("app.products.expired-product", compact("products", "catgeories", "location"));
    }

    public function expiredFilterByCategory(Request $request)
    {

        $categoryName = $request->category;
        $category = Category::where('category', $categoryName)->first();

        $products = [];
        if ($category) {
            $products = Product::with('cate', 'supply')
                ->where('category', $category->id)
                ->where('expiry_date', '<', Carbon::today())
                ->latest()
                ->get();
        }
        // Return only the table rows as HTML
        $html = view('app.products.expired-table', compact('products'))->render();
        return response()->json(['html' => $html]);
    }

    public function restoreProduct(Request $request)
    {

        // Format date helper
        $formatDate = function ($date) {
            return $date ? Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d') : null;
        };
        $product = Product::find($request->id);
        $product->product_name = $request->product_name;
        $product->manufacturer_date = $formatDate($request->manufacturer_date);
        $product->expiry_date = $formatDate($request->expiry_date);
        $product->save();
        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function lowStockProducts()
    {
        //
        $products = Product::with(['cate', 'supply'])
            ->whereRaw('quantity <= quantity_alert * 2')
            ->latest()
            ->get();
        $OutProducts = Product::with(['cate', 'supply'])
            ->where('quantity', '<=', 0)
            ->latest()
            ->get();

        $catgeories = Category::latest()->get();
        $location = Location::latest()->get();

        return view("app.products.low-stock", compact("products", "catgeories", "location", 'OutProducts'));
    }
    public function stockSendMail(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No products selected.');
        }

        $products = Product::whereIn('id', $ids)->get();

        // Generate the PDF content as a string
        $pdf = Pdf::loadView('export.products_pdf', compact('products'));
        $pdfContent = $pdf->output();

        // Send email to admin
        Mail::to('nithurshan002@gmail.com')->send(new LowstockProductListMail($pdfContent));

        return redirect()->back()->with('success', 'Email sent successfully to admin.');
    }

    // Low Stock Edit Product list
    public function lowStockProductsEdit(Request $request)
    {
        $product = Product::find($request->id);
        $product->product_name = $request->product_name;
        $product->quantity = $request->quantity ?? 0;
        $product->quantity_alert = $request->quantity_alert ?? 0;
        $product->save();
        return redirect()->back()->with('success', 'The product has been restocked and is now available in your inventory.');
    }


    public function import(Request $request)
    {

        $request->validate([
            'importFile' => 'required|mimes:xlsx,xls,xlsm,csv'
        ]);

        try {
            Excel::import(new ProductsImport, $request->file('importFile'));

            return back()->with('success', 'Products imported successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Import failed!');
        }
    }
}
