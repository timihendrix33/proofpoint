<?php 
/**
 * Template Name: Bookmarks
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.1
**/
?>

<?php get_header(); ?>

	<section id="content" role="main" class="clearfix animated">
    	<div class="wrapper">
        	
            <header class="entry-header">
                <h1 class="entry-title page-title">
					<span><?php wp_title( "", true ); ?></span>
                </h1>
            </header>

			<?php
			// Enable/Disable sidebar based on the field selection
			if ( ! get_field( 'page_sidebar' ) || get_field( 'page_sidebar' ) == 'page_sidebar_on' ):
			?>
            <div class="grids">
                <div class="grid-8">
            <?php endif; ?>
<!-- START WPFP CODE -->


                <?php
                    $wpfp_before = "";
                    echo "<div class='wpfp-span'>";
                    if (!empty($user)) {
                        if (wpfp_is_user_favlist_public($user)) {
                            $wpfp_before = "$user's Favorite Posts.";
                        } else {
                            $wpfp_before = "$user's list is not public.";
                        }
                    }

                    if ($wpfp_before):
                        echo '<div class="wpfp-page-before">'.$wpfp_before.'</div>';
                    endif;

                    echo "<ul>";
                    if ($favorite_post_ids) {
                        $favorite_post_ids = array_reverse($favorite_post_ids);
                        $post_per_page = wpfp_get_option("post_per_page");
                        $page = intval(get_query_var('paged'));

                        $qry = array('post__in' => $favorite_post_ids, 'posts_per_page'=> $post_per_page, 'orderby' => 'post__in', 'paged' => $page);
                        // custom post type support can easily be added with a line of code like below.
                        // $qry['post_type'] = array('post','page');
                        query_posts($qry);

                        while ( have_posts() ) : the_post();
                            echo "<li><a href='".get_permalink()."' title='". get_the_title() ."'>" . get_the_title() . "</a> ";
                            wpfp_remove_favorite_link(get_the_ID());
                            echo "</li>";
                            ?>
                            <article style="background-image: url(<?php echo $src[0]; ?> ) !important;" <?php post_class("grid-6"); ?>>            
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
                                        <div class="bookmark">
                                            <?php wpfp_link() ?>
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


                            <?php
                        endwhile;

                        echo '<div class="navigation">';
                            if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                            <div class="alignleft"><?php next_posts_link( __( '&larr; Previous Entries', 'buddypress' ) ) ?></div>
                            <div class="alignright"><?php previous_posts_link( __( 'Next Entries &rarr;', 'buddypress' ) ) ?></div>
                            <?php }
                        echo '</div>';

                        wp_reset_query();
                    } else {
                        $wpfp_options = wpfp_get_options();
                        echo "<li>";
                        echo $wpfp_options['favorites_empty'];
                        echo "</li>";
                    }
                    echo "</ul>";

                    echo '<p>'.wpfp_clear_list_link().'</p>';
                    echo "</div>";
                    wpfp_cookie_warning();

                    ?>
            		
<!-- END WPFP CODE -->
            	</div>
            </div>

        </div>
    </section><!-- #content -->

<?php get_footer(); ?>            