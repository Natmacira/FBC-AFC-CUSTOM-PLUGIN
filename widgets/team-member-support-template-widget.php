<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class FBC_Team_Member_Support_Template_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'fbc_team_member_support';
    }

    public function get_title() {
        return 'FBC Team Member Support';
    }

    public function get_icon() {
        return 'eicon-text-area';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        // No controls needed
    }

    public function get_style_depends() {
        return ['fbc-team-member-support-styles'];
    }

    protected function render() {

        if ( ! function_exists('get_field') ) return;

        // Enqueue styles
        wp_enqueue_style(
            'fbc-team-member-support-styles',
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
        $team_content = get_field('team_content', $post_id);

         /*
        ============================
        TYPES OF SUPPORT OFFERED
        ============================
        */


       echo '<div class="fbc-team-support">';

        if ( have_rows('types_of_support', $post_id) ) {
            echo '<div class="fbc-section fbc-types-of-support">';
            
            echo '<h2>Types of Support Offered:</h2>';
            echo '<ul class="fbc-list">';
            
            while ( have_rows('types_of_support', $post_id) ) {
                the_row();
                $support = get_sub_field('support_single');
                
                if ( $support ) {
                    echo '<li class="fbc-support-item">';
                    echo esc_html($support);
                    echo '</li>';
                }
            }
            
            echo '</ul>';
            echo '</div>'; // .fbc-section
        }
        
        echo '</div>'; // .fbc-team-support
        
    }  
}  