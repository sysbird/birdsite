<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage birdSITE
 * @since birdSITE 1.0
 */
get_header(); ?>

<article class="hentry">
	<?php birdsite_content_header(); ?>

	<header class="entry-header">
		<h1 class="entry-title"><?php _e(' Error 404 - Not Found', 'birdsite' ); ?></h1>
	</header>

	<div class="entry-content">
		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'birdsite' ); ?></p>
		<div class="widget">
		<?php get_search_form(); ?>
		</div>
	</div>

	<?php birdsite_content_footer(); ?>
</article>

<?php get_footer(); ?>
