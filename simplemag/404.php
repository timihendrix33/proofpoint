<?php 
/**
 * 404 error page
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/ 
?>

<?php get_header(); ?>
	
    <section id="content" role="main" class="clearfix animated">
    
    	<div class="wrapper">
    
            <article id="post-0" class="post error404 not-found">
                <h1>ANASDFASDKFLHASLDKFJHA</h1>
            	<?php if( $ti_option['error_image'] !='' ){ ?>
                    <img src="<?php echo $ti_option['error_image']; ?>" alt="<?php echo $ti_option['error_text']; ?>" width="400" height="400" />
                <?php } ?>
                <h1><?php echo $ti_option['error_title']; ?></h1>
                
            </article><!-- #post-0 .post .error404 .not-found -->
        
    	</div>
        
    </section><!-- #content -->
<section class="home-section latest-posts">
                    
    <header class="section-header">
        <h2 class="title"><span>Latest Posts on Proofpoint</span></h2>

    </header>
    
    
    <?php
    /** 
     * Latest Posts with paging
    **/
    $posts_to_show = get_sub_field( 'latest_posts_per_page' );
    $paged = 1;
    if ( get_query_var('paged') ) $paged = get_query_var('paged');
    if ( get_query_var('page') ) $paged = get_query_var('page');
    $wp_query = new WP_Query(
        array(
            'post_type' => 'post',
            'posts_per_page' => $posts_to_show,
            'paged' => $paged
        )
    );
    ?>

    <?php 
    // Enable/Disable sidebar based on the field selection         
    if ( get_sub_field ( 'latest_posts_sidebar' ) == 'sidebar_on' ) {
    ?>

    <div class="grids">
    
        <div class="grid-8 column">
            
            <div class="grids <?php the_sub_field( 'latest_posts_layout' ); ?> entries">
                
                <?php
                if ( $wp_query->have_posts() ) :
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
                
                    get_template_part( 'content', 'post' );
                    
                endwhile; 
                ?>
                
             </div>
             
             <?php if ( get_sub_field ( 'latest_pagination' ) == 'pagination_on' ){ ?>
             <div class="pagination">
                <?php ti_pagination(); ?>
             </div>
             <?php } ?>
            
             <?php else: ?>
             
                <p class="grid-12 message">
                    <?php _e( 'Sorry, no posts were found', 'themetext' ); ?>
                </p>
                
             <?php endif; ?>
                    
             
         </div>
        
        <?php wp_reset_query(); ?>
        
        <div class="grid-4 column">
            <?php get_sidebar(); ?>
        </div>
        
    </div>
    
    <?php } else { ?>

        <div class="grids <?php the_sub_field( 'latest_posts_layout' ); ?> entries">
        
            <?php 
            if ( $wp_query->have_posts() ) :
            while ( $wp_query->have_posts() ) : $wp_query->the_post();
            
                get_template_part( 'content', 'post' );
                
            endwhile; 
            ?>
         </div>  
          
         <?php 
         if ( get_sub_field ( 'latest_pagination' ) == 'pagination_on' ) {
            ti_pagination();
         }
         ?>
               
         <?php else: ?>
         
            <p class="grid-12 message">
                <?php _e( 'Sorry, no posts were found', 'themetext' ); ?>
            </p>
            
         <?php endif; ?>
            
        <?php wp_reset_query(); ?>
    
    <?php } ?>
    
</section><!-- Latest Posts -->    
	
<?php get_footer(); ?>