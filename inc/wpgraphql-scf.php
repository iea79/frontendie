<?php
/**
 * WPGraphQL — экспорт полей SCF (Smart Custom Fields).
 * Поля главной страницы (ID 14) и CPT projects доступны в схеме GraphQL.
 * Требует: WPGraphQL, Smart Custom Fields.
 *
 * @package frondendie
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'graphql_register_types', 'frontendie_register_scf_graphql_fields' );

function frontendie_register_scf_graphql_fields() {
	$page_fields = [
		'firstTitle'     => [ 'scf' => 'first__title', 'type' => 'String' ],
		'firstName'      => [ 'scf' => 'first__name', 'type' => 'String' ],
		'firstText'      => [ 'scf' => 'first__text', 'type' => 'String' ],
		'firstBgId'      => [ 'scf' => 'first__bg', 'type' => 'Int' ],
		'skillsTitle'    => [ 'scf' => 'skills__title', 'type' => 'String' ],
		'skillsLabel'    => [ 'scf' => 'skills__label', 'type' => 'String' ],
		'skillsLabel2'   => [ 'scf' => 'skills__label2', 'type' => 'String' ],
		'skillsText'     => [ 'scf' => 'skills__text', 'type' => 'String' ],
		'pricesTitle'    => [ 'scf' => 'prices__title', 'type' => 'String' ],
		'pricesLabel'    => [ 'scf' => 'prices__label', 'type' => 'String' ],
		'pricesLabelOpt' => [ 'scf' => 'prices__label_opt', 'type' => 'String' ],
		'pricesInfo'     => [ 'scf' => 'prices__info', 'type' => 'String' ],
	];

	foreach ( $page_fields as $graphql_name => $config ) {
		register_graphql_field( 'Page', $graphql_name, [
			'type'        => $config['type'],
			'description' => sprintf( 'SCF: %s', $config['scf'] ),
			'resolve'     => function( $page ) use ( $config ) {
				$value = frontendie_scf_get( $config['scf'], $page->databaseId );
				if ( $config['type'] === 'Int' ) {
					return $value ? (int) $value : null;
				}
				return $value ?: null;
			},
		] );
	}

	register_graphql_field( 'Page', 'firstBgUrl', [
		'type'        => 'String',
		'description' => 'URL картинки фона первого экрана (SCF: first__bg → wp_get_attachment_image_url)',
		'resolve'     => function( $page ) {
			$id = (int) frontendie_scf_get( 'first__bg', $page->databaseId );
			if ( ! $id ) {
				return null;
			}
			$url = wp_get_attachment_image_url( $id, 'full' );
			return $url ?: null;
		},
	] );

	register_graphql_field( 'Page', 'skillsList', [
		'type'        => [ 'list_of' => 'SkillsListItem' ],
		'description' => 'SCF: skills-list',
		'resolve'     => function( $page ) {
			$raw = frontendie_scf_get( 'skills-list', $page->databaseId );
			if ( ! is_array( $raw ) ) {
				return [];
			}
			return array_map( function( $row ) {
				return [
					'name' => isset( $row['skills__name'] ) ? $row['skills__name'] : '',
					'list' => isset( $row['skills__list'] ) ? $row['skills__list'] : '',
				];
			}, $raw );
		},
	] );

	register_graphql_field( 'Page', 'pricesList', [
		'type'        => [ 'list_of' => 'PricesListItem' ],
		'description' => 'SCF: prices_list',
		'resolve'     => function( $page ) {
			$raw = frontendie_scf_get( 'prices_list', $page->databaseId );
			if ( ! is_array( $raw ) ) {
				return [];
			}
			return array_map( function( $row ) {
				return [
					'name' => isset( $row['prices__name'] ) ? $row['prices__name'] : '',
					'summ' => isset( $row['prices__summ'] ) ? $row['prices__summ'] : '',
					'text' => isset( $row['prices__text'] ) ? $row['prices__text'] : '',
				];
			}, $raw );
		},
	] );

	register_graphql_field( 'Page', 'pricesListOpt', [
		'type'        => [ 'list_of' => 'PricesListItem' ],
		'description' => 'SCF: prices_list_opt',
		'resolve'     => function( $page ) {
			$raw = frontendie_scf_get( 'prices_list_opt', $page->databaseId );
			if ( ! is_array( $raw ) ) {
				return [];
			}
			return array_map( function( $row ) {
				return [
					'name' => isset( $row['prices__name_opt'] ) ? $row['prices__name_opt'] : '',
					'summ' => isset( $row['prices__summ_opt'] ) ? $row['prices__summ_opt'] : '',
					'text' => isset( $row['prices__text_opt'] ) ? $row['prices__text_opt'] : '',
				];
			}, $raw );
		},
	] );

	register_graphql_object_type( 'SkillsListItem', [
		'description' => 'Элемент списка навыков (SCF)',
		'fields'      => [
			'name' => [ 'type' => 'String' ],
			'list' => [ 'type' => 'String' ],
		],
	] );

	register_graphql_object_type( 'PricesListItem', [
		'description' => 'Элемент списка цен (SCF)',
		'fields'      => [
			'name' => [ 'type' => 'String' ],
			'summ' => [ 'type' => 'String' ],
			'text' => [ 'type' => 'String' ],
		],
	] );

	$project_type = 'Project';
	$pto = get_post_type_object( 'projects' );
	if ( $pto && ! empty( $pto->graphql_single_name ) ) {
		$project_type = $pto->graphql_single_name;
	}

	register_graphql_field( $project_type, 'projectLink', [
		'type'        => 'String',
		'description' => 'SCF: project__link',
		'resolve'     => function( $project ) {
			return frontendie_scf_get( 'project__link', $project->databaseId );
		},
	] );
}

/**
 * Получить значение SCF с fallback на get_post_meta.
 */
function frontendie_scf_get( $key, $post_id = null ) {
	if ( class_exists( 'SCF' ) && method_exists( 'SCF', 'get' ) ) {
		return SCF::get( $key, $post_id );
	}
	$value = get_post_meta( (int) $post_id, $key, true );
	if ( $value !== '' ) {
		return $value;
	}
	$value = get_post_meta( (int) $post_id, 'smart-cf-' . $key, true );
	return $value !== '' ? $value : null;
}
