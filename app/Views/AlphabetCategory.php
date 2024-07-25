<?php $this->extend('Layout'); ?>

<?php $this->section('main_page') ?>
  <?= view_cell('BreadcrumbCell', ['data' => $pagedata['breadcrumb']]) ?>
  <div class="comp-box --padding">
    <div class="comp-box__heading">
      <h1 class="comp-box__title-text"><?= esc($pagedata['pagetitle']) ?></h1>
      <small class="comp-box__title-small"><?= esc($pagedata['pagedesc']) ?></small>
    </div>
    <div class="comp-box__content">
      <div class="comp-alphabet">
        <ul>
          <?php foreach ($pagedata['list'] as $value) { ?>
            <li>
              <a href="<?= base_url('bang-chu-cai/'.$value['cat_slug']) ?>" title="alphabet">
                <span><?= esc($value['cat_name']) ?></span>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
<?php $this->endSection() ?>