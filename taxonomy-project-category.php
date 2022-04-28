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
                    <?php the_archive_description( '<div class="homeScreen__sub">', '</div>' ); ?>
                </div>
            </div>
        </section>
        <!-- end homeScreen -->

		<?php
            $post_slug = get_queried_object()->slug;
            setWorks(100, $post_slug);
        ?>
	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
