<?php $this->extend('Layout'); ?>

<?php $this->section('main_page') ?>
  <?php $data = $pagedata['data'] ?>
  <?= view_cell('BreadcrumbCell', ['data' => $pagedata['breadcrumb']]) ?>
  <div class="comp-box --padding">
    <div class="comp-box__heading">
      <h1 class="comp-box__title-text"><?= esc($pagedata['pagetitle']) ?></h1>
      <small class="comp-box__title-small"><?= esc($pagedata['pagedesc']) ?></small>
    </div>
    <div class="comp-box__content">
      <div class="comp-song-weekly --vertical">
        <?php foreach ($data['content'] as $pharse) { ?>
          <div class="comp-song-weekly__phase">
            <div class="comp-song-weekly__phase-name"><?= esc($pharse['cat']['cat_name']) ?>: </div>
            <div class="comp-song-weekly__phase-detail">
              <ul>
                <?php foreach ($pharse['list'] as $key => $song) { ?>
                  <li>
                    <div class="comp-song-weekly__phase-song">
                      <div class="comp-song-weekly__phase-song-detail">
                        <a href="<?= base_url('bai-hat/'.$song['slug']) ?>"><?= esc($song['title']) ?></a>
                        <a href="<?= esc($song['pdffile']) ?>"><img src="<?= base_url('images/pdf.svg') ?>" alt=""></a>
                      </div>
                      <div class="comp-song-weekly__phase-song-desc"><?= esc($song['excerpt']) ?></div>
                    </div>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
<?php $this->endSection() ?>