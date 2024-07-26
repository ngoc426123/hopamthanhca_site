<?php $this->extend('Layout'); ?>

<?php $this->section('main_page') ?>
  <?= view_cell('BreadcrumbCell', ['data' => $pagedata['breadcrumb']]) ?>
  <div class="comp-box --padding">
    <div class="comp-box__heading">
      <h1 class="comp-box__title-text"><?= esc($pagedata['pagetitle']) ?></h1>
      <small class="comp-box__title-small"><?= esc($pagedata['pagedesc']) ?></small>
    </div>
    <div class="comp-box__content">
      <div class="comp-five-grid">
        <div class="comp-five-grid__grid">
          <?php foreach ($pagedata['list'] as $value) { ?>
            <div class="comp-five-grid__col">
              <?= view_cell('CategoryItemCell', [
                'title' => $pagedata['typename'],
                'name'  => $value['cat_name'],
                'count' => $value['count'],
                'link'  => base_url($pagedata['typeslug'].'/'.$value['cat_slug']),
              ]) ?>
            </div>
          <?php } ?>
        </div>
      </div>
      <?= $pagedata['pagination'] ?>
    </div>
  </div>
<?php $this->endSection() ?>