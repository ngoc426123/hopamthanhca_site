<div class="main-content">
  <div class="wrapper">
    <?php breadcrumb($breadcrumb) ?>
    <div class="box padding">
      <div class="box-title">
        <h1>Danh sách bài hát</h1><small>Bài hát được tổng hợp toàn bộ ở đây để người dùng dễ dàng tìm kiếm hoặc muốn xem được toàn bộ bài hát của trang web</small>
      </div>
      <div class="box-content">
        <div class="list-song">
          <div class="grid" id="render-more">
          <?php
          foreach ($data_page["listsong"] as $key => $value) {
          ?>
            <div class="col">
              <div class="item">
                <div class="item__top">
                  <div class="item__att"><span class="fa-eye"><?php echo $value["meta"]["luotxem"] ?></span></div>
                  <div class="item__att"><span class="fa-heart"><?php echo $value["meta"]["lovesong"] ?></span></div>
                </div>
                <div class="item__info">
                  <div class="item__title"><a href="<?php echo $value["permalink"] ?>"><?php echo $value["title"] ?></a></div>
                  <div class="item__desc"><?php echo $value["excerpt"] ?></div>
                </div>
                <div class="item__attribute">
                  <div class="item__attitem"><span>Tác giả</span><span><?php echo $value["cat"]["tac-gia"][0]["cat_name"] ?></span></div>
                  <div class="item__attitem"><span>Chuyên mục</span><span><?php echo $value["cat"]["chuyen-muc"][0]["cat_name"] ?></span></div>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
          </div>
        </div>
        <div class="load-more-song"><a href="" data-url="<?php echo base_url("api/loadmore"); ?>" data-offset="16" data-limit="16"><span>load thêm</span></a></div>
      </div>
    </div>
  </div>
</div>