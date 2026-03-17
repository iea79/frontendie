<?php
/**
 * Customization for WordPress login page (wp-login.php) and frontend access control.
 *
 * @package frondendie
 */

/**
 * Redirect non-logged-in users to login page on frontend.
 */
function frondendie_protect_frontend_for_guests()
{
	if (is_user_logged_in()) {
		return;
	}

	if (is_admin() || wp_doing_ajax()) {
		return;
	}

	// Allow login, registration, password reset and REST/GraphQL endpoints.
	$request_uri = $_SERVER['REQUEST_URI'] ?? '';
	if (
		str_contains($request_uri, 'wp-login.php') ||
		str_contains($request_uri, 'wp-register.php') ||
		str_contains($request_uri, 'wp-signup.php') ||
		str_contains($request_uri, 'wp-json') ||
		str_contains($request_uri, 'graphql')
	) {
		return;
	}

	// Redirect all other frontend requests to login page.
	wp_redirect(wp_login_url());
	exit;
}
add_action('template_redirect', 'frondendie_protect_frontend_for_guests');

/**
 * Custom styles for WordPress login page.
 */
function frondendie_custom_login_styles()
{
	// Colors taken from scss variables: $color_primary, $color_withe, $btn_default_bg_color.
	$background_color = '#1D1D1B'; // $color_primary
	$text_color = '#ffffff';       // $color_withe
	$button_bg = '#FF3E00';        // $btn_default_bg_color

	// Use custom_logo from Customizer if set.
	$logo_url = '';
	$custom_logo_id = get_theme_mod('custom_logo');
	if ($custom_logo_id) {
		$image = wp_get_attachment_image_src($custom_logo_id, 'full');
		if (!empty($image[0])) {
			$logo_url = $image[0];
		}
	}

	// Fallback: theme logo file.
	if (!$logo_url) {
		$logo_url = get_template_directory_uri() . '/img/logo.svg';
	}
?>
	<style type="text/css">
		body.login {
			background-color: <?php echo esc_html($background_color); ?> !important;
			color: <?php echo esc_html($text_color); ?>;
		}

		body.login #loginform,
		body.login #lostpasswordform {
			background: rgba(255, 255, 255, 0.2);
			backdrop-filter: blur(12px);
			border-radius: 12px;
			border: 1px solid rgba(255, 255, 255, 0.1);
			box-shadow: 0 24px 60px rgba(0, 0, 0, 0.1);
		}

		body.login #loginform label,
		body.login #lostpasswordform label,
		body.login #nav a,
		body.login #backtoblog a {
			color: <?php echo esc_html($text_color); ?>;
		}

		body.login a {
			color: <?php echo esc_html($text_color); ?> !important;
		}

		body.login .button-primary {
			background-color: <?php echo esc_html($button_bg); ?>;
			border-color: <?php echo esc_html($button_bg); ?>;
			box-shadow: none;
			text-shadow: none;
		}

		body.login .button-primary:hover,
		body.login .button-primary:focus {
			filter: brightness(1.1);
		}

		body.login #login h1 a {
			background-image: url('<?php echo esc_url($logo_url); ?>') !important;
			background-size: contain !important;
			background-repeat: no-repeat !important;
			background-position: center !important;
			width: 200px !important;
			height: 80px !important;
		}
	</style>
<?php
}
add_action('login_head', 'frondendie_custom_login_styles');

/**
 * Make login logo link to site home.
 */
function frondendie_login_logo_url()
{
	return home_url('/');
}
add_filter('login_headerurl', 'frondendie_login_logo_url');

/**
 * Change login logo title (accessible link text).
 */
function frondendie_login_logo_title()
{
	return get_bloginfo('name');
}
add_filter('login_headertext', 'frondendie_login_logo_title');
