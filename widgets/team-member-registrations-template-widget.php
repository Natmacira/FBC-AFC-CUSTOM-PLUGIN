<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class FBC_Team_Member_Registrations_Template_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'fbc_team_member_registrations';
    }

    public function get_title() {
        return 'FBC Team Member Registrations';
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        // No controls needed
    }

    public function get_style_depends() {
        return ['fbc-team-member-styles'];
    }

    protected function render() {

        if ( ! function_exists('get_field') ) return;

        // Enqueue styles
        wp_enqueue_style(
            'fbc-team-member-styles',
            plugins_url('assets/css/fbc-team-member-general.css', dirname(__FILE__)),
            [],
            '1.0.0'
        );
        // Enqueue styles
        wp_enqueue_style(
            'fbc-team-member-styles',
            plugins_url('assets/css/fbc-team-member.css', dirname(__FILE__)),
            [],
            '1.0.0'
        );

        $post_id = get_the_ID();

      
        echo '<div class="fbc-team-registrations">';
        /*
        ============================
       PROFESSIONAL REGISTRATION
        ============================
        */
        if ( have_rows('professional_registration', $post_id) ) {
            echo '<div class="fbc-section fbc-registrations">';
            echo '<h3 class="fbc-registrations-title">Professional registration:</h3>';
            echo '<ul class="fbc-list">';
            
            while ( have_rows('professional_registration', $post_id) ) {
                the_row();
                $registration = get_sub_field('single_registration');
                
                if ( $registration ) {
                    echo '<li class="fbc-credential-item">';
                    echo esc_html($registration);
                    echo '</li>';
                }
            }
            
            echo '</ul>';
            echo '</div>';
        }
        echo '</div>';
    }
}