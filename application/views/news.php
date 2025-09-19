<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tin tức - Evo Car</title>
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
    <link href="/kholanh/assets/css/news.css" rel="stylesheet">
    
    <style>
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
    // Map động danh mục cho header trang news
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
    <!-- Breadcrumb -->
    <nav class="breadcrumb-section">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url() ?>">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('tin-tuc') ?>">Tin tức</a></li>
            </ol>
        </div>
    </nav>
    <!-- News Section -->
    <section class="news-section py-5">
        <div class="container">
            <h1 class="news-title text-center mb-5">Tin tức</h1>
            <!-- News Grid -->
            <div class="row" id="news-grid">
                <?php if (!empty($news)): ?>
                    <?php foreach ($news as $item): ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <a href="<?= site_url('product-title?id=' . $item['id']) ?>" style="text-decoration:none; color:inherit;">
                            <div class="news-item">
                                <img src="<?= htmlspecialchars($item['image'] ? $item['image'] : '/kholanh/assets/img/no-image.png') ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="news-image">
                                <div class="news-content">
                                    <h3 class="news-title-item"><?= htmlspecialchars($item['title']) ?></h3>
                                    <p class="news-excerpt"><?= htmlspecialchars($item['description']) ?></p>
                                    <div class="news-meta">
                                        <div class="news-date">
                                            <i class="bi bi-calendar3"></i>
                                            <span><?= date('d/m/Y', $item['addtime']) ?></span>
                                        </div>
                                        <div class="news-author">
                                            <i class="bi bi-person-circle"></i>
                                            <span>Evo Themes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12"><p>Không có tin tức nào.</p></div>
                <?php endif; ?>
            </div>
            <!-- Pagination -->
            <nav class="pagination-section mt-5">
                <ul class="pagination justify-content-center" id="pagination">
                    <?php if ($total_pages > 1): ?>
                        <!-- Previous button -->
                        <li class="page-item<?= $page <= 1 ? ' disabled' : '' ?>">
                            <a class="page-link" href="<?= ($page - 1) == 1 ? '/kholanh/news' : '?page=' . ($page - 1) ?>" tabindex="-1">
                                <i class="bi bi-chevron-left"></i>
                                <span class="page-text">Trước</span>
                            </a>
                        </li>
                        <!-- Page numbers -->
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item<?= $i == $page ? ' active' : '' ?>">
                                <a class="page-link" href="<?= $i == 1 ? '/kholanh/news' : '?page=' . $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <!-- Next button -->
                        <li class="page-item<?= $page >= $total_pages ? ' disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">
                                <span class="page-text">Sau</span>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
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
    <!-- <script src="/kholanh/assets/js/news.js"></script> -->
    <script>
        // Realtime: auto reload khi tập tin tức thay đổi
        (function(){
            var currentChecksum = '<?= isset($news_checksum) ? $news_checksum : '' ?>';
            var busy = false;
            var initialized = false;
            function check(){
                if(busy) return; busy = true;
                fetch('<?= base_url('home/check_news_updates') ?>?t=' + Date.now())
                    .then(r=>r.json())
                    .then(data=>{
                        if(!data || !data.checksum){ return; }
                        if(!initialized){
                            // Lần đầu đồng bộ checksum từ server để tránh reload vòng lặp
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


