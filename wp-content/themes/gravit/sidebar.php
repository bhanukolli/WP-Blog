<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package gravit
 */
?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
	<div class="sidebar">
		<div id="secondary" role="complementary">
			<div class="widget-area">
				<?php do_action( 'before_sidebar' ); ?>

				<?php dynamic_sidebar( 'sidebar-1' ); ?>
				
			</div>
		</div><!-- #secondary -->
	</div><!-- .sidebar -->
<?php } // end sidebar widget area ?>