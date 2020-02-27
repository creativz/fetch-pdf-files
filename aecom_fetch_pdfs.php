<?php 
/**
 * Plugin Name: AECOM fetch pdfs
 * Description: Fetch all uploaded pdf on Media and Create download link
 * Version: 1.0
 * Author: Zim Arcilla
 * Author URI: https://zimarcilla.com
*/

function plugin_styles() {
    // Register plugin stylesheet
    wp_enqueue_style( 'plugin-css', '/wp-content/plugins/aecom_fetch_pdfs/plugin-style.css', array(), 'all' );
  
}
add_action('wp_enqueue_scripts', 'plugin_styles', 999);

function fetch_pdfs() {

    
    $args = array(
        'post_type' => 'attachment',
        'numberposts' => -1,
        'post_status' => null,
        'post_parent' => null,
    ); 
    $attachments = get_posts($args);

    ob_start();
    if ($attachments) {
        echo '<div class="pdf-links-container">';
        foreach ($attachments as $pdf) {
            if($pdf->post_mime_type === 'application/pdf') {
                echo
                    '<div class="pdf-links">',
                        '<a href="', $pdf->guid , '" target="_blank">',
                            $pdf->post_title,
                        '</a>',
                    '</div>';
            }
        }
        echo '</div>';
    }
    return ob_get_clean();
}
add_shortcode( 'aecom_fetch_pdfs', 'fetch_pdfs' );