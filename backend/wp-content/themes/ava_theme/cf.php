<?php

add_action( 'rest_api_init', function () {	
	register_rest_field( 'projects', 'gal_pub', array(
        'get_callback' => function ( $post_arr ) {
            $arr = array();
            foreach (carbon_get_post_meta( $post_arr['id'], 'pub_gal' ) as &$value) {
                array_push($arr, wp_get_attachment_image_url( $value, 'full'));
            };
            return $arr;
        },
        'update_callback' => null,
        'schema' => null
    ));
	register_rest_field( 'projects', 'gal_m', array(
		'get_callback' => function ( $post_arr ) {

			$arr = array();
			foreach (carbon_get_post_meta( $post_arr['id'], 'a_gal' ) as &$value) {
				array_push($arr, wp_get_attachment_image_url( $value, 'full'));
			};
			return $arr;
		},
		'update_callback' => null,
		'schema' => null
	) );
	
	register_rest_route( 'wp/v2', '/menu_translate', array(
	    'methods' => 'GET',
	    'callback' => 'my_awesome_func',
	  ) );

	function my_awesome_func(){
		$arr = array(
			'projects'=> array(
				'ru'=> get_option( 'projects_sett_ru' ),
				'en'=> get_option( 'projects_sett_en' ),
			),
			'about_us'=> array(
				'ru'=> get_option( 'about_us_sett_ru' ),
				'en'=> get_option( 'about_us_sett_en' ),
			),
			'contacts'=> array(
				'ru'=> get_option( 'contacts_sett_ru' ),
				'en'=> get_option( 'contacts_sett_en' ),
			),
			'lang'=> array(
				'ru'=> get_option( 'lang_sett_ru' ),
				'en'=> get_option( 'lang_sett_en' ),
			),
		);
		return $arr;
	};
} );

add_filter( 'carbon_fields_map_field_api_key', 'crb_get_gmaps_api_key' );
function crb_get_gmaps_api_key( $key ) {
    return 'AIzaSyB7qB-Rc_Zovei0r7OBXX1clCHgxgY7Yzc';
}


//-----------------> Настройка страницы редактирования меню на главной
add_action( 'admin_menu', 'true_top_menu_page', 25 );
function true_top_menu_page(){
    add_submenu_page(
        'themes.php',
        'Настройки меню на главной', // тайтл страницы
        'Настройка меню', // текст ссылки в меню
        'manage_options', // права пользователя, необходимые для доступа к странице
        'true_menu_main', // ярлык страницы
        'true_menu_main_page_callback' // функция, которая выводит содержимое страницы
    );
}
function true_menu_main_page_callback(){
    echo '<div class="wrap">
    <h1>' . get_admin_page_title() . '</h1>
    <form method="post" action="options.php">';
        settings_fields( 'true_menu_main_settings' ); // название настроек
        do_settings_sections( 'true_menu_main' ); // ярлык страницы, не более
        submit_button(); // функция для вывода кнопки сохранения
    echo '</form></div>';
}

add_action( 'admin_init',  'true_menu_projects_fields' );
function true_menu_projects_fields(){
 
    // добавляем секцию без заголовка
    add_settings_section(
        'projects_settings_section_id', // ID секции, пригодится ниже
        'Проекты', // заголовок (не обязательно)
        'projects_desk', // функция для вывода HTML секции (необязательно)
        'true_menu_main' // ярлык страницы
    );

    function projects_desk( $args ) {
    	$url = "https://kerimovarchitects.com/projects";
		echo wpautop( 'Страница: <a href="' . $url . '">' .$url . '</a>' );
	}

    // регистрируем опцию
    register_setting(
        'true_menu_main_settings', // название настроек из предыдущего шага
        'projects_sett_ru', // ярлык опции
        '' // функция очистки
    );
 
    // добавление поля
    add_settings_field(
        'projects_sett_ru',
        'Русский',
        'true_char_field', // название функции для вывода
        'true_menu_main', // ярлык страницы
        'projects_settings_section_id', // // ID секции, куда добавляем опцию
        array( 
            'label_for' => 'projects_sett_ru',
            'class' => 'projects-block-class', // для элемента <tr>
            'name' => 'projects_sett_ru', // любые доп параметры в колбэк функцию
            'default' => 'Проекты', // значение по-умолчанию
        )
    );

    // регистрируем опцию
    register_setting(
        'true_menu_main_settings', // название настроек из предыдущего шага
        'projects_sett_en', // ярлык опции
        '' // функция очистки
    );
 
    // добавление поля
    add_settings_field(
        'projects_sett_en',
        'Английский',
        'true_char_field', // название функции для вывода
        'true_menu_main', // ярлык страницы
        'projects_settings_section_id', // // ID секции, куда добавляем опцию
        array( 
            'label_for' => 'projects_sett_en',
            'class' => 'projects-block-class', // для элемента <tr>
            'name' => 'projects_sett_en', // любые доп параметры в колбэк функцию
            'default' => 'Projects', // значение по-умолчанию
        )
    );
}

