<div class="main-content">
  <div class="wrapper">
    <div class="row">
      <div class="col-12 col-lg-8">
        <div class="box padding">
          <div class="box-title">
            <h1><?php echo $data_page["page_title"]; ?></h1><small><?php echo $data_page["page_desc"]; ?></small>
          </div>
          <div class="box-content">
            <div class="list-song">
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
            <?php 
            if ( $data_page["pagination"] != "" ) {
            ?>
            <div class="pagination">
              <ul>
                <?php
                foreach ($data_page["pagination"] as $value) {
                ?>
                  <li class="<?php echo ($value['active']===1)?'active':'' ?>"><a class="page-link" href="<?php echo $value['link'] ?>"><?php echo $value['number'] ?></a></li>
                <?php
                }
                ?>
              </ul>
            </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4">
        <div class="box padding">
          <div class="list-category sidebar">
            <ul>
            <?php
            foreach ($data_page["listcat"] as $key => $value) {
            ?>
              <li><a href="<?php echo $value["permalink"] ?>"><span><?php echo $value["cat_name"] ?> (<?php echo $value["count"] ?>)</span></a></li>
            <?php
            }
            ?>
            </ul>
          </div>
        </div>
        <div class="box padding">
          <div class="box-content">
            <div class="songhome">
              <div class="songhome__wrap">
                <div class="songhome__title">
                  <h3><a href="<?php echo $data_page["songrandom"]["permalink"] ?>"><?php echo $data_page["songrandom"]["title"] ?> <span><?php echo (isset($data_page["songrandom"]["cat"]["tac-gia"])) ? $data_page["songrandom"]["cat"]["tac-gia"][0]["cat_name"] : "Chưa rõ tác giả" ?></span></a></h3>
                </div>
                <div class="songhome__info"><?php echo $data_page["songrandom"]["date"] ?></div>
                <div class="songhome__df">
                  <div class="songhome__att"><span class="fa-eye"><?php echo $data_page["songrandom"]["meta"]["luotxem"] ?></span></div>
                  <div class="songhome__att"><span class="fa-heart"><?php echo $data_page["songrandom"]["meta"]["lovesong"] ?></span></div>
                </div>
              </div>
              <div class="songhome__content"><?php echo convent_song($data_page["songrandom"]["content"]); ?></div>
              <div class="songhome__link"><a href="<?php echo $data_page["songrandom"]["permalink"] ?>">Xem chi tiết</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>