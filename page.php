<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frondendie
 */

get_header();
?>

		<!-- page -->
		<main id="primary" class="main">
			<?php
			if (is_front_page()) {
				get_template_part( 'template-parts/content', 'home' );
			} else {
			?>
			<div class="container_center">
				<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
				?>
			</div>
			<?php
			}
			?>
		</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
