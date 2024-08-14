<?php $this->extend('Layout'); ?>

<?php $this->section('main_page') ?>
  <?= view_cell('BreadcrumbCell', ['data' => $pagedata['breadcrumb']]) ?>
  <div class="comp-box --padding">
    <div class="comp-box__heading">
      <h1 class="comp-box__title-text"><?= esc($pagedata['pagetitle']) ?></h1>
      <small class="comp-box__title-small"><?= esc($pagedata['pagedesc']) ?></small>
    </div>
    <div class="comp-box__content">
      <div class="row">
        <?php foreach ($pagedata['catalogue'] as $key => $value) { ?>
          <div class="col-md-6 col-lg-3">
            <div class="comp-catalogue">
              <div class="comp-catalogue__head">
                <div class="comp-catalogue__counter"><?= esc($value['counter']) ?></div>
                <div class="comp-catalogue__name"><?= esc($value['name']) ?></div>
              </div>
              <div class="comp-catalogue__body">
                <div class="comp-catalogue__list">
                  <ul>
                    <?php foreach ($value['data'] as $key => $catVal) { ?>
                      <li><a href="<?= base_url($value['slug'].'/'.$catVal['cat_slug']) ?>" title="<?= esc($catVal['cat_name']) ?>">
                        <span><?= $value['slug'] == 'bang-chu-cai' ? 'bài hát chữ' : '' ?> <?= esc($catVal['cat_name']) ?></span>
                      </a></li>
                    <?php } ?>
                  </ul>
                </div>
                <div class="comp-catalogue__cta"><a href="<?= base_url($value['slug']) ?>" title="Xem thêm"><span>Xem thêm</span></a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
<?php $this->endSection() ?>