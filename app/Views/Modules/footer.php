<footer class="footer">
  <div class="footer__main">
    <div class="wrapper">
      <div class="footer__right">
        <div class="footer__logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url("tmp/images/logo.svg"); ?>" alt="logo"></a></div>
        <div class="footer__social">
          <ul>
            <li><a href="<?php echo $this->model_options->get("social_facebook") ?>"><i class="fab fa-facebook"></i></a></li>
            <li><a href="<?php echo $this->model_options->get("social_youtube") ?>"><i class="fab fa-youtube"></i></a></li>
            <li><a href="<?php echo $this->model_options->get("social_twitter") ?>"><i class="fab fa-twitter"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="footer__contact">
        <div class="footer__title">Hợp âm thánh ca</div>
        <div class="footer__infor">
          <ul>
            <li><a href="tel:<?php echo str_replace('.', '', $this->model_options->get("phonenumber")) ?>"> <strong>[T]: </strong><?php echo $this->model_options->get("phonenumber") ?></a></li>
            <li><a href="mailto:<?php echo $this->model_options->get("email") ?>"><strong>[E]: </strong><?php echo $this->model_options->get("email") ?></a></li>
            <li><a href="<?php echo base_url() ?>"><strong>[W]: </strong><?php echo base_url() ?></a></li>
            <li><a href="#"><strong>[@] </strong>Copyright 2020 by Hợp âm thánh ca</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="footer__bottom">
    <div class="wrapper">
      <div class="footer__navigation">
        <ul>
          <li> <a href="<?php echo base_url(); ?>">Trang chủ</a></li>
          <li> <a href="<?php echo base_url("gioi-thieu"); ?>">Giới thiệu</a></li>
          <li> <a href="<?php echo base_url("bai-hat"); ?>">Bài hát</a></li>
          <li> <a href="<?php echo base_url("danh-sach-hop-am"); ?>">Hợp âm</a></li>
          <li><a href="<?php echo base_url("thanh-ca-hang-tuan"); ?>">Thánh ca hàng tuần</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>