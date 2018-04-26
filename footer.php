<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage BirdSITE
 * @since BirdSITE 1.0
 */
?>
			</div> <!-- /content -->
		</div><!-- /main -->
	</div> <!-- /container -->

	<footer id="footer">
		<div class="container">

			<ul class="row">
				<li><?php dynamic_sidebar( 'widget-area-footer-left' ); ?></li>
				<li><?php dynamic_sidebar( 'widget-area-footer-center' ); ?></li>
				<li><?php dynamic_sidebar( 'widget-area-footer-right' ); ?></li>
			</ul>

			<div class="site-title"><span class="home"><a href="<?php echo esc_url( home_url( '/' ) ) ; ?>"><?php bloginfo( 'name' ); ?></a></span>

				<?php if( get_theme_mod( 'birdsite_copyright', true ) ): ?>
					<?php printf(__( 'Copyright &copy; %s All Rights Reserved.', 'birdsite' ), birdsite_get_copyright_year() ); ?>
				<?php endif; ?>

				<?php if( get_theme_mod( 'birdsite_credit', true ) ): ?>
					<br>
					<span class="generator"><a href="<?php echo esc_url('http://wordpress.org/'); ?>" target="_blank"><?php _e( 'Proudly powered by WordPress', 'birdsite' ); ?></a></span>
				<?php printf(__( 'BirdSITE theme by %sSysbird%s', 'birdsite' ), '<a href="' .esc_url('https://profiles.wordpress.org/sysbird/') .'" target="_blank">', '</a>' ); ?>
				<?php endif; ?>
			</div>

		</div>
		<p id="back-top"><a href="#top"><span><?php _e( 'Go Top', 'birdsite'); ?></span></a></p>
	</footer>

</div><!-- wrapper -->

<div class="overlay"></div>

<?php wp_footer(); ?>

</body>
</html>