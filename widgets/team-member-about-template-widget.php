<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class FBC_Team_Member_About_Template_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'fbc_team_member_about';
    }

    public function get_title() {
        return 'FBC Team Member About';
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
        return ['fbc-team-member-about-styles'];
    }

    protected function render() {

        if ( ! function_exists('get_field') ) return;

        // Enqueue styles
        wp_enqueue_style(
            'fbc-team-member-about-styles',
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

        echo '<div class="fbc-team-about">';

        /*
        ============================
        BLOCK 1: ABOUT ME + PROFILE IMAGE
        ============================
        */
        $about_me = $team_content['about_me'] ?? '';
        $photo = get_field('profile_photo', $post_id);

        if ( $about_me || $photo ) {
            echo '<div class="fbc-about-section">';
            
            
            // Left column - About Me
            echo '<div class="fbc-about-content">';
            echo '<h2 class="fbc-support-title">';
            echo 'About Me';
          
            echo '</h2>';
            if ( $about_me ) {
                echo wp_kses_post( $about_me );
            }
            echo '</div>';
            
            // Right column - Profile Image
            echo '<div class="fbc-about-image">';
            if ( $photo ) {
                $url = is_array($photo) ? $photo['url'] : wp_get_attachment_url($photo);
                $alt = is_array($photo) && isset($photo['alt']) ? $photo['alt'] : get_the_title($post_id);
                
                echo '<img src="'.esc_url($url).'" alt="'.esc_attr($alt).'" class="fbc-profile-img">';
            }
            echo '</div>';
            
            echo '</div>'; // .fbc-about-section
        }
        echo '</div>'; // .fbc-team-about   
        
    }
        
    }
