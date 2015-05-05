<?php
/*
Plugin Name: Brew Log
Version: 0.1-alpha
Description: WordPress plugin to keep track of homebrewing
Author: Justin Peacock
Author URI: http://byjust.in
Plugin URI: https://github.com/mrdink/brew-log
Text Domain: brew-log
Domain Path: /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require plugin_dir_path( __FILE__ ) . 'includes/beers.php';
require plugin_dir_path( __FILE__ ) . 'includes/styles.php';
require plugin_dir_path( __FILE__ ) . 'includes/shortcodes.php';

/**
 * Include post and page templates
 */
add_filter( 'template_include', 'brew_log_templates' );
function brew_log_templates( $template ) {
    $post_types = array( 'beers' );
    if ( is_singular( $post_types ) && ! file_exists( get_stylesheet_directory() . '/single-beers.php' ) )
	    $template = plugin_dir_path( __FILE__ ) . 'includes/templates/single-beers.php';
	  return $template;
}

/**
 * Admin Styling
 */
function brew_log_styles() {
	wp_deregister_style( 'brew-log-font-awesome' );
	wp_register_style( 'brew-log-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', false, '4.3.0' );
	wp_enqueue_style( 'brew-log-font-awesome' );
}
add_action( 'admin_enqueue_scripts', 'brew_log_styles' );

function brew_log_admin_icons() { ?>
	<style type="text/css" media="screen">
		#adminmenu #menu-posts-beers div.wp-menu-image:before {
			font-family: "FontAwesome";
			content: "\f0fc";
		}
	</style>
<?php

}
add_action( 'admin_head', 'brew_log_admin_icons' );