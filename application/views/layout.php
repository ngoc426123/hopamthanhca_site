<?php
if ( $page_meta["maintain_status"] != 0 ) {
  $this->load->view("view_maintain");
  return false;
}

// pr($page_meta);
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $page_meta["title"]; ?></title>
    <meta name="google-site-verification" content="u_MBkWSe2AFG1aeQNi93_Y_jL4F7Cq31jGZACqK2SGs" />
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="<?php echo $page_meta["title"]; ?>">
    <meta property="og:url" content="<?php echo $page_meta["site_url"]; ?>">
    <meta property="og:image" content="<?php echo base_url("tmp/images/logo.svg"); ?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="<?php echo $page_meta["desc"]; ?>">
    <meta name="google" content="nositelinkssearchbox">
    <meta name="description" content="<?php echo $page_meta["desc"]; ?>">
    <meta name="keywords" content="<?php echo $page_meta["keywork"]; ?>">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <link rel="canonical" href="<?php echo $page_meta["canonical"] ?>">
    <link rel="shortcut icon" href="<?php echo base_url("tmp/images/favicon.ico"); ?>"/>
    <link rel="image_src" href="<?php echo base_url("tmp/images/1.jpg"); ?>">
    <link href="<?php echo base_url("tmp/images/favicon.ico"); ?>" rel="icon" sizes="64x64" type="image/ico">
    <link href="<?php echo base_url("tmp/css/style.min.css"); ?>" rel="stylesheet">
    <?php 
    if ( is_home() ) {
    ?>
      <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "url": "https://www.hopamthanhca.com/",
        "potentialAction": {
          "@type": "SearchAction",
          "target": {
            "@type": "EntryPoint",
            "urlTemplate": "https://hopamthanhca.com/tim-kiem?query={search_term_string}"
          },
          "query-input": "required name=search_term_string"
        }
      }
      </script>
    <?php
    }
    ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-EZRP510794"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-EZRP510794');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6075640192892482"
     crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="page">
      <header class="header">
        <div class="header__main">
          <div class="wrapper">
            <div class="header__left">
              <div class="header__logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url("tmp/images/logo.svg"); ?>" alt="logo"></a></div>
            </div>
            <div class="header__tools">
              <div class="header__menu">
                <div class="header__menuToggle"><span></span><span></span><span></span></div>
                <div class="header__menuOverlay"></div>
                <div class="header__menuDropdown">
                  <ul>
                    <li><a href="<?php echo base_url(); ?>" title="Trang chủ">Trang chủ</a></li>
                    <li><a href="<?php echo base_url("gioi-thieu"); ?>" title="Giới thiệu">Giới thiệu</a></li>
                    <li><a href=""><span>Danh mục</span></a>
                      <ul>
                        <li><a href="<?php echo base_url("bang-chu-cai"); ?>" title="Bảng chữ cái">Bảng chữ cái</a></li>
                        <li><a href="<?php echo base_url("chuyen-muc"); ?>" title="Chuyên mục">Chuyên mục</a></li>
                        <li><a href="<?php echo base_url("tac-gia"); ?>" title="Tác giả">Tác giả</a></li>
                      </ul>
                    </li>
                    <li class="noPos">
                      <a href="<?php echo base_url("dieu-bai-hat"); ?>" title="Điệu nhạc"> <span>Điệu nhạc</span></a>
                      <ul class="menuMega">
                      <?php
                      foreach ($data_menu["dieu-bai-hat"] as $key => $value) {
                      ?>
                        <li><a href="<?php echo $value["permalink"]; ?>" title="<?php echo $value["cat_name"]; ?>"> <span><?php echo $value["cat_name"]; ?></span></a></li>
                      <?php
                      }
                      ?>
                      </ul>
                    </li>
                    <li><a href="<?php echo base_url("thanh-ca-hang-tuan"); ?>" title="Hợp âm">Thánh ca hàng tuần</a></li>
                    <li><a href="<?php echo base_url("sheet-nhac"); ?>" title="Sheet nhạc">Sheet nhạc</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="header__search">
          <div class="wrapper">
            <div class="header__search--title">Cùng tìm kiếm bài hát bạn thích nhất</div>
            <div class="header__search--form">
              <input type="text" name="query" id="searchDesktop" autocomplete="off" placeholder="Nhập tên bài hát, từ khóa tìm kiếm..." data-search data-action="<?php echo base_url("tim-kiem") ?>" data-url="<?php echo base_url("api/search") ?>" value="<?php echo isset($data_page["keywork"]) ? $data_page["keywork"] : "" ?>">
            </div>
            <div class="header__search--note">
              <p>Tìm với tên bài hát: Ca vang tình yêu Chúa, Tình yêu Thiên Chúa</p>
              <p>Tìm với lời đầu tiên của bài hát: "Đời con là những nốt nhạc thiêng"</p>
              <p> Nhập bài hát đầy đủ dấu và chữ, không ghi tắt.</p>
            </div>
          </div>
        </div>
      </header>
      <?php $this->load->view($page_view); ?>
      <div class="wrapper">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6075640192892482"
      crossorigin="anonymous"></script>
        <!-- Ads2 -->
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-6075640192892482"
            data-ad-slot="6508241366"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </div>
      <?php
      $this->load->model(['model_options']);
      ?>
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
    </div>
  </body>
  <script type="text/javascript">
    const BASE_URL = '<?php echo base_url() ?>';
  </script>
  <script src="<?php echo base_url("tmp/js/app.min.js"); ?>" type="text/javascript"></script>
</html>