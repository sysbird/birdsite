<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage BirdSITE
 * @since BirdSITE 1.0
 */
get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php get_template_part( 'content', get_post_format() ); ?>
		<?php comments_template( '', true ); ?>

		<?php the_post_navigation(); ?>

	</article>

<?php endwhile; ?>

<?php get_footer(); ?>
