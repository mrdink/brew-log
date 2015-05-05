<?php

function beer_log_styles()  {

	$labels = array(
		'name'                       => _x( 'Styles', 'Taxonomy General Name', 'beer-log' ),
		'singular_name'              => _x( 'Style', 'Taxonomy Singular Name', 'beer-log' ),
		'menu_name'                  => __( 'Styles', 'beer-log' ),
		'all_items'                  => __( 'All Styles', 'beer-log' ),
		'parent_item'                => __( 'Parent Style', 'beer-log' ),
		'parent_item_colon'          => __( 'Parent Style:', 'beer-log' ),
		'new_item_name'              => __( 'New Style Name', 'beer-log' ),
		'add_new_item'               => __( 'Add New Style', 'beer-log' ),
		'edit_item'                  => __( 'Edit Style', 'beer-log' ),
		'update_item'                => __( 'Update Style', 'beer-log' ),
		'separate_items_with_commas' => __( 'Separate styles with commas', 'beer-log' ),
		'search_items'               => __( 'Search styles', 'beer-log' ),
		'add_or_remove_items'        => __( 'Add or remove styles', 'beer-log' ),
		'choose_from_most_used'      => __( 'Choose from the most used styles', 'beer-log' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'styles', 'beers', $args );

}

// Hook into the 'init' action
add_action( 'init', 'beer_log_styles', 0 );