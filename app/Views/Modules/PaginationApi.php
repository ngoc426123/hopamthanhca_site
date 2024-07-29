<?php
$pager->setSurroundCount(2);
?>
<div class="comp-pagination" data-filter-pagination>
  <ul>
    <?php if ($pager->hasPrevious()) { ?>
      <li>
        <a href="#" data-first data-page-number="1">
          <i class="fa fa-angle-double-left"></i>
        </a>
      </li>
    <?php } ?>
    <?php if ($pager->hasPreviousPage()) { ?>
      <li>
        <a href="#" data-previous data-page-number="<?= esc($pager->getPreviousPageNumber()) ?>">
          <i class="fa fa-angle-left"></i>
        </a>
      </li>
    <?php } ?>
    <?php foreach ($pager->links() as $key => $value) { ?>
      <li class="<?= $value['active'] == 1 ? 'active' : '' ?>">
        <a href="#" data-page-number="<?= esc($value['title']) ?>">
          <span><?= esc($value['title']) ?></span>
        </a>
      </li>
    <?php } ?>
    <?php if ($pager->hasNextPage()) { ?>
      <li class="">
        <a href="#" data-next data-page-number="<?= esc($pager->getNextPageNumber()) ?>">
          <i class="fa fa-angle-right"></i>
        </a>
      </li>
    <?php } ?>
    <?php if ($pager->hasNext()) { ?>
      <li>
        <a href="#" data-last data-page-number="<?= esc($pager->getPageCount()) ?>">
          <i class="fa fa-angle-double-right"></i>
        </a>
      </li>
    <?php } ?>
  </ul>
</div>