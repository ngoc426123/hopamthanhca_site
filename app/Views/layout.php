<?php $session = service('session'); ?>
<!DOCTYPE html>
<html>
  <head>
    <!-- TITLE TAG -->
    <title><?= esc($pagemeta['title']) ?></title>
    <!-- META TAG -->
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta property="og:title" content="<?= esc($pagemeta['title']) ?>">
    <meta property="og:description" content="<?= esc($pagemeta['desc']) ?>">
    <meta property="og:image" content="<?= base_url("images/logo.svg"); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $session->get('site_url') ?>">
    <meta name="description" content="<?= esc($pagemeta['desc']) ?>">
    <meta name="keywords" content="<?= esc($pagemeta['keywork']) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google" content="nositelinkssearchbox">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="google-site-verification" content="u_MBkWSe2AFG1aeQNi93_Y_jL4F7Cq31jGZACqK2SGs" />
    <!-- LINK TAG -->
    <link rel="canonical" href="<?= esc($pagemeta['canonical']) ?>">
    <link rel="shortcut icon" href="<?= base_url($session->get('favicon')); ?>"/>
    <link rel="image_src" href="<?= base_url("images/1.jpg"); ?>">
    <link href="<?= base_url($session->get('favicon')) ?>" rel="icon" sizes="64x64" type="image/ico">
    <!-- ASSETS -->
    <link href="<?= base_url("css/style.min.css"); ?>" rel="stylesheet">
    <link href="<?= base_url("css/customs.css"); ?>" rel="stylesheet">
    <!-- SCHEMA -->
    <?= $this->renderSection('schema'); ?>
    <!-- Google tag (gtag.js) -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-EZRP510794"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-EZRP510794');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6075640192892482" crossorigin="anonymous"></script> -->
  </head>
  <body>
    <div class="page">
      <?= $this->include('Modules/Header'); ?>
      <div class="main-page" data-main-page>
        <div class="comp-wrapper">
          <?= $this->renderSection('main_page'); ?>
          <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6075640192892482" crossorigin="anonymous"></script> -->
          <!-- Ads2 -->
          <!-- <ins
            class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-6075640192892482"
            data-ad-slot="6508241366"
            data-ad-format="auto"
            data-full-width-responsive="true"
          >
          </ins>
          <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
          </script> -->
        </div>
      </div>
      <?= $this->include('Modules/Footer'); ?>
      <?= $this->include('Modules/Loading'); ?>
    </div>
  </body>
  <script type="text/javascript">
    const BASE_URL = '<?= base_url() ?>';
  </script>
  <script src="<?= base_url("js/endpoint.js"); ?>" type="text/javascript"></script>
  <script src="<?= base_url("js/app.min.js"); ?>" type="text/javascript"></script>
</html>