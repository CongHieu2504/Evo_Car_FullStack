<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Bikin Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicons -->
    <link href="<?= base_url('assets/img/favicon.png') ?>" rel="icon">
    <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/aos/aos.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">
    <!-- Main CSS File -->
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
    
    <!-- Custom Dropdown CSS -->
    <style>
    .custom-dropdown {
        position: relative;
    }
    
    .custom-dropdown-menu {
        display: none;
        position: absolute !important;
        top: 100% !important;
        left: 0 !important;
        right: 0 !important;
        background: white !important;
        border: 1px solid #ced4da !important;
        border-radius: 0.375rem !important;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1) !important;
        z-index: 100000 !important;
        max-height: 200px !important;
        overflow-y: auto !important;
    }
    
    .custom-dropdown-item {
        padding: 8px 12px !important;
        cursor: pointer !important;
        border-bottom: 1px solid #f8f9fa !important;
        color: #212529 !important;
    }
    
    .custom-dropdown-item:hover {
        background-color: #f8f9fa !important;
    }
    
    .custom-dropdown-item:last-child {
        border-bottom: none !important;
    }
    </style>
    <style>
    /* Control stacking of home search panel; keep high on desktop, low on mobile */
    .home-search-panel { position: relative; z-index: 1000; }
    @media (max-width: 768px){ .home-search-panel { z-index: 10; } }
    </style>
</head>
<body>
    <?php
    // Map động danh mục để đảm bảo link đúng với DB
    $CI = &get_instance();
    if (isset($CI)) {
        $CI->load->database();
        $cats = $CI->db->get('shops_cat')->result_array();
        if (!function_exists('catIdByKeyword')) {
            function catIdByKeyword($cats, $keyword)
            {
                $kw = mb_strtolower($keyword, 'UTF-8');
                foreach ($cats as $c) {
                    $name = isset($c['name']) ? mb_strtolower($c['name'], 'UTF-8') : '';
                    if ($name !== '' && strpos($name, $kw) !== false) {
                        return (int)$c['id'];
                    }
                }
                return null;
            }
        }
        $CAT_IDS = [
            'HATCH BACK' => catIdByKeyword($cats, 'hatch'),
            'SEDAN' => catIdByKeyword($cats, 'sedan'),
            'PICK UP' => catIdByKeyword($cats, 'pick'),
            'MPV' => catIdByKeyword($cats, 'mpv'),
            'SUV' => catIdByKeyword($cats, 'suv'),
            'CROSSOVER' => catIdByKeyword($cats, 'crossover'),
            'COUPE – XE THỂ THAO' => catIdByKeyword($cats, 'coupe'),
            'CONVERTIBLE – XE MUI TRẦN' => catIdByKeyword($cats, 'convertible'),
        ];
        echo '<script>window.CAT_IDS = ' . json_encode($CAT_IDS, JSON_UNESCAPED_UNICODE) . ';</script>';
    }
    ?>