add_action( 'admin_init',  'true_menu_about_us_fields' );
function true_menu_about_us_fields(){
 
    // добавляем секцию без заголовка
    add_settings_section(
        'about_us_settings_section_id', // ID секции, пригодится ниже
        'О бюро', // заголовок (не обязательно)
        'about_us_desk', // функция для вывода HTML секции (необязательно)
        'true_menu_main' // ярлык страницы
    );

    function about_us_desk( $args ) {
    	$url = "https://kerimovarchitects.com/about";
		echo wpautop( 'Страница: <a href="' . $url . '">' .$url . '</a>' );
		// $args[ 'id' ] – ID секции
		// $args[ 'title' ] – заголовок
		// $args[ 'callback' ] – название функции
	}

    // регистрируем опцию
    register_setting(
        'true_menu_main_settings', // название настроек из предыдущего шага
        'about_us_sett_ru', // ярлык опции
        '' // функция очистки
    );
 
    // добавление поля
    add_settings_field(
        'about_us_sett_ru',
        'Русский',
        'true_char_field', // название функции для вывода
        'true_menu_main', // ярлык страницы
        'about_us_settings_section_id', // // ID секции, куда добавляем опцию
        array( 
            'label_for' => 'about_us_sett_ru',
            'class' => 'about_us-block-class', // для элемента <tr>
            'name' => 'about_us_sett_ru', // любые доп параметры в колбэк функцию
            'default' => 'О бюро', // значение по-умолчанию
        )
    );

    // регистрируем опцию
    register_setting(
        'true_menu_main_settings', // название настроек из предыдущего шага
        'about_us_sett_en', // ярлык опции
        '' // функция очистки
    );
 
    // добавление поля
    add_settings_field(
        'about_us_sett_en',
        'Английский',
        'true_char_field', // название функции для вывода
        'true_menu_main', // ярлык страницы
        'about_us_settings_section_id', // // ID секции, куда добавляем опцию
        array( 
            'label_for' => 'about_us_sett_en',
            'class' => 'about_us-block-class', // для элемента <tr>
            'name' => 'about_us_sett_en', // любые доп параметры в колбэк функцию
            'default' => 'About bureau', // значение по-умолчанию
        )
    );
}

