<?php
function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');
function elegant_enqueue_css()
{
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('fa-fluo', get_stylesheet_directory_uri() . '/fontawesome/css/all.min.css');
	wp_enqueue_style('css-responsive', get_stylesheet_directory_uri() . '/css/responsive.css');
	wp_enqueue_style('slick-fl-css', get_stylesheet_directory_uri() . '/slick/slick.css');
	wp_enqueue_style('slick-fl-css-theme', get_stylesheet_directory_uri() . '/slick/slick-theme.css');
	wp_enqueue_script('slick-fl-js', get_stylesheet_directory_uri() . '/slick/slick.min.js',array('jquery'),'1.8.0', true);
	wp_enqueue_script('img-laod', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.1/imagesloaded.pkgd.min.js');
	wp_enqueue_script('tw-js', 'https://platform.twitter.com/widgets.js#asyncload');
	wp_enqueue_script('theme_js', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'elegant_enqueue_css');


// Carga asíncrona
function ikreativ_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async"; 
    }
add_filter( 'clean_url', 'ikreativ_async_scripts', 11, 1 );


require get_theme_file_path('inc/functions.php');
require get_theme_file_path('inc/og/OpenGraph.php');
require get_theme_file_path('inc/post_types.php');
require get_theme_file_path('inc/shortcodes.php');
define( 'THEME_URI', get_stylesheet_directory_uri().'/img/feed/' );
//creamos el post con el feed
function create_feed_post($post_id)
{
	$url = $_POST['acf']['field_5e750ea627d22'];
	$parse = parse_url($url, PHP_URL_HOST);
	if($parse  !== 'twitter.com') {
		if (isset($_POST['acf']['field_5e750ea627d22'])) {
			$graph = OpenGraph::fetch($url);
			$descripcion = iconv('UTF-8', 'ISO-8859-1', utf8_decode($graph->description));
	
			update_field('imagen_nota', $graph->image, $post_id);
	
			if ($descripcion == false) {
				if($parse != 'www.youtube.com') {
					update_field('titulo_nota', $graph->title, $post_id);
					update_field('descripcion', $graph->description, $post_id);
				} else {
					update_field('titulo_nota', utf8_decode($graph->title), $post_id);
					update_field('descripcion', utf8_decode($graph->description), $post_id);
				}
			} else {
				update_field('titulo_nota', utf8_decode($graph->title), $post_id);
				update_field('descripcion', utf8_decode($graph->description), $post_id);
			}
		}
	}
}
add_action('acf/save_post', 'create_feed_post', 20);

// admin

add_action('admin_enqueue_scripts', 'load_admin_styles');
function load_admin_styles()
{
	wp_enqueue_style('admin_css', get_stylesheet_directory_uri() . '/css/admin.css', false, '1.0.0');
}


function add_footer_text_function()
{
	echo '<a href="https://www.tiempoar.com.ar/seamossocios" target="_blank" id="seamos-socios">seamos socios</a>';
}
add_action('wp_footer', 'add_footer_text_function');


//menu admin
/**
 * Removes some menus by page.
 */
function tar_remove_menu(){
   
	remove_menu_page( 'jetpack' );                    //Jetpack* 
	remove_menu_page( 'edit.php' );                   //Posts
	remove_menu_page( 'upload.php' );                 //Media
	remove_menu_page( 'edit.php?post_type=page' );    //Pages
	remove_menu_page( 'edit.php?post_type=acf-field-group' );
	remove_menu_page( 'edit.php?post_type=project' );
	remove_menu_page( 'edit-comments.php' );          //Comments
	remove_menu_page( 'themes.php' );                 //Appearance
	remove_menu_page( 'plugins.php' );                //Plugins
	remove_menu_page( 'ai1wm_export' );
	remove_menu_page( 'WP-Optimize' );
	remove_menu_page( 'et_divi_options' );
	remove_menu_page( 'tools.php' );                  //Tools
	remove_menu_page( 'options-general.php' );        //Settings
	 
  }
  if(get_current_user_id() !== 1) { //muestro los botones para el usuario ID 1
	add_action( 'admin_menu', 'tar_remove_menu' );
 }
 
