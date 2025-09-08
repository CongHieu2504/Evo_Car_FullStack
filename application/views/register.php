<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Đăng ký lái thử - Evo Car</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicons -->
    <link href="/kholanh/assets/img/favicon.png" rel="icon">
    <link href="/kholanh/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="/kholanh/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/kholanh/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/kholanh/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/kholanh/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/kholanh/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!-- Main CSS File -->
    <link href="/kholanh/assets/css/main.css" rel="stylesheet">
    <link href="/kholanh/assets/css/register.css" rel="stylesheet">
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
                    <li><a href="<?= site_url() ?>">Trang chủ</a></li>
                    <li><a href="<?= site_url('gioi-thieu') ?>">Giới thiệu</a></li>
                    <li class="dropdown">
                        <a href="<?= site_url('products') ?>">Sản phẩm</a>
                        <div class="dropdown-menu">
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=1') ?>">HATCH BACK</a>
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
                                <a class="column-title" href="<?= site_url('products?cat=2') ?>">SEDAN</a>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=3') ?>">PICK UP</a>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=4') ?>">MPV</a>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=5') ?>">SUV</a>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=6') ?>">CROSSOVER</a>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=7') ?>">COUPE – XE THỂ THAO</a>
                            </div>
                            <div class="dropdown-column">
                                <a class="column-title" href="<?= site_url('products?cat=8') ?>">CONVERTIBLE – XE MUI TRẦN</a>
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
    <!-- Phần Đăng ký lái thử -->
    <section class="test-drive-section py-5">
        <div class="container">
            <h2 class="text-center mb-3 text-black">ĐĂNG KÝ LÁI THỬ</h2>
            <p class="text-center mb-5">
                Điền vào mẫu dưới đây và gửi yêu cầu của bạn. Đại lý Evo Car của chúng tôi sẽ liên hệ với bạn để xác
                nhận ngày và thời gian đăng ký lái thử của bạn.
            </p>
            <?php
            $show_testdrive_alert = false;
            if ($this->session->flashdata('testdrive_success') || $this->session->flashdata('testdrive_error')) {
                // Chỉ hiển thị nếu vừa submit form (POST) hoặc vừa redirect từ POST
                if ($_SERVER['REQUEST_METHOD'] === 'POST' || (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], site_url('dang-ky-lai-thu')) !== false)) {
                    $show_testdrive_alert = true;
                }
            }
            ?>
            <?php if($this->session->flashdata('testdrive_success')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('testdrive_success'); ?>
                    <?php $this->session->unset_userdata('testdrive_success'); ?>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('testdrive_error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('testdrive_error'); ?>
                    <?php $this->session->unset_userdata('testdrive_error'); ?>
                </div>
            <?php endif; ?>
            
            <!-- Hiển thị lỗi validation -->
            <?php if(validation_errors()): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>
            <form action="" method="post">
                <!-- Thông tin xe -->
                <div class="mb-4">
                    <h5>THÔNG TIN XE</h5>
                    <div class="form-group">
                        <label for="car-model">CHỌN DÒNG XE<span class="text-danger">*</span></label>
                        <select class="form-control" id="car-model" name="car_model" required>
                            <option value="">-- Chọn dòng xe --</option>
                            <option value="i10">Hyundai i10</option>
                            <option value="morning">KIA Morning</option>
                            <option value="focus">Ford Focus</option>
                            <option value="yaris">Toyota Yaris</option>
                        </select>
                    </div>
                </div>
                <!-- Thông tin liên hệ -->
                <div class="mb-4">
                    <h5>THÔNG TIN LIÊN HỆ</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">HỌ VÀ TÊN<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone">ĐIỆN THOẠI<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email">EMAIL<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập địa chỉ Email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="location">ĐĂNG KÝ LÁI THỬ TẠI<span class="text-danger">*</span></label>
                            <select class="form-control" id="location" name="location" required>
                                <option value="">-- Chọn đại lý --</option>
                                <option value="danang">Đà Nẵng</option>
                                <option value="hcm">Hồ Chí Minh</option>
                                <option value="hanoi">Hà Nội</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="message">NỘI DUNG</label>
                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Nội dung liên hệ"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark px-5 py-2">Gửi ĐĂNG KÝ</button>
                    </div>
                </div>
            </form>
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
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Sản phẩm</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Tin tức</a></li>
                        <li><a href="#">Đăng ký lái thử</a></li>
                        <li><a href="#">Đại lý</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Dịch vụ khách hàng</h4>
                    <ul>
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Sản phẩm</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Tin tức</a></li>
                        <li><a href="#">Đăng ký lái thử</a></li>
                        <li><a href="#">Đại lý</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>Đăng ký nhận tin</h4>
                    <p>Nhận thông tin sản phẩm mới nhất, tin khuyến mãi và nhiều hơn nữa.</p>
                    <form action="forms/newsletter.php" method="post" class="php-email-form">
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
    <!-- Vendor JS Files -->
    <script src="/kholanh/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/kholanh/assets/js/main.js"></script>
    <script src="/kholanh/assets/js/register.js"></script>
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
                    if (val) window.location.href = '<?= site_url('search') ?>' + '?query=' + encodeURIComponent(val);
                }
            });
            // Ẩn input khi blur
            searchInput.addEventListener('blur', function () {
                setTimeout(() => { searchInput.style.display = 'none'; }, 200);
            });
        }
    </script>
</body>
</html> 


