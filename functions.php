<?php



	function my_replace_custom_script(){

		// Remove default jquery.custom.js
		wp_dequeue_script( 'custom' );

		// Add clamp.js
		wp_enqueue_script( 'dotdotdot', get_stylesheet_directory_uri() . '/js/jquery.dotdotdot.js', 'jquery', '1.0', true);				

		// Add new jquery.custom.js
		wp_enqueue_script( 'new-custom', get_stylesheet_directory_uri() . '/js/jquery.custom.js', 'jquery', '1.0', true);

		// Add Classie.js
		wp_enqueue_script( 'classie', get_stylesheet_directory_uri() . '/js/classie.js', 'jquery', '1.0', true);	

		// Add Modernizr
		wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr.custom.js', 'jquery', '1.0', true);

		// Add searchform.js
		wp_enqueue_script( 'searchform', get_stylesheet_directory_uri() . '/js/searchform.js', 'jquery', '1.0', true);		 

	}
	add_action( 'wp_enqueue_scripts', 'my_replace_custom_script', 100 );

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
			                	$out .= '<a href="http://' . $term->name .'">'.$term->name.'</a> ';
			            	} elseif ($taxonomy == "category") {
			            		$out .= '<a href="' . get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a> ';
			            	} elseif ($taxonomy == "twitter") {
			            		$out .= '<a href="http://twitter.com/' .$term->name . '">'.$term->name. '</a> ';
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

?>