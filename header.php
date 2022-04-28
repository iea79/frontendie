<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package frondendie
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<!-- <div class="viewport"> -->
	<header id="masthead" class="header">
		<div class="header__content">
			<div class="menu__toggle"></div>
			<div class="header__logo">
				<a href="/" class="logo">Evgeniy Ivanov</a>
			</div><!-- .site-branding -->
			<div class="header__nav">
				<nav id="site-navigation" class="nav">
					<?php
					wp_nav_menu(
						array(
							'menu' => 'menu-1',
							'container'       => '',
							'menu_class'      => 'menu',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>

			<div class="header__contact">
				<div class="soc">
					<div class="soc__label">Связаться со мной:</div>
					<div class="soc__list">
						<a href="#" class="icon_vk"></a>
						<a href="#" class="icon_tg"></a>
					</div>
				</div>
			</div>

		</div>
	</header><!-- #masthead -->
	<!-- <div class="viewport"> -->
