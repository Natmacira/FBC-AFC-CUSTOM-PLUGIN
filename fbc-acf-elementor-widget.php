<?php

/**
 * Plugin Name: FBC ACF Elementor Widget
 * Description: Custom Elementor widget to display ACF fields
 * Version: 1.8.6
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
        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-why-template-widget.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-credentials-template-widget.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-registrations-template-widget.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-addtraining-template-widget.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-support-template-widget.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-socialmedia-template-widget.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-faq-template-widget.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/services-card-team-member.php';
        require_once plugin_dir_path(__FILE__) . 'widgets/services-card-all-team-member.php';

        require_once plugin_dir_path(__FILE__) . 'widgets/team-member-template-widget.php';

        $widgets_manager->register(
            new \FBC_Team_Member_About_Template_Widget()
        );

        $widgets_manager->register(
            new \FBC_Team_Member_Motivation_Template_Widget()
        );
       
        $widgets_manager->register(
            new \FBC_Team_Member_Why_Template_Widget()
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
            new \FBC_Team_Member_Registrations_Template_Widget()
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

        $widgets_manager->register(
            new \FBC_Service_Providers_Grid_Widget()
        );
        
        $widgets_manager->register(
            new \FBC_All_Team_Members_Grid_Widget()
        );
    });
}

add_action('plugins_loaded', 'fbc_acf_elementor_widget_init');
