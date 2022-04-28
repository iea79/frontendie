<?php
/**
 * frondendie functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package frondendie
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.1.0' );
}

if ( ! function_exists( 'frondendie_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function frondendie_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on frondendie, use a find and replace
		 * to change 'frondendie' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'frondendie', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'frondendie' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'frondendie_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support('woocommerce');

	}
endif;
add_action( 'after_setup_theme', 'frondendie_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function frondendie_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'frondendie_content_width', 640 );
}
add_action( 'after_setup_theme', 'frondendie_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function frondendie_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'frondendie' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'frondendie' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'frondendie_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function frondendie_scripts() {
	// wp_enqueue_style( 'locomotive-style', get_template_directory_uri() . '/css/locomotive-scroll.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'frondendie-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'frondendie-style', 'rtl', 'replace' );

	wp_deregister_script( 'jquery' );
	wp_deregister_script( 'wp-embed-js' );
	// wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'jquery' );

	// wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), _S_VERSION, true );
	// wp_enqueue_script( 'modal', get_template_directory_uri() . '/js/modal.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js', '', _S_VERSION, true );
	wp_enqueue_script( 'gsap-st', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/ScrollTrigger.min.js', '', _S_VERSION, true );
	// wp_enqueue_script( 'locomotive-sript', get_template_directory_uri() . '/js/locomotive-scroll.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'smooth-scrollbar', get_template_directory_uri() . '/js/smooth-scrollbar.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'site-js', get_template_directory_uri() . '/js/function.js', array('gsap', 'gsap-st', 'smooth-scrollbar'), _S_VERSION, true );


	if (is_front_page()) {
		wp_deregister_style( 'wp-block-library' );
		wp_enqueue_script( 'p5', 'https://cdn.jsdelivr.net/npm/p5@1.4.1/lib/p5.js', '', '', true );
		wp_enqueue_script( 'home', get_template_directory_uri() . '/js/home.js', '', _S_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'frondendie_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Home page.
 */
require get_template_directory() . '/scf/home.php';

/**
 * Project page.
 */
require get_template_directory() . '/scf/project.php';

/**
* Projects archive.
* setWorks($per_page = -1, $slug = '')
*/
require get_template_directory() . '/inc/categories-page.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

## Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
add_filter( 'get_the_archive_title', function( $title ){
	return preg_replace('~^[^:]+: ~', '', $title );
});

add_filter('excerpt_more', function($more) {
	return '...';
});

// регистрирующая новые таксономии (create_projects_taxonomies)
add_action( 'init', 'create_projects_taxonomies' );

// функция, создающая новые таксономии постов типа "projects"
function create_projects_taxonomies(){

	// Добавляем НЕ древовидную таксономию 'project-category' (как метки)
	register_taxonomy('project-category', 'projects', array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'                        => _x( 'Категории проектов', 'taxonomy general name' ),
			'singular_name'               => _x( 'Категория проекта', 'taxonomy singular name' ),
			'search_items'                =>  __( 'Поиск категорий' ),
			'popular_items'               => __( 'Популярные категории' ),
			'all_items'                   => __( 'Все категории проектов' ),
			'parent_item'                 => null,
			'parent_item_colon'           => null,
			'edit_item'                   => __( 'Редактировать категорию' ),
			'update_item'                 => __( 'Обновить категорию' ),
			'add_new_item'                => __( 'Добавить категорию' ),
			'new_item_name'               => __( 'Название новой категории' ),
			'separate_items_with_commas'  => __( 'Разделитель категорий проектов' ),
			'add_or_remove_items'         => __( 'Добавить или удалить категорию' ),
			'choose_from_most_used'       => __( 'Выбрать самые используемые категории' ),
			'menu_name'                   => __( 'Категории проектов' ),
		),
		'show_ui'       => true,
		'show_admin_column'     => true,
		'query_var'     => true,
		'meta_box_cb'     => 'post_categories_meta_box',
		'rewrite'            => array( 'slug'=>'projects', 'with_front' => false ),
	));
}

add_action( 'init', 'register_project_types' );

function register_project_types(){
	register_post_type( 'projects', [
		'label'  => null,
		'labels' => [
			'name'               => 'Проекты', // основное название для типа записи
			'singular_name'      => 'Проект', // название для одной записи этого типа
			'add_new'            => 'Добавить проект', // для добавления новой записи
			'add_new_item'       => 'Добавление проекта', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование проекта', // для редактирования типа записи
			'new_item'           => 'Новый проект', // текст новой записи
			'view_item'          => 'Смотреть проект', // для просмотра записи этого типа.
			'search_items'       => 'Искать проект', // для поиска по этим типам записи
			'not_found'          => 'Не найдено проектов', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено проектов в корзине', // если не было найдено в корзине
			// 'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Проекты', // название меню
		],
		// 'description'         => '',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => true, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => true, // добавить в REST API. C WP 4.7
		// 'rest_base'           => true, // $post_type. C WP 4.7
		// 'menu_position'       => null,
		'menu_icon'           => 'dashicons-welcome-view-site',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		// 'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => ['project-category'],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}

// Register response image and link from project in wp rest
register_rest_field( 'projects', 'props', array(
	'get_callback' => function ( $data ) {
		$object = new stdClass();
		// $image = get_post_meta( $data['id'], 'book_img', true );

		$object->image = get_the_post_thumbnail($data['id'], 'full');
		$object->link = get_post_meta( $data['id'], 'project__link', true );

		return $object;
	},
));

add_action( 'init', function () {
	SCF::add_options_page( 'Контакты', 'Контакты', 'manage_options', 'contacts', 'dashicons-location-alt', 31 );
} );
