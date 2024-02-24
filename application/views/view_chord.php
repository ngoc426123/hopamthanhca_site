<div class="main-content">
  <div class="wrapper">
    <?php breadcrumb($breadcrumb) ?>
    <div class="box padding">
      <div class="chord">
        <div class="chord__text">Vòng tròn hợp âm</div>
        <div class="chord__circle"><img src="<?php echo base_url("tmp/images/cf.svg"); ?>" alt=""></div>
        <div class="chord__list">
        <select class="list-chord" name="chord">
          <option value="C" selected>C</option>
          <option value="C#">C#</option>
          <option value="D">D</option>
          <option value="Eb">Eb</option>
          <option value="E">E</option>
          <option value="F">F</option>
          <option value="F#">F#</option>
          <option value="G">G</option>
          <option value="G#">G#</option>
          <option value="A">A</option>
          <option value="Bb">Bb</option>
          <option value="B">B</option>
        </select>
        <select class="list-tail" name="tail">
          <option value="" selected>major</option>
          <option value="m">minor</option>
          <option value="6">6</option>
          <option value="m6">m6</option>
          <option value="69">69</option>
          <option value="7">7</option>
          <option value="m7">m7</option>
          <option value="maj7">maj7</option>
          <option value="7#5">7#5</option>
          <option value="m7b5">m7b5</option>
          <option value="7b9">7b9</option>
          <option value="7sus4">7sus4</option>
          <option value="9">9</option>
          <option value="m9">m9</option>
          <option value="maj9">maj9</option>
          <option value="add9">add9</option>
          <option value="13">13</option>
          <option value="sus2">sus2</option>
          <option value="sus4">sus4</option>
          <option value="dim">dim</option>
          <option value="dim7">dim7</option>
          <option value="aug">aug</option>
        </select>
        </div>
        <div class="chord__result"></div>
      </div>
    </div>
  </div>
</div>