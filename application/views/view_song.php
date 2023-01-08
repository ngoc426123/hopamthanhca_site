<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "MusicRecording",
  "byArtist": [
    {
      "@context": "http://schema.org",
      "@type": "MusicGroup",
      "name": "<?php echo $data_page["song"]["author"]["displayname"] ?>",
      "url": "<?php echo $data_page["song"]["cat"]["tac-gia"][0]["permalink"] ?>" 
    }
  ],
  "creator": {
    "@type": "Person",
    "name": "<?php echo $data_page["song"]["cat"]["tac-gia"][0]["cat_name"] ?>",
    "url": "<?php echo $data_page["song"]["cat"]["tac-gia"][0]["permalink"] ?>"
  },
  "name": "<?php echo ucfirst($data_page["song"]["title"]) ?>",
  "genre": "Indie",
  "version": "1",
  "image": "<?php echo base_url("tmp/images/logo.svg"); ?>",
  "url": "<?php echo $data_page["song"]["permalink"] ?>",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.5",
    "reviewCount": "<?php echo $data_page["song"]["meta"]["luotxem"] != 0 ? $data_page["song"]["meta"]["luotxem"] : 1 ?>"
  },
  "description": "<?php echo $data_page["song"]["meta"]["seodes"] ?>",
  "datePublished": "<?php echo $data_page["song"]["date"] ?>",
  "interactionStatistic": [
    {
      "@type": "InteractionCounter",
      "interactionType": "http://schema.org/LikeAction",
      "userInteractionCount": "<?php echo $data_page["song"]["meta"]["lovesong"] ?>"
    },
    {
      "@type": "InteractionCounter",
      "interactionType": "http://schema.org/ListenAction",
      "userInteractionCount": "<?php echo $data_page["song"]["meta"]["luotxem"] ?>"
    },
    {
      "@type": "InteractionCounter",
      "interactionType": "http://schema.org/CommentAction",
      "userInteractionCount": "<?php echo $data_page["song"]["meta"]["luotxem"] ?>"
    }
  ]
}
</script>
<?php
$pdf = ($data_page["song"]["meta"]["pdffile"] != "") 
  ? $data_page["song"]["meta"]["pdffile"] 
  : base_url("tmp/default.pdf");
