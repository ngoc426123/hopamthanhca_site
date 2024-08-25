<?php
$pager->setSurroundCount(2);
?>
<div class="comp-pagination">
  <ul>
    <?php if ($pager->hasPrevious()) { ?>
      <li>
        <a href="<?= esc($pager->getFirst()) ?>">
          <i class="fa fa-angle-double-left"></i>
        </a>
      </li>
    <?php } ?>
    <?php if ($pager->hasPreviousPage()) { ?>
      <li>
        <a href="<?= esc($pager->getPrevious()) ?>">
          <i class="fa fa-angle-left"></i>
        </a>
      </li>
    <?php } ?>
    <?php foreach ($pager->links() as $key => $value) { ?>
      <?php $uri = preg_replace('/\/index.php/', '', $value['uri']); ?>
      <li class="<?= $value['active'] == 1 ? 'active' : '' ?>">
        <a href="<?= esc($uri) ?>">
          <span><?= esc($value['title']) ?></span>
        </a>
      </li>
    <?php } ?>
    <?php if ($pager->hasNextPage()) { ?>
      <li class="">
        <a href="<?= esc($pager->getNext()) ?>">
          <i class="fa fa-angle-right"></i>
        </a>
      </li>
    <?php } ?>
    <?php if ($pager->hasNext()) { ?>
      <li>
        <a href="<?= esc($pager->getLast()) ?>">
          <i class="fa fa-angle-double-right"></i>
        </a>
      </li>
    <?php } ?>
  </ul>
</div>