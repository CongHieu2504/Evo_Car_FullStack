<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= htmlspecialchars($product['name']) ?> - Evo Car</title>
    <meta name="description" content="<?= htmlspecialchars($product['description']) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($product['name']) ?>, xe hơi, Evo Car">
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
    <link href="<?= base_url('assets/css/product-detail.css') ?>" rel="stylesheet">
    <style>
        .nav-detail ul li a {
            position: relative;
            transition: color 0.3s;
        }
        .nav-detail ul li a.active, .nav-detail ul li a:focus {
            color: #dc3545;
        }
        .nav-detail ul li a.active::after {
            content: '';
            position: absolute;
            left: 0; right: 0; bottom: -4px;
            height: 3px;
            background: #dc3545;
            border-radius: 2px;
            transition: width 0.3s;
            width: 100%;
        }

        /* Main image container styling */
        .main-image-container {
            max-width: 550px;
            height: 400px;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            margin-bottom: 20px;
        }

        .product-image {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center !important;
            transition: all 0.3s ease;
        }

        /* Product thumbnails styling */
        .product-thumbnails {
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            scrollbar-width: thin;
            scrollbar-color: #888 #f1f1f1;
            padding-bottom: 5px;
        }

        .product-thumbnails::-webkit-scrollbar {
            height: 6px;
        }

        .product-thumbnails::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .product-thumbnails::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .product-thumbnails::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .product-thumbnails .img-thumbnail {
            width: 85px !important;
            height: 85px !important;
            object-fit: cover !important;
            object-position: center !important;
            flex-shrink: 0;
            cursor: pointer;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: inline-block;
            margin-right: 8px;
        }

        .product-thumbnails .img-thumbnail:hover {
            border-color: #007bff;
            transform: scale(1.05);
        }

        .product-thumbnails .active-thumbnail {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 2px rgba(220, 53, 69, 0.3);
        }

        /* Swiper styling */
        .swiper-slide {
            height: 200px;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .swiper-slide img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center !important;
            transition: all 0.3s ease;
        }

        .swiper-slide img:hover {
            transform: scale(1.05);
        }

        /* Swiper navigation buttons */
        .swiper-button-next,
        .swiper-button-prev {
            background-color: rgba(255, 255, 255, 0.9);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            font-size: 18px;
            color: #333;
            font-weight: bold;
            z-index: 10;
            cursor: pointer;
            top: 50%;
            transform: translateY(-50%);
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .main-image-container {
                height: 300px;
            }

            .product-thumbnails .img-thumbnail {
                width: 70px !important;
                height: 70px !important;
                margin-right: 6px;
            }

            .swiper-slide img {
                height: 280px !important;
            }

            /* Stack columns on mobile */
            .product-detail .row,
            .exterior-section .row,
            .interior-section .row {
                flex-direction: column;
            }

            /* Interior section layout fix for mobile */
            .interior-section .row > .col-md-6:first-child {
                order: 2;
            }

            .interior-section .row > .col-md-6:last-child {
                order: 1;
            }
        }

        @media (max-width: 576px) {
            .main-image-container {
                height: 250px;
            }

            .product-thumbnails .img-thumbnail {
                width: 60px !important;
                height: 60px !important;
                margin-right: 5px;
            }

            .swiper-slide img {
                height: 200px !important;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .main-image-container {
                height: 350px;
            }

            .product-thumbnails .img-thumbnail {
                width: 75px !important;
                height: 75px !important;
            }

            .swiper-slide img {
                height: 180px !important;
            }
        }

        @media (min-width: 1200px) {
            .main-image-container {
                height: 450px;
            }

            .product-thumbnails .img-thumbnail {
                width: 90px !important;
                height: 90px !important;
            }

            .swiper-slide img {
                height: 220px !important;
            }
        }
    height: 400px;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.product-image {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    object-position: center !important;
    transition: all 0.3s ease;
}

/* Thumbnail styling */
.product-thumbnails .img-thumbnail {
    transition: all 0.3s ease;
    border: 1px solid #dee2e6;
    width: 85px !important;
    height: 85px !important;
    object-fit: cover !important;
    object-position: center !important;
    flex-shrink: 0;
    cursor: pointer;
}

.product-thumbnails .img-thumbnail:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.product-thumbnails .img-thumbnail.active-thumbnail {
    border: 2px solid #dc3545 !important;
    box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3);
}

