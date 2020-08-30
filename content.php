<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage BirdSITE
 * @since BirdSITE 1.0
 */
?>

<?php if ( is_home() ) : /* Display Excerpts for Home */ ?>

	<li id="post-<?php the_ID(); ?>" <?php post_class( ); ?>>
		<?php the_post_thumbnail( 'birdsite' ); ?>
		<div class="caption">
			<header class="entry-header">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'birdsite' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</header><!-- .entry-header -->

			<footer class="entry-meta">
				<?php if( get_theme_mod( 'birdsite_home_postdate', true ) ): ?>
					<div class="icon postdate"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'birdsite' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><time datetime="<?php echo get_the_time( 'Y-m-d' ) ?>" pubdate><?php echo get_post_time( get_option( 'date_format' ) ); ?></time></a></div>
				<?php endif; ?>

				<?php if( get_theme_mod( 'birdsite_home_author', true ) ): ?>
					<div class="icon author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></div>
				<?php endif; ?>

				<?php if( get_theme_mod( 'birdsite_home_category', true ) ): ?>
					<div class="icon category"><?php the_category( ', ' ) ?></div>
				<?php endif; ?>

				<?php if( get_theme_mod( 'birdsite_home_tags', true ) ): ?>
					<?php the_tags( '<div class="icon tag">', ', ', '</div>' ) ?>
				<?php endif; ?>

				<?php if ( comments_open() && get_theme_mod( 'birdsite_home_comment_number', true ) ) : ?>
					<div class="icon comment"><?php comments_popup_link( __( 'No Comments', 'birdsite' ), __( '1 Comment', 'birdsite' ), __( '% Comments', 'birdsite' ), '', __( 'Comments Closed', 'birdsite' ) ); ?></div>
				<?php endif; ?>
			</footer><!-- .entry-meta -->

			<div class="more-link"><a href="<?php the_permalink(); ?>"><?php _e( 'more', 'birdsite' ); ?></a></div>
		</div>
		<?php if( is_sticky() ): ?>
			<i></i>
		<?php endif; ?>
	</li><!-- #post -->

<?php elseif( is_singular() ): // Display Excerpts for Single/Page ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array(
			'before'		=> '<div class="page-link">' . __( 'Pages:', 'birdsite' ),
			'after'		=> '</div>',
			'link_before'	=> '<span>',
			'link_after'	=> '</span>'
			) ); ?>
	</div>

	<?php if(is_single()): // Only Display Excerpts for Single ?>
		<footer class="entry-meta">

			<div class="icon postdate"><time datetime="<?php echo get_the_time( 'Y-m-d' ) ?>" pubdate><?php echo get_post_time( get_option( 'date_format' ) ); ?></time></div>

			<div class="icon author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></div>

			<div class="icon category"><?php the_category( ', ' ) ?></div>
			<?php the_tags( '<div class="icon tag">', ', ', '</div>' ) ?>

		</footer>
	<?php endif; ?>

<?php else: // Display Excerpts for Archive/Search ?>

	<li id="post-<?php the_ID(); ?>" <?php post_class( ); ?>>
		<?php the_post_thumbnail( 'thumbnail' ); ?>
		<a href="<?php the_permalink() ?>" rel="bookmark"><div class="entry-title"><?php the_title(); ?></div><div class="postdate"><time datetime="<?php echo get_the_time( 'Y-m-d' ) ?>" pubdate><?php echo get_post_time( get_option( 'date_format' ) ); ?></time></div></a>
	</li>
<?php endif; ?>
