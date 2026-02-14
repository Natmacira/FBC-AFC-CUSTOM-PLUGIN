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
        wp_enqueue_style(
            'fbc-team-member-css',
            plugins_url('assets/css/fbc-team-member.css', dirname(__FILE__)),
            [],
            '1.0.0'
        );

        $post_id = get_the_ID();
        
        echo '<div class="fbc-team-faq">'; // Contenedor principal
        echo '<h2 class="fbc-support-title-faq">';
        echo 'Frequently Asked Questions About Grief Counselling in Calgary';
      
        echo '</h2>';
        /*
        ============================
        FAQ
        ============================
        */
        if ( have_rows('faq', $post_id) ) {
            echo '<div class="fbc-section fbc-faq">';
            
            while ( have_rows('faq', $post_id) ) {
                the_row();
                $question = get_sub_field('question');
                $answer = get_sub_field('answer');

           
                
                if ( $question || $answer ) {
                    echo '<details class="fbc-faq-accordion">';
                    
                    if ( $question ) {
                        echo '<summary class="fbc-faq-accordion-title">';
                        echo '<h4 class="fbc-faq-question">';
                        echo esc_html($question);
                        echo '</h4>';
                        echo '<span class="fbc-faq-accordion-icon"></span>';
                        echo '</summary>';
                    }
                    
                    if ( $answer ) {
                        echo '<div class="fbc-faq-accordion-content">';
                        echo '<div class="fbc-faq-answer">';
                        echo wp_strip_all_tags($answer);
                        echo '</div>';
                        echo '</div>';
                    }
                    
                    echo '</details>';
                }
            }
            
            echo '</div>'; // .fbc-section
        }
        
        echo '</div>'; // .fbc-team-faq
        
    }
}