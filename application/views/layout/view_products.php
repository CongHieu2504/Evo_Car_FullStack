<!-- Products Section -->
<section class="products-section py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-lg-3">
                <div class="sidebar-box mb-4">
                    <h5 class="sidebar-title">DANH MỤC</h5>
                    <ul class="sidebar-menu">
                        <li class="sidebar-item">
                            <span class="toggle-icon" style="cursor:pointer;">+</span>
                            <a href="<?= site_url('products') ?>">Sản phẩm</a>
                            <ul class="submenu" style="display:none;">
                                <?php if (!empty($cat_tree)): ?>
                                    <?php foreach ($cat_tree[0] as $cat): ?>
                                        <li><a href="<?= site_url('products?cat=' . $cat['id']) ?>"><?= htmlspecialchars($cat['title']) ?></a></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <span class="toggle-icon" style="cursor:pointer;">+</span>
                            <a href="<?= site_url('tin-tuc') ?>">Tin tức</a>
                            <ul class="submenu" style="display:none;">
                                <li><a href="#">Mua xe</a></li>
                                <li><a href="#">Lái xe</a></li>
                            </ul>
                        </li>
                        <li><a href="<?= site_url('dang-ky-lai-thu') ?>">Đăng ký lái thử</a></li>
                        <li><a href="<?= site_url('dai-ly') ?>">Đại lý</a></li>
                    </ul>
                </div>
                <div class="sidebar-box mb-4">
                    <h5 class="sidebar-title">TÌM THEO</h5>
                    <form id="filterForm" method="get" action="">
                        <div class="mb-3">
                            <strong>Thương hiệu</strong>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="brand" id="brand-mitsubishi" value="Mitsubishi" <?= ($brand=='Mitsubishi')?'checked':'' ?>>
                                <label class="form-check-label" for="brand-mitsubishi">Mitsubishi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="brand" id="brand-mazda" value="Mazda" <?= ($brand=='Mazda')?'checked':'' ?>>
                                <label class="form-check-label" for="brand-mazda">Mazda</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="brand" id="brand-toyota" value="Toyota" <?= ($brand=='Toyota')?'checked':'' ?>>
                                <label class="form-check-label" for="brand-toyota">Toyota</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="brand" id="brand-all" value="" <?= (empty($brand))?'checked':'' ?>>
                                <label class="form-check-label" for="brand-all">Tất cả</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <strong>Loại</strong>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="type-suv" value="SUV" <?= ($type=='SUV')?'checked':'' ?>>
                                <label class="form-check-label" for="type-suv">SUV</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="type-sedan" value="Sedan" <?= ($type=='Sedan')?'checked':'' ?>>
                                <label class="form-check-label" for="type-sedan">Sedan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="type-mpv" value="MPV" <?= ($type=='MPV')?'checked':'' ?>>
                                <label class="form-check-label" for="type-mpv">MPV</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="type-hatchback" value="Hatch Back" <?= ($type=='Hatch Back')?'checked':'' ?>>
                                <label class="form-check-label" for="type-hatchback">Hatch Back</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="type-all" value="" <?= (empty($type))?'checked':'' ?>>
                                <label class="form-check-label" for="type-all">Tất cả</label>
                            </div>
                        </div>
                        <div class="sort-group d-flex align-items-center flex-wrap mb-3">
                            <span class="me-2">Xếp theo:</span>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sort" id="sort-az" value="az" <?= ($sort=='az'||empty($sort))?'checked':'' ?>>
                                <label class="form-check-label" for="sort-az">Tên A-Z</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sort" id="sort-za" value="za" <?= ($sort=='za')?'checked':'' ?>>
                                <label class="form-check-label" for="sort-za">Tên Z-A</label>
                            </div>
                        </div>
                    </form>
                </div>
            </aside>
            <!-- Main Content: Sản phẩm -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                    <h2 class="section-title mb-0">TẤT CẢ SẢN PHẨM</h2>
                </div>
                <div class="row" id="products-grid">
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $item): ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card product-card h-100">
                                    <a href="<?= site_url('products/detail/' . $item['id']) ?>">
                                        <img src="<?= !empty($item['homeimgfile']) ? (strpos($item['homeimgfile'], '/') === 0 ? $item['homeimgfile'] : base_url('assets/img/' . $item['homeimgfile'])) : base_url('assets/img/no-image.png') ?>" class="card-img-top product-image" alt="<?= htmlspecialchars($item['title']) ?>">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title product-title">
                                            <a href="<?= site_url('products/detail/' . $item['id']) ?>"><?= htmlspecialchars($item['title']) ?></a>
                                        </h5>
                                        <p class="card-text product-excerpt"><?= htmlspecialchars($item['hometext']) ?></p>
                                        <?php if (!empty($item['price'])): ?>
                                            <div class="product-card-price mb-2">
                                                Giá: <span class="text-danger fw-bold"><?= number_format($item['price']) ?> VNĐ</span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="product-meta d-flex justify-content-between align-items-center mt-2">
                                            <span class="product-date"><i class="bi bi-calendar3"></i> <?= date('d/m/Y', $item['addtime']) ?></span>
                                        </div>
                                        <button class="btn btn-danger btn-sm mt-3 w-100">Mua ngay</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <div class="no-products-message">
                                <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                                <h4 class="text-dark mb-2">Không có sản phẩm nào</h4>
                                <p class="text-muted">Vui lòng thử lại với bộ lọc khác hoặc quay lại trang chủ.</p>
                                <a href="<?= site_url('products') ?>" class="btn btn-primary mt-3">Xem tất cả sản phẩm</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <nav class="pagination-section mt-4">
                    <ul class="pagination justify-content-center" id="pagination">
                        <?php
                        $total_pages = ceil($total_products / $limit);
                        if ($total_pages > 1) {
                            for ($i = 1; $i <= $total_pages; $i++) {
                                $active = ($i == $page) ? 'active' : '';
                                // Giữ lại các filter/sort khi chuyển trang
                                $query = http_build_query(array_merge($_GET, ['page' => $i]));
                                echo '<li class="page-item ' . $active . '"><a class="page-link" href="?' . $query . '">' . $i . '</a></li>';
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section> 