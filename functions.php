<?php
/*
BirdSITE functions and definitions.
*/
//////////////////////////////////////////
// Set the content width based on the theme's design and stylesheet.
function birdsite_content_width() {
	global $content_width;
	$content_width = 630;
}
add_action( 'template_redirect', 'birdsite_content_width' );

//////////////////////////////////////////
// Set Widgets
function birdsite_widgets_init() {

	register_sidebar( array (
		'name' => __( 'Widget Area for footer left', 'birdsite' ),
		'id' => 'widget-area-footer-left',
		'description' => __( 'Widget Area for footer left', 'birdsite' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );

	register_sidebar( array (
		'name' => __( 'Widget Area for footer center', 'birdsite' ),
		'id' => 'widget-area-footer-center',
		'description' => __( 'Widget Area for footer center', 'birdsite' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );

	register_sidebar( array (
		'name' => __( 'Widget Area for footer right', 'birdsite' ),
		'id' => 'widget-area-footer-right',
		'description' => __( 'Widget Area for footer right', 'birdsite' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );
}
add_action( 'widgets_init', 'birdsite_widgets_init' );

//////////////////////////////////////////
// SinglePage Comment callback
function birdsite_custom_comments( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

	<?php if( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ):
		$birstips_url    = get_comment_author_url();
		$birstips_author = get_comment_author();
	 ?> 

		<div class="posted"><strong><?php _e( 'Pingback', 'birdsite' ); ?> : </strong><a href="<?php echo $birstips_url; ?>" target="_blank" class="web"><?php echo $birstips_author ?></a><?php edit_comment_link( __('(Edit)', 'birdsite'), ' ' ); ?></div>

	<?php else: ?>

		<div class="comment_meta">
			<?php echo get_avatar( $comment, 40 ); ?>
			<span class="author"><?php comment_author(); ?></span>
			<span class="postdate"><?php echo get_comment_time(get_option('date_format') .' ' .get_option('time_format')); ?></span><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'birdsite' ); ?></em><br>
		<?php endif; ?>

		<div class="comment_text">
			<?php comment_text(); ?>

			<?php $birdsite_web = get_comment_author_url(); ?>
			<?php if( !empty( $birdsite_web ) ): ?>
				<p class="web"><a href="<?php echo $birdsite_web; ?>" target="_blank"><?php echo $birdsite_web; ?></a></p>
			<?php endif; ?>
		</div>

	<?php endif; ?>
<?php
	// no "</li>" conform WORDPRESS
}

//////////////////////////////////////////////////////
// Pagenation
function birdsite_the_pagenation() {

	global $wp_query, $paged;
	$birdsite_big = 999999999;

	$birdsite_pages = $wp_query -> max_num_pages;
	if ( empty( $paged ) ) $paged = 1;

	if ( 1 < $birdsite_pages ) {
		echo paginate_links( array(
			'base'      => str_replace( $birdsite_big, '%#%', get_pagenum_link( $birdsite_big ) ),
			'format'    => '?paged=%#%',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query -> max_num_pages,
			'mid_size'  => 3,
			'prev_text'    => __( 'Previous', 'birdsite' ),
			'next_text'    => __( 'Next', 'birdsite' )
			) );
	}
}

//////////////////////////////////////////////////////
// Copyright Year
function birdsite_get_copyright_year() {

	$birdsite_copyright_year = date("Y");

	$birdsite_first_year = $birdsite_copyright_year;
	$args = array(
		'numberposts' => 1,
		'orderby'     => 'post_date',
		'order'       => 'ASC',
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

	if ( 'blank' == get_header_textcolor() ) { ?>
		#header .site-title,
		#header .site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
			}   
		#header .branding {
			padding: 0;
			}

		#header.no-image .branding {
			margin-bottom: 0;
		}

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
	#content .hentry .page-link,
	#content .tablenav,
	#content .tablenav a.page-numbers {
		color: <?php echo $link_color; ?>;
	}

	#content .hentry .page-link a,
	#content .tablenav a.page-numbers,
	#content .tablenav .current {
		border-color: <?php echo $link_color; ?>;
	}

	#content .tablenav .current {
		background-color: <?php echo $link_color; ?>;
	}

	.wrapper,
	.widget #wp-calendar th,
	.widget #wp-calendar td {
		border-color: <?php echo $footer_color; ?>;
	}

	#footer {
		background-color: <?php echo $footer_color; ?>;
	}

	h1, h2, h3, h4, h5, h6,
	#menu-wrapper .menu #small-menu {
		color: <?php echo $footer_color; ?>;
	}

	#content table th {
		background-color: <?php echo $footer_color; ?>;
	}

	#menu-wrapper .menu,
	#menu-wrapper .menu ul li a {
	    color: <?php echo $navigation_color; ?>;
	}

	#menu-wrapper .menu ul li ul,
	#menu-wrapper .menu ul li {
		border-color: <?php echo $navigation_color; ?>;
	}

	@media screen and (max-width: 600px) {
		#menu-wrapper .menu ul#menu-primary-items {
			background-color: <?php echo $navigation_color; ?>;
		}
	}

