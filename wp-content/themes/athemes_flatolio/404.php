<?php get_header(); // HEADER ?>
    <div id="innercontentcontainer">
    	<div id="innercontent">
    		<div class="section group">
    			<div class="col span_2_of_3 trans unlimited">
    				<h1><?php _e( 'Page Not Found', 'wpblink_flatolio' ); ?></h1>
    				<h3><?php _e( '404 Error', 'wpblink_flatolio' ); ?></h3>
    				<div class="contentstyle">
    					<p><?php _e( 'The page you were trying to reach has either been renamed or moved to a new location. This is usually the result of a bad or outdated link.', 'wpblink_flatolio' ); ?></p>
    					<p><?php _e( 'We apologize for any inconvenience this may have caused you.', 'wpblink_flatolio' ); ?></p>
    				</div>
    			</div>
    			<div class="col span_1_of_3 trans unlimited">
    				<?php widget_post(); // SIDEBAR WIDGETS ?>
    			</div>
    		</div>
    	</div>
    </div>
<?php get_footer(); // FOOTER ?>