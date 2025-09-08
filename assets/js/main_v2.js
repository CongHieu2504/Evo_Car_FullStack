console.log('==== MAIN JS LOADED ====');

// Header
document.querySelectorAll('.dropdown').forEach(dropdown => {
    dropdown.addEventListener('click', (e) => {
        const mainLink = dropdown.querySelector('a');
        if (e.target === mainLink) {
            return;
        }
        e.preventDefault();
        dropdown.classList.toggle('active');
    });
});

// Toggle modal khi nhấn nút ☰ trên mobile
document.querySelector('.mobile-nav-toggle').addEventListener('click', () => {
    if (window.innerWidth <= 768) {
        const modal = document.querySelector('#mobile-nav-modal');
        modal.classList.toggle('active');
    }
});

// Đóng modal khi nhấn nút close
document.querySelector('#modal-close').addEventListener('click', () => {
    const modal = document.querySelector('#mobile-nav-modal');
    modal.classList.remove('active');
});

// Đóng modal khi nhấn vào overlay
document.querySelector('.modal-overlay').addEventListener('click', (e) => {
    if (e.target === document.querySelector('.modal-overlay')) {
        const modal = document.querySelector('#mobile-nav-modal');
        modal.classList.remove('active');
    }
});

// Toggle sub-menu for Sản Phẩm
document.querySelector('.modal-product-toggle').addEventListener('click', (e) => {
    e.preventDefault();
    const dropdown = e.currentTarget.closest('.modal-dropdown');
    const subMenu = dropdown.querySelector('.modal-sub-menu');
    const toggleIcon = dropdown.querySelector('.toggle-icon');
    const isActive = dropdown.classList.contains('active');

    if (!isActive) {
        subMenu.innerHTML = `
            <li><a href="#">Hatch Back</a></li>
            <li><a href="#">Sedan</a></li>
            <li><a href="#">Pick Up</a></li>
            <li><a href="#">MPV</a></li>
            <li><a href="#">SUV</a></li>
            <li><a href="#">Crossover</a></li>
            <li><a href="#">Coupe - Xe Thế Thao</a></li>
            <li><a href="#">Convertible - Xe Mui Trần</a></li>
        `;
        dropdown.classList.add('active');
        toggleIcon.textContent = '-';
    } else {
        subMenu.innerHTML = '';
        dropdown.classList.remove('active');
        toggleIcon.textContent = '+';
    }
});

// Toggle sub-menu for Tin tức
document.querySelector('.modal-news-toggle').addEventListener('click', (e) => {
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

// Thêm sự kiện click cho các mục menu mobile
// Sản Phẩm
const mobileProduct = document.querySelector('.modal-product-toggle');
if (mobileProduct) {
    mobileProduct.addEventListener('dblclick', function (e) {
        // Nếu người dùng double click vào "Sản Phẩm" thì chuyển trang
        window.location.href = '/kholanh/san-pham';
    });
}
// Tin tức
const mobileNews = document.querySelector('.modal-news-toggle');
if (mobileNews) {
    mobileNews.addEventListener('dblclick', function (e) {
        window.location.href = '/kholanh/tin-tuc';
    });
}
// Liên hệ
const mobileContact = document.querySelector('.modal-menu a[href="/kholanh/lien-he"]');
if (mobileContact) {
    mobileContact.addEventListener('click', function (e) {
        window.location.href = '/kholanh/lien-he';
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // KHỞI TẠO SWIPER CHO TOYOTA
    if (document.querySelector('.toyota-swiper')) {
        var toyotaSwiper = new Swiper('.toyota-swiper', {
            slidesPerView: 4,
            spaceBetween: 24,
            loop: true,
            navigation: {
                nextEl: '.toyota-swiper .swiper-button-next',
                prevEl: '.toyota-swiper .swiper-button-prev',
            },
            pagination: {
                el: '.toyota-swiper .swiper-pagination',
                clickable: true,
            },
            allowTouchMove: false,
            breakpoints: {
                0: { slidesPerView: 1, spaceBetween: 10 },
                576: { slidesPerView: 2, spaceBetween: 15 },
                992: { slidesPerView: 4, spaceBetween: 24 }
            }
        });
        console.log('Swiper Toyota đã khởi tạo:', toyotaSwiper);
        // Ép khởi tạo lại sau 200ms nếu lần đầu không bấm được
        setTimeout(function () {
            if (typeof toyotaSwiper.update === 'function') {
                toyotaSwiper.update();
                toyotaSwiper.updateSlides && toyotaSwiper.updateSlides();
                toyotaSwiper.updateProgress && toyotaSwiper.updateProgress();
                toyotaSwiper.updateSlidesClasses && toyotaSwiper.updateSlidesClasses();
                console.log('Swiper Toyota ép update lại!');
            }
        }, 200);
    }

    // Khởi tạo Swiper cho Banner
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
            576: {
                slidesPerView: 2,
                slidesPerGroup: 2,
                spaceBetween: 15,
            },
            992: {
                slidesPerView: 3,
                slidesPerGroup: 3,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 4,
                slidesPerGroup: 4,
                spaceBetween: 20,
            }
        }
    });

    // Khởi tạo Swiper cho Banner Title
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
            576: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 20,
            }
        }
    });

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

    // Logic hiệu ứng cho mục Toyota (từ FE gốc)
    const toyotaContainer = document.getElementById('toyota-container');
    if (toyotaContainer) {
        // Thêm sự kiện click cho icon toggle (flip card)
        toyotaContainer.addEventListener('click', (e) => {
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

        // Thêm sự kiện click để chuyển hướng chi tiết sản phẩm
        toyotaContainer.addEventListener('click', (e) => {
            const card = e.target.closest('.product-card');
            if (card && !e.target.closest('.product-icon')) {
                const productId = card.getAttribute('data-product-id');
                if (productId && !productId.startsWith('toyota-sample-')) {
                    // Chuyển đến trang chi tiết sản phẩm
                    window.location.href = '/kholanh/shops/rows/site_details/' + productId;
                }
            }
        });

        // Thêm sự kiện hover cho icon
        document.querySelectorAll('.toyota-swiper .product-card').forEach(card => {
            const icon = card.querySelector('.product-icon i');
            if (icon) {
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
            }
        });
    }
});