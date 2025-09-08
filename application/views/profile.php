<!-- Profile Section -->
<section class="profile-section" style="background: #f8f9fa; padding: 24px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="profile-card" style="background: #fff; border-radius: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); padding: 24px;">
                    
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <h2 style="color: #333; font-weight: 700; margin-bottom: 10px;">Hồ sơ cá nhân</h2>
                        <p style="color: #666; font-size: 16px;">Quản lý thông tin tài khoản của bạn</p>
                    </div>

                    <!-- Flash Messages -->
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <?php echo $this->session->flashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php $this->session->unset_userdata('error'); ?>
                    <?php endif; ?>

                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php $this->session->unset_userdata('success'); ?>
                    <?php endif; ?>

                    <!-- Profile Info -->
                    <div class="profile-info mb-5">
                        <h4 style="color: #333; font-weight: 600; margin-bottom: 20px;">
                            <i class="bi bi-person-circle me-2"></i>Thông tin cá nhân
                        </h4>
                        
                        <form action="<?php echo base_url('profile/update'); ?>" method="post" class="profile-form">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fullname" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                        <i class="bi bi-person me-2"></i>Họ và tên
                                    </label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" 
                                           value="<?php echo $data['user']->full_name; ?>" required
                                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                        <i class="bi bi-envelope me-2"></i>Email
                                    </label>
                                    <input type="email" class="form-control" id="email" value="<?php echo $data['user']->email; ?>" 
                                           readonly style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; background-color: #f8f9fa;">
                                    <small class="text-muted">Email không thể thay đổi</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                        <i class="bi bi-telephone me-2"></i>Số điện thoại
                                    </label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           value="<?php echo $data['user']->phone; ?>" required
                                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                        <i class="bi bi-calendar me-2"></i>Ngày tham gia
                                    </label>
                                    <input type="text" class="form-control" value="<?php echo date('d/m/Y', $data['user']->created); ?>" 
                                           readonly style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; background-color: #f8f9fa;">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" 
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 10px; padding: 12px 30px; font-size: 16px; font-weight: 600; transition: all 0.3s ease;">
                                <i class="bi bi-check-circle me-2"></i>Cập nhật thông tin
                            </button>
                        </form>
                    </div>

                    <!-- Change Password -->
                    <div class="change-password">
                        <h4 style="color: #333; font-weight: 600; margin-bottom: 20px;">
                            <i class="bi bi-lock me-2"></i>Thay đổi mật khẩu
                        </h4>
                        
                        <form action="<?php echo base_url('profile/change_password'); ?>" method="post" class="password-form">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="current_password" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                        Mật khẩu hiện tại
                                    </label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" 
                                           placeholder="Nhập mật khẩu hiện tại" required autocomplete="current-password"
                                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="new_password" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                        Mật khẩu mới
                                    </label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" 
                                           placeholder="Tối thiểu 6 ký tự" required autocomplete="new-password"
                                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="confirm_password" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                        Xác nhận mật khẩu
                                    </label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                                           placeholder="Nhập lại mật khẩu mới" required autocomplete="new-password"
                                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning" 
                                    style="background: linear-gradient(135deg, #ffc107 0%, #ff8c00 100%); border: none; border-radius: 10px; padding: 12px 30px; font-size: 16px; font-weight: 600; transition: all 0.3s ease; color: #fff;">
                                <i class="bi bi-key me-2"></i>Thay đổi mật khẩu
                            </button>
                        </form>
                    </div>

                    <!-- Back to Home -->
                    <div class="text-center mt-4">
                        <a href="<?php echo base_url(); ?>" style="color: #667eea; text-decoration: none; font-size: 14px;">
                            <i class="bi bi-arrow-left me-1"></i>Về trang chủ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const profileForm = document.querySelector('.profile-form');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            const fullname = document.getElementById('fullname').value;
            const phone = document.getElementById('phone').value;

            if (!fullname || !phone) {
                e.preventDefault();
                alert('Vui lòng điền đầy đủ thông tin!');
                return false;
            }

            if (fullname.length < 2) {
                e.preventDefault();
                alert('Họ và tên phải có ít nhất 2 ký tự!');
                return false;
            }

            if (!isValidPhone(phone)) {
                e.preventDefault();
                alert('Số điện thoại không hợp lệ!');
                return false;
            }
        });
    }

    const passwordForm = document.querySelector('.password-form');
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            const currentPassword = document.getElementById('current_password').value;
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (!currentPassword || !newPassword || !confirmPassword) {
                e.preventDefault();
                alert('Vui lòng điền đầy đủ thông tin!');
                return false;
            }

            if (newPassword.length < 6) {
                e.preventDefault();
                alert('Mật khẩu mới phải có ít nhất 6 ký tự!');
                return false;
            }

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Mật khẩu xác nhận không khớp!');
                return false;
            }
        });
    }

    function isValidPhone(phone) {
        const phoneRegex = /^[0-9]{10,15}$/;
        return phoneRegex.test(phone.replace(/\s/g, ''));
    }
});
</script>

<style>
.profile-section {
    background-attachment: fixed;
    /* Không đặt min-height, không padding-bottom đặc biệt */
}

.profile-card {
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
}

@media (max-width: 768px) {
    .profile-card {
        padding: 30px 20px;
        margin: 10px;
    }
    
    .profile-section {
        padding: 20px 0;
    }
}

@media (max-width: 600px) {
    .profile-section {
        min-height: unset;
        padding-bottom: 0;
    }
}
</style> 