<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 10px 20px;
        }
        .sidebar .nav-link:hover {
            background: #495057;
        }
        .sidebar .nav-link.active {
            background: #007bff;
        }
        .main-content {
            padding: 20px;
        }
        .stats-card {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: #007bff;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        /* Mobile optimizations */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                width: 280px;
                max-width: 80vw;
                z-index: 1000;
                transition: left 0.3s ease;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 10px;
            }
            
            .sidebar-overlay.show {
                display: block;
            }
            
            .stats-card {
                padding: 15px;
                margin-bottom: 15px;
            }
        }
        
        @media (max-width: 576px) {
            .stats-card {
                padding: 10px;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Mobile Menu Toggle -->
            <div class="d-lg-none w-100 mb-3">
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="fas fa-bars me-2"></i>Menu
                </button>
            </div>
            
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar" id="sidebar">
                <div class="d-flex flex-column p-3">
                    <h4 class="text-white mb-4">Admin Panel</h4>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin'); ?>" class="nav-link active">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/users'); ?>" class="nav-link">
                                <i class="fas fa-users me-2"></i>
                                Quản lý User
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/products'); ?>" class="nav-link">
                                <i class="fas fa-car me-2"></i>
                                Quản lý Sản phẩm
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/news'); ?>" class="nav-link">
                                <i class="fas fa-newspaper me-2"></i>
                                Quản lý Tin tức
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/admin_stock_products'); ?>" class="nav-link">
                                <i class="fas fa-warehouse me-2"></i>
                                Quản lý sản phẩm kho
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/settings'); ?>" class="nav-link">
                                <i class="fas fa-cog me-2"></i>
                                Cài đặt
                            </a>
                        </li>
                    </ul>
                    <hr class="text-white">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong><?php echo $user['full_name']; ?></strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="<?php echo base_url(); ?>">Trang chủ</a></li>
                            <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h2>
                        <div>
                            <button class="btn btn-outline-secondary me-2">Export</button>
                            <button class="btn btn-outline-secondary">Print</button>
                        </div>
                    </div>

                <!-- Stats Cards -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3><?php echo number_format($stats['total_users']); ?></h3>
                                    <p class="mb-0">Tổng User</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card" style="background: linear-gradient(45deg, #28a745, #1e7e34);">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3><?php echo number_format($stats['total_products']); ?></h3>
                                    <p class="mb-0">Sản phẩm</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-car fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card" style="background: linear-gradient(45deg, #ffc107, #e0a800);">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3><?php echo number_format($stats['total_news']); ?></h3>
                                    <p class="mb-0">Tin tức</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-newspaper fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card" style="background: linear-gradient(45deg, #6f42c1, #593196);">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3><?php echo number_format($stats['total_stock_products']); ?></h3>
                                    <p class="mb-0">Sản phẩm kho</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-warehouse fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Hoạt động gần đây</h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <?php if (!empty($recent_activities)): ?>
                                        <?php foreach ($recent_activities as $activity): ?>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1"><?php echo $activity['title']; ?></h6>
                                                <small class="text-muted"><?php echo $activity['description']; ?></small>
                                            </div>
                                            <span class="badge bg-<?php echo $activity['badge']; ?> rounded-pill"><?php echo $activity['time']; ?></span>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="list-group-item text-center text-muted">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Chưa có hoạt động nào gần đây
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Thống kê nhanh</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            // Mobile menu toggle
            $('#mobileMenuToggle').click(function() {
                $('#sidebar').toggleClass('show');
                $('#sidebarOverlay').toggleClass('show');
            });
            
            // Close sidebar when clicking overlay
            $('#sidebarOverlay').click(function() {
                $('#sidebar').removeClass('show');
                $('#sidebarOverlay').removeClass('show');
            });
            
            // Close sidebar when clicking outside on mobile
            $(document).on('click', function(e) {
                if ($(window).width() <= 768) {
                    if (!$(e.target).closest('#sidebar, #mobileMenuToggle').length) {
                        $('#sidebar').removeClass('show');
                        $('#sidebarOverlay').removeClass('show');
                    }
                }
            });
            
            // Handle window resize
            $(window).resize(function() {
                if ($(window).width() > 768) {
                    $('#sidebar').removeClass('show');
                    $('#sidebarOverlay').removeClass('show');
                }
            });
            
            // Add smooth scrolling to sidebar links
            $('.sidebar .nav-link').click(function() {
                if ($(window).width() <= 768) {
                    setTimeout(function() {
                        $('#sidebar').removeClass('show');
                        $('#sidebarOverlay').removeClass('show');
                    }, 300);
                }
            });
        });
        
        // Chart với dữ liệu thật từ PHP
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Users', 'Products', 'News', 'Orders'],
                datasets: [{
                    data: [
                        <?php echo $stats['total_users']; ?>,
                        <?php echo $stats['total_products']; ?>,
                        <?php echo $stats['total_news']; ?>,
                        <?php echo $stats['total_orders']; ?>
                    ],
                    backgroundColor: [
                        '#007bff',
                        '#28a745',
                        '#ffc107',
                        '#dc3545'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html> 