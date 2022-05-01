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
      <div class="chord">
        <div class="chord__text">Vòng tròn hợp âm</div>
        <div class="chord__circle"><img src="<?php echo base_url("tmp/images/cf.svg"); ?>" alt=""></div>
        <div class="chord__list">
          <ul>
            <li class="active"><a data-chord="C">C</a></li>
            <li><a data-chord="C#">C#</a></li>
            <li><a data-chord="D">D</a></li>
            <li><a data-chord="Eb">Eb</a></li>
            <li><a data-chord="E">E</a></li>
            <li><a data-chord="F">F</a></li>
            <li><a data-chord="F#">F#</a></li>
            <li><a data-chord="G">G</a></li>
            <li><a data-chord="G#">G#</a></li>
            <li><a data-chord="A">A</a></li>
            <li><a data-chord="Bb">Bb</a></li>
            <li><a data-chord="B">B</a></li>
          </ul>
        </div>
        <div class="chord__result"></div>
      </div>
    </div>
  </div>
</div>