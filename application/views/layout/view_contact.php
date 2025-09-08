<!-- Contact Form Section -->
<section class="contact-form-section">
    <div class="container">
        <h2 class="form-title">GỬI THÔNG TIN</h2>
        <p class="form-description">
            Bạn hãy điền nội dung tin nhắn vào form dưới đây và gửi cho chúng tôi. Chúng tôi sẽ trả lời bạn sau khi
            nhận được.
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
        
        <form action="<?php echo site_url('lien-he-moi'); ?>" method="post" class="contact-form">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name">Họ và tên<span>*</span></label>
                    <input type="text" id="name" name="name" placeholder="Nhập họ và tên" required>
                </div>
                <div class="col-md-6">
                    <label for="email">Email<span>*</span></label>
                    <input type="email" id="email" name="email" placeholder="Nhập địa chỉ Email" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="phone">Điện thoại<span>*</span></label>
                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
            </div>
            <div class="mb-3">
                <label for="subject">Tiêu đề<span>*</span></label>
                <input type="text" id="subject" name="subject" placeholder="Nhập tiêu đề liên hệ" required>
            </div>
            <div class="mb-4">
                <label for="message">Nội dung<span>*</span></label>
                <textarea id="message" name="message" rows="5" placeholder="Nội dung liên hệ" required></textarea>
            </div>
            <button type="submit" class="submit-btn">GỬI TIN NHẮN</button>
        </form>
    </div>
</section>
<!-- Map -->
<section class="map-section">
    <div class="container">
        <h2 class="map-title">BẢN ĐỒ CỬA HÀNG</h2>
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7838.900594260273!2d106.6779185745172!3d10.7767825591882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f265fb27727%3A0x6491c3b013b912e8!2zMzAgxJAuIDMgVGjDoW5nIDIsIFBoxrDhu51uZyAxMiwgUXXhuq1uIDEwLCBI4buTIENow60gTWluaCA3MDAwMDAsIFZpZXRuYW0!5e0!3m2!1sen!2sus!4v1750740889695!5m2!1sen!2sus"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section> 