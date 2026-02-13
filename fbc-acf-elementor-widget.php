<?php

/**
 * Plugin Name: FBC ACF Elementor Widget
 * Description: Custom Elementor widget to display ACF fields
 * Version: 1.3.0
 * Author: Natalia Ciraolo
 */

if (! defined('ABSPATH')) exit;

// Ensure Elementor is loaded
function fbc_acf_elementor_widget_init()
{

    if (! did_action('elementor/loaded')) {
        return;
    }

    add_action('elementor/widgets/register', function ($widgets_manager) {

        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-about-template-widget.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-motivation-template-widget.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-credentials-template-widget.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-addtraining-template-widget.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-support-template-widget.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-socialmedia-template-widget.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-faq-template-widget.php';

        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-template-widget.php';

        $widgets_manager->register(
            new \FBC_Team_Member_About_Template_Widget()
        );

        $widgets_manager->register(
            new \FBC_Team_Member_Motivation_Template_Widget()
        );

        $widgets_manager->register(
            new \FBC_Team_Member_Support_Template_Widget()
        );

        $widgets_manager->register(
            new \FBC_Team_Member_Addtraining_Template_Widget()
        );

        $widgets_manager->register(
            new \FBC_Team_Member_Credentials_Template_Widget()
        );

        $widgets_manager->register(
            new \FBC_Team_Member_Socialmedia_Template_Widget()
        );
      
        $widgets_manager->register(
            new \FBC_Team_Member_Faq_Template_Widget()
        );

        $widgets_manager->register(
            new \FBC_Team_Member_Template_Widget()
        );
    });
}

add_action('plugins_loaded', 'fbc_acf_elementor_widget_init');
