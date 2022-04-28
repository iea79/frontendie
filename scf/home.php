<?php

function home_first_section_fields( $settings, $type, $id, $meta_type, $types ) {
	// var_dump($type);
	// var_dump($id);
	if ( $id == 14 && $type === 'page' ) {
		$Section = SCF::add_setting( 'home-1', 'Первый экран' );
		$Section->add_group(
			'first-section',
			false,
			array(
				array(
					'name'        => 'first__title',
					'label'       => 'Заголовок страницы',
					'type'        => 'text',
				),
                array(
                    'name'        => 'first__name',
                    'label'       => 'Подзаголовок (имя)',
                    'type'        => 'text',
                ),
				array(
					'name'        => 'first__text',
					'label'       => 'Описание на первом экране',
					'type'        => 'wysiwyg',
				),
				array(
					'name'        => 'first__bg',
					'label'       => 'Фоновое изображение',
					'type'        => 'image',
					'size'        => 'medium',
				),
			)
		);
		$settings[] = $Section;
	}
	return $settings;
}
add_filter( 'smart-cf-register-fields', 'home_first_section_fields', 1, 5 );

function home_skills_section_fields( $settings, $type, $id, $meta_type, $types ) {
	// var_dump($type);
	// var_dump($id);
	if ( $id == 14 && $type === 'page' ) {
		$Section = SCF::add_setting( 'home-2', 'Навыки' );
		$Section->add_group(
			'skills-title',
			false,
			array(
				array(
					'name'        => 'skills__title',
					'label'       => 'Заголовок секции',
					'type'        => 'text',
				),
			)
		);
		$Section->add_group(
			'skills-label',
			false,
			array(
				array(
					'name'        => 'skills__label',
					'label'       => 'Заголовок навыка',
					'type'        => 'text',
				),
			)
		);
		$Section->add_group(
			'skills-list',
			true,
			array(
                array(
                    'name'        => 'skills__name',
                    'label'       => 'Название группы навыков',
                    'type'        => 'text',
                ),
				array(
					'name'        => 'skills__list',
					'label'       => 'Список группы навыков',
					'type'        => 'text',
				)
			)
		);
		$Section->add_group(
			'skills-label2',
			false,
			array(
				array(
					'name'        => 'skills__label2',
					'label'       => 'Заголовок менторства',
					'type'        => 'text',
				),
				array(
					'name'        => 'skills__text',
					'label'       => 'Текст менторства',
					'type'        => 'textarea',
				),
			)
		);
		$settings[] = $Section;
	}
	return $settings;
}
add_filter( 'smart-cf-register-fields', 'home_skills_section_fields', 1, 5 );

function home_prices_section_fields( $settings, $type, $id, $meta_type, $types ) {
	// var_dump($type);
	// var_dump($id);
	if ( $id == 14 && $type === 'page' ) {
		$Section = SCF::add_setting( 'home-3', 'Цены' );
		$Section->add_group(
			'prices-title',
			false,
			array(
				array(
					'name'        => 'prices__title',
					'label'       => 'Заголовок секции',
					'type'        => 'text',
				),
			)
		);
		$Section->add_group(
			'prices-label',
			false,
			array(
				array(
					'name'        => 'prices__label',
					'label'       => 'Заголовок розница',
					'type'        => 'text',
				),
			)
		);
		$Section->add_group(
			'prices_list',
			true,
			array(
                array(
                    'name'        => 'prices__name',
                    'label'       => 'Название работ',
                    'type'        => 'text',
                ),
				array(
					'name'        => 'prices__summ',
					'label'       => 'Стоимость работ',
					'type'        => 'text',
				),
				array(
					'name'        => 'prices__text',
					'label'       => 'Описание работ',
					'type'        => 'textarea',
				),
			)
		);
		$Section->add_group(
			'prices-label2',
			false,
			array(
				array(
					'name'        => 'prices__label_opt',
					'label'       => 'Заголовок опт',
					'type'        => 'text',
				),
			)
		);
		$Section->add_group(
			'prices_list_opt',
			true,
			array(
                array(
                    'name'        => 'prices__name_opt',
                    'label'       => 'Название работ',
                    'type'        => 'text',
                ),
				array(
					'name'        => 'prices__summ_opt',
					'label'       => 'Стоимость работ',
					'type'        => 'text',
				),
				array(
					'name'        => 'prices__text_opt',
					'label'       => 'Описание работ',
					'type'        => 'textarea',
				),
			)
		);
		$Section->add_group(
			'prices-info',
			false,
			array(
				array(
					'name'        => 'prices__info',
					'label'       => 'Информационный текст',
					'type'        => 'textarea',
				),
			)
		);
		$settings[] = $Section;
	}
	return $settings;
}
add_filter( 'smart-cf-register-fields', 'home_prices_section_fields', 1, 5 );