add_action( 'admin_init',  'true_menu_contacts_fields' );
function true_menu_contacts_fields(){
 
    // добавляем секцию без заголовка
    add_settings_section(
        'contacts_settings_section_id', // ID секции, пригодится ниже
        'Контакты', // заголовок (не обязательно)
        'contacts_desk', // функция для вывода HTML секции (необязательно)
        'true_menu_main' // ярлык страницы
    );

    function contacts_desk( $args ) {
    	$url = "hhttps://kerimovarchitects.com/contacts";
		echo wpautop( 'Страница: <a href="' . $url . '">' .$url . '</a>' );
	}

    // регистрируем опцию
    register_setting(
        'true_menu_main_settings', // название настроек из предыдущего шага
        'contacts_sett_ru', // ярлык опции
        '' // функция очистки
    );
 
    // добавление поля
    add_settings_field(
        'contacts_sett_ru',
        'Русский',
        'true_char_field', // название функции для вывода
        'true_menu_main', // ярлык страницы
        'contacts_settings_section_id', // // ID секции, куда добавляем опцию
        array( 
            'label_for' => 'contacts_sett_ru',
            'class' => 'contacts-block-class', // для элемента <tr>
            'name' => 'contacts_sett_ru', // любые доп параметры в колбэк функцию
            'default' => 'Контакты', // значение по-умолчанию
        )
    );

    // регистрируем опцию
    register_setting(
        'true_menu_main_settings', // название настроек из предыдущего шага
        'contacts_sett_en', // ярлык опции
        '' // функция очистки
    );
 
    // добавление поля
    add_settings_field(
        'contacts_sett_en',
        'Английский',
        'true_char_field', // название функции для вывода
        'true_menu_main', // ярлык страницы
        'contacts_settings_section_id', // // ID секции, куда добавляем опцию
        array( 
            'label_for' => 'contacts_sett_en',
            'class' => 'contacts-block-class', // для элемента <tr>
            'name' => 'contacts_sett_en', // любые доп параметры в колбэк функцию
            'default' => 'Contacts', // значение по-умолчанию
        )
    );
}

add_action( 'admin_init',  'true_menu_lang_fields' );
function true_menu_lang_fields(){
 
    // добавляем секцию без заголовка
    add_settings_section(
        'lang_settings_section_id', // ID секции, пригодится ниже
        'Языки', // заголовок (не обязательно)
        'lang_desk', // функция для вывода HTML секции (необязательно)
        'true_menu_main' // ярлык страницы
    );

    function lang_desk( $args ) {
    	$url = "https://kerimovarchitects.com/en";
		echo wpautop( 'Страница: <a href="' . $url . '">' .$url . '</a>' );
	}

    // регистрируем опцию
    register_setting(
        'true_menu_main_settings', // название настроек из предыдущего шага
        'lang_sett_ru', // ярлык опции
        '' // функция очистки
    );
 
    // добавление поля
    add_settings_field(
        'lang_sett_ru',
        'Русский',
        'true_char_field', // название функции для вывода
        'true_menu_main', // ярлык страницы
        'lang_settings_section_id', // // ID секции, куда добавляем опцию
        array( 
            'label_for' => 'lang_sett_ru',
            'class' => 'lang-block-class', // для элемента <tr>
            'name' => 'lang_sett_ru', // любые доп параметры в колбэк функцию
            'default' => 'RU / EN', // значение по-умолчанию
        )
    );

    // регистрируем опцию
    register_setting(
        'true_menu_main_settings', // название настроек из предыдущего шага
        'lang_sett_en', // ярлык опции
        '' // функция очистки
    );
 
    // добавление поля
    add_settings_field(
        'lang_sett_en',
        'Английский',
        'true_char_field', // название функции для вывода
        'true_menu_main', // ярлык страницы
        'lang_settings_section_id', // // ID секции, куда добавляем опцию
        array( 
            'label_for' => 'lang_sett_en',
            'class' => 'lang-block-class', // для элемента <tr>
            'name' => 'lang_sett_en', // любые доп параметры в колбэк функцию
            'default' => 'RU / EN', // значение по-умолчанию
        )
    );
}


function true_char_field( $args ){
    // получаем значение из базы данных
    $value = get_option( $args[ 'name' ] );
    if ($value == ""){
    	$value = $args[ 'default' ];
    }
    printf(
        '<input type="text" id="%s" name="%s" value="%s" />',
        esc_attr( $args[ 'name' ] ),
        esc_attr( $args[ 'name' ] ),
        $value
    );
}

add_action( 'admin_notices', 'true_custom_notice' );
function true_custom_notice() {
    if(
        isset( $_GET[ 'page' ] )
        && 'true_menu_main' == $_GET[ 'page' ]
        && isset( $_GET[ 'settings-updated' ] )
        && true == $_GET[ 'settings-updated' ]
    ) {
        echo '<div class="notice notice-success is-dismissible"><p>Информация для меню сохрвнена!</p></div>';
    }
}
//<----------------- Настройка страницы редактирования меню на главной


