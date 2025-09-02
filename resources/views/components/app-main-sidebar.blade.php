<!-- Sidebar -->

<div class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo">
        <a href="{{ route('dashboard.index') }}" class="logo logo-normal">
            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Img">
        </a>
        <a href="{{ route('dashboard.index') }}" class="logo logo-white">
            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Img">
        </a>
        <a href="{{ route('dashboard.index') }}" class="logo-small">
            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Img">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
            <i data-feather="chevrons-left" class="feather-16"></i>
        </a>
    </div>
    <!-- /Logo -->
    <div class="modern-profile p-3 pb-0">
        <div class="text-center rounded bg-light p-3 mb-4 user-profile">
            <div class="avatar avatar-lg online mb-3">
                <img src="assets/img/customer/customer15.jpg" alt="Img" class="img-fluid rounded-circle">
            </div>
            <h6 class="fs-14 fw-bold mb-1">Adrian Herman</h6>
            <p class="fs-12 mb-0">System Admin</p>
        </div>
        <div class="sidebar-nav mb-3">
            <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified bg-transparent" role="tablist">
                <li class="nav-item"><a class="nav-link active border-0" href="#">Menu</a></li>
                <li class="nav-item"><a class="nav-link border-0" href="chat.html">Chats</a></li>
                <li class="nav-item"><a class="nav-link border-0" href="email.html">Inbox</a></li>
            </ul>
        </div>
    </div>
    <div class="sidebar-header p-3 pb-0 pt-2">
        <div class="text-center rounded bg-light p-2 mb-4 sidebar-profile d-flex align-items-center">
            <div class="avatar avatar-md onlin">
                <img src="assets/img/customer/customer15.jpg" alt="Img" class="img-fluid rounded-circle">
            </div>
            <div class="text-start sidebar-profile-info ms-2">
                <h6 class="fs-14 fw-bold mb-1">Adrian Herman</h6>
                <p class="fs-12">System Admin</p>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between menu-item mb-3">
            <div>
                <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-icon bg-light">
                    <i class="ti ti-layout-grid-remove"></i>
                </a>
            </div>
            <div>
                <a href="chat.html" class="btn btn-sm btn-icon bg-light">
                    <i class="ti ti-brand-hipchat"></i>
                </a>
            </div>
            <div>
                <a href="email.html" class="btn btn-sm btn-icon bg-light position-relative">
                    <i class="ti ti-message"></i>
                </a>
            </div>
            <div class="notification-item">
                <a href="activities.html" class="btn btn-sm btn-icon bg-light position-relative">
                    <i class="ti ti-bell"></i>
                    <span class="notification-status-dot"></span>
                </a>
            </div>
            <div class="me-0">
                <a href="general-settings.html" class="btn btn-sm btn-icon bg-light">
                    <i class="ti ti-settings"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">

            <ul>
                @can('Dashboard')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Main</h6>
                        <ul>
                            <li><a href="{{ route('dashboard.index') }}"><i
                                        class="ti ti-layout-grid fs-16 me-2"></i><span>Dashboard</span></a></li>
                        </ul>
                    </li>
                @endcan

                @can('Inventory List')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Inventory</h6>
                        <ul>
                            <li><a href="{{ route('product.index') }}"><i data-feather="box"></i><span>Products</span></a>
                            </li>
                            <li><a href="{{ route('product.create') }}"><i
                                        class="ti ti-table-plus fs-16 me-2"></i><span>Create Product</span></a></li>
                            <li><a href="{{ route('expired.products') }}"><i
                                        class="ti ti-progress-alert fs-16 me-2"></i><span>Expired Products</span></a>
                            </li>
                            <li><a href="{{ route('low-stock.product') }}"><i
                                        class="ti ti-trending-up-2 fs-16 me-2"></i><span>Low Stocks</span></a></li>
                            <li><a href="{{ route('categories.index') }}"><i
                                        class="ti ti-list-details fs-16 me-2"></i><span>Category</span></a></li>
                            <li><a href="{{ route('sub-categories.index') }}"><i
                                        class="ti ti-carousel-vertical fs-16 me-2"></i><span>Sub Category</span></a>
                            </li>
                            <li><a href="{{ route('brands.index') }}"><i
                                        class="ti ti-triangles fs-16 me-2"></i><span>Brands</span></a></li>
                            <li><a href="{{ route('units.index') }}"><i
                                        class="ti ti-brand-unity fs-16 me-2"></i><span>Units</span></a></li>
                            <li><a href="{{ route('variants.index') }}"><i
                                        class="ti ti-checklist fs-16 me-2"></i><span>Variant Attributes</span></a></li>
                            <li><a href="{{ route('warranty.index') }}"><i
                                        class="ti ti-certificate fs-16 me-2"></i><span>Warranties</span></a></li>
                            <li><a href="{{ route('barcode.index') }}"><i class="ti ti-barcode fs-16 me-2"></i><span>Print
                                        Barcode</span></a></li>
                            {{-- <li><a href="qrcode.html"><i class="ti ti-qrcode fs-16 me-2"></i><span>Print QR Code</span></a></li> --}}
                        </ul>
                    </li>
                @endcan

                @can('Stock List')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Stock</h6>
                        <ul>
                            <li><a href="{{ route('manage_stock') }}"><i
                                        class="ti ti-stack-3 fs-16 me-2"></i><span>Manage
                                        Stock</span></a></li>
                            <li><a href="{{ route('stock.adjustment') }}"><i
                                        class="ti ti-stairs-up fs-16 me-2"></i><span>Stock Adjustment</span></a></li>
                            <li><a href="{{ route('stock.transfer') }}"><i
                                        class="ti ti-stack-pop fs-16 me-2"></i><span>Stock
                                        Transfer</span></a></li>
                        </ul>
                    </li>
                @endcan

                @can('Sales List')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Sales</h6>
                        <ul>
                            <li><a href="{{ route('sales') }}"><i
                                        class="ti ti-file-invoice fs-16 me-2"></i><span>Sales</span></a></li>
                            <li><a href="{{ route('pos') }}"><i
                                        class="ti ti-device-laptop fs-16 me-2"></i><span>POS</span></a></li>

                            <li><a href="{{ route('invoice.index') }}"><i
                                        class="ti ti-file-invoice fs-16 me-2"></i><span>Invoices</span></a>
                            </li>
                            <li><a href="{{ route('quotation.index') }}"><i
                                        class="ti ti-files fs-16 me-2"></i><span>Quotation</span></a>
                            </li>
                            <li><a href="{{ route('customer-due.index') }}"><i
                                        class="ti ti-user-star fs-16 me-2"></i><span>Customer
                                        Due</span></a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('Promo List')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Promo</h6>
                        <ul>
                            <li><a href="coupons.html"><i class="ti ti-ticket fs-16 me-2"></i><span>Coupons</span></a>
                            </li>
                            <li><a href="gift-cards.html"><i class="ti ti-cards fs-16 me-2"></i><span>Gift
                                        Cards</span></a></li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i
                                        class="ti ti-file-percent fs-16 me-2"></i><span>Discount</span><span
                                        class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="discount-plan.html">Discount Plan</a></li>
                                    <li><a href="discount.html">Discount</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('Purchases List')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Purchases</h6>
                        <ul>
                            <li><a href="{{ route('purchase') }}"><i
                                        class="ti ti-shopping-bag fs-16 me-2"></i><span>Purchases</span></a></li>
                            <li><a href="{{ route('purchase.order') }}"><i
                                        class="ti ti-file-unknown fs-16 me-2"></i><span>Purchase Order</span></a></li>
                            <li><a href="{{ route('purchase.return') }}"><i
                                        class="ti ti-file-upload fs-16 me-2"></i><span>Purchase Return</span></a></li>
                        </ul>
                    </li>
                @endcan

                @can('Finance_Accounts List')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Finance & Accounts</h6>
                        <ul>
                            <li><a href="{{ route('expenses.index') }}">
                                    <i class="ti ti-file-stack fs-16 me-2"></i>
                                    <span>Expenses</span></a></li>

                            <li><a href="{{ route('incomes.index') }}">
                                    <i class="ti ti-file-pencil fs-16 me-2"></i>
                                    <span>Income</span></a></li>



                            <li><a href="account-list.html"><i class="ti ti-building-bank fs-16 me-2"></i><span>Bank
                                        Accounts</span></a></li>
                            <li><a href="money-transfer.html"><i class="ti ti-moneybag fs-16 me-2"></i><span>Money
                                        Transfer</span></a></li>
                            <li><a href="balance-sheet.html"><i class="ti ti-report-money fs-16 me-2"></i><span>Balance
                                        Sheet</span></a></li>
                            <li><a href="trial-balance.html"><i class="ti ti-alert-circle fs-16 me-2"></i><span>Trial
                                        Balance</span></a></li>
                            <li><a href="cash-flow.html"><i class="ti ti-zoom-money fs-16 me-2"></i><span>Cash
                                        Flow</span></a></li>
                            <li><a href="account-statement.html"><i
                                        class="ti ti-file-infinity fs-16 me-2"></i><span>Account
                                        Statement</span></a>
                            </li>

                        </ul>
                    </li>
                @endcan

                @can('Peoples List')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Peoples</h6>
                        <ul>
                            <li><a href="{{ route('customer') }}"><i
                                        class="ti ti-users-group fs-16 me-2"></i><span>Customers</span></a></li>
                            {{-- <li><a href="{{url('billers-view')}}"><i class="ti ti-user-up fs-16 me-2"></i><span>Billers</span></a></li> --}}
                            <li><a href="{{ route('suppliers') }}"><i
                                        class="ti ti-user-dollar fs-16 me-2"></i><span>Suppliers</span></a></li>
                            {{-- <li><a href="store-list.html"><i class="ti ti-home-bolt fs-16 me-2"></i><span>Stores</span></a></li> --}}
                            <li><a href="{{ route('location') }}"><i
                                        class="ti ti-archive fs-16 me-2"></i><span>Location</span></a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('HRM List')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">HRM</h6>
                        <ul>
                            <li><a href="{{ route('employee.list') }}"><i
                                        class="ti ti-user fs-16 me-2"></i><span>Employees</span></a></li>
                            <li><a href="department-grid.html"><i
                                        class="ti ti-compass fs-16 me-2"></i><span>Departments</span></a></li>
                            <li><a href="designation.html"><i
                                        class="ti ti-git-merge fs-16 me-2"></i><span>Designation</span></a></li>
                            <li><a href="shift.html"><i
                                        class="ti ti-arrows-shuffle fs-16 me-2"></i><span>Shifts</span></a>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i
                                        class="ti ti-user-cog fs-16 me-2"></i><span>Attendence</span><span
                                        class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="attendance-employee.html">Employee</a></li>
                                    <li><a href="attendance-admin.html">Admin</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i
                                        class="ti ti-calendar fs-16 me-2"></i><span>Leaves</span><span
                                        class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="leaves-admin.html">Admin Leaves</a></li>
                                    <li><a href="leaves-employee.html">Employee Leaves</a></li>
                                    <li><a href="leave-types.html">Leave Types</a></li>
                                </ul>
                            </li>
                            <li><a href="holidays.html"><i
                                        class="ti ti-calendar-share fs-16 me-2"></i><span>Holidays</span></a>
                            </li>
                            <li class="submenu">
                                <a href="employee-salary.html"><i
                                        class="ti ti-file-dollar fs-16 me-2"></i><span>Payroll</span><span
                                        class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="employee-salary.html">Employee Salary</a></li>
                                    <li><a href="payslip.html">Payslip</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('Reports List')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Reports</h6>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i class="ti ti-chart-bar fs-16 me-2"></i><span>Sales
                                        Report</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="{{ route('salesReport.index') }}">Sales Report</a></li>
                                    <li><a href="best-seller.html">Best Seller</a></li>
                                </ul>
                            </li>
                            <li><a href="purchase-report.html"><i class="ti ti-chart-pie-2 fs-16 me-2"></i><span>Purchase
                                        report</span></a></li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i
                                        class="ti ti-triangle-inverted fs-16 me-2"></i><span>Inventory
                                        Report</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="inventory-report.html">Inventory Report</a></li>
                                    <li><a href="stock-history.html">Stock History</a></li>
                                    <li><a href="sold-stock.html">Sold Stock</a></li>
                                </ul>
                            </li>
                            <li><a href="invoice-report.html"><i class="ti ti-businessplan fs-16 me-2"></i><span>Invoice
                                        Report</span></a></li>
                            <li>
                                <a href="{{ route('supplierReport.index') }}"><i class="ti ti-user-star fs-16 me-2"></i><span>Supplier
                                        Report</span>
                                        {{-- <span class="menu-arrow"></span> --}}
                                    </a>
                                {{-- <ul>
                                    <li><a href="{{ route('supplierReport.index') }}">Supplier Report</a></li>
                                    <li><a href="{{ route('supplierReport.due') }}">Supplier Due Report</a></li>
                                </ul> --}}
                            </li>
                            <li>
                                <a href="{{ route('customerReport.index') }}"><i class="ti ti-report fs-16 me-2"></i><span>Customer
                                        Report</span>
                                        </a>
                                {{-- <ul>
                                    <li><a href="{{ route('customerReport.index') }}">Customer Report</a></li>
                                    <li><a href="customer-due-report.html">Customer Due Report</a></li>
                                </ul> --}}
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i
                                        class="ti ti-report-analytics fs-16 me-2"></i><span>Product
                                        Report</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="product-report.html">Product Report</a></li>
                                    <li><a href="product-expiry-report.html">Product Expiry Report</a></li>
                                    <li><a href="product-quantity-alert.html">Product Quantity Alert</a></li>
                                </ul>
                            </li>
                            <li><a href="expense-report.html"><i class="ti ti-file-vector fs-16 me-2"></i><span>Expense
                                        Report</span></a></li>
                            <li><a href="income-report.html"><i class="ti ti-chart-ppf fs-16 me-2"></i><span>Income
                                        Report</span></a></li>
                            <li><a href="tax-reports.html"><i class="ti ti-chart-dots-2 fs-16 me-2"></i><span>Tax
                                        Report</span></a></li>
                            <li><a href="profit-and-loss.html"><i class="ti ti-chart-donut fs-16 me-2"></i><span>Profit &
                                        Loss</span></a></li>
                            <li><a href="annual-report.html"><i class="ti ti-report-search fs-16 me-2"></i><span>Annual
                                        Report</span></a></li>
                        </ul>
                    </li>
                @endcan

                @can('CMS List')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Content (CMS)</h6>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i
                                        class="ti ti-page-break fs-16 me-2"></i><span>Pages</span><span
                                        class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="pages.html">Pages</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i
                                        class="ti ti-wallpaper fs-16 me-2"></i><span>Blog</span><span
                                        class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="all-blog.html">All Blog</a></li>
                                    <li><a href="blog-tag.html">Blog Tags</a></li>
                                    <li><a href="blog-categories.html">Categories</a></li>
                                    <li><a href="blog-comments.html">Blog Comments</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i
                                        class="ti ti-map-pin fs-16 me-2"></i><span>Location</span><span
                                        class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="countries.html">Countries</a></li>
                                    <li><a href="states.html">States</a></li>
                                    <li><a href="cities.html">Cities</a></li>
                                </ul>
                            </li>
                            <li><a href="testimonials.html"><i
                                        class="ti ti-star fs-16 me-2"></i><span>Testimonials</span></a>
                            </li>
                            <li><a href="faq.html"><i class="ti ti-help-circle fs-16 me-2"></i><span>FAQ</span></a>
                            </li>

                        </ul>
                    </li>
                @endcan

                @can('User Management List')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">User Management</h6>
                        <ul>
                            <li><a href="{{ route('users.index') }}"><i
                                        class="ti ti-shield-up fs-16 me-2"></i><span>Users</span></a></li>
                            <li><a href="{{ route('roles.index') }}"><i
                                        class="ti ti-jump-rope fs-16 me-2"></i><span>Roles &
                                        Permissions</span></a>
                            </li>
                            <li><a href="delete-account.html"><i class="ti ti-trash-x fs-16 me-2"></i><span>Delete
                                        Account
                                        Request</span></a></li>
                        </ul>
                    </li>
                @endcan

                @can('Pages List')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Pages</h6>
                        <ul>
                            <li><a href="profile.html"><i
                                        class="ti ti-user-circle fs-16 me-2"></i><span>Profile</span></a>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i
                                        class="ti ti-shield fs-16 me-2"></i><span>Authentication</span><span
                                        class="menu-arrow"></span></a>
                                <ul>
                                    <li class="submenu submenu-two"><a href="javascript:void(0);">Login<span
                                                class="menu-arrow inside-submenu"></span></a>
                                        <ul>
                                            <li><a href="signin.html">Cover</a></li>
                                            <li><a href="signin-2.html">Illustration</a></li>
                                            <li><a href="signin-3.html">Basic</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu submenu-two"><a href="javascript:void(0);">Register<span
                                                class="menu-arrow inside-submenu"></span></a>
                                        <ul>
                                            <li><a href="register.html">Cover</a></li>
                                            <li><a href="register-2.html">Illustration</a></li>
                                            <li><a href="register-3.html">Basic</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu submenu-two"><a href="javascript:void(0);">Forgot Password<span
                                                class="menu-arrow inside-submenu"></span></a>
                                        <ul>
                                            <li><a href="forgot-password.html">Cover</a></li>
                                            <li><a href="forgot-password-2.html">Illustration</a></li>
                                            <li><a href="forgot-password-3.html">Basic</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu submenu-two"><a href="javascript:void(0);">Reset Password<span
                                                class="menu-arrow inside-submenu"></span></a>
                                        <ul>
                                            <li><a href="reset-password.html">Cover</a></li>
                                            <li><a href="reset-password-2.html">Illustration</a></li>
                                            <li><a href="reset-password-3.html">Basic</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu submenu-two"><a href="javascript:void(0);">Email
                                            Verification<span class="menu-arrow inside-submenu"></span></a>
                                        <ul>
                                            <li><a href="email-verification.html">Cover</a></li>
                                            <li><a href="email-verification-2.html">Illustration</a></li>
                                            <li><a href="email-verification-3.html">Basic</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu submenu-two"><a href="javascript:void(0);">2 Step
                                            Verification<span class="menu-arrow inside-submenu"></span></a>
                                        <ul>
                                            <li><a href="two-step-verification.html">Cover</a></li>
                                            <li><a href="two-step-verification-2.html">Illustration</a></li>
                                            <li><a href="two-step-verification-3.html">Basic</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="lock-screen.html">Lock Screen</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i class="ti ti-file-x fs-16 me-2"></i><span>Error
                                        Pages</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="error-404.html">404 Error </a></li>
                                    <li><a href="error-500.html">500 Error </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="blank-page.html"><i class="ti ti-file fs-16 me-2"></i><span>Blank Page</span>
                                </a>
                            </li>
                            <li>
                                <a href="pricing.html"><i
                                        class="ti ti-currency-dollar fs-16 me-2"></i><span>Pricing</span>
                                </a>
                            </li>
                            <li>
                                <a href="coming-soon.html"><i class="ti ti-send fs-16 me-2"></i><span>Coming
                                        Soon</span>
                                </a>
                            </li>
                            <li>
                                <a href="under-maintenance.html"><i
                                        class="ti ti-alert-triangle fs-16 me-2"></i><span>Under
                                        Maintenance</span> </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('Settings List')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Settings</h6>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i class="ti ti-settings fs-16 me-2"></i><span>General
                                        Settings</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="general-settings.html">Profile</a></li>
                                    <li><a href="security-settings.html">Security</a></li>
                                    <li><a href="notification.html">Notifications</a></li>
                                    <li><a href="connected-apps.html">Connected Apps</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i class="ti ti-world fs-16 me-2"></i><span>Website
                                        Settings</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="system-settings.html">System Settings</a></li>
                                    <li><a href="company-settings.html">Company Settings </a></li>
                                    <li><a href="localization-settings.html">Localization</a></li>
                                    <li><a href="prefixes.html">Prefixes</a></li>
                                    <li><a href="preference.html">Preference</a></li>
                                    <li><a href="appearance.html">Appearance</a></li>
                                    <li><a href="social-authentication.html">Social Authentication</a></li>
                                    <li><a href="language-settings.html">Language</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i class="ti ti-device-mobile fs-16 me-2"></i>
                                    <span>App Settings</span><span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li class="submenu submenu-two"><a href="javascript:void(0);">Invoice<span
                                                class="menu-arrow inside-submenu"></span></a>
                                        <ul>
                                            <li><a href="invoice-settings.html">Invoice Settings</a></li>
                                            <li><a href="invoice-template.html">Invoice Template</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="printer-settings.html">Printer</a></li>
                                    <li><a href="pos-settings.html">POS</a></li>
                                    <li><a href="custom-fields.html">Custom Fields</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i class="ti ti-device-desktop fs-16 me-2"></i>
                                    <span>System Settings</span><span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li class="submenu submenu-two"><a href="javascript:void(0);">Email<span
                                                class="menu-arrow inside-submenu"></span></a>
                                        <ul>
                                            <li><a href="email-settings.html">Email Settings</a></li>
                                            <li><a href="email-template.html">Email Template</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu submenu-two"><a href="javascript:void(0);">SMS<span
                                                class="menu-arrow inside-submenu"></span></a>
                                        <ul>
                                            <li><a href="sms-settings.html">SMS Settings</a></li>
                                            <li><a href="sms-template.html">SMS Template</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="otp-settings.html">OTP</a></li>
                                    <li><a href="gdpr-settings.html">GDPR Cookies</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i class="ti ti-settings-dollar fs-16 me-2"></i>
                                    <span>Financial Settings</span><span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="payment-gateway-settings.html">Payment Gateway</a></li>
                                    <li><a href="bank-settings-grid.html">Bank Accounts</a></li>
                                    <li><a href="tax-rates.html">Tax Rates</a></li>
                                    <li><a href="currency-settings.html">Currencies</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i class="ti ti-settings-2 fs-16 me-2"></i>
                                    <span>Other Settings</span><span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="storage-settings.html">Storage</a></li>
                                    <li><a href="ban-ip-address.html">Ban IP Address</a></li>
                                </ul>
                            </li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ti ti-logout fs-16 me-2"></i><span>Logout</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan

            </ul>

        </div>
    </div>
</div>
