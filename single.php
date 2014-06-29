<?php 
/**
 * The Template for displaying all single blog posts
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
global $ti_option;
?>

<?php get_header(); ?>
		
    <section id="content" role="main" class="clearfix animated">

	<?php 
    if ( have_posts() ) :
      while ( have_posts() ) : the_post(); 
    ?>
           
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
        <header class="wrapper">
            
            <h1 class="single-title"><?php the_title(); ?></h1>
            
        </header>         
        
       
        <div class="wrapper">
            <div class="grids">
                <div class="grid-4">
                    <div class="single-box clearfix entry-content">
                        <?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'secondary-image'); endif; ?>
                        <?php echo custom_taxonomies_terms_links();?>
                        <?php
    						$args = array(
    							'before' => '<div class="link-pages">' . __( 'Pages:', 'themetext' ),
    							'after' => '</div>',
    							'link_before' => '<span>',
    							'link_after' => '</span>'
    						);
    						wp_link_pages( $args ); 
    					?>
                    </div>
                </div>
                <div class="grid-8">
                    <div class="single-box entry-media">
                        <?php 
                        if ( ! get_post_format() ): // Standard
                            get_template_part( 'formats/format', 'standard' );
                        elseif ( 'video' == get_post_format() ): // Video
                            get_template_part( 'formats/format', 'video' );
                        elseif ( 'audio' == get_post_format() ): // Audio
                            get_template_part( 'formats/format', 'audio' );
                        endif;
                        ?>
                    </div>   
                    <div class="single-box entry-content">             
                        <?php the_content(); ?>
                        <?php if (get_post_meta(get_the_ID(), 'ppt_file_advanced', true)) :
                            $attachment_id = get_post_meta(get_the_ID(), 'ppt_file_advanced', true);
                            $attachment_url = wp_get_attachment_url($attachment_id);
                        ?>
                        <p>
                            <a href="<?php echo $attachment_url ?>">Download PowerPoint Slide</a>
                        </p>
                        <?php endif ?>
                    </div>      
                </div>
                
                <div class="grid-12">
                                
                <?php the_tags('<div class="single-box clearfix"><div id="tags-box"><i class="icon-tag"></i>', '', '</div></div>'); ?>
                
                
                <?php 
                // Show/Hide share links
                if ( $ti_option['single_social'] == 1 ) { ?>
                <div id="social-box" class="single-box clearfix">
                    <ul>
                        <li>
                            <span><?php _e( 'Share on:', 'themetext' ); ?></span>
                        </li>
                        <li>
                            <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="blank"><?php _e( 'Facebook', 'themetext' ); ?></a>
                        </li>
                        <li>
                            <a href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&tw_p=tweetbutton&url=<?php the_permalink(); ?>&via=<?php bloginfo( 'name' ); ?>" target="_blank"><?php _e( 'Twitter', 'themetext' ); ?></a>
                        </li>
                        <li>
                            <?php $pinimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); ?>
                            <a href="//pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo $pinimage[0]; ?>&amp;description=<?php the_title(); ?>" target="_blank"><?php _e( 'Pinterest', 'themetext' ); ?></a>
                        </li>
                        <li>
                            <a href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink() ?>" target="_blank"><?php _e( 'Google +', 'themetext' ); ?></a>
                        </li>
                    </ul>
                </div><!-- social-box -->
                <?php } ?>
                
                
                <?php 
                // Show/Hide author box
                if ( $ti_option['single_author'] == 1 ) {
                    get_template_part( 'inc/author', 'box' );
                }
                ?>
                
				
                <?php  if ( $ti_option['single_nav_arrows'] == 1 ) { // Show/Hide Previous Post / Next Post Navigation ?>
				<nav class="single-box clearfix nav-single">
                    <?php
                    $prev_post = get_previous_post();
					$next_post = get_next_post();
					
                    if ( !empty( $prev_post ) ){ 
                    ?>
                    <div class="nav-previous">
                    	<?php previous_post_link ( '%link', '<i class="icon-chevron-left"></i><span class="sub-title">' . __( 'Previous article', 'themetext' ) . '</span><br />%title' ); ?>
                    </div>
                    <?php } ?>
                    
                    <?php if ( !empty( $next_post ) && !empty( $prev_post ) ) { ?>
                    
                    <?php } ?> 
                    
                    <?php
                    if ( !empty( $next_post ) ){ 
                    ?>
                    <div class="nav-next">
                        <?php next_post_link( '%link', '<i class="icon-chevron-right"></i><span class="sub-title">' . __( 'Next article', 'themetext' ) . '</span><br />%title' ); ?>
                    </div>
                    <?php } ?>
                </nav><!-- .nav-single -->
				<?php } ?>
                
                
                <?php
                // Show/Hide related posts
                if ( $ti_option['single_related'] == 1 ) {
                	get_template_part( 'inc/related', 'posts' );
                }
                ?>
                
                
                <?php comments_template(); ?>
                
                    </div><!-- .grid-12 -->
                </div><!-- .grids -->
            
            </div><!-- .wrapper -->
        </article>
              
        <?php endwhile; endif; ?>

    </section><!-- #content -->
    
    <?php
	// Show/Hide random posts slide dock
	if ( $ti_option['single_slide_dock'] == 1 ) {
		get_template_part( 'inc/slide', 'dock' );
	}
	?>
    
<?php get_footer(); ?>