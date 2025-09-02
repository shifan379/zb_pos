<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('app.brand.list', compact('brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $brand = new Brand();
        $brand->name = $validated['name'];
        $brand->status = $request->has('status') ? 1 : 0;

        // Handle image upload (same as Supplier logic)
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $baseName = Str::slug($request->name ?? 'brand');
                $filename = $baseName . '_' . time() . '_' . Str::random(6) . '.' . $extension;

                $uploadDir = public_path('storage/brands');
                File::ensureDirectoryExists($uploadDir, 0755, true);

                $image->move($uploadDir, $filename);

                // Store full public path
                $brand->image = asset('storage/brands/' . $filename);
            }
        }

        $brand->save();

        return back()->with('success', 'Brand added successfully!');
    }


    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return response()->json($brand);
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $brand->name = $validated['name'];
        $brand->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $filename = Str::slug($brand->name) . '_' . time() . '.' . $extension;

                $uploadDir = public_path('storage/brands');
                File::ensureDirectoryExists($uploadDir, 0755, true);

                $image->move($uploadDir, $filename);
                $brand->image = 'storage/brands/' . $filename;
            }
        }

        $brand->save();

        return back()->with('success', 'Brand updated successfully!');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return back()->with('success', 'Brand deleted successfully!');
    }
}
