<?php
/**
 * The template functions and definitions
 *
 * @package BirdSITE
 * @since BirdSITE 1.0
 */
//////////////////////////////////////////
// Set the content width based on the theme's design and stylesheet.
function birdsite_content_width() {
	global $content_width;
	$content_width = 720;
}
add_action( 'template_redirect', 'birdsite_content_width' );

//////////////////////////////////////////
// Set Widgets
function birdsite_widgets_init() {

	// Widget Area for footer first column
	register_sidebar( array (
		'name'			=> __( 'Widget Area for footer first column', 'birdsite' ),
		'id'			=> 'widget-area-footer-left',
		'description'	=> __( 'Widget Area for footer first column', 'birdsite' ),
		'before_widget'	=> '<div class="widget">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h3>',
		'after_title'	=> '</h3>',
		) );

	// Widget Area for footer center column
	register_sidebar( array (
		'name'			=> __( 'Widget Area for footer center column', 'birdsite' ),
		'id'			=> 'widget-area-footer-center',
		'description'	=> __( 'Widget Area for footer center column', 'birdsite' ),
		'before_widget'	=> '<div class="widget">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h3>',
		'after_title'	=> '</h3>',
		) );

	// Widget Area for footer last column
	register_sidebar( array (
		'name'			=> __( 'Widget Area for footer last column', 'birdsite' ),
		'id'			=> 'widget-area-footer-right',
		'description'	=> __( 'Widget Area for footer last column', 'birdsite' ),
		'before_widget'	=> '<div class="widget">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h3>',
		'after_title'	=> '</h3>',
		) );
}
add_action( 'widgets_init', 'birdsite_widgets_init' );

//////////////////////////////////////////////////////
// Copyright Year
function birdsite_get_copyright_year() {

	$birdsite_copyright_year = date( "Y" );

	$birdsite_first_year = $birdsite_copyright_year;
	$args = array(
		'numberposts'	=> 1,
		'post_status'	=> 'publish',
		'orderby'		=> 'post_date',
		'order'			=> 'ASC',
	);
	$posts = get_posts( $args );
	if ( $posts ) {
		foreach ( $posts as $post ) {
			$birdsite_first_year = mysql2date( 'Y', $post->post_date, true );
		}
		wp_reset_postdata();
	}

	if( $birdsite_copyright_year <> $birdsite_first_year ){
		$birdsite_copyright_year = $birdsite_first_year .' - ' .$birdsite_copyright_year;
	}

	return $birdsite_copyright_year;
}

//////////////////////////////////////////////////////
// Get default colors
function birdsite_get_default_colors() {
	return array(
			'main_color'		=> '#000000',
			'text_color'		=> '#555555',
			'link_color'		=> '#0066AA',
			'header_color'		=> '#F5F5F5' );
}

