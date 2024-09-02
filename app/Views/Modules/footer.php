<footer class="footer">
  <div class="footer__social">
    <div class="comp-wrapper">
      <div class="footer__social-text">Kết nối với chúng tôi tại đây: </div>
      <div class="footer__social-list">
        <ul>
          <li><a href="<?= $pageinit['social_facebook'] ?>"><i class="fab fa-facebook"></i></a></li>
          <li><a href="<?= $pageinit['social_youtube'] ?>"><i class="fab fa-youtube"></i></a></li>
          <li><a href="<?= $pageinit['social_twitter'] ?>"><i class="fab fa-twitter"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer__main">
    <div class="comp-wrapper">
      <div class="footer__grid">
        <div class="footer__col-1 footer__col-order-contact">
          <div class="footer__logo">
            <a href="<?= $pageinit['site_url'] ?>"><img src="<?= base_url("images/logo.svg") ?>" alt="logo"></a>
          </div>
          <div class="footer__contact">
            <div class="footer__contact-title">Liên hệ với chúng tôi</div>
            <div class="footer__contact-info">
              <?php $phoneNumber = str_replace('.', '', $pageinit['phonenumber']) ?>
              <ul>
                <li><a href="tel:<?= $phoneNumber ?>"> <strong>PHONE: </strong><?= esc($pageinit['phonenumber']) ?></a></li>
                <li><a href="mailto:<?= esc($pageinit['email']) ?>"><strong>EMAIL: </strong><?= esc($pageinit['email']) ?></a></li>
                <li><a href="<?= $pageinit['site_url'] ?>"><strong>SITE: </strong><?= $pageinit['site_url'] ?></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer__col-2 footer__col-order-quote">
          <div class="footer__quote">Hát là ơn Thiên Chúa ban cho mọi người. Hát là mang niềm tin vào Thiên Chúa Phục Sinh đến cho mọi nơi. Hát là thể hiện niềm phó thác trọn cuộc đời vào Đấng Hiện Hữu và "Hát là cầu nguyện hai lần (Thánh Augustino)"</div>
        </div>
        <div class="footer__col-3 footer__col-order-nav">
          <div class="footer__navigation">
            <ul> 
              <li><a href="<?= base_url() ?>" title=" Trang chủ"><span> Trang chủ</span></a></li>
              <li><a href="<?= base_url('gioi-thieu') ?>" title="Giới thiệu"><span>Giới thiệu</span></a></li>
              <li><a href="<?= base_url('bai-hat') ?>" title="Bài hát"><span>Bài hát</span></a></li>
              <li><a href="<?= base_url('danh-sach-hop-am') ?>" title="Hợp âm"><span>Hợp âm</span></a></li>
              <li><a href="<?= base_url('thanh-ca-hang-tuan') ?>" title="Thánh ca hàng tuần"><span>Thánh ca hàng tuần</span></a></li>
            </ul>
          </div>
        </div>
        <div class="footer__col-3 footer__col-order-nav">
          <div class="footer__navigation">
            <ul> 
              <li><a href="<?= base_url('chuyen-muc/mua-thuong-nien') ?>" title="Mùa thường niên"><span>Mùa thường niên</span></a></li>
              <li><a href="<?= base_url('chuyen-muc/mua-chay') ?>" title="Mùa chay"><span>Mùa chay</span></a></li>
              <li><a href="<?= base_url('chuyen-muc/mua-phuc-sinh') ?>" title="Mùa phục sinh"><span>Mùa phục sinh</span></a></li>
              <li><a href="<?= base_url('chuyen-muc/mua-vong') ?>" title="Mùa vọng"><span>Mùa vọng</span></a></li>
              <li><a href="<?= base_url('chuyen-muc/mua-giang-sinh') ?>" title="Mùa giáng sinh"><span>Mùa giáng sinh</span></a></li>
            </ul>
          </div>
        </div>
        <div class="footer__col-3 footer__col-order-nav">
          <div class="footer__navigation">
            <ul> 
              <li><a href="<?= base_url('tac-gia/kim-long') ?>" title="Kim Long"><span>Kim Long</span></a></li>
              <li><a href="<?= base_url('tac-gia/nguyen-duy') ?>" title="Nguyễn Duy"><span>Nguyễn Duy</span></a></li>
              <li><a href="<?= base_url('tac-gia/dinh-cong-huynh') ?>" title="Đinh Công Huỳnh"><span>Đinh Công Huỳnh</span></a></li>
              <li><a href="<?= base_url('tac-gia/giang-tam') ?>" title="Giang Tâm"><span>Giang Tâm</span></a></li>
              <li><a href="<?= base_url('tac-gia/-mi-tram') ?>" title="Mi Trầm"><span>Mi Trầm</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer__bottom">
    <div class="comp-wrapper">
      <div class="footer__copyright">Copyright 2020 by Hợp âm thánh ca</div>
    </div>
  </div>
</footer>