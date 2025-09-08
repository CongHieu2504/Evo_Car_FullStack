<!-- Breadcrumb -->
<nav class="breadcrumb-section">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
            <li class="breadcrumb-item active">Tìm kiếm</li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<section class="products-section py-5 main-flex">
    <div class="container">
        <div class="row">
            <!-- Sidebar Danh mục và Bộ lọc -->
            <aside class="col-lg-3 mb-4">
                <div class="sidebar-box mb-4">
                    <h5 class="sidebar-title">DANH MỤC</h5>
                    <ul class="sidebar-menu">
                        <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
                        <li><a href="#">Giới thiệu</a></li>
                        <li class="has-submenu active">
                            <a href="#">Sản phẩm <span class="toggle-icon">-</span></a>
                            <ul class="submenu">
                                <li><a href="#">Hatch Back</a></li>
                                <li><a href="#">Sedan</a></li>
                                <li><a href="#">Pick up</a></li>
                                <li><a href="#">MPV</a></li>
                                <li><a href="#">SUV</a></li>
                                <li><a href="#">Crossover</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url('tin-tuc'); ?>">Tin tức</a></li>
                        <li><a href="<?php echo base_url('contact'); ?>">Liên hệ</a></li>
                    </ul>
                </div>

                <div class="sidebar-box mb-4">
                    <h5 class="sidebar-title">BỘ LỌC</h5>
                    <div class="filter-section">
                        <div class="filter-group mb-3">
                            <label class="filter-label">Thương hiệu</label>
                            <select class="form-select" id="filter-brand">
                                <option value="">Tất cả</option>
                                <option value="toyota">Toyota</option>
                                <option value="honda">Honda</option>
                                <option value="mazda">Mazda</option>
                                <option value="mitsubishi">Mitsubishi</option>
                                <option value="hyundai">Hyundai</option>
                                <option value="kia">KIA</option>
                            </select>
                        </div>
                        <div class="filter-group mb-3">
                            <label class="filter-label">Giá</label>
                            <select class="form-select" id="filter-price">
                                <option value="">Tất cả</option>
                                <option value="0-500">Dưới 500 triệu</option>
                                <option value="500-1000">500 - 1 tỷ</option>
                                <option value="1000-2000">1 - 2 tỷ</option>
                                <option value="2000+">Trên 2 tỷ</option>
                            </select>
                        </div>
                        <div class="filter-group mb-3">
                            <label class="filter-label">Dòng xe</label>
                            <select class="form-select" id="filter-type">
                                <option value="">Tất cả</option>
                                <option value="sedan">Sedan</option>
                                <option value="suv">SUV</option>
                                <option value="mpv">MPV</option>
                                <option value="hatchback">Hatchback</option>
                                <option value="pickup">Pickup</option>
                            </select>
                        </div>
                        <button class="btn btn-primary w-100" id="apply-filters">Áp dụng</button>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="col-lg-9">
                <div class="products-header mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="products-title">Kết quả tìm kiếm</h2>
                        <div class="products-count">
                            <?php echo count($search_results); ?> sản phẩm
                        </div>
                    </div>
                    <?php if (!empty($keyword) || !empty($type) || !empty($brand)): ?>
                        <div class="search-info mt-2">
                            <small class="text-muted">
                                Tìm kiếm: 
                                <?php if (!empty($keyword)): ?>"<?php echo $keyword; ?>"<?php endif; ?>
                                <?php if (!empty($type) && $type != 'all'): ?> - Dòng xe: <?php echo $type; ?><?php endif; ?>
                                <?php if (!empty($brand) && $brand != 'all'): ?> - Thương hiệu: <?php echo $brand; ?><?php endif; ?>
                            </small>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Products Grid -->
                <div class="row" id="products-grid">
                    <?php if (isset($search_results) && is_array($search_results) && !empty($search_results)): ?>
                        <?php foreach ($search_results as $product): ?>
                            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                                <div class="product-card">
                                    <div class="product-front">
                                        <img src="<?php echo base_url('uploads/shops/' . $product['image']); ?>" alt="<?php echo $product['title']; ?>" class="product-image">
                                        <div class="product-icons">
                                            <i class="bi bi-heart product-icon"></i>
                                            <i class="bi bi-cart product-icon"></i>
                                        </div>
                                    </div>
                                    <div class="product-back">
                                        <div class="product-details">
                                            <h5><?php echo $product['title']; ?></h5>
                                            <p class="text-danger fw-bold"><?php echo number_format($product['price']); ?> VNĐ</p>
                                            <a href="<?php echo base_url('shops/rows/site_details/' . $product['id']); ?>" class="btn btn-primary">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="no-results text-center py-5">
                                <i class="bi bi-search" style="font-size: 3rem; color: #ccc;"></i>
                                <h4 class="mt-3">Không tìm thấy sản phẩm</h4>
                                <p class="text-muted">Vui lòng thử lại với từ khóa khác hoặc điều chỉnh bộ lọc</p>
                                <a href="<?php echo base_url(); ?>" class="btn btn-primary">Về trang chủ</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <?php if (isset($search_results) && count($search_results) > 12): ?>
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Trước</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Sau</a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            </main>
        </div>
    </div>
</section> 
