const productsData = [
    // Sản phẩm nổi bật
    {
        section: "featured",
        name: "Vios 1.5E SMT",
        price: "531.000.000đ",
        image: "/kholanh/assets/img/corolla.webp",
        year: 2019,
        seats: 5,
        transmission: "Số sàn",
        details: "Mẫu xe sedan phổ biến, tiết kiệm nhiên liệu, phù hợp cho gia đình."
    },
    {
        section: "featured",
        name: "Mitsubishi Triton",
        price: "555.000.000đ",
        image: "/kholanh/assets/img/mitsubishi-triton-4x2-at-mivec-10l-2019.webp",
        year: 2019,
        seats: 7,
        transmission: "Tự động",
        details: "Xe bán tải mạnh mẽ, phù hợp cho địa hình gồ ghề."
    },
    {
        section: "featured",
        name: "Mitsubishi Xpander",
        price: "550.000.000đ",
        image: "/kholanh/assets/img/nguoi-dua-tin-toyota-rush-2018-ra-mat-thai-lan-1-jpeg.webp",
        year: 2019,
        seats: 6,
        transmission: "Tự động",
        details: "MPV đa dụng với thiết kế hiện đại và không gian rộng rãi."
    },
    {
        section: "featured",
        name: "Rush S 1.5AT",
        price: "668.000.000đ",
        image: "/kholanh/assets/img/toyota-avanza.webp",
        year: 2018,
        seats: 7,
        transmission: "Số sàn",
        details: "SUV nhỏ gọn, phù hợp cho cả thành phố và ngoại ô."
    },
    {
        section: "featured",
        name: "Corolla Altis",
        price: "600.000.000đ",
        image: "/kholanh/assets/img/toyota-wifo.webp",
        year: 2019,
        seats: 5,
        transmission: "Tự động",
        details: "Sedan cao cấp với công nghệ tiên tiến."
    },
    {
        section: "featured",
        name: "Toyota Avanza",
        price: "450.000.000đ",
        image: "/kholanh/assets/img/xe-toyota-vios-2018-khuyen-mai-1.webp",
        year: 2018,
        seats: 7,
        transmission: "Số sàn",
        details: "MPV gia đình với không gian rộng rãi."
    },
    {
        section: "featured",
        name: "Toyota Wigo",
        price: "350.000.000đ",
        image: "/kholanh/assets/img/toyota-avanza.webp",
        year: 2020,
        seats: 5,
        transmission: "Số sàn",
        details: "Hatchback tiết kiệm, phù hợp cho đô thị."
    },
    {
        section: "featured",
        name: "Toyota Yaris",
        price: "500.000.000đ",
        image: "/kholanh/assets/img/toyota-wifo.webp",
        year: 2019,
        seats: 5,
        transmission: "Tự động",
        details: "Hatchback thể thao, thiết kế trẻ trung."
    },

    // Toyota
    {
        section: "toyota",
        name: "Vios 1.5E SMT",
        price: "531.000.000đ",
        image: "/kholanh/assets/img/corolla.webp",
        year: 2019,
        seats: 5,
        transmission: "Số sàn",
        details: "Mẫu xe sedan phổ biến, tiết kiệm nhiên liệu, phù hợp cho gia đình."
    },
    {
        section: "toyota",
        name: "Mitsubishi Triton",
        price: "555.000.000đ",
        image: "/kholanh/assets/img/mitsubishi-triton-4x2-at-mivec-10l-2019.webp",
        year: 2019,
        seats: 7,
        transmission: "Tự động",
        details: "Xe bán tải mạnh mẽ, phù hợp cho địa hình gồ ghề."
    },
    {
        section: "toyota",
        name: "Mitsubishi Xpander",
        price: "550.000.000đ",
        image: "/kholanh/assets/img/nguoi-dua-tin-toyota-rush-2018-ra-mat-thai-lan-1-jpeg.webp",
        year: 2019,
        seats: 6,
        transmission: "Tự động",
        details: "MPV đa dụng với thiết kế hiện đại và không gian rộng rãi."
    },
    {
        section: "toyota",
        name: "Rush S 1.5AT",
        price: "668.000.000đ",
        image: "/kholanh/assets/img/toyota-avanza.webp",
        year: 2018,
        seats: 7,
        transmission: "Số sàn",
        details: "SUV nhỏ gọn, phù hợp cho cả thành phố và ngoại ô."
    },
    {
        section: "toyota",
        name: "Corolla Altis",
        price: "600.000.000đ",
        image: "/kholanh/assets/img/toyota-wifo.webp",
        year: 2019,
        seats: 5,
        transmission: "Tự động",
        details: "Sedan cao cấp với công nghệ tiên tiến."
    },
    {
        section: "toyota",
        name: "Toyota Avanza",
        price: "450.000.000đ",
        image: "/kholanh/assets/img/xe-toyota-vios-2018-khuyen-mai-1.webp",
        year: 2018,
        seats: 7,
        transmission: "Số sàn",
        details: "MPV gia đình với không gian rộng rãi."
    },
    {
        section: "toyota",
        name: "Toyota Wigo",
        price: "350.000.000đ",
        image: "/kholanh/assets/img/toyota-avanza.webp",
        year: 2020,
        seats: 5,
        transmission: "Số sàn",
        details: "Hatchback tiết kiệm, phù hợp cho đô thị."
    },
    {
        section: "toyota",
        name: "Toyota Yaris",
        price: "500.000.000đ",
        image: "/kholanh/assets/img/toyota-wifo.webp",
        year: 2019,
        seats: 5,
        transmission: "Tự động",
        details: "Hatchback thể thao, thiết kế trẻ trung."
    },

];

