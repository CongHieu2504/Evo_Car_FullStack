console.log('main.js loaded');

// Header
const dropdowns = document.querySelectorAll('.dropdown');
dropdowns.forEach(dropdown => {
    dropdown.addEventListener('click', (e) => {
        // Nếu click vào thẻ <a> trong dropdown-menu thì không chặn, để chuyển trang
        if (e.target.tagName === 'A' && e.target.getAttribute('href') && e.target.getAttribute('href') !== '#') {
            return;
        }
        e.preventDefault();
        dropdown.classList.toggle('active');
    });
});

// Toggle modal khi nhấn nút ☰ trên mobile
const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
if (mobileNavToggle) {
    mobileNavToggle.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
            const modal = document.querySelector('#mobile-nav-modal');
            if (modal) {
                modal.classList.toggle('active');
                // Khi mở menu, cuộn lên đầu để thấy hết phần đầu menu
                const content = modal.querySelector('.modal-content');
                if (content) content.scrollTop = 0;
            }
        }
    });
}

// Đóng modal khi nhấn nút close
const modalClose = document.querySelector('#modal-close');
if (modalClose) {
    modalClose.addEventListener('click', () => {
        const modal = document.querySelector('#mobile-nav-modal');
        if (modal) modal.classList.remove('active');
    });
}

// Đóng modal khi nhấn vào overlay
const modalOverlay = document.querySelector('.modal-overlay');
if (modalOverlay) {
    modalOverlay.addEventListener('click', (e) => {
        if (e.target === modalOverlay) {
            const modal = document.querySelector('#mobile-nav-modal');
            if (modal) modal.classList.remove('active');
        }
    });
}

// Toggle sub-menu for Sản Phẩm
const modalProductToggle = document.querySelector('.modal-product-toggle');
if (modalProductToggle) {
    modalProductToggle.addEventListener('click', (e) => {
        e.preventDefault();
        const dropdown = e.currentTarget.closest('.modal-dropdown');
        const subMenu = dropdown.querySelector('.modal-sub-menu');
        const toggleIcon = dropdown.querySelector('.toggle-icon');
        const isActive = dropdown.classList.contains('active');

        if (!isActive) {
            // Lấy ID động từ window.CAT_IDS (được inject từ layout)
            const C = (window.CAT_IDS || {});
            const idHB = C['HATCH BACK'] || 1;
            const idSedan = C['SEDAN'] || 2;
            const idPick = C['PICK UP'] || 3;
            const idMPV = C['MPV'] || 4;
            const idSUV = C['SUV'] || 5;
            const idCrossover = C['CROSSOVER'] || 6;
            const idCoupe = C['COUPE – XE THỂ THAO'] || 7;
            const idConvertible = C['CONVERTIBLE – XE MUI TRẦN'] || 8;
            subMenu.innerHTML = `
                <li class="modal-sub-category">
                    <a href="#" class="modal-category-toggle" title="Click tên để lọc tất cả Hatch Back, Click dấu + để mở danh sách xe">
                        <span class="category-link" onclick="console.log('Click vào Hatch Back - lọc tất cả Hatch Back'); window.location.href='/kholanh/products?cat=${idHB}'">Hatch Back</span> <span class="sub-toggle-icon">+</span>
                    </a>
                    <ul class="modal-sub-sub-menu">
                        <li><a href="/kholanh/products?cat=11" onclick="console.log('Click vào Hyundai i10')">Hyundai i10</a></li>
                        <li><a href="/kholanh/products?cat=15" onclick="console.log('Click vào Ford Focus')">Ford Focus</a></li>
                        <li><a href="/kholanh/products?cat=16" onclick="console.log('Click vào Toyota Yaris')">Toyota Yaris</a></li>
                        <li><a href="/kholanh/products?cat=22" onclick="console.log('Click vào KIA Morning')">KIA Morning</a></li>
                        <li><a href="/kholanh/products?cat=31" onclick="console.log('Click vào Suzuki Celerio')">Suzuki Celerio</a></li>
                        <li><a href="/kholanh/products?cat=32" onclick="console.log('Click vào Chevrolet Spark')">Chevrolet Spark</a></li>
                    </ul>
                </li>
                <li><a href="/kholanh/products?cat=${idSedan}">Sedan</a></li>
                <li><a href="/kholanh/products?cat=${idPick}">Pick Up</a></li>
                <li><a href="/kholanh/products?cat=${idMPV}">MPV</a></li>
                <li><a href="/kholanh/products?cat=${idSUV}">SUV</a></li>
                <li><a href="/kholanh/products?cat=${idCrossover}">Crossover</a></li>
                <li><a href="/kholanh/products?cat=${idCoupe}">Coupe - Xe Thể Thao</a></li>
                <li><a href="/kholanh/products?cat=${idConvertible}">Convertible - Xe Mui Trần</a></li>
            `;
            dropdown.classList.add('active');
            toggleIcon.textContent = '-';

            // Thêm event listener cho sub-category toggle
            const categoryToggle = subMenu.querySelector('.modal-category-toggle');
            if (categoryToggle) {
                categoryToggle.addEventListener('click', function (e) {
                    // Nếu click vào category-link thì không chặn
                    if (e.target.classList.contains('category-link')) {
                        return;
                    }

                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Click vào Hatch Back submenu');
                    const subSubMenu = this.nextElementSibling;
                    const subToggleIcon = this.querySelector('.sub-toggle-icon');
                    const isSubActive = subSubMenu.style.display === 'block';

                    if (!isSubActive) {
                        subSubMenu.style.display = 'block';
                        subToggleIcon.textContent = '-';
                        console.log('Mở submenu Hatch Back');
                    } else {
                        subSubMenu.style.display = 'none';
                        subToggleIcon.textContent = '+';
                        console.log('Đóng submenu Hatch Back');
                    }
                });
            }
        } else {
            subMenu.innerHTML = '';
            dropdown.classList.remove('active');
            toggleIcon.textContent = '+';
        }
    });
}

