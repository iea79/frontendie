<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frondendie
 */

get_header();
?>

	<main id="primary" class="main">
		<!-- begin homeScreen -->
		<section id="homeScreen" class="homeScreen section">
			<div class="homeScreen__bg">
				<?php echo wp_get_attachment_image(SCF::get( 'first__bg', 14 ),'full') ?>
			</div>
			<div class="homeScreen__content">
				<div class="container_center">
					<div class="homeScreen__title">
						<?php the_archive_title( '<h1>', '</h1>' ); ?>
					</div>
					<div class="homeScreen__sub">
						<p>На странице собраны работы за последние 4 года из тех, что могу размещать в портфолио</p>
						<p>Подавляюшая часть проектов сделаны мной, в нескольких участвовали мои студенты</p>
					</div>
				</div>
			</div>
		</section>
		<!-- end homeScreen -->

		<?php setWorks() ?>
	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
