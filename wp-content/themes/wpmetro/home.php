<?php get_header(); query_posts( 'posts_per_page=-1' ); // HEADER ?>
	<div id="maincontentcontainer">
		<div id="maincontent">
        <?php // HOMEPAGE CONFIGURATIONS
				if ( mytheme_option( 'layout_config' ) && mytheme_option( 'layout_config' ) == 'choice1' ) { // IF SHORT LAYOUT
					get_template_part( 'library/parts/home', 'short' ); 
				} else {
				} 
				if ( mytheme_option( 'layout_config' ) && mytheme_option( 'layout_config' ) == 'choice2' ) { // IF MEDIUM LAYOUT
					get_template_part( 'library/parts/home', 'short' ); 
					get_template_part( 'library/parts/home', 'medium' ); 
				} else {
				} 
				if ( mytheme_option( 'layout_config' ) && mytheme_option( 'layout_config' ) == 'choice3' ) { // IF LONG LAYOUT
					get_template_part( 'library/parts/home', 'short' ); 
					get_template_part( 'library/parts/home', 'medium' );
					get_template_part( 'library/parts/home', 'long' ); 
				} else {
				} 
				if ( mytheme_option( 'layout_config' ) && mytheme_option( 'layout_config' ) == 'choice4' ) { // IF SUPER LAYOUT
					get_template_part( 'library/parts/home', 'short' ); 
					get_template_part( 'library/parts/home', 'medium' );
					get_template_part( 'library/parts/home', 'long' ); 
					get_template_part( 'library/parts/home', 'super' ); 
				} else {
				} 
             ?>
		</div>
	</div>
<?php get_footer(); // FOOTER ?>