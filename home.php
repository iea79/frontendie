<?php
get_header();
$page_for_posts = get_option('page_for_posts');
$blog_title = get_the_title($page_for_posts);
$blog_content = get_the_content(null, null, $page_for_posts);
?>
<main class="main">
	<section id="homeScreen" class="homeScreen section">
		<div class="homeScreen__bg">
			<?php echo wp_get_attachment_image(SCF::get('first__bg', 14), 'full') ?>
		</div>
		<div class="homeScreen__content">
			<div class="container_center">
				<div class="homeScreen__title">
					<h1><?php echo $blog_title ?></h1>
				</div>
				<?php if ($blog_content): ?>
					<div class="homeScreen__sub">
						<?php echo $blog_content ?>
					</div>
				<?php endif; ?>
				<?php the_archive_description('<div class="homeScreen__sub">', '</div>'); ?>
			</div>
		</div>
	</section>
	<!-- begin posts -->
	<div class="posts">
		<div class="container_center">
			<div class="posts__list">
				<?php
				while (have_posts()) :
					the_post();
					get_template_part('template-parts/post');
				endwhile;
				?>
			</div>
		</div>
	</div>
	<!-- end posts -->
</main>
<?php
get_footer();
?>