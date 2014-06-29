<?php
/**
 * The template for displaying search forms in _s
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.1
 */
?>
<div id="sb-search" class="sb-search">
	<form method="get"  action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="text" name="s" id="s" class="sb-search-input" placeholder="Search Proofpoint" ?>';" />
	    <button type="submit" class="sb-search-submit">
	    	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/search-grey.png" alt="search" />
	    </button>
	    <span class="sb-icon-search"><i class="fa fa-search"></i></span>
	</form>
</div>