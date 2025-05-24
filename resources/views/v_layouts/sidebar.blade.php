<div id="aside" class="col-md-3 custom-sidebar">
    <!-- CATEGORIES -->
    <div class="custom-sidebar-widget">
        <span class="category-header" id="toggleKategori">KATEGORI <i class=""></i></span>
        <ul class="category-list custom-brand-list {{ request()->segment(1) == '' || request()->segment(1) == 'beranda' ? '' : 'd-none' }}" id="kategoriList">
            @foreach ($kategori as $row)
                <li><a href="{{ route('produk.kategori', $row->id) }}">{{ $row->nama_kategori }}</a></li>
            @endforeach
        </ul>
    </div>

    <!-- TOP PRODUCTS - MANUAL -->
    <div class="custom-sidebar-widget">
        <h3 class="custom-widget-title">PRODUK TERLARIS</h3>

        <!-- Product 1 -->
        <div class="custom-product-widget">
            <div class="custom-product-thumb">
                <img src="{{ asset('storage/img-produk/thumb_lg_20250502073429_681413155e9cc.png') }}" alt="Mochi Singkong Kacang">
            </div>
            <div class="custom-product-details">
                <a href="#" class="custom-product-name">Mochi Hanabira</a>
                <div class="custom-product-price">Rp. 45.000</div>
                <div class="custom-product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </div>
            </div>
        </div>

        <!-- Product 2 -->
        <div class="custom-product-widget">
            <div class="custom-product-thumb">
                <img src="{{ asset('storage/img-produk/thumb_lg_20250502074208_681414e0bccf1.jpg') }}" alt="Brownies Crispy">
            </div>
            <div class="custom-product-details">
                <a href="#" class="custom-product-name">Wingko Babat</a>
                <div class="custom-product-price">Rp. 25.000</div>
                <div class="custom-product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                </div>
            </div>
        </div>

        <!-- Product 3 -->
        <div class="custom-product-widget">
            <div class="custom-product-thumb">
                <img src="{{ asset('storage/img-produk/thumb_lg_20250502073715_681413bbb1eea.png') }}" alt="Mochi Singkong Cokelat">
            </div>
            <div class="custom-product-details">
                <a href="#" class="custom-product-name">Mochi YummY!!</a>
                <div class="custom-product-price">Rp. 80.000</div>
                <div class="custom-product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
            </div>
        </div>

        <!-- Product 4 -->
        <div class="custom-product-widget">
            <div class="custom-product-thumb">
                <img src="{{ asset('storage/img-produk/thumb_lg_20250502071330_68140e2aa1ab0.jpg') }}" alt="Wingko Singkong Keju Cokelat">
            </div>
            <div class="custom-product-details">
                <a href="#" class="custom-product-name">Dawet Alam surga</a>
                <div class="custom-product-price">Rp. 10.000</div>
                <div class="custom-product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Sidebar - Won't affect other elements */
    .custom-sidebar {
        padding-left: 10px;
        padding-right: 15px;
    }

    .custom-sidebar-widget {
        margin-bottom: 25px;
        background: #ffffff;
        padding: 15px;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }

    .custom-widget-title {
        font-size: 15px;
        font-weight: 700;
        text-transform: uppercase;
        color: #333333;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 1px solid #eeeeee;
        letter-spacing: 0.5px;
    }

    .category-header {
        font-size: 15px;
        font-weight: 700;
        text-transform: uppercase;
        color: #333333;
        cursor: pointer;
        display: block;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 1px solid #eeeeee;
        letter-spacing: 0.5px;
    }

    .category-header i {
        margin-left: 5px;
    }

    .custom-product-widget {
        display: flex;
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f5f5f5;
    }

    .custom-product-widget:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .custom-product-thumb {
        width: 50px;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .custom-product-thumb img {
        width: 100%;
        height: auto;
        border-radius: 3px;
    }

    .custom-product-details {
        flex-grow: 1;
    }

    .custom-product-name {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 3px;
        line-height: 1.3;
    }

    .custom-product-name:hover {
        color: #e53935;
        text-decoration: none;
    }

    .custom-product-price {
        font-size: 13px;
        font-weight: 700;
        color: #e53935;
        margin-bottom: 3px;
    }

    .custom-old-price {
        font-size: 11px;
        color: #999999;
        text-decoration: line-through;
        margin-left: 5px;
    }

    .custom-product-rating {
        color: #FFC107;
        font-size: 11px;
        letter-spacing: 1px;
    }

    .custom-product-rating .fa-star-o {
        color: #dddddd;
    }

    .custom-brand-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .custom-brand-list li {
        margin-bottom: 7px;
    }

    .custom-brand-list li:last-child {
        margin-bottom: 0;
    }

    .custom-brand-list a {
        display: block;
        font-size: 12px;
        color: #555555;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 5px 0;
        transition: all 0.2s;
    }

    .custom-brand-list a:hover {
        color: #e53935;
        padding-left: 3px;
        text-decoration: none;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .custom-sidebar {
            padding-left: 15px;
            padding-right: 15px;
        }

        .custom-product-widget {
            flex-direction: column;
        }

        .custom-product-thumb {
            width: 100%;
            margin-right: 0;
            margin-bottom: 10px;
        }
    }
</style>

<script>
    // Toggle kategori list on mobile
    document.getElementById('toggleKategori').addEventListener('click', function() {
        if (window.innerWidth <= 768) {
            const kategoriList = document.getElementById('kategoriList');
            kategoriList.classList.toggle('d-none');
        }
    });
</script>
