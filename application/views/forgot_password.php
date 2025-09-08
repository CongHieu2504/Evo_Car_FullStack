<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu - Evo Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>
<body>
    <section class="login-section">
        <div class="login-card">
            <div class="text-center mb-4">
                <h2 style="color: #333; font-weight: 700; margin-bottom: 10px;">Quên mật khẩu</h2>
                <p style="color: #666; font-size: 16px;">Nhập email để lấy lại mật khẩu</p>
            </div>
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <form action="#" method="post" class="forgot-form" autocomplete="off">
                <div class="mb-4">
                    <label for="email" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                        <i class="bi bi-envelope me-2"></i>Email
                    </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required autocomplete="email"
                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;">
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 10px; padding: 12px; font-size: 16px; font-weight: 600; transition: all 0.3s ease;">
                    <i class="bi bi-send me-2"></i>Lấy lại mật khẩu
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