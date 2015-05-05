<?php

function beer_init() {
	register_post_type( 'beers', array(
		'labels'            => array(
			'name'                => __( 'Beers', 'brew-log' ),
			'singular_name'       => __( 'Beer', 'brew-log' ),
			'all_items'           => __( 'Beers', 'brew-log' ),
			'new_item'            => __( 'New beer', 'brew-log' ),
			'add_new'             => __( 'Add New', 'brew-log' ),
			'add_new_item'        => __( 'Add New beer', 'brew-log' ),
			'edit_item'           => __( 'Edit beer', 'brew-log' ),
			'view_item'           => __( 'View beer', 'brew-log' ),
			'search_items'        => __( 'Search beers', 'brew-log' ),
			'not_found'           => __( 'No beers found', 'brew-log' ),
			'not_found_in_trash'  => __( 'No beers found in trash', 'brew-log' ),
			'parent_item_colon'   => __( 'Parent beer', 'brew-log' ),
			'menu_name'           => __( 'Beers', 'brew-log' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true
	) );

}
add_action( 'init', 'beer_init' );

function beer_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['beer'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Beer updated. <a target="_blank" href="%s">View beer</a>', 'brew-log'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'brew-log'),
		3 => __('Custom field deleted.', 'brew-log'),
		4 => __('Beer updated.', 'brew-log'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Beer restored to revision from %s', 'brew-log'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Beer published. <a href="%s">View beer</a>', 'brew-log'), esc_url( $permalink ) ),
		7 => __('Beer saved.', 'brew-log'),
		8 => sprintf( __('Beer submitted. <a target="_blank" href="%s">Preview beer</a>', 'brew-log'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Beer scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview beer</a>', 'brew-log'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Beer draft updated. <a target="_blank" href="%s">Preview beer</a>', 'brew-log'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'beer_updated_messages' );