</style>

<?php 

}

//////////////////////////////////////////////////////
// Admin Header Style
function birdsite_admin_header_style() {
?>

<style type="text/css">

	#birdsite_header {
		font-family: Georgia, "Bitstream Charter", serif;
	}

	#birdsite_header img {
		width: 240px;
		height: 120px;
		}

	#birdsite_header #site-title {
		margin: 0;
		padding: 0;
		color: #<?php header_textcolor();?>;
		font-size: 3em;
		line-height: 1;
		}

	#birdsite_header #site-title a {
		color: #<?php header_textcolor();?>;
	    font-weight: bold;
	    text-decoration: none;
		}

	#birdsite_header #site-description {
		color: #<?php header_textcolor();?>;
		margin: 0.5em 0;
		}

</style>

<?php

} 

//////////////////////////////////////////////////////
// Admin Header Image
function birdsite_admin_header_image() {

	$header_image = get_header_image();
	$birdsite_image_tag = '';
	if ( empty( $header_image ) ){
		$birdsite_image_tag = ' class="no-image"'; 
	}

	$style = '';
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) ){
		$style = ' style="display:none;"';
	}
?>
	<div id="birdsite_header"<?php echo $birdsite_image_tag; ?>>

		<div id="site-title"><a <?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></div>
		<div id="site-description" <?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>

