<?php

/**
 * Plugin Name: Elementor Addon
 * Description: Simple hello world widgets for Elementor.
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-addon
 */

function register_hello_world_widget($widgets_manager)
{

    require_once(__DIR__ . '/widgets/switchSideImage.php');
    require_once(__DIR__ . '/widgets/ImageGallerySection.php');
    require_once(__DIR__ . '/widgets/GslTabsSection.php');
    require_once(__DIR__ . '/widgets/NeighbourhoodSection.php');
    require_once(__DIR__ . '/widgets/FloorPlanSection.php');
    require_once(__DIR__ . '/widgets/atriaDevelopmentSection.php');
    require_once(__DIR__ . '/widgets/landAcknowledgementSection.php');
    require_once(__DIR__ . '/widgets/testimonialsSection.php');
    require_once(__DIR__ . '/widgets/advantagesSection.php');
    require_once(__DIR__ . '/widgets/blogShowcase.php');
    require_once(__DIR__ . '/widgets/aboutUsHero.php');
    require_once(__DIR__ . '/widgets/suitsCatalog.php');

    $widgets_manager->register(new \Elementor_switchSideImage());
    $widgets_manager->register(new \Elementor_ImageGallerySection());
    $widgets_manager->register(new \Elementor_GslTabsSection());
    $widgets_manager->register(new \Elementor_NeighbourhoodSection());
    $widgets_manager->register(new \Elementor_FloorPlanSection());
    $widgets_manager->register(new \Elementor_AtriaDevelopmentSection());
    $widgets_manager->register(new \Elementor_LandAcknowledgementSection());
    $widgets_manager->register(new \Elementor_TestimonialsSection());
    $widgets_manager->register(new \Elementor_AdvantagesSection());
    $widgets_manager->register(new \Elementor_BlogShowcase());
    $widgets_manager->register(new \Elementor_AboutUsHero());
    $widgets_manager->register(new \Elementor_SuitesCatalog());
}
add_action('elementor/widgets/register', 'register_hello_world_widget');
