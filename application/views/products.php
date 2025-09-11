<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tất cả sản phẩm - Evo Car</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/main.css?v=' . @filemtime(FCPATH . 'assets/css/main.css')) ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/products.css?v=' . @filemtime(FCPATH . 'assets/css/products.css')) ?>" rel="stylesheet">
    <style>
        html, body { height: 100%; }
        body { min-height: 100vh; display: flex; flex-direction: column; }
        .main-flex { flex: 1 0 auto; display: flex; flex-direction: column; }
        .footer { flex-shrink: 0; }
        .sidebar-menu,
        .sidebar-menu ul {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }
        .sidebar-menu > li {
            padding-left: 0;
            margin-bottom: 2px;
        }
        .sidebar-menu .has-submenu > .toggle-icon {
            margin-right: 4px;
            font-weight: bold;
            display: inline-block;
            width: 16px;
            text-align: center;
        }
        .sidebar-menu li > a {
            display: inline-block;
            padding: 2px 0 2px 0;
            text-decoration: none;
            color: #222;
            vertical-align: middle;
        }
        .sidebar-menu .submenu {
            padding-left: 18px;
            border-left: 1px dotted #eee;
            margin-left: 6px;
        }
        .sidebar-menu .submenu li {
            position: relative;
            padding-left: 12px;
            margin-bottom: 2px;
        }
        .sidebar-menu .submenu li:before {
            content: '\2022';
            position: absolute;
            left: 0;
            color: #888;
            font-size: 13px;
            top: 6px;
        }
        .sidebar-menu .submenu li > a {
            padding-left: 0;
        }
        .sidebar-menu li.active > a {
            font-weight: bold;
            color: #d00;
        }
        
        /* Điều chỉnh khoảng cách breadcrumb */
        .breadcrumb-section {
            padding: 20px 0;
        }
        
        /* Hover effects cho breadcrumb */
        .breadcrumb-item a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .breadcrumb-item a:hover {
            color: #007bff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    // Map động danh mục cho header trong trang products
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
    <!-- Breadcrumb -->
    <nav class="breadcrumb-section">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url() ?>">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('products') ?>">Tất cả sản phẩm</a></li>
            </ol>
        </div>
    </nav>
    <!-- Main Content -->
    <section class="products-section py-5 main-flex">
        <div class="container">
            <div class="row">
                <!-- Sidebar Danh mục và Bộ lọc -->
                <aside class="col-lg-3 mb-4">
                    <div class="sidebar-box mb-4">
                        <h5 class="sidebar-title">DANH MỤC</h5>
                        <ul class="sidebar-menu">
                            <li><a href="<?= site_url() ?>">Trang chủ</a></li>
                            <li><a href="<?= site_url('gioi-thieu') ?>">Giới thiệu</a></li>
                            <li class="has-submenu">
                                <span class="toggle-icon" style="cursor:pointer;">+</span>
                                <a href="<?= site_url('products') ?>">Sản phẩm</a>
                                <ul class="submenu" style="display:none;">
                                    <?php
                                    if (!empty($cat_tree)) {
                                        echo renderSidebarCategory($cat_tree, 0, $cat, $_GET);
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li><a href="<?= site_url('lien-he-moi') ?>">Liên hệ</a></li>
                            <li class="has-submenu">
                                <span class="toggle-icon" style="cursor:pointer;">+</span>
                                <a href="<?= site_url('tin-tuc') ?>">Tin tức</a>
                                <ul class="submenu" style="display:none;">
                                    <li><a href="#">Mua xe</a></li>
                                    <li><a href="#">Lái xe</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= site_url('register') ?>">Đăng ký lái thử</a></li>
                            <li><a href="<?= site_url('dai-ly') ?>">Đại lý</a></li>
                        </ul>
                    </div>
                    <script>
                    (function() {
                        function bindSidebarToggles() {
                            var productToggle = document.querySelector('.product-toggle');
                            var productModels = document.querySelector('.product-models');
                            if (productToggle && productModels) {
                                productToggle.onclick = function(e) {
                                    var isOpen = productModels.style.display === 'block';
                                    productModels.style.display = isOpen ? 'none' : 'block';
                                    productToggle.textContent = isOpen ? '+' : '-';
                                };
                            }
                            var hatchToggle = document.querySelector('.hatchback-toggle');
                            var hatchModels = document.querySelector('.hatchback-models');
                            if (hatchToggle && hatchModels) {
                                hatchToggle.onclick = function(e) {
                                    var isOpen = hatchModels.style.display === 'block';
                                    hatchModels.style.display = isOpen ? 'none' : 'block';
                                    hatchToggle.textContent = isOpen ? '+' : '-';
                                };
                            }
                            var newsToggle = document.querySelector('.news-toggle');
                            var newsModels = document.querySelector('.news-models');
                            if (newsToggle && newsModels) {
                                newsToggle.onclick = function(e) {
                                    var isOpen = newsModels.style.display === 'block';
                                    newsModels.style.display = isOpen ? 'none' : 'block';
                                    newsToggle.textContent = isOpen ? '+' : '-';
                                };
                            }
                        }
                        if (document.readyState === 'loading') {
                            document.addEventListener('DOMContentLoaded', bindSidebarToggles);
                        } else {
                            bindSidebarToggles();
                        }
                    })();
                    </script>
                    <div class="sidebar-box mb-4">
                        <h5 class="sidebar-title">TÌM THEO</h5>
                        <form id="filterForm" method="get" action="">
                            <div class="mb-3">
                                <strong>Thương hiệu</strong>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="brand" id="brand-mitsubishi" value="Mitsubishi" <?= ($brand=='Mitsubishi')?'checked':'' ?>>
                                    <label class="form-check-label" for="brand-mitsubishi">Mitsubishi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="brand" id="brand-mazda" value="Mazda" <?= ($brand=='Mazda')?'checked':'' ?>>
                                    <label class="form-check-label" for="brand-mazda">Mazda</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="brand" id="brand-toyota" value="Toyota" <?= ($brand=='Toyota')?'checked':'' ?>>
                                    <label class="form-check-label" for="brand-toyota">Toyota</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="brand" id="brand-all" value="" <?= (empty($brand))?'checked':'' ?>>
                                    <label class="form-check-label" for="brand-all">Tất cả</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <strong>Loại</strong>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="type-suv" value="SUV" <?= ($type=='SUV')?'checked':'' ?>>
                                    <label class="form-check-label" for="type-suv">SUV</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="type-sedan" value="Sedan" <?= ($type=='Sedan')?'checked':'' ?>>
                                    <label class="form-check-label" for="type-sedan">Sedan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="type-mpv" value="MPV" <?= ($type=='MPV')?'checked':'' ?>>
                                    <label class="form-check-label" for="type-mpv">MPV</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="type-hatchback" value="Hatch Back" <?= ($type=='Hatch Back')?'checked':'' ?>>
                                    <label class="form-check-label" for="type-hatchback">Hatch Back</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="type-all" value="" <?= (empty($type))?'checked':'' ?>>
                                    <label class="form-check-label" for="type-all">Tất cả</label>
                                </div>
                            </div>
                            <div class="sort-group d-flex align-items-center flex-wrap mb-3">
                                <span class="me-2">Xếp theo:</span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sort" id="sort-az" value="az" <?= ($sort=='az'||empty($sort))?'checked':'' ?>>
                                    <label class="form-check-label" for="sort-az">Tên A-Z</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sort" id="sort-za" value="za" <?= ($sort=='za')?'checked':'' ?>>
                                    <label class="form-check-label" for="sort-za">Tên Z-A</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </aside>
                <!-- Main Content: Sản phẩm -->
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                        <h2 class="section-title mb-0">TẤT CẢ SẢN PHẨM</h2>
                    </div>
                    <div class="row" id="products-grid">
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $item): ?>
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card product-card h-100">
                                        <a href="<?= site_url('products/detail/' . $item['id']) ?>">
                                            <img src="<?= !empty($item['homeimgfile']) ? (strpos($item['homeimgfile'], '/') === 0 ? $item['homeimgfile'] : base_url('assets/img/' . $item['homeimgfile'])) : base_url('assets/img/no-image.png') ?>" class="card-img-top product-image" alt="<?= htmlspecialchars($item['title']) ?>">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title product-title">
                                                <a href="<?= site_url('products/detail/' . $item['id']) ?>"><?= htmlspecialchars($item['title']) ?></a>
                                            </h5>
                                            <p class="card-text product-excerpt"><?= htmlspecialchars($item['hometext']) ?></p>
                                            <?php if (!empty($item['price'])): ?>
                                                <div class="product-card-price mb-2">
                                                    Giá: <span class="text-danger fw-bold"><?= number_format($item['price']) ?> VNĐ</span>
                                                </div>
                                            <?php endif; ?>
                                            <div class="product-meta d-flex justify-content-between align-items-center mt-2">
                                                <?php $ts = isset($item['created']) ? $item['created'] : (isset($item['addtime']) ? $item['addtime'] : null); ?>
                                                <span class="product-date"><i class="bi bi-calendar3"></i> <?= $ts ? date('d/m/Y', $ts) : '' ?></span>
                                            </div>
                                            <button class="btn btn-danger btn-sm mt-3 w-100">Mua ngay</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12 text-center py-5">
                                <div class="no-products-message">
                                    <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                                    <h4 class="text-dark mb-2">Không có sản phẩm nào</h4>
                                    <p class="text-muted">Vui lòng thử lại với bộ lọc khác hoặc quay lại trang chủ.</p>
                                    <a href="<?= site_url('products') ?>" class="btn btn-primary mt-3">Xem tất cả sản phẩm</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <nav class="pagination-section mt-4">
                        <ul class="pagination justify-content-center" id="pagination">
                            <?php
                            $total_pages = ceil($total_products / $limit);
                            if ($total_pages > 1) {
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    $active = ($i == $page) ? 'active' : '';
                                    // Giữ lại các filter/sort khi chuyển trang
                                    $query = http_build_query(array_merge($_GET, ['page' => $i]));
                                    echo '<li class="page-item ' . $active . '"><a class="page-link" href="?' . $query . '">' . $i . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer id="footer" class="footer">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="<?= site_url() ?>" class="logo d-flex align-items-center">
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
                        <li><a href="<?= site_url() ?>">Trang chủ</a></li>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="<?= site_url('products') ?>">Sản phẩm</a></li>
                        <li><a href="<?= site_url('lien-he-moi') ?>">Liên hệ</a></li>
                        <li><a href="<?= site_url('tin-tuc') ?>">Tin tức</a></li>
                        <li><a href="<?= site_url('dang-ky-lai-thu') ?>">Đăng ký lái thử</a></li>
                        <li><a href="<?= site_url('dai-ly') ?>">Đại lý</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Dịch vụ khách hàng</h4>
                    <ul>
                        <li><a href="<?= site_url() ?>">Trang chủ</a></li>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="<?= site_url('products') ?>">Sản phẩm</a></li>
                        <li><a href="<?= site_url('lien-he-moi') ?>">Liên hệ</a></li>
                        <li><a href="<?= site_url('tin-tuc') ?>">Tin tức</a></li>
                        <li><a href="<?= site_url('dang-ky-lai-thu') ?>">Đăng ký lái thử</a></li>
                        <li><a href="<?= site_url('dai-ly') ?>">Đại lý</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>Đăng ký nhận tin</h4>
                    <p>Nhận thông tin sản phẩm mới nhất, tin khuyến mãi và nhiều hơn nữa.</p>
                    <form action="#" method="post" class="php-email-form">
                        <div class="newsletter-form"><input type="email" name="email"><input type="submit"
                                value="Subscribe"></div>
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Evo car</strong> <span>All Rights Reserved</span>
            </p>
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
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/products.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
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
        // Tự động submit form khi chọn filter/sort
        document.querySelectorAll('#filterForm input').forEach(function(el) {
            el.addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        });
    </script>
    <script>
    // Realtime: tự reload trang Sản phẩm khi danh sách shops_rows (status=1) thay đổi
    (function(){
        var currentChecksum = '<?= isset($products_checksum) ? $products_checksum : '' ?>';
        var initialized = false;
        var busy = false;
        function check(){
            if(busy) return; busy = true;
            fetch('<?= base_url('home/check_products_page_updates') ?>?t=' + Date.now())
                .then(r=>r.json())
                .then(data=>{
                    if(!data || !data.checksum) return;
                    if(!initialized){
                        // Đồng bộ lần đầu để tránh reload vòng lặp nếu có lệch checksum ban đầu
                        currentChecksum = data.checksum;
                        initialized = true;
                        return;
                    }
                    if(currentChecksum && data.checksum && data.checksum !== currentChecksum){
                        location.reload();
                    }
                })
                .catch(()=>{})
                .finally(()=>{ busy = false; });
        }
        setInterval(check, 1000);
        setTimeout(check, 1000);
    })();
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      var newsMenu = document.querySelector('.sidebar-box .news-dropdown-link');
      var newsSubmenu = document.querySelector('.sidebar-box .news-submenu');
      var submenuOpen = false;
      if (newsMenu && newsSubmenu) {
        newsMenu.addEventListener('click', function(e) {
          e.preventDefault();
          if (!submenuOpen) {
            newsSubmenu.style.display = 'block';
            submenuOpen = true;
          } else {
            window.location.href = '/kholanh/tin-tuc';
          }
        });
        document.addEventListener('click', function(e) {
          if (!newsMenu.contains(e.target) && !newsSubmenu.contains(e.target)) {
            newsSubmenu.style.display = 'none';
            submenuOpen = false;
          }
        });
      }
    });
    </script>
    <script>
    // Toggle model list khi click vào loại xe
    const typeToggles = document.querySelectorAll('.type-toggle');
    typeToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const modelList = this.parentElement.querySelector('.model-list');
            if (modelList) {
                modelList.style.display = (modelList.style.display === 'none' || modelList.style.display === '') ? 'block' : 'none';
            }
        });
    });
    </script>
