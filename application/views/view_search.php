<div class="main-content">
  <div class="wrapper">
    <div class="breadcrumb">
      <ul>
      <?php
        foreach($breadcrumb as $key => $value) {
        ?>
          <li><a href="<?php echo $value["link"] ?>"><?php echo ($key === 0) ? '<i class="fa fa-home"></i>' : ''; ?><span><?php echo $value["title"] ?></span></a></li>
        <?php
        }
      ?>
      </ul>
    </div>
    <div class="box padding">
      <div class="box-title">
        <h1>Từ khóa : <?php echo $data_page["keywork"]; ?></h1>
      </div>
      <div class="box-content">
        <div class="list-song search">
        <?php
          foreach ($data_page["listsong"] as $key => $value) {
          ?>
            <div class="song">
              <div class="song__title"><a href="<?php echo $value["permalink"] ?>"><?php echo $value["title"] ?> <span><?php echo (isset($value["cat"]["tac-gia"])) ? $value["cat"]["tac-gia"][0]["cat_name"] : "Chưa rõ tác giả" ?></span></a></div>
              <div class="song__desc"><?php echo $value["excerpt"] ?></div>
              <div class="song__info">
                <div class="song__date"><?php echo $value["date"] ?></div>
                <div class="song__chord"><?php echo $value["meta"]["hopamchinh"] ?></div>
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