add_action('init', 'add_post_type');
function add_post_type(){


	register_taxonomy( 'cat', 'projects', array(
		'labels' => array(
			// 'menu_name' => 'Вид материалов',
			'name'                     => 'Категории', // основное название во множественном числе
			'singular_name'            => 'Категория', // название единичного элемента таксономии
			'menu_name'                => 'Категории', // Название в меню. По умолчанию: name.
			'all_items'                => 'Все категории',
			'edit_item'                => 'Изменить ',
			'view_item'                => 'Просмотр ', // текст кнопки просмотра записи на сайте (если поддерживается типом)
			'update_item'              => 'Обновить ',
			'add_new_item'             => 'Добавить новую категорию',
			'new_item_name'            => 'Название новой категории',
			'parent_item'              => 'Родительский фильтр', // только для таксономий с иерархией
			'parent_item_colon'        => 'Родительский фильтр:',
			'search_items'             => 'Искать',
			'popular_items'            => 'Популярные фильтры', // для таксономий без иерархий
			'separate_items_with_commas' => 'Разделяйте запятыми',
			'add_or_remove_items'      => 'Добавить или удалить',
			'choose_from_most_used'    => 'Выбрать из часто используемых',
			'not_found'                => 'Категорий не найдено',
			'back_to_items'            => '← Назад',
		),
		'public' => true,
		'show_in_rest'=>true,
		'hierarchical'=>true,
		'show_admin_column'=>true,
		'rewrite'=>false
	));

	register_taxonomy( 'year', 'projects', array(
		'labels' => array(
			// 'menu_name' => 'Вид материалов',
			'name'                     => 'Год', // основное название во множественном числе
			'singular_name'            => 'Год', // название единичного элемента таксономии
			'menu_name'                => 'Год', // Название в меню. По умолчанию: name.
			'all_items'                => 'Все года',
			'edit_item'                => 'Изменить ',
			'view_item'                => 'Просмотр ', // текст кнопки просмотра записи на сайте (если поддерживается типом)
			'update_item'              => 'Обновить ',
			'add_new_item'             => 'Добавить новую категорию',
			'new_item_name'            => 'Название новой категории',
			'parent_item'              => 'Родительский фильтр', // только для таксономий с иерархией
			'parent_item_colon'        => 'Родительский фильтр:',
			'search_items'             => 'Искать',
			'popular_items'            => 'Популярные фильтры', // для таксономий без иерархий
			'separate_items_with_commas' => 'Разделяйте запятыми',
			'add_or_remove_items'      => 'Добавить или удалить',
			'choose_from_most_used'    => 'Выбрать из часто используемых',
			'not_found'                => 'Категорий не найдено',
			'back_to_items'            => '← Назад',
		),
		'public' => true,
		'show_in_rest'=>true,
		'hierarchical'=>true,
		'show_admin_column'=>true,
		'rewrite'=>false
	));

	register_taxonomy( 'country', 'projects', array(
		'labels' => array(
			// 'menu_name' => 'Вид материалов',
			'name'                     => 'Страна', // основное название во множественном числе
			'singular_name'            => 'Страна', // название единичного элемента таксономии
			'menu_name'                => 'Страна', // Название в меню. По умолчанию: name.
			'all_items'                => 'Все страны',
			'edit_item'                => 'Изменить ',
			'view_item'                => 'Просмотр ', // текст кнопки просмотра записи на сайте (если поддерживается типом)
			'update_item'              => 'Обновить ',
			'add_new_item'             => 'Добавить новую категорию',
			'new_item_name'            => 'Название новой категории',
			'parent_item'              => 'Родительский фильтр', // только для таксономий с иерархией
			'parent_item_colon'        => 'Родительский фильтр:',
			'search_items'             => 'Искать',
			'popular_items'            => 'Популярные фильтры', // для таксономий без иерархий
			'separate_items_with_commas' => 'Разделяйте запятыми',
			'add_or_remove_items'      => 'Добавить или удалить',
			'choose_from_most_used'    => 'Выбрать из часто используемых',
			'not_found'                => 'Категорий не найдено',
			'back_to_items'            => '← Назад',
		),
		'public' => true,
		'show_in_rest'=>true,
		'hierarchical'=>true,
		'show_admin_column'=>true,
		'rewrite'=>false
	));

	register_post_type('projects', array(
		'labels'             => array(
			'name'               => 'Проекты', // Основное название типа записи
			'singular_name'      => 'Проекты', // отдельное название записи типа Book
			'add_new'            => 'Добавить проект',
			'add_new_item'       => 'Добавить проект',
			'edit_item'          => 'Редактировать проект',
			'new_item'           => 'Новый проект',
			'view_item'          => 'Посмотреть проект',
			'search_items'       => 'Найти проект',
			'not_found'          => 'Оборудования в портфолио не найдено',
			'not_found_in_trash' => 'В корзине оборудования не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Проекты'

			),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'show_in_rest'=>true,
		'supports'           => array('title')
	) );



}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {

$lang = array('ru','en');

//
//----SEO----
//
$seoCF = Container::make( 'post_meta', __( 'SEO' ) )->where( 'post_type', 'IN', array( 'page','projects' ) );
foreach ($lang as &$langI) {
	$seoCF->add_tab( $langI, array(
		Field::make( 'text', $langI.'_seo_tit', 'Title - '.$langI )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'text', $langI.'_seo_des', 'Description - '.$langI )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
	));
}


