<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $title ?? 'Product Title' ?> - Evo Car</title>
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
    <link href="<?= base_url('assets/css/product-title.css') ?>" rel="stylesheet">
    <style>
        body { color: #000; background-color: #fff; }
        .product-detail h2, .product-detail p, .list-group-item h6, .list-group-item p { color: #000 !important; visibility: visible; }
        .product-title-section h4 { color: #000 !important; visibility: visible; border-bottom: 2px solid #000; }
        .product-detail h2#main-product-name { background-color: #fff; display: block !important; }
        .post-navigation { display: flex; justify-content: space-between; align-items: center; }
        .nav-label {
            max-width: 65%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <?php
    // Map động danh mục cho header trang product-title
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
                                <span class="column-title">HATCH BACK</span>
                                <ul>
                                    <li><a href="<?= site_url('products?cat=11') ?>">Hyundai i10</a></li>
                                    <li><a href="<?= site_url('products?cat=12') ?>">KIA Morning</a></li>
                                    <li><a href="<?= site_url('products?cat=13') ?>">Chevrolet Spark</a></li>
                                    <li><a href="<?= site_url('products?cat=14') ?>">Mitsubishi Mirage</a></li>
                                    <li><a href="<?= site_url('products?cat=15') ?>">Suzuki Celerio</a></li>
                                    <li><a href="<?= site_url('products?cat=16') ?>">Ford Focus</a></li>
                                    <li><a href="<?= site_url('products?cat=17') ?>">Toyota Yaris</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title"><a href="<?= site_url('products?cat=2') ?>">SEDAN</a></span>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title"><a href="<?= site_url('products?cat=' . (!empty($CAT_IDS['PICK UP']) ? $CAT_IDS['PICK UP'] : 3)) ?>">PICK UP</a></span>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title"><a href="<?= site_url('products?cat=' . (!empty($CAT_IDS['MPV']) ? $CAT_IDS['MPV'] : 4)) ?>">MPV</a></span>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title"><a href="<?= site_url('products?cat=' . (!empty($CAT_IDS['SUV']) ? $CAT_IDS['SUV'] : 5)) ?>">SUV</a></span>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title"><a href="<?= site_url('products?cat=6') ?>">CROSSOVER</a></span>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title"><a href="<?= site_url('products?cat=7') ?>">COUPE – XE THỂ THAO</a></span>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title"><a href="<?= site_url('products?cat=8') ?>">CONVERTIBLE – XE MUI TRẦN</a></span>
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

    <!-- Nội dung mới -->
    <section class="product-title-section py-5">
        <div class="container">
            <div class="row">
                <!-- CỘT TRÁI: NỘI DUNG CHI TIẾT -->
                <div class="col-lg-8">
                    <?php if (empty($products) || empty($products[0])): ?>
                        <div class="alert alert-warning">Không tìm thấy sản phẩm.</div>
                    <?php else: ?>
                        <?php $product = $products[0]; ?>
                        <div>
                            <h2 class="text-uppercase fw-bold mb-3 text-black" id="main-product-name"><?= htmlspecialchars($product['title'] ?? $product['name'] ?? 'Sản phẩm không tên') ?></h2>
                            <p class="text-muted mb-2">
                                <i class="bi bi-person-circle"></i> Tác giả: Evo Themes
                                <i class="bi bi-calendar3"></i> Ngày đăng: <?= isset($product['year']) ? htmlspecialchars($product['year']) : (isset($product['addtime']) ? date('Y', strtotime($product['addtime'])) : '2024') ?>
                            </p>
                            <div class="text-center mb-4">
                                <img id="main-product-image" src="<?= !empty($product['image']) ? $product['image'] : base_url('assets/img/placeholder.jpg') ?>" alt="<?= htmlspecialchars($product['title'] ?? $product['name'] ?? '') ?>" class="img-fluid">
                            </div>
                            <p class="text-justify">
                                <?= !empty($product['description']) ? htmlspecialchars($product['description']) : 'Mô tả sản phẩm đang được cập nhật...' ?>
                            </p>
                            <p class="text-justify">
                                <?= !empty($product['details']) ? htmlspecialchars($product['details']) : 'Thông tin chi tiết đang được cập nhật...' ?>
                            </p>
                            <?php if (!empty($product['price'])): ?><p class="text-danger fw-bold">Giá: <?= htmlspecialchars($product['price']) ?></p><?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- CỘT PHẢI: ĐỪNG BỎ LỠ -->
                <div class="col-lg-4">
                    <h4 class="mb-4 fw-bold border-bottom pb-2">Đừng bỏ lỡ</h4>
                    <div id="related-products" class="list-group">
                        <?php if (!empty($related_products)): $count = 0; foreach ($related_products as $related): if ($count++ >= 3) break; ?>
                        <a href="<?= site_url('product-title') ?>?id=<?= $related['id'] ?>" class="list-group-item list-group-item-action d-flex gap-3 align-items-start related-product">
                            <img src="<?= !empty($related['image']) ? $related['image'] : base_url('assets/img/placeholder.jpg') ?>" alt="<?= htmlspecialchars($related['title'] ?? $related['name'] ?? '') ?>" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-bold"><?= htmlspecialchars($related['title'] ?? $related['name'] ?? '') ?></h6>
                                <p class="mb-1 small text-muted"><?= isset($related['description']) ? mb_substr(strip_tags($related['description']), 0, 60) : '' ?>...</p>
                            </div>
                        </a>
                        <?php endforeach; endif; ?>
                    </div>
                    <div class="text-center mt-3">
                        <a href="<?= site_url('tin-tuc') ?>" class="text-decoration-none" style="color: #dc3545; font-weight: 500;">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Navigation và Comment Section -->
    <section class="comment-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Navigation Post -->
                    <div class="post-navigation bg-dark text-white p-3 mb-4 d-flex justify-content-between align-items-center">
                        <span class="nav-label" title="<?= htmlspecialchars($product['title'] ?? $product['name'] ?? '') ?>">Bạn đang xem: <?= htmlspecialchars($product['title'] ?? $product['name'] ?? '') ?></span>
                        <div class="nav-controls">
                            <?php if (!empty($prev_product)): ?>
                                <a class="btn btn-outline-light btn-sm me-2" href="<?= site_url('product-title?id=' . $prev_product['id']) ?>">
                                    <i class="bi bi-chevron-left"></i> Bài trước
                                </a>
                            <?php else: ?>
                                <button class="btn btn-outline-light btn-sm me-2" disabled><i class="bi bi-chevron-left"></i> Bài trước</button>
                            <?php endif; ?>
                            <?php if (!empty($next_product)): ?>
                                <a class="btn btn-outline-light btn-sm" href="<?= site_url('product-title?id=' . $next_product['id']) ?>">
                                    Bài sau <i class="bi bi-chevron-right"></i>
                                </a>
                            <?php else: ?>
                                <button class="btn btn-outline-light btn-sm" disabled>Bài sau <i class="bi bi-chevron-right"></i></button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- Comment Form -->
                    <div class="comment-form-container">
                        <?php if($this->session->flashdata('comment_success')): ?>
                            <div class="alert alert-success" role="alert">
                                <?= $this->session->flashdata('comment_success'); ?>
                                <?php $this->session->unset_userdata('comment_success'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('comment_error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $this->session->flashdata('comment_error'); ?>
                                <?php $this->session->unset_userdata('comment_error'); ?>
                            </div>
                        <?php endif; ?>
                        <h3 class="comment-title mb-4">VIẾT BÌNH LUẬN CỦA BẠN</h3>
                        <p class="comment-note mb-4">
                            Địa chỉ email của bạn sẽ được bảo mật. Các trường bắt buộc được đánh dấu <span class="text-danger">*</span>
                        </p>
                        <form class="comment-form" action="#" method="post">
                            <div class="form-group mb-4">
                                <label for="comment-content" class="form-label">Nội dung<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="comment-content" name="content" rows="6" placeholder="Nội dung" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="comment-name" class="form-label">Họ tên<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="comment-name" name="name" placeholder="Họ tên" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="comment-email" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="comment-email" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-comment-submit">GỬI BÌNH LUẬN</button>
                        </form>
                    </div>
                    <!-- Danh sách bình luận -->
                    <div class="comment-list mt-5">
                        <h4 class="mb-4">Bình luận gần đây</h4>
                        <?php if (!empty($comments)): ?>
                            <?php foreach ($comments as $cmt): ?>
                                <div class="comment-item mb-4 p-3 border rounded bg-light">
                                    <div class="d-flex align-items-center mb-2">
                                        <strong><?= htmlspecialchars($cmt['full_name']) ?></strong>
                                        <span class="text-muted ms-3" style="font-size:13px;">
                                            <?= date('d/m/Y H:i', $cmt['add_time']) ?>
                                        </span>
                                    </div>
                                    <div class="comment-content">
                                        <?= nl2br(htmlspecialchars($cmt['message'])) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-muted">Chưa có bình luận nào cho sản phẩm này.</div>
                        <?php endif; ?>
                    </div>
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

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
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
            searchInput.addEventListener('blur', function () {
                setTimeout(() => { searchInput.style.display = 'none'; }, 200);
            });
        }
    </script>
</body>
</html> 


