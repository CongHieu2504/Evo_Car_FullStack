// News data
const newsData = [
    {
        id: 1,
        title: "BMW 1-Series 2020: Khi X2 được thu nhỏ",
        excerpt: "BMW 1-Series thế hệ mới mang đến thiết kế táo bạo và hiệu suất vượt trội với động cơ tăng áp hiện đại.",
        image: "assets/img/corolla.webp",
        category: "BMW",
        author: "Evo Themes",
        date: "15/11/2024",
        content: "BMW 1-Series 2020 là bước tiến lớn trong phân khúc hatchback hạng sang..."
    },
    {
        id: 2,
        title: "Cận cảnh 'chiến binh sa mạc' Audi TT Safari",
        excerpt: "Audi TT Safari được thiết kế đặc biệt để chinh phục những địa hình khó khăn với phong cách off-road độc đáo.",
        image: "assets/img/mitsubishi-triton-4x2-at-mivec-10l-2019.webp",
        category: "AUDI",
        author: "Evo Themes",
        date: "14/11/2024",
        content: "Audi TT Safari mang đến trải nghiệm off-road hoàn toàn mới..."
    },
    {
        id: 3,
        title: "'Hổ hàng' nhà Mercedes-Benz ra mắt siêu xe mạnh 1.200 mã lực",
        excerpt: "Mercedes-AMG One với động cơ F1 mang đến sức mạnh khủng khiếp 1.200 mã lực, thiết lập kỷ lục mới.",
        image: "assets/img/nguoi-dua-tin-toyota-rush-2018-ra-mat-thai-lan-1-jpeg.webp",
        category: "MERCEDES",
        author: "Evo Themes",
        date: "13/11/2024",
        content: "Mercedes-AMG One là siêu xe hybrid đỉnh cao với công nghệ F1..."
    },
    {
        id: 4,
        title: "Bộ đôi Mercedes-AMG G63 cực ngầu của Brabus, sản xuất đúng 20 chiếc",
        excerpt: "Brabus giới thiệu phiên bản giới hạn Mercedes-AMG G63 với ngoại hình agressive và sức mạnh vượt trội.",
        image: "assets/img/toyota-avanza.webp",
        category: "MERCEDES",
        author: "Evo Themes",
        date: "12/11/2024",
        content: "Brabus Mercedes-AMG G63 phiên bản giới hạn chỉ 20 chiếc..."
    },
    {
        id: 5,
        title: "Hyundai Kona hybrid cuối cùng cũng chính thức lộ diện",
        excerpt: "Hyundai Kona hybrid thế hệ mới với thiết kế hiện đại và hệ thống hybrid tiết kiệm nhiên liệu vượt trội.",
        image: "assets/img/toyota-wifo.webp",
        category: "HYUNDAI",
        author: "Evo Themes",
        date: "11/11/2024",
        content: "Hyundai Kona hybrid mang đến giải pháp di chuyển thân thiện môi trường..."
    },
    {
        id: 6,
        title: "Chevrolet Trailblazer - SUV 7 chỗ trang bị nhiều công nghệ an toàn cao",
        excerpt: "Chevrolet Trailblazer với không gian 7 chỗ rộng rãi và hàng loạt công nghệ an toàn tiên tiến cho gia đình.",
        image: "assets/img/xe-toyota-vios-2018-khuyen-mai-1.webp",
        category: "CHEVROLET",
        author: "Evo Themes",
        date: "10/11/2024",
        content: "Chevrolet Trailblazer là lựa chọn hoàn hảo cho gia đình đông thành viên..."
    },
    {
        id: 7,
        title: "Toyota Corolla Cross 2024: Crossover đa năng cho mọi gia đình",
        excerpt: "Toyota Corolla Cross 2024 kết hợp ưu điểm của sedan và SUV, mang đến giải pháp di chuyển linh hoạt.",
        image: "assets/img/corolla.webp",
        category: "TOYOTA",
        author: "Evo Themes",
        date: "09/11/2024",
        content: "Toyota Corolla Cross là crossover compact lý tưởng..."
    },
    {
        id: 8,
        title: "Mazda CX-5 2024: Nâng cấp toàn diện về thiết kế và công nghệ",
        excerpt: "Mazda CX-5 2024 được nâng cấp với thiết kế KODO mới và loạt công nghệ i-Activsense tiên tiến.",
        image: "assets/img/mitsubishi-triton-4x2-at-mivec-10l-2019.webp",
        category: "MAZDA",
        author: "Evo Themes",
        date: "08/11/2024",
        content: "Mazda CX-5 2024 tiếp tục khẳng định vị thế trong phân khúc SUV..."
    },
    {
        id: 9,
        title: "Ford Ranger Raptor 2024: Bán tải hiệu suất cao cho dân chơi off-road",
        excerpt: "Ford Ranger Raptor 2024 với hệ thống treo Fox, động cơ twin-turbo mạnh mẽ cho những chuyến phiêu lưu.",
        image: "assets/img/nguoi-dua-tin-toyota-rush-2018-ra-mat-thai-lan-1-jpeg.webp",
        category: "FORD",
        author: "Evo Themes",
        date: "07/11/2024",
        content: "Ford Ranger Raptor là chiếc bán tải off-road hàng đầu..."
    },
    {
        id: 10,
        title: "Volkswagen Tiguan Allspace: SUV 7 chỗ Đức cao cấp",
        excerpt: "Volkswagen Tiguan Allspace mang đến không gian 7 chỗ rộng rãi với chất lượng Đức đặc trưng.",
        image: "assets/img/toyota-avanza.webp",
        category: "VOLKSWAGEN",
        author: "Evo Themes",
        date: "06/11/2024",
        content: "Volkswagen Tiguan Allspace định nghĩa lại SUV 7 chỗ cao cấp..."
    },
    {
        id: 11,
        title: "Subaru Outback: Wagon đa địa hình cho gia đình năng động",
        excerpt: "Subaru Outback kết hợp ưu điểm của wagon và SUV với hệ dẫn động 4 bánh toàn thời gian Symmetrical AWD.",
        image: "assets/img/toyota-wifo.webp",
        category: "SUBARU",
        author: "Evo Themes",
        date: "05/11/2024",
        content: "Subaru Outback là chiếc wagon off-road độc đáo..."
    },
    {
        id: 12,
        title: "Land Rover Defender 2024: Huyền thoại off-road tái sinh",
        excerpt: "Land Rover Defender 2024 kế thừa tinh thần off-road huyền thoại với công nghệ hiện đại nhất.",
        image: "assets/img/xe-toyota-vios-2018-khuyen-mai-1.webp",
        category: "LAND ROVER",
        author: "Evo Themes",
        date: "04/11/2024",
        content: "Land Rover Defender tiếp tục là biểu tượng của khả năng off-road..."
    }
];

