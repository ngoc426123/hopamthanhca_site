<?php
if ( $page_meta["maintain_status"] != 0 ) {
  $this->load->view("view_maintain");
  return false;
}
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
                    <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
                    <li><a href="<?php echo base_url("gioi-thieu"); ?>">Giới thiệu</a></li>
                    <li><a href="<?php echo base_url("bai-hat"); ?>">Bài hát</a></li>
                    <li><a href=""><span>Danh mục</span></a>
                      <ul>
                        <li><a href="<?php echo base_url("bang-chu-cai"); ?>">Bảng chữ cái</a></li>
                        <li><a href="<?php echo base_url("chuyen-muc"); ?>">Chuyên mục</a></li>
                        <li><a href="<?php echo base_url("tac-gia"); ?>">Tác giả</a></li>
                      </ul>
                    </li>
                    <li class="noPos"><a href="<?php echo base_url("dieu-bai-hat"); ?>"> <span>Điệu nhạc</span></a>
                      <ul class="menuMega">
                      <?php
                      foreach ($data_menu["dieu-bai-hat"] as $key => $value) {
                      ?>
                        <li><a href="<?php echo $value["permalink"]; ?>"> <span><?php echo $value["cat_name"]; ?></span></a></li>
                      <?php
                      }
                      ?>
                      </ul>
                    </li>
                    <li><a href="<?php echo base_url("danh-sach-hop-am"); ?>">Hợp âm</a></li>
                    <li><a href="<?php echo base_url("sheet-nhac"); ?>">Sheet nhạc</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="header__search">
          <div class="wrapper">
          <form action="<?php echo base_url("tim-kiem"); ?>" method="get">
              <div class="header__search--title">Cùng tìm kiếm bài hát bạn thích nhất</div>
              <div class="header__search--form">
                <input type="text" name="query" id="searchDesktop" autocomplete="off" placeholder="Nhập tên bài hát, từ khóa tìm kiếm..." data-search data-url="<?php echo base_url("api/search") ?>" value="<?php echo isset($data_page["keywork"]) ? $data_page["keywork"] : "" ?>">
              </div>
              <div class="header__search--note">
                <p>Tìm với tên bài hát : Ca vang tình yêu Chúa, Tình yêu Thiên Chúa</p>
                <p> Nhập bài hát đầy đủ dấu và chữ, không ghi tắt.</p>
              </div>
            </form>
          </div>
        </div>
      </header>
      <?php $this->load->view($page_view); ?>
      <footer class="footer">
        <div class="wrapper">
          <div class="footer__wrapper">
            <div class="footer__copyright">@ Copyright 2020 by Hợp âm thánh ca</div>
            <div class="footer__social">
              <ul>
                <li><a href=""><i class="fab fa-facebook"></i></a></li>
                <li><a href=""><i class="fab fa-youtube"></i></a></li>
                <li><a href=""><i class="fab fa-twitter"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </body>
  <script src="<?php echo base_url("tmp/js/app.min.js"); ?>" type="text/javascript"></script>
</html>