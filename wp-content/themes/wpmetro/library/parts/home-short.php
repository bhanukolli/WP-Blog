                    <div class="section group"><!-- section -->
                        <div class="col span_6_of_12"><!-- col -->
                            <?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 0) && ($count <= 1)) : // POST #1
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                        </div><!-- /col -->
                        <div class="col span_3_of_12"><!-- col -->
                            <?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 1) && ($count <= 2)) : // POST #2
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                        </div><!-- /col -->
                        <div class="col span_3_of_12"><!-- col -->
                            <?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 2) && ($count <= 3)) : // POST #3
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                        </div><!-- /col -->
                    </div><!-- /section -->
                    <div class="section group"><!-- section -->
                    	<div class="col span_2_of_6"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 3) && ($count <= 4)) : // POST #4
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                    	<div class="col span_2_of_6"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 4) && ($count <= 5)) : // POST #5
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                    	<div class="col span_2_of_6"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 5) && ($count <= 6)) : // POST #6
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                    </div><!-- /section -->
					<div class="section group"><!-- section -->
                    	<div class="col span_2_of_6"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 6) && ($count <= 7)) : // POST #7
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                    	<div class="col span_1_of_6"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 7) && ($count <= 8)) : // POST #6
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                        <div class="col span_1_of_6"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 8) && ($count <= 9)) : // POST #9
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                    	<div class="col span_2_of_6"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 9) && ($count <= 10)) : // POST #10
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                    </div><!-- /section -->
                    <div class="section group"><!-- section -->
                    	<div class="col span_2_of_6"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 10) && ($count <= 11)) : // POST #11
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                    	<div class="col span_1_of_6"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 11) && ($count <= 12)) : // POST #12
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                        <div class="col span_1_of_6"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 12) && ($count <= 13)) : // POST #13
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                    	<div class="col span_1_of_6"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 13) && ($count <= 14)) : // POST #14
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                        <div class="col span_1_of_6"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 14) && ($count <= 15)) : // POST #15
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                    </div><!-- /section -->
                    <div class="section group"><!-- section -->
                    	<div class="col span_3_of_12"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 15) && ($count <= 16)) : // POST #16
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                    	<div class="col span_3_of_12"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 16) && ($count <= 17)) : // POST #17
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                    	<div class="col span_3_of_12"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 17) && ($count <= 18)) : // POST #18
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                    	<div class="col span_3_of_12"><!-- col -->
							<?php 
                                if (have_posts()) : 
                                    $count = 0; 
                                    while (have_posts()) : the_post();
                                        $count++;
                                        if (($count > 18) && ($count <= 19)) : // POST #19
                                            ?>
                                            <?php get_template_part( 'library/inc/loop' ); ?>
                                            <?php
                                        else : 
                                        endif; 
                                    endwhile; 
                                else : 
                            endif;
                            ?>
                    	</div><!-- /col -->
                    </div><!-- /section -->