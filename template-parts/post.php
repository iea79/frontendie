<?php
$thumbnail = get_the_post_thumbnail(get_the_ID(), 'full');
?>
<div class="posts__item">
	<?php if ($thumbnail): ?>
		<div class="posts__thumbs">
			<?php echo $thumbnail ?>
		</div>
	<?php endif; ?>
	<div class="posts__title"><?php the_title() ?></div>
	<div class="posts__excerpt"><?php the_excerpt() ?></div>
	<div class="posts__link"><a href="<?php the_permalink() ?>">Читать дальше</a></div>
</div>