<?php if($this->session->userdata('just_logged_in')): ?>
    <div id="login-toast-alert" class="alert alert-success toast-alert alert-dismissible fade show" role="alert">
        Đăng nhập thành công!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php $this->session->unset_userdata('just_logged_in'); ?>
    <script>
    setTimeout(function() {
        var alert = document.getElementById('login-toast-alert');
        if(alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(function() { alert.style.display = 'none'; }, 500);
        }
    }, 5000);
    document.addEventListener('DOMContentLoaded', function() {
        var closeBtn = document.querySelector('#login-toast-alert .btn-close');
        var alert = document.getElementById('login-toast-alert');
        if(closeBtn && alert) {
            closeBtn.addEventListener('click', function() {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(function() { alert.style.display = 'none'; }, 500);
            });
        }
        document.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                var alert = document.getElementById('login-toast-alert');
                if(alert) alert.remove();
            });
        });
    });
    </script>
    <style>
    .toast-alert {
        position: fixed;
        top: 32px;
        right: 32px;
        z-index: 9999;
        min-width: 260px;
        max-width: 350px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        animation: fadeInDown 0.5s;
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px);}
        to { opacity: 1; transform: translateY(0);}
    }
    @media (max-width: 600px) {
        .toast-alert { right: 8px; left: 8px; top: 16px; min-width: unset; max-width: 98vw; }
    }
    .header-actions {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    @media (max-width: 600px) {
        .header-actions {
            gap: 8px;
        }
    }
    </style>
<?php endif; ?>
    <!-- Header -->
    <header class="header">
        <div class="container-fluid">
            <div class="logo">
                <a href="<?= site_url('') ?>"><img src="<?= base_url('assets/img/logo.webp') ?>" alt="Logo"></a>
            </div>
            <!-- Navmenu cho desktop -->
            <nav class="navmenu">
                <ul>
                    <li><a href="<?= site_url() ?>">Trang chủ</a></li>
                    <li><a href="<?= site_url('gioi-thieu') ?>">Giới thiệu</a></li>
                    <li class="dropdown">
                        <a href="<?= site_url('products') ?>">Sản phẩm</a>
                        <div class="dropdown-menu">
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=' . (!empty($CAT_IDS['HATCH BACK']) ? $CAT_IDS['HATCH BACK'] : 1)) ?>">HATCH BACK</a>
                                <ul>
                                    <li><a href="<?= site_url('products?cat=11') ?>">Hyundai i10</a></li>
                                    <li><a href="<?= site_url('products?cat=15') ?>">Ford Focus</a></li>
                                    <li><a href="<?= site_url('products?cat=16') ?>">Toyota Yaris</a></li>
                                    <li><a href="<?= site_url('products?cat=22') ?>">KIA Morning</a></li>
                                    <li><a href="<?= site_url('products?cat=31') ?>">Suzuki Celerio</a></li>
                                    <li><a href="<?= site_url('products?cat=32') ?>">Chevrolet Spark</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=' . (!empty($CAT_IDS['SEDAN']) ? $CAT_IDS['SEDAN'] : 2)) ?>">SEDAN</a>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=' . (!empty($CAT_IDS['PICK UP']) ? $CAT_IDS['PICK UP'] : 3)) ?>">PICK UP</a>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=' . (!empty($CAT_IDS['MPV']) ? $CAT_IDS['MPV'] : 4)) ?>">MPV</a>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=' . (!empty($CAT_IDS['SUV']) ? $CAT_IDS['SUV'] : 5)) ?>">SUV</a>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=' . (!empty($CAT_IDS['CROSSOVER']) ? $CAT_IDS['CROSSOVER'] : 6)) ?>">CROSSOVER</a>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=' . (!empty($CAT_IDS['COUPE – XE THỂ THAO']) ? $CAT_IDS['COUPE – XE THỂ THAO'] : 7)) ?>">COUPE – XE THỂ THAO</a>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=' . (!empty($CAT_IDS['CONVERTIBLE – XE MUI TRẦN']) ? $CAT_IDS['CONVERTIBLE – XE MUI TRẦN'] : 8)) ?>">CONVERTIBLE – XE MUI TRẦN</a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="<?= site_url('tin-tuc') ?>">Tin tức</a>
                        <div class="dropdown-menu news-menu">
                            <div class="dropdown-column">
                                <ul>
                                    <li><a href="#">Mua xe</a></li>
                                    <li><a href="#">Lái xe</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="<?= site_url('lien-he-moi') ?>">Liên hệ</a></li>
                    <li><a href="<?= site_url('dang-ky-lai-thu') ?>">Đăng ký lái thử</a></li>
                    <li><a href="<?= site_url('dai-ly') ?>">Đại lý</a></li>
                </ul>
            </nav>
            <div class="header-controls">
                <div class="mobile-nav-toggle">☰</div>
                <div class="header-actions">
                    <a href="#" class="search-icon" title="Tìm kiếm"><i class="bi bi-search"></i></a>
                    <input type="text" class="header-search-input" placeholder="Tìm sản phẩm..."
                        style="display:none; position:absolute; right:60px; top:50%; transform:translateY(-50%); width:220px; padding:6px 12px; border:1px solid #ccc; border-radius:4px; z-index:2000; background:#fff; color:#222; font-size:15px;" />
                    
                    <?php if($this->session->userdata('logged_in')): ?>
                        <!-- User đã đăng nhập -->
                        <div class="user-dropdown">
                            <a href="#" class="user-icon" title="<?php echo isset($this->session->userdata('logged_in')['full_name']) ? $this->session->userdata('logged_in')['full_name'] : 'User'; ?>">
                                <i class="bi bi-person-circle"></i>
                                <span class="user-name"><?php echo isset($this->session->userdata('logged_in')['full_name']) ? $this->session->userdata('logged_in')['full_name'] : 'User'; ?></span>
                            </a>
                            <div class="user-dropdown-menu">
                                <a href="<?php echo base_url('profile'); ?>"><i class="bi bi-person me-2"></i>Hồ sơ</a>
                                <a href="<?php echo base_url('favorites'); ?>"><i class="bi bi-heart me-2"></i>Yêu thích</a>
                                <?php 
                                $logged_in = $this->session->userdata('logged_in');
                                if($logged_in && is_array($logged_in) && isset($logged_in['role']) && $logged_in['role'] == 'ADMIN'): 
                                ?>
                                <div class="dropdown-divider"></div>
                                <a href="<?php echo base_url('admin'); ?>" class="admin-link"><i class="bi bi-gear me-2"></i>Quản trị</a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a href="<?php echo base_url('logout'); ?>"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- User chưa đăng nhập -->
                        <a href="<?php echo base_url('login'); ?>" class="login-icon" title="Đăng nhập"><i class="bi bi-person-circle"></i></a>
                        <a href="<?php echo base_url('register_account'); ?>" class="register-icon" title="Đăng ký"><i class="bi bi-person-plus"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="header-banner-container">
            <img src="<?= base_url('assets/img/slider_1.webp') ?>" alt="Header Banner" class="header-banner">
        </div>
    </header>
    <!-- Search Overlay -->
    <div class="search-overlay"
        style="display:none; position:fixed; left:0; top:0; width:100vw; height:100vh; background:#fff; z-index:3000; align-items:center; justify-content:center;">
        <form class="search-overlay-form"
            style="width:100%; max-width:600px; margin:auto; display:flex; align-items:center; justify-content:center; position:relative;">
            <input type="text" class="search-overlay-input" placeholder="Tìm kiếm xe..."
                style="width:100%; font-size:2rem; padding:18px 60px 18px 30px; border:none; border-bottom:2px solid #eee; outline:none; background:transparent; text-align:center; color:#222;"
                autofocus />
            <button type="button" class="search-overlay-close"
                style="position:absolute; right:10px; top:50%; transform:translateY(-50%); background:none; border:none; font-size:2.2rem; color:#222; cursor:pointer;">&times;</button>
        </form>
    </div>

    <!-- Thanh tìm kiếm mới - fix dropdown bị che -->
    <div class="d-flex justify-content-center" style="margin-top: 32px; margin-bottom: 24px;">
        <div class="bg-danger text-white py-3 px-4 home-search-panel" style="border-radius: 12px; max-width: 1350px; width: 100%; position: relative;">
            <div class="d-flex align-items-center mb-3">
                <span style="font-size: 2rem; margin-right: 12px;"><i class="bi bi-car-front"></i></span>
                <span style="font-size: 1.3rem; font-weight: 600; letter-spacing: 1px;">Tìm Kiếm Xe</span>
            </div>
            <div class="d-flex flex-wrap align-items-end gap-3">
                <div style="flex:1; min-width: 160px;">
                    <label for="search-keyword-new" class="form-label text-white mb-1" style="font-size: 0.95rem;">Từ khóa</label>
                    <input type="text" class="form-control" id="search-keyword-new" placeholder="Từ khóa">
                </div>
                <div style="flex:1; min-width: 140px; position: relative;">
                    <label for="search-type-new" class="form-label text-white mb-1" style="font-size: 0.95rem;">Dòng xe</label>
                    <div class="custom-dropdown">
                        <button type="button" class="form-select text-start" id="search-type-btn" style="background: white; color: #212529; border: 1px solid #ced4da; border-radius: 0.375rem; padding: 0.375rem 0.75rem; width: 100%; text-align: left; cursor: pointer;">
                            <span id="search-type-text">Tất cả</span>
                            <i class="bi bi-chevron-down" style="float: right; margin-top: 2px;"></i>
                        </button>
                        <div class="custom-dropdown-menu" id="search-type-menu">
                            <div class="custom-dropdown-item" data-value="all">Tất cả</div>
                            <div class="custom-dropdown-item" data-value="suv">SUV</div>
                            <div class="custom-dropdown-item" data-value="sedan">Sedan</div>
                            <div class="custom-dropdown-item" data-value="mpv">MPV</div>
                            <div class="custom-dropdown-item" data-value="hatchback">Hatch Back</div>
                        </div>
                        <input type="hidden" id="search-type-new" value="all">
                    </div>
                </div>
                <div style="flex:1; min-width: 140px; position: relative;">
                    <label for="search-brand-new" class="form-label text-white mb-1" style="font-size: 0.95rem;">Thương hiệu</label>
                    <div class="custom-dropdown">
                        <button type="button" class="form-select text-start" id="search-brand-btn" style="background: white; color: #212529; border: 1px solid #ced4da; border-radius: 0.375rem; padding: 0.375rem 0.75rem; width: 100%; text-align: left; cursor: pointer;">
                            <span id="search-brand-text">Tất cả</span>
                            <i class="bi bi-chevron-down" style="float: right; margin-top: 2px;"></i>
                        </button>
                        <div class="custom-dropdown-menu" id="search-brand-menu">
                            <div class="custom-dropdown-item" data-value="all">Tất cả</div>
                            <div class="custom-dropdown-item" data-value="mitsubishi">Mitsubishi</div>
                            <div class="custom-dropdown-item" data-value="mazda">Mazda</div>
                            <div class="custom-dropdown-item" data-value="toyota">Toyota</div>
                        </div>
                        <input type="hidden" id="search-brand-new" value="all">
                    </div>
                </div>
                <div style="min-width: 120px; align-self: end;">
                    <label class="form-label mb-1" style="opacity:0;">&nbsp;</label>
                    <button type="button" class="btn btn-dark w-100" id="btn-search-new">TÌM KIẾM</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sản phẩm nổi bật -->
    <section class="featured-products py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header-row d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-black m-0">Sản phẩm nổi bật</h2>
                        <div class="categories d-flex">
                            <a href="#" class="filter-tab text-danger mx-2">Tất cả</a>
                            <a href="#" class="filter-tab text-danger mx-2">Hatch Back</a>
                            <a href="#" class="filter-tab text-danger mx-2">Sedan</a>
                            <a href="#" class="filter-tab text-danger mx-2">Pick up</a>
                            <a href="#" class="filter-tab text-danger mx-2">MPV</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row text-center">
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <div class="col-md-3 mb-4" data-type="<?= htmlspecialchars($product['type']) ?>">
                                    <div class="product-card position-relative">
                                        <div class="product-quick-menu" style="position:absolute;top:8px;right:8px;z-index:2;cursor:pointer;">
                                            <span class="quick-menu-icon" title="Xem nhanh" data-product-id="featured-<?= $product['id'] ?>" style="font-size:22px;color:#c00;text-shadow:0 1px 4px #fff,0 0 2px #c00;">&#9776;</span>
                                        </div>
                                        <a href="<?= site_url('product-detail?id=' . $product['id']) ?>">
                                            <img src="<?= !empty($product['image']) ? $product['image'] : base_url('assets/img/no-image.png') ?>" class="product-image" alt="<?= htmlspecialchars($product['title']) ?>">
                                        </a>
                                        <div class="product-details">
                                            <h5 class="card-title">
                                                <a href="<?= site_url('product-detail?id=' . $product['id']) ?>" class="text-dark">
                                                    <?= htmlspecialchars($product['title']) ?>
                                                </a>
                                            </h5>
                                            <?php if (!empty($product['description'])): ?>
                                                <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="quick-info-box" id="quick-info-featured-<?= $product['id'] ?>" style="display:none;position:absolute;top:40px;right:8px;background:#fff;border:1px solid #ccc;padding:12px;z-index:10;width:260px;box-shadow:0 2px 8px rgba(0,0,0,0.15);">
                                            <strong>Tên xe:</strong> <?= htmlspecialchars($product['title']) ?><br>
                                            <?php if (!empty($product['brand'])): ?>
                                                <strong>Thương hiệu:</strong> <?= htmlspecialchars($product['brand']) ?><br>
                                            <?php endif; ?>
                                            <?php if (!empty($product['type'])): ?>
                                                <strong>Dòng xe:</strong> <?= htmlspecialchars($product['type']) ?><br>
                                            <?php endif; ?>
                                            <?php if (!empty($product['description'])): ?>
                                                <strong>Mô tả:</strong> <?= htmlspecialchars($product['description']) ?><br>
                                            <?php endif; ?>
                                            <?php if (!empty($product['price'])): ?>
                                                <strong>Giá:</strong> <?= htmlspecialchars($product['price']) ?><br>
                                            <?php endif; ?>
                                            <div class="mt-2">
                                                <a href="<?= site_url('product-detail?id=' . $product['id']) ?>" class="btn btn-sm btn-primary">Xem chi tiết</a>
                                                <button class="btn btn-sm btn-secondary close-quick-info">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">Không có sản phẩm.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner ở giữa -->
    <section class="banner-section py-4">
        <div class="container">
            <div class="banner-content text-center mb-3">
                <h3 class="text-white">
                    <span class="text-danger">9999+</span> khách hàng mua xe tại Evo Car
                </h3>
                <p class="text-white">Sự tin tưởng của khách hàng chính là thành công lớn nhất của chúng tôi</p>
            </div>
            <div class="swiper banner-swiper">
                <div class="swiper-wrapper" id="banner-container">
                    <?php if (isset($banners) && is_array($banners) && !empty($banners)): ?>
                        <?php foreach ($banners as $banner): ?>
                            <div class="swiper-slide">
                                <a href="<?= site_url('product-title?id=' . $banner['id']) ?>" style="text-decoration:none; color:inherit;">
                                    <div class="banner-item">
                                        <img src="<?= !empty($banner['image']) ? $banner['image'] : base_url('assets/img/no-image.png') ?>" class="img-fluid" alt="<?= htmlspecialchars($banner['title']) ?>">
                                        <div class="banner-content">
                                            <h4><?= htmlspecialchars($banner['title']) ?></h4>
                                            <?php if (!empty($banner['description'])): ?>
                                                <p><?= htmlspecialchars($banner['description']) ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="swiper-slide">
                            <div class="text-center text-muted py-5">Không có banner.</div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
