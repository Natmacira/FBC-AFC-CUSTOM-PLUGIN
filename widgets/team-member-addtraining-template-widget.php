<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class FBC_Team_Member_Addtraining_Template_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'fbc_team_member_addtraining';
    }

    public function get_title() {
        return 'FBC Team Member Addtraining';
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
        ADDITIONAL TRAINING (MODELS OF THERAPY)
        ============================
        */
        if ( have_rows('additional_training', $post_id) ) {
            echo '<div class="fbc-section fbc-additional-training">';
            echo '<h3>MODELS OF THERAPY:</h3>';
            echo '<ul class="fbc-list">';
            
            while ( have_rows('additional_training', $post_id) ) {
                the_row();
                $training = get_sub_field('single_training');
                
                if ( $training ) {
                    echo '<li class="fbc-training-item">';
                    echo esc_html($training);
                    echo '</li>';
                }
            }
            
            echo '</ul>';
            echo '</div>';
        }
    }
}