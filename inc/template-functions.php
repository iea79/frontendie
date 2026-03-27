<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package frondendie
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function frondendie_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'frondendie_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function frondendie_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'frondendie_pingback_header' );

/**
 * WPGraphQL — подключение экспорта полей SCF в схему GraphQL.
 */
if ( function_exists( 'register_graphql_field' ) ) {
	require get_template_directory() . '/inc/wpgraphql-scf.php';
}

/**
 * Webhook для принудительного сброса кэша Next.js (revalidateTag wp-graphql).
 * Вызывается на ключевых изменениях контента/таксономий.
 */
function frondendie_trigger_next_revalidate() {
	$frontend_url = defined( 'FRONTENDIE_NEXT_URL' ) ? FRONTENDIE_NEXT_URL : '';
	$secret       = defined( 'FRONTENDIE_REVALIDATE_SECRET' ) ? FRONTENDIE_REVALIDATE_SECRET : '';

	if ( empty( $frontend_url ) || empty( $secret ) ) {
		return;
	}

	$endpoint = trailingslashit( $frontend_url ) . 'api/revalidate';

	wp_remote_post(
		add_query_arg(
			array(
				'secret' => rawurlencode( $secret ),
				'tag'    => 'wp-graphql',
			),
			$endpoint
		),
		array(
			'timeout'   => 3,
			'sslverify' => false,
		)
	);
}

add_action(
	'save_post',
	function( $post_id ) {
		if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
			return;
		}

		frondendie_trigger_next_revalidate();
	}
);

// Новые/измененные/удаленные термины (категории, таксономии проектов и т.д.).
add_action( 'created_term', 'frondendie_trigger_next_revalidate' );
add_action( 'edited_term', 'frondendie_trigger_next_revalidate' );
add_action( 'delete_term', 'frondendie_trigger_next_revalidate' );

// Удаление записей/страниц.
add_action( 'deleted_post', 'frondendie_trigger_next_revalidate' );
