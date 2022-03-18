<?php

/**
 * 
 * Plugin Name: GSAP Marquee
 * Plugin URI: https://stefanomonteiro.com/wp-plugins
 * Author: Stefano Monteiro
 * Author URI: https://stefanomonteiro.com
 * Version: 1.0.0
 * Description: Create GSAP Marquee
 * Text Domain: sm_
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Basic security, prevents file from being loaded directly.
defined('ABSPATH') or die('Cheatin&#8217; uh?');

if (!function_exists('add_gsap_marquee_shortcode')) {
    function add_gsap_marquee_shortcode($atts)
    {

        $a = shortcode_atts(array(
            'text'      => 'Insert a text inside the shortcode',
            'separator' => '·',
            'clone'     => 3,
            'hover_pause' => false,
            // 'scrub'     => false,
            'reversed'  => false,
            'speed'  => false,
            'extra_class'   => ''
        ), $atts);


        $inner_marquee = '';
        for ($i=0; $i < $a['clone']; $i++) { 
            $inner_marquee = $inner_marquee . '<span class="sm-marquee-item" >
                                                    <span>'. $a['text'] . '</span>
                                                </span>
                                                <span class="sm-marquee-item">
                                                    <span class="separator">' . $a['separator'] . '</span>
                                                </span>';
        }
     
        $html = ' <div class="sm-marquee-wrapper gsap-autoAlpha--marquee   ' . $a['extra_class'] . ' " >
                        <div class="sm-marquee-line" data-hover_pause="' . $a['hover_pause'] . '" data-reversed="' . $a['reversed'] . '" data-speed="' . $a['speed'] . '">
                            '. $inner_marquee .'
                        </div>
                    </div>';


        // Enqueue
        if (!wp_style_is('gsap_marquee-css', 'enqueued')) {
            wp_enqueue_style('gsap_marquee-css');
        }
        if (!wp_script_is('gsap_marquee-js', 'enqueued')) {
            wp_localize_script('gsap_marquee-js', 'php_marquee', $a);
            wp_enqueue_script('gsap_marquee-js');
        }

        return $html;
    }
}
add_shortcode('gsap_marquee', 'add_gsap_marquee_shortcode');

wp_register_style('gsap_marquee-css', plugin_dir_url(__FILE__) . 'css/gsap_marquee.css', [], '1.0.0');
wp_register_script('GSAP', plugin_dir_url(__FILE__) . 'js/GSAP/gsap.min.js', [], '1.0.0', true);
wp_register_script('ScrollTrigger', plugin_dir_url(__FILE__) . 'js/GSAP/ScrollTrigger.min.js', ['GSAP'], '1.0.0', true);
wp_register_script('gsap_marquee-js', plugin_dir_url(__FILE__) . 'js/gsap_marquee.js', ['GSAP', 'ScrollTrigger'], '1.0.0', true);

//! Enqueue Scripts Elementor Editor
if (!function_exists('gsap_marquee_enqueue_styles_elementor_editor')) {
    function gsap_marquee_enqueue_styles_elementor_editor()
    {

        if (!wp_style_is('gsap_marquee-css', 'enqueued')) {
            wp_enqueue_style('gsap_marquee-css');
        }
    }
}

if (!function_exists('gsap_marquee_enqueue_scripts_elementor_editor')) {
    function gsap_marquee_enqueue_scripts_elementor_editor()
    {

        if (!wp_script_is('gsap_marquee-js', 'enqueued')) {
            wp_enqueue_script('gsap_marquee-js');
        }
    }
}

// Add Action elementor/preview/enqueue_styles 
add_action('elementor/preview/enqueue_styles', 'gsap_marquee_enqueue_styles_elementor_editor');
add_action('elementor/preview/enqueue_scripts', 'gsap_marquee_enqueue_scripts_elementor_editor');
