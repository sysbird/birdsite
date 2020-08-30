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
	<div class="container">

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

			<?php if( has_nav_menu( 'primary' )): ?>
			<button id="small-menu" type="button"><span class="icon"></span></button>
			<?php wp_nav_menu( array( 'theme_location'	=> 'primary',
					'container'			=> 'nav',
					'container_id'		=> 'menu-wrapper',
					'menu_id'			=> 'menu-primary-items',
					'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul><div class="close"><a href="#">' .__( 'Close', 'birdsite' ) .'</a>' )); ?>
			<?php endif; ?>

		</header>
		
		<div class="main">
			<div id="content">
