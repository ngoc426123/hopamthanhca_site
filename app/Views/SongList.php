<?php $this->extend('Layout'); ?>

<?php $this->section('main_page') ?>
  <?= view_cell('BreadcrumbCell', ['data' => $pagedata['breadcrumb']]) ?>
  <div class="comp-box --padding">
    <div class="comp-box__heading">
      <h1 class="comp-box__title-text"><?= esc($pagedata['pagetitle']) ?></h1>
      <small class="comp-box__title-small"><?= esc($pagedata['pagedesc']) ?></small>
    </div>
    <div class="comp-box__content">
      <div class="row" data-list-song>
        <div class="col-lg-3">
          <div class="comp-filter__toggle">
            <button type="button" data-filter-toggle><span>Bộ lọc</span><span>(Nhấn để mở)</span></button>
          </div>
          <div class="comp-filter" data-filter>
            <div class="comp-filter__overlay" data-filter-overlay></div>
            <div class="comp-filter__inner" data-filter-form>
              <div class="comp-filter__box" data-filter-box=""><input type="hidden" name="Page" value="1"></div>
              <div class="comp-filter__box" data-filter-box>
                <div class="comp-filter__title">Tên bài hát</div>
                <div class="comp-filter__content">
                  <input class="comp-filter__input" type="text" name="TenBaiHat" placeholder="Tên bài hát...">
                </div>
              </div>
              <div class="comp-filter__box" data-filter-box>
                <div class="comp-filter__title">Chuyên mục</div>
                <div class="comp-filter__content">
                  <div class="comp-filter__list-checkbox">
                    <?php foreach ($pagedata['cat']['chuyen-muc'] as $value) { ?>
                      <label class="comp-filter__checkbox" for="<?= esc($value['id']) ?>">
                        <input type="checkbox" name="ChuyenMuc" value="<?= esc($value['cat_slug']) ?>" id="<?= esc($value['id']) ?>"><span><?= esc($value['cat_name']) ?></span>
                      </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="comp-filter__box" data-filter-box>
                <div class="comp-filter__title">Tác giả</div>
                <div class="comp-filter__content">
                  <div class="comp-filter__list-checkbox">
                    <?php foreach ($pagedata['cat']['tac-gia'] as $value) { ?>
                      <label class="comp-filter__checkbox" for="<?= esc($value['id']) ?>">
                        <input type="checkbox" name="TacGia" value="<?= esc($value['cat_slug']) ?>" id="<?= esc($value['id']) ?>"><span><?= esc($value['cat_name']) ?></span>
                      </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="comp-filter__box" data-filter-box>
                <div class="comp-filter__title">Bảng chữ cái</div>
                <div class="comp-filter__content">
                  <div class="comp-filter__list-checkbox">
                    <?php foreach ($pagedata['cat']['bang-chu-cai'] as $value) { ?>
                      <label class="comp-filter__checkbox" for="<?= esc($value['id']) ?>">
                        <input type="checkbox" name="BangChuCai" value="<?= esc($value['cat_slug']) ?>" id="<?= esc($value['id']) ?>"><span><?= esc($value['cat_name']) ?></span>
                      </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="comp-filter__box" data-filter-box>
                <div class="comp-filter__title">điệu bài hát</div>
                <div class="comp-filter__content">
                  <div class="comp-filter__list-checkbox">
                    <?php foreach ($pagedata['cat']['dieu-bai-hat'] as $value) { ?>
                      <label class="comp-filter__checkbox" for="<?= esc($value['id']) ?>">
                        <input type="checkbox" name="DieuBaiHat" value="<?= esc($value['cat_slug']) ?>" id="<?= esc($value['id']) ?>"><span><?= esc($value['cat_name']) ?></span>
                      </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="comp-filter__button">
                <button type="button" name="submitFormFilter" data-filter-btn>Tìm kiếm</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="comp-filter__count" data-filter-counter><span><?= count($pagedata['list']) ?> bài hát mới nhất</span></div>
          <div class="comp-filter__result" data-filter-result>
            <?php
            foreach ($pagedata['list'] as $value) {
              echo view_cell('SongItemCell', [
                'title'          => $value['title'],
                'author'         => renderAuthor($value['author']),
                'excerpt'        => $value['excerpt'],
                'permalink'      => base_url('bai-hat/'.$value['slug']),
                'date'           => $value['date'],
                'chords'         => $value['meta']['hopamchinh'],
                'datetimeformat' => $pageinit['datetimeformat'],
              ]);
            }
            ?>
          </div>
          <div class="comp-filter__pagination-render" data-filter-pagination-render></div>
        </div>
      </div>
    </div>
  </div>
<?php $this->endSection() ?>