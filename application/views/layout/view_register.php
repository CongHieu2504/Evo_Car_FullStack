<!-- Register Form Section -->
<section class="register-form-section">
    <div class="container">
        <h2 class="form-title">ĐĂNG KÝ LÁI THỬ</h2>
        <p class="form-description">
            Đăng ký lái thử xe và nhận tư vấn miễn phí từ chuyên gia của chúng tôi.
        </p>
        
        <!-- Hiển thị thông báo -->
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
                <?php $this->session->unset_userdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
                <?php $this->session->unset_userdata('error'); ?>
            </div>
        <?php endif; ?>
        
        <!-- Hiển thị lỗi validation -->
        <?php if(validation_errors()): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        
        <form action="" method="post">
            <!-- Thông tin xe -->
            <div class="mb-4">
                <h5>THÔNG TIN XE</h5>
                <div class="form-group">
                    <label for="car-model">CHỌN DÒNG XE<span class="text-danger">*</span></label>
                    <select class="form-control" id="car-model" name="car_model" required>
                        <option value="">-- Chọn dòng xe --</option>
                        <option value="i10">Hyundai i10</option>
                        <option value="morning">KIA Morning</option>
                        <option value="focus">Ford Focus</option>
                        <option value="yaris">Toyota Yaris</option>
                    </select>
                </div>
            </div>
            <!-- Thông tin liên hệ -->
            <div class="mb-4">
                <h5>THÔNG TIN LIÊN HỆ</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">HỌ VÀ TÊN<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone">ĐIỆN THOẠI<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email">EMAIL<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập địa chỉ Email" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="location">ĐĂNG KÝ LÁI THỬ TẠI<span class="text-danger">*</span></label>
                        <select class="form-control" id="location" name="location" required>
                            <option value="">-- Chọn đại lý --</option>
                            <option value="danang">Đà Nẵng</option>
                            <option value="hcm">Hồ Chí Minh</option>
                            <option value="hanoi">Hà Nội</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="message">NỘI DUNG</label>
                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Nội dung liên hệ"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-dark px-5 py-2">Gửi ĐĂNG KÝ</button>
                </div>
            </div>
        </form>
    </div>
</section> 