<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
        .btn-action {
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            margin: 2px;
            font-size: 12px;
        }
        .btn-edit {
            background: #28a745;
            color: white;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-view {
            background: #17a2b8;
            color: white;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-publish {
            background: #d4edda;
            color: #155724;
        }
        .status-draft {
            background: #f8d7da;
            color: #721c24;
        }
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
        
        /* Responsive Table Styles */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            max-width: 100%;
        }
        
        /* Action buttons container */
        .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            justify-content: center;
            min-width: 120px;
        }
        
        /* Enhanced button styles */
        .btn-action {
            padding: 8px 12px;
            font-size: 14px;
            min-width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-edit:hover { background: #218838; color: white; transform: scale(1.05); }
        .btn-delete:hover { background: #c82333; color: white; transform: scale(1.05); }
        .btn-view:hover { background: #138496; color: white; transform: scale(1.05); }
        
        /* Ensure table is scrollable if needed */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
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
            
            /* Table responsive for tablet */
            .table-responsive .table th,
            .table-responsive .table td {
                min-width: 80px;
                max-width: 150px;
                word-wrap: break-word;
            }
            
            .btn-action {
                padding: 6px 10px;
                font-size: 12px;
                min-width: 30px;
                height: 30px;
            }
            
            .action-buttons {
                min-width: 100px;
                gap: 3px;
            }
            
            .status-badge {
                padding: 3px 8px;
                font-size: 10px;
            }
        }
        
        @media (max-width: 576px) {
            /* Show all columns on mobile, just make them smaller */
            .table-responsive .table th,
            .table-responsive .table td {
                min-width: 60px;
                max-width: 120px;
                word-wrap: break-word;
                font-size: 10px;
                padding: 4px 2px;
            }
            
            .table-responsive .table th:first-child,
            .table-responsive .table td:first-child {
                min-width: 40px;
                max-width: 50px;
            }
            
            .table-responsive .table th:last-child,
            .table-responsive .table td:last-child {
                min-width: 100px;
                max-width: 120px;
            }
            
            .btn-action {
                padding: 4px 6px;
                font-size: 10px;
                min-width: 24px;
                height: 24px;
            }
            
            .action-buttons {
                min-width: 80px;
                gap: 2px;
            }
        }
            
            .stats-card {
                padding: 15px;
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
                            <a href="<?php echo base_url('admin'); ?>" class="nav-link">
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
                            <a href="<?php echo base_url('admin/news'); ?>" class="nav-link active">
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
                            <a href="#" class="nav-link">
                                <i class="fas fa-cog me-2"></i>
                                Cài đặt
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong>Administrator</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="<?php echo base_url(); ?>">Trang chủ</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('profile'); ?>">Hồ sơ</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2><i class="fas fa-newspaper me-2"></i>Quản lý Tin tức</h2>
                        <div>
                            <button class="btn btn-primary me-2" onclick="addNews()">
                                <i class="fas fa-plus me-1"></i>Thêm tin tức
                            </button>
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
                                        <h3><?php echo number_format($stats['total_news']); ?></h3>
                                        <p class="mb-0">Tổng Tin tức</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-newspaper fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card" style="background: linear-gradient(45deg, #28a745, #1e7e34);">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3><?php echo number_format($stats['published_news']); ?></h3>
                                        <p class="mb-0">Đã Publish</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card" style="background: linear-gradient(45deg, #ffc107, #e0a800);">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3><?php echo number_format($stats['draft_news']); ?></h3>
                                        <p class="mb-0">Draft</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-edit fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card" style="background: linear-gradient(45deg, #dc3545, #c82333);">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3><?php echo number_format($stats['new_news']); ?></h3>
                                        <p class="mb-0">Mới (7 ngày)</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-star fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- News Table -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Danh sách Tin tức</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="newsTable" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Hình ảnh</th>
                                        <th>Tiêu đề</th>
                                        <th>Mô tả</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($news as $item): ?>
                                    <tr>
                                        <td><?php echo $item->id; ?></td>
                                        <td>
                                            <?php if (!empty($item->featured_image)): ?>
                                                <img src="<?php echo $item->featured_image; ?>" class="product-image" alt="News">
                                            <?php else: ?>
                                                <img src="https://via.placeholder.com/50" class="product-image" alt="No Image">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $item->title; ?></td>
                                        <td><?php echo $item->description ?: 'Chưa có'; ?></td>
                                        <td>
                                            <?php if ($item->status == 'publish'): ?>
                                                <span class="status-badge status-publish">Đã Publish</span>
                                            <?php else: ?>
                                                <span class="status-badge status-draft">Draft</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo date('d/m/Y', $item->addtime); ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn-action btn-view" title="Xem chi tiết" onclick="viewNews(<?php echo $item->id; ?>)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn-action btn-edit" title="Chỉnh sửa" onclick="editNews(<?php echo $item->id; ?>)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn-action btn-delete" title="Xóa" onclick="deleteNews(<?php echo $item->id; ?>, '<?php echo $item->title; ?>')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xem chi tiết News -->
    <div class="modal fade" id="viewNewsModal" tabindex="-1" aria-labelledby="viewNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewNewsModalLabel">
                        <i class="fas fa-newspaper me-2"></i>Chi tiết Tin tức
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="viewNewsModalBody">
                    <!-- Nội dung sẽ được load bằng AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thêm News -->
    <div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewsModalLabel">
                        <i class="fas fa-plus me-2"></i>Thêm Tin tức mới
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addNewsForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add_title" class="form-label">Tiêu đề tin tức</label>
                            <input type="text" class="form-control" id="add_title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="add_description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="add_description" name="description" rows="3" placeholder="Nhập mô tả tin tức"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="add_status" class="form-label">Trạng thái</label>
                            <select class="form-select" id="add_status" name="status" required>
                                <option value="publish">Publish</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hình ảnh tin tức</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="add_image" class="form-label">Đường dẫn hình ảnh (tùy chọn)</label>
                                    <input type="text" class="form-control" id="add_image" name="image" placeholder="Nhập đường dẫn hình ảnh có sẵn">
                                    <small class="form-text text-muted">Ví dụ: /kholanh/assets/img/corolla.webp</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="add_image_file" class="form-label">Hoặc upload file mới</label>
                                    <input type="file" class="form-control" id="add_image_file" name="image_file" accept="image/*">
                                    <small class="form-text text-muted">Chọn file JPG, PNG, GIF, WEBP (tối đa 2MB) - Lưu vào assets/img</small>
                                </div>
                            </div>
                            <small class="form-text text-muted mt-2">* Bạn có thể để trống hình ảnh và thêm sau</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Thêm tin tức
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Sửa News -->
    <div class="modal fade" id="editNewsModal" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewsModalLabel">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa Tin tức
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editNewsForm">
                    <div class="modal-body" id="editNewsModalBody">
                        <!-- Form sẽ được load bằng AJAX -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
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
            
            // Initialize DataTable
            $('#newsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/vi.json'
                },
                pageLength: 10,
                order: [[0, 'desc']],
                responsive: true
            });
        });

        // Function thêm news
        function addNews() {
            $('#addNewsModal').modal('show');
        }

        // Function xem chi tiết news
        function viewNews(newsId) {
            $.ajax({
                url: '/kholanh/admin/news/view',
                type: 'POST',
                data: {news_id: newsId},
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#viewNewsModalBody').html(response.html);
                        $('#viewNewsModal').modal('show');
                    } else {
                        alert('Lỗi: ' + response.message);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải dữ liệu!');
                }
            });
        }

        // Function chỉnh sửa news
        function editNews(newsId) {
            $.ajax({
                url: '/kholanh/admin/news/edit',
                type: 'POST',
                data: {news_id: newsId},
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#editNewsModalBody').html(response.html);
                        $('#editNewsModal').modal('show');
                    } else {
                        alert('Lỗi: ' + response.message);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải dữ liệu!');
                }
            });
        }

        // Function xóa news
        function deleteNews(newsId, newsTitle) {
            if (confirm('Bạn có chắc chắn muốn xóa tin tức "' + newsTitle + '"?')) {
                $.ajax({
                    url: '/kholanh/admin/news/delete',
                    type: 'POST',
                    data: {news_id: newsId},
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert('Xóa tin tức thành công!');
                            location.reload();
                        } else {
                            alert('Lỗi: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi xóa tin tức!');
                    }
                });
            }
        }

        // Submit form thêm news
        $(document).on('submit', '#addNewsForm', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            
            $.ajax({
                url: '/kholanh/admin/news/add',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Thêm tin tức thành công!');
                        $('#addNewsModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Lỗi: ' + response.message);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi thêm tin tức!');
                }
            });
        });

        // Submit form chỉnh sửa news
        $(document).on('submit', '#editNewsForm', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            
            $.ajax({
                url: '/kholanh/admin/news/update',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Cập nhật tin tức thành công!');
                        $('#editNewsModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Lỗi: ' + response.message);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi cập nhật tin tức!');
                }
            });
        });
    </script>
</body>
</html> 