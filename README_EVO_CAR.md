# Tích hợp Evo Car Frontend vào Backend KHOLANH

## Tổng quan
Dự án này đã tích hợp giao diện frontend Evo Car vào backend KHOLANH (CodeIgniter) để tạo ra một website bán xe hơi hoàn chỉnh.

## Các file đã được tạo/cập nhật

### 1. Controller mới
- `application/modules/layout/controllers/Home.php` - Controller chính cho trang chủ và tìm kiếm

### 2. Views mới
- `application/views/layout/view_layout.php` - Layout chính với header, footer và navigation
- `application/views/layout/view_home.php` - Trang chủ với các section sản phẩm
- `application/views/layout/view_search.php` - Trang tìm kiếm sản phẩm

### 3. Assets
- `assets/css/main.css` - CSS chính cho giao diện Evo Car
- `assets/js/main.js` - JavaScript cho các tính năng tương tác

### 4. Cấu hình
- `application/config/routes.php` - Cập nhật routes để sử dụng controller Home mới

## Tính năng chính

### Trang chủ
- Header với navigation menu đa cấp
- Banner slider
- Thanh tìm kiếm xe (theo từ khóa, dòng xe, thương hiệu)
- Sản phẩm nổi bật
- Banner giữa trang với thống kê khách hàng
- Section TOYOTA với slider
- EVO CAR MAGAZINE
- Footer với thông tin liên hệ

### Trang tìm kiếm
- Breadcrumb navigation
- Sidebar với bộ lọc (thương hiệu, giá, dòng xe)
- Grid hiển thị kết quả tìm kiếm
- Pagination

### Responsive Design
- Giao diện responsive cho mobile, tablet và desktop
- Mobile navigation với modal menu
- Swiper sliders cho các section

## Cách sử dụng

### 1. Truy cập website
- Trang chủ: `http://localhost/kholanh/`
- Tìm kiếm: `http://localhost/kholanh/search`

### 2. Các tính năng tương tác
- **Tìm kiếm**: Sử dụng thanh tìm kiếm ở header hoặc form tìm kiếm ở trang chủ
- **Navigation**: Menu dropdown cho sản phẩm và tin tức
- **Mobile menu**: Nhấn nút ☰ để mở menu mobile
- **Product cards**: Hover để xem chi tiết sản phẩm
- **Sliders**: Sử dụng nút prev/next hoặc pagination

### 3. Dữ liệu mẫu
Khi không có dữ liệu thực từ database, website sẽ hiển thị:
- Sản phẩm mẫu với ảnh placeholder
- Banner mẫu
- Tin tức mẫu

## Cấu trúc thư mục

```
kholanh/
├── application/
│   ├── modules/
│   │   └── layout/
│   │       └── controllers/
│   │           └── Home.php (MỚI)
│   └── views/
│       └── layout/
│           ├── view_layout.php (MỚI)
│           ├── view_home.php (MỚI)
│           └── view_search.php (MỚI)
├── assets/
│   ├── css/
│   │   └── main.css (MỚI)
│   └── js/
│       └── main.js (MỚI)
└── application/config/routes.php (CẬP NHẬT)
```

## Thư viện sử dụng

### CDN Libraries
- **Bootstrap 5.3.0** - Framework CSS
- **Bootstrap Icons 1.10.0** - Icon library
- **Swiper 10** - Touch slider
- **AOS 2.3.4** - Animate On Scroll
- **GLightbox 3.2.0** - Lightbox gallery

### Fonts
- **Roboto** - Font chính
- **Lato** - Font navigation
- **Nunito** - Font heading

## Tùy chỉnh

### 1. Thay đổi màu sắc
Chỉnh sửa biến CSS trong `assets/css/main.css`:
```css
:root {
  --primary-color: #00aaff;
  --text-danger: #dc3545;
  --banner-bg: #1e2a44;
}
```

### 2. Thay đổi logo
Thay thế URL placeholder trong `application/views/layout/view_layout.php`:
```php
<img src="https://via.placeholder.com/150x50/0066cc/ffffff?text=EVO+CAR" alt="Logo">
```

### 3. Thêm sản phẩm thực
Để hiển thị sản phẩm thực từ database:
1. Đảm bảo có dữ liệu trong bảng `shops_rows`
2. Set field `is_featured = 1` cho sản phẩm nổi bật
3. Thêm ảnh vào thư mục `uploads/shops/`

### 4. Thêm banner thực
Để hiển thị banner thực:
1. Thêm bài viết vào bảng `posts`
2. Set field `inhome = 1` cho banner trang chủ
3. Thêm ảnh vào thư mục `uploads/posts/`

## Lưu ý kỹ thuật

### 1. Database
Website sử dụng các bảng có sẵn:
- `shops_rows` - Sản phẩm
- `posts` - Bài viết/banner
- `configs` - Cấu hình website

### 2. Routing
- Default controller đã được thay đổi từ `layout` sang `home`
- Các route mới đã được thêm cho search, products, news, contact

### 3. Responsive
- Mobile breakpoint: 768px
- Tablet breakpoint: 992px
- Desktop: > 992px

## Troubleshooting

### 1. Lỗi 404
- Kiểm tra file `.htaccess` có tồn tại
- Đảm bảo mod_rewrite được bật
- Kiểm tra quyền thư mục

### 2. CSS/JS không load
- Kiểm tra đường dẫn assets
- Đảm bảo CDN có thể truy cập
- Kiểm tra console browser

### 3. Database errors
- Kiểm tra kết nối database
- Đảm bảo các bảng cần thiết tồn tại
- Kiểm tra quyền database user

## Tương lai

### Tính năng có thể thêm
- Giỏ hàng và checkout
- Đăng ký/đăng nhập user
- Quản lý wishlist
- So sánh sản phẩm
- Đánh giá và review
- Chat support
- Newsletter subscription

### Tối ưu hóa
- Lazy loading images
- Minify CSS/JS
- Image optimization
- Caching
- SEO optimization 