//////////////////////////////////////////////////////
// Enqueues front-end CSS for the Theme Customizer.
function birdsite_custom_style() {

	// default color
	$birdsite_default_colors = birdsite_get_default_colors();

	// Custom Text Color
	$birdsite_text_color =  esc_attr( get_theme_mod( 'birdsite_text_color', $birdsite_default_colors[ 'text_color' ] ));
	if( strcasecmp( $birdsite_text_color, $birdsite_default_colors[ 'text_color' ] )) {
		$birdsite_css = "
			/* Custom Text Color */
			.wrapper,
			#content .hentry .entry-header .entry-title,
			#content .hentry .entry-header .entry-title a,
			.archive #content ul li a,
			.search #content ul li a,
			.error404 #content ul li a {
				color: {$birdsite_text_color};
			}

			#content .hentry .entry-header .entry-title {
				border-color: {$birdsite_text_color};
			}
			";

		wp_add_inline_style( 'birdsite', $birdsite_css );
	}

	// Custom Link Color
	$birdsite_link_color =  esc_attr( get_theme_mod( 'birdsite_link_color', $birdsite_default_colors[ 'link_color' ] ));
	if( strcasecmp( $birdsite_link_color, $birdsite_default_colors[ 'link_color' ] )) {
		$birdsite_css = "
			/* Custom Link Color */
			a,
			.page-link,
			.pagination,
			.pagination a.page-numbers,
			.page-link a span {
				color: {$birdsite_link_color};
			}

			.pagination a.page-numbers,
			.pagination span.current,
			.page-link a,
			.page-link span {
				border-color: {$birdsite_link_color};
			}

			.pagination span.current,
			#content .hentry .page-link > span {
				background: {$birdsite_link_color};
			}
		";

		wp_add_inline_style( 'birdsite', $birdsite_css );
	}

	// Custom Header Color
	$birdsite_header_color = esc_attr( get_theme_mod( 'birdsite_header_color', $birdsite_default_colors[ 'header_color' ] ));
	if( strcasecmp( $birdsite_header_color, $birdsite_default_colors[ 'header_color' ] )) {
		$birdsite_css = "
			/* Custom Header Color */
			#header,
			#menu-wrapper,
			#menu-wrapper ul#menu-primary-items li ul,
			#content .hentry .entry-meta {
				background: {$birdsite_header_color};
			}
		";
				wp_add_inline_style( 'birdsite', $birdsite_css );
	}

	// Custom Main Color
	$birdsite_main_color = esc_attr( get_theme_mod( 'birdsite_footer_color', $birdsite_default_colors[ 'main_color' ] ));
	if( strcasecmp( $birdsite_main_color, $birdsite_default_colors[ 'main_color' ] )) {
		$birdsite_css = "
			/* Custom Main Color */
			h1, h2, h3, h4, h5, h6,
			#header .branding .site-title,
			#header .branding .site-title a,
			#header .branding .site-description,
			.widget #wp-calendar tbody th a,
			.widget #wp-calendar tbody td a,
			.widget #wp-calendar a,
			#menu-wrapper,
			#menu-wrapper ul#menu-primary-items li a,
			#menu-wrapper .close a,
			#searchform #searchsubmit,
			#content .hentry .entry-meta,
			#content .hentry .entry-meta a,
			#content .hentry .entry-meta .icon:before,
			#content .wp-block-separator.is-style-dots,
			#content .wp-block-pullquote.is-style-dots,
			#content .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color),
			#content .wp-block-button.is-style-outline .wp-block-button__link:focus:not(.has-text-color),
			#content .wp-block-button.is-style-outline .wp-block-button__link:active:not(.has-text-color),
			.wp-block-calendar table caption,
			.wp-block-calendar table tbody {
				color: {$birdsite_main_color};
			}

			#content h2,
			#content h3,
			#content .wp-block-separator,
			#content .wp-block-pullquote,
			blockquote,
			.wp-block-quote,
			#menu-wrapper ul#menu-primary-items li ul,
			#menu-wrapper ul#menu-primary-items li a,
			#searchform,
			#menu-wrapper .close a {
				border-color: {$birdsite_main_color};
			}

			#small-menu .icon,
			#small-menu .icon:before,
			#small-menu .icon:after,
			#footer,
			#content .wp-block-button a.wp-block-button__link:not(.has-background),
			#content .wp-block-file .wp-block-file__button,
			input[type='submit'],
			button[type='submit'] {
				background-color: {$birdsite_main_color};
			}
		";

		wp_add_inline_style( 'birdsite', $birdsite_css );
	}

	// Site Title
	if ( !display_header_text()) {
		$birdsite_css = "
			#header.no-image #menu-wrapper .menu {
				margin-top: 0;
			}
		";

		wp_add_inline_style( 'birdsite', $birdsite_css );
	}
}
add_action( 'wp_enqueue_scripts', 'birdsite_custom_style', 11 );

//////////////////////////////////////////////////////
// Setup Theme
function birdsite_setup() {

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor-style.css' );

	// Set feed
	add_theme_support( 'automatic-feed-links' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-image'		=> '',
		'default-color'		=> 'FFF',
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Navigation Menu', 'birdsite' ),
	) );

	// Add support for title tag.
	add_theme_support( 'title-tag' );

	// Add support for custom headers.
	add_theme_support( 'custom-header', array(
		'default-text-color'	=> '000',
		'default-image'			=> '',
		'height'				=> 300,
		'width'					=> 600,
		'max-width'				=> 600,
		'random-default'		=> true,
	) );

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add support for responsive embeds.
    add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'birdsite_setup' );

