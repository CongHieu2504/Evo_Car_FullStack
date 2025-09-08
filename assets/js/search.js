// Giả lập dữ liệu sản phẩm (nên dùng data.js nếu có)
const products = [
    {
        id: 1,
        name: 'Mazda 2',
        price: 514000000,
        year: 2019,
        seats: 7,
        transmission: 'Tự động',
        img: 'assets/img/corolla.webp'
    },
    {
        id: 2,
        name: 'Wigo 4AT',
        price: 405000000,
        year: 2018,
        seats: 4,
        transmission: 'Số sàn',
        img: 'assets/img/toyota-avanza.webp'
    },
    {
        id: 3,
        name: 'Yaris 1.5G CVT',
        price: 650000000,
        year: 2019,
        seats: 5,
        transmission: 'Tự động',
        img: 'assets/img/xe-toyota-vios-2018-khuyen-mai-1.webp'
    }
];

function getSearchKeyword() {
    // Lấy từ khóa từ query string ?q=...
    const params = new URLSearchParams(window.location.search);
    return params.get('q') || '';
}

function filterProducts(keyword) {
    if (!keyword) return [];
    const lower = keyword.toLowerCase();
    return products.filter(p =>
        p.name.toLowerCase().includes(lower)
    );
}

function renderResults() {
    const keyword = getSearchKeyword();
    const results = filterProducts(keyword);
    const container = document.getElementById('search-results');
    container.innerHTML = '';
    if (results.length > 0) {
        container.innerHTML = `
      <div class="search-title">CÓ ${results.length} KẾT QUẢ TÌM KIẾM PHÙ HỢP</div>
      <div class="row" id="search-products-grid"></div>
    `;
        const grid = document.getElementById('search-products-grid');
        results.forEach(product => {
            const col = document.createElement('div');
            col.className = 'col-md-4';
            col.innerHTML = `
        <div class="product-card">
          <img src="${product.img}" alt="${product.name}">
          <div class="product-card-body">
            <div class="product-card-title">${product.name}</div>
            <div class="product-card-price">${product.price.toLocaleString('vi-VN')}₫</div>
            <div class="product-card-meta">
              <span><i class="bi bi-calendar"></i> ${product.year}</span>
              <span><i class="bi bi-people"></i> ${product.seats} chỗ</span>
              <span><i class="bi bi-gear"></i> ${product.transmission}</span>
            </div>
          </div>
        </div>
      `;
            grid.appendChild(col);
        });
    } else {
        container.innerHTML = `
      <div class="search-empty-title">KHÔNG TÌM THẤY BẤT KỲ KẾT QUẢ NÀO VỚI TỪ KHÓA TRÊN.</div>
      <div class="search-empty-desc">Vui lòng nhập từ khóa tìm kiếm khác</div>
      <form class="search-form" id="search-form">
        <input type="text" name="q" placeholder="Bạn cần tìm gì hôm nay?" value="${keyword}">
        <button type="submit"><i class="bi bi-search"></i></button>
      </form>
    `;
        document.getElementById('search-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const q = this.q.value.trim();
            if (q) {
                window.location.href = `search.html?q=${encodeURIComponent(q)}`;
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', renderResults); 