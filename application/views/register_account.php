<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản - Evo Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>
<body>
    <!-- Register Account Section -->
    <section class="register-section" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: block; padding: 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7 col-sm-10">
                    <div class="register-card" style="background: #fff; border-radius: 18px; box-shadow: 0 8px 32px rgba(102,126,234,0.18); padding: 20px 20px; max-width: 500px; margin: 40px auto 40px auto; position: relative;">
                        
                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <h2 style="color: #333; font-weight: 700; margin-bottom: 10px;">Đăng ký tài khoản</h2>
                            <p style="color: #666; font-size: 16px;">Tạo tài khoản mới để trải nghiệm dịch vụ tốt nhất</p>
                        </div>

                        <!-- Flash Messages -->
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <?php echo $this->session->flashdata('error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <?php echo $this->session->flashdata('success'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Register Form -->
                        <form action="<?php echo base_url('register_account/create'); ?>" method="post" class="register-form">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                        <i class="bi bi-person-badge me-2"></i>Tên đăng nhập
                                    </label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           placeholder="Nhập tên đăng nhập (không dấu, không khoảng trắng)" required autocomplete="username"
                                           value="<?php echo set_value('username'); ?>"
                                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                                    <?php echo form_error('username', '<div class="invalid-feedback" style="display:block">', '</div>'); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fullname" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                        <i class="bi bi-person me-2"></i>Họ và tên
                                    </label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" 
                                           placeholder="Nhập họ và tên đầy đủ" required autocomplete="name"
                                           value="<?php echo set_value('fullname'); ?>"
                                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                                    <?php echo form_error('fullname', '<div class="invalid-feedback" style="display:block">', '</div>'); ?>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                        <i class="bi bi-envelope me-2"></i>Email
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           placeholder="Nhập email" required autocomplete="email"
                                           value="<?php echo set_value('email'); ?>"
                                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                                    <?php echo form_error('email', '<div class="invalid-feedback" style="display:block">', '</div>'); ?>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                        <i class="bi bi-telephone me-2"></i>Số điện thoại
                                    </label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           placeholder="Nhập số điện thoại" required autocomplete="tel"
                                           value="<?php echo set_value('phone'); ?>"
                                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                                    <?php echo form_error('phone', '<div class="invalid-feedback" style="display:block">', '</div>'); ?>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                        <i class="bi bi-lock me-2"></i>Mật khẩu
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" 
                                               placeholder="Tối thiểu 6 ký tự" required autocomplete="new-password"
                                               style="border: 2px solid #e9ecef; border-radius: 10px 0 0 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                                        <?php echo form_error('password', '<div class="invalid-feedback" style="display:block">', '</div>'); ?>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"
                                                style="border: 2px solid #e9ecef; border-left: none; border-radius: 0 10px 10px 0; background: #f8f9fa;">
                                            <i class="bi bi-eye" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="confirm_password" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                        <i class="bi bi-lock-fill me-2"></i>Xác nhận mật khẩu
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                                               placeholder="Nhập lại mật khẩu" required autocomplete="new-password"
                                               style="border: 2px solid #e9ecef; border-radius: 10px 0 0 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                                        <?php echo form_error('confirm_password', '<div class="invalid-feedback" style="display:block">', '</div>'); ?>
                                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword"
                                                style="border: 2px solid #e9ecef; border-left: none; border-radius: 0 10px 10px 0; background: #f8f9fa;">
                                            <i class="bi bi-eye" id="eyeConfirmIcon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="agree" name="agree" required>
                                <label class="form-check-label" for="agree" style="color: #666; font-size: 14px;">
                                    Tôi đồng ý với <a href="#" style="color: #667eea;">Điều khoản sử dụng</a> và 
                                    <a href="#" style="color: #667eea;">Chính sách bảo mật</a>
                                </label>
                            </div>

                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter">
                                <label class="form-check-label" for="newsletter" style="color: #666; font-size: 14px;">
                                    Đăng ký nhận thông tin khuyến mãi và tin tức mới nhất
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3" 
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 10px; padding: 12px; font-size: 16px; font-weight: 600; transition: all 0.3s ease;">
                                <i class="bi bi-person-plus me-2"></i>Đăng ký tài khoản
                            </button>
                        </form>

                        <!-- Divider -->
                        <div class="text-center my-4">
                            <span style="color: #999; font-size: 14px;">hoặc</span>
                        </div>

                        <!-- Social Register -->
                        <div class="social-register">
                            <button class="btn btn-outline-secondary w-100 mb-2" style="border-radius: 10px; padding: 12px; font-size: 16px;">
                                <i class="bi bi-google me-2"></i>Đăng ký với Google
                            </button>
                            <button class="btn btn-outline-primary w-100" style="border-radius: 10px; padding: 12px; font-size: 16px;">
                                <i class="bi bi-facebook me-2"></i>Đăng ký với Facebook
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center mt-4">
                            <p style="color: #666; font-size: 14px; margin: 0;">
                                Đã có tài khoản? 
                                <a href="<?php echo base_url('login'); ?>" style="color: #667eea; text-decoration: none; font-weight: 600;">
                                    Đăng nhập ngay
                                </a>
                            </p>
                        </div>

                        <!-- Back to Home -->
                        <div class="text-center mt-3">
                            <a href="<?php echo base_url(); ?>" style="color: #999; text-decoration: none; font-size: 14px;">
                                <i class="bi bi-arrow-left me-1"></i>Về trang chủ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('confirm_password');
        const eyeConfirmIcon = document.getElementById('eyeConfirmIcon');

        if (togglePassword && password && eyeIcon) {
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                eyeIcon.classList.toggle('bi-eye');
                eyeIcon.classList.toggle('bi-eye-slash');
            });
        }

        if (toggleConfirmPassword && confirmPassword && eyeConfirmIcon) {
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPassword.setAttribute('type', type);
                eyeConfirmIcon.classList.toggle('bi-eye');
                eyeConfirmIcon.classList.toggle('bi-eye-slash');
            });
        }

        // Form validation
        const form = document.querySelector('.register-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const username = document.getElementById('username').value;
                const fullname = document.getElementById('fullname').value;
                const email = document.getElementById('email').value;
                const phone = document.getElementById('phone').value;
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirm_password').value;
                const agree = document.getElementById('agree').checked;

                if (!username || !fullname || !email || !phone || !password || !confirmPassword) {
                    e.preventDefault();
                    alert('Vui lòng điền đầy đủ thông tin!');
                    return false;
                }

                if (!isValidEmail(email)) {
                    e.preventDefault();
                    alert('Email không hợp lệ!');
                    return false;
                }

                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Mật khẩu xác nhận không khớp!');
                    return false;
                }

                if (!agree) {
                    e.preventDefault();
                    alert('Vui lòng đồng ý với điều khoản sử dụng!');
                    return false;
                }
            });
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    });
    </script>

    <style>
    html, body {
        height: 100%;
        min-height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    }
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    }
    .register-section {
        background: none;
        display: block;
        padding: 0;
    }
    .register-card {
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.18);
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(102,126,234,0.18);
        max-width: 420px;
        margin: 40px auto 40px auto;
        padding: 20px 20px;
    }
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .social-register .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    @media (max-width: 768px) {
        .register-card {
            padding: 12px 4px;
            margin: 16px auto 16px auto;
            max-width: 98vw;
        }
        .register-section {
            padding: 0;
        }
    }
    </style>
</body>
</html> 