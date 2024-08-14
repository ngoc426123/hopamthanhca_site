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
        <div class="col-12">
          <div class="comp-song-weekly --vertical">
            <div class="comp-song-weekly__title">LỄ RIÊNG - ĐẶC BIỆT</div>
            <div class="comp-song-weekly__list">
              <ul>
                <?php foreach ($pagedata['data']['lerieng']['data'] as $value) { ?>
                  <li><a href="<?= base_url('thanh-ca-hang-tuan/'.$value['slug']) ?>"><?= esc($value['name']) ?></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xxl-4">
          <div class="comp-song-weekly">
            <div class="comp-song-weekly__title">NĂM A</div>
            <div class="comp-song-weekly__list">
              <ul> 
                <?php foreach ($pagedata['data']['nama']['data'] as $value) { ?>
                  <li><a href="<?= base_url('thanh-ca-hang-tuan/'.$value['slug']) ?>"><?= esc($value['name']) ?></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xxl-4">
          <div class="comp-song-weekly">
            <div class="comp-song-weekly__title">NĂM B</div>
            <div class="comp-song-weekly__list">
              <ul> 
                <?php foreach ($pagedata['data']['namb']['data'] as $value) { ?>
                  <li><a href="<?= base_url('thanh-ca-hang-tuan/'.$value['slug']) ?>"><?= esc($value['name']) ?></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xxl-4">
          <div class="comp-song-weekly">
            <div class="comp-song-weekly__title">NĂM C</div>
            <div class="comp-song-weekly__list">
              <ul> 
                <?php foreach ($pagedata['data']['namc']['data'] as $value) { ?>
                  <li><a href="<?= base_url('thanh-ca-hang-tuan/'.$value['slug']) ?>"><?= esc($value['name']) ?></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $this->endSection() ?>