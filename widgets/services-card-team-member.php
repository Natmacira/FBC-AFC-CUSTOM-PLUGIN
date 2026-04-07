<?php

if (!defined('ABSPATH')) exit;

class FBC_Service_Providers_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'fbc_service_providers_grid';
    }

    public function get_title() {
        return 'Service Providers Grid';
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function register_controls() {

        $this->start_controls_section('section_style', [
            'label' => 'Card Style',
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('card_bg_color', [
            'label'     => 'Card Background',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => ['{{WRAPPER}} .fbc-provider-card' => 'background-color: {{VALUE}};'],
        ]);

        $this->add_control('name_color', [
            'label'     => 'Name Color',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#1a1a2e',
            'selectors' => ['{{WRAPPER}} .fbc-provider-name' => 'color: {{VALUE}};'],
        ]);

        $this->end_controls_section();
    }

    protected function render() {

            // Enqueue styles
            wp_enqueue_style(
                'fbc-team-member-styles',
                plugins_url('assets/css/services-card.css', dirname(__FILE__)),
                [],
                '1.0.0'
            );
          

        $post_id   = get_the_ID();
        $providers = get_field('providers', $post_id);

        if (empty($providers)) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<p>No providers assigned to this service.</p>';
            }
            return;
        }
        ?>
        <div class="fbc-providers-grid">
            <?php foreach ($providers as $provider) :
                $provider_id  = $provider->ID;

                // Skip providers that are not published
                if ( get_post_status( $provider_id ) !== 'publish' ) continue;

                $permalink    = get_permalink($provider_id);
                $title        = get_the_title($provider_id);
                $specializes  = get_field('specializes_in', $provider_id);
                $photo        = get_the_post_thumbnail($provider_id, 'medium');
                $team_content = get_field('team_content', $provider_id);
                $job_title    = !empty($team_content['job_title']) ? $team_content['job_title'] : '';
                $additional_info = !empty($team_content['additional_info']) ? $team_content['additional_info'] : '';
            ?>
                <div class="fbc-provider-card">

                    <?php if ($photo) : ?>
                        <div class="fbc-provider-photo">
                            <?php echo $photo; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($additional_info) :
                        $badge_class = strpos($additional_info, 'Not Accepting') !== false ? 'fbc-badge--grey' : 'fbc-badge--green';
                    ?>
                        <span class="fbc-provider-badge <?php echo $badge_class; ?>"><?php echo esc_html($additional_info); ?></span>
                    <?php endif; ?>

                    <div class="fbc-provider-info">

                        <div class="fbc-provider-info-inner-container">
                            <h3 class="fbc-provider-name">
                                <a href="<?php echo esc_url($permalink); ?>">
                                    <?php echo esc_html($title); ?>
                                    <span class="fbc-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M17 5.13695C17 4.84977 16.8859 4.57435 16.6829 4.37129C16.4798 4.16822 16.2044 4.05414 15.9172 4.05414L7.25471 4C6.96753 4 6.69211 4.11408 6.48905 4.31715C6.28598 4.52021 6.1719 4.79563 6.1719 5.08281C6.1719 5.36999 6.28598 5.64541 6.48905 5.84847C6.69211 6.05154 6.96753 6.16562 7.25471 6.16562H13.2751L4.32029 15.1421C4.2188 15.2428 4.13825 15.3625 4.08328 15.4945C4.0283 15.6264 4 15.768 4 15.9109C4 16.0539 4.0283 16.1954 4.08328 16.3273C4.13825 16.4593 4.2188 16.579 4.32029 16.6797C4.42095 16.7812 4.54071 16.8618 4.67266 16.9167C4.80462 16.9717 4.94614 17 5.08909 17C5.23203 17 5.37356 16.9717 5.50551 16.9167C5.63746 16.8618 5.75722 16.7812 5.85788 16.6797L14.8344 7.70321V13.7453C14.8344 14.0325 14.9485 14.3079 15.1515 14.511C15.3546 14.714 15.63 14.8281 15.9172 14.8281C16.2044 14.8281 16.4798 14.714 16.6829 14.511C16.8859 14.3079 17 14.0325 17 13.7453V5.13695Z" fill="#8DCBC6"></path></svg></span>
                                </a>
                            </h3>

                            <?php if ($job_title) : ?>
                                <p class="fbc-provider-position">
                                    <?php echo esc_html($job_title); ?>
                                </p>
                            <?php endif; ?>

                            <?php if (!empty($specializes)) : ?>
                                <div class="fbc-provider-specializes">
                                    <span class="fbc-specializes-label">SPECIALIZES IN:</span>
                                    <p><?php echo esc_html(implode(', ', $specializes)); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                            <a href="https://onelife.janeapp.com/" class="fbc-book-now" target="_blank">
                                Book Now <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4 10.5H17M17 10.5L11.5 5M17 10.5L11.5 16" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>

                       
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}