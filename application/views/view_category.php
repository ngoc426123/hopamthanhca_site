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
        <h1><?php echo $data_page["page_title"]; ?></h1><small><?php echo $data_page["page_desc"]; ?></small>
      </div>
      <div class="box-content">
        <div class="category-list-cat">
          <ul>
          <?php
          foreach ($data_page["listcat"] as $key => $value) {
          ?>
            <li>
              <div class="item">
                <div class="item__sp"><?php echo $value["type_name"] ?></div>
                <div class="item__title"><?php echo $value["cat_name"] ?></div>
                <div class="item__count"><?php echo $value["count"] ?> bài</div><a class="item__link" href="<?php echo $value["permalink"] ?>"></a>
              </div>
            </li>
          <?php
          }
          ?>
          </ul>
        </div>
        <?php 
        if ( $data_page["pagination"] != "" ) {
        ?>
        <div class="pagination">
          <ul>
            <?php
            foreach ($data_page["pagination"] as $value) {
              if ( $value["type"] == "node" ) {
            ?>
              <li class="<?php echo ($value['active']===1)?'active':'' ?>"><a class="page-link" href="<?php echo $value['link'] ?>"><?php echo $value['number'] ?></a></li>
            <?php
              } else {
            ?>
              <li>...</li>
            <?php
              }
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
</div>