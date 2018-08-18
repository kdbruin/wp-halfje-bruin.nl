<?php

function hb_gridsby_theme_setup()
{
    add_theme_support( 'post-formats', array( 'image', 'quote' ) );
}
add_action( 'after_setup_theme', 'hb_gridsby_theme_setup', 20 );

function hb_gridsby_enqueue_scripts()
{
    // 500px script
    wp_enqueue_script( '500px', 'https://500px.com/embed.js' );
}

function hb_gridsby_enqueue_styles()
{
    wp_enqueue_style( 'gridsby-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'hb-gridsby-style', get_stylesheet_directory_uri() . '/style.css', array( 'gridsby-style' ) );
}

add_action( 'wp_enqueue_scripts', 'hb_gridsby_enqueue_scripts' );
add_action( 'wp_enqueue_scripts', 'hb_gridsby_enqueue_styles' );

/**
 * Remove this filter!
 */
remove_filter( 'pre_get_posts', 'gridsby_posts_cat_gallery' );

/**
 * Ascending order on Series acrhive pages.
 */
//add_action( 'pre_get_posts', 'hb_reverse_post_order' );
function hb_reverse_post_order( $query )
{
	if ( is_admin() )
		return;
	if ( $query->is_main_query() && is_archive() && is_tax( 'series' ) )
	{
		$query->set( 'posts_per_page', '2' );
		$query->set( 'orderby', 'date' );
		$query->set( 'order', 'ASC' );
	}
}

/**
 * Other stuff
 */
require_once( get_stylesheet_directory() . '/inc/series.php' );

