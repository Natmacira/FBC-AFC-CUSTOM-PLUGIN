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

    protected function render() {

        if ( ! function_exists('get_field') ) return;

        $post_id = get_the_ID();

        echo '<div class="fbc-team-member">';

        // PHOTO
        $photo = get_field('profile_photo', $post_id);
        if ( $photo ) {
            $url = is_array($photo) ? $photo['url'] : wp_get_attachment_url($photo);
            echo '<img src="'.esc_url($url).'" class="fbc-photo">';
        }

        // POSITION
        if ( $position = get_field('position_type', $post_id) ) {
            echo '<div class="fbc-position">';
            echo esc_html($position);
            echo '</div>';
        }

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
            $license = $team_content['license_information'] ?? '';
            $specialization = $team_content['specialization'] ?? '';
            $motivation = $team_content['motivation'] ?? '';
            $why_therapist = $team_content['why_therapist'] ?? '';
            $about_me = $team_content['about_me'] ?? '';

            // Name
            if ( $first_name || $second_name ) {
                echo '<h1 class="fbc-name">';
                echo esc_html( $first_name . ' ' . $second_name );
                echo '</h1>';
            }

            // Job title
            if ( $job_title ) {
                echo '<div class="fbc-job-title">';
                echo esc_html( $job_title );
                echo '</div>';
            }

            // Designation
            if ( $designation ) {
                echo '<div class="fbc-designation">';
                echo esc_html( $designation );
                echo '</div>';
            }

            // License
            if ( $license ) {
                echo '<div class="fbc-license">';
                echo esc_html( $license );
                echo '</div>';
            }

            // Specialization
            if ( $specialization ) {
                echo '<div class="fbc-specialization">';
                echo esc_html( $specialization );
                echo '</div>';
            }

            // Motivation (textarea)
            if ( $motivation ) {
                echo '<div class="fbc-motivation">';
                echo nl2br( esc_html( $motivation ) );
                echo '</div>';
            }

            // Why therapist (WYSIWYG)
            if ( $why_therapist ) {
                echo '<div class="fbc-why-therapist">';
                echo wp_kses_post( $why_therapist );
                echo '</div>';
            }

            // About me (WYSIWYG)
            if ( $about_me ) {
                echo '<div class="fbc-about-me">';
                echo wp_kses_post( $about_me );
                echo '</div>';
            }
        }

        // CORE FOCUS
        if ( $core = get_field('core_focus', $post_id) ) {
            echo '<div class="fbc-core-focus">';
            echo esc_html($core);
            echo '</div>';
        }

        /*
        ============================
        ACADEMIC CREDENTIALS
        ============================
        */
        if ( have_rows('academic_credentials', $post_id) ) {
            echo '<div class="fbc-credentials">';
            echo '<h3>Academic Credentials</h3>';
            
            while ( have_rows('academic_credentials', $post_id) ) {
                the_row();
                $credential = get_sub_field('single_credential');
                
                if ( $credential ) {
                    echo '<div class="fbc-credential-item">';
                    echo esc_html($credential);
                    echo '</div>';
                }
            }
            
            echo '</div>';
        }

        /*
        ============================
        ADDITIONAL TRAINING
        ============================
        */
        if ( have_rows('additional_training', $post_id) ) {
            echo '<div class="fbc-additional-training">';
            echo '<h3>Additional Training</h3>';
            
            while ( have_rows('additional_training', $post_id) ) {
                the_row();
                $training = get_sub_field('single_training');
                
                if ( $training ) {
                    echo '<div class="fbc-training-item">';
                    echo esc_html($training);
                    echo '</div>';
                }
            }
            
            echo '</div>';
        }

        /*
        ============================
        TYPES OF SUPPORT OFFERED
        ============================
        */
        if ( have_rows('types_of_support', $post_id) ) {
            echo '<div class="fbc-types-of-support">';
            echo '<h3>Types of Support Offered</h3>';
            
            while ( have_rows('types_of_support', $post_id) ) {
                the_row();
                $support = get_sub_field('single_support');
                
                if ( $support ) {
                    echo '<div class="fbc-support-item">';
                    echo esc_html($support);
                    echo '</div>';
                }
            }
            
            echo '</div>';
        }

        /*
        ============================
        FAQ
        ============================
        */
        if ( have_rows('faq', $post_id) ) {
            echo '<div class="fbc-faq">';
            echo '<h3>Frequently Asked Questions</h3>';
            
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
                        echo wp_kses_post($answer);
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

        /*
        ============================
        BOOKING LINK
        ============================
        */
        if ( $booking_link = get_field('booking_link', $post_id) ) {
            echo '<div class="fbc-booking">';
            echo '<a href="'.esc_url($booking_link).'" class="fbc-booking-link" target="_blank">';
            echo 'Book an Appointment';
            echo '</a>';
            echo '</div>';
        }

        echo '</div>';
    }
}