//////////////////////////////////////////////////////
// Enqueue Scripts
function birdsite_scripts() {

	if ( is_singular() && comments_open() && get_option('thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Google Fonts
	wp_enqueue_style( 'setos-google-font', '//fonts.googleapis.com/css?family=Open+Sans', false, null, 'all' );
	
	// this theme
	wp_enqueue_script( 'birdsite', get_template_directory_uri() .'/js/birdsite.js', array( 'jquery' ), '1.14' );
	wp_enqueue_style( 'birdsite', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'birdsite_scripts' );

//////////////////////////////////////////////////////
// Enqueue Scripts for Dashboard
function birdsite_admin_enqueue_scripts() {
	wp_enqueue_style( 'setos-google-font', '//fonts.googleapis.com/css?family=Open+Sans', false, null, 'all' );
}
add_action( 'admin_enqueue_scripts', 'birdsite_admin_enqueue_scripts' );

//////////////////////////////////////////////////////
// Theme Customizer
function birdsite_customize( $wp_customize ) {

	// remove customize default header textcolor
	$wp_customize->remove_control( 'header_textcolor' );

	// defaut theme colors
	$birdsite_default_colors = birdsite_get_default_colors();

	// Text Color
	$wp_customize->add_setting( 'birdsite_text_color', array(
		'default'		=> $birdsite_default_colors[ 'text_color' ],
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdsite_text_color', array(
		'label'		=> __( 'Text Color', 'birdsite' ),
		'section'	=> 'colors',
		'settings'	=> 'birdsite_text_color',
	) ) );

	// Link Color
	$wp_customize->add_setting( 'birdsite_link_color', array(
		'default'		=> $birdsite_default_colors[ 'link_color' ],
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdsite_link_color', array(
		'label'		=> __( 'Link Color', 'birdsite' ),
		'section'	=> 'colors',
		'settings'	=> 'birdsite_link_color',
	) ) );

	// header background Color
	$wp_customize->add_setting( 'birdsite_header_color', array(
		'default'		=> $birdsite_default_colors[ 'header_color' ],
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdsite_header_color', array(
		'label'			=> __( 'Header Color', 'birdsite' ),
		'section'		=> 'colors',
		'settings'		=> 'birdsite_header_color',
	) ) );

	// Main Color ( site title, menu color, heading text in single page and footer background color )
	$wp_customize->add_setting( 'birdsite_footer_color', array(
		'default'		=> $birdsite_default_colors[ 'main_color' ],
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdsite_footer_color', array(
		'label'			=> __( 'Accent Color', 'birdsite' ),
		'description'	=> __( 'Used for site title, menu color, heading text in single page and footer background color.', 'birdsite' ),
		'section'		=> 'colors',
		'settings'		=> 'birdsite_footer_color',
	) ) );

	// Home Section
	$wp_customize->add_section( 'birdsite_home', array(
		'title'		=> __( 'Home', 'birdsite' ),
		'description'	=> __( 'Items to display with mouse hover in homepage thumbnails.', 'birdsite' ),
		'priority'	=> 999,
	) );

	// Display Date
	$wp_customize->add_setting( 'birdsite_home_postdate', array(
		'default'			=> true,
		'sanitize_callback'	=> 'birdsite_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'birdsite_home_postdate', array(
		'label'		=> __( 'Display Postate', 'birdsite' ),
		'section'	=> 'birdsite_home',
		'type'		=> 'checkbox',
		'settings'	=> 'birdsite_home_postdate',
	) );

	// Display Author
	$wp_customize->add_setting( 'birdsite_home_author', array(
		'default'			=> true,
		'sanitize_callback'	=> 'birdsite_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'birdsite_home_author', array(
		'label'		=> __( 'Display Author', 'birdsite' ),
		'section'	=> 'birdsite_home',
		'type'		=> 'checkbox',
		'settings'	=> 'birdsite_home_author',
	) );

	// Display Category
	$wp_customize->add_setting( 'birdsite_home_category', array(
		'default'			=> true,
		'sanitize_callback'	=> 'birdsite_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'birdsite_home_category', array(
		'label'		=> __( 'Display Category', 'birdsite' ),
		'section'	=> 'birdsite_home',
		'type'		=> 'checkbox',
		'settings'	=> 'birdsite_home_category',
	) );

	// Display Tags
	$wp_customize->add_setting( 'birdsite_home_tags', array(
		'default'			=> true,
		'sanitize_callback'	=> 'birdsite_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'birdsite_home_tags', array(
		'label'		=> __( 'Display Tags', 'birdsite' ),
		'section'	=> 'birdsite_home',
		'type'		=> 'checkbox',
		'settings'	=> 'birdsite_home_tags',
	) );

	// Display Comment Number
	$wp_customize->add_setting( 'birdsite_home_comment_number', array(
		'default'		=> true,
		'sanitize_callback'	=> 'birdsite_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'birdsite_home_comment_number', array(
		'label'		=> __( 'Display Comment Number', 'birdsite' ),
		'section'	=> 'birdsite_home',
		'type'		=> 'checkbox',
		'settings'	=> 'birdsite_home_comment_number',
	) );

	// Footer Section
	$wp_customize->add_section( 'birdsite_footer', array(
		'title'		=> __( 'Footer', 'birdsite' ),
		'description'	=> __( 'Items to display in footer.', 'birdsite' ),
		'priority'	=> 999,
	) );

	// Display Copyright
	$wp_customize->add_setting( 'birdsite_copyright', array(
		'default'		=> true,
		'sanitize_callback'	=> 'birdsite_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'birdsite_copyright', array(
		'label'		=> __( 'Display Copyright', 'birdsite' ),
		'section'	=> 'birdsite_footer',
		'type'		=> 'checkbox',
		'settings'	=> 'birdsite_copyright',
	) );

	// Display Credit
	$wp_customize->add_setting( 'birdsite_credit', array(
		'default'			=> true,
		'sanitize_callback'	=> 'birdsite_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'birdsite_credit', array(
		'label'		=> __( 'Display Credit', 'birdsite' ),
		'section'	=> 'birdsite_footer',
		'type'		=> 'checkbox',
		'settings'	=> 'birdsite_credit',
	) );
}
add_action( 'customize_register', 'birdsite_customize' );

