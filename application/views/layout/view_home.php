<?php if (isset($banners) || isset($banner_titles)) { echo '<pre style="background:#fff;color:#000;z-index:99999;position:relative;">BANNERS='; var_dump($banners); echo "\nBANNER_TITLES="; var_dump($banner_titles); echo '</pre>'; } ?>
<!-- Tìm kiếm -->
<section class="search-section">
    <div class="search-bar bg-danger text-white py-2">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="search-icon me-3">
                <i class="bi bi-car-front"></i> Tìm Kiếm Xe
            </div>
            <div class="search-inputs d-flex align-items-center">
                <input type="text" class="form-control me-2" id="search-keyword" placeholder="Từ khóa" aria-label="Từ khóa">
                <select class="form-select me-2" id="search-type" aria-label="Dòng xe">
                    <option value="all">Tất cả</option>
                    <option value="suv">SUV</option>
                    <option value="sedan">Sedan</option>
                    <option value="mpv">MPV</option>
                    <option value="hatchback">Hatch Back</option>
                </select>
                <select class="form-select me-2" id="search-brand" aria-label="Thương hiệu">
                    <option value="all">Tất cả</option>
                    <option value="mitsubishi">Mitsubishi</option>
                    <option value="mazda">Mazda</option>
                    <option value="toyota">Toyota</option>
                </select>
                <button type="button" class="btn btn-dark btn-search" id="btn-search">TÌM KIẾM</button>
            </div>
        </div>
    </div>
</section>

<!-- Sản phẩm nổi bật -->
<section class="featured-products py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header-row d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-black m-0">Sản phẩm nổi bật</h2>
                    <div class="categories d-flex">
                        <a href="#" class="text-danger mx-2">Hatch Back</a>
                        <a href="#" class="text-danger mx-2">Sedan</a>
                        <a href="#" class="text-danger mx-2">Pick up</a>
                        <a href="#" class="text-danger mx-2">MPV</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row text-center" id="featured-products-container">
                    <?php if (isset($featured_products) && is_array($featured_products) && !empty($featured_products)): ?>
                        <?php foreach ($featured_products as $product): ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="product-card">
                                    <div class="product-front">
                                        <img src="<?php 
                                            $img = !empty($product['homeimgfile']) ? $product['homeimgfile'] : (isset($product['image']) ? $product['image'] : '');
                                            echo !empty($img) ? base_url('uploads/shops/' . $img) : 'https://via.placeholder.com/300x200/cccccc/666666?text=NO+IMAGE'; 
                                        ?>" alt="<?php echo $product['title']; ?>" class="product-image">
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
                        <!-- Sample products when no data -->
                        <?php for($i = 1; $i <= 8; $i++): ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="product-card">
                                    <div class="product-front">
                                        <img src="https://via.placeholder.com/300x200/0066cc/ffffff?text=PRODUCT+<?php echo $i; ?>" alt="Product <?php echo $i; ?>" class="product-image">
                                        <div class="product-icons">
                                            <i class="bi bi-heart product-icon"></i>
                                            <i class="bi bi-cart product-icon"></i>
                                        </div>
                                    </div>
                                    <div class="product-back">
                                        <div class="product-details">
                                            <h5>Sản phẩm mẫu <?php echo $i; ?></h5>
                                            <p class="text-danger fw-bold"><?php echo number_format(500000000 + ($i * 10000000)); ?> VNĐ</p>
                                            <a href="#" class="btn btn-primary">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TOYOTA -->
