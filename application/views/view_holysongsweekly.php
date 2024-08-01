<div class="main-content">
  <div class="wrapper">
    <?php breadcrumb($breadcrumb) ?>
    <div class="box padding">
      <div class="box-title">
        <h1>Thánh ca hàng tuần</h1>
        <small>Soạn bài hát thánh lễ các mùa phụng vụ, các lễ riêng, lễ đặc biệt.</small>
      </div>
      <div class="box-content">
        <div class="holy-songs-weekly">
          <div class="row">
            <div class="col-12">
              <div class="holy-songs-weekly__group">
                <div class="holy-songs-weekly__title">LỄ RIÊNG - ĐẶC BIỆT</div>
                <div class="holy-songs-weekly__list --vertical">
                  <ul>
                  <?php
                  foreach($data["le-rieng-dac-biet"] as $item) {
                  ?>
                    <li><a href="<?php echo base_url("thanh-ca-hang-tuan/{$item["slug"]}") ?>"><?php echo $item["name"] ?></a></li>
                  <?php
                  }
                  ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="holy-songs-weekly__group">
                <div class="holy-songs-weekly__title">NĂM A</div>
                <div class="holy-songs-weekly__list">
                  <ul>
                  <?php
                  foreach($data["nam-phung-vu-a"] as $item) {
                  ?>
                    <li><a href="<?php echo base_url("thanh-ca-hang-tuan/{$item["slug"]}") ?>"><?php echo $item["name"] ?></a></li>
                  <?php
                  }
                  ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="holy-songs-weekly__group">
                <div class="holy-songs-weekly__title">NĂM B</div>
                <div class="holy-songs-weekly__list">
                  <ul>
                  <?php
                  foreach($data["nam-phung-vu-b"] as $item) {
                  ?>
                    <li><a href="<?php echo base_url("thanh-ca-hang-tuan/{$item["slug"]}") ?>"><?php echo $item["name"] ?></a></li>
                  <?php
                  }
                  ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="holy-songs-weekly__group">
                <div class="holy-songs-weekly__title">NĂM C</div>
                <div class="holy-songs-weekly__list">
                  <ul>
                  <?php
                  foreach($data["nam-phung-vu-c"] as $item) {
                  ?>
                    <li><a href="<?php echo base_url("thanh-ca-hang-tuan/{$item["slug"]}") ?>"><?php echo $item["name"] ?></a></li>
                  <?php
                  }
                  ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>