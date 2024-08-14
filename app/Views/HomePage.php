<?php $this->extend('Layout'); ?>

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
  <div class="comp-box --padding --season --focus --song-fix-desc">
    <div class="comp-box__title">
      <h2 class="comp-box__title-text">Thánh ca tuyển chọn</h2>
      <span class="comp-box__title-small">Danh sách bài hát thánh ca, thánh ca tuyển chọn, được imprimatur(sử dụng trong phụng vụ) bởi các Đấng Bản Quyền tại các giáo phận</span>
    </div>
    <div class="comp-box__content">
      <?php
      foreach ($pagedata['season'] as $value) {
        $author = '';
        echo view_cell('SongItemSeasonCell', [
          'title'       => $value['title'],
          'author'      => renderAuthor($value['author']),
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
          foreach ($pagedata['newest'] as $value) {
            echo view_cell('SongItemCell', [
              'title'       => $value['title'],
              'author'      => renderAuthor($value['author']),
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
          foreach ($pagedata['mostview'] as $value) {
            echo view_cell('SongItemCell', [
              'title'       => $value['title'],
              'author'      => renderAuthor($value['author']),
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
        <?php foreach ($pagedata['cat'] as $value) { ?>
          <div class="swiper-slide">
            <?= view_cell('CatBannerCell', [
              'title' => $value['name'],
              'img'   => base_url($value['img']),
              'link'  => base_url($value['link']),
              'class' => $value['class'],
            ]); ?>
          </div>
        <?php } ?>
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
          foreach ($pagedata['mostweek'] as $value) {
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
            foreach ($pagedata['mostmonth'] as $value) {
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
            foreach ($pagedata['mostlove'] as $value) {
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
  <div class="comp-box --transparent">
    <div class="comp-box__title">
      <h2 class="comp-box__title-text">Các tác giả</h2>
    </div>
    <div class="comp-box__content">
      <div class="comp-slide-author" data-slide-author>
        <div class="swiper">
          <div class="swiper-wrapper">
            <?php foreach ($pagedata['author'] as $value) { ?>
              <div class="swiper-slide">
                <?= view_cell('AuthorBannerCell', [
                  'name'  => $value['name'],
                  'img'   => base_url($value['img']),
                  'link'  => base_url($value['link']),
                ]); ?>
              </div>
            <?php } ?>
            <div class="swiper-slide">
              <div class="comp-author-banner">
                <a href="<?= esc('tac-gia') ?>" title="Nhiều Hơn">
                  <img src="images/tac-gia/_014_nhieuhon.jpg" alt="Nhiều Hơn"/>
                  <span>Nhiều Hơn</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <button class="comp-slide-design__arrow --prev" data-slide-prev></button>
        <button class="comp-slide-design__arrow --next" data-slide-next></button>
      </div>
    </div>
  </div>
  <div class="comp-list-song-home">
    <div class="row">
      <?php foreach ($pagedata['songhome'] as $value) { ?>
        <div class="col-12 col-lg-6">
          <?= view_cell('SongHomeCell', [
            'title'     => $value['title'],
            'date'     => $value['date'],
            'author'    => renderAuthor($value['author']),
            'viewer'    => $value['meta']['luotxem'],
            'lover'     => $value['meta']['lovesong'],
            'content'   => $value['content'],
            'permalink' => base_url('bai-hat/'.$value['slug']),
          ]); ?>
        </div>
      <?php } ?>
    </div>
  </div>
<?php $this->endSection() ?>