// Hàm render sản phẩm cho Sản phẩm nổi bật với icon và toggle
function renderFeaturedProducts(typeKeyword) {
    if (document.getElementById('featured-products-container')) {
        const container = document.getElementById('featured-products-container');
        let featuredProducts = productsData.filter(product => product.section === 'featured');
        if (typeKeyword) {
            featuredProducts = featuredProducts.filter(product =>
                (product.details && product.details.toLowerCase().includes(typeKeyword))
            );
        }
        container.innerHTML = '';
        if (featuredProducts.length === 0) {
            container.innerHTML = '<div class="col-12 text-center text-muted py-5">Không có sản phẩm phù hợp.</div>';
            return;
        }
        featuredProducts.forEach((product, index) => {
            const productHtml = `
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="product-card" data-product-id="${index}">
                        <div class="product-front">
                            <img src="${product.image}" alt="${product.name}" class="product-image">
                            <h5 class="text-black mt-2">${product.name}</h5>
                            <p class="text-muted">${product.price}</p>
                            <div class="product-icons">
                                <i class="bi bi-calendar"></i> ${product.year}
                                <i class="bi bi-people"></i> ${product.seats} chỗ
                                <i class="bi bi-gear"></i> ${product.transmission}
                            </div>
                            <div class="product-icon">
                                <i class="bi bi-blockquote-left"></i>
                            </div>
                        </div>
                        <div class="product-back" style="background-color: #f0f8ff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: none;">
                            <div class="product-details">
                                <h5 style="color: #2c3e50;">${product.name}</h5>
                                <p style="color: #34495e;">${product.details}</p>
                                <p style="color: #e74c3c; font-weight: bold;">Giá: ${product.price}</p>
                                <p style="color: #34495e;">Năm: ${product.year} | Số chỗ: ${product.seats} | Hộp số: ${product.transmission}</p>
                                <div class="product-icon">
                                    <i class="bi bi-blockquote-left"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', productHtml);
        });

        // Thêm sự kiện click cho icon toggle
        container.addEventListener('click', (e) => {
            const icon = e.target.closest('.product-icon i');
            if (icon) {
                const card = icon.closest('.product-card');
                const front = card.querySelector('.product-front');
                const back = card.querySelector('.product-back');
                card.classList.toggle('show-details');
                if (card.classList.contains('show-details')) {
                    front.style.display = 'none';
                    back.style.display = 'block';
                } else {
                    front.style.display = 'block';
                    back.style.display = 'none';
                }
                e.stopPropagation();
            }
        });

        // Thêm sự kiện click để chuyển hướng với ID
        container.addEventListener('click', (e) => {
            const card = e.target.closest('.product-card');
            if (card && !e.target.closest('.product-icon')) {
                const productId = card.getAttribute('data-product-id');
                const product = featuredProducts[parseInt(productId)];
                console.log('Product saved to localStorage:', product);
                if (product) {
                    localStorage.setItem('selectedProduct', JSON.stringify(product));
                    window.location.href = "/kholanh/product-detail?id=" + productId;
                } else {
                    console.error('Product not found for id:', productId);
                }
            }
        });

        // Thêm sự kiện hover
        document.querySelectorAll('.featured-products .product-card').forEach(card => {
            const icon = card.querySelector('.product-icon i');
            card.addEventListener('mouseover', () => {
                if (!card.classList.contains('show-details')) {
                    icon.style.opacity = '1';
                }
            });
            card.addEventListener('mouseout', () => {
                if (!card.classList.contains('show-details')) {
                    icon.style.opacity = '0';
                }
            });
        });
    }
}

// Hàm render banner ở giữa với điều hướng - Đã được render từ PHP
function renderBanner() {
    // Banner đã được render từ PHP, không cần JavaScript
}

// Hàm render banner title với điều hướng - Đã được render từ PHP  
function renderBannerTitle() {
    // Banner title đã được render từ PHP, không cần JavaScript
}

document.addEventListener('DOMContentLoaded', function () {
    const featuredTabs = document.querySelectorAll('.featured-products .categories a');
    if (featuredTabs.length) {
        featuredTabs.forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                featuredTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                const type = tab.textContent.trim();
                let keyword = '';
                if (type === 'Hatch Back') keyword = 'hatchback';
                else if (type === 'Sedan') keyword = 'sedan';
                else if (type === 'Pick up') keyword = 'bán tải';
                else if (type === 'MPV') keyword = 'mpv';
                renderFeaturedProducts(keyword);
            });
        });
    }
    renderFeaturedProducts();
    renderBanner();
    renderBannerTitle();
    // Lưu productsData vào localStorage
    localStorage.setItem('productsData', JSON.stringify(productsData));
}); 