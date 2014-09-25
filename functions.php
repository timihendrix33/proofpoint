<?php



	function my_replace_custom_script(){

		// Remove default jquery.custom.js
		wp_dequeue_script( 'custom' );

		// Remove default jquery.assets.js
		wp_dequeue_script( 'assets' );

		// Add clamp.js
		wp_enqueue_script( 'dotdotdot', get_stylesheet_directory_uri() . '/js/jquery.dotdotdot.js', 'jquery', '1.0', true);				

		// Add new jquery.custom.js
		wp_enqueue_script( 'new-custom', get_stylesheet_directory_uri() . '/js/jquery.custom.js', 'jquery', '1.0', true);

		// Add new jquery.assets.js
		wp_enqueue_script( 'new-assets', get_stylesheet_directory_uri() . '/js/jquery.assets.js', 'jquery', '1.0', true);		

		// Add Classie.js
		wp_enqueue_script( 'classie', get_stylesheet_directory_uri() . '/js/classie.js', 'jquery', '1.0', true);	

		// Add Modernizr
		wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr.custom.js', 'jquery', '1.0', true);

		// Add searchform.js
		wp_enqueue_script( 'searchform', get_stylesheet_directory_uri() . '/js/searchform.js', 'jquery', '1.0', true);		

		// Add infinitescroll.min.js
		//wp_enqueue_script( 'infinite', get_stylesheet_directory_uri() . '/js/jquery.infinitescroll.min.js', 'jquery', '1.0', true);				 

	}
	add_action( 'wp_enqueue_scripts', 'my_replace_custom_script', 100 );

	function infinite_scroll() {
		if (!is_singular() ) { ?>
		<script>
		var infinite_scroll = {
			loading: {
				img: "<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader.gif",
				msgText: "<?php _e( 'Loading the next set of posts...', 'custom' ); ?>",
				finishedMsg: "<?php _e( 'All posts loaded.', 'custom' ); ?>"
			},
			"nextSelector":"#content .pagination .page-numbers li a.next",
			"navSelector":"#content .pagination .page-numbers",
			"itemSelector":"article",
			"contentSelector":"#content .wrapper .grids"
		};
		jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll );
		</script>
		}

		<?php
		}
	}
	//add_action( 'wp_footer', 'infinite_scroll', 100 );



	add_action( 'init', 'taxonomies_init' );

	function taxonomies_init() {

		register_taxonomy(
			'website',
			'post',
			array(
				'label' => __( 'Website' ),
				'rewrite' => array( 'slug' => 'website' ),
				'update_count_callback' => '_update_post_term_count'
			)
		);	
		register_taxonomy(
			'twitter',
			'post',
			array(
				'label' => __( 'Twitter' ),
				'rewrite' => array( 'slug' => 'twitter' ),
				'update_count_callback' => '_update_post_term_count'
			)
		);
		register_taxonomy(
			'competitors',
			'post',
			array(
				'label' => __( 'Competitors' ),
				'rewrite' => array( 'slug' => 'competitors' ),
				'update_count_callback' => '_update_post_term_count'
			)
		);	
		register_taxonomy(
			'model',
			'post',
			array(
				'label' => __( 'Model' ),
				'rewrite' => array( 'slug' => 'model' ),
				'update_count_callback' => '_update_post_term_count'
			)
		);		
		register_taxonomy(
			'founded',
			'post',
			array(
				'label' => __( 'Founded' ),
				'rewrite' => array( 'slug' => 'founded' ),
				'update_count_callback' => '_update_post_term_count'
			)
		);	
	}

	// get taxonomies terms links
	function custom_taxonomies_terms_links() {
	    global $post, $post_id;
	    // get post by post id
	    $post = &get_post($post->ID);
	    // get post type by post
	    $post_type = $post->post_type;
	    // get post type taxonomies
	    $taxonomies = get_object_taxonomies($post_type);
	    $out = "<ul class='taxonomies'>";
	    $exclude = array('post_format', 'post_tag');
	    $newTaxes = array_diff($taxonomies, $exclude);
	    foreach ($newTaxes as $taxonomy) {        
	        // get the terms related to post
	        $terms = get_the_terms( $post->ID, $taxonomy );
	        if ( !empty( $terms ) ) {
	        		if(sizeof($terms) > 1) {
	        			$out .=  "<li class='multiple-terms'>".$taxonomy.": ";
	        		} else {
	        			$out .=  "<li>".$taxonomy.": ";
	        		}
			            foreach ( $terms as $term )
			            	if ($taxonomy == "website") {
			                	$out .= "<a href='http://" . $term->name ."' target='_blank' >".$term->name."</a>";
			            	} elseif ($taxonomy == "category") {
			            		$out .= "<a href='" . get_term_link($term->slug, $taxonomy) ."'>".$term->name."</a>";
			            	} elseif ($taxonomy == "twitter") {
			            		$out .= "<a href='http://twitter.com/" .$term->name . " ' target='_blank'>" .$term->name. "</a>";
			            	} elseif ($taxonomy == "competitors" || $taxonomy == "model" || $taxonomy == "founded") {
			            		$out .=   '<span>'.$term->name.'</span>';
			            	}
					$out .= "</li>";	
   
	        }
	    }
	    $out .= "</ul>";
	    return $out;
	}

	// More than 1 featured image per post
	
    if (class_exists('MultiPostThumbnails')) {
        new MultiPostThumbnails(
            array(
                'label' => 'Secondary Image',
                'id' => 'secondary-image',
                'post_type' => 'post'
            )
        );
    }

    // Including login screen customizations

	function my_login_logo_url() {
	    return home_url();
	}
	add_filter( 'login_headerurl', 'my_login_logo_url' );

	function my_login_logo_url_title() {
	    return 'Proofpoint';
	}
	add_filter( 'login_headertitle', 'my_login_logo_url_title' );

	function my_login_stylesheet() {
	    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/style-login.css' );
	}
	add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

	// Include PPT upload file

	include 'ppt_upload.php';

	// Paging

	add_filter('query_vars', 'parameter_queryvars' ); // Let WP accept the query argument we will use
	function parameter_queryvars( $qvars )
	{
	    $qvars[] = 'posts_per_page';
	    return $qvars;
	}
	add_action( 'pre_get_posts', 'change_post_per_page' ); // Filter posts based on passed query variable if set
	function change_post_per_page( $query ) {
	    global $wp_query;
	    if ( !empty($wp_query->query['posts_per_page']) && is_numeric($wp_query->query['posts_per_page'])) {
	        $query->set( 'posts_per_page', $wp_query->query['posts_per_page'] );
	    }
	}

	function get_category_post_attachments() {
		//get the category ID
		if (is_category() || is_single()){
          $cat = get_category_by_path(get_query_var('category_name'),false);
          $current = $cat->cat_ID;
        }
        //set args to current cat ID, unlimited # of posts
		$args = array(
			'category'	=> $current,
			'posts_per_page' => -1
		);
		// get current posts
		$category_posts_array = get_posts($args);
		// add current posts ids to an array
		$category_post_ids = array();
		foreach ($category_posts_array as $post) {
			$post_id = $post->ID;
			$category_post_ids[] = $post_id;
		}
		// get post attachment urls from post ids array, add to a different array
	    $attachments = array();
	    foreach ($category_post_ids as $fav) { 
	        $attachment_id = get_post_meta($fav, 'ppt_file_advanced', true);
	        $attachment_url = wp_get_attachment_url($attachment_id);
	        $attachments[] = $attachment_url;
	    }
	    // return array of post attachment urls
	    return $attachments;
	}

	/* creates a compressed zip file */
	function create_zip($files = array(),$destination = "",$overwrite = false) {
	    //if the zip file already exists and overwrite is false, return false
	    if(file_exists($destination) && !$overwrite) { return false; }
	    //vars
	    $valid_files = array();
	    //if files were passed in...
	    if(is_array($files)) {
	        //cycle through each file
	        foreach($files as $file) {
	            //make sure the file exists
	            $valid_files[] = $file;
	        }
	    }
	    //if we have good files...
	    if(count($valid_files)) {
	        //create the archive
	        $zip = new ZipArchive();

	        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
	            return false;
	        }
	        //add the files
	        foreach($valid_files as $file) {
	            // $zip->addFile($file,$file);
	            $content = file_get_contents($file);
	            $zip->addFromString(pathinfo ( $file, PATHINFO_BASENAME), $content);            
	        }
	        //debug
	        //echo 'The zip archive contains ',$zip->numFiles . "<br />",' files with a status of ',$zip->status . "<br />", $zip->filename . "<br />";      
	     
	        //close the zip -- done!
	        $zip->close();
	        
	        //check to make sure the file exists
	        return file_exists($destination);
	    } else {
	        return false;
	    }
	 }

?>