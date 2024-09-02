<?php $this->extend('Layout'); ?>

<?php $this->section('main_page') ?>
  <?= view_cell('BreadcrumbCell', ['data' => $pagedata['breadcrumb']]) ?>
  <div class="comp-box --padding">
    <div class="comp-box__heading">
      <h1 class="comp-box__title-text"><?= esc($pagedata['pagetitle']) ?></h1>
      <small class="comp-box__title-small"><?= esc($pagedata['pagedesc']) ?></small>
    </div>
    <div class="comp-box__content">
      <?php
      if (isset($pagedata['list'])) {
        foreach ($pagedata['list'] as $value) {
          echo view_cell('SongItemCell', [
            'title'          => $value['title'],
            'author'         => renderAuthor($value['author']),
            'excerpt'        => $value['excerpt'],
            'permalink'      => base_url('bai-hat/'.$value['slug']),
            'datetimeformat' => $pageinit['datetimeformat'],
          ]);
        }
      } else {
      ?>
        <div class="comp-filter__no-result">
          <div class="comp-filter__no-result-text">Không có kết quả</div>
          <div class="comp-filter__no-result-img">
            <img src="images/no-result.png" alt="Không có kết quả">
          </div>
          <div class="comp-filter__no-result-desc">
            <p>Sử dụng công cụ phía trên để tìm kiếm bài hát bạn mong muốn</p>
            <p>Nếu được, bạn hãy đóng góp bài hát theo mong muốn của bạn vô địa chỉ email này: <a href="mailto: minhngoc.ith@gmail.com" title="Email liên hệ">minhngoc.ith@gmail.com</a>, chúng tôi sẽ cập nhật bài hát sớm nhất có thể.</p><p>Xin cảm ơn.</p>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
<?php $this->endSection() ?>