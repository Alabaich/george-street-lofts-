<?php

class Elementor_NeighbourhoodSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'NeighbourhoodSection';
    }

    public function get_title()
    {
        return esc_html__('Neighbourhood Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['neighbourhood', 'slider', 'gallery', 'location', 'george', 'street'];
    }

    protected function register_controls()
    {
        // === Section Heading ===
        $this->start_controls_section(
            'neighbourhood_heading',
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
                'default'     => esc_html__('Neighbourhood', 'elementor-addon'),
                'placeholder' => esc_html__('Enter section title', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'section_subtitle',
            [
                'label'       => esc_html__('Subtitle', 'elementor-addon'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Explore what’s around', 'elementor-addon'),
                'placeholder' => esc_html__('Enter section subtitle', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        // === Slider Content ===
        $this->start_controls_section(
            'neighbourhood_slider_section',
            [
                'label' => esc_html__('Slider Content', 'elementor-addon'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'neighbourhood_slide_image',
            [
                'label'   => esc_html__('Slide Image', 'elementor-addon'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => 'https://placehold.co/800x600/4D4337/FFF'],
            ]
        );

        $this->add_control(
            'neighbourhood_slides',
            [
                'label'       => esc_html__('Slides', 'elementor-addon'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    ['neighbourhood_slide_image' => ['url' => 'https://placehold.co/800x600/4D4337/FFF']],
                    ['neighbourhood_slide_image' => ['url' => 'https://placehold.co/800x600/888/FFF']],
                    ['neighbourhood_slide_image' => ['url' => 'https://placehold.co/800x600/333/FFF']],
                ],
                'title_field' => 'Image Slide',
            ]
        );

        $this->end_controls_section();

        // === Button Settings ===
        $this->start_controls_section(
            'neighbourhood_button_section',
            [
                'label' => esc_html__('Button', 'elementor-addon'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => esc_html__('Button Text', 'elementor-addon'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Learn More', 'elementor-addon'),
                'placeholder' => esc_html__('Enter button text', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label'         => esc_html__('Button Link', 'elementor-addon'),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => esc_html__('https://your-link.com', 'elementor-addon'),
                'show_external' => true,
                'default'       => [
                    'url'         => '',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <style>
            .neighbourhood-section {
                background: #fff;
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 50px;
                overflow: hidden;
            }

            .neighbourhood-slider {
                position: relative;
            }

            .neighbourhood-slide {
                overflow: hidden;
                border-radius: 16px;
                transition: transform 0.4s ease, opacity 0.4s ease, z-index 0.4s ease;
                transform: scale(0.85);
                opacity: 0.6;
                z-index: 1;
            }

            .neighbourhood-slide img {
                width: 100%;
                height: 500px;
                object-fit: cover;
                display: block;
            }

            .splide__slide.is-active .neighbourhood-slide {
                transform: scale(1);
                opacity: 1;
                z-index: 3;
                position: relative;
            }

            .splide__list {
                gap: 0;
            }

            .splide__slide {
                margin: 0 -50px;
                position: relative;
            }

            .neighbourhood-slider-nav {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 1rem;
            }

            .neighbourhood-slider-prev,
            .neighbourhood-slider-next {
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

            .neighbourhood-slider-prev svg path,
            .neighbourhood-slider-next svg path {
                fill: #2c2d2c;
                transition: fill 0.3s;
            }

            .neighbourhood-slider-prev:hover,
            .neighbourhood-slider-next:hover {
                background: #A87F58;
                color: #fff;
            }

            .neighbourhood-slider-prev:hover svg path,
            .neighbourhood-slider-next:hover svg path {
                fill: #fff;
            }

            .neighbourhood-slider-pagination {
                display: flex;
                gap: 0.5rem;
            }

            .splide-bullet {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background: #d9d9d9;
                cursor: pointer;
                transition: all 0.3s;
            }

            .splide-bullet.is-active {
                width: 30px;
                border-radius: 6px;
                background: #A87F58;
            }

            .neighbourhood-button-wrapper {
                display: flex;
                justify-content: center;
            }
        </style>

        <div class="neighbourhood-section pageWidth">

            <div class="gsl-heading-wrapper">
                <?php if (!empty($settings['section_title'])) : ?>
                    <h1><?php echo esc_html($settings['section_title']); ?></h1>
                <?php endif; ?>

                <?php if (!empty($settings['section_subtitle'])) : ?>
                    <p class="text"><?php echo esc_html($settings['section_subtitle']); ?></p>
                <?php endif; ?>
            </div>

            <div class="neighbourhood-slider splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php foreach ($settings['neighbourhood_slides'] as $slide) : ?>
                            <li class="splide__slide">
                                <div class="neighbourhood-slide">
                                    <img src="<?php echo esc_url($slide['neighbourhood_slide_image']['url']); ?>" alt="">
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="neighbourhood-slider-nav">
                <div class="neighbourhood-slider-prev">
                    <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9301 18.9889C14.3369 19.3957 14.9964 19.3957 15.4032 18.9889C15.81 18.5822 15.81 17.9226 15.4032 17.5158L9.8898 12.0024L15.4032 6.48893C15.81 6.08213 15.81 5.42259 15.4032 5.01579C14.9964 4.60899 14.3369 4.60899 13.9301 5.01579L7.6801 11.2658C7.2733 11.6726 7.2733 12.3321 7.6801 12.7389L13.9301 18.9889Z" fill="currentColor" />
                    </svg>
                </div>
                <div class="neighbourhood-slider-pagination"></div>
                <div class="neighbourhood-slider-next">
                    <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.15292 18.9889C8.74612 19.3957 8.08658 19.3957 7.67978 18.9889C7.27299 18.5822 7.27299 17.9226 7.67978 17.5158L13.1932 12.0024L7.67978 6.48893C7.27299 6.08213 7.27299 5.42259 7.67978 5.01579C8.08658 4.60899 8.74612 4.60899 9.15292 5.01579L15.4029 11.2658C15.8097 11.6726 15.8097 12.3321 15.4029 12.7389L9.15292 18.9889Z" fill="currentColor" />
                    </svg>
                </div>
            </div>

            <?php if (!empty($settings['button_text']) && !empty($settings['button_link']['url'])) : ?>
                <div class="neighbourhood-button-wrapper">
                    <a class="mainButton"
                       href="<?php echo esc_url($settings['button_link']['url']); ?>"
                       <?php echo $settings['button_link']['is_external'] ? 'target="_blank"' : ''; ?>
                       <?php echo $settings['button_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                        <?php echo esc_html($settings['button_text']); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var splide = new Splide('.neighbourhood-slider', {
                    type: 'loop',
                    focus: 'center',
                    speed: 600,
                    arrows: false,
                    pagination: false,
                    perPage: 1,
                    gap: '-100px',
                    padding: {
                        left: '15%',
                        right: '15%'
                    },
                    breakpoints: {
                        1024: {
                            padding: {
                                left: '10%',
                                right: '10%'
                            }
                        },
                        768: {
                            padding: {
                                left: '0%',
                                right: '0%'
                            },
                            gap: '10px',
                        }
                    }
                }).mount();

                document.querySelector('.neighbourhood-slider-prev').addEventListener('click', () => splide.go('<'));
                document.querySelector('.neighbourhood-slider-next').addEventListener('click', () => splide.go('>'));

                const pagination = document.querySelector('.neighbourhood-slider-pagination');

                function renderPagination() {
                    pagination.innerHTML = '';
                    for (let i = 0; i < splide.length; i++) {
                        let bullet = document.createElement('span');
                        bullet.className = 'splide-bullet' + (i === splide.index ? ' is-active' : '');
                        bullet.addEventListener('click', () => splide.go(i));
                        pagination.appendChild(bullet);
                    }
                }
                splide.on('mounted move', renderPagination);
            });
        </script>
<?php
    }
}
