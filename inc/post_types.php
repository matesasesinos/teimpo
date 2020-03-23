<?php
function cptui_register_my_taxes_feed_tag() {

	/**
	 * Taxonomy: Feeds Tags.
	 */

	$labels = [
		"name" => __( "Feeds Tags", "custom-post-type-ui" ),
		"singular_name" => __( "Feed Tag", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Feeds Tags", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'feed_tag', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "feed_tag",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "feed_tag", [ "notas" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_feed_tag' );


function cptui_register_my_cpts_notas() {

	/**
	 * Post Type: Feeds Web.
	 */

	$labels = [
		"name" => __( "Feeds Web", "custom-post-type-ui" ),
		"singular_name" => __( "Feed Web", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Feeds Web", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "notas", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title" ],
		"taxonomies" => [ "feed_tag" ],
	];

	register_post_type( "notas", $args );
}

add_action( 'init', 'cptui_register_my_cpts_notas' );
