<?php $this->extend('Layout'); ?>

<?php $this->section('main_page') ?>
  <?= view_cell('BreadcrumbCell', ['data' => $pagedata['breadcrumb']]) ?>
  <div class="row">
    <div class="col-12 col-lg-8">
      <div class="comp-box --padding">
        <div class="comp-box__heading">
          <h1 class="comp-box__title-text"><?= esc($pagedata['pagetitle']) ?></h1>
          <small class="comp-box__title-small"><?= esc($pagedata['pagedesc']) ?></small>
        </div>
        <div class="comp-box__content">
          <?php
          if (count($pagedata['songlist']) > 0) {
            foreach ($pagedata['songlist'] as $value) {
              echo view_cell('SongItemCell', [
                'title'     => $value['title'],
                'author'    => renderAuthor($value['author']),
                'excerpt'   => $value['excerpt'],
                'permalink' => base_url('bai-hat/'.$value['slug']),
                'date'      => $value['date'],
                'chords'    => $value['meta']['hopamchinh'],
              ]);
            }
          } else { ?>
            <div class="comp-filter__no-result">
              <div class="comp-filter__no-result-text">Hiện chưa có bài hát nào trong chuyên mục này</div>
              <div class="comp-filter__no-result-img">
                <img src="<?= base_url('images/no-result.png') ?>" alt="Không có kết quả chính xác">
              </div>
              <div class="comp-filter__no-result-desc">
                <p>Có thể hệ thống vẫn chưa có bài hát nào phù hợp với mong muốn của bạn, xin thông cảm vì thiếu sót này của đội ngũ chúng tôi.</p>
                <p>Nếu được, bạn hãy đóng góp bài hát theo mong muốn của bạn vô địa chỉ email này: <a href="mailto: minhngoc.ith@gmail.com" title="Email liên hệ">minhngoc.ith@gmail.com</a>, chúng tôi sẽ cập nhật bài hát sớm nhất có thể.</p><p>Xin cảm ơn.</p>
              </div>
            </div>
          <?php } ?>
          <?= $pagedata['pagination'] ?>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="comp-box --padding --small-spacing">
        <div class="comp-category-tag">
          <ul>
            <?php foreach ($pagedata['catlist'] as $value) { ?>
              <li><a href="<?= base_url($pagedata['typeslug'].'/'.$value['cat_slug']); ?>"><span><?= esc($value['cat_name']); ?></span></a></li>
            <?php } ?>
            <?php if (count($pagedata['catlist']) > 26) { ?>
              <li><a href="<?= base_url($value['cat_slug']) ?>"><span>Nhiều hơn ...</span></a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <?php if (count($pagedata['songrandom']) > 0) { ?>
        <?= view_cell('SongHomeCell', [
          'title'     => $pagedata['songrandom']['title'],
          'date'      => $pagedata['songrandom']['date'],
          'author'    => renderAuthor($pagedata['songrandom']['author']),
          'viewer'    => $pagedata['songrandom']['meta']['luotxem'],
          'lover'     => $pagedata['songrandom']['meta']['lovesong'],
          'content'   => $pagedata['songrandom']['content'],
          'permalink' => base_url('bai-hat/'.$pagedata['songrandom']['slug']),
        ]); ?>
      <?php } ?>
    </div>
  </div>
<?php $this->endSection() ?>