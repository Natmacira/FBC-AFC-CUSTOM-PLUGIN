<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class FBC_Team_Member_Faq_Template_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'fbc_team_member_faq';
    }

    public function get_title() {
        return 'FBC Team Member FAQ';
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

      
      /*
        ============================
        FAQ
        ============================
        */
        if ( have_rows('faq', $post_id) ) {
            echo '<div class="fbc-section fbc-faq">';
            echo '<h2 class="fbc-faq-title">Frequently Asked Questions</h2>';
            
            while ( have_rows('faq', $post_id) ) {
                the_row();
                $question = get_sub_field('question');
                $answer = get_sub_field('answer');
                
                if ( $question || $answer ) {
                    echo '<div class="fbc-faq-item">';
                    
                    if ( $question ) {
                        echo '<h4 class="fbc-faq-question">';
                        echo esc_html($question);
                        echo '</h4>';
                    }
                    
                    if ( $answer ) {
                        echo '<div class="fbc-faq-answer">';
                        echo wp_strip_all_tags($answer);
                        echo '</div>';
                    }
                    
                    echo '</div>';
                }
            }
            
            echo '</div>';
        }
    }
}