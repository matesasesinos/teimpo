<?php

function elegant_enqueue_css()
{
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('fa-fluo', get_stylesheet_directory_uri() . '/fontawesome/css/all.min.css');
	wp_enqueue_style('css-responsive', get_stylesheet_directory_uri() . '/css/responsive.css');
	wp_enqueue_style('slick-fl-css', get_stylesheet_directory_uri() . '/slick/slick.css');
	wp_enqueue_style('slick-fl-css-theme', get_stylesheet_directory_uri() . '/slick/slick-theme.css');
	wp_enqueue_script('slick-fl-js', get_stylesheet_directory_uri() . '/slick/slick.min.js');
	wp_enqueue_script('masonry-js', get_stylesheet_directory_uri() . '/js/masonry.pkgd.min.js');
	wp_enqueue_script('tw-js', 'https://platform.twitter.com/widgets.js');
	wp_enqueue_script('theme_js', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'elegant_enqueue_css');

require get_theme_file_path( 'inc/functions.php' );
require get_theme_file_path('inc/og/OpenGraph.php');
require get_theme_file_path('inc/post_types.php');
require get_theme_file_path( 'inc/shortcodes.php' );

//creamos el post con el feed
function create_feed_post($post_id)
{
	$url = $_POST['acf']['field_5e750ea627d22'];

	if (isset($_POST['acf']['field_5e750ea627d22'])) {
		$graph = OpenGraph::fetch($url);
		update_field('imagen_nota', $graph->image, $post_id);
		update_field('titulo_nota', utf8_decode($graph->title), $post_id);
		update_field('descripcion', utf8_decode($graph->description), $post_id);
		
	}
}
add_action('acf/save_post', 'create_feed_post', 20);

// admin

add_action( 'admin_enqueue_scripts', 'load_admin_styles' );
function load_admin_styles() {
  wp_enqueue_style( 'admin_css', get_stylesheet_directory_uri() . '/css/admin.css', false, '1.0.0' );
}  


function add_footer_text_function() {
    echo '<a href="https://www.tiempoar.com.ar/seamossocios" target="_blank" id="seamos-socios">seamos socios</a>';
}
add_action( 'wp_footer', 'add_footer_text_function');