/* Container styling for consistent layout */
.product-thumbnails {
    display: flex;
    flex-wrap: nowrap;
    gap: 8px;
    overflow-x: auto;
    padding: 5px 0;
}

.product-thumbnails::-webkit-scrollbar {
    height: 4px;
}

.product-thumbnails::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 2px;
}

.product-thumbnails::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 2px;
}

.product-thumbnails::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Basic Swiper styling */
.swiper-slide img {
    width: 100%;
    height: 200px !important;
    object-fit: cover;
    border-radius: 8px;
}

.swiper-button-next,
.swiper-button-prev {
    background-color: rgba(255, 255, 255, 0.9);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 18px;
    color: #333;
    font-weight: bold;
}








</style>
</head>
<body>
    <?php
    // Map động danh mục cho header trang product-detail
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
    }
    ?>
    <!-- Header -->
    <header class="header">
        <div class="container-fluid">
            <div class="logo">
                <a href="<?= site_url('') ?>"><img src="<?= base_url('assets/img/logo.webp') ?>" alt="Logo"></a>
            </div>
            <!-- Navmenu cho desktop -->
            <nav class="navmenu">
                <ul>
                    <li><a href="<?= site_url('') ?>">Trang chủ</a></li>
                    <li><a href="<?= site_url('about') ?>">Giới thiệu</a></li>
                    <li class="dropdown">
                        <a href="<?= site_url('products') ?>">Sản phẩm</a>
                        <div class="dropdown-menu">
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=' . (!empty($CAT_IDS['HATCH BACK']) ? $CAT_IDS['HATCH BACK'] : 1)) ?>">HATCH BACK</a>
                                <ul>
                                    <li><a href="<?= site_url('products?cat=11') ?>">Hyundai i10</a></li>
                                    <li><a href="<?= site_url('products?cat=22') ?>">KIA Morning</a></li>
                                    <li><a href="<?= site_url('products?cat=32') ?>">Chevrolet Spark</a></li>
                                    <li><a href="<?= site_url('products?cat=14') ?>">Mitsubishi Mirage</a></li>
                                    <li><a href="<?= site_url('products?cat=31') ?>">Suzuki Celerio</a></li>
                                    <li><a href="<?= site_url('products?cat=15') ?>">Ford Focus</a></li>
                                    <li><a href="<?= site_url('products?cat=16') ?>">Toyota Yaris</a></li>
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
                                <a class="column-title" href="<?= site_url('products?cat=' . (!empty($CAT_IDS['COUPE – XE THỂ THAO']) ? $CAT_IDS['COUPE – XE THỂ THAO'] : 7)) ?>">COUPE - XE THỂ THAO</a>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=' . (!empty($CAT_IDS['CONVERTIBLE – XE MUI TRẦN']) ? $CAT_IDS['CONVERTIBLE – XE MUI TRẦN'] : 8)) ?>">CONVERTIBLE - XE MUI TRẦN</a>
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
                    <li><a href="<?= site_url('register') ?>">Đăng ký lái thử</a></li>
                    <li><a href="<?= site_url('branch') ?>">Đại lý</a></li>
                </ul>
            </nav>
            <!-- Navmenu mới cho mobile -->
            <div class="modal-overlay" id="mobile-nav-modal">
                <div class="modal-content">
                    <button class="modal-close" id="modal-close">×</button>
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
            <div class="header-controls">
                <div class="mobile-nav-toggle">☰</div>
                <div class="header-actions">
                    <a href="#" class="search-icon" title="Tìm kiếm"><i class="bi bi-search"></i></a>
                    <input type="text" class="header-search-input" placeholder="Tìm sản phẩm..."
                        style="display:none; position:absolute; right:60px; top:50%; transform:translateY(-50%); width:220px; padding:6px 12px; border:1px solid #ccc; border-radius:4px; z-index:2000; background:#fff; color:#222; font-size:15px;" />
                    
                    <?php if($this->session->userdata('logged_in')): ?>
                        <?php 
                        $logged_in = $this->session->userdata('logged_in');
                        $full_name = is_array($logged_in) && isset($logged_in['full_name']) ? $logged_in['full_name'] : 'User';
                        ?>
                        <div class="user-dropdown">
                            <a href="#" class="user-icon" title="<?php echo $full_name; ?>">
                                <i class="bi bi-person-circle"></i>
                                <span class="user-name"><?php echo $full_name; ?></span>
                            </a>
                            <div class="user-dropdown-menu">
                                <a href="<?php echo base_url('profile'); ?>"><i class="bi bi-person me-2"></i>Hồ sơ</a>
                                <a href="<?php echo base_url('favorites'); ?>"><i class="bi bi-heart me-2"></i>Yêu thích</a>
                                <?php
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

    <!-- Menu điều hướng chi tiết -->
    <nav class="nav-detail">
        <ul>
            <li><a href="#overview"><i class="bi bi-star"></i> TỔNG QUAN</a></li>
            <li><a href="#exterior"><i class="bi bi-circle-half"></i> NGOẠI THẤT</a></li>
            <li><a href="#interior"><i class="bi bi-car-front"></i> NỘI THẤT</a></li>
            <li><a href="#specifications"><i class="bi bi-gear"></i> THÔNG SỐ KỸ THUẬT</a></li>
            <li><a href="#cost"><i class="bi bi-currency-dollar"></i> DỰ TÍNH CHI PHÍ</a></li>
        </ul>
    </nav>

    <!-- Product Detail Section - Tổng quan -->
    <section class="product-detail" id="overview">
        <div class="container">
            <?php
            $images = [];
            if (!empty($product['images'])) {
                $images = json_decode($product['images'], true);
                if (!is_array($images)) $images = [];
            }
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="main-image-container">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image" id="mainImage">
                    </div>
                    <div class="product-thumbnails mt-3">
                        <!-- Main image thumbnail (always first) -->
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="Main Image" class="img-thumbnail active-thumbnail" onclick="changeMainImage('<?= htmlspecialchars($product['image']) ?>', this)">
                        
                        <!-- Additional images thumbnails -->
                        <?php if (!empty($images)): ?>
                            <?php foreach ($images as $img): ?>
                                <img src="<?= htmlspecialchars($img) ?>" alt="Thumbnail" class="img-thumbnail" onclick="changeMainImage('<?= htmlspecialchars($img) ?>', this)">
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-info">
                        <h2 id="productName"><?= htmlspecialchars($product['name']) ?></h2>
                        <p id="productPrice" class="text-danger fw-bold"><?= htmlspecialchars($product['price']) ?></p>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-people"></i> Số chỗ ngồi: <span id="productSeats">
                                <?= isset($product['specs']['Số chỗ ngồi']) ? htmlspecialchars($product['specs']['Số chỗ ngồi']) : '5' ?>
                            </span> chỗ</li>
                            <li><i class="bi bi-car-front"></i> Kiểu dáng: <span id="productType">
                                <?= htmlspecialchars($product['category']) ?>
                            </span></li>
                            <li><i class="bi bi-calendar"></i> Năm sản xuất: <span id="productYear">
                                <?= htmlspecialchars($product['year']) ?>
                            </span></li>
                            <li><i class="bi bi-arrows-expand"></i> Kích thước: <span id="productSize">
                                <?= isset($product['specs']['Kích thước']) ? htmlspecialchars($product['specs']['Kích thước']) : 'Xe trung bình' ?>
                            </span></li>
                            <li><i class="bi bi-droplet"></i> Dung tích:
                                <span id="productCapacity">
                                    <?= isset($product['specs']['Dung tích bình xăng']) ? htmlspecialchars($product['specs']['Dung tích bình xăng']) : '1.496 cm³' ?>
                                </span>
                            </li>
                        </ul>
                        <p id="productDetails" class="mt-3"><?= htmlspecialchars($product['details']) ?></p>
                        <button class="hotline-btn" onclick="window.location.href='tel:19006750'">GỌI HOTLINE 1900 6750</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Exterior Section - Ngoại thất -->
    <section class="exterior-section" id="exterior">
        <div class="container">
            <div class="row">
                <!-- Thông tin sản phẩm bên trái -->
                <div class="col-md-6">
                    <h3 class="exterior-title">NGOẠI THẤT</h3>
                    <p class="exterior-description">
                        <?= !empty($product['description']) ? htmlspecialchars($product['description']) : 'Thông tin ngoại thất đang được cập nhật.' ?>
                    </p>
                </div>
                <!-- Ảnh chính bên phải -->
                <div class="col-md-6">
                    <?php $mainExterior = (!empty($images) ? $images[0] : $product['image']); ?>
                    <div class="main-image-container">
                        <img src="<?= htmlspecialchars($mainExterior) ?>" alt="<?= htmlspecialchars($product['name']) ?> Exterior" class="product-image" id="mainExteriorImage">
                    </div>
                </div>
            </div>
            <!-- Gallery ảnh liên quan bên dưới -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="exterior-gallery">
                        <div class="swiper exterior-swiper">
                            <div class="swiper-wrapper" id="exteriorGallery">
                                <?php if (!empty($images)): ?>
                                    <?php foreach ($images as $img): ?>
                                        <div class="swiper-slide"><img src="<?= htmlspecialchars($img) ?>" alt="Exterior" class="img-fluid"></div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                <div class="swiper-slide"><img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?> Exterior <?= $i+1 ?>" class="img-fluid"></div>
                                <?php endfor; ?>
                                <?php endif; ?>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interior Section - Nội thất -->
    <?php
    $interior_images = [];
    if (!empty($product['interior_images'])) {
        $interior_images = json_decode($product['interior_images'], true);
        if (!is_array($interior_images)) $interior_images = [];
    }
    ?>
    <section class="interior-section" id="interior">
        <div class="container">
            <div class="row">
                <!-- Ảnh chính bên trái -->
                <div class="col-md-6">
                    <?php $mainInterior = (!empty($interior_images) ? $interior_images[0] : $product['image']); ?>
                    <div class="main-image-container">
                        <img src="<?= htmlspecialchars($mainInterior) ?>" alt="<?= htmlspecialchars($product['name']) ?> Interior" class="product-image" id="mainInteriorImage">
                    </div>
                </div>
                <!-- Thông tin nội thất bên phải -->
                <div class="col-md-6">
                    <h3 class="interior-title">NỘI THẤT</h3>
                    <p class="interior-description">
                        <?= !empty($product['description']) ? htmlspecialchars($product['description']) : 'Thông tin nội thất đang được cập nhật.' ?>
                    </p>
                </div>
            </div>
            <!-- Gallery ảnh liên quan bên dưới -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="interior-gallery">
                        <div class="swiper interior-swiper">
                            <div class="swiper-wrapper" id="interiorGallery">
                                <?php if (!empty($interior_images)): ?>
                                    <?php foreach ($interior_images as $img): ?>
                                        <div class="swiper-slide"><img src="<?= htmlspecialchars($img) ?>" alt="Interior" class="img-fluid"></div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                <div class="swiper-slide"><img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?> Interior <?= $i+1 ?>" class="img-fluid"></div>
                                <?php endfor; ?>
                                <?php endif; ?>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Spec Section - Thông số kỹ thuật -->
    <section class="spec-section" id="specifications">
        <div class="container">
            <h3 class="spec-title">THÔNG SỐ KỸ THUẬT</h3>
            <div class="spec-content" id="specContent">
                <?php if (!empty($product['specs'])): ?>
                <div class="spec-item">
                    <h4>Thông số cơ bản</h4>
                    <ul>
                        <?php if (!empty($product['specs']['Động cơ'])): ?>
                            <li><strong>Loại động cơ:</strong> <?= htmlspecialchars($product['specs']['Động cơ']) ?></li>
                        <?php endif; ?>
                        <?php if (!empty($product['specs']['Dung tích'])): ?>
                            <li><strong>Dung tích xy-lanh:</strong> <?= htmlspecialchars($product['specs']['Dung tích']) ?></li>
                        <?php endif; ?>
                        <?php if (!empty($product['specs']['Hộp số'])): ?>
                            <li><strong>Hộp số:</strong> <?= htmlspecialchars($product['specs']['Hộp số']) ?></li>
                        <?php endif; ?>
                        <li><strong>Kích thước (D x R x C):</strong> 4,420 x 1,730 x 1,475 mm</li>
                        <li><strong>Trọng lượng:</strong> 1,200 kg</li>
                    </ul>
                </div>
                <div class="spec-item">
                    <h4>Thông số hiệu suất</h4>
                    <ul>
                        <?php if (!empty($product['specs']['Công suất'])): ?>
                            <li><strong>Công suất tối đa:</strong> <?= htmlspecialchars($product['specs']['Công suất']) ?></li>
                        <?php endif; ?>
                        <?php if (!empty($product['specs']['Mô-men xoắn'])): ?>
                            <li><strong>Mô-men xoắn cực đại:</strong> <?= htmlspecialchars($product['specs']['Mô-men xoắn']) ?></li>
                        <?php endif; ?>
                        <li><strong>Tốc độ tối đa:</strong> 180 km/h</li>
                        <?php if (!empty($product['specs']['Tiêu thụ nhiên liệu'])): ?>
                            <li><strong>Mức tiêu hao nhiên liệu:</strong> <?= htmlspecialchars($product['specs']['Tiêu thụ nhiên liệu']) ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="spec-item">
                    <h4>Thông số an toàn</h4>
                    <ul>
                        <li><strong>Hệ thống phanh:</strong> ABS, EBD</li>
                        <li><strong>Kiểm soát lực kéo:</strong> Có</li>
                        <li><strong>Túi khí:</strong> 2</li>
                        <li><strong>Hệ thống hỗ trợ:</strong> Camera lùi, cảm biến lùi</li>
                    </ul>
                </div>
                <?php else: ?>
                <p>Thông số kỹ thuật đang được cập nhật.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Cost Section - Dự tính chi phí -->
    <section class="cost-section" id="cost">
        <div class="container">
            <h3 class="cost-title">DỰ TÍNH CHI PHÍ</h3>
            <div class="cost-content">
                <div class="cost-selection">
                    <label for="regionSelect">Chọn tỉnh/thành phố:</label>
                    <select id="regionSelect" class="form-control">
                        <option value="">Chọn tỉnh/thành phố</option>
                        <option value="HCM">TP. Hồ Chí Minh</option>
                        <option value="HN">Hà Nội</option>
                        <option value="DN">Đà Nẵng</option>
                    </select>
                </div>
                <ul class="cost-details">
                    <li><strong>Giá xe cơ bản:</strong> <span id="basePrice"><?= htmlspecialchars($product['price']) ?></span></li>
                    <li><strong>Phí đăng ký:</strong> <span id="registrationFee">0 VND</span></li>
                    <li><strong>Phí bảo hiểm:</strong> <span id="insuranceFee">0 VND</span></li>
                    <li><strong>Giá đàm phán:</strong> <span id="negotiablePrice">0 VND</span></li>
                    <li class="cost-total"><strong>Tổng cộng:</strong> <span id="totalCost">0 VND</span></li>
                </ul>
                <p class="cost-note"><strong>Lưu ý:</strong> Giá có thể thay đổi tùy theo chính sách đại lý và chương trình khuyến mãi.</p>
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
                        <li><a href="<?= site_url('about') ?>">Giới thiệu</a></li>
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
                        <li><a href="<?= site_url('about') ?>">Giới thiệu</a></li>
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

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script>
        // Function to change main image and update active thumbnail
        function changeMainImage(imageSrc, clickedThumbnail) {
            // Update main image
            document.getElementById('mainImage').src = imageSrc;
            
            // Remove active class from all thumbnails
            document.querySelectorAll('.product-thumbnails .img-thumbnail').forEach(thumb => {
                thumb.classList.remove('active-thumbnail');
            });
            
            // Add active class to clicked thumbnail
            clickedThumbnail.classList.add('active-thumbnail');
        }
        
        // Swiper cho gallery ngoại thất
        new Swiper('.exterior-swiper', {
            slidesPerView: 3,
            spaceBetween: 15,
            loop: true,
            navigation: {
                nextEl: '.exterior-swiper .swiper-button-next',
                prevEl: '.exterior-swiper .swiper-button-prev',
            },
            breakpoints: {
                320: { slidesPerView: 1, spaceBetween: 10 },
                576: { slidesPerView: 2, spaceBetween: 15 },
                768: { slidesPerView: 3, spaceBetween: 20 },
                992: { slidesPerView: 4, spaceBetween: 25 }
            }
        });
        
        // Swiper cho gallery nội thất
        new Swiper('.interior-swiper', {
            slidesPerView: 3,
            spaceBetween: 15,
            loop: true,
            navigation: {
                nextEl: '.interior-swiper .swiper-button-next',
                prevEl: '.interior-swiper .swiper-button-prev',
            },
            breakpoints: {
                320: { slidesPerView: 1, spaceBetween: 10 },
                576: { slidesPerView: 2, spaceBetween: 15 },
                768: { slidesPerView: 3, spaceBetween: 20 },
                992: { slidesPerView: 4, spaceBetween: 25 }
            }
        });

        // Swiper cho gallery ảnh phụ tổng quan
        if (document.querySelector('.overview-thumbnails')) {
            new Swiper('.overview-thumbnails', {
                slidesPerView: 4,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.overview-thumbnails .swiper-button-next',
                    prevEl: '.overview-thumbnails .swiper-button-prev',
                },
                breakpoints: {
                    576: { slidesPerView: 3 },
                    768: { slidesPerView: 4 }
                }
            });
        }
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
            searchInput.addEventListener('blur', function () {
                setTimeout(() => { searchInput.style.display = 'none'; }, 200);
            });
        }
        // Scroll menu điều hướng
        document.querySelectorAll('.nav-detail a').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                document.getElementById(targetId).scrollIntoView({ behavior: 'smooth' });
            });
        });
        // Render phí từ PHP sang JS
        const costData = {
            HCM: {
                registration: <?= isset($product['specs']['Phí đăng ký HCM']) ? (int)$product['specs']['Phí đăng ký HCM'] : 0 ?>,
                insurance: <?= isset($product['specs']['Phí bảo hiểm HCM']) ? (int)$product['specs']['Phí bảo hiểm HCM'] : 0 ?>,
                nego: <?= isset($product['specs']['Giá đàm phán HCM']) ? (int)$product['specs']['Giá đàm phán HCM'] : 0 ?>
            },
            HN: {
                registration: <?= isset($product['specs']['Phí đăng ký HN']) ? (int)$product['specs']['Phí đăng ký HN'] : 0 ?>,
                insurance: <?= isset($product['specs']['Phí bảo hiểm HN']) ? (int)$product['specs']['Phí bảo hiểm HN'] : 0 ?>,
                nego: <?= isset($product['specs']['Giá đàm phán HN']) ? (int)$product['specs']['Giá đàm phán HN'] : 0 ?>
            },
            DN: {
                registration: <?= isset($product['specs']['Phí đăng ký DN']) ? (int)$product['specs']['Phí đăng ký DN'] : 0 ?>,
                insurance: <?= isset($product['specs']['Phí bảo hiểm DN']) ? (int)$product['specs']['Phí bảo hiểm DN'] : 0 ?>,
                nego: <?= isset($product['specs']['Giá đàm phán DN']) ? (int)$product['specs']['Giá đàm phán DN'] : 0 ?>
            }
        };
        document.getElementById('regionSelect').addEventListener('change', function() {
            let region = this.value;
            let fee = 0, insurance = 0, nego = 0;
            if (region && costData[region]) {
                fee = costData[region].registration;
                insurance = costData[region].insurance;
                nego = costData[region].nego;
            }
            document.getElementById('registrationFee').textContent = fee.toLocaleString() + ' VND';
            document.getElementById('insuranceFee').textContent = insurance.toLocaleString() + ' VND';
            document.getElementById('negotiablePrice').textContent = nego.toLocaleString() + ' VND';
            document.getElementById('totalCost').textContent = (fee + insurance + nego).toLocaleString() + ' VND';
        });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.nav-detail ul li a');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
    // Set active on scroll to section
    window.addEventListener('scroll', function() {
        let fromTop = window.scrollY + 120;
        navLinks.forEach(link => {
            const section = document.querySelector(link.getAttribute('href'));
            if (section && section.offsetTop <= fromTop && section.offsetTop + section.offsetHeight > fromTop) {
                navLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            }
        });
    });
        });
    </script>

    <!-- Chat Popup AI -->
    <div id="chat-popup" class="chat-popup">
        <div class="chat-popup-header">
            <span class="chat-popup-title">Chat với nhân viên tư vấn</span>
            <button class="chat-popup-close" onclick="toggleChatPopup()">
                <i class="bi bi-x"></i>
            </button>
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
