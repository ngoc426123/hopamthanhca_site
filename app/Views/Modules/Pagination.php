<?php
$pager->setSurroundCount(2);
?>
<div class="comp-pagination">
  <ul>
    <?php if ($pager->hasPrevious()) { ?>
      <?php $uri = preg_replace('/\/index.php/', '', $pager->getFirst()); ?>
      <li>
        <a href="<?= esc($uri) ?>">
          <i class="fa fa-angle-double-left"></i>
        </a>
      </li>
    <?php } ?>
    <?php if ($pager->hasPreviousPage()) { ?>
      <?php $uri = preg_replace('/\/index.php/', '', $pager->getPrevious()); ?>
      <li>
        <a href="<?= esc($uri) ?>">
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
      <?php $uri = preg_replace('/\/index.php/', '', $pager->getNext()); ?>
      <li class="">
        <a href="<?= esc($uri) ?>">
          <i class="fa fa-angle-right"></i>
        </a>
      </li>
    <?php } ?>
    <?php if ($pager->hasNext()) { ?>
      <?php $uri = preg_replace('/\/index.php/', '', $pager->getLast()); ?>
      <li>
        <a href="<?= esc($uri) ?>">
          <i class="fa fa-angle-double-right"></i>
        </a>
      </li>
    <?php } ?>
  </ul>
</div>