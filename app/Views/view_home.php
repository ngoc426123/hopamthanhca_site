<?php $this->extend('layout'); ?>

<?php $this->section('page_title') ?>
  <title>Hợp âm Thánh ca - Trang chủ</title>
<?php $this->endSection() ?>

<?php $this->section('meta_tag') ?>
  <meta property="og:title" content="Trang chủ">
  <meta property="og:url" content="localhost:3000">
  <meta property="og:description" content="Lorem ispum">
  <meta name="description" content="Lorem ispum">
  <meta name="keywords" content="hop,am,thanh,ca">
<?php $this->endSection() ?>

<?php $this->section('link_tag') ?>
  <link rel="canonical" href="localhost:3000">
<?php $this->endSection() ?>

<?php $this->section('schema') ?>
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
<?php $this->endSection() ?>

<?php $this->section('main_page') ?>
  <h1>title world</h1>
<?php $this->endSection() ?>