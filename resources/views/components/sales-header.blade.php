 <div class="header pos-header">

            <!-- Logo -->
            <div class="header-left active">
                <a href="{{ route('dashboard.index') }}" class="logo logo-normal">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Img">
                </a>
                <a href="{{ route('dashboard.index') }}" class="logo logo-white">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Img">
                </a>
                <a href="{{ route('dashboard.index') }}" class="logo-small">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Img">
                </a>
            </div>
            <!-- /Logo -->

            <a id="mobile_btn" class="mobile_btn d-none" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <!-- Header Menu -->
            <ul class="nav user-menu">
                <!-- Search -->
                <li class="nav-item time-nav">
                    <span class="bg-teal text-white d-inline-flex align-items-center"><img
                            src="assets/img/icons/clock-icon.svg" alt="img" class="me-2"><span id="clock">--:--:--</span></span>
                </li>
                <!-- /Search -->
                <li class="nav-item pos-nav">
                    <a href="{{ route('dashboard.index') }}" class="btn btn-purple btn-md d-inline-flex align-items-center">
                        <i class="ti ti-world me-1"></i>Dashboard
                    </a>
                </li>
                <!-- Select Store -->

                <!-- /Select Store -->
                <li class="nav-item nav-item-box">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#calculator"
                        class="bg-orange border-orange text-white"><i class="ti ti-calculator"></i></a>
                </li>
                <li class="nav-item nav-item-box">
                    <a href="javascript:void(0);" id="btnFullscreen" data-bs-toggle="tooltip"
                        data-bs-placement="top" data-bs-title="Maximize">
                        <i class="ti ti-maximize"></i>
                    </a>
                </li>
                {{-- <li class="nav-item nav-item-box" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-title="Cash Register">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#cash-register"><i
                            class="ti ti-cash"></i></a>
                </li>
                <li class="nav-item nav-item-box" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-title="Print Last Reciept">
                    <a href="#"><i class="ti ti-printer"></i></a>
                </li>
                <li class="nav-item nav-item-box" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-title="Today’s Sale">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#today-sale"><i
                            class="ti ti-progress"></i></a>
                </li>
                <li class="nav-item nav-item-box" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-title="Today’s Profit">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#today-profit"><i
                            class="ti ti-chart-infographic"></i></a>
                </li>
                <li class="nav-item nav-item-box" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-title="Sales Settings">
                    <a href="pos-settings.html"><i class="ti ti-settings"></i></a>
                </li> --}}
                <li class="nav-item dropdown has-arrow main-drop profile-nav">
                    <a href="javascript:void(0);" class="nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-info p-0">
                            <span class="user-letter">
                                <img src="assets/img/profiles/avator1.jpg" alt="Img" class="img-fluid">
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img src="assets/img/profiles/avator1.jpg" alt="Img">
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>John Smilga</h6>
                                    <h5>Super Admin</h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="profile.html"><i class="me-2"
                                    data-feather="user"></i>My
                                Profile</a>
                            <a class="dropdown-item" href="general-settings.html"><i class="me-2"
                                    data-feather="settings"></i>Settings</a>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="signin.html"><img
                                    src="assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->

            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="general-settings.html">Settings</a>
                    <a class="dropdown-item" href="signin.html">Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->
        </div>