//////////////////////////////////////////////////////
// Santize a checkbox
function birdsite_sanitize_checkbox( $input ) {

	if ( $input == true ) {
		return true;
	} else {
		return false;
	}
}

//////////////////////////////////////////////////////
// Removing the default gallery style
function birdsite_gallery_atts( $out, $pairs, $atts ) {

	$atts = shortcode_atts( array( 'size' => 'medium', ), $atts );
	$out['size'] = $atts['size'];

	return $out;
}
add_filter( 'shortcode_atts_gallery', 'birdsite_gallery_atts', 10, 3 );
add_filter( 'use_default_gallery_style', '__return_false' );

//////////////////////////////////////////////////////
// Display the Featured Image at home
function birdsite_post_image_html( $html, $post_id, $post_image_id, $size, $attr ) {

	if( !( false === strpos( $size, 'birdsite' )) && $post_image_id ){

		$birdsite_thumbnail_size = 300;
		$birdsite_thumbnail_width = $birdsite_thumbnail_size;
		$birdsite_thumbnail_height = $birdsite_thumbnail_size;

		$birdsite_thumbnail_attr = wp_get_attachment_metadata( $post_image_id );
		if( $birdsite_thumbnail_attr['width'] > $birdsite_thumbnail_attr['height'] ){
			// Horizontal Thumbnail
			$birdsite_thumbnail_width = intval( ( $birdsite_thumbnail_attr['width'] / $birdsite_thumbnail_attr['height'] ) * $birdsite_thumbnail_height );
		}
		else{
			// Vertical Thumbnail
			$birdsite_thumbnail_height = intval( ( $birdsite_thumbnail_attr['height'] / $birdsite_thumbnail_attr['width'] ) * $birdsite_thumbnail_width );
		}

		$birdsite_thumbnail_top = intval( ( $birdsite_thumbnail_size - $birdsite_thumbnail_height ) /2 );
		$birdsite_thumbnail_left = intval( ( $birdsite_thumbnail_size - $birdsite_thumbnail_width ) /2 );

		$birdsite_thumbnail_style = 'width: ' .$birdsite_thumbnail_width .'px; height: ' .$birdsite_thumbnail_height .'px; left: ' .$birdsite_thumbnail_left .'px; top: ' .$birdsite_thumbnail_top .'px;';

		$html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
		$html = preg_replace('/<img/', '<img style="'. $birdsite_thumbnail_style .'"', $html );
		$html = '<div class="thumbnail">' .$html .'<div class="more-link"><a href="' .get_permalink() .'">' .__( 'more', 'birdsite' ) .'</a></div></div>';
	}

	return $html;
}
add_filter( 'post_thumbnail_html', 'birdsite_post_image_html', 10, 5 );

//////////////////////////////////////////////////////
// Add hook content begin
function birdsite_content_header() {
	$birdsite_html = apply_filters( 'birdsite_content_header', '' );
	echo $birdsite_html;
}

//////////////////////////////////////////////////////
// Add hook content end
function birdsite_content_footer() {
	$birdsite_html = apply_filters( 'birdsite_content_footer', '' );
	echo $birdsite_html;
}