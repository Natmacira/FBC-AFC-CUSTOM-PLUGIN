<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class FBC_Team_Member_Socialmedia_Template_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'fbc_team_member_socialmedia';
    }

    public function get_title() {
        return 'FBC Team Member Social Media';
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
        SOCIAL MEDIA
        ============================
        */
        if ( have_rows('social_media', $post_id) ) {
            echo '<div class="fbc-social-media">';
            echo '<h3>Connect With Me</h3>';
            echo '<div class="fbc-social-links">';
            
            while ( have_rows('social_media', $post_id) ) {
                the_row();
                $platform = get_sub_field('type');
                $url = get_sub_field('url');
                
                if ( $platform && $url ) {
                    echo '<a href="'.esc_url($url).'" class="fbc-social-link" target="_blank" rel="noopener noreferrer">';
                    echo esc_html($platform);
                    echo '</a>';
                }
            }
            
            echo '</div>';
            echo '</div>';
        }
    }
}