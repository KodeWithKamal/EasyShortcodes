<?php

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Easy_FAQ_Shortcode {

    public function __construct() {
        add_shortcode( 'faqs', array( $this, 'render_faqs' ) );
        add_shortcode('faq', array( $this, 'render_faq' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    public function enqueue_scripts() {
        global $post;
        if ( ! is_a( $post, 'WP_Post' ) || ! has_shortcode( $post->post_content, 'faqs' ) ) {
            return;
        }
        wp_enqueue_style( 'easy-faq-style', plugin_dir_url( dirname(__FILE__) ) . 'assets/css/faq.css', array(), '1.0.0' );
        wp_enqueue_script( 'easy-faq-script', plugin_dir_url( dirname(__FILE__) ) . 'assets/js/faq.js', array('jquery'), '1.0.0', true );
    }

    function render_faqs( $atts, $content = null ){
        $atts = shortcode_atts([
            'style' => 'modern',
        ], $atts);

        $output = '<div class="faqs-container '.esc_attr($atts['style']).'">';
        $output .= do_shortcode( $content );
        $output .= '</div>';
        return $output;
    }

    public function render_faq($atts, $content = null){
        $atts = shortcode_atts([
            'q' => 'Question',
            'ans' => 'Answer',
            'open' => 'false',
        ], $atts);

         $id = 'faq-' . uniqid();
        $active_class = $atts['open'] === 'true' ? 'faq-active' : '';

        $output = '<div class="faq-item">';
        $output .= '<div class="faq-question ' . esc_attr($active_class) . '" data-faq-id="' . esc_attr($id) . '">' . esc_html($atts['q']) . '</div>';
        $output .= '<div class="faq-answer" id="' . esc_attr($id) . '" style="display: ' . ($atts['open'] === 'true' ? 'block' : 'none') . ';">' . esc_html($atts['ans']) . '</div>';
        $output .= '</div>';

        return $output;

    }
}