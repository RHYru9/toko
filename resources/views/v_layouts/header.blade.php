<header>
    <!-- Top Header -->
    <div id="top-header" class="py-2 bg-light">
        <div class="container d-flex justify-content-start">
            <span class="small">Selamat datang di toko online</span>
        </div>
    </div>
    <!-- /Top Header -->

    <!-- Main Header -->
    <div id="header" class="py-3">
        <div class="container d-flex justify-content-between align-items-center">

            <!-- Logo -->
            <div class="header-logo">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" style="height: 50px;">
                </a>
            </div>
            <!-- /Logo -->

            <!-- Header Buttons -->
            <div class="d-flex align-items-center">

                <!-- Cart -->
                <div class="me-3">
                    <a href="{{ route('keranjang.index') }}" class="text-decoration-none text-dark d-flex align-items-center">
                        <i class="fa fa-shopping-cart fa-lg me-2"></i>
                        <strong class="text-uppercase">Keranjang</strong>
                    </a>
                </div>
                <!-- /Cart -->

                <!-- Account -->
                <div class="dropdown me-3">
                    <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-user fa-lg me-2"></i>
                        <strong class="text-uppercase">
                            @auth
                                {{ auth()->guard('customer')->user()->name }}
                            @else
                                Akun Saya
                            @endauth
                        </strong>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                        @auth
                            <li><a class="dropdown-item" href="{{ route('account.edit') }}"><i class="fa fa-user-o me-2"></i> Akun Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('history.index') }}"><i class="fa fa-check me-2"></i> History</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('customer.logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out me-2"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('customer.login') }}"><i class="fa fa-unlock-alt me-2"></i> Masuk</a></li>
                            <li><a class="dropdown-item" href="{{ route('auth.google') }}"><i class="fab fa-google me-2"></i> Masuk dengan Google</a></li>
                            <li><a class="dropdown-item" href="{{ route('auth.google') }}"><i class="fa fa-user-plus me-2"></i> Buat Akun</a></li>
                        @endauth
                    </ul>
                </div>
                <!-- /Account -->

                <!-- Mobile Nav Toggle -->
                <button class="btn btn-primary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- /Mobile Nav Toggle -->

            </div>
            <!-- /Header Buttons -->

        </div>
    </div>
    <!-- /Main Header -->

    <!-- Mobile Menu (Offcanvas) -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header">
            <h5 id="mobileMenuLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled">
                <li><a href="{{ route('keranjang.index') }}" class="nav-link">Keranjang</a></li>
                @auth
                    <li><a href="{{ route('account.edit') }}" class="nav-link">Akun Saya</a></li>
                    <li><a href="{{ route('history.index') }}" class="nav-link">History</a></li>
                    <li>
                        <a href="{{ route('customer.logout') }}" class="nav-link"
                           onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                            Logout
                        </a>
                        <form id="logout-form-mobile" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('customer.login') }}" class="nav-link">Masuk</a></li>
                    <li><a href="{{ route('auth.google') }}" class="nav-link">Masuk dengan Google</a></li>
                    <li><a href="{{ route('auth.google') }}" class="nav-link">Buat Akun</a></li>
                @endauth
            </ul>
        </div>
    </div>
    <!-- /Mobile Menu -->
</header>
