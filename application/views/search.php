<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tìm kiếm - Evo Car</title>
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
</head>
<body>
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
                    <li><a href="#">Giới thiệu</a></li>
                    <li class="dropdown">
                        <a href="<?= site_url('products') ?>">Sản phẩm</a>
                        <div class="dropdown-menu">
                            <div class="dropdown-column">
                                <span class="column-title">Hatch Back</span>
                                <ul>
                                    <li><a href="#">Hyundai i10</a></li>
                                    <li><a href="#">KIA Morning</a></li>
                                    <li><a href="#">Chevrolet Spark</a></li>
                                    <li><a href="#">Mitsubishi Mirage</a></li>
                                    <li><a href="#">Suzuki Celerio</a></li>
                                    <li><a href="#">Ford Focus</a></li>
                                    <li><a href="#">Toyota Yaris</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title">Sedan</span>
                                <ul>
                                    <li><a href="#">Hyundai i10</a></li>
                                    <li><a href="#">KIA Morning</a></li>
                                    <li><a href="#">Chevrolet Spark</a></li>
                                    <li><a href="#">Mitsubishi Mirage</a></li>
                                    <li><a href="#">Suzuki Celerio</a></li>
                                    <li><a href="#">Ford Focus</a></li>
                                    <li><a href="#">Toyota Yaris</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title">Pick Up</span>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title">MPV</span>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title">SUV</span>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title">Crossover</span>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title">Coupe - Xe Thế Thao</span>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title">Convertible - Xe Mui Trần</span>
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
            <div class="header-controls">
                <div class="mobile-nav-toggle">☰</div>
                <div class="header-actions">
                    <a href="#" class="search-icon" title="Tìm kiếm"><i class="bi bi-search"></i></a>
                    <input type="text" class="header-search-input" placeholder="Tìm sản phẩm..."
                        style="display:none; position:absolute; right:60px; top:50%; transform:translateY(-50%); width:220px; padding:6px 12px; border:1px solid #ccc; border-radius:4px; z-index:2000; background:#fff; color:#222; font-size:15px;" />
                    
                    <?php if($this->session->userdata('logged_in')): ?>
                        <!-- User đã đăng nhập -->
                        <div class="user-dropdown">
                            <a href="#" class="user-icon" title="<?php echo $this->session->userdata('fullname'); ?>">
                                <i class="bi bi-person-circle"></i>
                                <span class="user-name"><?php echo $this->session->userdata('fullname'); ?></span>
                            </a>
                            <div class="user-dropdown-menu">
                                <a href="<?php echo base_url('profile'); ?>"><i class="bi bi-person me-2"></i>Hồ sơ</a>
                                <a href="<?php echo base_url('orders'); ?>"><i class="bi bi-bag me-2"></i>Đơn hàng</a>
                                <a href="<?php echo base_url('favorites'); ?>"><i class="bi bi-heart me-2"></i>Yêu thích</a>
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

    <!-- Nội dung tìm kiếm -->
    <section class="search-results" style="padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Kết quả tìm kiếm</h1>
                    <?php if(isset($query) && !empty($query)): ?>
                        <p>Tìm kiếm cho: <strong>"<?= htmlspecialchars($query) ?>"</strong></p>
                        <div class="alert alert-info">
                            <p>Chức năng tìm kiếm đang được phát triển. Vui lòng thử lại sau.</p>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <p>Vui lòng nhập từ khóa tìm kiếm.</p>
                        </div>
                    <?php endif; ?>
                    <div class="mt-4">
                        <a href="<?= site_url('') ?>" class="btn btn-primary">Về trang chủ</a>
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
                        <li><a href="#">Giới thiệu</a></li>
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
                        <li><a href="#">Giới thiệu</a></li>
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
</body>
</html> 
