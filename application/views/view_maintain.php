<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $page_meta["title"]; ?></title>
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
    <meta name="keywords" content="Website">
    <meta name="robots" content="nofollow">
    <meta name="googlebot" content="nofollow">
    <link href="<?php echo base_url("tmp/images/favicon.ico"); ?>" rel="icon" sizes="64x64" type="image/ico">
    <link href="<?php echo base_url("tmp/css/style.min.css"); ?>" rel="stylesheet">
    <style type="text/css">@font-face{font-family:Pacifico;src:url('<?php echo base_url("tmp/fonts/Pacifico/Pacifico-Regular.eot"); ?>');src:url('<?php echo base_url("tmp/fonts/Pacifico/Pacifico-Regular.eot?#iefix"); ?>') format('embedded-opentype'),url('<?php echo base_url("tmp/fonts/Pacifico/Pacifico-Regular.woff2"); ?>') format('woff2'),url('<?php echo base_url("tmp/fonts/Pacifico/Pacifico-Regular.woff"); ?>') format('woff'),url('<?php echo base_url("tmp/fonts/Pacifico/Pacifico-Regular.svg#Pacifico-Regular"); ?>') format('svg');font-weight:400;font-style:normal}#page-maintain{height:100vh;width:100vw;background-size:cover;position:relative;color:#fff;display:flex;align-items:center}#page-maintain:after{content:"";position:absolute;top:0;right:0;bottom:0;left:0;background-color:#000;opacity:.5;pointer-events:none}#page-maintain .wrap{max-width:550px;margin:0 auto}#page-maintain .title{color:#fff;text-align:center;font-size:45px;line-height:55px;z-index:2;position:relative;margin-bottom:45px;font-family:Pacifico}#page-maintain .content{color:#fff;text-align:center;font-size:16px;line-height:24px;font-weight:400;z-index:2;position:relative;margin-bottom:40px;white-space:pre-wrap}#page-maintain .social{position:relative;z-index:1}#page-maintain .social ul{display:flex;align-items:center;justify-content:center;list-style:none;padding:0;margin:0}#page-maintain .social ul li{margin:0 5px}#page-maintain .social ul li a{display:flex;align-items:center;justify-content:center;width:50px;height:50px;font-size:18px;line-height:26px;color:#333;background-color:#fff}</style>
  </head>
  <body>
    <div id="page-maintain" style="background-image:url(<?php echo $page_meta["maintain_background"] ?>)">
    <div class="wrap">
      <div class="title"><?php echo $page_meta["maintain_title"] ?></div>
      <div class="content"><?php echo $page_meta["maintain_content"] ?></div>
      <div class="social">
        <ul>
          <li><a href="https://www.facebook.com/hopamthanhca/" target="_blank"><i class="fab fa-facebook"></i></a></li>
          <li><a href=""><i class="fab fa-google"></i></a></li>
          <li><a href=""><i class="fab fa-youtube"></i></a></li>
        </ul>
      </div>
    </div>
    </div>
  </body>
  <script src="<?php echo base_url("tmp/js/app.min.js"); ?>" type="text/javascript"></script>
</html>