<div class="comp-song-item <?= esc($pdf ? '--pdf' : '') ?>">
	<div class="comp-song-item__title">
		<h3 class="comp-song-item__title-text"><?= esc($title) ?></h3>
		<span class="comp-song-item__author"><?= esc($author) ?></span>
	</div>
	<div class="comp-song-item__desc"><?= esc($excerpt) ?></div>
	<?php if ($pdf) { ?>
		<div class="comp-song-item__downloadsheet">
			<a href="<?= esc($pdf) ?>" title="Ca vang tình yêu Chúa 4">
				<img src="<?= base_url('images/pdf.svg') ?>" alt="Download Sheet - Hơp Âm Thánh Ca - hopamthanhca.com">
			</a>
		</div>
	<?php } ?>
	<?php if ($date && $chords) { ?>
		<div class="comp-song-item__info">
			<div class="comp-song-item__date"><?= esc($dateFormat) ?></div>
			<div class="comp-song-item__chord"><?= esc($chords) ?></div>
		</div>
	<?php } ?>
	<a class="comp-song-item__link" href="<?= esc($permalink) ?>"></a>
</div>