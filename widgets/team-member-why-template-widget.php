<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class FBC_Team_Member_Why_Template_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'fbc_team_member_why';
    }

    public function get_title() {
        return 'FBC Team Member Why';
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
        return ['fbc-team-member-why-styles'];
    }

    protected function render() {

        if ( ! function_exists('get_field') ) return;

        // Enqueue styles
        wp_enqueue_style(
            'fbc-team-member-motivation-styles',
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

        echo '<div class="fbc-team-motivation">';

  


        /*
        ============================
        BLOCK 4: WHY THERAPIST CARD
        ============================
        */
        $why_therapist = $team_content['why_therapist'] ?? '';
        
        if ( $why_therapist ) {
           
            
            echo '<div class="fbc-question-answer">';
            echo wp_kses_post( $why_therapist );
            echo '</div>';
            
        }

        echo '</div>'; // .fbc-team-motivation
        echo '</div>';
    }
}