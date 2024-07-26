<div class="comp-song-item">
	<div class="comp-song-item__title">
		<h3 class="comp-song-item__title-text"><?= esc($title) ?></h3>
		<span class="comp-song-item__author"><?= esc($author) ?></span>
	</div>
	<div class="comp-song-item__desc"><?= esc($excerpt) ?></div>
	<?php if ($date && $chords) { ?>
		<div class="comp-song-item__info">
			<div class="comp-song-item__date"><?= esc($date) ?></div>
			<div class="comp-song-item__chord"><?= esc($chords) ?></div>
		</div>
	<?php } ?>
	<a class="comp-song-item__link" href="<?= esc($permalink) ?>"></a>
</div>