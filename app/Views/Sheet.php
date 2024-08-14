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
      foreach ($pagedata['list'] as $value) {
        echo view_cell('SongItemCell', [
          'title'       => $value['title'],
          'author'      => renderAuthor($value['author']),
          'excerpt'     => $value['excerpt'],
          'permalink'   => base_url('bai-hat/'.$value['slug']),
          'pdf'         => $value['meta']['pdffile'],
        ]);
      }
      ?>
      <?= $pagedata['pagination'] ?>
    </div>
  </div>
<?php $this->endSection() ?>