<?php

class Elementor_CityLifeWidget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'CityLifeWidget';
    }

    public function get_title()
    {
        return esc_html__('City Life Carousel', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['city', 'life', 'peterborough', 'attractions', 'slider', 'splide'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Live In The Heart Of Peterborough', 'elementor-addon'),
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
                'default' => esc_html__('Millennium Park', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'card_description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('A scenic riverside park with walking trails, summer festivals, and live events.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'cards_list',
            [
                'label' => esc_html__('Attraction Cards', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'card_title' => 'Millennium Park',
                        'card_description' => 'A scenic riverside park with walking trails, summer festivals, and live events.',
                    ],
                    [
                        'card_title' => 'Otonabee River',
                        'card_description' => 'A scenic riverside park with walking trails, summer festivals, and live events.',
                    ],
                    [
                        'card_title' => 'Beavermead Park',
                        'card_description' => 'A large green space with a sandy beach, picnic areas, and outdoor activities.',
                    ],
                    [
                        'card_title' => 'Trent University',
                        'card_description' => 'A major public research university known for its beautiful riverfront campus.',
                    ],
                ],
                'title_field' => '{{{ card_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();

        if (empty($settings['cards_list'])) {
            return;
        }

        $main_cards = $settings['cards_list'];

        $svg_prev_arrow = '<svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.9301 18.9889C14.3369 19.3957 14.9964 19.3957 15.4032 18.9889C15.81 18.5822 15.81 17.9226 15.4032 17.5158L9.8898 12.0024L15.4032 6.48893C15.81 6.08213 15.81 5.42259 15.4032 5.01579C14.9964 4.60899 14.3369 4.60899 13.9301 5.01579L7.6801 11.2658C7.2733 11.6726 7.2733 12.3321 7.6801 12.7389L13.9301 18.9889Z" fill="currentColor" /></svg>';
        $svg_next_arrow = '<svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.15292 18.9889C8.74612 19.3957 8.08658 19.3957 7.67978 18.9889C7.27299 18.5822 7.27299 17.9226 7.67978 17.5158L13.1932 12.0024L7.67978 6.48893C7.27299 6.08213 7.27299 5.42259 7.67978 5.01579C8.08658 4.60899 8.74612 4.60899 9.15292 5.01579L15.4029 11.2658C15.8097 11.6726 15.8097 12.3321 15.4029 12.7389L9.15292 18.9889Z" fill="currentColor" /></svg>';
?>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

        <style>
            .splide__pagination {
                display: none !important;
            }

            .city-life-container-<?php echo esc_attr($widget_id); ?> {
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 50px;
            }

            .city-life-header {
                color: var(--Text-color, #5C5C5C);
                text-align: center;
                font-family: "Open Sans", sans-serif;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
                text-transform: uppercase;
            }

            .city-life-title {
                color: var(--Black, #32302F);
                text-align: center;
                font-family: "Cormorant", serif;
                font-size: 48px;
                font-style: normal;
                font-weight: 500;
                line-height: 110%;
                letter-spacing: -0.48px;
                text-transform: capitalize;
            }

            .splide__slide .card-image-wrap {
                height: 250px;
                margin-bottom: 20px;
                border-radius: 5px;
                overflow: hidden;
                box-sizing: border-box;
            }

            .splide__slide .card-image-wrap img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .splide__slide:hover .card-image-wrap img {
                transform: scale(1.05);
            }

            .splide__slide .card-title {
                font-size: 1.4em;
                font-weight: 600;
                margin-bottom: 10px;
                color: #333;
                text-align: left;
            }

            .splide__slide .card-description {
                font-size: 0.95em;
                line-height: 1.6;
                color: #666;
                text-align: left;
            }

            .custom-splide-controls-<?php echo esc_attr($widget_id); ?> {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 15px;
                margin-top: 30px;
            }

            .splide__arrows {
                display: none;
            }

            .custom-splide-controls-<?php echo esc_attr($widget_id); ?> .nav-arrow {
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
                text-decoration: none;
            }

            .custom-splide-controls-<?php echo esc_attr($widget_id); ?> .nav-arrow svg path {
                fill: #2c2d2c;
                transition: fill 0.3s;
            }

            .custom-splide-controls-<?php echo esc_attr($widget_id); ?> .nav-arrow:hover {
                background: #A87F58;
                color: #fff;
            }

            .custom-splide-controls-<?php echo esc_attr($widget_id); ?> .nav-arrow:hover svg path {
                fill: #fff;
            }

            .custom-pagination-list {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 5px;
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .custom-pagination-list li {
                margin: 0;
                padding: 0;
                line-height: 0;
            }

            .custom-pagination-list li button {
                background-color: #D3D3D3;
                width: 10px;
                height: 10px;
                border-radius: 50%;
                cursor: pointer;
                opacity: 1;
                margin: 0;
                transition: background-color 0.3s;
                border: none;
                padding: 0;
                line-height: 0;
                font-size: 0;
                box-shadow: none;
                transform: none;
            }

            .custom-pagination-list li button.is-active {
                background-color: #A87F58;
                transform: none;
            }
        </style>

        <div class="pageWidth city-life-container-<?php echo esc_attr($widget_id); ?>">
            <div class="gsl-heading-wrapper">
                <p class="city-life-header">CITY LIFE</p>
                <h2 class="city-life-title">
                    <?php echo esc_html($settings['section_title']); ?>
                </h2>
            </div>

            <div id="city-splide-<?php echo esc_attr($widget_id); ?>" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                        foreach ($main_cards as $item) :
                            $image_url = !empty($item['card_image']['url']) ? $item['card_image']['url'] : \Elementor\Utils::get_placeholder_image_src();
                        ?>
                            <li class="splide__slide">
                                <div class="card-image-wrap">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($item['card_title']); ?>">
                                </div>
                                <h3 class="card-title"><?php echo esc_html($item['card_title']); ?></h3>
                                <p class="card-description"><?php echo esc_html($item['card_description']); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="custom-splide-controls-<?php echo esc_attr($widget_id); ?>">
                    <a class="nav-arrow prev">
                        <?php echo $svg_prev_arrow; ?>
                    </a>

                    <ul class="custom-pagination-list" id="pagination-list-<?php echo esc_attr($widget_id); ?>"></ul>

                    <a class="nav-arrow next">
                        <?php echo $svg_next_arrow; ?>
                    </a>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

        <script>
            (function() {
                var widgetId = 'city-splide-<?php echo esc_js($widget_id); ?>';
                var splideElement = document.getElementById(widgetId);
                var paginationListId = 'pagination-list-<?php echo esc_js($widget_id); ?>';

                if (!splideElement) return;

                var splideInstance = new Splide('#' + widgetId, {
                    type: 'loop',
                    perPage: 3,
                    perMove: 1,
                    gap: '25px',
                    pagination: true,
                    arrows: false, // Set back to FALSE since we use manual click handlers now
                    drag: true,
                    mediaQuery: 'min',
                    breakpoints: {
                        769: {
                            perPage: 3,
                            perMove: 1,
                            gap: '25px',
                            padding: 0
                        },
                        0: {
                            perPage: 1,
                            perMove: 1,
                            gap: '20px',
                            padding: '10%'
                        }
                    }
                });

                splideInstance.on('mounted', function() {
                    var defaultPagination = splideElement.querySelector('.splide__pagination');
                    var customPaginationTarget = document.getElementById(paginationListId);

                    if (defaultPagination && customPaginationTarget) {
                        // Move all list items (dots) from Splide's generated container
                        while (defaultPagination.firstChild) {
                            customPaginationTarget.appendChild(defaultPagination.firstChild);
                        }
                    }

                    // Explicitly attach click listeners to the custom arrow elements
                    var prevArrow = splideElement.querySelector('.nav-arrow.prev');
                    var nextArrow = splideElement.querySelector('.nav-arrow.next');

                    if (prevArrow) {
                        prevArrow.addEventListener('click', function(e) {
                            e.preventDefault(); // Prevent <a> tag from changing URL
                            splideInstance.go('<');
                        });
                    }
                    if (nextArrow) {
                        nextArrow.addEventListener('click', function(e) {
                            e.preventDefault(); // Prevent <a> tag from changing URL
                            splideInstance.go('>');
                        });
                    }
                });

                splideInstance.mount();

            })();
        </script>
<?php
    }
}