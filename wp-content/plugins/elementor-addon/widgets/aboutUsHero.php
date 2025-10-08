<?php

class Elementor_AboutUsHero extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'aboutUsHero';
    }

    public function get_title()
    {
        return esc_html__('About Us Hero Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-image';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['hero', 'about us'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Hero Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'upperTitle',
            [
                'label' => esc_html__('Upper Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'textForButton',
            [
                'label' => esc_html__('Text For Button', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('insert text for button', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => esc_html__('URL to embed', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_content',
            [
                'label' => esc_html__('Scrolling Slider', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'showSlider',
            [
                'label' => esc_html__('Display Scrolling Slider', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'elementor-addon'),
                'label_off' => esc_html__('Hide', 'elementor-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'sliderItems',
            [
                'label' => esc_html__('Slider Words (One per line)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => "Design\nDevelopment\nBranding\nStrategy\nSEO",
                'description' => esc_html__('Enter each word/phrase on a new line. You may need more words for a smoother infinite scroll.', 'elementor-addon'),
                'condition' => [
                    'showSlider' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Hero Title Style', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__('Scrolling Slider Style', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'showSlider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'slider_background_color',
            [
                'label' => esc_html__('Background Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#F3F5F6',
                'selectors' => [
                    '{{WRAPPER}} .scrollingSlider' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'slider_text_color',
            [
                'label' => esc_html__('Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#32302F',
                'selectors' => [
                    '{{WRAPPER}} .scrollingSlider li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $sliderItemsArray = [];
        if (!empty($settings['sliderItems'])) {
            $sliderItemsArray = array_map('trim', explode("\n", $settings['sliderItems']));
            $sliderItemsArray = array_filter($sliderItemsArray);
        }

        $duplicatedSliderItems = array_merge($sliderItemsArray, $sliderItemsArray, $sliderItemsArray);
?>

        <style>
            .aboutUsHeroContainer {
                display: flex;
                justify-content: start;
                align-items: end;
                gap: 25px;
                height: 90vh;
                width: 100%;
                background-repeat: no-repeat;
                background-size: cover;
                padding-bottom: 50px;
            }

            @media (max-width: 1500px) {
                .pageWidth {
                    padding: 25px;
                }
            }

            @media (max-width: 768px) {
                .pageWidth {
                    padding: 15px;
                }
            }

            .aboutUsHeroContainer .heroText * {
                color: white;
                margin: 0;
                text-align: left;
                max-width: 600px;
            }

            .scrollingSlider {
                width: 100%;
                overflow: hidden;
                white-space: nowrap;
                padding: 15px 0;
            }

            .scrollingSlider ul {
                display: flex;
                padding: 0;
                margin: 0;
                list-style: disc inside;
                animation: scrollLeft 40s linear infinite;
                min-width: max-content; 
            }

            .scrollingSlider ul:hover {
                animation-play-state: paused;
            }

            .scrollingSlider li {
                display: inline-block;
                padding-right: 80px;
                text-align: center;
                font-family: Arial, sans-serif;
                font-size: 18px;
                font-style: normal;
                font-weight: 500;
                line-height: 140%;
            }

            @keyframes scrollLeft {
                0% {
                    transform: translateX(0%);
                }

                100% {
                    transform: translateX(-33.333%); 
                }
            }
        </style>

        <div class="aboutUsHeroWrapper">
            <div class="aboutUsHeroContainer pageWidth"
                style="background-image: url(<?php echo esc_url($settings['image']['url']); ?>); ">
                <div class="heroText">
                    <p>
                        <?php echo esc_html($settings['upperTitle']); ?>
                    </p>
                    <h1>
                        <?php echo esc_html($settings['title']); ?>
                    </h1>
                    <?php
                    echo $settings['text'];
                    ?>
                    <?php if (!empty($settings['url'])) : ?>
                        <div class="buttonHeroSection">
                            <a class="buttonBlueBg" href="<?php echo esc_url($settings['url']); ?>">
                                <?php echo esc_html($settings['textForButton']); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($settings['showSlider'] === 'yes' && !empty($duplicatedSliderItems)) : ?>
                <div class="scrollingSlider">
                    <ul>
                        <?php foreach ($duplicatedSliderItems as $item) : ?>
                            <li><?php echo esc_html($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
<?php
    }
}