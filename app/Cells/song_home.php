<div class="comp-box --padding --small-spacing">
	<div class="comp-box__content">
		<div class="comp-song-home">
			<div class="comp-song-home__wrap">
				<div class="comp-song-home__title">
					<h3><a href="<?= esc($permalink) ?>"><?= esc($title) ?> <span><?= esc($author) ?></span></a>
					</h3>
				</div>
				<div class="comp-song-home__info"><?= esc($dateFormat) ?></div>
				<div class="comp-song-home__attrs">
					<div class="comp-song-home__attr-item"><span class="fa-eye"><?= esc($viewer) ?></span></div>
					<div class="comp-song-home__attr-item"><span class="fa-heart"><?= esc($lover) ?></span></div>
				</div>
			</div>
			<div class="comp-song-home__content">
				<?= html_entity_decode($content) ?>
			</div>
			<div class="comp-song-home__link"><a href="<?= esc($permalink) ?>">Xem chi tiết</a>
			</div>
		</div>
	</div>
</div>
