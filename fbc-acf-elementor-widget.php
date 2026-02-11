<?php
/**
 * Plugin Name: FBC ACF Elementor Widget
 * Description: Custom Elementor widget to display ACF fields
 * Version: 1.0.5
 * Author: Natalia Ciraolo
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Ensure Elementor is loaded
function fbc_acf_elementor_widget_init() {

    if ( ! did_action( 'elementor/loaded' ) ) {
        return;
    }

    add_action( 'elementor/widgets/register', function( $widgets_manager ) {

        require_once plugin_dir_path( __FILE__ ) . 'widgets/acf-field-widget.php';
        require_once plugin_dir_path( __FILE__ ) . 'widgets/team-member-template-widget.php';
    
        $widgets_manager->register(
            new \FBC_acf_Elementor_Field_Widget()
        );
    
        $widgets_manager->register(
            new \FBC_Team_Member_Template_Widget()
        );
    
    });

}

add_action( 'plugins_loaded', 'fbc_acf_elementor_widget_init' );