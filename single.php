<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package BirdSITE
 * @since BirdSITE 1.0
 */
get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php birdsite_content_header(); ?>

		<?php get_template_part( 'content', get_post_format() ); ?>
		<?php the_post_navigation(); ?>
		<?php comments_template( '', true ); ?>

		<?php birdsite_content_footer(); ?>
	</article>

<?php endwhile; ?>

<?php get_footer(); ?>
