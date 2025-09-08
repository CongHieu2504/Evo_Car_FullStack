<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu - Evo Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>
<body>
    <section class="login-section">
        <div class="login-card">
            <div class="text-center mb-4">
                <h2 style="color: #333; font-weight: 700; margin-bottom: 10px;">Đặt lại mật khẩu</h2>
                <p style="color: #666; font-size: 16px;">Nhập mật khẩu mới cho tài khoản của bạn</p>
            </div>
            <form action="<?php echo base_url('reset-password?token=' . urlencode($token)); ?>" method="post" class="reset-form" autocomplete="off">
                <div class="mb-4">
                    <label for="password" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                        <i class="bi bi-lock me-2"></i>Mật khẩu mới
                    </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới" required autocomplete="new-password"
                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                    <?php echo form_error('password', '<div class="invalid-feedback" style="display:block">', '</div>'); ?>
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                        <i class="bi bi-lock-fill me-2"></i>Xác nhận mật khẩu
                    </label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu mới" required autocomplete="new-password"
                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                    <?php echo form_error('confirm_password', '<div class="invalid-feedback" style="display:block">', '</div>'); ?>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 10px; padding: 12px; font-size: 16px; font-weight: 600; transition: all 0.3s ease;">
                    <i class="bi bi-shield-lock me-2"></i>Đặt lại mật khẩu
                </button>
                <div class="text-center mt-3">
                    <a href="<?php echo base_url('login'); ?>" style="color: #667eea; text-decoration: none; font-size: 14px;">
                        <i class="bi bi-arrow-left me-1"></i>Quay lại đăng nhập
                    </a>
                </div>
            </form>
        </div>
    </section>
    <style>
    html, body {
        height: 100%;
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    }
    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 0;
    }
    .login-card {
        max-width: 480px;
        width: 100%;
        margin: 48px auto;
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        padding: 48px;
        background: #fff;
        font-size: 18px;
    }
    .form-label, .form-control, .btn, .alert {
        font-size: 18px;
    }
    </style>
</body>
</html> 