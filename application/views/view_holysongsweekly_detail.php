<div class="main-content">
  <div class="wrapper">
    <?php breadcrumb($breadcrumb) ?>
    <div class="box padding">
      <div class="box-content">
        <div class="holy-songs-weekly">
          <div class="holy-songs-weekly__content">
            <p>TÍNH NĂNG CHUẨN BỊ RA MẮT</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php die(); ?>

<?php
$content = unserialize($weekly["content"]);
?>
<div class="main-content">
  <div class="wrapper">
    <?php breadcrumb($breadcrumb) ?>
    <div class="box padding">
      <div class="box-title">
        <h1><?php echo $weekly["name"] ?></h1>
        <small><?php echo $weekly["desc"] ? $weekly["desc"] : $weekly["meta"]["seodes"] ?></small>
      </div>
      <div class="box-content">
        <div class="holy-songs-weekly">
          <div class="holy-songs-weekly__phase-wrap">
          <?php
            foreach ($content as $key => $value) {
              $phaseFilter = array_values(array_filter($phan_hat, function ($var) use($key) {
                return $key == $var["cat_slug"];
              }))[0];
            ?>
              <div class="holy-songs-weekly__phase">
                <div class="holy-songs-weekly__phase-name"><?php echo $phaseFilter["cat_name"] ?>: </div>
                <div class="holy-songs-weekly__phase-detail">
                  <ul>
                  <?php
                  foreach ($value as $item) {
                    $songFilter = array_values(array_filter($list_song, function ($var) use($item) {
                      return $var["id"] == $item;
                    }))[0];
                  ?>
                    <li>
                      <div class="holy-songs-weekly__phase-song">
                        <div class="holy-songs-weekly__phase-song-detail">
                          <a href="<?php echo base_url("bai-hat/{$songFilter["slug"]}") ?>"><?php echo ucfirst($songFilter["title"]) ?> - <?php echo $songFilter["cat"]["tac-gia"][0]["cat_name"] ?></a>
                          <a href="<?php echo $songFilter["meta"]["pdffile"] ?>"><img src="<?php echo base_url("tmp/images/pdf.svg") ?>" alt=""></a>
                        </div>
                        <div class="holy-songs-weekly__phase-song-desc"><?php echo mb_substr($songFilter["excerpt"], 0, 40) ?></div>
                      </div>
                    </li>
                  <?php
                  }
                  ?>
                  </ul>
                </div>
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