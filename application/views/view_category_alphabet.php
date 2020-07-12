<div class="main-content">
  <div class="wrapper">
    <div class="box padding">
      <div class="box-title">
        <h1><?php echo $data_page["page_title"]; ?></h1><small><?php echo $data_page["page_desc"]; ?></small>
      </div>
      <div class="box-content">
        <div class="category-list-alphabet">
          <ul>
          <?php
          foreach ($data_page["listcat"] as $key => $value) {
          ?>
            <li><a href="<?php echo $value["permalink"] ?>"><span><?php echo $value["cat_name"] ?></span></a></li>
          <?php
          }
          ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>