//
//----Projects cat----
//

$catPrCF = Container::make( 'term_meta', __( ' ' ) )
    ->where( 'term_taxonomy', '=', 'cat' );
	foreach ($lang as &$langI) {
		$catPrCF->add_tab( $langI, array(
			Field::make( 'text', $langI.'_tit', 'Заголовок' )->set_width( 70 )->set_visible_in_rest_api( $visible = true ),
		));
	};

$yearPrCF = Container::make( 'term_meta', __( ' ' ) )
    ->where( 'term_taxonomy', '=', 'year' );
	foreach ($lang as &$langI) {
		$yearPrCF->add_tab( $langI, array(
			Field::make( 'text', $langI.'_tit', 'Заголовок' )->set_width( 70 )->set_visible_in_rest_api( $visible = true ),
		));
	};

$countryPrCF = Container::make( 'term_meta', __( ' ' ) )
    ->where( 'term_taxonomy', '=', 'country' );
	foreach ($lang as &$langI) {
		$countryPrCF->add_tab( $langI, array(
			Field::make( 'text', $langI.'_tit', 'Заголовок' )->set_width( 70 )->set_visible_in_rest_api( $visible = true ),
		));
	};


//
//----Projects----
//
$servCF = Container::make( 'post_meta', __( 'Projects' ) )->where( 'post_type', 'IN', ['projects'] ) ;
foreach ($lang as &$langI) {
	$servCF->add_tab( $langI, array(
		Field::make( 'text', $langI.'_tit', 'Заголовок' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'text', $langI.'_tit1', 'Заголовок' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'rich_text',  $langI.'_val1', 'Описание' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'rich_text',  $langI.'_val2', 'Описание' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'text', $langI.'_tit2', 'Заголовок' )->set_width( 70 )->set_visible_in_rest_api( $visible = true ),
		
		Field::make( 'complex', $langI.'_list', 'Список' )
		->add_fields( array(
			Field::make( 'text', 'name', __( 'Название' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'rich_text', 'det', __( 'Описание' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
		) )->set_visible_in_rest_api( $visible = true ),
		));
	}
	
	$arrGal = array(
		Field::make( 'image', 'img', __( 'Фото' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true )->set_value_type( 'url' ),
		Field::make( 'text', 'vid', __( 'Видео' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'checkbox', 'width', __( 'Ширина 100%' ) )
	);
	foreach ($lang as &$langI) {
		array_push($arrGal, Field::make( 'rich_text', $langI.'_name', __( 'Описание '.$langI ) )->set_width( 100 )->set_visible_in_rest_api( $visible = true ));
	}
	
	
	$servCF->add_tab( 'Общее', array(
		Field::make( 'image', 'r_img1', __( 'Фото1' ) )->set_width( 50 )->set_value_type( 'url' )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'image', 'r_img2', __( 'Фото2' ) )->set_width( 50 )->set_value_type( 'url' )->set_visible_in_rest_api( $visible = true ),

		Field::make( 'map', 'map', __( 'Map' ) )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'complex', 'gal', 'Галерея с описанием' )
		->add_fields( $arrGal )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'media_gallery', 'pub_gal', __( 'Галерея наград' ) )->set_type( array( 'image' ) )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'media_gallery', 'a_gal', __( 'Галерея' ) )->set_type( array( 'image' ) )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'association', 'ass', __( 'Следующий проект' ) )->set_max( 1 )->set_types( array(
			array(
				'type'      => 'post',
				'post_type' => 'projects',
			)
		) )->set_visible_in_rest_api( $visible = true )
));

