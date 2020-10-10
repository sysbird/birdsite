<?php
/**
 * The template for displaying image attachments
 *
 * @package BirdSITE
 * @since BirdSITE 1.0
 */
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php birdsite_content_header(); ?>

		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content">

			<div class="entry-attachment">
				<div class="attachment">
<?php
	$birdite_attachment_url = wp_get_attachment_image_src( get_the_ID(), 'full' );
	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $birdite_attachment_url[0] ),
		wp_get_attachment_image( $post->ID, 'large' )
	);
?>

<?php if ( has_excerpt() ) : ?>
	<div class="wp-caption">
		<?php the_excerpt(); ?>
	</div>
<?php endif; ?>
				</div>
			</div>

			<?php the_content(); ?>
		</div>

		<footer class="entry-meta">
			<div class="icon postdate"><time datetime="<?php echo get_the_time('Y-m-d') ?>" pubdate><?php echo get_post_time(get_option('date_format')); ?></time></div>

			<div class="icon author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></div>

			<?php if( $post->post_parent ): ?>
				<div class="icon parent-post-link"><a href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a></div>
			<?php endif; ?>
		</footer>

		<?php comments_template(); ?>

		<?php birdsite_content_footer(); ?>
	</article>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
