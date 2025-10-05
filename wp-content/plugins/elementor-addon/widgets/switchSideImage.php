<?php

class Elementor_switchSideImage extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'switchSideImage';
    }

    public function get_title()
    {
        return esc_html__('Switch Side Image', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-code';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['hello', 'world'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
            'switch_position',
            [
                'label' => esc_html__('Switch Image Position', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Right', 'elementor-addon'),
                'label_off' => esc_html__('Left', 'elementor-addon'),
                'default' => '',
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
                    '{{WRAPPER}} .heroText h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $positionClass = ('yes' === $settings['switch_position']) ? 'reverse-order' : 'default-order';
?>
        <style>
            .switchSideImage {
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 100%;
                min-height: 80vh;
            }

            .switchSideImage img {
                width: 50%;
                max-width: 100%;
                height: 80vh;
                max-height: 100%;;
                object-fit: contain;
            }

            .switchSideImage img.left {
                display: none;
            }

            .switchSideImage.left img.left {
                display: block;
                height: 80vh;
            }

            .switchSideImage.left img.right {
                display: none;
            }

            .switchSideImage .heroText {
                display: flex;
                justify-content: center;
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
                padding: 25px;
                max-width: calc(50% - 25px);
            }

            .switchSideImage .heroText *{
                max-width: 600px;
            }

            .switchSideImage .heroText h1 {
                color: var(--black);
                font-size: 3.5rem;
                font-weight: 300;
                line-height: 3.5rem;
                text-align: left;
            }

            .switchSideImage .heroText p {
                color: var(--black);
                font-size: 1.25rem;
                font-weight: 300;
            }

            .switchSideImage .heroSectionTwo {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 25px;
                padding: 0 25px;
                height: 80vh;
            }

            .switchSideImage .rightImage .leftImageInner {
                display: none;
            }

            .switchSideImage .leftImage .rightImageInner {
                display: none;
            }

            .switchSideImage .heroSectionTwo h1 {
                color: #010626;
                font-size: 3rem;
                font-weight: 700;
                line-height: 3rem;
            }

            .switchSideImage.left img.right,
            .switchSideImage.right img.right {
                display: block;
            }

            .switchSideImage.left img.left,
            .switchSideImage.right img.left {
                display: none;
            }

            .switchSideImage .buttonBlueBg {
                color: #2c2d2c;
                text-decoration: underline;
            }

            .mainButton {
                outline: none;
                box-sizing: none;
                font-size: 1.2rem;
                font-weight: 400;
                text-align: center;
                display: inline-block;
                width: max-content;
                color: #fff;
            }

            .switchSideImage .heroText p a {
                color: #2c2d2c;
                text-decoration: underline;
                padding: 10px 20px;
                background-color: #007bff;
                text-decoration: none;
                border-radius: 5px;
            }

            .mainButton:hover {
                box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.25);
                background-color: #0056b3;
            }

            @media screen and (max-width: 767px) {

                .heroSection,
                .heroSection.reverse-order {
                    flex-direction: column;
                    min-height: auto;
                    padding: 10px;
                    gap: 20px;
                }

                .heroSection img {
                    width: 100%;
                    height: auto;
                }

                .heroText {
                    padding: 0;
                    width: 100%;
                    max-width: 100%;
                }
            }
        </style>


        <div class="switchSideImage <?php
                                if ('yes' === $settings['switch_position']) {
                                    echo 'right';
                                } else {
                                    echo 'left';
                                }
                                ?> pageWidth">
            <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="" class="left">
            <div class="heroText">
                <h2 style="text-align: left;">
                    <?php echo $settings['title']; ?>
                </h2>
                <div class="text">
                    <?php echo $settings['text']; ?>
                </div>
                <?php if (!empty($settings['url'])) {
                ?>
                    <div class="buttonHeroSection">
                        <a class="mainButton" href="<?php echo esc_url($settings['url']); ?>">
                            <?php echo esc_html($settings['textForButton']); ?>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>

            <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="">

        </div>
<?php
    }
}
