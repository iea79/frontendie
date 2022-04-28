<?php

// Регистрация метабоксов и произвольных полей.
function project_fields( $settings, $type, $id, $meta_type, $types ) {
	// Отображаем поля только на странице редактирования Записи
	// var_dump($type);
	// var_dump($id);
	if ( $type === 'projects' ) {

		// Создаем блок настроек (метабокс).
		$Section = SCF::add_setting( 'project-settings', 'Настройки проекта' );

		// Добавляем в метабокс произвольные поля.
		$Section->add_group(
			// ID группы полей.
			'first-section',
			// Повторяемая группа полей? Да - true, Нет - false.
			false,
			// Массив полей.
			array(
				array(
					'name'        => 'project__link',
					'label'       => 'Ссылка на проект',
					'type'        => 'text',
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
add_filter( 'smart-cf-register-fields', 'project_fields', 1, 5 );
