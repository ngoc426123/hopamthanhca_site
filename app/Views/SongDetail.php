<?php $this->extend('Layout'); ?>
<?php $session = service('session'); ?>

<?php $this->section('main_page') ?>
  <?php $songdata = $pagedata['songdata'] ?>
  <?= view_cell('BreadcrumbCell', ['data' => $pagedata['breadcrumb']]) ?>
  <div class="comp-box --padding --detail">
    <div class="comp-box__heading">
      <div class="comp-box__title">
        <h1 class="comp-box__title-text"><?= esc($songdata['title']) ?></h1>
        <?php foreach ($songdata['author'] as $key => $value) { ?>
          <a class="comp-box__title-author" href="<?= base_url('tac-gia/'.$value['cat_slug']) ?>" title="<?= esc($value['cat_name']) ?>">
            <?= $key != 0 ? ', ' : ' - ' ?><?= esc($value['cat_name']) ?>
          </a>
        <?php } ?>
      </div>
      <div class="comp-song-share">
        <ul>
          <li><a class="fac share-facebook" href="javascript:void(0)"><i class="fab fa-facebook"></i></a></li>
          <li><a class="goo" href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600,hl=vi');return false;"><i class="fab fa-google"></i></a></li>
          <li><a class="twi" href=""><i class="fab fa-twitter"></i></a></li>
          <li><a
            class="love <?= esc($songdata['meta']['lovesong'] > 0 ? '--active' : '') ?>"
            href=""
            data-love-song
            data-post-id="<?= esc($songdata['id']) ?>"
            data-love="5"
          ><i class="fa fa-heart"></i></a><span><?= esc($songdata['meta']['lovesong']) ?></span></li>
        </ul>
      </div>
    </div>
    <div class="box-content">
      <div class="comp-song-controls" data-song-controls>
        <div class="comp-song-controls__group">
          <button class="comp-song-controls__btn" data-chords-down><img src="<?= base_url('images/icon/flat.svg') ?>" alt="flat music"/></button>
          <input class="comp-song-controls__input" value="<?= esc($songdata['meta']['hopamchinh']) ?>" data-chords-input>
          <button class="comp-song-controls__btn" data-chords-up><img src="<?= base_url('images/icon/sharp.svg') ?>" alt="sharp music"/></button>
        </div>
        <div class="comp-song-controls__group">
          <button class="comp-song-controls__btn" data-font-down>-</button>
          <input class="comp-song-controls__input" data-font-input value="15px">
          <button class="comp-song-controls__btn" data-font-up>+</button>
        </div>
        <div class="comp-song-controls__group d-none d-xl-block">
          <label for="columnSplit">
            <input class="comp-song-controls__checkbox" type="checkbox" id="columnSplit" checked data-column-split-input>
            <div class="comp-song-controls__text">Chia cột</div>
          </label>
        </div>
        <div class="comp-song-controls__group">
          <label for="inline">
            <input class="comp-song-controls__checkbox" type="checkbox" id="inline" checked data-chords-inline-input>
            <div class="comp-song-controls__text">Tách dòng</div>
          </label>
        </div>
        <div class="comp-song-controls__group">
          <label for="hideChords">
            <input class="comp-song-controls__checkbox" type="checkbox" id="hideChords" data-hide-chords-input>
            <div class="comp-song-controls__text">Ẩn hợp âm</div>
          </label>
        </div>
      </div>
      <div class="comp-song-accordion" data-song-accordion>
        <div class="comp-song-accordion__toggle" data-toggle><span>Thêm thông tin</span></div>
        <div class="comp-song-accordion__dropdown" data-dropdown>
          <div class="comp-song-accordion__wrap">
            <div class="row">
              <div class="col-12 col-lg-4">
                <div class="comp-song-info">
                  <ul>
                    <li><span class="comp-song-info__att">Tác giả :</span><a class="comp-song-info__ats --up" href=""><?= esc($pagedata['authorrender']) ?></a></li>
                    <li><span class="comp-song-info__att">Người đăng :</span><span class="comp-song-info__ats"><?= esc($songdata['user']) ?></span></li>
                    <li><span class="comp-song-info__att">Ngày đăng :</span><span class="comp-song-info__ats"><?= esc(date_format(date_create($songdata['date']), $session->get('datetimeformat'))) ?></span></li>
                    <li><span class="comp-song-info__att">Lượt xem :</span><span class="comp-song-info__ats"><?= esc($songdata['meta']['luotxem']) ?></span></li>
                    <li><span class="comp-song-info__att">Tone chính :</span><span class="comp-song-info__ats"><?= esc($songdata['meta']['hopamchinh']) ?></span></li>
                    <li><span class="comp-song-info__att">Chuyên mục :</span><a class="comp-song-info__ats" href="<?= base_url('chuyen-muc/'.$songdata['cat']['cat_slug']) ?>"><?= esc($songdata['cat']['cat_name']) ?></a></li>
                    <li><span class="comp-song-info__att">Điệu bài hát :</span><a class="comp-song-info__ats --up" href="<?= base_url('dieu-bai-hat/'.$songdata['rhythm']['cat_slug']) ?>"><?= esc($songdata['rhythm']['cat_name']) ?></a></li>
                  </ul>
                </div>
              </div>
              <div class="col-12 col-lg-4">
                <div class="comp-song-intro d-none d-lg-block">
                  <ul>
                    <li><span class="comp-song-intro__keys"><span class="comp-song-intro__key"><i>Ctrl</i></span><i class="fa fa-plus"></i><span class="comp-song-intro__key"><i>P</i></span></span><span class="comp-song-intro__ats comp-song-intro--up">In bài hát</span></li>
                    <li><span class="comp-song-intro__keys"><span class="comp-song-intro__key"><i>Ctrl</i></span><i class="fa fa-plus"></i><span class="comp-song-intro__key"><i class="fa fa-arrow-right"></i></span></span><span class="comp-song-intro__ats comp-song-intro--up">Thăng 1/2 note</span></li>
                    <li><span class="comp-song-intro__keys"><span class="comp-song-intro__key"><i>Ctrl</i></span><i class="fa fa-plus"></i><span class="comp-song-intro__key"><i class="fa fa-arrow-left"></i></span></span><span class="comp-song-intro__ats comp-song-intro--up">Giáng 1/2 note</span></li>
                    <li><span class="comp-song-intro__keys"><span class="comp-song-intro__key"><i>Ctrl</i></span><i class="fa fa-plus"></i><span class="comp-song-intro__key"><i class="fa fa-arrow-up"></i></span></span><span class="comp-song-intro__ats comp-song-intro--up">Tăng 1 font size</span></li>
                    <li><span class="comp-song-intro__keys"><span class="comp-song-intro__key"><i>Ctrl</i></span><i class="fa fa-plus"></i><span class="comp-song-intro__key"><i class="fa fa-arrow-down"></i></span></span><span class="comp-song-intro__ats comp-song-intro--up">giảm 1 font size</span></li>
                  </ul>
                </div>
              </div>
              <div class="col-12 col-lg-4">
                <div class="comp-song-pdf">
                  <div class="comp-song-pdf__file"><a href="<?= esc($songdata['meta']['pdffile']) ?>" target="_blank" downloaded="downloaded"><img src="<?= base_url('images/pdf.svg') ?>"/></a>
                  </div>
                  <div class="comp-song-pdf__note">(Click vào hình để tải file sheet nhạc)</div>
                  <div class="comp-song-pdf__note">Xin cảm ơn tác giả, cũng là chủ của trang web <a href='http://www.thuvienamnhac.org/' terget='_blank'>Thư viện âm nhạc</a>, tác giả <span>Đinh Công Huỳnh</span> Đã cho phép trang web sử dụng file PDF từ trang.</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-xl-8 comp-song-content__split">
          <div class="comp-song-content --inline" data-song-content>
            <?= html_entity_decode($songdata['content']) ?>
          </div>
        </div>
        <div class="col-12 col-xl-4">
          <div class="comp-song-list-chords" data-list-chords></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="comp-box --padding">
        <div class="comp-box__title">
          <h3 class="comp-box__title-text">Cùng tác giả <?= esc($songdata['author'][0]['cat_name']) ?></h3>
        </div>
        <div class="comp-box__content">
          <?php
          foreach ($pagedata['songauthor'] as $value) {
            echo view_cell('SongItemCell', [
              'title'       => $value['title'],
              'author'      => $value['cat']['cat_name'],
              'excerpt'     => $value['excerpt'],
              'permalink'   => base_url('bai-hat/'.$value['slug']),
            ]);
          }
          ?>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="comp-box --padding">
        <div class="comp-box__title">
          <h3 class="comp-box__title-text">Cùng Chuyên mục <?= esc($songdata['cat']['cat_name']) ?></h3>
        </div>
        <div class="comp-box__content">
          <?php
          foreach ($pagedata['songcat'] as $value) {
            echo view_cell('SongItemCell', [
              'title'       => $value['title'],
              'author'      => renderAuthor($value['cat']),
              'excerpt'     => $value['excerpt'],
              'permalink'   => base_url('bai-hat/'.$value['slug']),
            ]);
          }
          ?>
        </div>
      </div>
    </div>
  </div>
<?php $this->endSection() ?>