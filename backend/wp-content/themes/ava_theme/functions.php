<?php
/**
 * avatheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package avatheme
 */

if ( ! function_exists( 'avatheme_setup' ) ) :

	function avatheme_setup() {
		add_theme_support( 'title-tag', 'post-thumbnails' );
	}
endif;
if( is_admin() ){
	// отключим проверку обновлений при любом заходе в админку...
	remove_action( 'admin_init', '_maybe_update_core' );
	remove_action( 'admin_init', '_maybe_update_plugins' );
	remove_action( 'admin_init', '_maybe_update_themes' );

	// отключим проверку обновлений при заходе на специальную страницу в админке...
	remove_action( 'load-plugins.php', 'wp_update_plugins' );
	remove_action( 'load-themes.php', 'wp_update_themes' );

	// оставим принудительную проверку при заходе на страницу обновлений...
	remove_action( 'load-update-core.php', 'wp_update_plugins' );
	remove_action( 'load-update-core.php', 'wp_update_themes' );

	// внутренняя страница админки "Update/Install Plugin" или "Update/Install Theme" - оставим не мешает...
	remove_action( 'load-update.php', 'wp_update_plugins' );
	remove_action( 'load-update.php', 'wp_update_themes' );

	// событие крона не трогаем, через него будет проверяться наличие обновлений - тут все отлично!
	remove_action( 'wp_version_check', 'wp_version_check' );
	remove_action( 'wp_update_plugins', 'wp_update_plugins' );
	remove_action( 'wp_update_themes', 'wp_update_themes' );

	/**
	 * отключим проверку необходимости обновить браузер в консоли - мы всегда юзаем топовые браузеры!
	 * эта проверка происходит раз в неделю...
	 * @see https://wp-kama.ru/function/wp_check_browser_version
	 */
	add_filter( 'pre_site_transient_browser_'. md5( $_SERVER['HTTP_USER_AGENT'] ), '__return_empty_array' );
}


## Удаление метабоксов на странице редактирования записи
add_action('admin_menu','remove_default_post_screen_metaboxes');
function remove_default_post_screen_metaboxes() {
	// для постов
	// remove_meta_box( 'postcustom','post','normal' ); // произвольные поля
	remove_meta_box( 'postexcerpt','post','normal' ); // цитата
	remove_meta_box( 'commentstatusdiv','post','normal' ); // комменты
	// remove_meta_box( 'trackbacksdiv','post','normal' ); // блок уведомлений
	remove_meta_box( 'slugdiv','post','normal' ); // блок альтернативного названия статьи
	remove_meta_box( 'authordiv','post','normal' ); // автор

	// для страниц
	// remove_meta_box( 'postcustom','page','normal' ); // произвольные поля
	remove_meta_box( 'postexcerpt','page','normal' ); // цитата
	remove_meta_box( 'commentstatusdiv','page','normal' ); // комменты
	// remove_meta_box( 'trackbacksdiv','page','normal' ); // блок уведомлений
	remove_meta_box( 'slugdiv','page','normal' ); // блок альтернативного названия статьи
	remove_meta_box( 'authordiv','page','normal' ); // автор
}
add_action( 'widgets_init', 'unregister_basic_widgets' );

function unregister_basic_widgets(){

	unregister_widget( 'WP_Widget_Pages' );            // Виджет страниц
	unregister_widget( 'WP_Widget_Calendar' );         // Календарь
	unregister_widget( 'WP_Widget_Archives' );         // Архивы
	unregister_widget( 'WP_Widget_Links' );            // Ссылки
	unregister_widget( 'WP_Widget_Meta' );             // Мета виджет
	unregister_widget( 'WP_Widget_Search' );           // Поиск
	unregister_widget( 'WP_Widget_Text' );             // Текст
	unregister_widget( 'WP_Widget_Categories' );       // Категории
	unregister_widget( 'WP_Widget_Recent_Posts' );     // Последние записи
	unregister_widget( 'WP_Widget_Recent_Comments' );  // Последние комментарии
	unregister_widget( 'WP_Widget_RSS' );              // RSS
	unregister_widget( 'WP_Widget_Tag_Cloud' );        // Облако меток
	unregister_widget( 'WP_Nav_Menu_Widget' );         // Меню
}

add_action( 'after_setup_theme', 'avatheme_setup' );
if( is_admin() && ! defined('DOING_AJAX') ){
	add_action( 'init', 'remove_license_txt_readme_html' );
	function remove_license_txt_readme_html(){

		$license_file = ABSPATH .'/license.txt';
		$readme_file  = ABSPATH .'/readme.html';

		if( file_exists($license_file) && current_user_can('manage_options') ){

			$deleted = unlink($license_file) && unlink($readme_file);

			if( ! $deleted  )
				$GLOBALS['readmedel'] = 'Не удалось удалить файлы: license.txt и readme.html из папки `'. ABSPATH .'`. Удалите их вручную!';
			else
				$GLOBALS['readmedel'] = 'Файлы: license.txt и readme.html удалены из из папки `'. ABSPATH .'`.';

			add_action( 'admin_notices', function(){
				echo '<div class="error is-dismissible"><p>'. $GLOBALS['readmedel'] .'</p></div>';
			} );
		}
	}
}

// Скрытие "лишних" пунктов меню
add_action('admin_menu', 'remove_menus');
function remove_menus(){
	global $menu;
	$restricted = array(
		__('Dashboard'),
		__('Posts'),
		// __('Media'),
		// __('Links'),
		// __('Pages'),
		// __('Appearance'),
		// __('Tools'),
		// __('Users'),
		// __('Settings'),
		__('Comments'),
		// __('Plugins')
	);
	end ($menu);
	while (prev($menu)){
		$value = explode(' ', $menu[key($menu)][0]);
		if( in_array( ($value[0] != NULL ? $value[0] : "") , $restricted ) ){
			unset($menu[key($menu)]);
		}
	}
}

// Стили админки
add_action('admin_head', 'my_custom_styles');
function my_custom_styles() {
  echo '<style>
    .acf-input .image-wrap img{
			max-width:200px !important;
		}
		.acf-to-rest-api-donation-button{
			display:none;
    }
    #toplevel_page_edit-post_type-acf-field-group{
      display:none;
    }
	.admin-bar-search, #preview-action{
      display:none ;
	}
    #postdivrich{
       display:none;
    }

  </style>';
}

include 'cf.php';

// Количество слов отрывка и его окончание
add_filter('excerpt_more', function($more) {
	return '...';
});
add_filter( 'excerpt_length', function(){
	return 22;
} );

add_filter( 'use_block_editor_for_post_type', '__return_false' );



// Increase max page limit
function increase_per_page_limit($params)
{
  if (isset($params['per_page'])) {
    $params['per_page']['maximum'] = 1000000;
  }
  return $params;
}

add_filter('rest_post_collection_params', 'increase_per_page_limit', 10, 2);
add_filter('rest_page_collection_params', 'increase_per_page_limit', 10, 2);
add_filter('rest_category_collection_params', 'increase_per_page_limit', 10, 2);
add_filter('rest_user_collection_params', 'increase_per_page_limit', 10, 2);

function add_cors_headers() {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
}
add_action('init', 'add_cors_headers');
