<article>
    <section>
        <div class="box-contact">
            <div class="container">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 map__div">
                    <div class="box-maps">
                        <div class="embed-responsive embed-responsive-21by9">
                            <?php echo isset($iframe_map) ? $iframe_map : ''; ?>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="block-contact-form">
                            <h3>Liên hệ với chúng tôi</h3>
                            <p class="lienhe__we-text">Để không ngừng nâng cao chất
                                lượng dịch vụ và đáp ứng tốt hơn nữa
                                các yêu cầu của Quý khách, chúng tôi mong muốn nhận
                                được
                                các thông tin
                                phản hồi. Nếu Quý khách có bất kỳ thắc mắc hoặc đóng
                                góp
                                nào, xin vui lòng
                                liên hệ với chúng tôi theo thông tin dưới đây. Chúng
                                tôi
                                sẽ phản hồi lại Quý
                                khách trong thời gian sớm nhất</p>
                        </div>
                        <div class="block-contact-form">
                            <h3>Thông tin liên hệ</h3>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12">
                                    <div class="block-contact-information">
                                        <ul>
                                            <li>
                                                <span class="icon--border"><i class="fas fa-map-marker-alt"></i></span><?php echo isset($info_address_none['content']) ? $info_address_none['content'] : ''; ?>
                                            </li>
                                            <li>
                                                <span><i class="fas fa-mobile-alt"></i></span><?php echo isset($info_hotline_none['content']) ? $info_hotline_none['content'] : ''; ?>
                                            </li>
                                            <li>
                                                <span><i class="far fa-envelope"></i></span><?php echo isset($info_email_none['content']) ? $info_email_none['content'] : ''; ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="block-contact-form">
                            <h3>Đăng kí để nhận thông tin miễn phí</h3>
                            <?php $this->load->view('layout/notify'); ?>
                            <form action="<?php echo site_url('lien-he'); ?>" method="post">
                                <div class="row">
                                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" id="full_name" name="full_name" class="form-control input--field" placeholder="Họ và tên">
                                    </div>
                                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <input type="email" id="email" name="email" class="form-control input--field" placeholder="Email">
                                    </div>
                                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-3">
                                        <textarea name="message" id="message" class="form-control area--field" rows="3" placeholder="Nội dung liên hệ:"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn--submit" >GỬI
                                    LIÊN HỆ</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <div class="row">
                        <!-- <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12">
                                <div class="block-contact-information">
                                    <ul>
                                        <li>
                                            <span class="icon--border"><i class="fas fa-map-marker-alt"></i></span><?php echo isset($info_address_none['content']) ? $info_address_none['content'] : ''; ?>
                                        </li>
                                        <li>
                                            <span><i class="fas fa-mobile-alt"></i></span><?php echo isset($info_hotline_none['content']) ? $info_hotline_none['content'] : ''; ?>
                                        </li>
                                        <li>
                                            <span><i class="far fa-envelope"></i></span><?php echo isset($info_email_none['content']) ? $info_email_none['content'] : ''; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                        <!-- <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12">
                                <div class="block-contact-form">
                                    <h3>Liên hệ với chúng tôi</h3>
                                    <?php $this->load->view('layout/notify'); ?>
                                    <form action="<?php echo site_url('lien-he'); ?>" method="post">
                                        <div class="row">
                                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <input type="text" id="full_name" name="full_name" class="form-control input--field" placeholder="Họ và tên">
                                            </div>
                                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <input type="email" id="email" name="email" class="form-control input--field" placeholder="Email">
                                            </div>
                                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <textarea name="message" id="message" class="form-control area--field" rows="3" placeholder="Nhập nội dung"></textarea>
                                            </div>
                                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <div class="controls">
                                                    <div class="g-recaptcha" data-theme="light" data-sitekey="6Ld1vx4UAAAAAHwmEZ0S881Qcwz1nyMYTL6MEkkD" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn--submit">Gửi liên hệ</button>
                                    </form>
                                </div>
                            </div> -->
                    </div>
                </div>
                <!-- <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                        <div class="box-maps">
                            <div class="embed-responsive embed-responsive-4by3">
                                <?php echo isset($iframe_map) ? $iframe_map : ''; ?>
                            </div>
                        </div>
                    </div> -->
            </div>
        </div>
    </section>
    <!-- <section>
            <div class="box-contact">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12">
                                    <div class="block-contact-information">
                                        <ul>
                                            <li>
                                                <span class="icon--border"><i
                                                        class="fas fa-map-marker-alt"></i></span><?php echo isset($info_address_none['content']) ? $info_address_none['content'] : ''; ?>
                                            </li>
                                            <li>
                                                <span><i class="fas fa-mobile-alt"></i></span><?php echo isset($info_hotline_none['content']) ? $info_hotline_none['content'] : ''; ?>
                                            </li>
                                            <li>
                                                <span><i class="far fa-envelope"></i></span><?php echo isset($info_email_none['content']) ? $info_email_none['content'] : ''; ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12">
                                    <div class="block-contact-form">
										<h3>Liên hệ với chúng tôi</h3>
										<?php $this->load->view('layout/notify'); ?>
                                        <form action="<?php echo site_url('lien-he'); ?>" method="post">
                                            <div class="row">
                                                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <input type="text" id="full_name" name="full_name" class="form-control input--field"
                                                        placeholder="Họ và tên">
                                                </div>
                                                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <input type="email" id="email" name="email" class="form-control input--field"
                                                        placeholder="Email">
                                                </div>
                                                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <textarea name="message" id="message"  class="form-control area--field" rows="3"
                                                        placeholder="Nhập nội dung"></textarea>
                                                </div>
                                                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                  	<div class="controls">
                                                    	<div class="g-recaptcha" data-theme="light" data-sitekey="6Ld1vx4UAAAAAHwmEZ0S881Qcwz1nyMYTL6MEkkD" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                                                  	</div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn--submit">Gửi liên hệ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                            <div class="box-maps">
                                <div class="embed-responsive embed-responsive-4by3">
									<?php echo isset($iframe_map) ? $iframe_map : ''; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
</article>