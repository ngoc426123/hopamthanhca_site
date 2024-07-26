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
          ?>
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
      <div class="comp-box --padding">
        <div class="box-content">
          <div class="comp-song-home">
            <div class="comp-song-home__wrap">
              <div class="comp-song-home__title">
                <h3>
                  <a href="<?= base_url('bai-hat/'.$pagedata['songrandom']['slug']) ?>">
                    <?= esc($pagedata['songrandom']['title']) ?>
                    <span><?= esc(renderAuthor($pagedata['songrandom']['author'])) ?></span>
                  </a>
                </h3>
              </div>
              <div class="comp-song-home__info"><?= esc($pagedata['songrandom']['date']) ?></div>
              <div class="comp-song-home__attrs">
                <div class="comp-song-home__attr-item"><span class="fa-eye"><?= esc($pagedata['songrandom']['meta']['luotxem']) ?></span></div>
                <div class="comp-song-home__attr-item"><span class="fa-heart"><?= esc($pagedata['songrandom']['meta']['lovesong']) ?></span></div>
              </div>
            </div>
            <div class="comp-song-home__content">
              <?= html_entity_decode($pagedata['songrandom']['content']) ?>
            </div>
            <div class="comp-song-home__link"><a href="<?= base_url('bai-hat/'.$pagedata['songrandom']['slug']) ?>">Xem chi tiết</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $this->endSection() ?>