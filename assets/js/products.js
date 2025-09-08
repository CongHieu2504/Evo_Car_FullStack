// Đã chuyển sang render sản phẩm bằng PHP, không dùng JS nữa
// (Đã xoá toàn bộ JS cũ để không ảnh hưởng sidebar danh mục)

// Sidebar submenu toggle (đa cấp, chỉ mở 1 mục cùng cấp)
document.querySelectorAll('.sidebar-menu .toggle-icon').forEach(function (toggle) {
    toggle.addEventListener('click', function (e) {
        e.stopPropagation();
        var li = this.closest('li');
        var submenu = li.querySelector('ul.submenu');
        if (submenu) {
            var isOpen = submenu.style.display === 'block';
            submenu.style.display = isOpen ? 'none' : 'block';
            this.textContent = isOpen ? '+' : '-';
        }
    });
});

// Đảm bảo các submenu con ẩn mặc định
window.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.sidebar-menu .has-submenu .submenu').forEach(sub => {
        if (!sub.parentElement.classList.contains('active')) {
            sub.style.display = 'none';
        }
    });
});