// Pagination configuration
const itemsPerPage = 8;
let currentPage = 1;

// Initialize news page
document.addEventListener('DOMContentLoaded', function () {
    renderNews();
    renderPagination();
});

// Render news items
function renderNews() {
    const newsGrid = document.getElementById('news-grid');
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const currentNews = newsData.slice(startIndex, endIndex);

    newsGrid.innerHTML = '';

    currentNews.forEach(news => {
        const newsHtml = `
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="news-item" onclick="viewNewsDetail(${news.id})">
                    <img src="${news.image}" alt="${news.title}" class="news-image">
                    <div class="news-content">
                        <span class="news-category">${news.category}</span>
                        <h3 class="news-title-item">${news.title}</h3>
                        <p class="news-excerpt">${news.excerpt}</p>
                        <div class="news-meta">
                            <div class="news-date">
                                <i class="bi bi-calendar3"></i>
                                <span>${news.date}</span>
                            </div>
                            <div class="news-author">
                                <i class="bi bi-person-circle"></i>
                                <span>${news.author}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        newsGrid.insertAdjacentHTML('beforeend', newsHtml);
    });
}

// Render pagination
function renderPagination() {
    const pagination = document.getElementById('pagination');
    const totalPages = Math.ceil(newsData.length / itemsPerPage);

    pagination.innerHTML = '';

    // Previous button
    const prevDisabled = currentPage === 1 ? 'disabled' : '';
    pagination.insertAdjacentHTML('beforeend', `
        <li class="page-item ${prevDisabled}">
            <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">
                <i class="bi bi-chevron-left"></i>
                <span class="page-text">Trước</span>
            </a>
        </li>
    `);

    // Page numbers
    for (let i = 1; i <= totalPages; i++) {
        const active = i === currentPage ? 'active' : '';
        pagination.insertAdjacentHTML('beforeend', `
            <li class="page-item ${active}">
                <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
            </li>
        `);
    }

    // Next button
    const nextDisabled = currentPage === totalPages ? 'disabled' : '';
    pagination.insertAdjacentHTML('beforeend', `
        <li class="page-item ${nextDisabled}">
            <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">
                <span class="page-text">Sau</span>
                <i class="bi bi-chevron-right"></i>
            </a>
        </li>
    `);
}

// Change page function
function changePage(page) {
    const totalPages = Math.ceil(newsData.length / itemsPerPage);

    if (page < 1 || page > totalPages) return;

    currentPage = page;
    renderNews();
    renderPagination();

    // Scroll to top of news section
    document.querySelector('.news-section').scrollIntoView({
        behavior: 'smooth'
    });
}

// View news detail function
function viewNewsDetail(newsId) {
    window.location.href = "/kholanh/product-title?id=" + newsId;
} 