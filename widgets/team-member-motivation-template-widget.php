<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class FBC_Team_Member_motivation_Template_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'fbc_team_member_motivation';
    }

    public function get_title() {
        return 'FBC Team Member Motivation';
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
        return ['fbc-team-member-motivation-styles'];
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
        BLOCK 3: MOTIVATION CARD
        ============================
        */
        $motivation = $team_content['motivation'] ?? '';
        
        if ( $motivation ) {
            echo '<div class="fbc-question-card fbc-motivation-card">';
            
            echo '<h3 class="fbc-question-title">';
            echo 'How will I know if you are a good fit for working with me?';
            echo '</h3>';
            
            echo '<div class="fbc-question-answer">';
            echo nl2br( esc_html( wp_strip_all_tags( $motivation ) ) );
            echo '</div>';
            
            echo '</div>'; // .fbc-motivation-card
        }

        /*
        ============================
        BLOCK 4: WHY THERAPIST CARD
        ============================
        */
        $why_therapist = $team_content['why_therapist'] ?? '';
        
        if ( $why_therapist ) {
            echo '<div class="fbc-question-card fbc-why-therapist-card">';
            
            echo '<h3 class="fbc-question-title">';
            echo 'Why did you decide to become a therapist?';
            echo '</h3>';
            
            echo '<div class="fbc-question-answer">';
            echo wp_kses_post( $why_therapist );
            echo '</div>';
            
            echo '</div>'; // .fbc-why-therapist-card
        }

        echo '</div>'; // .fbc-team-motivation
    }
}