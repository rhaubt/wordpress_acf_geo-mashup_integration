<?php
// ***** ACF Location Field Geo Mashup integration http://support.advancedcustomfields.com/forums/topic/acf-and-geo-mashup-integration/ or http://wpquestions.com/question/show/id/10778*****

add_action('save_post', 'wpq_acf_gmap');

function wpq_acf_gmap($post_id) {

   if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

   if( !isset($_POST['acf_nonce'], $_POST['fields']) || !wp_verify_nonce($_POST['acf_nonce'], 'input') ) return $post_id;

   

   if(get_post_status( $post_id ) <> 'publish' )  return $post_id;

      

   $location   = (array) ( maybe_unserialize(get_post_meta($post_id, 'RAE_0254', true)) ); //change location as your acf field name

   if( count($location) >= 3 ) {

      $geo_address = $location['address'];

      $geo_latitude = $location['lat'];

      $geo_longitude = $location['lng'];

      $geo_location = ''.$geo_latitude.','.$geo_longitude.'';

      update_post_meta( $post_id, 'geo_address', $geo_address );

      update_post_meta( $post_id, 'geo_latitude', $geo_latitude );

      update_post_meta( $post_id, 'geo_longitude', $geo_longitude );

      update_post_meta( $post_id, 'geo_location', $geo_location );

   }

}
?>