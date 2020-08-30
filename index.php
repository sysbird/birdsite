<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage BirdSITE
 * @since BirdSITE 1.0
 */
get_header(); ?>

<ul class="row">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; ?>
</ul>

<?php the_posts_pagination( array( 'mid_size' => 3 ) ); ?>

<?php get_footer(); ?>