// Toggle sub-menu for Tin tức
const modalNewsToggle = document.querySelector('.modal-news-toggle');
if (modalNewsToggle) {
    modalNewsToggle.addEventListener('click', (e) => {
        e.preventDefault();
        const dropdown = e.currentTarget.closest('.modal-dropdown');
        const subMenu = dropdown.querySelector('.modal-news-sub-menu');
        const toggleIcon = dropdown.querySelector('.toggle-icon');
        const isActive = dropdown.classList.contains('active');

        if (!isActive) {
            dropdown.classList.add('active');
            toggleIcon.textContent = '-';
        } else {
            dropdown.classList.remove('active');
            toggleIcon.textContent = '+';
        }
    });
}

// Thêm sự kiện click cho các mục menu mobile
// Sản Phẩm - Double click để vào trang
const mobileProduct = document.querySelector('.modal-product-toggle');
if (mobileProduct) {
    mobileProduct.addEventListener('dblclick', function (e) {
        e.preventDefault();
        console.log('Double click Sản phẩm - chuyển trang');
        window.location.href = '/kholanh/products';
    });
}
// Tin tức - Double click để vào trang
const mobileNews = document.querySelector('.modal-news-toggle');
if (mobileNews) {
    mobileNews.addEventListener('dblclick', function (e) {
        e.preventDefault();
        console.log('Double click Tin tức - chuyển trang');
        window.location.href = '/kholanh/news';
    });
}

