<?php

class Elementor_FloorPlanSection extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'FloorPlanSection';
    }

    public function get_title()
    {
        return esc_html__('Floor Plan Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-h-align-stretch';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['floor', 'plan', 'space', 'unit', 'apartment', 'slider'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'floor_plan_heading',
            [
                'label' => esc_html__('Section Heading', 'elementor-addon'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label'       => esc_html__('Title', 'elementor-addon'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Find Your Perfect Space', 'elementor-addon'),
                'placeholder' => esc_html__('Enter section title', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'section_subtitle',
            [
                'label'       => esc_html__('Subtitle', 'elementor-addon'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Explore our thoughtfully designed floor plans', 'elementor-addon'),
                'placeholder' => esc_html__('Enter section subtitle', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'floor_plan_cards_section',
            [
                'label' => esc_html__('Floor Plan Cards', 'elementor-addon'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'unit_type',
            [
                'label'       => esc_html__('Unit Type', 'elementor-addon'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('STUDIO', 'elementor-addon'),
                'placeholder' => esc_html__('e.g., STUDIO, 1 BED', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'unit_name',
            [
                'label'       => esc_html__('Unit Name', 'elementor-addon'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Unit 201', 'elementor-addon'),
                'placeholder' => esc_html__('e.g., Unit 201', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'unit_price',
            [
                'label'       => esc_html__('Unit Price', 'elementor-addon'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('$1500 per month', 'elementor-addon'),
                'placeholder' => esc_html__('e.g., $1500 per month', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'floor_plan_image',
            [
                'label'   => esc_html__('Floor Plan Image', 'elementor-addon'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => 'https://placehold.co/300x400/fff/000?text=Floor+Plan'],
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label'   => esc_html__('Button Text', 'elementor-addon'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Floor Plan', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'elementor-addon'),
                'type'  => \Elementor\Controls_Manager::URL,
                'options' => ['url'],
                'default' => ['url' => '#'],
            ]
        );

        $this->add_control(
            'floor_plan_list',
            [
                'label'       => esc_html__('Floor Plans', 'elementor-addon'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    ['unit_name' => 'Unit 201'],
                    ['unit_name' => 'Unit 202'],
                    ['unit_name' => 'Unit 203'],
                    ['unit_name' => 'Unit 204'],
                ],
                'title_field' => 'Unit: {{{ unit_name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        $button_color = '#A87F58';
        $button_hover_color = '#7C5E45';
?>

        <style>
            .floor-plan-section-<?php echo esc_attr($widget_id); ?> {
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 50px;
                position: relative;
                align-items: center;
                /* HIDE HORIZONTAL SCROLLBAR */
                overflow-x: hidden;
            }

            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .floor-plan-header h1 {
                margin-bottom: 5px;
            }

            .floor-plan-slider-<?php echo esc_attr($widget_id); ?> {
                width: 100%;
                margin: 0 auto;
                position: relative;
                padding: 0 15px;
            }

            .floor-plan-card-<?php echo esc_attr($widget_id); ?> {
                text-align: left;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }

            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .floor-plan-image-wrapper {
                border: 1px solid #ddd;
                padding: 15px;
                margin-bottom: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 400px;
                width: 100%;
            }

            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .floor-plan-image-wrapper img {
                max-width: 100%;
                max-height: 100%;
                height: auto;
                display: block;
            }

            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .unit-type {
                font-size: 12px;
                color: #555;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin: 0;
            }

            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .unit-name {
                font-size: 24px;
                color: #333;
                margin: 5px 0 10px 0;
            }

            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .unit-price {
                font-size: 16px;
                color: #777;
                margin: 0 0 15px 0;
            }

            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .floor-plan-slider-wrapper {
                position: relative;
                width: 100%;
            }

            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-prev,
            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-next {
                position: absolute;
                top: 50%;
                /* Reset transform to only translateY */
                transform: translateY(-50%); 
                z-index: 10;
                width: 48px;
                height: 48px;
                border-radius: 4px;
                border: 1px solid var(--Color-Grey, #9E9E9E);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s;
                color: #A87F58;
                background: #fff;
                font-size: 20px;
                font-weight: bold;
            }
            
            /* CORRECTED STYLES FOR NAVIGATION BUTTONS */
            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-prev {
                left: 0;
                /* Use translate to move the button outside without causing overflow/scroll */
                transform: translate(-25%, -50%); 
            }

            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-next {
                right: 0;
                /* Use translate to move the button outside without causing overflow/scroll */
                transform: translate(25%, -50%); 
            }
            /* END CORRECTED STYLES */

            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-prev svg path,
            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-next svg path {
                fill: #2c2d2c;
                transition: fill 0.3s;
            }

            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-prev:hover,
            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-next:hover {
                background: #A87F58;
                color: #fff;
                border-color: #A87F58;
            }

            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-prev:hover svg path,
            .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-next:hover svg path {
                fill: #fff;
            }

            /* REMOVED .floor-plan-slider-pagination AND .splide-bullet STYLES */

            @media (min-width: 769px) {
                .floor-plan-slider-<?php echo esc_attr($widget_id); ?> {
                    padding: 0;
                }
            }

            @media (max-width: 1200px) {
                .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-prev {
                    transform: translate(-80%, -50%);
                }
                .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-next {
                    transform: translate(80%, -50%);
                }
            }

            @media (max-width: 768px) {
                .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-prev,
                .floor-plan-section-<?php echo esc_attr($widget_id); ?> .neighbourhood-slider-next {
                    transform: none;
                }
                .floor-plan-section-<?php echo esc_attr($widget_id); ?> .floor-plan-slider-nav {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    gap: 1rem;
                    margin-top: 2rem;
                }
            }
        </style>

        <div class="floor-plan-section floor-plan-section-<?php echo esc_attr($widget_id); ?> pageWidth">

            <div class="floor-plan-header gsl-heading-wrapper">
                <?php if (!empty($settings['section_title'])) : ?>
                    <h1><?php echo esc_html($settings['section_title']); ?></h1>
                <?php endif; ?>

                <?php if (!empty($settings['section_subtitle'])) : ?>
                    <p class="text"><?php echo esc_html($settings['section_subtitle']); ?></p>
                <?php endif; ?>
            </div>

            <div class="floor-plan-slider-wrapper">
                <div class="floor-plan-slider floor-plan-slider-<?php echo esc_attr($widget_id); ?> splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php foreach ($settings['floor_plan_list'] as $card) : ?>
                                <li class="splide__slide">
                                    <div class="floor-plan-card floor-plan-card-<?php echo esc_attr($widget_id); ?>">
                                        <div class="floor-plan-image-wrapper">
                                            <img src="<?php echo esc_url($card['floor_plan_image']['url']); ?>" alt="<?php echo esc_attr($card['unit_name']); ?>">
                                        </div>

                                        <?php if (!empty($card['unit_type'])) : ?>
                                            <p class="unit-type"><?php echo esc_html($card['unit_type']); ?></p>
                                        <?php endif; ?>

                                        <?php if (!empty($card['unit_name'])) : ?>
                                            <h3 class="unit-name"><?php echo esc_html($card['unit_name']); ?></h3>
                                        <?php endif; ?>

                                        <?php if (!empty($card['unit_price'])) : ?>
                                            <p class="unit-price"><?php echo esc_html($card['unit_price']); ?></p>
                                        <?php endif; ?>

                                        <?php if (!empty($card['button_text']) && !empty($card['button_link']['url'])) :
                                            $target = $card['button_link']['is_external'] ? ' target="_blank"' : '';
                                            $nofollow = $card['button_link']['nofollow'] ? ' rel="nofollow"' : '';
                                        ?>
                                            <a href="<?php echo esc_url($card['button_link']['url']); ?>" class="mainButton" <?php echo esc_attr($target . $nofollow); ?>>
                                                <?php echo esc_html($card['button_text']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="neighbourhood-slider-prev floor-plan-slider-prev-<?php echo esc_attr($widget_id); ?>">
                    <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9301 18.9889C14.3369 19.3957 14.9964 19.3957 15.4032 18.9889C15.81 18.5822 15.81 17.9226 15.4032 17.5158L9.8898 12.0024L15.4032 6.48893C15.81 6.08213 15.81 5.42259 15.4032 5.01579C14.9964 4.60899 14.3369 4.60899 13.9301 5.01579L7.6801 11.2658C7.2733 11.6726 7.2733 12.3321 7.6801 12.7389L13.9301 18.9889Z" fill="currentColor" />
                    </svg>
                </div>
                
                <div class="neighbourhood-slider-next floor-plan-slider-next-<?php echo esc_attr($widget_id); ?>">
                    <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.15292 18.9889C8.74612 19.3957 8.08658 19.3957 7.67978 18.9889C7.27299 18.5822 7.27299 17.9226 7.67978 17.5158L13.1932 12.0024L7.67978 6.48893C7.27299 6.08213 7.27299 5.42259 7.67978 5.01579C8.08658 4.60899 8.74612 4.60899 9.15292 5.01579L15.4029 11.2658C15.8097 11.6726 15.8097 12.3321 15.4029 12.7389L9.15292 18.9889Z" fill="currentColor" />
                    </svg>
                </div>
            </div>

            <a href="#" class="mainButton">
                <?php echo esc_html__('View Suites', 'elementor-addon'); ?>
            </a>
        </div>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

        <script>
            (function($) {
                if (typeof Splide === 'undefined') {
                    return;
                }

                var initSplide = function() {
                    var widgetId = '<?php echo esc_js($widget_id); ?>';
                    var selector = '.floor-plan-slider-' + widgetId;
                    var splideElement = document.querySelector(selector);

                    if (!splideElement) {
                        return;
                    }

                    var splide = new Splide(splideElement, {
                        type: 'loop',
                        perPage: 3,
                        perMove: 1,
                        gap: '30px',
                        // Smooth animation speed
                        speed: 800,
                        arrows: false,
                        // Set pagination to false as requested
                        pagination: false,
                        breakpoints: {
                            1024: {
                                perPage: 2,
                                perMove: 1
                            },
                            768: {
                                perPage: 1,
                                perMove: 1
                            }
                        }
                    }).mount();

                    var prevButton = document.querySelector('.floor-plan-slider-prev-' + widgetId);
                    var nextButton = document.querySelector('.floor-plan-slider-next-' + widgetId);
                    // Removed pagination variable

                    if (prevButton) {
                        prevButton.addEventListener('click', (e) => {
                            e.preventDefault();
                            splide.go('<');
                        });
                    }
                    if (nextButton) {
                        nextButton.addEventListener('click', (e) => {
                            e.preventDefault();
                            splide.go('>');
                        });
                    }

                    // Removed renderPagination function and splide.on('mounted move', ...)
                };

                $(window).on('elementor/frontend/init', function() {
                    elementorFrontend.hooks.addAction('frontend/element_ready/FloorPlanSection.default', function($scope) {
                        initSplide();
                    });
                });
            })(jQuery);
        </script>
<?php
    }
}