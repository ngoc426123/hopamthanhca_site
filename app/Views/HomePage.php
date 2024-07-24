<?php $this->extend('Layout'); ?>

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
  <div class="comp-box --season --focus --song-fix-desc">
    <div class="comp-box__title --padding">
      <h2 class="comp-box__title-text">Thánh ca tuyển chọn</h2>
      <span>Danh sách bài hát thánh ca, thánh ca tuyển chọn, được imprimatur(sử dụng trong phụng vụ) bởi các Đấng Bản Quyền tại các giáo phận</span>
    </div>
    <div class="comp-box__content">
      <?php
        foreach ($season as $value) {
          echo view_cell('SongItemSeasonCell', [
            'title'       => $value['title'],
            'author'      => $value['meta']['author'],
            'excerpt'     => $value['excerpt'],
            'permalink'   => base_url('bai-hat/'.$value['slug']),
          ]);
        }
        ?>
      <div class="comp-song-item --more">
        <div class="comp-song-item__text-more">Xem<br/> nhiều hơn</div>
        <a class="comp-song-item__link" href="<?= esc('bai-hat') ?>"></a>
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="comp-box --padding --song-fix-desc">
        <div class="comp-box__title">
          <h2 class="comp-box__title-text">Bài hát mới nhất</h2>
        </div>
        <div class="comp-box__content">
          <?php
          foreach ($newest as $value) {
            echo view_cell('SongItemCell', [
              'title'       => $value['title'],
              'author'      => $value['meta']['author'],
              'excerpt'     => $value['excerpt'],
              'permalink'   => base_url('bai-hat/'.$value['slug']),
            ]);
          }
          ?>
        </div>
      </div>
    </div>
    <div class="col-lg-6"> 
      <div class="comp-box --padding --song-fix-desc">
        <div class="comp-box__title">
          <h2 class="comp-box__title-text">Bài hát xem nhiều nhất</h2>
        </div>
        <div class="comp-box__content">
          <?php
          foreach ($mostview as $value) {
            echo view_cell('SongItemCell', [
              'title'       => $value['title'],
              'author'      => $value['meta']['author'],
              'excerpt'     => $value['excerpt'],
              'permalink'   => base_url('bai-hat/'.$value['slug']),
            ]);
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="comp-slide-category" data-slide-category>
    <div class="swiper">
      <div class="swiper-wrapper">
        <?php
          foreach ($chuyenmuc as $value) {
            echo view_cell('HomeCatBannerCell', [
              'title' => $value['name'],
              'img'   => base_url($value['img']),
              'link'  => base_url($value['link']),
              'class' => $value['class'],
            ]);
          }
        ?>
      </div>
    </div>
    <button class="comp-slide-design__arrow --prev" data-slide-prev></button>
    <button class="comp-slide-design__arrow --next" data-slide-next></button>
  </div>
  <div class="row">
    <div class="col-12 col-md-6 col-lg-4">
      <div class="comp-box --transparent">
        <div class="comp-box__title">
          <h3 class="comp-box__title-text">Xem nhiều trong tuần</h3>
        </div>
        <div class="comp-box__content --background --padding">
          <?php
            foreach ($mostweek as $value) {
              echo view_cell('SongIronCell', [
                'title' => $value['title'],
                'link'  => base_url('bai-hat/'.$value['slug']),
                'viewer'  => $value['meta']['luotxem'],
                'lover'  => $value['meta']['lovesong'],
              ]);
            }
          ?>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4">
      <div class="comp-box --transparent">
        <div class="comp-box__title">
          <h3 class="comp-box__title-text">Xem nhiều trong tháng</h3>
        </div>
        <div class="comp-box__content --background --padding">
          <?php
            foreach ($mostmonth as $value) {
              echo view_cell('SongIronCell', [
                'title' => $value['title'],
                'link'  => base_url('bai-hat/'.$value['slug']),
                'viewer'  => $value['meta']['luotxem'],
                'lover'  => $value['meta']['lovesong'],
              ]);
            }
          ?>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-12 col-lg-4">
      <div class="comp-box --transparent">
        <div class="comp-box__title">
          <h3 class="comp-box__title-text">Yêu thích nhất trang</h3>
        </div>
        <div class="comp-box__content --background --padding">
          <?php
            foreach ($mostlove as $value) {
              echo view_cell('SongIronCell', [
                'title' => $value['title'],
                'link'  => base_url('bai-hat/'.$value['slug']),
                'viewer'  => $value['meta']['luotxem'],
                'lover'  => $value['meta']['lovesong'],
              ]);
            }
          ?>
        </div>
      </div>
    </div>
  </div>
<?php $this->endSection() ?>