<div class="main-content">
  <div class="wrapper">
    <div class="row justify-content-center">
      <div class="col-lg-6"> 
        <div class="box padding"> 
          <div class="box-title"> 
            <h3>Bài hát mới nhất</h3>
          </div>
          <div class="box-content">
            <div class="list-song">
            <?php
            foreach ($data_page["newsong"] as $key => $value) {
            ?>
              <div class="song">
                <div class="song__title">
                  <a href="<?php echo $value["permalink"] ?>" title="<?php echo $value["cat"]["tac-gia"][0]["cat_name"] ?>">
                    <?php echo $value["title"] ?>
                    <span><?php echo $value["cat"]["tac-gia"][0]["cat_name"] ?></span>
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
        <div class="box padding"> 
          <div class="box-title"> 
            <h3>Bài hát xem nhiều nhất</h3>
          </div>
          <div class="box-content">
            <div class="list-song">
            <?php
            foreach ($data_page["mostview"] as $key => $value) {
            ?>
              <div class="song">
                <div class="song__title">
                  <a href="<?php echo $value["permalink"] ?>" title="<?php echo $value["cat"]["tac-gia"][0]["cat_name"] ?>">
                    <?php echo $value["title"] ?>
                    <span><?php echo $value["cat"]["tac-gia"][0]["cat_name"] ?></span>
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
    <div class="row">
      <div class="col-12">
        <div class="box-title">
          <h3>Các tác giả</h3>
        </div>
        <div class="box">
          <div class="list-category">
            <ul>
            <?php 
            foreach ($data_page["tacgia"] as $key => $value) {
            ?>
              <li>
                <a href="<?php echo $value["permalink"] ?>" title="<?php echo $value["cat_name"] ?>">
                  <span><?php echo $value["cat_name"] ?></span>
                </a>
              </li>
            <?php
            }
            ?>
              <li><a href="<?php echo base_url("tac-gia"); ?>">Xem nhiều hơn...</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="box-title">
          <h3>Danh mục phụng vụ</h3>
        </div>
        <div class="box">
          <div class="list-category">
            <ul>
            <?php 
            foreach ($data_page["chuyenmuc"] as $key => $value) {
            ?>
              <li>
                <a href="<?php echo $value["permalink"] ?>" title="<?php echo $value["cat_name"] ?>">
                  <span><?php echo $value["cat_name"] ?></span>
                </a>
              </li>
            <?php
            }
            ?>
              <li><a href="<?php echo base_url("chuyen-muc"); ?>">Xem nhiều hơn...</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="box-title">
          <h3>Xem nhiều trong tuần</h3>
        </div>
        <div class="box padding">
          <div class="box-content">
            <div class="list-most-song">
              <ul>
              <?php 
              foreach ($data_page["mostweek"] as $key => $value) {
                $index = $key + 1;
              ?>
                <li>
                  <div class="num"><?php echo $index ?>.</div>
                  <div class="tend">
                    <h3>
                      <a href="<?php echo $value["permalink"] ?>" title="<?php echo $value["title"] ?>">
                        <?php echo $value["title"] ?>
                      </a>
                    </h3>
                  </div>
                  <div class="df">
                    <div class="att"><span class="fa-eye"><?php echo $value["meta"]["luotxem"] ?></span></div>
                    <div class="att"><span class="fa-heart"><?php echo $value["meta"]["lovesong"] ?></span></div>
                  </div>
                </li>
              <?php
              }
              ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <div class="box-title">
          <h3>Xem nhiều trong tháng</h3>
        </div>
        <div class="box padding">
          <div class="box-content">
            <div class="list-most-song">
              <ul>
              <?php 
              foreach ($data_page["mostmonth"] as $key => $value) {
                $index = $key + 1;
              ?>
                <li>
                  <div class="num"><?php echo $index ?>.</div>
                  <div class="tend">
                    <h3>
                      <a href="<?php echo $value["permalink"] ?>" title="<?php echo $value["title"] ?>">
                        <?php echo $value["title"] ?>
                      </a>
                    </h3>
                  </div>
                  <div class="df">
                    <div class="att"><span class="fa-eye"><?php echo $value["meta"]["luotxem"] ?></span></div>
                    <div class="att"><span class="fa-heart"><?php echo $value["meta"]["lovesong"] ?></span></div>
                  </div>
                </li>
              <?php
              }
              ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-12 col-lg-4">
        <div class="box-title">
          <h3>Yêu thích nhất trang</h3>
        </div>
        <div class="box padding">
          <div class="box-content">
            <div class="list-most-song">
              <ul>
              <?php 
              foreach ($data_page["mostlove"] as $key => $value) {
                $index = $key + 1;
              ?>
                <li>
                  <div class="num"><?php echo $index ?>.</div>
                  <div class="tend">
                    <h3>
                      <a href="<?php echo $value["permalink"] ?>" title="<?php echo $value["title"] ?>">
                        <?php echo $value["title"] ?>
                      </a>
                    </h3>
                  </div>
                  <div class="df">
                    <div class="att"><span class="fa-eye"><?php echo $value["meta"]["luotxem"] ?></span></div>
                    <div class="att"><span class="fa-heart"><?php echo $value["meta"]["lovesong"] ?></span></div>
                  </div>
                </li>
              <?php
              }
              ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
    <?php
    foreach ($data_page["nextsong"] as $key => $value) {
    ?>
      <div class="col-12 col-lg-6">
        <div class="box padding">
          <div class="box-content">
            <div class="songhome">
              <div class="songhome__wrap">
                <div class="songhome__title">
                  <h3><a href="<?php echo $value["permalink"] ?>" title="<?php echo $value["title"] ?>"><?php echo $value["title"] ?> <span><?php echo $value["cat"]["tac-gia"][0]["cat_name"] ?></span></a></h3>
                </div>
                <div class="songhome__info"><?php echo $value["date"] ?></div>
                <div class="songhome__df">
                  <div class="songhome__att"><span class="fa-eye"><?php echo $value["meta"]["luotxem"] ?></span></div>
                  <div class="songhome__att"><span class="fa-heart"><?php echo $value["meta"]["lovesong"] ?></span></div>
                </div>
              </div>
              <div class="songhome__content"><?php echo convent_song($value["content"]); ?></div>
              <div class="songhome__link"><a href="<?php echo $value["permalink"] ?>">Xem chi tiết</a></div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
    </div>
  </div>
</div>