function bindQuickInfoEvents() {
    document.querySelectorAll('.quick-menu-icon').forEach(function (icon) {
        icon.onclick = function (e) {
            e.stopPropagation();
            var id = this.getAttribute('data-product-id');
            var box = document.getElementById('quick-info-' + id);
            if (box) {
                box.style.display = (box.style.display === 'none' || box.style.display === '') ? 'block' : 'none';
            }
        };
    });
    document.querySelectorAll('.close-quick-info').forEach(function (btn) {
        btn.onclick = function (e) {
            e.stopPropagation();
            this.closest('.quick-info-box').style.display = 'none';
        };
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Khởi tạo Swiper cho Toyota
    if (document.querySelector('.toyota-swiper')) {
        var toyotaSwiper = new Swiper('.toyota-swiper', {
            slidesPerView: 4,
            spaceBetween: 24,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                576: {
                    slidesPerView: 2,
                    spaceBetween: 15,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 24,
                }
            }
        });
    }

    // Khởi tạo Swiper cho Banner
    if (document.querySelector('.banner-swiper')) {
        var bannerSwiper = new Swiper('.banner-swiper', {
            slidesPerView: 4,
            slidesPerGroup: 4,
            spaceBetween: 20,
            loop: true,
            loopFillGroupWithBlank: true,
            pagination: {
                el: '.banner-swiper .swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    spaceBetween: 10,
                },
                992: {
                    slidesPerView: 2,
                    slidesPerGroup: 2,
                    spaceBetween: 15,
                },
                1200: {
                    slidesPerView: 3,
                    slidesPerGroup: 3,
                    spaceBetween: 20,
                },
                1400: {
                    slidesPerView: 4,
                    slidesPerGroup: 4,
                    spaceBetween: 20,
                }
            }
        });
    }

    // Khởi tạo Swiper cho Banner Title
    if (document.querySelector('.banner-title-swiper')) {
        var bannerTitleSwiper = new Swiper('.banner-title-swiper', {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                992: {
                    slidesPerView: 2,
                    spaceBetween: 15,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                }
            }
        });
    }

    // Force refresh swipers khi resize window
    window.addEventListener('resize', function () {
        if (bannerSwiper) {
            bannerSwiper.update();
        }
        if (bannerTitleSwiper) {
            bannerTitleSwiper.update();
        }
        if (toyotaSwiper) {
            toyotaSwiper.update();
        }
    });

    // Force refresh swipers sau khi load xong
    setTimeout(function () {
        if (bannerSwiper) {
            bannerSwiper.update();
        }
        if (bannerTitleSwiper) {
            bannerTitleSwiper.update();
        }
        if (toyotaSwiper) {
            toyotaSwiper.update();
        }
    }, 100);

    // --- Floating Zalo Chat & Notification Bell ---
    if (!document.getElementById('floating-chat-btn')) {
        const chatBtn = document.createElement('div');
        chatBtn.id = 'floating-chat-btn';
        chatBtn.className = 'floating-chat-btn';
        chatBtn.innerHTML = '<i class="bi bi-chat-dots-fill"></i>';
        chatBtn.title = 'Chat Zalo';
        chatBtn.onclick = function () {
            window.open('https://zalo.me/your-zalo-id', '_blank');
        };
        document.body.appendChild(chatBtn);
    }
    if (!document.getElementById('floating-bell-btn')) {
        const bellBtn = document.createElement('div');
        bellBtn.id = 'floating-bell-btn';
        bellBtn.className = 'floating-bell-btn';
        bellBtn.innerHTML = '<i class="bi bi-bell-fill"></i>';
        bellBtn.title = 'Thông báo';
        bellBtn.onclick = function () {
            const popup = document.getElementById('bell-popup');
            popup.classList.toggle('active');
        };
        document.body.appendChild(bellBtn);
    }
    if (!document.getElementById('bell-popup')) {
        const popup = document.createElement('div');
        popup.id = 'bell-popup';
        popup.className = 'bell-popup';
        popup.innerHTML = `
            <button class="bell-popup-close" title="Đóng">&times;</button>
            <h4>Tích hợp sẵn các ứng dụng</h4>
            <ul>
                <li><i class="bi bi-chevron-double-right"></i> Đánh giá sản phẩm</li>
                <li><i class="bi bi-chevron-double-right"></i> Mua X tặng Y</li>
                <li><i class="bi bi-chevron-double-right"></i> Ứng dụng Affiliate</li>
                <li><i class="bi bi-chevron-double-right"></i> Đa ngôn ngữ</li>
                <li><i class="bi bi-chevron-double-right"></i> Chatlive Facebook</li>
            </ul>
            <div class="bell-popup-note">
                Lưu ý với các ứng dụng trả phí bạn cần cài đặt và mua ứng dụng này trên App store Sapo để sử dụng ngay
            </div>
        `;
        document.body.appendChild(popup);
        popup.querySelector('.bell-popup-close').onclick = function () {
            popup.classList.remove('active');
        };
    }

    // Filter sản phẩm nổi bật theo type (debug)
    const featuredTabs = document.querySelectorAll('.filter-tab');
    const featuredCards = document.querySelectorAll('.featured-products .col-md-3.mb-4');
    if (featuredTabs.length) {
        featuredTabs.forEach(t => t.classList.remove('active'));
        featuredTabs[0].classList.add('active');
        function filterFeatured(type) {
            featuredCards.forEach(card => {
                const cardType = (card.getAttribute('data-type') || '').trim().toLowerCase();
                if (type === '' || type === 'tất cả' || cardType === type) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        filterFeatured('tất cả');
        featuredTabs.forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                featuredTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                const selectedType = tab.textContent.trim().toLowerCase();
                filterFeatured(selectedType);
            });
        });
    }

    // Event delegation cho quick info trong Sản phẩm nổi bật
    var featuredSection = document.querySelector('.featured-products');
    if (featuredSection) {
        featuredSection.addEventListener('click', function (e) {
            const icon = e.target.closest('.quick-menu-icon');
            if (icon) {
                e.stopPropagation();
                var id = icon.getAttribute('data-product-id');
                var box = document.getElementById('quick-info-' + id);
                if (box) {
                    box.style.display = (box.style.display === 'none' || box.style.display === '') ? 'block' : 'none';
                }
            }
            const closeBtn = e.target.closest('.close-quick-info');
            if (closeBtn) {
                e.stopPropagation();
                closeBtn.closest('.quick-info-box').style.display = 'none';
            }
        });
    }

    // Event delegation cho quick info trong TOYOTA
    var toyotaSection = document.querySelector('.toyota-products');
    if (toyotaSection) {
        toyotaSection.addEventListener('click', function (e) {
            const icon = e.target.closest('.quick-menu-icon');
            if (icon) {
                e.stopPropagation();
                var id = icon.getAttribute('data-product-id');
                var box = document.getElementById('quick-info-' + id);
                if (box) {
                    box.style.display = (box.style.display === 'none' || box.style.display === '') ? 'block' : 'none';
                }
            }
            const closeBtn = e.target.closest('.close-quick-info');
            if (closeBtn) {
                e.stopPropagation();
                closeBtn.closest('.quick-info-box').style.display = 'none';
            }
        });
    }

    var btnSearch = document.getElementById('btn-search');
    if (btnSearch) {
        btnSearch.addEventListener('click', function () {
            var keyword = document.getElementById('search-keyword').value.trim();
            var type = document.getElementById('search-type').value;
            var brand = document.getElementById('search-brand').value;
            var params = [];
            if (keyword) params.push('query=' + encodeURIComponent(keyword));
            if (type && type !== 'all') params.push('type=' + encodeURIComponent(type));
            if (brand && brand !== 'all') params.push('brand=' + encodeURIComponent(brand));
            var url = '/kholanh/search-new';
            if (params.length > 0) url += '?' + params.join('&');
            window.location.href = url;
        });
    }
});