</body>
</html> 

<?php
function renderSidebarCategory($cat_tree, $parent = 0, $cat_selected = 0, $query = []) {
    if (empty($cat_tree[$parent])) return '';
    $html = '';
    foreach ($cat_tree[$parent] as $cat) {
        $is_hatchback = (strtolower($cat['name']) === 'hatch back');
        $has_sub = $is_hatchback && !empty($cat_tree[$cat['id']]);
        $is_active = ($cat_selected == $cat['id']);
        $li_class = $has_sub ? 'has-submenu' : '';
        if ($is_active) $li_class .= ' active';
        $html .= '<li class="' . trim($li_class) . '">';
        // Tất cả mục cha và con đều truyền cat=id
        $query2 = $query;
        $query2['cat'] = $cat['id'];
        unset($query2['type']);
        $url = '?' . http_build_query($query2);
        if ($has_sub) {
            $html .= '<span class="toggle-icon" style="cursor:pointer;">+</span> ';
        } else {
            $html .= '<span style="display:inline-block;width:16px;"></span> ';
        }
        $html .= '<a href="' . $url . '">' . htmlspecialchars($cat['name']) . '</a>';
        if ($has_sub) {
            $html .= '<ul class="submenu" style="display:none;">';
            $html .= renderSidebarCategory($cat_tree, $cat['id'], $cat_selected, $query);
            $html .= '</ul>';
        }
        $html .= '</li>';
    }
    return $html;
}
?> 


