<?php
/**
 * Property Enquiries
 *
 * @author      PropertyHive
 * @category    Admin
 * @package     PropertyHive/Admin/Meta Boxes
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * PH_Meta_Box_Property_Enquiries
 */
class PH_Meta_Box_Property_Enquiries {

    /**
     * Output the metabox
     */
    public static function output( $post ) {

        global $post;

        $original_post = $post;
        
        echo '<div class="propertyhive_meta_box">';
        
        echo '<div class="options_group">';

            $args = array(
                'post_type'   => 'enquiry', 
                'nopaging'    => true,
                'meta_query'  => array(
                    'relation' => 'OR',
                    array(
                        'key' => 'property_id',
                        'value' => $post->ID
                    ),
                    array(
                        'key' => '_property_id',
                        'value' => $post->ID
                    )
                )
            );
            $enquiries_query = new WP_Query( $args );

            if ( $enquiries_query->have_posts() )
            {
                include( PH()->plugin_path() . '/includes/admin/views/html-display-enquiries.php' );
            }
            else
            {
                echo '<p>' . __( 'No enquiries received for this property', 'propertyhive') . '</p>';
            }
            wp_reset_postdata();

        do_action('propertyhive_property_enquiries_fields');
        
        echo '</div>';
        
        echo '</div>';

        $post = $original_post;
    }

    /**
     * Save meta box data
     */
    public static function save( $post_id, $post ) {
        global $wpdb;
        

    }

}
