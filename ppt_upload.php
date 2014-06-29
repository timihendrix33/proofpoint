<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'ppt_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function ppt_register_meta_boxes( $meta_boxes )
{
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'ppt_';



	// meta box
	$meta_boxes[] = array(
		'title' => __( 'Attach PowerPoint Slide', 'rwmb' ),

		'fields' => array(
			// FILE ADVANCED (WP 3.5+)
			array(
				'name' => __( 'Upload the PPT file for the post here', 'rwmb' ),
				'id'   => "{$prefix}file_advanced",
				'type' => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type' => 'application,audio,video', // Leave blank for all file types
			),
		)
	);

	return $meta_boxes;
}