<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class FBC_ACF_Elementor_Field_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'fbc_acf_field';
    }

    public function get_title() {
        return 'FBC ACF Field';
    }

    public function get_icon() {
        return 'eicon-database';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => 'Field',
            ]
        );

        $this->add_control(
            'field_name',
            [
                'label' => 'Field Name',
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_acf_fields(),
            ]
        );

        $this->add_control(
            'sub_field',
            [
                'label' => 'Sub Field',
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

    }


    private function get_acf_fields() {

        $choices = [];

        if ( ! function_exists('acf_get_field_groups') ) return $choices;

        $groups = acf_get_field_groups();

        foreach ( $groups as $group ) {

            $fields = acf_get_fields( $group['key'] );

            foreach ( $fields as $field ) {

                $choices[$field['name']] =
                    $field['label'] . ' (' . $field['name'] . ')';

            }

        }

        return $choices;

    }



    protected function render() {

        $settings = $this->get_settings_for_display();

        $field = $settings['field_name'];
        $sub_field = $settings['sub_field'];

        if ( empty($field) ) return;

        $post_id = get_the_ID();

        $value = get_field($field, $post_id);

        if ( $sub_field && isset($value[$sub_field]) ) {
            $value = $value[$sub_field];
        }

        if ( empty($value) ) return;

        echo '<div class="fbc-acf-field fbc-acf-' . esc_attr($field) . '">';

        echo $this->render_value($value);

        echo '</div>';

    }



    private function render_value($value) {

        if ( is_scalar($value) ) {

            return wp_kses_post($value);

        }

        if ( is_array($value) ) {

            $output = '';

            foreach ($value as $item) {

                if ( is_scalar($item) ) {

                    $output .= '<div>' . wp_kses_post($item) . '</div>';

                }

                elseif ( is_array($item) ) {

                    foreach ($item as $sub) {

                        if ( is_scalar($sub) ) {

                            $output .= '<div>' . wp_kses_post($sub) . '</div>';

                        }

                    }

                }

            }

            return $output;

        }

        if ( is_object($value) ) {

            if ( isset($value->post_title) ) {

                return esc_html($value->post_title);

            }

        }

        return '';

    }

}