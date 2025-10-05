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

        // Content Tab Start

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

                $this->add_control(
            'upperTitle',
            [
                'label' => esc_html__('upperTitle', 'elementor-addon'),
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

        // Content Tab End

        // Style Tab Start

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
                ],
            ]
        );



        $this->end_controls_section();

        // Style Tab End

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
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
                background-size:cover;
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

            .aboutUsHeroContainer .heroText *{
                color: white;
                margin: 0;
                text-align: left;
                max-width: 600px;
            }
        </style>

        <div class="aboutUsHeroContainer pageWidth"
            style="background-image: url(<?php echo esc_url($settings['image']['url']); ?>); ">
            <div class="heroText">
                                <p>
                    <?php echo $settings['upperTitle']; ?>
                </p>
                <h1>
                    <?php echo $settings['title']; ?>
                </h1>
                <p>
                    <?php echo $settings['text']; ?>
                </p>
                <?php if ($settings['url'] != "") {
                    ?>
                    <div class="buttonHeroSection">
                        <a class="buttonBlueBg" href="<?php echo esc_url($settings['url']); ?>">
                            <?php echo esc_html($settings['textForButton']); ?>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
}
