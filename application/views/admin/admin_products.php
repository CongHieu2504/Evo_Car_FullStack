<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
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
            padding: 8px 12px;
            border-radius: 5px;
            border: none;
            margin: 2px;
            font-size: 14px;
            min-width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-edit {
            background: #28a745;
            color: white;
        }
        .btn-edit:hover {
            background: #218838;
            color: white;
            transform: scale(1.05);
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background: #c82333;
            color: white;
            transform: scale(1.05);
        }
        .btn-view {
            background: #17a2b8;
            color: white;
        }
        .btn-view:hover {
            background: #138496;
            color: white;
            transform: scale(1.05);
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
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .main-content {
                padding: 10px;
            }
            
            /* Show all columns on tablet, just make them smaller */
            .table-responsive .table th,
            .table-responsive .table td {
                min-width: 80px;
                max-width: 150px;
                word-wrap: break-word;
            }
            
            .stats-card {
                padding: 15px;
                margin-bottom: 15px;
            }
            
            .stats-card h3 {
                font-size: 1.5rem;
            }
            
            .stats-card p {
                font-size: 0.9rem;
            }
            
            .btn-action {
                padding: 8px 12px;
                font-size: 14px;
                margin: 1px;
                min-width: 32px;
                height: 32px;
            }
            
            .action-buttons {
                min-width: 110px;
            }
            
                    .table-responsive {
            font-size: 12px;
            overflow-x: auto;
            max-width: 100%;
        }
            
            .table th,
            .table td {
                padding: 8px 4px;
                vertical-align: middle;
            }
            
            .product-image {
                width: 40px;
                height: 40px;
                object-fit: cover;
                border-radius: 4px;
            }
            
            .status-badge {
                padding: 4px 8px;
                font-size: 10px;
            }
            
            .modal-body {
                padding: 15px;
            }
            
            .form-label {
                font-size: 14px;
            }
            
            .form-control,
            .form-select {
                font-size: 14px;
                padding: 8px 12px;
            }
        }
        
        @media (max-width: 576px) {
            .main-content {
                padding: 5px;
            }
            
            .stats-card {
                padding: 10px;
                margin-bottom: 10px;
            }
            
            .stats-card h3 {
                font-size: 1.2rem;
            }
            
            .stats-card p {
                font-size: 0.8rem;
            }
            
            .btn-action {
                padding: 6px 8px;
                font-size: 12px;
                min-width: 28px;
                height: 28px;
            }
            
            .action-buttons {
                min-width: 100px;
                gap: 3px;
            }
            
            .table-responsive {
                font-size: 11px;
                overflow-x: auto;
                max-width: 100%;
            }
            
            .table th,
            .table td {
                padding: 6px 2px;
            }
            
            .product-image {
                width: 30px;
                height: 30px;
            }
            
            .status-badge {
                padding: 3px 6px;
                font-size: 9px;
            }
            
            .modal-body {
                padding: 10px;
            }
            
            .form-label {
                font-size: 13px;
            }
            
            .form-control,
            .form-select {
                font-size: 13px;
                padding: 6px 10px;
            }
            
            /* Show all columns on mobile, just make them smaller */
            .table-responsive .table th,
            .table-responsive .table td {
                min-width: 60px;
                max-width: 120px;
                word-wrap: break-word;
                font-size: 10px;
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
        }
        
        /* Action buttons container */
        .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            justify-content: center;
            min-width: 120px;
        }
        
        /* Ensure icons are visible */
        .btn-action i {
            font-size: inherit;
            display: inline-block;
        }
        
        /* Mobile specific button styles */
        @media (max-width: 768px) {
            .btn-action {
                min-width: 30px !important;
                height: 30px !important;
                padding: 4px 6px !important;
                font-size: 12px !important;
            }
            
            .btn-action i {
                font-size: 12px !important;
            }
            
            .action-buttons {
                min-width: 100px;
                gap: 3px;
            }
        }
        
        /* Ensure table is scrollable */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Keep table layout on mobile, just make it scrollable */
        @media (max-width: 480px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .table-responsive .table {
                min-width: 800px;
            }
            
            .table-responsive .table th,
            .table-responsive .table td {
                min-width: 50px;
                max-width: 100px;
                word-wrap: break-word;
                font-size: 9px;
                padding: 4px 2px;
            }
            
            .table-responsive .table th:first-child,
            .table-responsive .table td:first-child {
                min-width: 30px;
                max-width: 40px;
            }
            
            .table-responsive .table th:last-child,
            .table-responsive .table td:last-child {
                min-width: 90px;
                max-width: 100px;
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
            width: 100%;
        }
        
        /* Ensure table has minimum width on mobile */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            #productsTable {
                min-width: 900px !important;
                width: 100% !important;
            }
            
            .table th,
            .table td {
                white-space: nowrap;
                min-width: auto;
            }
            
            /* Ensure all columns are visible */
            .table th,
            .table td {
                display: table-cell !important;
            }
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
            
            .btn-action {
                padding: 4px 8px;
                font-size: 11px;
                margin: 1px;
            }
            
            .status-badge {
                padding: 3px 8px;
                font-size: 10px;
            }
        }
        
        @media (max-width: 576px) {
            .btn-action {
                padding: 3px 6px;
                font-size: 10px;
            }
            
            .stats-card {
                padding: 15px;
                margin-bottom: 10px;
            }
        }
        
        /* Fix cho cột mô tả dài - word wrapping */
        .table td[data-label="Mô tả"] {
            word-wrap: break-word !important;
            word-break: break-word !important;
            overflow-wrap: break-word !important;
            max-width: 200px !important;
            white-space: normal !important;
            line-height: 1.4 !important;
            text-align: justify !important;
        }
        
        /* Đảm bảo tất cả các cột đều có word wrapping */
        .table td {
            word-wrap: break-word !important;
            word-break: break-word !important;
            overflow-wrap: break-word !important;
            white-space: normal !important;
        }
        
        /* Responsive cho cột mô tả */
        @media (max-width: 768px) {
            .table td[data-label="Mô tả"] {
                max-width: 150px !important;
                font-size: 12px !important;
                line-height: 1.3 !important;
            }
        }
        
        @media (max-width: 576px) {
            .table td[data-label="Mô tả"] {
                max-width: 120px !important;
                font-size: 11px !important;
                line-height: 1.2 !important;
            }
        }
        
        /* Đảm bảo tất cả cột hiển thị trên mobile */
        .never-hide {
            display: table-cell !important;
        }
        
        /* Responsive cho tất cả breakpoints */
        @media (max-width: 1200px) {
            .table th, .table td {
                padding: 8px 6px !important;
                font-size: 13px !important;
            }
        }
        
        @media (max-width: 992px) {
            .table th, .table td {
                padding: 6px 4px !important;
                font-size: 12px !important;
            }
            
            .btn-action {
                padding: 6px 8px !important;
                font-size: 11px !important;
                min-width: 30px !important;
                height: 30px !important;
            }
        }
        
        @media (max-width: 768px) {
            .table th, .table td {
                padding: 5px 3px !important;
                font-size: 11px !important;
            }
            
            .btn-action {
                padding: 4px 6px !important;
                font-size: 10px !important;
                min-width: 28px !important;
                height: 28px !important;
            }
            
            .product-image {
                width: 35px !important;
                height: 35px !important;
            }
        }
        
        @media (max-width: 576px) {
            .table th, .table td {
                padding: 4px 2px !important;
                font-size: 10px !important;
            }
            
            .btn-action {
                padding: 3px 5px !important;
                font-size: 9px !important;
                min-width: 25px !important;
                height: 25px !important;
            }
            
            .product-image {
                width: 30px !important;
                height: 30px !important;
            }
            
            .status-badge {
                padding: 2px 6px !important;
                font-size: 9px !important;
            }
        }
        
        @media (max-width: 480px) {
            .table th, .table td {
                padding: 3px 1px !important;
                font-size: 9px !important;
            }
            
            .btn-action {
                padding: 2px 4px !important;
                font-size: 8px !important;
                min-width: 22px !important;
                height: 22px !important;
            }
            
            .product-image {
                width: 25px !important;
                height: 25px !important;
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
                            <a href="<?php echo base_url('admin/products'); ?>" class="nav-link active">
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
                        <h2><i class="fas fa-car me-2"></i>Quản lý Sản phẩm</h2>
                        <div>
                            <button class="btn btn-primary me-2" onclick="addProduct()">
                                <i class="fas fa-plus me-1"></i>Thêm sản phẩm
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
                                    <h3><?php echo number_format($stats['total_products']); ?></h3>
                                    <p class="mb-0">Tổng Sản phẩm</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-car fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card" style="background: linear-gradient(45deg, #28a745, #1e7e34);">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3><?php echo number_format($stats['published_products']); ?></h3>
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
                                    <h3><?php echo number_format($stats['draft_products']); ?></h3>
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
                                    <h3><?php echo number_format($stats['new_products']); ?></h3>
                                    <p class="mb-0">Mới (7 ngày)</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-star fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Danh sách Sản phẩm</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="min-height: 400px;">
                            <table id="productsTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Thương hiệu</th>
                                    <th>Loại xe</th>
                                    <th>Mô tả</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product): ?>
                                <tr>
                                    <td data-label="ID"><?php echo $product->id; ?></td>
                                    <td data-label="Hình ảnh">
                                        <?php if (!empty($product->featured_image)): ?>
                                            <img src="<?php echo $product->featured_image; ?>" class="product-image" alt="Product">
                                        <?php else: ?>
                                            <img src="https://via.placeholder.com/50" class="product-image" alt="No Image">
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="Tên sản phẩm"><?php echo $product->title; ?></td>
                                    <td data-label="Thương hiệu"><?php echo $product->brand ?: 'Chưa có'; ?></td>
                                    <td data-label="Loại xe"><?php echo $product->type ?: 'Chưa có'; ?></td>
                                    <td data-label="Mô tả"><?php echo $product->description ?: 'Chưa có'; ?></td>
                                    <td data-label="Giá"><?php echo $product->price ?: 'Chưa có'; ?></td>
                                    <td data-label="Trạng thái">
                                        <?php if ($product->status == 'publish'): ?>
                                            <span class="status-badge status-publish">Đã Publish</span>
                                        <?php else: ?>
                                            <span class="status-badge status-draft">Draft</span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="Ngày tạo"><?php echo date('d/m/Y', $product->addtime); ?></td>
                                    <td data-label="Thao tác">
                                        <div class="action-buttons">
                                            <button class="btn-action btn-view" title="Xem chi tiết" onclick="viewProduct(<?php echo $product->id; ?>)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn-action btn-edit" title="Chỉnh sửa" onclick="editProduct(<?php echo $product->id; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-action btn-delete" title="Xóa" onclick="deleteProduct(<?php echo $product->id; ?>, '<?php echo $product->title; ?>')">
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

    <!-- Modal Xem chi tiết Product -->
    <div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewProductModalLabel">
                        <i class="fas fa-car me-2"></i>Chi tiết Sản phẩm
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="viewProductModalBody">
                    <!-- Nội dung sẽ được load bằng AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thêm Product -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">
                        <i class="fas fa-plus me-2"></i>Thêm Sản phẩm mới
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addProductForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add_title" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="add_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_brand" class="form-label">Thương hiệu</label>
                            <select class="form-select" id="add_brand" name="brand" required>
                                <option value="">Chọn thương hiệu</option>
                                <option value="Toyota">Toyota</option>
                                <option value="Mitsubishi">Mitsubishi</option>
                                <option value="Mazda">Mazda</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add_type" class="form-label">Loại xe</label>
                            <select class="form-select" id="add_type" name="type" required>
                                <option value="">Chọn loại xe</option>
                                <option value="Hatch Back">Hatch Back</option>
                                <option value="Sedan">Sedan</option>
                                <option value="MPV">MPV</option>
                                <option value="Pick up">Pick up</option>
                                <option value="Crossover">Crossover</option>
                                <option value="SUV">SUV</option>
                                <option value="Couple - xe thể thao">Couple - xe thể thao</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add_description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="add_description" name="description" rows="3" placeholder="Nhập mô tả sản phẩm"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="add_price" class="form-label">Giá</label>
                            <input type="text" class="form-control" id="add_price" name="price" placeholder="Nhập giá sản phẩm">
                        </div>
                        <div class="mb-3">
                            <label for="add_status" class="form-label">Trạng thái</label>
                            <select class="form-select" id="add_status" name="status" required>
                                <option value="publish">Publish</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                                                 <div class="mb-3">
                             <label class="form-label">Hình ảnh sản phẩm</label>
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
                         
                         <!-- Thông số kỹ thuật -->
                         <div class="mb-3">
                             <h6 class="form-label fw-bold text-primary">Thông số kỹ thuật</h6>
                             <div class="row">
                                 <div class="col-md-6">
                                     <label for="add_kich_thuoc" class="form-label">Kích thước</label>
                                     <input type="text" class="form-control specs-input" id="add_kich_thuoc" name="kich_thuoc" placeholder="Ví dụ: 4.640 x 1.775 x 1.460 mm">
                                 </div>
                                 <div class="col-md-6">
                                     <label for="add_dong_co" class="form-label">Động cơ</label>
                                     <input type="text" class="form-control specs-input" id="add_dong_co" name="dong_co" placeholder="Ví dụ: 1.8L I4">
                                 </div>
                             </div>
                             <div class="row mt-2">
                                 <div class="col-md-6">
                                     <label for="add_cong_suat" class="form-label">Công suất</label>
                                     <input type="text" class="form-control specs-input" id="add_cong_suat" name="cong_suat" placeholder="Ví dụ: 138 mã lực">
                                 </div>
                                 <div class="col-md-6">
                                     <label for="add_hop_so" class="form-label">Hộp số</label>
                                     <input type="text" class="form-control specs-input" id="add_hop_so" name="hop_so" placeholder="Ví dụ: CVT">
                                 </div>
                             </div>
                             <div class="row mt-2">
                                 <div class="col-md-6">
                                     <label for="add_dung_tich_binh_xang" class="form-label">Dung tích bình xăng</label>
                                     <input type="text" class="form-control specs-input" id="add_dung_tich_binh_xang" name="dung_tich_binh_xang" placeholder="Ví dụ: 50L">
                                 </div>
                                 <div class="col-md-6">
                                     <label for="add_so_cho_ngoi" class="form-label">Số chỗ ngồi</label>
                                     <input type="text" class="form-control specs-input" id="add_so_cho_ngoi" name="so_cho_ngoi" placeholder="Ví dụ: 5">
                                 </div>
                             </div>
                         </div>
                         
                         <!-- Dự tính chi phí theo tỉnh thành -->
                         <div class="mb-3">
                             <h6 class="form-label fw-bold text-success">Dự tính chi phí theo tỉnh thành</h6>
                             <div class="row">
                                 <div class="col-md-4">
                                     <h6 class="text-center text-primary">TP. Hồ Chí Minh</h6>
                                     <div class="mb-2">
                                         <label for="add_phi_dang_ky_hcm" class="form-label">Phí đăng ký</label>
                                         <input type="number" class="form-control specs-input" id="add_phi_dang_ky_hcm" name="phi_dang_ky_hcm" placeholder="0">
                                     </div>
                                     <div class="mb-2">
                                         <label for="add_phi_bao_hiem_hcm" class="form-label">Phí bảo hiểm</label>
                                         <input type="number" class="form-control specs-input" id="add_phi_bao_hiem_hcm" name="phi_bao_hiem_hcm" placeholder="0">
                                     </div>
                                     <div class="mb-2">
                                         <label for="add_gia_dam_phan_hcm" class="form-label">Giá đàm phán</label>
                                         <input type="number" class="form-control specs-input" id="add_gia_dam_phan_hcm" name="gia_dam_phan_hcm" placeholder="0">
                                     </div>
                                 </div>
                                 <div class="col-md-4">
                                     <h6 class="text-center text-primary">Hà Nội</h6>
                                     <div class="mb-2">
                                         <label for="add_phi_dang_ky_hn" class="form-label">Phí đăng ký</label>
                                         <input type="number" class="form-control specs-input" id="add_phi_dang_ky_hn" name="phi_dang_ky_hn" placeholder="0">
                                     </div>
                                     <div class="mb-2">
                                         <label for="add_phi_bao_hiem_hn" class="form-label">Phí bảo hiểm</label>
                                         <input type="number" class="form-control specs-input" id="add_phi_bao_hiem_hn" name="phi_bao_hiem_hn" placeholder="0">
                                     </div>
                                     <div class="mb-2">
                                         <label for="add_gia_dam_phan_hn" class="form-label">Giá đàm phán</label>
                                         <input type="number" class="form-control specs-input" id="add_gia_dam_phan_hn" name="gia_dam_phan_hn" placeholder="0">
                                     </div>
                                 </div>
                                 <div class="col-md-4">
                                     <h6 class="text-center text-primary">Đà Nẵng</h6>
                                     <div class="mb-2">
                                         <label for="add_phi_dang_ky_dn" class="form-label">Phí đăng ký</label>
                                         <input type="number" class="form-control specs-input" id="add_phi_dang_ky_dn" name="phi_dang_ky_dn" placeholder="0">
                                     </div>
                                     <div class="mb-2">
                                         <label for="add_phi_bao_hiem_dn" class="form-label">Phí bảo hiểm</label>
                                         <input type="number" class="form-control specs-input" id="add_phi_bao_hiem_dn" name="phi_bao_hiem_dn" placeholder="0">
                                     </div>
                                     <div class="mb-2">
                                         <label for="add_gia_dam_phan_dn" class="form-label">Giá đàm phán</label>
                                         <input type="number" class="form-control specs-input" id="add_gia_dam_phan_dn" name="gia_dam_phan_dn" placeholder="0">
                                     </div>
                                 </div>
                             </div>
                         </div>
                         
                         <!-- Hình ảnh ngoại thất (images) -->
                         <div class="mb-3">
                             <h6 class="form-label fw-bold text-info">Hình ảnh ngoại thất (cho Tổng quan & Ngoại thất)</h6>
                             <div class="row">
                                 <div class="col-md-6">
                                     <label for="add_images_text" class="form-label">Đường dẫn hình ảnh (JSON)</label>
                                     <textarea class="form-control" id="add_images_text" name="images_text" rows="3" placeholder='["/kholanh/assets/img/toyota-avanza.webp", "/kholanh/assets/img/corolla.webp"]'></textarea>
                                     <small class="form-text text-muted">Nhập mảng JSON các đường dẫn hình ảnh</small>
                                 </div>
                                 <div class="col-md-6">
                                     <label for="add_images_files" class="form-label">Hoặc upload nhiều file</label>
                                     <input type="file" class="form-control" id="add_images_files" name="images_files[]" accept="image/*" multiple>
                                     <small class="form-text text-muted">Chọn nhiều file JPG, PNG, GIF, WEBP</small>
                                 </div>
                             </div>
                         </div>
                         
                         <!-- Hình ảnh nội thất (interior_images) -->
                         <div class="mb-3">
                             <h6 class="form-label fw-bold text-warning">Hình ảnh nội thất</h6>
                             <div class="row">
                                 <div class="col-md-6">
                                     <label for="add_interior_images_text" class="form-label">Đường dẫn hình ảnh (JSON)</label>
                                     <textarea class="form-control" id="add_interior_images_text" name="interior_images_text" rows="3" placeholder='["/kholanh/assets/img/noi-that-1.webp", "/kholanh/assets/img/noi-that-2.webp"]'></textarea>
                                     <small class="form-text text-muted">Nhập mảng JSON các đường dẫn hình ảnh nội thất</small>
                                 </div>
                                 <div class="col-md-6">
                                     <label for="add_interior_images_files" class="form-label">Hoặc upload nhiều file</label>
                                     <input type="file" class="form-control" id="add_interior_images_files" name="interior_images_files[]" accept="image/*" multiple>
                                     <small class="form-text text-muted">Chọn nhiều file JPG, PNG, GIF, WEBP</small>
                                 </div>
                             </div>
                         </div>
                         
                         <!-- Hidden inputs for JSON data -->
                         <input type="hidden" id="add_specs" name="specs">
                         <input type="hidden" id="add_images" name="images">
                         <input type="hidden" id="add_interior_images" name="interior_images">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Thêm sản phẩm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Sửa Product -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa Sản phẩm
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editProductForm" enctype="multipart/form-data">
                    <div class="modal-body" id="editProductModalBody">
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
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    
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
            $('#productsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/vi.json'
                },
                pageLength: 10,
                order: [[0, 'desc']],
                scrollX: true,
                scrollCollapse: true,
                autoWidth: false,
                responsive: false, // Disable responsive to show all columns
                columnDefs: [
                    { width: '50px', targets: 0 }, // ID
                    { width: '80px', targets: 1 }, // Hình ảnh
                    { width: '150px', targets: 2 }, // Tên sản phẩm
                    { width: '100px', targets: 3 }, // Thương hiệu
                    { width: '100px', targets: 4 }, // Loại xe
                    { width: '200px', targets: 5 }, // Mô tả
                    { width: '100px', targets: 6 }, // Giá
                    { width: '100px', targets: 7 }, // Trạng thái
                    { width: '100px', targets: 8 }, // Ngày tạo
                    { width: '120px', targets: -1 } // Thao tác
                ]
            });
            
            // Force table recalculation on window resize
            $(window).on('resize', function() {
                setTimeout(function() {
                    $('#productsTable').DataTable().columns.adjust();
                }, 100);
            });
            
            // Ensure table is scrollable on mobile
            function ensureMobileScroll() {
                if ($(window).width() <= 768) {
                    $('.table-responsive').css({
                        'overflow-x': 'auto',
                        '-webkit-overflow-scrolling': 'touch',
                        'min-width': '100%'
                    });
                    
                    // Set minimum width for table to ensure all columns are visible
                    $('#productsTable').css('min-width', '900px');
                }
            }
            
            // Call on page load and window resize
            ensureMobileScroll();
            $(window).on('resize', ensureMobileScroll);
            
            // Ensure all columns are visible on mobile
            function ensureAllColumnsVisible() {
                if ($(window).width() <= 768) {
                    $('.table td, .table th').css('display', 'table-cell');
                    $('.table-responsive').css('overflow-x', 'auto');
                }
            }
            
            // Call on page load and window resize
            ensureAllColumnsVisible();
            $(window).on('resize', ensureAllColumnsVisible);
        });

        // Function thêm product
        function addProduct() {
            $('#addProductModal').modal('show');
        }

        // Function xem chi tiết product
        function viewProduct(productId) {
            $.ajax({
                url: '/kholanh/admin/products/view',
                type: 'POST',
                data: { product_id: productId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#viewProductModalBody').html(response.html);
                        $('#viewProductModal').modal('show');
                    } else {
                        alert('Lỗi: ' + response.message);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải dữ liệu!');
                }
            });
        }

        // Function sửa product
        function editProduct(productId) {
            $.ajax({
                url: '/kholanh/admin/products/edit',
                type: 'POST',
                data: { product_id: productId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#editProductModalBody').html(response.html);
                        $('#editProductModal').modal('show');
                    } else {
                        alert('Lỗi: ' + response.message);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải dữ liệu!');
                }
            });
        }

        // Function xóa product
        function deleteProduct(productId, productName) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm "' + productName + '"?')) {
                $.ajax({
                    url: '/kholanh/admin/products/delete',
                    type: 'POST',
                    data: { product_id: productId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert('Xóa thành công!');
                            location.reload(); // Reload trang để cập nhật danh sách
                        } else {
                            alert('Lỗi: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi xóa!');
                    }
                });
            }
        }

                 // Function to build specs JSON from form inputs
         function buildSpecsJSON() {
             var specs = {};
             
             // Technical specifications
             specs['Kích thước'] = $('#add_kich_thuoc').val() || '';
             specs['Động cơ'] = $('#add_dong_co').val() || '';
             specs['Công suất'] = $('#add_cong_suat').val() || '';
             specs['Hộp số'] = $('#add_hop_so').val() || '';
             specs['Dung tích bình xăng'] = $('#add_dung_tich_binh_xang').val() || '';
             specs['Số chỗ ngồi'] = $('#add_so_cho_ngoi').val() || '';
             
             // Cost estimates for HCM
             specs['Phí đăng ký HCM'] = parseInt($('#add_phi_dang_ky_hcm').val()) || 0;
             specs['Phí bảo hiểm HCM'] = parseInt($('#add_phi_bao_hiem_hcm').val()) || 0;
             specs['Giá đàm phán HCM'] = parseInt($('#add_gia_dam_phan_hcm').val()) || 0;
             
             // Cost estimates for HN
             specs['Phí đăng ký HN'] = parseInt($('#add_phi_dang_ky_hn').val()) || 0;
             specs['Phí bảo hiểm HN'] = parseInt($('#add_phi_bao_hiem_hn').val()) || 0;
             specs['Giá đàm phán HN'] = parseInt($('#add_gia_dam_phan_hn').val()) || 0;
             
             // Cost estimates for DN
             specs['Phí đăng ký DN'] = parseInt($('#add_phi_dang_ky_dn').val()) || 0;
             specs['Phí bảo hiểm DN'] = parseInt($('#add_phi_bao_hiem_dn').val()) || 0;
             specs['Giá đàm phán DN'] = parseInt($('#add_gia_dam_phan_dn').val()) || 0;
             
             return JSON.stringify(specs);
         }
         
         // Function to build images JSON from form inputs
         function buildImagesJSON() {
             var imagesText = $('#add_images_text').val().trim();
             if (imagesText) {
                 try {
                     // Try to parse as JSON
                     var images = JSON.parse(imagesText);
                     if (Array.isArray(images)) {
                         return JSON.stringify(images);
                     }
                 } catch (e) {
                     // If not valid JSON, treat as comma-separated values
                     var images = imagesText.split(',').map(function(item) {
                         return item.trim().replace(/['"]/g, '');
                     }).filter(function(item) {
                         return item.length > 0;
                     });
                     return JSON.stringify(images);
                 }
             }
             return '[]';
         }
         
         // Function to build interior_images JSON from form inputs
         function buildInteriorImagesJSON() {
             var interiorImagesText = $('#add_interior_images_text').val().trim();
             if (interiorImagesText) {
                 try {
                     // Try to parse as JSON
                     var interiorImages = JSON.parse(interiorImagesText);
                     if (Array.isArray(interiorImages)) {
                         return JSON.stringify(interiorImages);
                     }
                 } catch (e) {
                     // If not valid JSON, treat as comma-separated values
                     var interiorImages = interiorImagesText.split(',').map(function(item) {
                         return item.trim().replace(/['"]/g, '');
                     }).filter(function(item) {
                         return item.length > 0;
                     });
                     return JSON.stringify(interiorImages);
                 }
             }
             return '[]';
         }
         
         // Function to build specs JSON for edit form
         function buildEditSpecsJSON() {
             var specs = {};
             
             // Technical specifications
             specs['Kích thước'] = $('#edit_kich_thuoc').val() || '';
             specs['Động cơ'] = $('#edit_dong_co').val() || '';
             specs['Công suất'] = $('#edit_cong_suat').val() || '';
             specs['Hộp số'] = $('#edit_hop_so').val() || '';
             specs['Dung tích bình xăng'] = $('#edit_dung_tich_binh_xang').val() || '';
             specs['Số chỗ ngồi'] = $('#edit_so_cho_ngoi').val() || '';
             
             // Cost estimates for HCM
             specs['Phí đăng ký HCM'] = parseInt($('#edit_phi_dang_ky_hcm').val()) || 0;
             specs['Phí bảo hiểm HCM'] = parseInt($('#edit_phi_bao_hiem_hcm').val()) || 0;
             specs['Giá đàm phán HCM'] = parseInt($('#edit_gia_dam_phan_hcm').val()) || 0;
             
             // Cost estimates for HN
             specs['Phí đăng ký HN'] = parseInt($('#edit_phi_dang_ky_hn').val()) || 0;
             specs['Phí bảo hiểm HN'] = parseInt($('#edit_phi_bao_hiem_hn').val()) || 0;
             specs['Giá đàm phán HN'] = parseInt($('#edit_gia_dam_phan_hn').val()) || 0;
             
             // Cost estimates for DN
             specs['Phí đăng ký DN'] = parseInt($('#edit_phi_dang_ky_dn').val()) || 0;
             specs['Phí bảo hiểm DN'] = parseInt($('#edit_phi_bao_hiem_dn').val()) || 0;
             specs['Giá đàm phán DN'] = parseInt($('#edit_gia_dam_phan_dn').val()) || 0;
             
             return JSON.stringify(specs);
         }
         
         // Function to build images JSON for edit form
         function buildEditImagesJSON() {
             var imagesText = $('#edit_images_text').val().trim();
             if (imagesText) {
                 try {
                     // Try to parse as JSON
                     var images = JSON.parse(imagesText);
                     if (Array.isArray(images)) {
                         return JSON.stringify(images);
                     }
                 } catch (e) {
                     // If not valid JSON, treat as comma-separated values
                     var images = imagesText.split(',').map(function(item) {
                         return item.trim().replace(/['"]/g, '');
                     }).filter(function(item) {
                         return item.length > 0;
                     });
                     return JSON.stringify(images);
                 }
             }
             return '[]';
         }
         
         // Function to build interior_images JSON for edit form
         function buildEditInteriorImagesJSON() {
             var interiorImagesText = $('#edit_interior_images_text').val().trim();
             if (interiorImagesText) {
                 try {
                     // Try to parse as JSON
                     var interiorImages = JSON.parse(interiorImagesText);
                     if (Array.isArray(interiorImages)) {
                         return JSON.stringify(interiorImages);
                     }
                 } catch (e) {
                     // If not valid JSON, treat as comma-separated values
                     var interiorImages = interiorImagesText.split(',').map(function(item) {
                         return item.trim().replace(/['"]/g, '');
                     }).filter(function(item) {
                         return item.length > 0;
                     });
                     return JSON.stringify(interiorImages);
                 }
             }
             return '[]';
         }

         // Handle form submit cho add product
         $(document).on('submit', '#addProductForm', function(e) {
             e.preventDefault();
             
             // Build JSON data before form submission
             $('#add_specs').val(buildSpecsJSON());
             $('#add_images').val(buildImagesJSON());
             $('#add_interior_images').val(buildInteriorImagesJSON());
             
             var formData = new FormData(this);
            
            $.ajax({
                url: '/kholanh/admin/products/add',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Thêm sản phẩm thành công!');
                        $('#addProductModal').modal('hide');
                        location.reload(); // Reload trang để cập nhật danh sách
                    } else {
                        alert('Lỗi: ' + response.message);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi thêm sản phẩm!');
                }
            });
        });

                 // Handle form submit cho edit product
         $(document).on('submit', '#editProductForm', function(e) {
             e.preventDefault();
             
             // Build JSON data before form submission
             $('#edit_specs').val(buildEditSpecsJSON());
             $('#edit_images').val(buildEditImagesJSON());
             $('#edit_interior_images').val(buildEditInteriorImagesJSON());
             
             var formData = new FormData(this);
            
            $.ajax({
                url: '/kholanh/admin/products/update',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Cập nhật thành công!');
                        $('#editProductModal').modal('hide');
                        location.reload(); // Reload trang để cập nhật danh sách
                    } else {
                        alert('Lỗi: ' + response.message);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi cập nhật!');
                }
            });
        });
    </script>
</body>
</html> 