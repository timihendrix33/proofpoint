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

    	<div class="wrapper <?php if (!is_paged()) {echo 'first-page';}?>">

          <div class="entry-header">
            <h1 class="entry-title page-title">Latest Posts</h1>            
          </div>

        <!-- <div class="previous-section-indicator"></div> -->
			<?php
            // Enable/Disable sidebar based on the field selection
            if ( get_field( 'page_sidebar' ) == 'page_sidebar_on'):
            ?>
            <div class="grids">
                <div class="grid-8">
                <?php endif; ?>
                <div class="export clearfix">
                     <div class="posts-per-page">
                            <p>Items per page:
                            <!-- In order to stay on the page number when changing the posts per page, add this to the href: . array_shift(explode('?',$_SERVER["REQUEST_URI"])) -->
                            <!-- Watch out though, it causes a 404 when you're further than the number of pages there are with a high number of posts per page -->
                              <a class="<?php if($wp_query->query['posts_per_page'] == 15){echo 'current-posts-per-page';}?>" href="http://<?php echo $_SERVER["HTTP_HOST"] ?>?posts_per_page=15">15</a>
                              <a class="<?php if($wp_query->query['posts_per_page'] == 30 || $wp_query->query['posts_per_page'] == ''){echo 'current-posts-per-page';}?>" href="http://<?php echo $_SERVER["HTTP_HOST"] ?>?posts_per_page=30">30</a>
                              <a class="<?php if($wp_query->query['posts_per_page'] == 50){echo 'current-posts-per-page';}?>" href="http://<?php echo $_SERVER["HTTP_HOST"] ?>?posts_per_page=50">50</a>
                            </p>
                    </div>    
                    <?php ti_pagination(); ?>      
                </div>          
                    <div class="grids masonry-layout entries">
                      <div class="infinite-wrapper">
                        <?php 
                        if ( have_posts() ) :
                        while ( have_posts()) : the_post();
                        
                            get_template_part( 'content', 'post' );
                        
                        endwhile; ?>
                      </div>
                    </div>
                    
                    	<?php ti_pagination(); ?>

<!--                     <div class="pagination">
                      <div class="page-numbers">
                        <a href="<?php get_pagenum_link($page + 1) ?>" class="next">More Posts</a>
                      </div>
                    </div> -->
                        
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