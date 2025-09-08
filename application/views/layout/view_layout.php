<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo isset($title) ? $title : 'Evo Car'; ?></title>
    <meta name="description" content="<?php echo isset($description) ? $description : ''; ?>">
    <meta name="keywords" content="<?php echo isset($keywords) ? $keywords : ''; ?>">

    <!-- Favicons -->
    <link href="<?php echo base_url('assets/img/favicon.png'); ?>" rel="icon">
    <link href="<?php echo base_url('assets/img/apple-touch-icon.png'); ?>" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <!-- GLightbox CSS -->
    <link href="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <?php if (isset($plugins_css) && is_array($plugins_css)): ?>
        <?php foreach ($plugins_css as $css): ?>
            <link href="<?php echo base_url('assets/' . $css['folder'] . '/' . $css['name'] . '.css'); ?>" rel="stylesheet">
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Main CSS File -->
    <link href="<?php echo base_url('assets/css/main.css'); ?>" rel="stylesheet">
</head>

<body>
    <?php
    // Map động ID danh mục theo tên để tránh sai lệch khi DB thay đổi
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
        // Xuất map cho JS dùng trong menu mobile
        echo '<script>window.CAT_IDS = ' . json_encode($CAT_IDS, JSON_UNESCAPED_UNICODE) . ';</script>';
    }
    ?>
    <!-- Header -->
    <header class="header">
        <div class="container-fluid">
            <div class="logo">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?= base_url('assets/img/logo.webp') ?>" alt="Logo">
                </a>
            </div>

            <!-- Navmenu cho desktop -->
            <nav class="navmenu">
                <ul>
                    <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
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
            
            <!-- Navmenu mới cho mobile -->
            <div class="modal-overlay" id="mobile-nav-modal">
                <div class="modal-content">
                    <button class="modal-close" id="modal-close">×</button>
                    <h3 class="modal-title">Menu</h3>
                    <nav class="modal-menu">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
                            <li><a href="<?php echo base_url('gioi-thieu'); ?>">Giới thiệu</a></li>
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
                        <!-- User đã đăng nhập -->
                        <?php 
                        $logged_in = $this->session->userdata('logged_in');
                        $full_name = is_array($logged_in) && isset($logged_in['full_name']) ? $logged_in['full_name'] : 'User';
                        // Debug: Kiểm tra session data
                        // echo '<pre>'; print_r($logged_in); echo '</pre>';
                        // echo 'Role: ' . (isset($logged_in['role']) ? $logged_in['role'] : 'NULL') . '<br>';
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

    <!-- Main Content -->
    <?php if (isset($banners) || isset($banner_titles)) { echo '<pre style="background:#fff;color:#000;z-index:99999;position:relative;">LAYOUT DEBUG\nBANNERS='; var_dump($banners); echo "\nBANNER_TITLES="; var_dump($banner_titles); echo '</pre>'; } ?>
    <?php if (isset($main_content)): ?>
        <?php $this->load->view($main_content); ?>
    <?php endif; ?>

    <!-- Footer -->
    <footer id="footer" class="footer">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="<?php echo base_url(); ?>" class="logo d-flex align-items-center">
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
                        <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
                        <li><a href="<?= site_url('gioi-thieu') ?>">Giới thiệu</a></li>
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
                        <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
                        <li><a href="<?= site_url('gioi-thieu') ?>">Giới thiệu</a></li>
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
                    <form action="<?php echo base_url('newsletter/subscribe'); ?>" method="post" class="php-email-form">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    
    <!-- GLightbox JS -->
    <script src="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js"></script>

    <!-- Vendor JS Files -->
    <?php if (isset($plugins_script) && is_array($plugins_script)): ?>
        <?php foreach ($plugins_script as $script): ?>
            <script src="<?php echo base_url('assets/' . $script['folder'] . '/' . $script['name'] . '.js'); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Main JS File (đảm bảo chỉ load 1 lần, sau Swiper) -->
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ép buộc khởi tạo Swiper cho mục Toyota
        if (typeof Swiper !== 'undefined') {
            var toyotaSwiper = new Swiper('.toyota-swiper', {
                slidesPerView: 4,
                spaceBetween: 24,
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    0: { slidesPerView: 1, spaceBetween: 10 },
                    576: { slidesPerView: 2, spaceBetween: 15 },
                    768: { slidesPerView: 3, spaceBetween: 20 },
                    992: { slidesPerView: 4, spaceBetween: 24 }
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                }
            });
            
            // Ép buộc update Swiper
            setTimeout(function() {
                toyotaSwiper.update();
                toyotaSwiper.updateSlides();
                toyotaSwiper.updateProgress();
                toyotaSwiper.updateSlidesClasses();
            }, 100);
        }
    });
    </script>

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
                    if (val) window.location.href = '<?php echo base_url("search"); ?>?query=' + encodeURIComponent(val);
                }
            });
            // Ẩn input khi blur
            searchInput.addEventListener('blur', function () {
                setTimeout(() => { searchInput.style.display = 'none'; }, 200);
            });
        }

        // Search button functionality
        const btnSearch = document.getElementById('btn-search');
        if (btnSearch) {
            btnSearch.onclick = function () {
                const keyword = document.getElementById('search-keyword') ? document.getElementById('search-keyword').value.trim() : '';
                const type = document.getElementById('search-type') ? document.getElementById('search-type').value : '';
                const brand = document.getElementById('search-brand') ? document.getElementById('search-brand').value : '';
                let query = '';
                if (keyword) query += 'q=' + encodeURIComponent(keyword);
                if (type && type !== 'all') query += (query ? '&' : '') + 'type=' + encodeURIComponent(type);
                if (brand && brand !== 'all') query += (query ? '&' : '') + 'brand=' + encodeURIComponent(brand);
                window.location.href = '<?php echo base_url("search"); ?>' + (query ? '?' + query : '');
            };
        }
    </script>
</body>

</html> 
