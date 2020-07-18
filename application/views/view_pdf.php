<div class="main-content">
  <div class="wrapper">
    <div class="box padding">
      <div class="box-title">
        <h1><?php echo $page_meta["title"]; ?></h1><small><?php echo $page_meta["desc"]; ?></small>
      </div>
      <div class="box-content">
        <div class="list-song pdf">
        <?php
        foreach ($data_page["listsong"] as $key => $value) {
          $pdf = ($value["meta"]["pdffile"] != "") ? $value["meta"]["pdffile"] : base_url("tmp/default.pdf");
        ?>
          <div class="song">
            <div class="song__title"><a href="<?php echo $value["permalink"] ?>"><?php echo $value["title"] ?><span><?php echo (isset($value["cat"]["tac-gia"])) ? $value["cat"]["tac-gia"][0]["cat_name"] : "Chưa rõ tác giả" ?></span></a></div>
            <div class="song__desc"><?php echo $value["excerpt"] ?></div>
            <div class="song__downloadsheet"><a href="<?php echo $pdf ?>" download><img src="<?php echo base_url("tmp/images/pdf.svg") ?>" alt=""></a></div>
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
</div>