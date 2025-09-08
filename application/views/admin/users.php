<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 10px 20px;
        }
        .sidebar .nav-link:hover {
            background: #495057;
        }
        .sidebar .nav-link.active {
            background: #007bff;
        }
        .main-content {
            padding: 20px;
        }
        .stats-card {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .btn-action {
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            margin: 2px;
            font-size: 12px;
        }
        .btn-edit {
            background: #28a745;
            color: white;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-view {
            background: #17a2b8;
            color: white;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-active {
            background: #d4edda;
            color: #155724;
        }
        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }
        .role-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .role-admin {
            background: #d1ecf1;
            color: #0c5460;
        }
        .role-manager {
            background: #fff3cd;
            color: #856404;
        }
        .role-member {
            background: #e2e3e5;
            color: #383d41;
        }
        
        /* Responsive Table Styles */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: #007bff;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        /* Mobile optimizations */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                width: 280px;
                max-width: 80vw;
                z-index: 1000;
                transition: left 0.3s ease;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 10px;
            }
            
            .sidebar-overlay.show {
                display: block;
            }
            
            .btn-action {
                padding: 4px 8px;
                font-size: 11px;
                margin: 1px;
            }
            
            .status-badge, .role-badge {
                padding: 3px 8px;
                font-size: 10px;
            }
        }
        
        @media (max-width: 576px) {
            .btn-action {
                padding: 3px 6px;
                font-size: 10px;
            }
            
            .stats-card {
                padding: 15px;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Mobile Menu Toggle -->
            <div class="d-lg-none w-100 mb-3">
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="fas fa-bars me-2"></i>Menu
                </button>
            </div>
            
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar" id="sidebar">
                <div class="d-flex flex-column p-3">
                    <h4 class="text-white mb-4">Admin Panel</h4>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin'); ?>" class="nav-link">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/users'); ?>" class="nav-link active">
                                <i class="fas fa-users me-2"></i>
                                Quản lý User
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/products'); ?>" class="nav-link">
                                <i class="fas fa-car me-2"></i>
                                Quản lý Sản phẩm
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/news'); ?>" class="nav-link">
                                <i class="fas fa-newspaper me-2"></i>
                                Quản lý Tin tức
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/admin_stock_products'); ?>" class="nav-link">
                                <i class="fas fa-warehouse me-2"></i>
                                Quản lý sản phẩm kho
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/settings'); ?>" class="nav-link">
                                <i class="fas fa-cog me-2"></i>
                                Cài đặt
                            </a>
                        </li>
                    </ul>
                    <hr class="text-white">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong><?php echo $user['full_name']; ?></strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="<?php echo base_url(); ?>">Trang chủ</a></li>
                            <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2><i class="fas fa-users me-2"></i>Quản lý User</h2>
                        <div>
                            <button class="btn btn-primary me-2" onclick="addUser()">
                                <i class="fas fa-plus me-1"></i>Thêm User
                            </button>
                            <button class="btn btn-outline-secondary me-2">Export</button>
                            <button class="btn btn-outline-secondary">Print</button>
                        </div>
                    </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="stats-card">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0"><?php echo $stats['total_users']; ?></h3>
                                    <p class="mb-0">Tổng User</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="stats-card">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-user-check fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0"><?php echo $stats['active_users']; ?></h3>
                                    <p class="mb-0">User Hoạt động</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="stats-card">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-user-shield fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0"><?php echo $stats['admin_users']; ?></h3>
                                    <p class="mb-0">Admin</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="stats-card">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-user fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0"><?php echo $stats['member_users']; ?></h3>
                                    <p class="mb-0">Member</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Danh sách User</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="usersTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo $user->userid; ?></td>
                                    <td><?php echo $user->username; ?></td>
                                    <td><?php echo $user->full_name; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td>
                                        <?php if ($user->role == 'ADMIN'): ?>
                                            <span class="role-badge role-admin">Admin</span>
                                        <?php elseif ($user->role == 'MANAGER'): ?>
                                            <span class="role-badge role-manager">Manager</span>
                                        <?php else: ?>
                                            <span class="role-badge role-member">Member</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($user->active == 1): ?>
                                            <span class="status-badge status-active">Hoạt động</span>
                                        <?php else: ?>
                                            <span class="status-badge status-inactive">Không hoạt động</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo date('d/m/Y', $user->created); ?></td>
                                    <td>
                                        <button class="btn-action btn-view" title="Xem chi tiết" onclick="viewUser(<?php echo $user->userid; ?>)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn-action btn-edit" title="Chỉnh sửa" onclick="editUser(<?php echo $user->userid; ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-action btn-delete" title="Xóa" onclick="deleteUser(<?php echo $user->userid; ?>, '<?php echo $user->full_name; ?>')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xem chi tiết User -->
    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewUserModalLabel">
                        <i class="fas fa-user me-2"></i>Chi tiết User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="viewUserModalBody">
                    <!-- Nội dung sẽ được load bằng AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sửa User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm">
                    <div class="modal-body" id="editUserModalBody">
                        <!-- Form sẽ được load bằng AJAX -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Mobile menu toggle
            $('#mobileMenuToggle').click(function() {
                $('#sidebar').toggleClass('show');
                $('#sidebarOverlay').toggleClass('show');
            });
            
            // Close sidebar when clicking overlay
            $('#sidebarOverlay').click(function() {
                $('#sidebar').removeClass('show');
                $('#sidebarOverlay').removeClass('show');
            });
            
            // Close sidebar when clicking outside on mobile
            $(document).on('click', function(e) {
                if ($(window).width() <= 768) {
                    if (!$(e.target).closest('#sidebar, #mobileMenuToggle').length) {
                        $('#sidebar').removeClass('show');
                        $('#sidebarOverlay').removeClass('show');
                    }
                }
            });
            
            // Handle window resize
            $(window).resize(function() {
                if ($(window).width() > 768) {
                    $('#sidebar').removeClass('show');
                    $('#sidebarOverlay').removeClass('show');
                }
            });
            
            // Add smooth scrolling to sidebar links
            $('.sidebar .nav-link').click(function() {
                if ($(window).width() <= 768) {
                    setTimeout(function() {
                        $('#sidebar').removeClass('show');
                        $('#sidebarOverlay').removeClass('show');
                    }, 300);
                }
            });
            
            // Initialize DataTable with responsive configuration
            $('#usersTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/vi.json'
                },
                pageLength: 10,
                order: [[0, 'desc']],
                responsive: true,
                columnDefs: [
                    {
                        targets: [0, 1, 4, 5, 6, 7], // ID, Username, Role, Status, Date, Actions
                        className: 'text-center'
                    },
                    {
                        targets: [2, 3], // Họ tên, Email
                        className: 'text-start'
                    }
                ]
            });
        });

        // Function xem chi tiết user
        function viewUser(userId) {
            $.ajax({
                url: '/kholanh/admin/users/view',
                type: 'POST',
                data: {user_id: userId},
                success: function(response) {
                    $('#viewUserModalBody').html(response);
                    $('#viewUserModal').modal('show');
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải thông tin user!');
                }
            });
        }

        // Function sửa user
        function editUser(userId) {
            $.ajax({
                url: '/kholanh/admin/users/edit',
                type: 'POST',
                data: {user_id: userId},
                success: function(response) {
                    $('#editUserModalBody').html(response);
                    $('#editUserModal').modal('show');
                },
                error: function() {
                    alert('Có lỗi xảy ra khi tải form chỉnh sửa!');
                }
            });
        }

        // Function xóa user
        function deleteUser(userId, userName) {
            console.log('Attempting to delete user:', userId, userName);
            
            if (confirm('Bạn có chắc chắn muốn xóa user "' + userName + '"?')) {
                console.log('User confirmed deletion, sending AJAX request...');
                
                $.ajax({
                    url: '/kholanh/admin/users/delete',
                    type: 'POST',
                    data: {user_id: userId},
                    dataType: 'json',
                    beforeSend: function() {
                        console.log('Sending request to:', '/kholanh/admin/users/delete');
                        console.log('Data being sent:', {user_id: userId});
                    },
                    success: function(response) {
                        console.log('Success response:', response);
                        if (response.success) {
                            alert('Xóa user thành công!');
                            location.reload();
                        } else {
                            if (response.debug) {
                                alert('Có lỗi xảy ra: ' + response.message + '\n\nChi tiết lỗi: ' + response.debug);
                            } else {
                                alert('Có lỗi xảy ra: ' + response.message);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX Error Details:');
                        console.log('Status:', status);
                        console.log('Error:', error);
                        console.log('Response Text:', xhr.responseText);
                        console.log('Response Status:', xhr.status);
                        
                        try {
                            var response = JSON.parse(xhr.responseText);
                            console.log('Parsed JSON response:', response);
                            if (response.debug) {
                                alert('Có lỗi xảy ra khi xóa user!\n\nChi tiết lỗi: ' + response.debug);
                            } else {
                                alert('Có lỗi xảy ra khi xóa user! Vui lòng thử lại.');
                            }
                        } catch(e) {
                            console.log('JSON parse error:', e);
                            alert('Có lỗi xảy ra khi xóa user! Vui lòng thử lại.\n\nResponse: ' + xhr.responseText);
                        }
                    }
                });
            } else {
                console.log('User cancelled deletion');
            }
        }

        // Handle form submit
        $('#editUserForm').submit(function(e) {
            e.preventDefault();
            
            $.ajax({
                url: '/kholanh/admin/users/update',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Cập nhật user thành công!');
                        $('#editUserModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Có lỗi xảy ra: ' + response.message);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi cập nhật user!');
                }
            });
        });
    </script>
</body>
</html> 