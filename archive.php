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
		<h1 class="entry-title"><?php
			if( is_category() ) {
				printf( __( 'Category Archives: %s', 'birdsite' ), single_cat_title(' ', false ) );
			}
			elseif( is_tag() ) {
				printf( __( 'Tag Archives: %s', 'birdsite' ), single_tag_title(' ', false ) );
			}
			elseif ( is_day() ) {
				printf( __( 'Daily Archives: %s', 'birdsite' ), get_post_time( get_option( 'date_format' ) ) );
			}
			elseif ( is_month() ) {
				printf( __( 'Monthly Archives: %s', 'birdsite' ), get_post_time( __('F, Y', 'birdsite' ) ) );
			}
			elseif ( is_year() ) {
				printf( __( 'Yearly Archives: %s', 'birdsite' ), get_post_time( __( 'Y', 'birdsite' ) ) );
			}
			elseif ( is_author() ) {
				printf( __( 'Author Archives: %s', 'birdsite' ), get_the_author_meta( 'display_name', get_query_var( 'author' ) ) );
			}
			elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) {
				_e( 'Blog Archives', 'birdsite' );
			}
		?></h1>
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
