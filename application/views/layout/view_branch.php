<!-- Store Locator Section -->
<section class="store-locator">
    <div class="store-search">
        <select id="province-select" class="form-select mb-4" aria-label="Chọn tỉnh/thành phố">
            <option value="">Chọn tỉnh/thành phố</option>
            <option value="hcm">Hồ Chí Minh</option>
            <option value="hanoi">Hà Nội</option>
            <!-- Thêm các tỉnh khác nếu cần -->
        </select>
    </div>
    <div class="store-content">
        <!-- Danh sách cửa hàng -->
        <div class="store-sidebar" id="store-list">
            <!-- Danh sách địa chỉ sẽ được thêm bằng JavaScript -->
        </div>
        <!-- Bản đồ -->
        <div class="store-map">
            <iframe id="map-frame" src="" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>

<script>
    // Dữ liệu địa chỉ
    const branches = {
        hcm: [
            { name: "70 Lữ Gia, Quận 11, TP.HCM", phone: "0905 123 456", hours: "8:00 - 17:00", query: "70+Lữ+Gia,+Quận+11,+TP.HCM" },
            { name: "138A Đ. Tô Hiến Thành, Quận 10, TP.HCM", phone: "0905 234 567", hours: "8:00 - 17:00", query: "138A+Tô+Hiến+Thành,+Quận+10,+TP.HCM" },
            { name: "215A Lý Thường Kiệt, Quận 11, TP.HCM", phone: "0905 345 678", hours: "8:00 - 17:00", query: "215A+Lý+Thường+Kiệt,+Quận+11,+TP.HCM" },
            { name: "584 Âu Cơ, Quận Tân Bình, TP.HCM", phone: "0905 456 789", hours: "8:00 - 17:00", query: "584+Âu+Cơ,+Quận+Tân+Bình,+TP.HCM" },
            { name: "615A Âu Cơ, Quận Tân Phú, TP.HCM", phone: "0905 567 890", hours: "8:00 - 17:00", query: "615A+Âu+Cơ,+Quận+Tân+Phú,+TP.HCM" }
        ],
        hanoi: [
            { name: "266 Đội Cấn, Ba Đình, Hà Nội", phone: "0905 678 901", hours: "8:00 - 17:00", query: "266+Đội+Cấn,+Ba+Đình,+Hà+Nội" },
            { name: "1 Phạm Văn Đồng, Cầu Giấy, Hà Nội", phone: "0905 789 012", hours: "8:00 - 17:00", query: "1+Phạm+Văn+Đồng,+Cầu+Giấy,+Hà+Nội" }
        ]
    };
    
    // Tham chiếu các phần tử
    const provinceSelect = document.getElementById('province-select');
    const storeList = document.getElementById('store-list');
    const mapFrame = document.getElementById('map-frame');
    
    // Hàm cập nhật danh sách địa chỉ
    function updateBranchList(province) {
        storeList.innerHTML = '';
        if (branches[province]) {
            branches[province].forEach((branch, idx) => {
                const div = document.createElement('div');
                div.className = 'store-item';
                div.innerHTML = `
                    <strong>${branch.name}</strong>
                    <p>SĐT: ${branch.phone}</p>
                    <p>Giờ mở cửa: ${branch.hours}</p>
                `;
                div.addEventListener('click', () => {
                    mapFrame.src = `https://www.google.com/maps?q=${branch.query}&output=embed`;
                    document.querySelectorAll('.store-item').forEach(item => item.classList.remove('active'));
                    div.classList.add('active');
                });
                storeList.appendChild(div);
            });
        }
    }
    
    // Sự kiện khi chọn tỉnh/thành phố
    provinceSelect.addEventListener('change', function () {
        updateBranchList(this.value);
        mapFrame.src = '';
        // Nếu có đại lý, tự động chọn và hiển thị bản đồ đại lý đầu tiên
        if (branches[this.value] && branches[this.value][0]) {
            const firstBranch = branches[this.value][0];
            mapFrame.src = `https://www.google.com/maps?q=${firstBranch.query}&output=embed`;
            setTimeout(() => {
                const firstItem = storeList.querySelector('.store-item');
                if (firstItem) firstItem.classList.add('active');
            }, 0);
        }
    });
    
    // Khởi tạo với địa điểm mặc định (nếu có)
    updateBranchList('hcm');
    const firstBranch = branches['hcm'] && branches['hcm'][0];
    if (firstBranch) {
        mapFrame.src = `https://www.google.com/maps?q=${firstBranch.query}&output=embed`;
        setTimeout(() => {
            const firstItem = storeList.querySelector('.store-item');
            if (firstItem) firstItem.classList.add('active');
        }, 0);
    }
</script> 