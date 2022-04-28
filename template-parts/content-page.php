<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frondendie
 */

?>

<div class="page__content <?php post_class(); ?>">
	<div class="container_center">
		<?php the_title( '<h1 class="page__title">', '</h1>' ); ?>
		<div class="page__body">
			<?php
			the_content();
			?>
		</div>
	</div>
</div>
