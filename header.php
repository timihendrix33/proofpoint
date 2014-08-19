<?php
/**
 * The Header for the theme
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.4
**/
global $ti_option; // Fetch options stored in $ti_option;
?><!DOCTYPE html>
<!--[if lt IE 9]><html <?php language_attributes(); ?> class="oldie"><![endif]-->
<!--[if (gte IE 9) | !(IE)]><!--><html <?php language_attributes(); ?> class="modern"><!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php
	if( ! is_home() ):
	  wp_title( '|', true, 'right' );
	endif;
	bloginfo( 'name' );
  ?></title>

<!-- Always force latest IE rendering engine & Chrome Frame -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<!-- Meta Viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php 
// Get the favicon
if ( $ti_option['site_favicon'] != '' ) { 
	$site_favicon = $ti_option['site_favicon'];
} else { 
	$site_favicon = get_template_directory_uri() . '/images/favicon.ico';
}
?>
<link rel="shortcut icon" href="<?php echo $site_favicon; ?>" />
<?php 
// Get the retina favicon
if ( $ti_option['site_retina_favicon'] != '' ) { 
	$retina_favicon = $ti_option['site_retina_favicon'];
} else { 
	$retina_favicon = get_template_directory_uri() . '/images/retina-favicon.png';
}
?>
<link rel="apple-touch-icon-precomposed" href="<?php echo $retina_favicon; ?>" />

<?php wp_head(); ?>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
</head>

<?php 
if ( is_page() ) { $page_slug = 'page-'.$post->post_name; } else { $page_slug = ''; }
if ( get_field( 'page_sidebar' ) == 'page_sidebar_on' || get_field('category_slider', 'category_' . get_query_var('cat') ) == 'cat_slider_on' && get_field('category_slider_position', 'category_' . get_query_var('cat') ) == 'cat_slider_above' && get_field( 'category_sidebar', 'category_' . get_query_var('cat') ) == 'cat_sidebar_on' ) { $with_sidebar = 'with-sidebar'; } else { $with_sidebar = ''; } ?>
<body <?php body_class( $with_sidebar, $page_slug ); ?>>

<div id="outer-wrap">
    <div id="inner-wrap">

    <header id="masthead" role="banner" class="clearfix">
        
		<div class="top-strip <?php echo $ti_option['site_top_strip_color']; if ( $ti_option['site_top_strip'] == 0 ) { echo ' hide-strip'; } ?>">
            <div class="wrapper clearfix">
            	
                <div class="nav-container">
                    
                    <?php 
    				// Social Profiles
    				if( $ti_option['top_social_profiles'] == 1 ) {
    					get_template_part ( 'inc/social', 'profiles' ); 
    				}
    				?>
                    
                    <a id="open-pageslide" href="#pageslide">
                        <?php
                            if (is_category() || is_single()){
                              $cat = get_category_by_path(get_query_var('category_name'),false);
                              $current = $cat->cat_ID;
                              $current_name = $cat->cat_name;
                                echo '<span>' . $current_name . '<i class="fa fa-angle-down"></i></span>';
                                //echo '<img src="'. get_template_directory_uri() . '/images/' . $current_name . '.png" alt="' . $current . '" />  ';

                            } else {
                                echo ("<span>Categories <i class='fa fa-angle-down'></i></span>");
                            }
                        ?>        
                        <i class="fa fa-bars fa-2"></i>
                    </a>
                    <?php
                    // Main Menu
                    if ( has_nav_menu( 'main_menu' ) ) :
                        wp_nav_menu( array (
                            'theme_location' => 'main_menu',
                            'container' => 'nav',
                            'container_class' => 'main-menu-new',
                            'menu_id' => 'main-nav',
                            'depth' => 2,
                            'fallback_cb' => false,
                            'walker' => new TI_Menu()
                         ));
                    endif;
                    ?> 
                            

                    <?php get_search_form(); ?>       
                    
                    <?php
                    // Pages Menu
    				if ( has_nav_menu( 'secondary_menu' ) ) :
    					wp_nav_menu( array (
    						'theme_location' => 'secondary_menu',
    						'container' => 'nav',
    						'container_class' => 'secondary-menu',
    						'menu_id' => 'secondary-nav',
    						'depth' => 2,
    						'fallback_cb' => false
    					 ));
    				 else:
    					echo '<div class="alignleft no-margin message warning"><i class="icon-warning-sign"></i>' . __( 'Define your site secondary menu', 'themetext' ) . '</div>';
    				 endif;
                    ?>
                </div>
                <!-- Logo -->
                <?php 
                // Get the logo
                if ( $ti_option['site_logo'] != '' ) { 
                    $site_logo = $ti_option['site_logo'];
                } else { 
                    $site_logo = get_template_directory_uri() . '/images/logo.png';
                }
                ?>
                <a class="logo" href="<?php echo home_url( '/' ); ?>">
                    <img src="<?php echo $site_logo; ?>" alt="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>" title="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>" />
                </a>
                <!-- End Logo -->                
            </div><!-- .wrapper -->
        </div><!-- .top-strip -->
     
    
    </header><!-- #masthead -->
    <div class="wrapper">
        <div id="pageslide">
            <a id="close-pageslide" href="#top"><i class="icon-remove-sign"></i></a>
        </div><!-- Sidebar in Mobile View -->       
    </div>

    <script>
        var update_bookmarks_count = function() {

            
            console.log(<?php echo wpfp_user_favs_count(); ?>);
            var $bookmarks = '(' + <?php echo wpfp_user_favs_count(); ?> + ')';
            if($bookmarks !== "(0)") {
                jQuery("#user_favs_count").html($bookmarks);
                console.log("ubc is being called");
            }
        }
        update_bookmarks_count();

        var increase_bookmarks_count = function(){
            var $bookmarks = jQuery("#user_favs_count").html().replace ( /[^\d.]/g, '' );
                ++$bookmarks;
                if($bookmarks !== 0) {
                    jQuery("#user_favs_count").html('(' + $bookmarks +  ')');
                } else {
                    jQuery("#user_favs_count").html('');
                }                
        }
        var decrease_bookmarks_count = function(){
            var $bookmarks = jQuery("#user_favs_count").html().replace ( /[^\d.]/g, '' ) - 1;
                if($bookmarks !== 0) {
                    jQuery("#user_favs_count").html('(' + $bookmarks +  ')');
                } else {
                    jQuery("#user_favs_count").html('');
                }
        }
            //Remove favorites when cleared
        var remove_favorites = function() {
            jQuery(".wpfp-span.grids").fadeOut().remove();
            jQuery("#user_favs_count").html('');
        }
 
    </script>





