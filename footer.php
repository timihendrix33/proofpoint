<?php
/**
 * The template for displaying the footer.
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.1
**/
global $ti_option;
?>

    <footer id="footer" role="contentinfo" class="animated <?php echo $ti_option['site_footer_color']; ?>">
    
        <?php get_sidebar( 'footer' ); // Output the footer sidebars ?>
        
        <div class="copyright">
            <div class="wrapper">
            	<div class="grids">
                    <div class="grid-10">
                        <?php echo $ti_option['copyright_text']; ?>
                    </div>
                    <div class="back-top-wrap">
                        <a href="#" class="back-top"><?php _e( 'Back to top', 'themetext' ); ?><i class="icon-chevron-up"></i></a>
                        <a class="hww-logo" href="http://www.havasworldwide.com/"><img src="<?php echo get_stylesheet_directory_uri()?>/images/havasww-logo.jpg" alt="Havas Worldwide" /></a>
                    </div>
                </div>
            </div>
        </div>
            
    </footer><!-- #footer -->
    
    </div><!-- #inner-wrap -->
</div><!-- #outer-wrap -->
    
<?php wp_footer(); ?>
<script type="text/javascript">
    new UISearch( document.getElementById( 'sb-search' ) );
</script>
</body>
</html>