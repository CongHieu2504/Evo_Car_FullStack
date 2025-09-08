<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Evo Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>
<body>
    <!-- Login Section -->
    <section class="login-section">
        <div class="login-card">
            <!-- Logo -->
            <div class="text-center mb-4">
                <h2 style="color: #333; font-weight: 700; margin-bottom: 10px;">Đăng nhập</h2>
                <p style="color: #666; font-size: 16px;">Chào mừng bạn quay trở lại!</p>
            </div>
            <!-- Flash Messages -->
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php $this->session->unset_userdata('success'); ?>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php $this->session->unset_userdata('error'); ?>
            <?php endif; ?>
            <!-- Login Form -->
            <form action="<?php echo base_url('login/authenticate'); ?>" method="post" class="login-form" autocomplete="off">
                            <div class="mb-4">
                                <label for="email" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    <i class="bi bi-person me-2"></i>Email hoặc Username
                                </label>
                                <input type="text" class="form-control" id="email" name="email" 
                                       placeholder="Nhập email hoặc username" required autocomplete="off"
                                       style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;"
                                       readonly onfocus="this.removeAttribute('readonly');">
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    <i class="bi bi-lock me-2"></i>Mật khẩu
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" 
                                           placeholder="Nhập mật khẩu" required autocomplete="new-password"
                                           style="border: 2px solid #e9ecef; border-radius: 10px 0 0 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;"
                                           readonly onfocus="this.removeAttribute('readonly');">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword"
                                            style="border: 2px solid #e9ecef; border-left: none; border-radius: 0 10px 10px 0; background: #f8f9fa;">
                                        <i class="bi bi-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember" style="color: #666;">
                                    Ghi nhớ đăng nhập
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3" 
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 10px; padding: 12px; font-size: 16px; font-weight: 600; transition: all 0.3s ease;">
                                <i class="bi bi-person-circle me-2"></i>Đăng nhập
                            </button>

                            <div class="text-center">
                                <a href="<?php echo base_url('forgot-password'); ?>" style="color: #667eea; text-decoration: none; font-size: 14px;">
                                    Quên mật khẩu?
                                </a>
                            </div>
                        </form>

                        <!-- Divider -->
                        <div class="text-center my-4">
                            <span style="color: #999; font-size: 14px;">hoặc</span>
                        </div>

                        <!-- Social Login -->
                        <div class="social-login">
                            <button class="btn btn-outline-secondary w-100 mb-2" style="border-radius: 10px; padding: 12px; font-size: 16px;">
                                <i class="bi bi-google me-2"></i>Đăng nhập với Google
                            </button>
                            <button class="btn btn-outline-primary w-100" style="border-radius: 10px; padding: 12px; font-size: 16px;">
                                <i class="bi bi-facebook me-2"></i>Đăng nhập với Facebook
                            </button>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center mt-4">
                            <p style="color: #666; font-size: 14px; margin: 0;">
                                Chưa có tài khoản? 
                                <a href="<?php echo base_url('register_account'); ?>" style="color: #667eea; text-decoration: none; font-weight: 600;">
                                    Đăng ký ngay
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
                </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide flash messages after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            }, 5000);
        });
        
        // Clear form fields to prevent autofill
        const emailField = document.getElementById('email');
        const passwordField = document.getElementById('password');
        
        if (emailField) {
            emailField.value = '';
            emailField.setAttribute('autocomplete', 'off');
        }
        
        if (passwordField) {
            passwordField.value = '';
            passwordField.setAttribute('autocomplete', 'new-password');
        }
        
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (togglePassword && password && eyeIcon) {
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                eyeIcon.classList.toggle('bi-eye');
                eyeIcon.classList.toggle('bi-eye-slash');
            });
        }

        // Form validation
        const form = document.querySelector('.login-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                if (!email || !password) {
                    e.preventDefault();
                    alert('Vui lòng điền đầy đủ thông tin!');
                    return false;
                }

                // Cho phép cả email và username
                if (email.includes('@') && !isValidEmail(email)) {
                    e.preventDefault();
                    alert('Email không hợp lệ!');
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
    /* Reset CSS */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    
    html, body {
        height: 100%;
        width: 100%;
        overflow-x: hidden;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        font-family: 'Roboto', sans-serif;
    }
    
    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
    }
    
    /* Login Section - Luôn căn giữa hoàn hảo */
    .login-section {
        width: 100%;
        max-width: 100vw;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
        z-index: 1;
    }
    
    /* Login Card - Responsive hoàn hảo */
    .login-card {
        max-width: 400px;
        width: 100%;
        min-width: 320px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        padding: 40px 30px;
        background: #ffffff !important;
        color: #333333 !important;
        margin: 0 auto;
        position: relative;
        z-index: 10;
        transform: translateZ(0);
    }
    
    /* Đảm bảo tất cả text trong card có màu đen */
    .login-card h2,
    .login-card p,
    .login-card label,
    .login-card span,
    .login-card a {
        color: #333333 !important;
    }
    
    /* Đảm bảo form controls có màu trắng */
    .login-card .form-control {
        background: #ffffff !important;
        border-color: #e9ecef !important;
        color: #333333 !important;
    }
    
    /* Đảm bảo buttons có màu đúng */
    .login-card .btn-outline-secondary {
        background: #f8f9fa !important;
        border-color: #e9ecef !important;
        color: #6c757d !important;
    }
    
    /* Form styling */
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .social-login .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    
    /* ===== RESPONSIVE DESIGN HOÀN CHỈNH ===== */
    
    /* 1. MOBILE PHONES - Portrait (320px - 480px) */
    @media (max-width: 480px) {
        body {
            padding: 5px 0;
        }
        
        .login-section {
            padding: 10px 5px;
            min-height: auto;
            height: 100vh;
        }
        
        .login-card {
            padding: 20px 15px;
            margin: 0 auto;
            max-width: 96vw;
            min-width: 280px;
            border-radius: 15px;
        }
        
        .login-card h2 {
            font-size: 22px !important;
            margin-bottom: 6px !important;
        }
        
        .login-card p {
            font-size: 14px !important;
        }
        
        .form-control {
            font-size: 16px !important; /* Tránh zoom trên iOS */
            padding: 12px 10px !important;
        }
        
        .btn {
            font-size: 15px !important;
            padding: 12px !important;
        }
        
        .mb-4 {
            margin-bottom: 0.8rem !important;
        }
        
        .my-4 {
            margin: 0.8rem 0 !important;
        }
        
        .mt-4 {
            margin-top: 0.8rem !important;
        }
        
        .mt-3 {
            margin-top: 0.6rem !important;
        }
    }
    
    /* 2. MOBILE PHONES - Landscape (481px - 768px) */
    @media (min-width: 481px) and (max-width: 768px) and (orientation: landscape) {
        body {
            padding: 5px 0;
        }
        
        .login-section {
            padding: 10px;
            min-height: auto;
            height: 100vh;
        }
        
        .login-card {
            padding: 25px 20px;
            margin: 0 auto;
            max-width: 90vw;
            min-width: 400px;
        }
    }
    
    /* 3. TABLETS - Portrait (481px - 768px) */
    @media (min-width: 481px) and (max-width: 768px) and (orientation: portrait) {
        .login-card {
            padding: 30px 25px;
            max-width: 450px;
        }
    }
    
    /* 4. TABLETS - Landscape (769px - 1024px) */
    @media (min-width: 769px) and (max-width: 1024px) {
        .login-card {
            padding: 35px 30px;
            max-width: 500px;
        }
    }
    
    /* 5. LAPTOPS (1025px - 1366px) */
    @media (min-width: 1025px) and (max-width: 1366px) {
        .login-card {
            padding: 40px 35px;
            max-width: 450px;
        }
    }
    
    /* 6. DESKTOP LARGE (1367px+) */
    @media (min-width: 1367px) {
        .login-card {
            padding: 45px 40px;
            max-width: 500px;
        }
        
        .login-card h2 {
            font-size: 32px !important;
        }
        
        .login-card p {
            font-size: 18px !important;
        }
    }
    
    /* 7. MÀN HÌNH THẤP (≤700px height) */
    @media (max-height: 700px) {
        body {
            padding: 5px 0;
        }
        
        .login-section {
            min-height: auto;
            height: 100vh;
            align-items: flex-start;
            padding-top: 10px;
        }
        
        .login-card {
            margin-top: 10px;
            padding: 20px 15px;
        }
        
        .login-card h2 {
            font-size: 20px !important;
            margin-bottom: 5px !important;
        }
        
        .login-card p {
            font-size: 14px !important;
        }
    }
    
    /* 8. MÀN HÌNH CAO (≥701px height) */
    @media (min-height: 701px) {
        .login-section {
            min-height: 100vh;
        }
    }
    
    /* 9. ULTRA-WIDE SCREENS (≥1920px width) */
    @media (min-width: 1920px) {
        .login-card {
            padding: 50px 45px;
            max-width: 550px;
        }
        
        .login-card h2 {
            font-size: 36px !important;
        }
        
        .login-card p {
            font-size: 20px !important;
        }
        
        .form-control {
            font-size: 18px !important;
            padding: 15px 20px !important;
        }
        
        .btn {
            font-size: 18px !important;
            padding: 15px !important;
        }
    }
    
    /* 10. FOLDABLE PHONES (280px - 320px) */
    @media (max-width: 320px) {
        body {
            padding: 1px 0;
        }
        
        .login-section {
            padding: 3px 1px;
        }
        
        .login-card {
            padding: 15px 10px;
            max-width: 98vw;
            min-width: 250px;
            border-radius: 10px;
        }
        
        .login-card h2 {
            font-size: 18px !important;
            margin-bottom: 4px !important;
        }
        
        .login-card p {
            font-size: 12px !important;
        }
        
        .form-control {
            font-size: 16px !important;
            padding: 10px 8px !important;
        }
        
        .btn {
            font-size: 14px !important;
            padding: 10px !important;
        }
        
        .mb-4 {
            margin-bottom: 0.6rem !important;
        }
        
        .my-4 {
            margin: 0.6rem 0 !important;
        }
        
        .mt-4 {
            margin-top: 0.6rem !important;
        }
        
        .mt-3 {
            margin-top: 0.4rem !important;
        }
    }
    
    /* 11. HIGH DPI DISPLAYS */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
        .login-card {
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
    }
    
    /* 12. DARK MODE SUPPORT - TẠM THỜI TẮT */
    /*
    @media (prefers-color-scheme: dark) {
        .login-card {
            background: #1a1a1a !important;
            color: #ffffff !important;
        }
        
        .login-card h2,
        .login-card label {
            color: #ffffff !important;
        }
        
        .login-card p {
            color: #cccccc !important;
        }
        
        .form-control {
            background: #2a2a2a !important;
            border-color: #444444 !important;
            color: #ffffff !important;
        }
    }
    */
    
    /* Fix cho tất cả text elements */
    .login-card h2,
    .login-card p,
    .login-card label,
    .login-card span,
    .login-card a {
        position: relative;
        z-index: 11;
    }
    
    /* Đảm bảo form luôn hiển thị đúng */
    .login-form {
        position: relative;
        z-index: 12;
    }
    
    /* Fix cho alert messages */
    .alert {
        position: relative;
        z-index: 13;
    }
    </style>
</body>
</html>
 