?>
<div class="main-content">
  <div class="wrapper">
    <?php breadcrumb($breadcrumb) ?>
    <div class="box padding detail">
      <div class="box-heading">
        <div class="box-title">
          <h1><?php echo $data_page["song"]["title"] ?></h1> - 
          <a href="<?php echo $data_page["song"]["cat"]["tac-gia"][0]["permalink"] ?>" title="<?php echo $data_page["song"]["cat"]["tac-gia"][0]["cat_name"] ?>">
            <?php echo $data_page["song"]["cat"]["tac-gia"][0]["cat_name"] ?>
          </a>
        </div>
        <div class="song-share">
          <ul>
            <li><a class="fac share-facebook" href="javascript:void(0)"><i class="fab fa-facebook"></i></a></li>
            <li><a class="goo" href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600,hl=vi');return false;"><i class="fab fa-google"></i></a></li>
            <li><a class="twi" href=""><i class="fab fa-twitter"></i></a></li>
            <?php
            $love = $data_page["song"]["meta"]["lovesong"];
            ?>
            <li><a class="love <?php echo ($love>0) ? 'active' : '' ?>" href="" data-post-id="<?php echo $data_page["song"]["id"] ?>" data-love='<?php echo $love; ?>' data-url="<?php echo base_url("updatelovesong"); ?>"><i class="fa fa-heart"></i></a><span><?php echo $love; ?></span></li>
          </ul>
        </div>
      </div>
      <div class="box-content">
        <div class="song-tools">
          <div class="song-tools__group">
            <button class="song-tools__btn" id="chordDown">b</button>
            <input class="song-tools__input chord_ipt" value="<?php echo $data_page["song"]["meta"]["hopamchinh"] ?>">
            <button class="song-tools__btn" id="chordUp">#</button>
          </div>
          <div class="song-tools__group">
            <button class="song-tools__btn" id="fontDown">-</button>
            <input class="song-tools__input font_ipt" value="16px">
            <button class="song-tools__btn" id="fontUp">+</button>
          </div>
          <div class="song-tools__group d-none d-xl-block">
            <label for="chiacot">
              <input class="song-tools__checkbox" type="checkbox" id="chiacot" checked>
              <div class="song-tools__text">Chia cột</div>
            </label>
          </div>
          <div class="song-tools__group">
            <label for="gopdong">
              <input class="song-tools__checkbox" type="checkbox" id="gopdong" checked>
              <div class="song-tools__text">Tách dòng</div>
            </label>
          </div>
          <div class="song-tools__group">
            <label for="anhopam">
              <input class="song-tools__checkbox" type="checkbox" id="anhopam">
              <div class="song-tools__text">Ẩn hợp âm</div>
            </label>
          </div>
        </div>
        <div class="song-more">
          <div class="song-more__toggle"><span>Thêm thông tin</span></div>
          <div class="song-more__dropdown">
            <div class="song-more__wrap">
              <div class="row">
                <div class="col-12 col-lg-4">
                  <div class="song-info">
                    <ul>
                      <li><span class="song-info__att">Tác giả :</span><a href="<?php echo $data_page["song"]["cat"]["tac-gia"][0]["permalink"] ?>" class="song-info__ats song-info--up" title="<?php echo $data_page["song"]["cat"]["tac-gia"][0]["cat_name"] ?>"><?php echo $data_page["song"]["cat"]["tac-gia"][0]["cat_name"] ?></a></li>
                      <li><span class="song-info__att">Người đăng :</span><span class="song-info__ats"><?php echo $data_page["song"]["author"]["displayname"] ?></span></li>
                      <li><span class="song-info__att">Ngày đăng :</span><span class="song-info__ats"><?php echo $data_page["song"]["date"] ?></span></li>
                      <li><span class="song-info__att">Lượt xem :</span><span class="song-info__ats"><?php echo $data_page["song"]["meta"]["luotxem"] ?></span></li>
                      <li><span class="song-info__att">Tone chính :</span><span class="song-info__ats"><?php echo $data_page["song"]["meta"]["hopamchinh"] ?></span></li>
                      <li><span class="song-info__att">Điệu bài hát :</span><a href="<?php echo $data_page["song"]["cat"]["dieu-bai-hat"][0]["permalink"] ?>" class="song-info__ats" title="<?php echo $data_page["song"]["cat"]["dieu-bai-hat"][0]["cat_name"] ?>"><?php echo $data_page["song"]["cat"]["dieu-bai-hat"][0]["cat_name"] ?></a></li>
                      <li><span class="song-info__att">Chuyên mục :</span><a href="<?php echo $data_page["song"]["cat"]["chuyen-muc"][0]["permalink"] ?>" class="song-info__ats song-info--up" title="<?php echo (isset($data_page["song"]["cat"]["chuyen-muc"])) ? $data_page["song"]["cat"]["chuyen-muc"][0]["cat_name"] : "Chưa rõ chuyên mục" ?>"><?php echo (isset($data_page["song"]["cat"]["chuyen-muc"])) ? $data_page["song"]["cat"]["chuyen-muc"][0]["cat_name"] : "Chưa rõ chuyên mục" ?></a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-12 col-lg-4">
                  <div class="song-intro d-none d-lg-block">
                    <ul>
                      <li><span class="song-intro__att"><img src="<?php echo base_url("tmp/images/print.png"); ?>" alt=""></span><span class="song-intro__ats song-intro--up">In bài hát</span></li>
                      <li><span class="song-intro__att"><img src="<?php echo base_url("tmp/images/right.png"); ?>" alt=""></span><span class="song-intro__ats song-intro--up">Thăng 1/2 note</span></li>
                      <li><span class="song-intro__att"><img src="<?php echo base_url("tmp/images/left.png"); ?>" alt=""></span><span class="song-intro__ats song-intro--up">Giáng 1/2 note</span></li>
                      <li><span class="song-intro__att"><img src="<?php echo base_url("tmp/images/up.png"); ?>" alt=""></span><span class="song-intro__ats song-intro--up">Tăng 1 font size</span></li>
                      <li><span class="song-intro__att"><img src="<?php echo base_url("tmp/images/down.png"); ?>" alt=""></span><span class="song-intro__ats song-intro--up">giảm 1 font size</span></li>
                    </ul>
                  </div>
                </div>
                <div class="col-12 col-lg-4">
                  <div class="song-pdf">
                    <div class="song-pdf__file"><a href="<?php echo $pdf ?>" src="<?php echo $pdf ?>" downloaded target="_blank"><img src="<?php echo base_url("tmp/images/pdf.svg"); ?>" alt=""></a></div>
                    <div class="song-pdf__note">(Click vào hình để xem hoặc tải file sheet nhạc)</div>
                    <div class="song-pdf__note">Xin cảm ơn tác giả, cũng là chủ của trang web <a href="http://www.thuvienamnhac.org/" terget="_blank">Thư viện âm nhạc</a>, tác giả <span>Đinh Công Huỳnh</span> đã cho phép trang web sử dụng file PDF từ trang.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-xl-8 song-content__slipt">
            <div class="song-content song-content__lahubalahu"><?php echo convent_song($data_page["song"]["content"]); ?></div>
          </div>
          <div class="col-12 col-xl-4">
            <div class="song-list-chord"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center song-other">
      <div class="col-lg-6">
        <div class="box-heading">
          <div class="box-title"> 
            <h3>Cùng tác giả <?php echo $data_page["song"]["cat"]["tac-gia"][0]["cat_name"] ?></h3>
          </div>
        </div>
        <div class="box padding">
          <div class="box-content">
            <div class="list-song">
            <?php
            foreach ($data_page["songother"]["tac-gia"] as $key => $value) {
            ?>
              <div class="song">
                <div class="song__title">
                  <a href="<?php echo $value["permalink"] ?>" title="<?php echo $value["title"] ?>">
                    <?php echo $value["title"] ?>
                    <span>
                      <?php echo $value["cat"]["tac-gia"][0]["cat_name"] ?>
                    </span>
                  </a>
                </div>
                <div class="song__desc"><?php echo $value["excerpt"] ?></div>
              </div>
            <?php
            }
            ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6"> 
        <div class="box-heading">
          <div class="box-title"> 
            <h3>Cùng chuyên mục <?php echo $data_page["song"]["cat"]["chuyen-muc"][0]["cat_name"] ?></h3>
          </div>
        </div>
        <div class="box padding"> 
          <div class="box-content">
            <div class="list-song">
            <?php
            foreach ($data_page["songother"]["chuyen-muc"] as $key => $value) {
            ?>
              <div class="song">
                <div class="song__title">
                  <a href="<?php echo $value["permalink"] ?>" title="<?php echo $value["title"] ?>">
                    <?php echo $value["title"] ?>
                    <span>
                      <?php echo $value["cat"]["tac-gia"][0]["cat_name"] ?>
                    </span>
                  </a>
                </div>
                <div class="song__desc"><?php echo $value["excerpt"] ?></div>
              </div>
            <?php
            }
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>