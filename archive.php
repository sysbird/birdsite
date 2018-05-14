<?php
/**
 * The template for displaying archive pages
 *
 * @package WordPress
 * @subpackage birdSITE
 * @since birdSITE 1.0
 */
get_header(); ?>

<article class="hentry">
	<?php birdsite_content_header(); ?>

	<header class="entry-header">
		<?php
			the_archive_title( '<h1 class="entry-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
	</header>

	<?php if ( have_posts() ) : ?>

		<ul>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		</ul>

		<?php the_posts_pagination( array( 'mid_size' => 3, ) ); ?>

	<?php else: ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.', 'birdsite' ); ?></p>
	<?php endif; ?>

	<?php birdsite_content_footer(); ?>
</article>

<?php get_footer(); ?>
