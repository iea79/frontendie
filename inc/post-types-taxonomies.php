<?php
/**
 * Custom post types and taxonomies.
 *
 * @package frondendie
 */

add_action('init', 'frondendie_register_projects_taxonomies');
add_action('init', 'frondendie_register_project_stacks');
add_action('init', 'frondendie_register_project_types');

/**
 * Taxonomies for post type "projects" (categories).
 */
function frondendie_register_projects_taxonomies()
{
	register_taxonomy('project-category', 'projects', array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'                        => _x('Категории проектов', 'taxonomy general name'),
			'singular_name'               => _x('Категория проекта', 'taxonomy singular name'),
			'search_items'                =>  __('Поиск категорий'),
			'popular_items'               => __('Популярные категории'),
			'all_items'                   => __('Все категории проектов'),
			'parent_item'                 => null,
			'parent_item_colon'           => null,
			'edit_item'                   => __('Редактировать категорию'),
			'update_item'                 => __('Обновить категорию'),
			'add_new_item'                => __('Добавить категорию'),
			'new_item_name'               => __('Название новой категории'),
			'separate_items_with_commas'  => __('Разделитель категорий проектов'),
			'add_or_remove_items'         => __('Добавить или удалить категорию'),
			'choose_from_most_used'       => __('Выбрать самые используемые категории'),
			'menu_name'                   => __('Категории проектов'),
		),
		'show_ui'       		=> true,
		'show_in_rest'	   		=> true,
		'show_admin_column'     => true,
		'show_in_quick_edit'    => true,
		'query_var'     		=> true,
		'meta_box_cb'     		=> 'post_categories_meta_box',
		'rewrite'            	=> array('slug' => 'projects', 'with_front' => false),
		'show_in_graphql'      => true,
		'graphql_single_name'  => 'ProjectCategory',
		'graphql_plural_name'  => 'ProjectCategories',
	));
}

/**
 * Taxonomies for post type "projects" (stack/technologies).
 */
function frondendie_register_project_stacks()
{
	register_taxonomy('project-staks', 'projects', array(
		'hierarchical'  => false,
		'labels'		=> array(
			'name'						=> _x('Стек технологий', 'taxonomy general name'),
			'singular_name'			   => _x('Технология', 'taxonomy singular name'),
			'search_items'				=>  __('Поиск технологий'),
			'popular_items'			   => __('Популярные технологии'),
			'all_items'				   => __('Все технологии проектов'),
			'parent_item'				 => null,
			'parent_item_colon'		 => null,
			'edit_item'				 => __('Редактировать технологию'),
			'update_item'				 => __('Обновить технологию'),
			'add_new_item'				 => __('Добавить новую технологию'),
			'new_item_name'			 => __('Название новой технологии'),
			'separate_items_with_commas' => __('Разделить технологии запятыми'),
			'add_or_remove_items'		 => __('Добавить или удалить технологию'),
			'choose_from_most_used'	   => __('Выбрать самые используемые технологии'),
		),
		'show_ui'       		=> true,
		'show_in_rest'	   		=> true,
		'show_admin_column'     => true,
		'show_in_quick_edit'    => true,
		'query_var'     		=> true,
		'meta_box_cb'     		=> 'post_tags_meta_box',
		'show_in_graphql'      => true,
		'graphql_single_name'  => 'ProjectStack',
		'graphql_plural_name'  => 'ProjectStacks',
	));
}

/**
 * Custom post type "projects".
 */
function frondendie_register_project_types()
{
	register_post_type('projects', [
		'label'  => null,
		'labels' => [
			'name'               => 'Проекты',
			'singular_name'      => 'Проект',
			'add_new'            => 'Добавить проект',
			'add_new_item'       => 'Добавление проекта',
			'edit_item'          => 'Редактирование проекта',
			'new_item'           => 'Новый проект',
			'view_item'          => 'Смотреть проект',
			'search_items'       => 'Искать проект',
			'not_found'          => 'Не найдено проектов',
			'not_found_in_trash' => 'Не найдено проектов в корзине',
			'menu_name'          => 'Проекты',
		],
		'public'              => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'menu_icon'           => 'dashicons-welcome-view-site',
		'supports'            => ['title', 'editor', 'thumbnail'],
		'taxonomies'          => ['project-category', 'project-staks'],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
		'show_in_graphql'      => true,
		'graphql_single_name'  => 'Project',
		'graphql_plural_name'  => 'Projects',
	]);
}

/**
 * REST API: image and link for projects.
 */
add_action('rest_api_init', function () {
	register_rest_field('projects', 'props', array(
		'get_callback' => function ($data) {
			$object = new stdClass();
			$object->image = get_the_post_thumbnail($data['id'], 'full');
			$object->link = get_post_meta($data['id'], 'project__link', true);
			return $object;
		},
	));
});
