<x-app-layout>
    @section('title', 'Dashboard')

    @push('css')
        <!-- Datetimepicker CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
        <!-- Select2 CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
        <!-- Daterangepikcer CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
        {{-- Animation CSS --}}
        <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    @endpush

    @section('content')
        <div class="content">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-2">
                <div class="mb-3">
                    <h1 class="mb-1">Welcome, Admin</h1>
                    <p class="fw-medium">You have <span class="text-primary fw-bold">200+</span> Orders, Today</p>
                </div>
                {{-- <div class="input-icon-start position-relative mb-3">
                    <span class="input-icon-addon fs-16 text-gray-9">
                        <i class="ti ti-calendar"></i>
                    </span>
                    <input type="text" class="form-control date-range bookingrange" placeholder="Search Product">
                </div> --}}
            </div>

            @foreach ($OutProducts->take(3) as $product)
                <div class="alert bg-orange-transparent alert-dismissible fade show mb-4">
                    <div>
                        <span>
                            <i class="ti ti-info-circle fs-14 text-orange me-2"></i>
                            Your Product
                        </span>
                        <span class="text-orange fw-semibold">{{ $product->product_name }}</span>
                        is running low, already below {{ $product->quantity }} pcs.,
                        <a href="{{route('purchase')}}" class="link-orange text-decoration-underline fw-semibold"
                            {{-- data-bs-toggle="modal" data-bs-target="#add-stock" data-product-id="{{ $product->id }}"
                            data-product-name="{{ $product->name }}"> --}}
                            > Add Stock
                        </a>
                    </div>
                    <button type="button" class="btn-close text-gray-9 fs-14" data-bs-dismiss="alert" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            @endforeach


            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-primary sale-widget flex-fill">
                        <div class="card-body d-flex align-items-center">
                            <span class="sale-icon bg-white text-primary">
                                <i class="ti ti-file-text fs-24"></i>
                            </span>
                            <div class="ms-2">
                                <p class="text-white mb-1">Total Sales</p>
                                <div class="d-inline-flex align-items-center flex-wrap gap-2">
                                    <h4 class="text-white">Rs.{{ number_format($todaySales, 2) }}</h4>
                                    {{-- <span class="badge badge-soft-primary"><i class="ti ti-arrow-up me-1"></i>+22%</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-secondary sale-widget flex-fill">
                        <div class="card-body d-flex align-items-center">
                            <span class="sale-icon bg-white text-secondary">
                                <i class="ti ti-repeat fs-24"></i>
                            </span>
                            <div class="ms-2">
                                <p class="text-white mb-1">Total Sales Return</p>
                                <div class="d-inline-flex align-items-center flex-wrap gap-2">
                                    <h4 class="text-white">Rs.{{ number_format($returnSales, 2) }}</h4>
                                    {{-- <span class="badge badge-soft-danger"><i class="ti ti-arrow-down me-1"></i>-22%</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-teal sale-widget flex-fill">
                        <div class="card-body d-flex align-items-center">
                            <span class="sale-icon bg-white text-teal">
                                <i class="ti ti-gift fs-24"></i>
                            </span>
                            <div class="ms-2">
                                <p class="text-white mb-1">Total Purchase</p>
                                <div class="d-inline-flex align-items-center flex-wrap gap-2">
                                    <h4 class="text-white">Rs.{{ number_format($totalPurchase, 2) }}</h4>
                                    {{-- <span class="badge badge-soft-success"><i class="ti ti-arrow-up me-1"></i>+22%</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-info sale-widget flex-fill">
                        <div class="card-body d-flex align-items-center">
                            <span class="sale-icon bg-white text-info">
                                <i class="ti ti-brand-pocket fs-24"></i>
                            </span>
                            <div class="ms-2">
                                <p class="text-white mb-1">Total Purchase Return</p>
                                <div class="d-inline-flex align-items-center flex-wrap gap-2">
                                    <h4 class="text-white">Rs.{{ number_format($totalPurchaseReturn, 2) }}</h4>
                                    {{-- <span class="badge badge-soft-success"><i class="ti ti-arrow-up me-1"></i>+22%</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">

                <!-- Profit -->
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card revenue-widget flex-fill">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                <div>
                                    <h4 class="mb-1">Rs.{{ number_format($totalProfit, 2) }}</h4>
                                    <p>Profit</p>
                                </div>
                                <span class="revenue-icon bg-cyan-transparent text-cyan">
                                    <i class="fa-solid fa-layer-group fs-16"></i>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /Profit -->

                <!-- Income -->
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card revenue-widget flex-fill">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                <div>
                                    <h4 class="mb-1">Rs.{{ number_format($totalIncomes, 2) }}</h4>
                                    <p>Total Incomes</p>
                                </div>
                                <span class="revenue-icon bg-teal-transparent text-teal">
                                    <i class="ti ti-chart-pie fs-16"></i>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /Income -->

                <!-- Expenses -->
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card revenue-widget flex-fill">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                <div>
                                    <h4 class="mb-1">Rs.{{ number_format($totalExpenses, 2) }}</h4>
                                    <p>Total Expenses</p>
                                </div>
                                <span class="revenue-icon bg-orange-transparent text-orange">
                                    <i class="ti ti-lifebuoy fs-16"></i>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /Expenses -->

                <!-- Returns -->
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card revenue-widget flex-fill">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                <div>
                                    <h4 class="mb-1">Rs.{{ number_format($totalPaymentReturn, 2) }}</h4>
                                    <p>Total Payment Returns</p>
                                </div>
                                <span class="revenue-icon bg-indigo-transparent text-indigo">
                                    <i class="ti ti-hash fs-16"></i>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /Returns -->

            </div>

            <div class="row">

                <!-- Sales & Purchase -->
                <div class="col-xxl-8 col-xl-7 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-inline-flex align-items-center">
                                <span class="title-icon bg-soft-primary fs-16 me-2"><i
                                        class="ti ti-shopping-cart"></i></span>
                                <h5 class="card-title mb-0">Sales & Purchase</h5>
                            </div>
                            {{-- <ul class="nav btn-group custom-btn-group">
                                <a class="btn btn-outline-light" href="javascript:void(0);">1D</a>
                                <a class="btn btn-outline-light" href="javascript:void(0);">1W</a>
                                <a class="btn btn-outline-light" href="javascript:void(0);">1M</a>
                                <a class="btn btn-outline-light" href="javascript:void(0);">3M</a>
                                <a class="btn btn-outline-light" href="javascript:void(0);">6M</a>
                                <a class="btn btn-outline-light active" href="javascript:void(0);">1Y</a>
                            </ul> --}}
                        </div>
                        <div class="card-body pb-0">
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="border p-2 br-8">
                                        <p class="d-inline-flex align-items-center mb-1"><i
                                                class="ti ti-circle-filled fs-8 text-primary-300 me-1"></i>Total Purchase
                                        </p>
                                        <h4>Rs.{{ number_format($totalPurchases) }}</h4>
                                    </div>
                                    <div class="border p-2 br-8">
                                        <p class="d-inline-flex align-items-center mb-1"><i
                                                class="ti ti-circle-filled fs-8 text-primary me-1"></i>Total Sales</p>
                                        <h4>Rs.{{ number_format($totalSales) }}</h4>
                                    </div>
                                </div>
                                <div id="sales-day"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Laravel data passed to JS
                                        var salesPurchaseChart = @json($salesPurchaseChart);

                                        var months = Object.keys(salesPurchaseChart);
                                        var sales = months.map(m => salesPurchaseChart[m].sales);
                                        var purchases = months.map(m => salesPurchaseChart[m].purchase);

                                        var options = {
                                            chart: {
                                                type: 'line',
                                                height: 250,
                                                toolbar: {
                                                    show: false
                                                }
                                            },
                                            series: [{
                                                    name: "Sales",
                                                    data: sales
                                                },
                                                {
                                                    name: "Purchases",
                                                    data: purchases
                                                }
                                            ],
                                            xaxis: {
                                                categories: months
                                            },
                                            colors: ["#3b82f6", "#10b981"], // blue & green
                                            stroke: {
                                                curve: 'smooth',
                                                width: 3
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            legend: {
                                                position: 'top'
                                            }
                                        };

                                        var chart = new ApexCharts(document.querySelector("#sales-day"), options);
                                        chart.render();
                                    });
                                </script>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Sales & Purchase -->

                <!-- Top Selling Products -->
                <div class="col-xxl-4 col-xl-5 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-inline-flex align-items-center">
                                <span class="title-icon bg-soft-info fs-16 me-2"><i class="ti ti-info-circle"></i></span>
                                <h5 class="card-title mb-0">Overall Information</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="info-item border bg-light p-3 text-center">
                                        <div class="mb-2 text-info fs-24">
                                            <i class="ti ti-user-check"></i>
                                        </div>
                                        <p class="mb-1">Suppliers</p>
                                        <h5>{{ number_format($totalSupplier, 0) }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-item border bg-light p-3 text-center">
                                        <div class="mb-2 text-orange fs-24">
                                            <i class="ti ti-users"></i>
                                        </div>
                                        <p class="mb-1">Customer</p>
                                        <h5>{{ number_format($totalCustomer, 0) }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-item border bg-light p-3 text-center">
                                        <div class="mb-2 text-teal fs-24">
                                            <i class="ti ti-shopping-cart"></i>
                                        </div>
                                        <p class="mb-1">Orders</p>
                                        <h5>{{ number_format($totalOrders, 0) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-footer pb-sm-0">
								<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
									<h5>Customers Overview</h5>
									<div class="dropdown dropdown-wraper">
										<a href="javascript:void(0);" class="dropdown-toggle btn btn-sm btn-white"  data-bs-toggle="dropdown" aria-expanded="false">
											<i class="ti ti-calendar me-1"></i>Today
										</a>
										<ul class="dropdown-menu p-3">
											<li>
												<a href="javascript:void(0);" class="dropdown-item">Today</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="dropdown-item">Weekly</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="dropdown-item">Monthly</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col-sm-5">
										<div id="customer-chart"></div>
									</div>
									<div class="col-sm-7">
										<div class="row gx-0">
											<div class="col-sm-6">
												<div class="text-center border-end">
													<h2 class="mb-1">5.5K</h2>
													<p class="text-orange mb-2">First Time</p>
													<span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-arrow-up-left me-1"></i>25%</span>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="text-center">
													<h2 class="mb-1">3.5K</h2>
													<p class="text-teal mb-2">Return</p>
													<span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-arrow-up-left me-1"></i>21%</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> --}}
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Top Selling Products -->
                <div class="col-xxl-4 col-md-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-inline-flex align-items-center">
                                <span class="title-icon bg-soft-pink fs-16 me-2"><i class="ti ti-box"></i></span>
                                <h5 class="card-title mb-0">Top Selling Products</h5>
                            </div>
                        </div>
                        <div class="card-body sell-product">
                            @foreach ($topProducts->take(5) as $product)
                                @php
                                    $images = $product->product?->images
                                        ? json_decode($product->product->images, true)
                                        : [];
                                    $firstImage = $images[0] ?? asset('assets/img/products/istockphoto.png');
                                @endphp
                                <div class="d-flex align-items-center justify-content-between border-bottom mb-2">
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-lg">
                                            <img src="{{ $firstImage }}" alt="Product">
                                        </a>
                                        <div class="ms-2">
                                            <h6 class="fw-bold mb-1">
                                                <a
                                                    href="javascript:void(0);">{{ $product->product->product_name ?? 'Unknown' }}</a>
                                            </h6>
                                            <div class="d-flex align-items-center item-list">
                                                <p>Rs. {{ number_format($product->total_amount, 2) }}</p>
                                                <p>{{ $product->total_qty }}+ Sales</p>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="badge bg-outline-success badge-xs d-inline-flex align-items-center">
                                        <i class="ti ti-arrow-up-left me-1"></i>
                                        {{ round(($product->total_qty / $topProducts->sum('total_qty')) * 100, 1) }}%
                                    </span>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
                <!-- /Top Selling Products -->

                <!-- Low Stock Products -->
                <div class="col-xxl-4 col-md-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-inline-flex align-items-center">
                                <span class="title-icon bg-soft-danger fs-16 me-2"><i
                                        class="ti ti-alert-triangle"></i></span>
                                <h5 class="card-title mb-0">Low Stock Products</h5>
                            </div>
                            <a href="{{ route('low-stock.product') }}"
                                class="fs-13 fw-medium text-decoration-underline">View All</a>
                        </div>
                        <div class="card-body">
                            @forelse($OutProducts->take(5) as $product)
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        @php
                                            $images = $product->images ? json_decode($product->images, true) : [];
                                            $firstImage = $images[0] ?? 'assets/img/products/istockphoto.png';
                                        @endphp
                                        <a href="javascript:void(0);" class="avatar avatar-lg">
                                            <img src="{{ asset($firstImage) }}" alt="{{ $product->product_name }}"> </a>
                                        <div class="ms-2">
                                            <h6 class="fw-bold mb-1"><a
                                                    href="javascript:void(0);">{{ $product->product_name }}</a></h6>
                                            <p class="fs-13">ID : #{{ $product->id }}</p>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <p class="fs-13 mb-1">Instock</p>
                                        <h6 class="text-orange fw-medium">{{ $product->quantity }}</h6>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">No low stock products.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- /Low Stock Products -->


                <!-- Recent Sales -->
                <div class="col-xxl-4 col-md-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-inline-flex align-items-center">
                                <span class="title-icon bg-soft-pink fs-16 me-2"><i class="ti ti-box"></i></span>
                                <h5 class="card-title mb-0">Recent Sales</h5>
                            </div>
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle btn btn-sm btn-white"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-calendar me-1"></i>Weekly
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li><a href="javascript:void(0);" class="dropdown-item">Today</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item">Weekly</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item">Monthly</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($recentOrders->take(5) as $order)
                                @php
                                    $firstItem = $order->items->first(); // could be null

                                    // Get product images
                                    $images = $firstItem->product?->images
                                        ? json_decode($firstItem->product->images, true)
                                        : [];
                                    $firstImage = $images[0] ?? 'assets/img/products/istockphoto.png';
                                @endphp

                                @if ($firstItem)
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-lg">
                                                <img src="{{ asset($firstImage) }}" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-bold mb-1">
                                                    <a
                                                        href="javascript:void(0);">{{ $firstItem->product->product_name ?? 'N/A' }}</a>
                                                </h6>
                                                <div class="d-flex align-items-center item-list">
                                                    <p>{{ $firstItem->qty ?? 'Uncategorized' }}</p>
                                                    <p class="text-gray-9">Rs.{{ number_format($firstItem->total, 2) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <p class="fs-13 mb-1">{{ $order->created_at->diffForHumans() }}</p>
                                            <span class="badge bg-purple badge-xs d-inline-flex align-items-center">
                                                <i
                                                    class="ti ti-circle-filled fs-5 me-1"></i>{{ ucfirst($order->order_type) }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach


                        </div>
                    </div>
                </div>


            </div>

            <div class="row">

                <!-- Sales Statics -->
                <div class="col-xl-6 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-inline-flex align-items-center">
                                <span class="title-icon bg-soft-danger fs-16 me-2"><i
                                        class="ti ti-alert-triangle"></i></span>
                                <h5 class="card-title mb-0">Sales Statics</h5>
                            </div>
                            {{-- <div class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle btn btn-sm btn-white"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-calendar me-1"></i>2025
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2025</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                        <div class="card-body pb-0">
                            <div class="d-flex align-items-center flex-wrap gap-2">
                                <div class="border p-2 br-8">
                                    <h5 class="d-inline-flex align-items-center text-teal">
                                        Rs.{{ number_format($revenue) }}
                                        <span
                                            class="badge badge-{{ $revenueChange >= 0 ? 'success' : 'danger' }} badge-xs d-inline-flex align-items-center ms-2">
                                            <i
                                                class="ti {{ $revenueChange >= 0 ? 'ti-arrow-up-left' : 'ti-arrow-down-right' }} me-1"></i>
                                            {{ abs($revenueChange) }}%
                                        </span>
                                    </h5>
                                    <p>Revenue</p>
                                </div>
                                <div class="border p-2 br-8">
                                    <h5 class="d-inline-flex align-items-center text-orange">
                                        Rs.{{ number_format($expense) }}
                                        <span
                                            class="badge badge-{{ $expenseChange >= 0 ? 'danger' : 'success' }} badge-xs d-inline-flex align-items-center ms-2">
                                            <i
                                                class="ti {{ $expenseChange >= 0 ? 'ti-arrow-down-right' : 'ti-arrow-up-left' }} me-1"></i>
                                            {{ abs($expenseChange) }}%
                                        </span>
                                    </h5>
                                    <p>Expense</p>
                                </div>
                            </div>

                            <div id="sales-statistic"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var monthlyStats = @json($monthlyStats);

                                    var months = Object.keys(monthlyStats);
                                    var revenue = months.map(m => monthlyStats[m].revenue);
                                    var expense = months.map(m => monthlyStats[m].expense);

                                    var options = {
                                        chart: {
                                            type: 'area',
                                            height: 300,
                                            toolbar: {
                                                show: false
                                            }
                                        },
                                        series: [{
                                                name: 'Revenue',
                                                data: revenue
                                            },
                                            {
                                                name: 'Expense',
                                                data: expense
                                            }
                                        ],
                                        xaxis: {
                                            categories: months
                                        },
                                        colors: ['#20c997', '#fd7e14'], // teal for revenue, orange for expense
                                        stroke: {
                                            curve: 'smooth',
                                            width: 3
                                        },
                                        markers: {
                                            size: 4
                                        },
                                        legend: {
                                            position: 'top'
                                        },
                                        tooltip: {
                                            y: {
                                                formatter: function(val) {
                                                    return "Rs." + val.toLocaleString();
                                                }
                                            }
                                        }
                                    };

                                    var chart = new ApexCharts(document.querySelector("#sales-statistic"), options);
                                    chart.render();
                                });
                            </script>

                        </div>
                    </div>
                </div>
                <!-- /Sales Statics -->

                <!-- Recent Transactions -->
                <div class="col-xl-6 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div class="d-inline-flex align-items-center">
                                <span class="title-icon bg-soft-orange fs-16 me-2"><i class="ti ti-flag"></i></span>
                                <h5 class="card-title mb-0">Recent Transactions</h5>
                            </div>
                            {{-- <a href="online-orders.html" class="fs-13 fw-medium text-decoration-underline">View All</a> --}}
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-tabs nav-justified transaction-tab">
                                <li class="nav-item"><a class="nav-link active" href="#sale"
                                        data-bs-toggle="tab">Sale</a></li>
                                {{-- <li class="nav-item"><a class="nav-link" href="#purchase-transaction"
                                        data-bs-toggle="tab">Purchase</a></li>
                                <li class="nav-item"><a class="nav-link" href="#quotation"
                                        data-bs-toggle="tab">Quotation</a></li>
                                <li class="nav-item"><a class="nav-link" href="#expenses"
                                        data-bs-toggle="tab">Expenses</a></li>
                                <li class="nav-item"><a class="nav-link" href="#invoices"
                                        data-bs-toggle="tab">Invoices</a></li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="sale">
                                    <div class="table-responsive">
                                        <table class="table table-borderless custom-table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Customer</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($recentSales->take(5) as $transaction)
                                                    @php
                                                        $order = $transaction->order;
                                                        $customer = $order?->customer;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center file-name-icon">
                                                                <a href="javascript:void(0);" class="avatar avatar-md">
                                                                    <img src="{{ $customer->image ?? asset('assets/img/products/istockphoto.png') }}"
                                                                        class="img-fluid" alt="img">
                                                                </a>
                                                                <div class="ms-2">
                                                                    <h6>
                                                                        <a href="javascript:void(0);" class="fw-bold">
                                                                            {{ $customer ? $customer->first_name . ' ' . $customer->last_name : 'Walk in Customer' }}
                                                                        </a>
                                                                    </h6>
                                                                    <span
                                                                        class="fs-13 text-orange">{{ $order?->invoice_no ?? '---' }}</span>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <span
                                                                class="badge badge-{{ $transaction->payment_status == 'Completed' ? 'success' : 'pink' }} badge-xs d-inline-flex align-items-center">
                                                                <i class="ti ti-circle-filled fs-5 me-1"></i>
                                                                {{ $transaction->payment_status ?? 'Pending' }}
                                                            </span>
                                                        </td>
                                                        <td class="fs-16 fw-bold text-gray-9">
                                                            ${{ number_format($transaction->total, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="purchase-transaction">
                                    <div class="table-responsive">
                                        <table class="table table-borderless custom-table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Supplier</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($recentPurchases->take(5) as $purchase)
                                                    <tr>
                                                        <td>{{ $purchase->created_at->format('d M Y') }}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="fw-semibold">
                                                                {{ $purchase->supplier?->company_name ?? 'N/A' }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge badge-{{ $purchase->status == 'Completed' ? 'success' : 'cyan' }} badge-xs d-inline-flex align-items-center">
                                                                <i class="ti ti-circle-filled fs-5 me-1"></i>
                                                                {{ $purchase->status ?? 'Pending' }}
                                                            </span>
                                                        </td>
                                                        <td class="text-gray-9">
                                                            ${{ number_format($purchase->total_amount ?? 0, 2) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="quotation">
                                    <div class="table-responsive">
                                        <table class="table table-borderless custom-table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Customer</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>24 May 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center file-name-icon">
                                                            <a href="javascript:void(0);" class="avatar avatar-md">
                                                                <img srcasset="assets/img/customer/customer16.jpg"
                                                                    class="img-fluid" alt="img">
                                                            </a>
                                                            <div class="ms-2">
                                                                <h6 class="fw-medium"><a href="javascript:void(0);">Andrea
                                                                        Willer</a></h6>
                                                                <span class="fs-13 text-orange">#114589</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><span
                                                            class="badge badge-success badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Sent</span></td>
                                                    <td class="text-gray-9">$4,560</td>
                                                </tr>
                                                <tr>
                                                    <td>23 May 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center file-name-icon">
                                                            <a href="javascript:void(0);" class="avatar avatar-md">
                                                                <img srcasset="assets/img/customer/customer17.jpg"
                                                                    class="img-fluid" alt="img">
                                                            </a>
                                                            <div class="ms-2">
                                                                <h6 class="fw-medium"><a
                                                                        href="javascript:void(0);">Timothy Sandsr</a></h6>
                                                                <span class="fs-13 text-orange">#114589</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><span
                                                            class="badge badge-warning badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Ordered</span>
                                                    </td>
                                                    <td class="text-gray-9">$3,569</td>
                                                </tr>
                                                <tr>
                                                    <td>22 May 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center file-name-icon">
                                                            <a href="javascript:void(0);" class="avatar avatar-md">
                                                                <img srcasset="assets/img/customer/customer18.jpg"
                                                                    class="img-fluid" alt="img">
                                                            </a>
                                                            <div class="ms-2">
                                                                <h6 class="fw-medium"><a href="javascript:void(0);">Bonnie
                                                                        Rodrigues</a></h6>
                                                                <span class="fs-13 text-orange">#114589</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><span
                                                            class="badge badge-cyan badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Pending</span>
                                                    </td>
                                                    <td class="text-gray-9">$4,560</td>
                                                </tr>
                                                <tr>
                                                    <td>21 May 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center file-name-icon">
                                                            <a href="javascript:void(0);" class="avatar avatar-md">
                                                                <img srcasset="assets/img/customer/customer15.jpg"
                                                                    class="img-fluid" alt="img">
                                                            </a>
                                                            <div class="ms-2">
                                                                <h6 class="fw-medium"><a href="javascript:void(0);">Randy
                                                                        McCree</a></h6>
                                                                <span class="fs-13 text-orange">#114589</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><span
                                                            class="badge badge-warning badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Ordered</span>
                                                    </td>
                                                    <td class="text-gray-9">$2,155</td>
                                                </tr>
                                                <tr>
                                                    <td>21 May 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center file-name-icon">
                                                            <a href="javascript:void(0);" class="avatar avatar-md">
                                                                <img srcasset="assets/img/customer/customer13.jpg"
                                                                    class="img-fluid" alt="img">
                                                            </a>
                                                            <div class="ms-2">
                                                                <h6 class="fw-medium"><a href="javascript:void(0);">Dennis
                                                                        Anderson</a></h6>
                                                                <span class="fs-13 text-orange">#114589</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><span
                                                            class="badge badge-success badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Sent</span></td>
                                                    <td class="text-gray-9">$5,123</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="expenses">
                                    <div class="table-responsive">
                                        <table class="table table-borderless custom-table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Expenses</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>24 May 2025</td>
                                                    <td>
                                                        <h6 class="fw-medium"><a href="javascript:void(0);">Electricity
                                                                Payment</a></h6>
                                                        <span class="fs-13 text-orange">#EX849</span>
                                                    </td>
                                                    <td><span
                                                            class="badge badge-success badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Approved</span>
                                                    </td>
                                                    <td class="text-gray-9">$200</td>
                                                </tr>
                                                <tr>
                                                    <td>23 May 2025</td>
                                                    <td>
                                                        <h6 class="fw-medium"><a href="javascript:void(0);">Electricity
                                                                Payment</a></h6>
                                                        <span class="fs-13 text-orange">#EX849</span>
                                                    </td>
                                                    <td><span
                                                            class="badge badge-success badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Approved</span>
                                                    </td>
                                                    <td class="text-gray-9">$200</td>
                                                </tr>
                                                <tr>
                                                    <td>22 May 2025</td>
                                                    <td>
                                                        <h6 class="fw-medium"><a href="javascript:void(0);">Stationery
                                                                Purchase</a></h6>
                                                        <span class="fs-13 text-orange">#EX848</span>
                                                    </td>
                                                    <td><span
                                                            class="badge badge-success badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Approved</span>
                                                    </td>
                                                    <td class="text-gray-9">$50</td>
                                                </tr>
                                                <tr>
                                                    <td>21 May 2025</td>
                                                    <td>
                                                        <h6 class="fw-medium"><a href="javascript:void(0);">AC Repair
                                                                Service</a></h6>
                                                        <span class="fs-13 text-orange">#EX847</span>
                                                    </td>
                                                    <td><span
                                                            class="badge badge-cyan badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Pending</span>
                                                    </td>
                                                    <td class="text-gray-9">$800</td>
                                                </tr>
                                                <tr>
                                                    <td>21 May 2025</td>
                                                    <td>
                                                        <h6 class="fw-medium"><a href="javascript:void(0);">Client
                                                                Meeting</a></h6>
                                                        <span class="fs-13 text-orange">#EX846</span>
                                                    </td>
                                                    <td><span
                                                            class="badge badge-success badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Approved</span>
                                                    </td>
                                                    <td class="text-gray-9">$100</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="invoices">
                                    <div class="table-responsive">
                                        <table class="table table-borderless custom-table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Due Date</th>
                                                    <th>Status</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center file-name-icon">
                                                            <a href="javascript:void(0);" class="avatar avatar-md">
                                                                <img srcasset="assets/img/customer/customer16.jpg"
                                                                    class="img-fluid" alt="img">
                                                            </a>
                                                            <div class="ms-2">
                                                                <h6 class="fw-bold"><a href="javascript:void(0);">Andrea
                                                                        Willer</a></h6>
                                                                <span class="fs-13 text-orange">#INV005</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>24 May 2025</td>
                                                    <td><span
                                                            class="badge badge-success badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Paid</span></td>
                                                    <td class="text-gray-9">$1300</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center file-name-icon">
                                                            <a href="javascript:void(0);" class="avatar avatar-md">
                                                                <img srcasset="assets/img/customer/customer17.jpg"
                                                                    class="img-fluid" alt="img">
                                                            </a>
                                                            <div class="ms-2">
                                                                <h6 class="fw-bold"><a href="javascript:void(0);">Timothy
                                                                        Sandsr</a></h6>
                                                                <span class="fs-13 text-orange">#INV004</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>23 May 2025</td>
                                                    <td><span
                                                            class="badge badge-warning badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Overdue</span>
                                                    </td>
                                                    <td class="text-gray-9">$1250</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center file-name-icon">
                                                            <a href="javascript:void(0);" class="avatar avatar-md">
                                                                <img srcasset="assets/img/customer/customer18.jpg"
                                                                    class="img-fluid" alt="img">
                                                            </a>
                                                            <div class="ms-2">
                                                                <h6 class="fw-bold"><a href="javascript:void(0);">Bonnie
                                                                        Rodrigues</a></h6>
                                                                <span class="fs-13 text-orange">#INV003</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>22 May 2025</td>
                                                    <td><span
                                                            class="badge badge-success badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Paid</span></td>
                                                    <td class="text-gray-9">$1700</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center file-name-icon">
                                                            <a href="javascript:void(0);" class="avatar avatar-md">
                                                                <img srcasset="assets/img/customer/customer15.jpg"
                                                                    class="img-fluid" alt="img">
                                                            </a>
                                                            <div class="ms-2">
                                                                <h6 class="fw-bold"><a href="javascript:void(0);">Randy
                                                                        McCree</a></h6>
                                                                <span class="fs-13 text-orange">#INV002</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>21 May 2025</td>
                                                    <td><span
                                                            class="badge badge-danger badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Unpaid</span>
                                                    </td>
                                                    <td class="text-gray-9">$1500</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center file-name-icon">
                                                            <a href="javascript:void(0);" class="avatar avatar-md">
                                                                <img srcasset="assets/img/customer/customer13.jpg"
                                                                    class="img-fluid" alt="img">
                                                            </a>
                                                            <div class="ms-2">
                                                                <h6 class="fw-bold"><a href="javascript:void(0);">Dennis
                                                                        Anderson</a></h6>
                                                                <span class="fs-13 text-orange">#INV001</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>21 May 2025</td>
                                                    <td><span
                                                            class="badge badge-success badge-xs d-inline-flex align-items-center"><i
                                                                class="ti ti-circle-filled fs-5 me-1"></i>Paid</span></td>
                                                    <td class="text-gray-9">$1000</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Recent Transactions -->

            </div>

            <div class="row">

                <!-- Top Customers -->
                <div class="col-xxl-4 col-md-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-inline-flex align-items-center">
                                <span class="title-icon bg-soft-orange fs-16 me-2"><i class="ti ti-users"></i></span>
                                <h5 class="card-title mb-0">Top Customers</h5>
                            </div>
                            <a href="{{ route('customer') }}" class="fs-13 fw-medium text-decoration-underline">View
                                All</a>
                        </div>
                        <div class="card-body">
                            @foreach ($topCustomers->take(5) as $customer)
                                <div
                                    class="d-flex align-items-center justify-content-between border-bottom mb-3 pb-3 flex-wrap gap-2">
                                    <div class="d-flex align-items-center">
                                        @php
                                            $image = $customer->image;
                                            $imageUrl = !empty($image)
                                                ? $image
                                                : asset('assets/img/products/istockphoto.png');
                                        @endphp
                                        <a href="javascript:void(0);" class="avatar avatar-lg flex-shrink-0">
                                            <img src="{{ url($imageUrl) }}" alt="{{ $customer->first_name }}"> </a>

                                        {{-- <img src="{{ asset($firstImage) }}" alt="img"> --}}
                                        </a>
                                        <div class="ms-2">
                                            <h6 class="fs-14 fw-bold mb-1"><a
                                                    href="javascript:void(0);">{{ $customer->first_name }}</a></h6>
                                            <div class="d-flex align-items-center item-list">
                                                <p class="d-inline-flex align-items-center"><i
                                                        class="ti ti-map-pin me-1"></i>{{ $customer->country }}</p>
                                                <p>{{ $customer->orders_count }} Orders</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <h5>Rs.{{ number_format($customer->orders_sum_total, 2) }}</h5>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- /Top Customers -->


                <!-- Top Categories -->
                <div class="col-xxl-4 col-md-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-inline-flex align-items-center">
                                <span class="title-icon bg-soft-orange fs-16 me-2"><i class="ti ti-users"></i></span>
                                <h5 class="card-title mb-0">Top Categories</h5>
                            </div>
                            {{-- <div class="dropdown">
                                <a href="javascript:void(0);"
                                    class="dropdown-toggle btn btn-sm btn-white d-flex align-items-center"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-calendar me-1"></i>Weekly
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li><a href="javascript:void(0);" class="dropdown-item">Today</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item">Weekly</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item">Monthly</a></li>
                                </ul>
                            </div> --}}
                        </div>

                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-4 mb-4">

                                <div id="top-cat" style="height: 250px;">
                                </div>

                                <!-- Top categories summary -->
                                <div>
                                    @foreach ($topCategories->take(5) as $category)
                                        <div
                                            class="category-item category-{{ $loop->iteration == 1 ? 'primary' : ($loop->iteration == 2 ? 'orange' : 'secondary') }}">
                                            <p class="fs-13 mb-1">{{ $category->category }}</p>
                                            <h2 class="d-flex align-items-center">
                                                {{ $category->products_count }}
                                                <span class="fs-13 fw-normal text-default ms-1">Products</span>
                                            </h2>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Category statistics -->
                            <h6 class="mb-2">Category Statistics</h6>
                            <div class="border br-8 p-2">
                                <div class="d-flex align-items-center justify-content-between border-bottom p-2">
                                    <p class="d-inline-flex align-items-center mb-0">
                                        <i class="ti ti-square-rounded-filled text-indigo fs-8 me-2"></i>Total Categories
                                    </p>
                                    <h5>{{ $totalCategories }}</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-between p-2">
                                    <p class="d-inline-flex align-items-center mb-0">
                                        <i class="ti ti-square-rounded-filled text-orange fs-8 me-2"></i>Total Products
                                    </p>
                                    <h5>{{ $totalProducts }}</h5>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const options = {
                                    chart: {
                                        type: 'radialBar',
                                        height: 350
                                    },
                                    series: @json($topCategoryValues), // [10,20,30,...]
                                    labels: @json($topCategoryLabels), // ['Cat A','Cat B',...]
                                    plotOptions: {
                                        radialBar: {
                                            dataLabels: {
                                                name: {
                                                    fontSize: '14px'
                                                },
                                                value: {
                                                    fontSize: '16px',
                                                    formatter: val => val + ' P'
                                                },
                                                total: {
                                                    show: true,
                                                    label: 'Total',
                                                    formatter: w => w.globals.series.reduce((a, b) => a + b, 0)
                                                }
                                            }
                                        }
                                    },
                                    colors: ['#5c6ac4', '#ff9f43', '#45cb85', '#ff6b6b', '#36a2eb'],
                                    tooltip: {
                                        y: {
                                            formatter: val => val + " Products"
                                        }
                                    }
                                };

                                const chart = new ApexCharts(document.querySelector("#top-cat"), options);
                                chart.render();
                            });
                        </script>

                    </div>
                </div>
                <!-- /Top Categories -->


                <!-- Order Statistics -->
                <div class="col-xxl-4 col-md-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-inline-flex align-items-center">
                                <span class="title-icon bg-soft-indigo fs-16 me-2"><i class="ti ti-package"></i></span>
                                <h5 class="card-title mb-0">Order Statistics</h5>
                            </div>
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="btn btn-sm btn-white" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ti ti-calendar me-1"></i>Weekly
                                </a>
                                {{-- <ul class="dropdown-menu p-3">
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">Today</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">Weekly</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">Monthly</a>
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div id="orders_bar_chart"></div>
                            {{-- <pre>{{ json_encode($orderHeatmap, JSON_PRETTY_PRINT) }}</pre> --}}

                        </div>
                    </div>
                </div>
                <!-- /Order Statistics -->
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const heatData = @json($orderHeatmap); // PHP array

                        // Categories: hours (0-2, 2-4, ... 22-24)
                        const categories = Array.from({
                            length: 12
                        }, (_, i) => `${i*2}-${i*2+2}h`);

                        // Series: one for each day
                        const series = Object.keys(heatData).map(day => ({
                            name: day,
                            data: categories.map(cat => {
                                const hourStart = parseInt(cat.split('-')[0]);
                                return heatData[day][hourStart] || 0; // fallback to 0
                            })
                        }));

                        const options = {
                            chart: {
                                type: 'bar',
                                height: 350,
                                stacked: true,
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                }
                            },
                            series: series,
                            xaxis: {
                                categories: categories
                            },
                            colors: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF", "#FF9F40",
                                "#008000"
                            ], // 7 colors for days
                            legend: {
                                position: 'top'
                            },
                            title: {
                                text: 'Orders by Day and Hour'
                            }
                        };

                        const chart = new ApexCharts(document.querySelector("#orders_bar_chart"), options);
                        chart.render();
                    });
                </script>


            </div>

        </div>
    @endsection


    @push('js')
        <!-- ApexChart JS -->
        <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>






        <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>
        <!-- Chart JS -->
        <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/chartjs/chart-data.js') }}"></script>
        <!-- Daterangepikcer JS -->
        <script src="{{ asset('assets/js/moment.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <!-- Select2 JS -->
        <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    @endpush
</x-app-layout>
