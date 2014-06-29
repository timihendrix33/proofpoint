<?php
/**
 * Content
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.1
**/
global $ti_option;
?>
<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) ); ?>  
<article style="background-image: url(<?php echo $src[0]; ?> ) !important;" <?php post_class("grid-6"); ?>>

<!--     <figure class="entry-image">

        <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) ); ?>    
    	<a style="background-image: url(<?php echo $src[0]; ?> ) !important;" href="<?php the_permalink(); ?>">



			<?php
			if ( has_post_thumbnail() ) { // Set Featured Image
				if ( get_sub_field ( 'latest_posts_layout' ) == 'classic-layout' || get_field ( 'category_posts_layout', 'category_' . get_query_var('cat') ) == 'classic-layout' ) {
            		the_post_thumbnail( 'medium-size' );
				} else {
					the_post_thumbnail( 'masonry-size' );
				}
            } elseif( first_post_image() ) { // Set the first image from the editor
            	echo '<img src="' . first_post_image() . '" class="wp-post-image" />';
           	}
			
            // Add icon to different post formats
            if ( 'gallery' == get_post_format() ): // Gallery
                echo '<i class="icon-camera-retro"></i>';
            elseif ( 'video' == get_post_format() ): // Video
                echo '<i class="icon-camera"></i>';
            elseif ( 'audio' == get_post_format() ): // Audio
                echo '<i class="icon-music"></i>';
            endif;
            ?> 
    	</a>
    </figure> -->
    <div class="blur-image" style="background-image: url(<?php echo $src[0]; ?> ) !important;"></div>   
    <div class="post-info"> 
        <header class="entry-header">
            <a href="<?php the_permalink() ?>">
                <h2 class="entry-title">
                    <?php the_title(); ?>
                </h2>
            </a>
            <div class="entry-meta">
               <span class="entry-category">
                    <?php
                        if ( is_front_page() ) {
                            $category = get_the_category(); 
                            echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
                        } else {
                            the_category(', ');
                        }
                    ?>
                </span>
                <br />
               <!-- <span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span> -->
            </div>
            <?php if( $ti_option['site_author_name'] == 1 ) { ?>
            <span class="entry-author">
            	<?php _e( 'By','themetext' ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author"><?php the_author_meta( 'display_name' ); ?></a>
            </span>
            <?php } ?>
        </header>
    	    
        <?php if( $ti_option['site_wide_excerpt'] == 1 ) { // Enable/Disable the excerpt site wide ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>
        <?php } ?>
    </div>
</article>