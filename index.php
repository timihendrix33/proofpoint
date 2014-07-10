<?php
/**
 * The main template file
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
?>

<?php get_header(); ?>
	
    <section id="content" role="main" class="clearfix animated">
    <?php if (!is_paged()) : ?>
      <div class="promo">
        <div class="promo-content">
          <?php
          $the_query = new WP_Query( 'page_id=7' );
          while ( $the_query->have_posts() ) :
            $the_query->the_post();
                  the_content();
          endwhile;
          wp_reset_postdata();
          ?>
        </div>
        <a href="javascript:;" class="get-started">
           <img src="wp-content/themes/simplemag-child/images/down-arrow.png" />
        </a>
      </div>
    <?php endif; ?>

    	<div class="wrapper">
        <div class="previous-section-indicator"></div>
			<?php
            // Enable/Disable sidebar based on the field selection
            if ( get_field( 'page_sidebar' ) == 'page_sidebar_on'):
            ?>
            <div class="grids">
                <div class="grid-8">
                <?php endif; ?>
                
                    <div class="grids masonry-layout entries">
                    <?php 
                    if ( have_posts() ) :
                    while ( have_posts()) : the_post();
                    
                        get_template_part( 'content', 'post' );
                    
                    endwhile; ?>
                    </div>
                    
                    	<?php ti_pagination(); ?>
                        
                    <?php else : ?>
                    
                    	<p class="grid-12 message"><?php _e( 'Sorry, no posts were found', 'themetext' ); ?></p>
                    
                    <?php endif;?>
                
                <?php
                // Enable/Disable sidebar based on the field selection
                if ( get_field( 'page_sidebar' ) == 'page_sidebar_on'):
                ?>
                </div><!-- .grid-8 -->
            
                <div class="grid-4">
                    <?php get_sidebar(); ?>
                </div>
            </div><!-- .grids -->
            <?php endif; ?>
    
		</div>
    </section><!-- #content -->
    
<?php get_footer(); ?>