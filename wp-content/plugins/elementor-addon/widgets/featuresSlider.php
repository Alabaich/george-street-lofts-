<?php

class Elementor_Features_Slider extends \Elementor\Widget_Base
{

    // Widget Name
    public function get_name()
    {
        return 'featuresSlider';
    }

    // Widget Title
    public function get_title()
    {
        return esc_html__('Features Slider', 'elementor-addon');
    }

    // Widget Icon
    public function get_icon()
    {
        return 'eicon-posts-carousel';
    }

    // Widget Categories
    public function get_categories()
    {
        return ['basic'];
    }

    // Register Widget Controls
    protected function register_controls()
    {
        // Section: General Titles
        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Sophisticated Building Features', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Experience luxury, comfort, and modern convenience in every detail.', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        // Section: Repeater Cards
        $this->start_controls_section(
            'section_cards',
            [
                'label' => esc_html__('Feature Cards', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'card_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'card_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Luxury Vinyl Flooring', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'card_description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Stylish, and easy to maintain for everyday living.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'features_list',
            [
                'label' => esc_html__('Features', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['card_title' => esc_html__('Luxury Vinyl Flooring', 'elementor-addon')],
                    ['card_title' => esc_html__('Soaring Ceilings', 'elementor-addon')],
                    ['card_title' => esc_html__('Smart Controls', 'elementor-addon')],
                ],
                'title_field' => '{{{ card_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    // Render Widget Output
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        $cards = $settings['features_list'];
        $card_count = count($cards);
        ?>
        <style>
            .featuresSlider-<?php echo esc_attr($widget_id); ?> {
                font-family: sans-serif;
                color: #333;
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .features-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-end;
                margin-bottom: 25px;
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .header-text-title {
                font-size: 2.5rem;
                margin: 0 0 5px 0;
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .header-text-subtitle {
                font-size: 1rem;
                color: #777;
                margin: 0;
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .slider-nav {
                display: flex;
                gap: 10px;
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .slider-nav-button {
                background-color: var(--Accent-color);
                border: none;
                border-radius: 5px;
                width: 40px;
                height: 40px;
                cursor: pointer;
                font-size: 1.2rem;
                transition: background-color 0.3s, border-color 0.3s;
                display: flex;
                justify-content: center;

                align-items: center;
            }

             .featuresSlider-<?php echo esc_attr($widget_id); ?> .slider-nav-button svg {
                width: 24px;
                height: 24px;
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .slider-nav-button svg path {
                fill: #fff;
                transition: fill 0.3s;
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .slider-nav-button:hover {
                background-color: var(--Brown-bg);
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .slider-nav-button:disabled {
                cursor: not-allowed;
                background-color: #fff;
                border: 1px solid #2c2d2c;
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .slider-nav-button:disabled svg path {
                fill: #2c2d2c;
            }

            .featuresSlider-<?php echo esc_attr($widget_id); ?> .slider-viewport {
                overflow: hidden;
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .slider-track {
                display: flex;
                transition: transform 0.4s ease-in-out;
                margin: 0 -15px; /* Compensate for card padding */
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .slider-card {
                flex: 0 0 33.333%;
                box-sizing: border-box;
                padding: 0 15px;
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .card-image {
                width: 100%;
                height: 250px;
                object-fit: cover;
                border-radius: 8px;
                margin-bottom: 15px;
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .card-title {
                font-size: 1.25rem;
                margin: 0 0 10px 0;
            }
            .featuresSlider-<?php echo esc_attr($widget_id); ?> .card-description {
                font-size: 1rem;
                color: #555;
                line-height: 1.5;
                margin: 0;
            }

            @media (max-width: 768px){
                .featuresSlider .features-header{
                    flex-direction: column;
                    align-items: center;
                    gap: 25px;
                }

                .featuresSlider .features-header *{
                    text-align: center;
                }

                .featuresSlider-<?php echo esc_attr($widget_id); ?> .slider-card {
    flex: 0 0 100%; /* Make each card take up the full width on mobile */
}
            }
        </style>

        <div id="featuresSlider-<?php echo esc_attr($widget_id); ?>" class="featuresSlider pageWidth featuresSlider-<?php echo esc_attr($widget_id); ?>">
            <div class="features-header">
                <div class="header-text">
                    <h2 class="header-text-title"><?php echo esc_html($settings['title']); ?></h2>
                    <p class="header-text-subtitle"><?php echo esc_html($settings['subtitle']); ?></p>
                </div>
                <?php if ($card_count > 3) : ?>
                <div class="slider-nav">
                    <button class="slider-nav-button slider-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16" fill="none">
  <path fill-rule="evenodd" clip-rule="evenodd" d="M6.93008 14.9887C7.33688 15.3954 7.99643 15.3954 8.40323 14.9887C8.81002 14.5819 8.81002 13.9223 8.40323 13.5156L2.8898 8.00212L8.40323 2.48869C8.81002 2.08189 8.81002 1.42234 8.40323 1.01555C7.99643 0.60875 7.33688 0.60875 6.93008 1.01555L0.680097 7.26554C0.273301 7.67235 0.273301 8.33189 0.680097 8.73869L6.93008 14.9887Z"/>
</svg></button>
                    <button class="slider-nav-button slider-next"><svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16" fill="none">
  <path fill-rule="evenodd" clip-rule="evenodd" d="M2.1539 14.9887C1.7471 15.3954 1.08756 15.3954 0.680758 14.9887C0.273967 14.5819 0.273967 13.9223 0.680758 13.5156L6.19419 8.00212L0.680758 2.48869C0.273967 2.08189 0.273967 1.42234 0.680758 1.01555C1.08756 0.60875 1.7471 0.60875 2.1539 1.01555L8.40389 7.26554C8.81068 7.67235 8.81068 8.33189 8.40389 8.73869L2.1539 14.9887Z"/>
</svg></button>
                </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($cards)) : ?>
            <div class="slider-viewport">
                <div class="slider-track">
                    <?php foreach ($cards as $item) : ?>
                        <div class="slider-card">
                            <?php if (!empty($item['card_image']['url'])) : ?>
                                <img src="<?php echo esc_url($item['card_image']['url']); ?>" alt="<?php echo esc_attr($item['card_title']); ?>" class="card-image">
                            <?php endif; ?>
                            <h3 class="card-title"><?php echo esc_html($item['card_title']); ?></h3>
                            <p class="card-description"><?php echo esc_html($item['card_description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <?php if ($card_count > 3) : ?>
        <script>
(function() {
    const widgetContainer = document.querySelector('#featuresSlider-<?php echo esc_attr($widget_id); ?>');
    if (!widgetContainer) return;

    const track = widgetContainer.querySelector('.slider-track');
    const cards = widgetContainer.querySelectorAll('.slider-card');
    const nextBtn = widgetContainer.querySelector('.slider-next');
    const prevBtn = widgetContainer.querySelector('.slider-prev');
    const cardCount = cards.length;
    let slidesPerView = 3; // Default value
    let currentIndex = 0;

    function updateSlidesPerView() {
        if (window.innerWidth <= 768) {
            slidesPerView = 1; // On mobile, show 1 slide
        } else {
            slidesPerView = 3; // On desktop, show 3 slides
        }
    }

    function updateSlider() {
        const cardWidth = 100 / slidesPerView;
        const offset = currentIndex * cardWidth;
        track.style.transform = `translateX(-${offset}%)`;
        updateNavButtons();
    }

    function updateNavButtons() {
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= cardCount - slidesPerView;
    }
    
    nextBtn.addEventListener('click', function() {
        if (currentIndex < cardCount - slidesPerView) {
            currentIndex++;
            updateSlider();
        }
    });

    prevBtn.addEventListener('click', function() {
        if (currentIndex > 0) {
            currentIndex--;
            updateSlider();
        }
    });

    // Listen for window resize to adjust the slider
    window.addEventListener('resize', function() {
        updateSlidesPerView();
        // Reset slider to the beginning to avoid weird positioning
        currentIndex = 0;
        updateSlider();
    });
    
    // Initial setup
    updateSlidesPerView();
    updateSlider();
})();
        </script>
        <?php endif; ?>
        <?php
    }
}
