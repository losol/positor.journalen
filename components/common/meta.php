<?php
/**
 * Shows meta inforation about post/page.
 *
 * @package Positor
 */

?>

<?php // Show author_alias if assigned
if (get_post_meta(get_the_ID(), 'author_alias', true) != "") :
    echo '<span class="sr-only">Skribent </span><i class="fa fa-fw fa-pencil" aria-hidden="true"></i>&nbsp;' . get_post_meta(get_the_ID(), 'author_alias', true); 
    echo '&nbsp;<small>' . get_post_meta(get_the_ID(), 'author_bio', true) . '</small>';

endif;
?>

<?php // Show photographer_alias if assigned
if (get_post_meta(get_the_ID(), 'photographer_alias', true) != "") :
    echo '<span class="sr-only">Fotograf </span><i class="fa fa-fw fa-camera-retro" aria-hidden="true"></i>&nbsp;' . get_post_meta(get_the_ID(), 'photographer_alias', true); 
endif;
?>
<?php // Show published date
    echo '<i class="fa fa-fw fa-calendar" aria-hidden="true"></i>&nbsp;Publisert ' . get_the_date('j.n.Y');
    
    // If updated date is different, show this as well
    if ( get_the_date( 'j.n.Y' ) !== get_the_modified_date( 'j.n.Y' ) ) {
            echo ', oppdatert ' . get_the_modified_date('j.n.Y')  ;
        }
    ?>

<?php
} // End if(). 

