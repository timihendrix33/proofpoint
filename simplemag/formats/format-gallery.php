<?php 
/**
 * Gallery (Carousel) post format
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.3
**/ 
?>

<?php 
// Check if gallery was uploaded
if( get_field( 'post_upload_gallery' ) ): ?>

    <div id="gallery-carousel">
        <div class="carousel">
        <?php
        // Output the uploaded images as gallery
        $images = get_field( 'post_upload_gallery' );
        if ( $images ):
            foreach( $images as $image ):
                if ( !empty ( $image['alt'] ) ){
                    $alt = $image['alt'];
                } else {
                    $alt = $image['title'];
                }
                $img_src = $image['sizes']['gallery-carousel'];
				$size = GetImageSize( $img_src );
                echo '<img src="'  . $img_src . '" alt="'  . $alt . '" width="'  . $size[0] . '" height="'  . $size[1] . '" />';
            endforeach;
        endif;
        
        ?>
        </div>
        <a class="carousel-nav prev" href="#"><i class="icon-chevron-left"></i></a>
        <a class="carousel-nav next" href="#"><i class="icon-chevron-right"></i></a>
    </div>

<?php endif; ?>