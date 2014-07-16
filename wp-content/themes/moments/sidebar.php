
<!-- begin aside -->
<aside>

    <?php
	if(is_page()){	?>
	<!-- Page Widgets Area -->
    <?php if ( is_active_sidebar( 'pagewidget' ) ) : ?>
        <?php dynamic_sidebar( 'pagewidget' ); ?>
    <?php else : ?>
    <!-- This content shows up if there are no widgets defined in the backend. -->
        <p>
            Here you can add widgets.
            <?php if(current_user_can('edit_theme_options')) : ?><br>
            <a href="<?php echo admin_url('widgets.php')?>" class="add-widget">Add Widget</a>
            <?php endif ?>
        </p>
    <?php endif; ?>
    <!-- End Page Widgets Area -->
	<?php
	} else {
	?>
	<!-- Sidebar Widgets Area -->
    <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar' ); ?>
    <?php else : ?>
    <!-- This content shows up if there are no widgets defined in the backend. -->
        <p>
            Here you can add widgets.
            <?php if(current_user_can('edit_theme_options')) : ?><br>
            <a href="<?php echo admin_url('widgets.php')?>" class="add-widget">Add Widget</a>
            <?php endif ?>
        </p>
    <?php endif; ?>
    <!-- END Sidebar Widgets Area -->
	<?php
	}
	?>

</aside>
<!-- end aside -->