<?php
	$header_image = get_header_image();
	if ( ! empty( $header_image ) ) : ?>

		<img src="<?php echo esc_url( $header_image ); ?>" alt="" />

	<?php endif; ?>

	</div>
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
		'default-color' => 'f9f9ef',
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Navigation Menu', 'birdsite' ),
	) );

	// Add support for custom headers.
	$custom_header_support = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '000',
		'default-image'          => '',

		// Set height and width, with a maximum value for the width.
		'height'                 => 300,
		'width'                  => 600,
		'max-width'              => 600,

		// Random image rotation off by default.
		'random-default'         => true,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback' => 'birdsite_header_style',
		'admin-head-callback' => 'birdsite_admin_header_style',
		'admin-preview-callback' => 'birdsite_admin_header_image'
	);

	register_default_headers( array(
		'blue' => array(
			'url' => '%s/images/headers/blue.jpg',
			'thumbnail_url' => '%s/images/headers/blue-thumbnail.jpg',
			'description' => 'blue'
		),
		'yellow' => array(
			'url' => '%s/images/headers/yellow.jpg',
			'thumbnail_url' => '%s/images/headers/yellow-thumbnail.jpg',
			'description' => 'yellow'
		),
		'pink' => array(
			'url' => '%s/images/headers/pink.jpg',
			'thumbnail_url' => '%s/images/headers/pink-thumbnail.jpg',
			'description' => 'pink'
		),
		'navy' => array(
			'url' => '%s/images/headers/navy.jpg',
			'thumbnail_url' => '%s/images/headers/navy-thumbnail.jpg',
			'description' => 'navy'
		),
		'red' => array(
			'url' => '%s/images/headers/red.jpg',
			'thumbnail_url' => '%s/images/headers/red-thumbnail.jpg',
			'description' => 'red'
		),
		'green' => array(
			'url' => '%s/images/headers/green.jpg',
			'thumbnail_url' => '%s/images/headers/green-thumbnail.jpg',
			'description' => 'green'
		),
	) );

	add_theme_support( 'custom-header', $custom_header_support );
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
// Enqueue Acripts
function birdsite_scripts() {

	if ( is_singular() && comments_open() && get_option('thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('jquery');  
	wp_enqueue_script( 'birdsite', get_template_directory_uri() .'/js/birdsite.js', 'jquery', '1.06' );
	wp_enqueue_style( 'birdsite', get_stylesheet_uri() );

	if ( strtoupper( get_locale() ) == 'JA' ) {
		wp_enqueue_style( 'birdsite_ja', get_template_directory_uri().'/css/ja.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'birdsite_scripts' );

//////////////////////////////////////////////////////
// Theme Customizer
function birdsite_customize($wp_customize) {
 
	$wp_customize->add_section( 'birdsite_customize', array(
		'title'=> __( 'Theme Options', 'birdsite' ),
		'priority' => 999,
	) );

	// Text Color
	$wp_customize->add_setting( 'birdsite_text_color', array(
		'default' => '#555',
		'sanitize_callback' => 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdsite_text_color', array(
		'label' => __( 'Text Color', 'birdsite' ),
		'section'=> 'birdsite_customize',
		'settings' => 'birdsite_text_color',
	) ) );

	// Link Color
	$wp_customize->add_setting( 'birdsite_link_color', array(
		'default' => '#06A',
		'sanitize_callback' => 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdsite_link_color', array(
		'label' => __( 'Link Color', 'birdsite' ),
		'section'=> 'birdsite_customize',
		'settings' => 'birdsite_link_color',
	) ) );

	// Header, Footer Color
	$wp_customize->add_setting( 'birdsite_footer_color', array(
		'default' => '#000',
		'sanitize_callback' => 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdsite_footer_color', array(
		'label' => __( 'Header, Footer Color', 'birdsite' ),
		'section'=> 'birdsite_customize',
		'settings' => 'birdsite_footer_color',
	) ) );

	// Navigation Text Color
	$wp_customize->add_setting( 'birdsite_navigation_color', array(
		'default' => '#555',
		'sanitize_callback' => 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdsite_navigation_color', array(
		'label' => __( 'Navigation Text Color', 'birdsite' ),
		'section'=> 'birdsite_customize',
		'settings' => 'birdsite_navigation_color',
	) ) );

	// Display Copyright
	$wp_customize->add_setting( 'birdsite_copyright', array(
		'default'  => true,
		'sanitize_callback' => 'birdsite_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'birdsite_copyright', array(
		'label'		=> __( 'Display Copyright', 'birdsite' ),
		'section'  => 'birdsite_customize',
		'type'     => 'checkbox',
		'settings' => 'birdsite_copyright',
	) );

	// Display Credit
	$wp_customize->add_setting( 'birdsite_credit', array(
		'default'  => true,
		'sanitize_callback' => 'birdsite_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'birdsite_credit', array(
		'label'		=> __( 'Display Credit', 'birdsite' ),
		'section'  => 'birdsite_customize',
		'type'     => 'checkbox',
		'settings' => 'birdsite_credit',
	) );
}
add_action( 'customize_register', 'birdsite_customize' );

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
// Santize a checkbox
function birdsite_sanitize_checkbox( $input ) {

	if ( $input == true ) {
		return true;
	} else {
		return false;
	}
}
