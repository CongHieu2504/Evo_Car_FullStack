<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Kết quả tìm kiếm - Evo Car</title>
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
    <style>
        .breadcrumb {
            margin-left: 32px;
        }
        @media (max-width: 576px) {
            .breadcrumb {
                margin-left: 10px;
            }
        }
        
        /* Card styling for consistent layout */
        .card.h-100 {
            transition: box-shadow 0.25s, transform 0.22s;
            height: 100% !important;
            display: flex;
            flex-direction: column;
        }
        
        .card.h-100:hover {
            box-shadow: 0 8px 32px rgba(44,62,80,0.18), 0 1.5px 6px rgba(44,62,80,0.10);
            transform: translateY(-6px) scale(1.03);
            z-index: 2;
            cursor: pointer;
        }
        
                 /* Product image styling */
         .card-img-top {
             width: 100% !important;
             height: 250px !important;
             object-fit: cover !important;
             object-position: center !important;
         }
        
        /* Card body styling */
        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 1rem;
        }
        
        /* Title styling */
        .card-title {
            font-size: 1.1rem !important;
            font-weight: 500 !important;
            color: #222 !important;
            min-height: 48px !important;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-bottom: 0.5rem !important;
        }
        
        /* Description styling */
        .card-text {
            font-size: 15px !important;
            color: #444 !important;
            min-height: 48px !important;
            margin-bottom: 0.5rem !important;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        
        /* Product info styling */
        .card-body > div {
            font-size: 14px !important;
            margin-bottom: 0.25rem !important;
        }
        
        .card-body > div:last-child {
            margin-bottom: 0 !important;
        }
        
        /* Price styling */
        .card-body > div:last-child {
            font-size: 15px !important;
            color: #c00 !important;
            font-weight: bold !important;
        }
        
                 /* Responsive adjustments */
         @media (max-width: 768px) {
             .card-img-top {
                 height: 220px !important;
             }
            
            .card-title {
                font-size: 1rem !important;
                min-height: 40px !important;
            }
            
            .card-text {
                font-size: 14px !important;
                min-height: 40px !important;
            }
        }
        
                 @media (max-width: 576px) {
             .card-img-top {
                 height: 300px !important;
             }
            
            .card-title {
                font-size: 0.95rem !important;
                min-height: 36px !important;
            }
            
            .card-text {
                font-size: 13px !important;
                min-height: 36px !important;
            }
        }
    </style>
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

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" style="background:transparent; margin-top: 24px;">
        <ol class="breadcrumb" style="font-size: 1.1rem;">
            <li class="breadcrumb-item"><a href="<?= site_url('') ?>">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kết quả tìm kiếm</li>
        </ol>
    </nav>
    <!-- Nội dung tìm kiếm -->
    <section class="search-results" style="padding: 0 0 50px 0;">
        <div class="container">
            <!-- Đã xóa breadcrumb ở đây để tránh trùng và lệch lề -->
            <div class="text-center mb-4">
                <span style="display:inline-block; background:#2563eb; color:#fff; font-size:2rem; font-weight:600; letter-spacing:1px; border-radius:8px; padding:8px 32px; margin-bottom:12px;">
                    CÓ <?= $total_products ?> KẾT QUẢ TÌM KIẾM PHÙ HỢP
                </span>
            </div>
            <?php if(isset($query) && !empty($query)): ?>
                <p class="mb-3 text-center">Tìm kiếm cho: <strong>"<?= htmlspecialchars($query) ?>"</strong></p>
            <?php endif; ?>
            <?php if (!empty($products)): ?>
                <div class="row justify-content-center">
                    <?php foreach ($products as $item): ?>
                        <div class="col-md-3 mb-4">
                            <div class="card h-100 position-relative">
                                <div class="product-quick-menu" style="position:absolute;top:8px;right:8px;z-index:2;cursor:pointer;">
                                    <span class="quick-menu-icon" title="Xem nhanh" data-product-id="search-<?= $item['id'] ?>" style="font-size:22px;color:#c00;text-shadow:0 1px 4px #fff,0 0 2px #c00;">&#9776;</span>
                                </div>
                                <a href="<?= site_url('product-detail?id=' . $item['id']) ?>">
                                    <img src="<?= !empty($item['image']) ? $item['image'] : (!empty($item['homeimgfile']) ? $item['homeimgfile'] : base_url('assets/img/no-image.png')) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['title']) ?>">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="<?= site_url('product-detail?id=' . $item['id']) ?>" class="text-dark">
                                            <?= htmlspecialchars($item['title']) ?>
                                        </a>
                                    </h5>
                                    <p class="card-text">
                                        <?= !empty($item['description']) ? htmlspecialchars($item['description']) : 'Chưa có mô tả.' ?>
                                    </p>
                                    <?php if (!empty($item['brand'])): ?>
                                        <div><strong>Hãng:</strong> <?= htmlspecialchars($item['brand']) ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($item['type'])): ?>
                                        <div><strong>Loại:</strong> <?= htmlspecialchars($item['type']) ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($item['price'])): ?>
                                        <div><strong>Giá:</strong> <?= htmlspecialchars($item['price']) ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="quick-info-box" id="quick-info-search-<?= $item['id'] ?>" style="display:none;position:absolute;top:40px;right:8px;background:#fff;border:1px solid #ccc;padding:12px;z-index:10;width:260px;box-shadow:0 2px 8px rgba(0,0,0,0.15);">
                                    <strong>Mô tả:</strong> <?= !empty($item['description']) ? htmlspecialchars($item['description']) : 'Chưa có mô tả.' ?><br>
                                    <?php if (!empty($item['price'])): ?>
                                        <strong>Giá:</strong> <?= htmlspecialchars($item['price']) ?> <br>
                                    <?php endif; ?>
                                    <button class="btn btn-sm btn-secondary mt-2 close-quick-info">Đóng</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">
                    <p>Không tìm thấy sản phẩm phù hợp.</p>
                </div>
            <?php endif; ?>

            <?php if (isset($total_pages) && $total_pages > 1): ?>
            <div class="pagination d-flex justify-content-center" style="margin: 32px 0;">
                <?php if ($current_page > 1): ?>
                    <a href="?<?php
                        $params = $_GET;
                        $params['page'] = $current_page - 1;
                        echo http_build_query($params);
                    ?>" class="btn btn-outline-primary">Trang trước</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?<?php
                        $params = $_GET;
                        $params['page'] = $i;
                        echo http_build_query($params);
                    ?>" class="btn btn<?php if ($i == $current_page) echo ' btn-primary'; else echo ' btn-outline-primary'; ?>" style="margin:0 2px;">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <a href="?<?php
                        $params = $_GET;
                        $params['page'] = $current_page + 1;
                        echo http_build_query($params);
                    ?>" class="btn btn-outline-primary">Trang sau</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="mt-4 text-center">
                <a href="<?= site_url('') ?>" class="btn btn-primary">Về trang chủ</a>
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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Quick info icon click cho trang search-new
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
    });
    </script>
</body>
</html> 