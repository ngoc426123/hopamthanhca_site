<div class="comp-breadcrumb">
	<ul> 
		<?php foreach($data as $key => $value) { ?>
			<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="<?php echo $value["link"] ?>">
					<?php echo ($key === 0) ? '<i class="fa fa-home"></i>' : ''; ?>
					<span itemprop="name"><?php echo $value["title"] ?></span>
				</a>
				<meta itemprop="position" content="1">
			</li>
		<?php } ?>
	</ul>
</div>