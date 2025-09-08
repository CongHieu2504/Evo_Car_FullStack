<!-- News Section -->
<section class="news-section py-5">
    <div class="container">
        <h1 class="news-title text-center mb-5">Tin tức</h1>
        <!-- News Grid -->
        <div class="row" id="news-grid">
            <?php if (!empty($news)): ?>
                <?php foreach ($news as $item): ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                        <a href="<?= site_url('product-title?id=' . $item['id']) ?>" style="text-decoration:none; color:inherit;">
                        <div class="news-item">
                            <img src="<?= htmlspecialchars($item['image'] ? $item['image'] : '/kholanh/assets/img/no-image.png') ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="news-image">
                            <div class="news-content">
                                <span class="news-category">EVO</span>
                                <h3 class="news-title-item"><?= htmlspecialchars($item['title']) ?></h3>
                                <p class="news-excerpt"><?= htmlspecialchars($item['hometext']) ?></p>
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
                        <a class="page-link" href="<?= ($page - 1) == 1 ? '/kholanh/tin-tuc' : '?page=' . ($page - 1) ?>" tabindex="-1">
                            <i class="bi bi-chevron-left"></i>
                            <span class="page-text">Trước</span>
                        </a>
                    </li>
                    <!-- Page numbers -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item<?= $i == $page ? ' active' : '' ?>">
                            <a class="page-link" href="<?= $i == 1 ? '/kholanh/tin-tuc' : '?page=' . $i ?>"><?= $i ?></a>
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