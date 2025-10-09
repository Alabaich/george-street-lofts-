<?php

/**
 * Plugin Name: George Street Additional Widgets
 * Description: Simple hello world widgets for Elementor.
 * Version:     1.0.1
 * Author:      Enjoyable Design
 * Author URI:  https://enjoyable.design/
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
    require_once(__DIR__ . '/widgets/3DSuiteViewer.php');
    require_once(__DIR__ . '/widgets/hotspotViewer.php');
    require_once(__DIR__ . '/widgets/awards.php');
    require_once(__DIR__ . '/widgets/splitHeroSection.php');
    require_once(__DIR__ . '/widgets/horizontalAutoCarousel.php');
    require_once(__DIR__ . '/widgets/switchSideDropdowns.php');
    require_once(__DIR__ . '/widgets/imagesTabs.php');
    require_once(__DIR__ . '/widgets/featuresSlider.php');
    require_once(__DIR__ . '/widgets/gallerySlider.php');
    require_once(__DIR__ . '/widgets/contactUsPageForm.php');
    require_once(__DIR__ . '/widgets/secondGallerySlider.php');
    require_once(__DIR__ . '/widgets/galleryGrid.php');
    require_once(__DIR__ . '/widgets/featuresGridTabs.php');
    require_once(__DIR__ . '/widgets/atriaAdvantageSection.php');
    require_once(__DIR__ . '/widgets/executiveTeamSection.php');
    require_once(__DIR__ . '/widgets/animatedScoreSection.php'); 
    require_once(__DIR__ . '/widgets/cityLifeWidget.php'); 
    require_once(__DIR__ . '/widgets/amenitiesGrid.php'); 
    require_once(__DIR__ . '/widgets/developmentsPortfolio.php'); 
    require_once(__DIR__ . '/widgets/formForContact.php'); 

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
    $widgets_manager->register(new \Elementor_3DSuiteViewer());
    $widgets_manager->register(new \Elementor_HotspotViewer());
    $widgets_manager->register(new \Elementor_AwardsAndRecognition());
    $widgets_manager->register(new \Elementor_SplitHeroSection());
    $widgets_manager->register(new \Elementor_HorizontalAutoCarousel());
    $widgets_manager->register(new \Elementor_SwitchSideDropdowns());
    $widgets_manager->register(new \Elementor_ImagesTabs());
    $widgets_manager->register(new \Elementor_Features_Slider());
    $widgets_manager->register(new \Elementor_GallerySlider());
    $widgets_manager->register(new \Elementor_ContactUsPageForm());
    $widgets_manager->register(new \Elementor_SecondGallerySlider());
    $widgets_manager->register(new \Elementor_GalleryGrid());
    $widgets_manager->register(new \Elementor_FeaturesGridTabs());
    $widgets_manager->register(new \Elementor_AtriaAdvantageSection());
    $widgets_manager->register(new \Elementor_ExecutiveTeamSection());
    $widgets_manager->register(new \Elementor_ScoreCircleWidget());
    $widgets_manager->register(new \Elementor_CityLifeWidget());
    $widgets_manager->register(new \Elementor_AmenitiesGridWidget());
    $widgets_manager->register(new \Elementor_DevelopmentsPortfolioWidget());
    $widgets_manager->register(new \Elementor_formForContact());
}

add_action('elementor/widgets/register', 'register_hello_world_widget');