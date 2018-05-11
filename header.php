<?php
/**
 * The template for displaying the header
 *
 * @package WordPress
 * @subpackage BirdSITE
 * @since BirdSITE 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" >
<meta name="viewport" content="width=device-width" >
<link rel="profile" href="http://gmpg.org/xfn/11" >
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" >
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="wrapper">
	<div class="container drawer drawer--left">

<?php
	// The header image
	$birdsite_image_tag = '';
	if(	!has_header_image()){
		$birdsite_image_tag = 'no-image';
	}

	// The header text
	if ( !display_header_text()) {
		$birdsite_image_tag .= ' no-title';
	}

	if( $birdsite_image_tag ){
		 $birdsite_image_tag = 'class="' . $birdsite_image_tag .'"';
	}
?>

		<header id="header" <?php echo $birdsite_image_tag; ?>>
			<div class="branding">
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</<?php echo $heading_tag; ?>>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div>

			<?php if ( has_header_image()) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-image"><img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" ></a>
			<?php endif; ?>

			<nav id="menu-wrapper">
				<button type="button" id="small-menu" class="drawer-toggle drawer-hamburger">
					<span class="sr-only">toggle navigation</span>
					<span class="drawer-hamburger-icon"></span>
				</button>

				<?php wp_nav_menu( array( 'theme_location'	=> 'primary',
								'container_class'	=> 'menu',
								'menu_class'		=> '',
								'menu_id'			=> 'menu-primary-items',
								'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'fallback_cb'		=> '' ) ); ?>
			</nav>
		</header>

		<div class="main">
			<div id="content">
