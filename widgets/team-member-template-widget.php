<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class FBC_Team_Member_Template_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'fbc_team_member_template';
    }

    public function get_title() {
        return 'FBC Team Member Template';
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
            plugins_url('assets/css/fbc-team-member.css', dirname(__FILE__)),
            [],
            '1.0.0'
        );

        $post_id = get_the_ID();

        echo '<div class="fbc-team-member">';

        // HERO SECTION
        echo '<div class="fbc-hero-section">';
        
        echo '<div class="fbc-hero-content">';

        /*
        ============================
        TEAM CONTENT (GROUP FIELD)
        ============================
        */
        $team_content = get_field('team_content', $post_id);

        if ( $team_content ) {
            $first_name = $team_content['first_name'] ?? '';
            $second_name = $team_content['second_name'] ?? '';
            $job_title = $team_content['job_title'] ?? '';
            $designation = $team_content['designation'] ?? '';

            // Name
            if ( $first_name || $second_name ) {
                echo '<h1 class="fbc-name">';
                echo esc_html( $first_name . ' ' . $second_name );
                echo '</h1>';
            }

            // Job title (Position Type)
            if ( $position = get_field('position_type', $post_id) ) {
                echo '<div class="fbc-position">';
                echo esc_html($position);
                echo '</div>';
            }

            // Designation - Additional info below position
            if ( $designation ) {
                echo '<div class="fbc-designation">';
                echo esc_html( $designation );
                echo '</div>';
            }

            // Book appointment button
            if ( $booking_link = get_field('booking_link', $post_id) ) {
                echo '<a href="'.esc_url($booking_link).'" class="fbc-booking-btn" target="_blank">';
                echo 'Book an Appointment';
                echo '</a>';
            }
        }

        echo '</div>'; // .fbc-hero-content

        // PHOTO
        echo '<div class="fbc-hero-image">';
        $photo = get_field('profile_photo', $post_id);
        if ( $photo ) {
            $url = is_array($photo) ? $photo['url'] : wp_get_attachment_url($photo);
            $alt = is_array($photo) && isset($photo['alt']) ? $photo['alt'] : get_the_title($post_id);
            
            echo '<img src="'.esc_url($url).'" alt="'.esc_attr($alt).'" class="fbc-photo">';
        }
        echo '</div>'; // .fbc-hero-image

        echo '</div>'; // .fbc-hero-section

        // MAIN CONTENT SECTION
        echo '<div class="fbc-main-content">';

        if ( $team_content ) {
            $license = $team_content['license_information'] ?? '';
            $specialization = $team_content['specialization'] ?? '';
            $motivation = $team_content['motivation'] ?? '';
            $why_therapist = $team_content['why_therapist'] ?? '';
            $about_me = $team_content['about_me'] ?? '';

            // Motivation Section (with image card style)
            if ( $motivation ) {
                echo '<div class="fbc-card fbc-motivation-card">';
                echo '<h2>How will I know if you are a good fit for working with me?</h2>';
                echo '<div class="fbc-motivation">';
                echo nl2br( esc_html( $motivation ) );
                echo '</div>';
                echo '</div>';
            }

            // Why therapist Section (with background)
            if ( $why_therapist ) {
                echo '<div class="fbc-card fbc-why-therapist-card">';
                echo '<h2>Why did you decide to become a therapist?</h2>';
                echo '<div class="fbc-why-therapist">';
                echo wp_kses_post( $why_therapist );
                echo '</div>';
                echo '</div>';
            }

            // License & Specialization
            if ( $license || $specialization ) {
                echo '<div class="fbc-info-row">';
                
                if ( $license ) {
                    echo '<div class="fbc-license">';
                    echo esc_html( $license );
                    echo '</div>';
                }
                
                if ( $specialization ) {
                    echo '<div class="fbc-specialization">';
                    echo esc_html( $specialization );
                    echo '</div>';
                }
                
                echo '</div>';
            }

            // About me
            if ( $about_me ) {
                echo '<div class="fbc-about-me">';
                echo wp_kses_post( $about_me );
                echo '</div>';
            }
        }

        // CORE FOCUS
        if ( $core = get_field('core_focus', $post_id) ) {
            echo '<div class="fbc-core-focus">';
            echo '<h3>Core Focus</h3>';
            echo '<p>'.esc_html($core).'</p>';
            echo '</div>';
        }

        /*
        ============================
        ACADEMIC CREDENTIALS
        ============================
        */
        if ( have_rows('academic_credentials', $post_id) ) {
            echo '<div class="fbc-section fbc-credentials">';
            echo '<h3>ACADEMIC CREDENTIALS:</h3>';
            echo '<ul class="fbc-list">';
            
            while ( have_rows('academic_credentials', $post_id) ) {
                the_row();
                $credential = get_sub_field('single_credential');
                
                if ( $credential ) {
                    echo '<li class="fbc-credential-item">';
                    echo esc_html($credential);
                    echo '</li>';
                }
            }
            
            echo '</ul>';
            echo '</div>';
        }

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

        /*
        ============================
        TYPES OF SUPPORT OFFERED
        ============================
        */
        if ( have_rows('types_of_support', $post_id) ) {
            echo '<div class="fbc-section fbc-types-of-support">';
            echo '<h3>Types of Support Offered</h3>';
            echo '<ul class="fbc-list">';
            
            while ( have_rows('types_of_support', $post_id) ) {
                the_row();
                $support = get_sub_field('single_support');
                
                if ( $support ) {
                    echo '<li class="fbc-support-item">';
                    echo esc_html($support);
                    echo '</li>';
                }
            }
            
            echo '</ul>';
            echo '</div>';
        }

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
                $platform = get_sub_field('platform');
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

        echo '</div>'; // .fbc-main-content

        echo '</div>'; // .fbc-team-member
    }
}