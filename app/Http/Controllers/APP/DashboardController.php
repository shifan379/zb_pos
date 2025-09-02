<?php

namespace App\Http\Controllers\APP;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\product;
use App\Models\Purchase;
use App\Models\PurchaseReturn;
use App\Models\ReturnLog;
use App\Models\Supplier;
use App\Models\Transaction;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Products that are low in stock (less than or equal to 2x alert quantity)
        $products = product::with(['cate', 'supply'])
            ->whereRaw('quantity <= quantity_alert * 2')
            ->latest()
            ->get();


        // Total Sales
        $todaySales = Order::whereDate('created_at', Carbon::today())
            ->sum('total');

        // Total Sales Return
        $returnSales = ReturnLog::whereDate('created_at', Carbon::today())
            ->sum('total');

        // Total Purchase
        $totalPurchase = Purchase::whereDate('created_at', Carbon::today())
            ->sum('total');

        // Total Purchase Return
        $totalPurchaseReturn = PurchaseReturn::whereDate('created_at', Carbon::today())
            ->sum('total');

        // Total Profit Calculation
        $totalProfit = DB::table('order_items')
            ->join('products', 'order_items.productID', '=', 'products.id')
            ->select(DB::raw('SUM((order_items.net_price - products.buying_price) * order_items.qty) as profit'))
            ->value('profit');

        // Total Income (Payin)
        $totalIncomes = DB::table('payment_logbooks')
            ->where('name', 'payin')
            ->sum('amount'); // assuming your table has 'amount' column

        // Total Expenses (Payout)
        $totalExpenses = DB::table('payment_logbooks')
            ->where('name', 'payout')
            ->sum('amount');

        // Total Payment Return
        $totalPaymentReturn = Order::whereDate('created_at', Carbon::today())
            ->sum('return_amount');

        // Supplier Total
        $totalSupplier = Supplier::whereDate('created_at', Carbon::today())
            ->count('id');

        // Total Customers
        $totalCustomer = DB::table('customers')
            ->whereDate('created_at', Carbon::today())
            ->count('id');

        // Total Orders
        $totalOrders = Order::whereDate('created_at', Carbon::today())
            ->count('id');

        // Top Selling Products
        $topProducts = OrderItem::select(
            'productID',
            DB::raw('SUM(qty) as total_qty'),
            DB::raw('SUM(total) as total_amount')
        )
            ->with('product') // eager load product relation
            ->groupBy('productID')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        // Products that are low in stock (less than or equal to 2x alert quantity)
        $products = product::with(['cate', 'supply'])
            ->whereRaw('quantity <= quantity_alert * 2')
            ->latest()
            ->get();

        // Out of stock products
        $OutProducts = product::with(['cate', 'supply'])
            ->where('quantity', '<=', 0)
            ->latest()
            ->take(5)
            ->get();

        $categories = Category::latest()->get();
        $locations = Location::latest()->get();

        // Get the 5 most recent orders with their items
        $recentOrders = Order::with('items.product') // assuming relation 'orderItems' and 'product'
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Recent Sales
        $recentSales = Transaction::with('order.customer') // eager load customer via order
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Purchase return Transection
        $recentPurchases = Purchase::with('supplier') // eager load supplier
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Top Customers
        $topCustomers = Customer::withCount('orders')
            ->withSum('orders', 'total') // 'total' is the column in orders table for total spent
            ->orderByDesc('orders_sum_total') // sum column is named automatically by Laravel
            ->take(5)
            ->get();

        // Top Categories

        $topCategories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->take(3)
            ->get();
        $topCategoryLabels = $topCategories->pluck('category')->toArray();
        $topCategoryValues = $topCategories->pluck('products_count')->toArray();


        $totalCategories = Category::count();
        $totalProducts = \App\Models\product::count();

        // Sales & Purchase chart (last 12 months)
        $salesPurchaseChart = [];
        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');
            $sales = Order::whereYear('created_at', substr($month, 0, 4))
                ->whereMonth('created_at', substr($month, 5, 2))
                ->sum('total');
            $purchases = Purchase::whereYear('created_at', substr($month, 0, 4))
                ->whereMonth('created_at', substr($month, 5, 2))
                ->sum('total');
            $salesPurchaseChart[$month] = [
                'sales' => $sales,
                'purchase' => $purchases,
            ];
        }
        $salesPurchaseChart = array_reverse($salesPurchaseChart, true);

        // Sales Statistics
        $salesStatics = [
            'revenue' => Order::sum('total'), // or your profit logic
            'expense' => Purchase::sum('total'), // or payout logic
        ];

        $monthlyStats = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');
            $monthlyRevenue = Order::whereYear('created_at', substr($month, 0, 4))
                ->whereMonth('created_at', substr($month, 5, 2))
                ->sum('total');
            $monthlyExpense = Purchase::whereYear('created_at', substr($month, 0, 4))
                ->whereMonth('created_at', substr($month, 5, 2))
                ->sum('total');

            $monthlyStats[$month] = [
                'revenue' => $monthlyRevenue,
                'expense' => $monthlyExpense,
            ];
        }

        $today = Carbon::today();
        $lastMonth = Carbon::now()->subMonth();

        // Revenue
        $revenue = Order::sum('total');
        $revenueLastMonth = Order::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('total');
        $revenueChange = $revenueLastMonth ? round((($revenue - $revenueLastMonth) / $revenueLastMonth) * 100, 2) : 0;

        // Expense
        $expense = Purchase::sum('total');
        $expenseLastMonth = Purchase::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('total');
        $expenseChange = $expenseLastMonth ? round((($expense - $expenseLastMonth) / $expenseLastMonth) * 100, 2) : 0;



        $orderStats = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date')
            ->toArray();

        $totalSales = Order::sum('total');
        $totalPurchases = Purchase::sum('total');

        // Order statistics for heatmap (hour vs day)
        $orderHeatmap = [];
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

        foreach ($days as $dayIndex => $dayName) {
            for ($hour = 0; $hour < 24; $hour += 2) { // 2-hour blocks
                $count = Order::whereRaw('WEEKDAY(created_at) = ?', [$dayIndex])
                    ->whereRaw('HOUR(created_at) >= ? AND HOUR(created_at) < ?', [$hour, $hour + 2])
                    ->count();

                $orderHeatmap[$dayName][$hour] = $count;
            }
        }





        // Return the view with the data
        return view('app.dashboard', compact(
            'products',
            'todaySales',
            'returnSales',
            'totalPurchase',
            'totalPurchaseReturn',
            'totalProfit',
            'totalIncomes',
            'totalExpenses',
            'totalPaymentReturn',
            'totalSupplier',
            'totalCustomer',
            'totalOrders',
            'topProducts',
            'products',
            'OutProducts',
            'categories',
            'locations',
            'recentOrders',
            'recentSales',
            'recentPurchases',
            'topCustomers',
            'topCategories',
            'totalCategories',
            'totalProducts',
            'salesPurchaseChart',
            'salesStatics',
            'monthlyStats',
            'orderStats',
            'totalSales',
            'totalPurchases',
            'revenue',
            'revenueChange',
            'expense',
            'expenseChange',
            'monthlyStats',
            'topCategoryLabels',
            'topCategoryValues',
            'orderHeatmap'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
