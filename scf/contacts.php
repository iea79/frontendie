<?php
if ( ! defined( 'CONTACT_TYPE_NAME' ) ) {
	define( 'CONTACT_TYPE_NAME', 'our-contacts' );
}

// Регистрация метабоксов и произвольных полей.
function contacts_part_fields( $settings, $type, $id, $meta_type, $types ) {
	// Отображаем поля только на странице редактирования Записи
	// var_dump($type);
	if ( $type == CONTACT_TYPE_NAME ) {

		// Создаем блок настроек (метабокс).
		$Section = SCF::add_setting( 'contacts_part', 'Edit your contact' );

		// Добавляем в метабокс произвольные поля.
		$Section->add_group(
			// ID группы полей.
			'contacts_part_field',
			// Повторяемая группа полей? Да - true, Нет - false.
			false,
			// Массив полей.
			array(
				array(
					'name'        => 'contacts__addres',
					'label'       => 'Company address',
					'type'        => 'wysiwyg',
				),
				array(
					'name'        => 'contacts__tel',
					'label'       => 'Company phone',
					'type'        => 'text',
					'notes'       => ''
				),
				array(
					'name'        => 'contacts__email',
					'label'       => 'Company email',
					'type'        => 'text',
					'notes'       => ''
				),
			)
		);

		// Добавляем информацию о наших полях в общий массив.
		$settings[] = $Section;
	}

	// var_dump($Section);
	// var_dump($settings);
	// Обязательно возвращаем данные.
	return $settings;
}
add_filter( 'smart-cf-register-fields', 'contacts_part_fields', 10, 5 );