<!-- TOYOTA -->
<section class="toyota-products py-5">
    <div class="container">
        <div class="toyota-header-row d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-black m-0">TOYOTA</h2>
        </div>
        <div class="swiper toyota-swiper" id="toyota-swiper">
            <div class="swiper-wrapper" id="toyota-container">
                <?php if (isset(
                    $toyota_products) && is_array($toyota_products) && !empty($toyota_products)): ?>
                    <?php foreach ($toyota_products as $product): ?>
                        <div class="swiper-slide">
                            <div class="product-card position-relative">
                                <div class="product-quick-menu" style="position:absolute;top:8px;right:8px;z-index:2;cursor:pointer;">
                                    <span class="quick-menu-icon" title="Xem nhanh" data-product-id="toyota-<?= $product['id'] ?>" style="font-size:22px;color:#c00;text-shadow:0 1px 4px #fff,0 0 2px #c00;">&#9776;</span>
                                </div>
                                <a href="<?= site_url('product-detail?id=' . $product['id']) ?>">
                                    <img src="<?= !empty($product['image']) ? $product['image'] : base_url('assets/img/no-image.png') ?>" class="product-image" alt="<?= htmlspecialchars($product['title']) ?>">
                                </a>
                                <div class="product-details">
                                    <h5 class="text-black">
                                        <a href="<?= site_url('product-detail?id=' . $product['id']) ?>" class="text-dark">
                                            <?= htmlspecialchars($product['title']) ?>
                                        </a>
                                    </h5>
                                    <?php if (!empty($product['description'])): ?>
                                        <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($product['price'])): ?>
                                        <p class="text-muted">Giá: <?= htmlspecialchars($product['price']) ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="quick-info-box" id="quick-info-toyota-<?= $product['id'] ?>" style="display:none;position:absolute;top:40px;right:8px;background:#fff;border:1px solid #ccc;padding:12px;z-index:10;width:260px;box-shadow:0 2px 8px rgba(0,0,0,0.15);">
                                    <strong>Tên xe:</strong> <?= htmlspecialchars($product['title']) ?><br>
                                    <?php if (!empty($product['brand'])): ?>
                                        <strong>Thương hiệu:</strong> <?= htmlspecialchars($product['brand']) ?><br>
                                    <?php endif; ?>
                                    <?php if (!empty($product['type'])): ?>
                                        <strong>Dòng xe:</strong> <?= htmlspecialchars($product['type']) ?><br>
                                    <?php endif; ?>
                                    <?php if (!empty($product['description'])): ?>
                                        <strong>Mô tả:</strong> <?= htmlspecialchars($product['description']) ?><br>
                                    <?php endif; ?>
                                    <?php if (!empty($product['price'])): ?>
                                        <strong>Giá:</strong> <?= htmlspecialchars($product['price']) ?><br>
                                    <?php endif; ?>
                                    <div class="mt-2">
                                        <a href="<?= site_url('product-detail?id=' . $product['id']) ?>" class="btn btn-sm btn-primary">Xem chi tiết</a>
                                        <button class="btn btn-sm btn-secondary close-quick-info">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="swiper-slide">
                        <div class="text-center text-muted py-5">Không có sản phẩm Toyota.</div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
    <!-- Banner Title -->
    <section class="banner-title py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="banner-title-header">
                        <img src="<?= base_url('assets/img/evo_full_banner.webp') ?>" alt="Banner Long" class="banner-title-header-image">
                    </div>
                </div>
                <div class="col-12 text-center mb-4">
                    <button class="banner-title-text-black">EVO CAR MAGAZINE</button>
                </div>
                <div class="col-12">
                    <div class="swiper banner-title-swiper">
                        <div class="swiper-wrapper" id="banner-title-container">
                            <?php if (isset($banner_titles) && is_array($banner_titles) && !empty($banner_titles)): ?>
                                <?php foreach ($banner_titles as $banner_title): ?>
                                    <div class="swiper-slide">
                                        <a href="<?= site_url('product-title?id=' . $banner_title['id']) ?>" style="text-decoration:none; color:inherit;">
                                            <div class="banner-title-item">
                                                <img src="<?= !empty($banner_title['image']) ? $banner_title['image'] : base_url('assets/img/no-image.png') ?>" class="img-fluid" alt="<?= htmlspecialchars($banner_title['title']) ?>">
                                                <div class="banner-title-content">
                                                    <h5><?= htmlspecialchars($banner_title['title']) ?></h5>
                                                    <?php if (!empty($banner_title['description'])): ?>
                                                        <p><?= htmlspecialchars($banner_title['description']) ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="swiper-slide">
                                    <div class="text-center text-muted py-5">Không có banner title.</div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="col-12 text-center mt-4">
                    <button class="view-all-button" onclick="window.location.href='<?= site_url('tin-tuc') ?>'">XEM TẤT CẢ</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer id="footer" class="footer">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="<?= site_url('') ?>" class="logo d-flex align-items-center">
                        <span class="sitename">Evo Car</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>70 Lu Gia, Ward 15, District 11, Ho Chi Minh City</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>1900 6750</span></p>
                        <p><strong>Email:</strong> <span>support@sapo.vn</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Mua hàng</h4>
                    <ul>
                        <li><a href="<?= site_url('') ?>">Trang chủ</a></li>
                        <li><a href="<?= site_url('gioi-thieu') ?>">Giới thiệu</a></li>
                        <li><a href="<?= site_url('products') ?>">Sản phẩm</a></li>
                        <li><a href="<?= site_url('lien-he-moi') ?>">Liên hệ</a></li>
                        <li><a href="<?= site_url('tin-tuc') ?>">Tin tức</a></li>
                        <li><a href="<?= site_url('register') ?>">Đăng ký lái thử</a></li>
                        <li><a href="<?= site_url('branch') ?>">Đại lý</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Dịch vụ khách hàng</h4>
                    <ul>
                        <li><a href="<?= site_url('') ?>">Trang chủ</a></li>
                        <li><a href="<?= site_url('gioi-thieu') ?>">Giới thiệu</a></li>
                        <li><a href="<?= site_url('products') ?>">Sản phẩm</a></li>
                        <li><a href="<?= site_url('lien-he-moi') ?>">Liên hệ</a></li>
                        <li><a href="<?= site_url('tin-tuc') ?>">Tin tức</a></li>
                        <li><a href="<?= site_url('register') ?>">Đăng ký lái thử</a></li>
                        <li><a href="<?= site_url('branch') ?>">Đại lý</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>Đăng ký nhận tin</h4>
                    <p>Nhận thông tin sản phẩm mới nhất, tin khuyến mãi và nhiều hơn nữa.</p>
                    <form action="#" method="post" class="php-email-form">
                        <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Evo car</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer>
    <!-- Mobile Navigation Modal -->
    <div class="modal-overlay" id="mobile-nav-modal">
        <div class="modal-content">
            <button class="modal-close" id="modal-close">&times;</button>
            <h3 class="modal-title">Menu</h3>
            <nav class="modal-menu">
                <ul>
                    <li><a href="<?= site_url() ?>">Trang chủ</a></li>
                    <li><a href="<?= site_url('gioi-thieu') ?>">Giới thiệu</a></li>
                    <li class="modal-dropdown">
                        <a href="#" class="modal-product-toggle" title="Click để mở menu con, Double click để vào trang Sản phẩm">
                            Sản phẩm <span class="toggle-icon">+</span>
                        </a>
                        <ul class="modal-sub-menu"></ul>
                    </li>
                    <li class="modal-dropdown">
                        <a href="#" class="modal-news-toggle" title="Click để mở menu con, Double click để vào trang Tin tức">
                            Tin tức <span class="toggle-icon">+</span>
                        </a>
                        <ul class="modal-news-sub-menu">
                            <li><a href="#">Mua xe</a></li>
                            <li><a href="#">Lái xe</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= site_url('lien-he-moi') ?>">Liên hệ</a></li>
                    <li><a href="<?= site_url('dang-ky-lai-thu') ?>">Đăng ký lái thử</a></li>
                    <li><a href="<?= site_url('dai-ly') ?>">Đại lý</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/product-dynamic.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script>
    // Realtime update system
    var lastUpdateTime = <?= isset($page_timestamp) ? $page_timestamp : time() ?>;
    var currentChecksum = '<?= isset($products_checksum) ? $products_checksum : '' ?>';
    var isCheckingUpdates = false;
    
    // Create update notification banner
    function createUpdateBanner() {
        const banner = document.createElement('div');
        banner.id = 'update-banner';
        banner.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            padding: 10px 20px;
            text-align: center;
            z-index: 9999;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            transform: translateY(-100%);
            transition: transform 0.3s ease;
        `;
        banner.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-sync-alt me-2"></i>
                    <strong>Có sản phẩm mới được cập nhật!</strong>
                </div>
                <div>
                    <button onclick="location.reload()" class="btn btn-light btn-sm me-2">
                        <i class="fas fa-refresh me-1"></i>Cập nhật ngay
                    </button>
                    <button onclick="hideUpdateBanner()" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(banner);
        
        // Show banner with animation
        setTimeout(() => {
            banner.style.transform = 'translateY(0)';
        }, 100);
    }
    
    function hideUpdateBanner() {
        const banner = document.getElementById('update-banner');
        if (banner) {
            banner.style.transform = 'translateY(-100%)';
            setTimeout(() => {
                banner.remove();
            }, 300);
        }
    }
    
    // Check for updates every 5 seconds
    function checkForUpdates() {
        if (isCheckingUpdates) return;
        isCheckingUpdates = true;
        
        console.log('🔍 Checking for updates... Last update time:', lastUpdateTime);
        
        fetch('<?= base_url('home/check_updates') ?>?t=' + Date.now())
            .then(response => {
                console.log('📡 Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('📊 Update data:', data);
                if (data && data.checksum && data.checksum !== currentChecksum) {
                    console.log('🔄 Content changed (checksum mismatch). Reloading...');
                    location.reload();
                } else {
                    console.log('✅ No updates found');
                }
            })
            .catch(error => {
                console.log('❌ Update check failed:', error);
            })
            .finally(() => {
                isCheckingUpdates = false;
            });
    }
    
    // Start checking for product updates
    setInterval(checkForUpdates, 1000); // Check every 1 second
    setTimeout(checkForUpdates, 1000); // Check after 1 second

    // Realtime cho banner trang chủ (toàn bộ banner publish)
    var currentBannerChecksum = '<?= isset($banner_checksum) ? $banner_checksum : '' ?>';
    var isCheckingBanner = false;
    var bannerInitialized = false;
    function checkBannerUpdates(){
        if(isCheckingBanner) return; isCheckingBanner = true;
        fetch('<?= base_url('home/check_banner_updates') ?>?t=' + Date.now())
            .then(r=>r.json())
            .then(data=>{
                if(!data || !data.checksum) return;
                if(!bannerInitialized){
                    currentBannerChecksum = data.checksum;
                    bannerInitialized = true;
                    return;
                }
                if(currentBannerChecksum && data.checksum && data.checksum !== currentBannerChecksum){
                    location.reload();
                }
            })
            .catch(()=>{})
            .finally(()=>{ isCheckingBanner = false; });
    }
    setInterval(checkBannerUpdates, 1000);
    setTimeout(checkBannerUpdates, 1000);
    
    document.addEventListener('DOMContentLoaded', function () {
        // Tìm kiếm header
        const searchIcon = document.querySelector('.search-icon');
        const searchInput = document.querySelector('.header-search-input');
        if (searchIcon && searchInput) {
            searchIcon.addEventListener('click', function (e) {
                e.preventDefault();
                searchInput.style.display = (searchInput.style.display === 'none' || searchInput.style.display === '') ? 'block' : 'none';
                if (searchInput.style.display === 'block') {
                    searchInput.focus();
                }
            });
            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    const val = searchInput.value.trim();
                    if (val) window.location.href = "<?= site_url('search') ?>?query=" + encodeURIComponent(val);
                }
            });
            // Ẩn input khi blur
            searchInput.addEventListener('blur', function () {
                setTimeout(() => { searchInput.style.display = 'none'; }, 200);
            });
        }
        // Custom dropdown functionality
        function setupCustomDropdown(btnId, menuId, textId, hiddenInputId) {
            const btn = document.getElementById(btnId);
            const menu = document.getElementById(menuId);
            const text = document.getElementById(textId);
            const hiddenInput = document.getElementById(hiddenInputId);
            
            // Toggle dropdown
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Close other dropdowns
                document.querySelectorAll('.custom-dropdown-menu').forEach(m => {
                    if (m !== menu) m.style.display = 'none';
                });
                
                menu.style.display = menu.style.display === 'none' || menu.style.display === '' ? 'block' : 'none';
            });
            
            // Handle option selection
            menu.addEventListener('click', function(e) {
                if (e.target.classList.contains('custom-dropdown-item')) {
                    const value = e.target.getAttribute('data-value');
                    const label = e.target.textContent;
                    
                    hiddenInput.value = value;
                    text.textContent = label;
                    menu.style.display = 'none';
                }
            });
        }
        
        // Setup dropdowns
        setupCustomDropdown('search-type-btn', 'search-type-menu', 'search-type-text', 'search-type-new');
        setupCustomDropdown('search-brand-btn', 'search-brand-menu', 'search-brand-text', 'search-brand-new');
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.custom-dropdown')) {
                document.querySelectorAll('.custom-dropdown-menu').forEach(menu => {
                    menu.style.display = 'none';
                });
            }
        });
        
        document.getElementById('btn-search-new').onclick = function () {
            const keyword = document.getElementById('search-keyword-new').value.trim();
            const type = document.getElementById('search-type-new').value;
            const brand = document.getElementById('search-brand-new').value;
            let query = '';
            if (keyword) query += `q=${encodeURIComponent(keyword)}`;
            if (type && type !== 'all') query += (query ? '&' : '') + `type=${encodeURIComponent(type)}`;
            if (brand && brand !== 'all') query += (query ? '&' : '') + `brand=${encodeURIComponent(brand)}`;
            window.location.href = "/kholanh/search-new" + (query ? '?' + query : '');
        };
        // Quick info icon click
        document.querySelectorAll('.quick-menu-icon').forEach(function(icon) {
            icon.addEventListener('click', function(e) {
                e.stopPropagation();
                var id = this.getAttribute('data-product-id');
                var box = document.getElementById('quick-info-' + id);
                if (box) {
                    box.style.display = (box.style.display === 'none' || box.style.display === '') ? 'block' : 'none';
                }
            });
        });
        document.querySelectorAll('.close-quick-info').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                this.closest('.quick-info-box').style.display = 'none';
            });
        });
        // Sau khi render xong các section, khởi tạo lại Swiper cho từng section Home
        setTimeout(function() {
            // Banner ở giữa
            if (window.bannerSwiper) window.bannerSwiper.destroy(true, true);
            window.bannerSwiper = new Swiper('.banner-swiper', {
                slidesPerView: 4,
                slidesPerGroup: 4,
                spaceBetween: 20,
                loop: true,
                loopFillGroupWithBlank: true,
                pagination: {
                    el: '.banner-swiper .swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    0: { slidesPerView: 1, slidesPerGroup: 1, spaceBetween: 10 },
                    992: { slidesPerView: 2, slidesPerGroup: 2, spaceBetween: 15 },
                    1200: { slidesPerView: 3, slidesPerGroup: 3, spaceBetween: 20 },
                    1400: { slidesPerView: 4, slidesPerGroup: 4, spaceBetween: 20 }
                }
            });
            // TOYOTA
            if (window.toyotaSwiper) window.toyotaSwiper.destroy(true, true);
            window.toyotaSwiper = new Swiper('.toyota-swiper', {
                slidesPerView: 4,
                spaceBetween: 24,
                loop: true,
                navigation: {
                    nextEl: '.toyota-swiper .swiper-button-next',
                    prevEl: '.toyota-swiper .swiper-button-prev',
                },
                pagination: {
                    el: '.toyota-swiper .swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    0: { slidesPerView: 1, spaceBetween: 10 },
                    992: { slidesPerView: 2, spaceBetween: 15 },
                    1200: { slidesPerView: 4, spaceBetween: 24 }
                }
            });
            // Banner Title
            if (window.bannerTitleSwiper) window.bannerTitleSwiper.destroy(true, true);
            window.bannerTitleSwiper = new Swiper('.banner-title-swiper', {
                slidesPerView: 3,
                spaceBetween: 20,
                loop: true,
                navigation: {
                    nextEl: '.banner-title-swiper .swiper-button-next',
                    prevEl: '.banner-title-swiper .swiper-button-prev',
                },
                pagination: {
                    el: '.banner-title-swiper .swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    0: { slidesPerView: 1, spaceBetween: 10 },
                    992: { slidesPerView: 2, spaceBetween: 15 },
                    1200: { slidesPerView: 3, spaceBetween: 20 }
                }
            });
        }, 200); // Đợi DOM render xong (có thể điều chỉnh timeout nếu cần)
        
        // Force update swipers sau khi khởi tạo
        setTimeout(function() {
            if (window.bannerSwiper) {
                window.bannerSwiper.update();
                window.bannerSwiper.updateSlides();
                window.bannerSwiper.updateProgress();
                window.bannerSwiper.updateSlidesClasses();
            }
            if (window.toyotaSwiper) {
                window.toyotaSwiper.update();
                window.toyotaSwiper.updateSlides();
                window.toyotaSwiper.updateProgress();
                window.toyotaSwiper.updateSlidesClasses();
            }
            if (window.bannerTitleSwiper) {
                window.bannerTitleSwiper.update();
                window.bannerTitleSwiper.updateSlides();
                window.bannerTitleSwiper.updateProgress();
                window.bannerTitleSwiper.updateSlidesClasses();
            }
        }, 500);
        
        // Force update khi resize window
        window.addEventListener('resize', function() {
            setTimeout(function() {
                if (window.bannerSwiper) {
                    window.bannerSwiper.update();
                }
                if (window.toyotaSwiper) {
                    window.toyotaSwiper.update();
                }
                if (window.bannerTitleSwiper) {
                    window.bannerTitleSwiper.update();
                }
            }, 100);
        });
    });
    </script>

    <!-- Chat Popup AI -->
    <div id="chat-popup" class="chat-popup">
        <div class="chat-popup-header">
            <span class="chat-popup-title">Chat với nhân viên tư vấn</span>
            <div class="chat-popup-actions">
                <button class="chat-clear-btn" onclick="clearChatHistory()" title="Xóa cuộc trò chuyện">
                    <i class="bi bi-trash"></i>
                </button>
                <button class="chat-popup-close" onclick="toggleChatPopup()">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        </div>
        <div class="chat-popup-body">
            <div class="chat-assistant-greeting">
                <div class="chat-assistant-avatar">
                    <i class="bi bi-robot"></i>
                </div>
                <div class="chat-assistant-message">
                    Em ở đây để hỗ trợ cho mình ạ
                </div>
            </div>
            <!-- Chat Messages Area (hidden initially) -->
            <div class="chat-messages" id="chat-messages" style="display: none;">
                <!-- Messages will be added here dynamically -->
            </div>
            <div class="chat-input-section">
                <textarea id="chat-message-input" class="chat-message-input" placeholder="Tin nhắn" rows="4"></textarea>
                <div class="chat-input-footer">
                    <span class="chat-input-hint">Hãy nhập</span>
                    <button class="chat-send-btn" onclick="startChat()">
                        <i class="bi bi-send"></i>
                        BẮT ĐẦU TRÒ CHUYỆN
                    </button>
                </div>
            </div>
        </div>
    </div>


</body>
</html> 



