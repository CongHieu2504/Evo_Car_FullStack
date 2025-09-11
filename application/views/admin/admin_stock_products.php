<?php /* Quản lý sản phẩm kho - giống admin_products nhưng dùng shops_rows */ ?>
<!DOCTYPE html>
<html lang="en">
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
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-view {
            background: #17a2b8;
            color: white;
        }
        .btn-edit:hover {
            background: #218838;
            color: white;
            transform: scale(1.05);
        }
        .btn-delete:hover {
            background: #c82333;
            color: white;
            transform: scale(1.05);
        }
        .btn-view:hover {
            background: #138496;
            color: white;
            transform: scale(1.05);
        }
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            justify-content: center;
            min-width: 120px;
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
                padding: 6px 8px;
                font-size: 12px;
                min-width: 28px;
                height: 28px;
            }
        }
        
        @media (max-width: 576px) {
            .btn-action {
                padding: 4px 6px;
                font-size: 11px;
                min-width: 24px;
                height: 24px;
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
                            <a href="<?php echo base_url('admin/news'); ?>" class="nav-link">
                                <i class="fas fa-newspaper me-2"></i>
                                Quản lý Tin tức
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/admin_stock_products'); ?>" class="nav-link active">
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
                            <strong><?php echo isset($user['full_name']) ? $user['full_name'] : 'Admin'; ?></strong>
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
                    <h2><i class="fas fa-warehouse me-2"></i>Quản lý sản phẩm kho</h2>
                    <div>
                        <button class="btn btn-primary me-2" onclick="addStockProduct()">
                            <i class="fas fa-plus me-1"></i>Thêm sản phẩm kho
                        </button>
                        <button class="btn btn-outline-secondary me-2">Export</button>
                        <button class="btn btn-outline-secondary">Print</button>
                    </div>
                </div>
                <!-- Stats row for stock products -->
                <?php if (isset($stock_stats)): ?>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="card border-0" style="background: linear-gradient(45deg,#0d6efd,#0b5ed7); color:#fff;">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="mb-0"><?php echo number_format($stock_stats['total_stock']); ?></h3>
                                    <div>Tổng sản phẩm kho</div>
                                </div>
                                <i class="fas fa-warehouse fa-2x"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0" style="background: linear-gradient(45deg,#198754,#157347); color:#fff;">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="mb-0"><?php echo number_format($stock_stats['with_price']); ?></h3>
                                    <div>Có nhập giá</div>
                                </div>
                                <i class="fas fa-tags fa-2x"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0" style="background: linear-gradient(45deg,#dc3545,#bb2d3b); color:#fff;">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="mb-0"><?php echo number_format($stock_stats['new_7d']); ?></h3>
                                    <div>Mới (7 ngày)</div>
                                </div>
                                <i class="fas fa-star fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Danh sách sản phẩm kho</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="stockProductsTable" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Danh mục</th>
                                        <th>Thương hiệu</th>
                                        <th>Loại</th>
                                        <th>Giá</th>
                                        <th>Mô tả</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td><?php echo $product->id; ?></td>
                                        <td>
                                            <?php if (!empty($product->homeimgfile)): ?>
                                                <img src="<?php echo (strpos($product->homeimgfile, '/') === 0 ? $product->homeimgfile : base_url('assets/img/' . $product->homeimgfile)); ?>" class="product-image" alt="Product">
                                            <?php else: ?>
                                                <img src="https://via.placeholder.com/50" class="product-image" alt="No Image">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $product->title; ?></td>
                                        <td><?php echo $product->cat_name ?: 'Chưa phân loại'; ?></td>
                                        <td><?php echo $product->brand ?: 'Chưa có'; ?></td>
                                        <td><?php echo $product->type ?: 'Chưa có'; ?></td>
                                        <?php $p = isset($product->product_price) ? $product->product_price : (isset($product->price) ? $product->price : ''); ?>
                                        <td><?php echo ($p !== '' && $p !== null) ? number_format($p) . ' VNĐ' : 'Chưa có'; ?></td>
                                        <td><?php echo $product->hometext ?: 'Chưa có'; ?></td>
                                        <td><?php echo date('d/m/Y', $product->created); ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn-action btn-view" title="Xem chi tiết" onclick="viewStockProduct(<?php echo $product->id; ?>)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn-action btn-edit" title="Chỉnh sửa" onclick="editStockProduct(<?php echo $product->id; ?>)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn-action btn-delete" title="Xóa" onclick="deleteStockProduct(<?php echo $product->id; ?>, '<?php echo $product->title; ?>')">
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

    <!-- Modal Xem chi tiết sản phẩm kho -->
    <div class="modal fade" id="viewStockProductModal" tabindex="-1" aria-labelledby="viewStockProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewStockProductModalLabel">
                        <i class="fas fa-warehouse me-2"></i>Chi tiết sản phẩm kho
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="viewStockProductModalBody">
                    <!-- Nội dung sẽ được load bằng AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thêm sản phẩm kho -->
    <div class="modal fade" id="addStockProductModal" tabindex="-1" aria-labelledby="addStockProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStockProductModalLabel">
                        <i class="fas fa-plus me-2"></i>Thêm sản phẩm kho mới
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addStockProductForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add_title" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="add_title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="add_cat_id" class="form-label">Danh mục</label>
                            <select class="form-select" id="add_cat_id" name="listcatid">
                                <option value="">Chọn danh mục</option>
                                <?php foreach ($cats as $cat): ?>
                                <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="add_brand" class="form-label">Thương hiệu</label>
                                    <select class="form-select" id="add_brand" name="brand">
                                        <option value="">Chọn thương hiệu</option>
                                        <option value="Mitsubishi">Mitsubishi</option>
                                        <option value="Mazda">Mazda</option>
                                        <option value="Toyota">Toyota</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="add_type" class="form-label">Loại</label>
                                    <select class="form-select" id="add_type" name="type">
                                        <option value="">Chọn loại</option>
                                        <option value="SUV">SUV</option>
                                        <option value="Sedan">Sedan</option>
                                        <option value="MPV">MPV</option>
                                        <option value="Hatch Back">Hatch Back</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="add_hometext" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="add_hometext" name="hometext" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="add_product_price" class="form-label">Giá sản phẩm (VNĐ)</label>
                            <input type="number" class="form-control" id="add_product_price" name="product_price" min="0" step="1" placeholder="Nhập giá, ví dụ: 150000000">
                        </div>

                        <div class="mb-3">
                            <label for="add_image" class="form-label">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" id="add_image" name="homeimgfile" accept="image/*">
                            <small class="form-text text-muted">Chọn file hình ảnh (JPG, PNG, GIF, WEBP)</small>
                        </div>

                        <!-- Hình ảnh ngoại thất (images) -->
                        <div class="mb-3">
                            <h6 class="form-label fw-bold text-info">Hình ảnh ngoại thất (Tổng quan & Ngoại thất)</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="add_images_text" class="form-label">Đường dẫn hình ảnh (JSON)</label>
                                    <textarea class="form-control" id="add_images_text" name="images_text" rows="3" placeholder='["/kholanh/assets/img/toyota-avanza.webp", "/kholanh/assets/img/corolla.webp"]'></textarea>
                                    <small class="form-text text-muted">Nhập mảng JSON đường dẫn ảnh</small>
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
                                    <small class="form-text text-muted">Nhập mảng JSON đường dẫn ảnh nội thất</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="add_interior_images_files" class="form-label">Hoặc upload nhiều file</label>
                                    <input type="file" class="form-control" id="add_interior_images_files" name="interior_images_files[]" accept="image/*" multiple>
                                    <small class="form-text text-muted">Chọn nhiều file JPG, PNG, GIF, WEBP</small>
                                </div>
                            </div>
                        </div>

                        <!-- Thông số kỹ thuật -->
                        <div class="mb-3">
                            <h6 class="form-label fw-bold text-primary">Thông số kỹ thuật</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Kích thước</label>
                                    <input type="text" class="form-control specs-input" id="add_kich_thuoc" placeholder="4.640 x 1.775 x 1.460 mm">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Động cơ</label>
                                    <input type="text" class="form-control specs-input" id="add_dong_co" placeholder="1.8L I4">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="form-label">Công suất</label>
                                    <input type="text" class="form-control specs-input" id="add_cong_suat" placeholder="138 mã lực">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Hộp số</label>
                                    <input type="text" class="form-control specs-input" id="add_hop_so" placeholder="CVT">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="form-label">Dung tích bình xăng</label>
                                    <input type="text" class="form-control specs-input" id="add_dung_tich_binh_xang" placeholder="50L">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Số chỗ ngồi</label>
                                    <input type="text" class="form-control specs-input" id="add_so_cho_ngoi" placeholder="5">
                                </div>
                            </div>
                        </div>

                        <!-- Dự tính chi phí theo tỉnh thành -->
                        <div class="mb-3">
                            <h6 class="form-label fw-bold text-success">Dự tính chi phí theo tỉnh thành</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="text-center text-primary">TP. HCM</h6>
                                    <input type="number" class="form-control mb-2 specs-input" id="add_phi_dang_ky_hcm" placeholder="Phí đăng ký">
                                    <input type="number" class="form-control mb-2 specs-input" id="add_phi_bao_hiem_hcm" placeholder="Phí bảo hiểm">
                                    <input type="number" class="form-control specs-input" id="add_gia_dam_phan_hcm" placeholder="Giá đàm phán">
                                </div>
                                <div class="col-md-4">
                                    <h6 class="text-center text-primary">Hà Nội</h6>
                                    <input type="number" class="form-control mb-2 specs-input" id="add_phi_dang_ky_hn" placeholder="Phí đăng ký">
                                    <input type="number" class="form-control mb-2 specs-input" id="add_phi_bao_hiem_hn" placeholder="Phí bảo hiểm">
                                    <input type="number" class="form-control specs-input" id="add_gia_dam_phan_hn" placeholder="Giá đàm phán">
                                </div>
                                <div class="col-md-4">
                                    <h6 class="text-center text-primary">Đà Nẵng</h6>
                                    <input type="number" class="form-control mb-2 specs-input" id="add_phi_dang_ky_dn" placeholder="Phí đăng ký">
                                    <input type="number" class="form-control mb-2 specs-input" id="add_phi_bao_hiem_dn" placeholder="Phí bảo hiểm">
                                    <input type="number" class="form-control specs-input" id="add_gia_dam_phan_dn" placeholder="Giá đàm phán">
                                </div>
                            </div>
                        </div>

                        <!-- Hidden JSON holders -->
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

    <!-- Modal Sửa sản phẩm kho -->
    <div class="modal fade" id="editStockProductModal" tabindex="-1" aria-labelledby="editStockProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStockProductModalLabel">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa sản phẩm kho
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editStockProductForm" enctype="multipart/form-data">
                    <div class="modal-body" id="editStockProductModalBody">
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
            $('#stockProductsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/vi.json'
                },
                pageLength: 10,
                order: [[0, 'desc']],
                responsive: true
            });
        });

        // Function thêm sản phẩm kho
        function addStockProduct() {
            $('#addStockProductModal').modal('show');
        }
        
        

        // Function xem chi tiết sản phẩm kho
        function viewStockProduct(productId) {
            $.ajax({
                url: '/kholanh/admin/stock_products/view',
                type: 'POST',
                data: {product_id: productId},
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#viewStockProductModalBody').html(response.html);
                        $('#viewStockProductModal').modal('show');
                    } else {
                        alert('Lỗi: ' + response.message);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải dữ liệu!');
                }
            });
        }

        // Function chỉnh sửa sản phẩm kho
        function editStockProduct(productId) {
            $.ajax({
                url: '/kholanh/admin/stock_products/edit',
                type: 'POST',
                data: {product_id: productId},
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#editStockProductModalBody').html(response.html);
                        $('#editStockProductModal').modal('show');
                    } else {
                        alert('Lỗi: ' + response.message);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải dữ liệu!');
                }
            });
        }

        // Function xóa sản phẩm kho
        function deleteStockProduct(productId, productTitle) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm "' + productTitle + '"?')) {
                $.ajax({
                    url: '/kholanh/admin/stock_products/delete',
                    type: 'POST',
                    data: {product_id: productId},
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert('Xóa sản phẩm thành công!');
                            location.reload();
                        } else {
                            alert('Lỗi: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi xóa sản phẩm!');
                    }
                });
            }
        }

        // Submit form thêm sản phẩm kho
        $(document).on('submit', '#addStockProductForm', function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);

            // Build specs JSON from input fields
            var specs = {};
            function setIfNotEmpty(obj, key, val){ if(val!==null && val!==undefined && String(val).trim()!==''){ obj[key]=val; } }
            setIfNotEmpty(specs, 'Kích thước', $('#add_kich_thuoc').val());
            setIfNotEmpty(specs, 'Động cơ', $('#add_dong_co').val());
            setIfNotEmpty(specs, 'Công suất', $('#add_cong_suat').val());
            setIfNotEmpty(specs, 'Hộp số', $('#add_hop_so').val());
            setIfNotEmpty(specs, 'Dung tích bình xăng', $('#add_dung_tich_binh_xang').val());
            setIfNotEmpty(specs, 'Số chỗ ngồi', $('#add_so_cho_ngoi').val());
            setIfNotEmpty(specs, 'Phí đăng ký HCM', $('#add_phi_dang_ky_hcm').val());
            setIfNotEmpty(specs, 'Phí bảo hiểm HCM', $('#add_phi_bao_hiem_hcm').val());
            setIfNotEmpty(specs, 'Giá đàm phán HCM', $('#add_gia_dam_phan_hcm').val());
            setIfNotEmpty(specs, 'Phí đăng ký HN', $('#add_phi_dang_ky_hn').val());
            setIfNotEmpty(specs, 'Phí bảo hiểm HN', $('#add_phi_bao_hiem_hn').val());
            setIfNotEmpty(specs, 'Giá đàm phán HN', $('#add_gia_dam_phan_hn').val());
            setIfNotEmpty(specs, 'Phí đăng ký DN', $('#add_phi_dang_ky_dn').val());
            setIfNotEmpty(specs, 'Phí bảo hiểm DN', $('#add_phi_bao_hiem_dn').val());
            setIfNotEmpty(specs, 'Giá đàm phán DN', $('#add_gia_dam_phan_dn').val());
            formData.set('specs', JSON.stringify(specs));

            // Parse JSON textareas for images
            try {
                var imagesText = $('#add_images_text').val().trim();
                var images = imagesText ? JSON.parse(imagesText) : [];
                formData.set('images', JSON.stringify(images));
            } catch(e){ formData.set('images', '[]'); }
            try {
                var interiorText = $('#add_interior_images_text').val().trim();
                var interior = interiorText ? JSON.parse(interiorText) : [];
                formData.set('interior_images', JSON.stringify(interior));
            } catch(e){ formData.set('interior_images', '[]'); }
            console.log('Add form submitted');
            console.log('Form data:', formData);
            
            $.ajax({
                url: '/kholanh/admin/stock_products/add',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    console.log('Add response:', response);
                    if (response.success) {
                        alert('Thêm sản phẩm thành công!');
                        $('#addStockProductModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Lỗi: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Add AJAX Error:', xhr.responseText);
                    console.log('Add Status:', status);
                    console.log('Add Error:', error);
                    alert('Có lỗi xảy ra khi thêm sản phẩm!');
                }
            });
        });

        // Submit form chỉnh sửa sản phẩm kho
        $(document).on('submit', '#editStockProductForm', function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            // Build specs JSON from edit fields if present
            var specs = {};
            function setIfNotEmpty(obj, key, val){ if(val!==null && val!==undefined && String(val).trim()!==''){ obj[key]=val; } }
            setIfNotEmpty(specs, 'Kích thước', $('#edit_kich_thuoc').val());
            setIfNotEmpty(specs, 'Động cơ', $('#edit_dong_co').val());
            setIfNotEmpty(specs, 'Công suất', $('#edit_cong_suat').val());
            setIfNotEmpty(specs, 'Hộp số', $('#edit_hop_so').val());
            setIfNotEmpty(specs, 'Dung tích bình xăng', $('#edit_dung_tich_binh_xang').val());
            setIfNotEmpty(specs, 'Số chỗ ngồi', $('#edit_so_cho_ngoi').val());
            setIfNotEmpty(specs, 'Phí đăng ký HCM', $('#edit_phi_dang_ky_hcm').val());
            setIfNotEmpty(specs, 'Phí bảo hiểm HCM', $('#edit_phi_bao_hiem_hcm').val());
            setIfNotEmpty(specs, 'Giá đàm phán HCM', $('#edit_gia_dam_phan_hcm').val());
            setIfNotEmpty(specs, 'Phí đăng ký HN', $('#edit_phi_dang_ky_hn').val());
            setIfNotEmpty(specs, 'Phí bảo hiểm HN', $('#edit_phi_bao_hiem_hn').val());
            setIfNotEmpty(specs, 'Giá đàm phán HN', $('#edit_gia_dam_phan_hn').val());
            setIfNotEmpty(specs, 'Phí đăng ký DN', $('#edit_phi_dang_ky_dn').val());
            setIfNotEmpty(specs, 'Phí bảo hiểm DN', $('#edit_phi_bao_hiem_dn').val());
            setIfNotEmpty(specs, 'Giá đàm phán DN', $('#edit_gia_dam_phan_dn').val());
            formData.set('specs', JSON.stringify(specs));

            // Parse JSON textareas for images in edit form
            try {
                var imagesText = $('#edit_images_text').val();
                var images = imagesText ? JSON.parse(imagesText) : [];
                formData.set('images', JSON.stringify(images));
            } catch(e){ formData.set('images', '[]'); }
            try {
                var interiorText = $('#edit_interior_images_text').val();
                var interior = interiorText ? JSON.parse(interiorText) : [];
                formData.set('interior_images', JSON.stringify(interior));
            } catch(e){ formData.set('interior_images', '[]'); }
            console.log('Sending data:', formData);
            
            // First test the endpoint
            $.ajax({
                url: '/kholanh/admin/stock_products/test',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    console.log('Test response:', response);
                    if (response.success) {
                        // If test works, proceed with actual update
                        $.ajax({
                            url: '/kholanh/admin/stock_products/update',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            success: function(response) {
                                console.log('Response received:', response);
                                if (response.success) {
                                    alert('Cập nhật sản phẩm thành công!');
                                    $('#editStockProductModal').modal('hide');
                                    location.reload();
                                } else {
                                    alert('Lỗi: ' + response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log('AJAX Error:', xhr.responseText);
                                console.log('Status:', status);
                                console.log('Error:', error);
                                alert('Có lỗi xảy ra khi cập nhật sản phẩm!');
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Test AJAX Error:', xhr.responseText);
                    console.log('Test Status:', status);
                    console.log('Test Error:', error);
                    alert('Có lỗi kết nối đến server!');
                }
            });
        });
    </script>
</body>
</html>