<section class="toyota-products py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="toyota-header-row d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-black m-0">TOYOTA</h2>
                </div>
            </div>
            <div class="col-12">
                <div class="swiper toyota-swiper" id="toyota-swiper">
                    <div class="swiper-wrapper" id="toyota-container">
                        <?php if (isset($toyota_products) && is_array($toyota_products) && !empty($toyota_products)): ?>
                            <?php foreach ($toyota_products as $product): ?>
                                <div class="swiper-slide">
                                    <div class="product-card">
                                        <div class="product-front">
                                            <img src="<?php 
                                                $img = !empty($product['homeimgfile']) ? $product['homeimgfile'] : (isset($product['image']) ? $product['image'] : '');
                                                echo !empty($img) ? base_url('uploads/shops/' . $img) : 'https://via.placeholder.com/300x200/cccccc/666666?text=NO+IMAGE'; 
                                            ?>" alt="<?php echo $product['title']; ?>" class="product-image">
                                            <div class="toyota-product-icons">
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
                            <!-- Sample Toyota products when no data -->
                            <?php for($i = 1; $i <= 8; $i++): ?>
                                <div class="swiper-slide">
                                    <div class="product-card">
                                        <div class="product-front">
                                            <img src="https://via.placeholder.com/300x200/ff6b35/ffffff?text=TOYOTA+<?php echo $i; ?>" alt="Toyota <?php echo $i; ?>">
                                            <div class="toyota-product-icons">
                                                <i class="bi bi-heart product-icon"></i>
                                                <i class="bi bi-cart product-icon"></i>
                                            </div>
                                        </div>
                                        <div class="product-back">
                                            <div class="product-details">
                                                <h5>Toyota mẫu <?php echo $i; ?></h5>
                                                <p class="text-danger fw-bold"><?php echo number_format(800000000 + ($i * 15000000)); ?> VNĐ</p>
                                                <a href="#" class="btn btn-primary">Xem chi tiết</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section> 
<!-- Banner ở giữa (render động) -->
<?php if (!empty($banners)): ?>
<section class="banner-section py-4">
    <div class="container">
        <div class="banner-content text-center mb-3">
            <?php if (!empty($banners[0]['title'])): ?>
                <h3 class="text-white">
                    <span class="text-danger"><?= htmlspecialchars($banners[0]['title']) ?></span>
                </h3>
            <?php endif; ?>
            <?php if (!empty($banners[0]['description'])): ?>
                <p class="text-white"><?= htmlspecialchars($banners[0]['description']) ?></p>
            <?php endif; ?>
        </div>
        <div class="swiper banner-swiper">
            <div class="swiper-wrapper" id="banner-container">
                <?php foreach ($banners as $banner): ?>
                    <div class="swiper-slide">
                        <?php if (!empty($banner['link'])): ?>
                            <a href="<?= htmlspecialchars($banner['link']) ?>" target="_blank">
                                <img src="<?= !empty($banner['image']) ? $banner['image'] : base_url('assets/img/no-image.png') ?>" alt="<?= htmlspecialchars($banner['title']) ?>" class="img-fluid" />
                            </a>
                        <?php else: ?>
                            <img src="<?= !empty($banner['image']) ? $banner['image'] : base_url('assets/img/no-image.png') ?>" alt="<?= htmlspecialchars($banner['title']) ?>" class="img-fluid" />
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- Banner Title (render động) -->
<?php if (!empty($banner_titles)): ?>
<section class="banner-title py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4">
                <?php if (!empty($banner_titles[0]['image'])): ?>
                    <div class="banner-title-header">
                        <img src="<?= $banner_titles[0]['image'] ?>" alt="Banner Long" class="banner-title-header-image">
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 text-center mb-4">
                <?php if (!empty($banner_titles[0]['title'])): ?>
                    <button class="banner-title-text-black"> <?= htmlspecialchars($banner_titles[0]['title']) ?> </button>
                <?php endif; ?>
            </div>
            <div class="col-12">
                <div class="swiper banner-title-swiper">
                    <div class="swiper-wrapper" id="banner-title-container">
                        <?php foreach ($banner_titles as $banner): ?>
                            <div class="swiper-slide">
                                <?php if (!empty($banner['link'])): ?>
                                    <a href="<?= htmlspecialchars($banner['link']) ?>" target="_blank">
                                        <img src="<?= !empty($banner['image']) ? $banner['image'] : base_url('assets/img/no-image.png') ?>" alt="<?= htmlspecialchars($banner['title']) ?>" class="img-fluid" />
                                    </a>
                                <?php else: ?>
                                    <img src="<?= !empty($banner['image']) ? $banner['image'] : base_url('assets/img/no-image.png') ?>" alt="<?= htmlspecialchars($banner['title']) ?>" class="img-fluid" />
                                <?php endif; ?>
                                <?php if (!empty($banner['description'])): ?>
                                    <div class="mt-2 text-center text-dark"> <?= htmlspecialchars($banner['description']) ?> </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <div class="col-12 text-center mt-4">
                <button class="view-all-button" onclick="window.location.href='<?= site_url('tin-tuc') ?>'">XEM TẤT CẢ</button>
            </div>
        </div>
    </div>
</section>
<?php endif; ?> 

