<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage BirdSITE
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

	$post                = get_post();
	$attachment_size     = apply_filters( 'birdsite', 'large' );
	$next_attachment_url = wp_get_attachment_url();
	$attachment_ids = get_posts( array(
		'post_parent'		=> $post->post_parent,
		'fields'			=> 'ids',
		'numberposts'		=> -1,
		'post_status'		=> 'inherit',
		'post_type'		=> 'attachment',
		'post_mime_type'	=> 'image',
		'order'			=> 'ASC',
		'orderby' 		=> 'menu_order ID',
	) );

	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
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
			<?php wp_link_pages( array(
				'before'		=> '<div class="page-links">' . __( 'Pages:', 'birdsite' ),
				'after'		=> '</div>',
				'link_before'	=> '<span>',
				'link_after'	=> '</span>'
				) ); ?>
		</div>

		<footer class="entry-meta">
			<div class="icon postdate"><time datetime="<?php echo get_the_time('Y-m-d') ?>" pubdate><?php echo get_post_time(get_option('date_format')); ?></time></div>

			<div class="icon author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></div>

			<div class="icon parent-post-link"><a href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a></div>
		</footer>

		<?php comments_template(); ?>

		<nav id="nav-below">
			<span class="nav-previous"><?php next_image_link( false, __( 'Next Image' , 'birdsite' )); ?></span>
			<span class="nav-next"><?php previous_image_link( false, __( 'Previous Image' , 'birdsite' ) ); ?></span>
		</nav>

		<?php birdsite_content_footer(); ?>
	</article>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
