<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#ffffff">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/icon_univ_bsi.png') }}">
    <title>{{ $title ?? 'TokoOnline' }}</title>

    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Hind:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <style>
        /* Style untuk memastikan sidebar di sebelah kanan banner */
        #home {
            margin-bottom: 30px;
        }

        .section {
            margin-top: 30px;
        }

        .container {
            max-width: 1140px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        #main {
            flex: 1;
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Sidebar */
        #sidebar {
            flex: 0 0 250px;
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Responsive untuk tampilan kecil */
        @media (max-width: 768px) {
            #sidebar {
                flex: 0 0 100%;
                margin-top: 30px;
            }

            #main {
                flex: 0 0 100%;
            }
        }

        #main {
            padding-left: 0;
            padding-right: 0;
        }

        .product-details {
            margin-left: 0;
            margin-right: 0;
        }

        .d-none {
            display: none !important;
        }

        #navigation {
            margin-top: -10px;
        }

        .menu-nav {
            margin-left: auto;
        }

        .category-nav {
            margin-right: auto;
        }

        @media (max-width: 768px) {
            .menu-nav, .category-nav {
                margin: 0;
            }
            .menu-list {
                flex-direction: column;
                align-items: start;
            }
            .menu-list li {
                margin-bottom: 10px;
            }
            #kategoriList {
                padding-left: 0;
            }
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .banner-caption h1, .banner-caption h3, .banner-caption button {
            word-break: break-word;
        }

        .top-rated-products {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-left: 10px;
        }

        .top-rated-products .product {
            margin-right: 20px;
        }

        .top-rated-products .product h4 {
            white-space: normal;
            word-wrap: break-word;
        }
    </style>
</head>

<body>

    @php
        $kategori = DB::table('kategori')->orderBy('nama_kategori', 'asc')->get();
    @endphp

    <!-- HEADER -->
    @include('v_layouts.header')
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <div id="navigation">
        <div class="container">
            <div id="responsive-nav" class="d-flex align-items-start flex-wrap">
                <div class="category-nav me-4">
                    <span class="category-header" id="toggleKategori">Kategori <i class="fas fa-list"></i></span>
                    <ul class="category-list {{ request()->segment(1) == '' || request()->segment(1) == 'beranda' ? '' : 'd-none' }}" id="kategoriList">
                        @foreach ($kategori as $row)
                            <li><a href="{{ route('produk.kategori', $row->id) }}">{{ $row->nama_kategori }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="menu-nav">
                    <ul class="menu-list d-flex list-unstyled mb-0">
                        <li><a href="{{ route('beranda') }}"><i class="fas fa-home"></i> Beranda</a></li>
                        <li><a href="{{ route('produk.all') }}"><i class="fas fa-box-open"></i> Produk</a></li>
                        <li><a href="{{ route('tentang-kami') }}"><i class="fas fa-info-circle"></i> Tentang Kami</a></li>
                        <li><a href="{{ route('kontak') }}"><i class="fas fa-envelope"></i> Kontak</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /NAVIGATION -->

    <!-- BANNER -->
    @if (request()->segment(1) == '' || request()->segment(1) == 'beranda')
    <div id="home">
        <div class="container">
            <div class="home-wrap">
                <div id="home-slick" class="slick-slider">
                    <div class="banner banner-1">
                        <img src="{{ asset('frontend/banner/banner_1.jpg') }}" alt="Banner 1">
                        <div class="banner-caption text-center">
                            <h1>Jajanan Tradisional</h1>
                            <h3 class="font-weak" style="color: #30323a;">Khas Makanan Indonesia</h3>
                            <button class="primary-btn"><i class="fas fa-shopping-cart"></i> Pesan Sekarang</button>
                        </div>
                    </div>
                    <div class="banner banner-1">
                        <img src="{{ asset('frontend/banner/banner_2.jpg') }}" alt="Banner 2">
                        <div class="banner-caption">
                            <h1 class="primary-color">Cita Rasa Nusantara</h1>
                            <button class="primary-btn"><i class="fas fa-utensils"></i> Lihat Menu</button>
                        </div>
                    </div>
                    <div class="banner banner-1">
                        <img src="{{ asset('frontend/banner/banner_3.jpg') }}" alt="Banner 3">
                        <div class="banner-caption">
                            <h1 style="color: #f8694a;">Makanan Indonesia</h1>
                            <button class="primary-btn"><i class="fas fa-arrow-right"></i> Coba Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- /BANNER -->

    <!-- CONTENT -->
    <div class="section">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                @include('v_layouts.sidebar')
                <!-- /Sidebar -->

                <!-- Main content -->
                <div id="main" class="col-md-9">
                    @yield('content')
                </div>
                <!-- /Main content -->
            </div>
        </div>
    </div>
    <!-- /CONTENT -->

    <!-- FOOTER -->
    <footer id="footer" class="section section-grey mt-4">
        <div class="container">
            <div class="row text-center">
                <p class="mb-0">&copy; {{ date('Y') }} TokoOnline. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- /FOOTER -->

    <!-- JS Plugins -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <!-- Script toggle kategori -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggle = document.getElementById("toggleKategori");
            const list = document.getElementById("kategoriList");

            if (toggle && list) {
                toggle.addEventListener("click", function () {
                    list.classList.toggle("d-none");
                });
            }
        });
    </script>
</body>
</html>