//
//----MainP----
//

$contPCF = Container::make( 'post_meta', __( 'О компании' ) )->where( 'post_type', '=', 'page' )->show_on_page(21);
foreach ($lang as &$langI) {
	$contPCF->add_tab( $langI, array(
		Field::make( 'text', $langI.'_m_tit', 'Заголовок' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'text', $langI.'_m_text', 'Текст' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'image', $langI.'_m_img', 'Фото' )->set_value_type( 'url' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
	));
}

//
//----AboutP----
//
$contPCF = Container::make( 'post_meta', __( 'О компании' ) )->where( 'post_type', '=', 'page' )->show_on_page(24);
foreach ($lang as &$langI) {
	$contPCF->add_tab( $langI, array(
		Field::make( 'text', $langI.'_tit', 'Заголовок' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),

		Field::make( 'text', $langI.'_tit_sm', 'Заголовок малый' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),

		Field::make( 'rich_text',  $langI.'_val1', 'Описание' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'rich_text',  $langI.'_val2', 'Описание' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'rich_text',  $langI.'_val3', 'Описание' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),

		Field::make( 'text', $langI.'_team_title', __( 'Заголовок блока команда' ) )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'complex', $langI.'_team', 'Команда' )
		->add_fields( array(
			Field::make( 'text', 'name', __( 'Имя' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'text', 'pos', __( 'Должность' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'image', 'img', __( 'Фото' ) )->set_value_type( 'url' )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'complex', 'list', 'Описание' )
			->add_fields( array(
				Field::make( 'text', 'name', __( 'Заголовок' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
				Field::make( 'rich_text', 'val', __( 'Описание' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
			) )->set_visible_in_rest_api( $visible = true )->set_header_template( '<% if (name) { %><%- name %><% } %>' )->set_layout( 'tabbed-vertical' ),

		) )->set_visible_in_rest_api( $visible = true )->set_header_template( '<% if (name) { %><%- name %><% } %>' )->set_layout( 'tabbed-vertical' ),

		Field::make( 'complex', $langI.'_inf', 'Информация' )
		->add_fields( array(
			Field::make( 'text', 'name', __( 'Заголовок' ) )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'rich_text', 'pos', __( 'Описание' ) )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		) )->set_visible_in_rest_api( $visible = true )->set_header_template( '<% if (name) { %><%- name %><% } %>' )->set_layout( 'tabbed-vertical' ),

		Field::make( 'text', $langI.'_tit_1sm', 'Заголовок малый' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),

		Field::make( 'rich_text',  $langI.'_val11', 'Описание' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'rich_text',  $langI.'_val12', 'Описание' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'rich_text',  $langI.'_val13', 'Описание' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		
		Field::make( 'image', $langI.'_img_big0', 'Фото' )->set_value_type( 'url' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),

		Field::make( 'separator', $langI.'_aww_sep', __( 'Награды' ) ),
		Field::make( 'text', $langI.'_aww_tit', 'Заголовок' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'text', $langI.'_aww_tit_sm', 'Заголовок малый' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'complex', $langI.'_aww_list', 'Список' )
		->add_fields( array(
			Field::make( 'text', 'name', 'Название' )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'text', 'link', __( 'Ссылка' ) )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'image', 'img', 'Лого' )->set_value_type( 'url' )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
		) )->set_visible_in_rest_api( $visible = true )->set_header_template( '<% if (name) { %><%- name %><% } %>' ),		
		
		Field::make( 'separator', $langI.'_pub_sep', __( 'Публикации' ) ),
		Field::make( 'text', $langI.'_pub_tit', 'Заголовок' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'text', $langI.'_pub_tit_sm', 'Заголовок малый' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'complex', $langI.'_pub_list', 'Список' )
		->add_fields( array(
			Field::make( 'text', 'name', 'Название' )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'text', 'link', __( 'Ссылка' ) )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
		) )->set_visible_in_rest_api( $visible = true )->set_header_template( '<% if (name) { %><%- name %><% } %>' ),

		
		
		
		Field::make( 'text', $langI.'_pub-print_title', __( 'Заголовок блока печатные публикации' ) )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'complex', $langI.'_pub-print', 'Печатные публикации' )
		->add_fields( array(
			Field::make( 'text', 'name', __( 'Название' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'text', 'pos', __( 'Издательство' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'image', 'img', __( 'Фото' ) )->set_value_type( 'url' )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'media_gallery', 'gallery', __( 'Галерея для картинок публикаций' ) )->set_type( array( 'url' ) )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'complex', 'list', 'Описание' )
			->add_fields( array(
				Field::make( 'text', 'name', __( 'Заголовок' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
				Field::make( 'rich_text', 'val', __( 'Описание' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
			) )->set_visible_in_rest_api( $visible = true )->set_header_template( '<% if (name) { %><%- name %><% } %>' )->set_layout( 'tabbed-vertical' ),
		) )->set_visible_in_rest_api( $visible = true )->set_header_template( '<% if (name) { %><%- name %><% } %>' )->set_layout( 'tabbed-vertical' ),
		
		
		
		
		Field::make( 'image', $langI.'_img_big2', 'Фото' )->set_value_type( 'url' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'text', $langI.'_img_big2_vid', 'Видео' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),

		Field::make( 'separator', $langI.'_eve_sep', __( 'События' ) ),
		Field::make( 'text', $langI.'_eve_tit', 'Заголовок' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'text', $langI.'_eve_tit_sm', 'Заголовок малый' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'complex', $langI.'_eve_list', 'Список' )
		->add_fields( array(
			Field::make( 'text', 'name', 'Название' )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
		) )->set_visible_in_rest_api( $visible = true )->set_header_template( '<% if (name) { %><%- name %><% } %>' ),


		Field::make( 'separator', $langI.'_vac_sep', __( 'Вакансии' ) ),
		Field::make( 'text', $langI.'_vac_tit', 'Заголовок' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'complex', $langI.'_vac_list', 'Список' )
		->add_fields( array(
			Field::make( 'text', 'name', 'Название' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'rich_text', 'val', 'Описание' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'complex', 'list', 'Список' )
			->add_fields( array(
				Field::make( 'text', 'name', 'Название' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
				Field::make( 'rich_text', 'val', 'Описание' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
			) )->set_visible_in_rest_api( $visible = true )->set_layout( 'tabbed-vertical' )->set_header_template( '<% if (name) { %><%- name %><% } %>' ),
		) )->set_visible_in_rest_api( $visible = true )->set_layout( 'tabbed-vertical' )->set_header_template( '<% if (name) { %><%- name %><% } %>' ),

		Field::make( 'image', $langI.'_img_big3', 'Фото' )->set_value_type( 'url' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
	));
}

//
//----ContP----
//
$contPCF = Container::make( 'post_meta', __( 'Контакты' ) )->where( 'post_type', '=', 'page' )->show_on_page(27);
foreach ($lang as &$langI) {
	$contPCF->add_tab( $langI, array(
		Field::make( 'text', $langI.'_tit', 'Заголовок' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'complex', $langI.'_email_l', 'Email' )
		->add_fields( array(
			Field::make( 'text', 'name', 'Название' )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'text', 'link', 'Почта' )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
		) )->set_visible_in_rest_api( $visible = true )->set_layout( 'tabbed-vertical' )->set_header_template( '<% if (name) { %><%- name %><% } %>' ),
		Field::make( 'complex', $langI.'_tel_l', 'Телефон' )
		->add_fields( array(
			Field::make( 'text', 'name', 'Название' )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'text', 'link', 'Телефон' )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
		) )->set_visible_in_rest_api( $visible = true )->set_layout( 'tabbed-vertical' )->set_header_template( '<% if (name) { %><%- name %><% } %>' ),
		Field::make( 'complex', $langI.'_addres_l', 'Адрес' )
		->add_fields( array(
			Field::make( 'text', 'name', 'Название' )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'text', 'link', 'Адрес' )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
		) )->set_visible_in_rest_api( $visible = true )->set_layout( 'tabbed-vertical' )->set_header_template( '<% if (name) { %><%- name %><% } %>' ),

		// Field::make( 'text', $langI.'_email', 'Email' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		// Field::make( 'text', $langI.'_tel', 'Телефон' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		// Field::make( 'text', $langI.'_addres', 'Адрес' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'complex', $langI.'_soc', 'Соц сети' )
		->add_fields( array(
			Field::make( 'text', 'name', 'Название' )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'text', 'link', 'Ссылка' )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
			// Field::make( 'image', 'img', 'Лого' )->set_value_type( 'url' )->set_width( 33 )->set_visible_in_rest_api( $visible = true ),
		) )->set_visible_in_rest_api( $visible = true )->set_layout( 'tabbed-vertical' )->set_header_template( '<% if (name) { %><%- name %><% } %>' ),
		Field::make( 'image', $langI.'_img', 'Фото' )->set_value_type( 'url' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		

		Field::make( 'separator', $langI.'_form', __( 'Форма' ) ),
		Field::make( 'text', $langI.'form_tit', 'Заголовок' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'text', $langI.'from_tit_sm', 'Заголовок малый' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'text', $langI.'form_call', 'Мы перезвоним' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		// Field::make( 'complex', $langI.'_f_menu', 'Меню в подвале' )
		// ->add_fields( array(
		// 	Field::make( 'text', 'name', __( 'Название' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
		// 	Field::make( 'text', 'link', __( 'Ссылка' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
		// ) )->set_visible_in_rest_api( $visible = true )->set_layout( 'tabbed-vertical' )->set_header_template( '<% if (name) { %><%- name %><% } %>' ),

		Field::make( 'complex', $langI.'_m_menu', 'Меню в меню' )
		->add_fields( array(
			Field::make( 'text', 'name', __( 'Название' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
			Field::make( 'text', 'link', __( 'Ссылка' ) )->set_width( 50 )->set_visible_in_rest_api( $visible = true ),
		) )->set_visible_in_rest_api( $visible = true )->set_layout( 'tabbed-vertical' )->set_header_template( '<% if (name) { %><%- name %><% } %>' ),
		
	));
}

// //
// //----ContP----
// //
$contPCF = Container::make( 'post_meta', __( 'Форма' ) )->where( 'post_type', '=', 'page' )->show_on_page(635);
foreach ($lang as &$langI) {
	$contPCF->add_tab( $langI, array(
		Field::make( 'text', $langI.'_tit', 'Заголовок' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'text', $langI.'_tit_sm', 'Заголовок малый' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'text', $langI.'_call', 'Мы перезвоним' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
	
	));
}

//
//----Шаблон areaP----
//
$areaPCF = Container::make( 'post_meta', __( ' ' ) )->where( 'post_template', '=', 'p-area.php' );
foreach ($lang as &$langI) {
	$areaPCF->add_tab( $langI, array(
		Field::make( 'text', $langI.'_tit', 'Заголовок' )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
		Field::make( 'rich_text', $langI.'_val', __( 'Страница' ) )->set_width( 100 )->set_visible_in_rest_api( $visible = true ),
	));
}


}