<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage BirdSITE
 * @since BirdSITE 1.0
 */
get_header(); ?>

<ul id="thumbnails" class="row">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; ?>
</ul>
<?php birdsite_the_pagenation(); ?>

<?php get_footer(); ?>
