<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Test Home - Evo</title>
</head>
<body>
    <h1>Trang chủ đã hoạt động!</h1>
    <ul>
        <li><a href="<?= site_url() ?>">Trang chủ</a></li>
        <li><a href="<?= site_url('gioi-thieu') ?>">Giới thiệu</a></li>
        <li><a href="<?= site_url('products') ?>">Sản phẩm</a></li>
        <li><a href="<?= site_url('tin-tuc') ?>">Tin tức</a></li>
        <li><a href="<?= site_url('lien-he-moi') ?>">Liên hệ</a></li>
    </ul>
    <p>Nếu các link trên KHÔNG có đuôi <b>.html</b> là bạn đã fix thành công!</p>
</body>
</html> 
