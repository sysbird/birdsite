<?php
/**
 * The template functions and definitions
 *
 * @package WordPress
 * @subpackage BirdSITE
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

	register_sidebar( array (
		'name'			=> __( 'Widget Area for footer left', 'birdsite' ),
		'id'			=> 'widget-area-footer-left',
		'description'		=> __( 'Widget Area for footer left', 'birdsite' ),
		'before_widget'	=> '<div class="widget">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h3>',
		'after_title'		=> '</h3>',
		) );

	register_sidebar( array (
		'name'			=> __( 'Widget Area for footer center', 'birdsite' ),
		'id'			=> 'widget-area-footer-center',
		'description'		=> __( 'Widget Area for footer center', 'birdsite' ),
		'before_widget'	=> '<div class="widget">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h3>',
		'after_title'		=> '</h3>',
		) );

	register_sidebar( array (
		'name'			=> __( 'Widget Area for footer right', 'birdsite' ),
		'id'			=> 'widget-area-footer-right',
		'description'		=> __( 'Widget Area for footer right', 'birdsite' ),
		'before_widget'	=> '<div class="widget">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h3>',
		'after_title'		=> '</h3>',
		) );
}
add_action( 'widgets_init', 'birdsite_widgets_init' );

//////////////////////////////////////////////////////
// Pagenation
function birdsite_the_pagenation() {

	global $wp_query, $paged;
	$birdsite_big = 999999999;

	$birdsite_pages = $wp_query -> max_num_pages;
	if ( empty( $paged ) ) $paged = 1;

	if ( 1 < $birdsite_pages ) {
		echo '	<div class="tablenav">' ."\n";
		echo paginate_links( array(
			'base'		=> str_replace( $birdsite_big, '%#%', get_pagenum_link( $birdsite_big ) ),
			'format'		=> '?paged=%#%',
			'current'	=> max( 1, get_query_var( 'paged' ) ),
			'total'		=> $wp_query -> max_num_pages,
			'mid_size'	=> 3,
			'prev_text'	=> __( 'Previous', 'birdsite' ),
			'next_text'	=> __( 'Next', 'birdsite' )
			) );
		echo '</div>' ."\n";;
	}
}

//////////////////////////////////////////////////////
// Copyright Year
function birdsite_get_copyright_year() {

	$birdsite_copyright_year = date( "Y" );

	$birdsite_first_year = $birdsite_copyright_year;
	$args = array(
		'numberposts'	=> 1,
		'orderby'	=> 'post_date',
		'order'		=> 'ASC',
	);
	$posts = get_posts( $args );

	foreach ( $posts as $post ) {
		$birdsite_first_year = mysql2date( 'Y', $post->post_date, true );
	}

	if( $birdsite_copyright_year <> $birdsite_first_year ){
		$birdsite_copyright_year = $birdsite_first_year .' - ' .$birdsite_copyright_year;
	}

	return $birdsite_copyright_year;
}

//////////////////////////////////////////////////////
// Header Style
function birdsite_header_style() {

?>

<style type="text/css">

<?php
	//Theme Option
	$text_color = esc_attr( get_theme_mod( 'birdsite_text_color', '#555' ) );
	$link_color = esc_attr( get_theme_mod( 'birdsite_link_color', '#06A' ) );
	$footer_color = esc_attr( get_theme_mod( 'birdsite_footer_color', '#000' ) );
	$navigation_color = esc_attr( get_theme_mod( 'birdsite_navigation_color', '#555') );

	if ( 'blank' == get_header_textcolor() ) {
		?>
		#header.no-image #menu-wrapper .menu {
			margin-top: 0;
		}

	<?php } else { ?>
		#header .branding .site-title,
		#header .branding .site-title a,
		#header .branding .site-description,
		#header p {
			color: #<?php header_textcolor();?>;
			}
		<?php } ?>

	.wrapper,
	#content .hentry .entry-header .entry-title,
	#content .hentry .entry-header .entry-title a,
	#content .hentry .entry-meta a,
	.archive #content ul li a,
	.search #content ul li a,
	.error404 #content ul li a {
		color: <?php echo $text_color; ?>;
	}

	a,
	#content .tablenav,
	#content .tablenav a.page-numbers,
	#content .hentry .page-link,
	#content .hentry .page-link a span {
		color: <?php echo $link_color; ?>;
	}

	#content .tablenav a.page-numbers,
	#content .tablenav span.current,
	#content .hentry .page-link span {
		border-color: <?php echo $link_color; ?>;
	}

	#content .tablenav span.current,
	#content .hentry .page-link span {
		background: <?php echo $link_color; ?>;
	}

	.wrapper,
	.widget #wp-calendar th,
	.widget #wp-calendar td {
		border-color: <?php echo $footer_color; ?>;
	}

	#footer,
	.home #content ul.row li.sticky i {
		background-color: <?php echo $footer_color; ?>;
	}

	h1, h2, h3, h4, h5, h6,
	.widget #wp-calendar tbody th a,
	.widget #wp-calendar tbody td a {
		color: <?php echo $footer_color; ?>;
	}

	#menu-wrapper .menu,
	#menu-wrapper .menu ul li a {
		color: <?php echo $navigation_color; ?>;
	}

	#menu-wrapper .menu ul li ul,
	#menu-wrapper .menu ul li,
	#menu-wrapper .menu ul li a,
	#menu-wrapper .menu #small-menu {
		border-color: <?php echo $navigation_color; ?>;
	}

	@media screen and (max-width: 600px) {
		#menu-wrapper .menu #small-menu,
		#menu-wrapper .menu ul#menu-primary-items {
			background-color: <?php echo $navigation_color; ?>;
		}
	}

</style>

<?php

}

//////////////////////////////////////////////////////
// Setup Theme
function birdsite_setup() {

	// Set languages
	load_theme_textdomain( 'birdsite', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Set feed
	add_theme_support( 'automatic-feed-links' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

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
		'default-color' => 'F5F5F5',
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Navigation Menu', 'birdsite' ),
	) );

	// Add support for title tag.
	add_theme_support( 'title-tag' );

	// Add support for custom headers.
	add_theme_support( 'custom-header', array(
		'default-text-color'		=> '000',
		'default-image'			=> '',
		'height'				=> 300,
		'width'				=> 600,
		'max-width'			=> 600,
		'random-default'		=> true,
		'wp-head-callback'		=> 'birdsite_header_style',
	) );

	register_default_headers( array(
			'blue'		=> array(
			'url'		=> '%s/images/headers/blue.jpg',
			'thumbnail_url'	=> '%s/images/headers/blue-thumbnail.jpg',
			'description'	=> 'blue'
		),
		'yellow' => array(
			'url'		=> '%s/images/headers/yellow.jpg',
			'thumbnail_url'	=> '%s/images/headers/yellow-thumbnail.jpg',
			'description'	=> 'yellow'
		),
		'pink' => array(
			'url'		=> '%s/images/headers/pink.jpg',
			'thumbnail_url'	=> '%s/images/headers/pink-thumbnail.jpg',
			'description'	=> 'pink'
		),
		'navy' => array(
			'url'		=> '%s/images/headers/navy.jpg',
			'thumbnail_url'	=> '%s/images/headers/navy-thumbnail.jpg',
			'description'	=> 'navy'
		),
		'red' => array(
			'url'		=> '%s/images/headers/red.jpg',
			'thumbnail_url'	=> '%s/images/headers/red-thumbnail.jpg',
			'description'	=> 'red'
		),
		'green' => array(
			'url'		=> '%s/images/headers/green.jpg',
			'thumbnail_url'	=> '%s/images/headers/green-thumbnail.jpg',
			'description'	=> 'green'
		),
	) );
}
add_action( 'after_setup_theme', 'birdsite_setup' );

//////////////////////////////////////////////////////
// Document Title
function birdsite_title( $title ) {
	global $page, $paged;

	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title .= ' | ' . sprintf( __( 'Page %s', 'birdsite' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'birdsite_title' );

//////////////////////////////////////////////////////
// Title Tag Backwards Compatibility
function birdsite_slug_render_title() {
	?><title><?php wp_title( '|', true, 'right' ); ?></title><?php
}

//////////////////////////////////////////////////////
// Enqueue Acripts
function birdsite_scripts() {

	if ( is_singular() && comments_open() && get_option('thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'birdsite', get_template_directory_uri() .'/js/birdsite.js', array( 'jquery' ), '1.08' );
	wp_enqueue_style( 'birdsite', get_stylesheet_uri() );

	if ( strtoupper( get_locale() ) == 'JA' ) {
		wp_enqueue_style( 'birdsite_ja', get_template_directory_uri() .'/css/ja.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'birdsite_scripts' );

//////////////////////////////////////////////////////
// Theme Customizer
function birdsite_customize( $wp_customize ) {

	// Text Color
	$wp_customize->add_setting( 'birdsite_text_color', array(
		'default'		=> '#555',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdsite_text_color', array(
		'label'		=> __( 'Text Color', 'birdsite' ),
		'section'	=> 'colors',
		'settings'	=> 'birdsite_text_color',
	) ) );

	// Link Color
	$wp_customize->add_setting( 'birdsite_link_color', array(
		'default'		=> '#06A',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdsite_link_color', array(
		'label'		=> __( 'Link Color', 'birdsite' ),
		'section'	=> 'colors',
		'settings'	=> 'birdsite_link_color',
	) ) );

	// Header, Footer Color
	$wp_customize->add_setting( 'birdsite_footer_color', array(
		'default'		=> '#000',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdsite_footer_color', array(
		'label'		=> __( 'Header, Footer Color', 'birdsite' ),
		'section'	=> 'colors',
		'settings'	=> 'birdsite_footer_color',
	) ) );

	// Navigation Text Color
	$wp_customize->add_setting( 'birdsite_navigation_color', array(
		'default'		=> '#555',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdsite_navigation_color', array(
		'label'		=> __( 'Navigation Text Color', 'birdsite' ),
		'section'	=> 'colors',
		'settings'	=> 'birdsite_navigation_color',
	) ) );

	// Home Section
	$wp_customize->add_section( 'birdsite_home', array(
		'title'		=> __( 'Home', 'birdsite' ),
		'priority'	=> 999,
	) );

	// Display Date
	$wp_customize->add_setting( 'birdsite_home_postdate', array(
		'default'		=> true,
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
		'default'		=> true,
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
		'default'		=> true,
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
		'default'		=> true,
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
		'default'		=> true,
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
