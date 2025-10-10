<?php

class Elementor_SplitHeroSection extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'splitHeroSection';
    }

    public function get_title()
    {
        return esc_html__('Split Hero Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-columns';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['columns', 'hero'];
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
            .splitHeroSection {
                display: flex;
                justify-content: space-between;
                align-items: start;
                gap: 100px;
            }

            .splitHeroSection.left .right {
                display: none;
            }

            .splitHeroSection.right .left {
                display: none;
            }

            .splitHeroSection .titles,
            .splitHeroSection .text{
                max-width: 50%;
                width: 50%;
                display: flex;
                justify-content: start;
                align-items: start;
                flex-direction: column;
                gap: 15px;
            }

            .splitHeroSection *{
                text-align: left;
            }

            @media (max-width: 768px) {
                .splitHeroSection {
                    flex-direction: column;
                    gap:25px;
                }

                .splitHeroSection .titles,
                .splitHeroSection .text{
                    width: 100%;
                    max-width: 100%;
                }
            }
        </style>


        <div class="splitHeroSection <?php
        if ('yes' === $settings['switch_position']) {
            echo 'right';
        } else {
            echo 'left';
        }
        ?> pageWidth">
            <div class="titles left">
                <p style="text-align: left;" class="upperTitle">
                    <?php echo $settings['upperTitle']; ?>
                </p>
                <h2 style="text-align: left;">
                    <?php echo $settings['title']; ?>
                </h2>
            </div>
            <div class="text">

                    <?php echo $settings['text']; ?>

                <?php if (!empty($settings['url'])) {
                    ?>
                    <a class="customButton" href="<?php echo esc_url($settings['url']); ?>">
                        <?php echo esc_html($settings['textForButton']); ?>
                    </a>
                    <?php
                }
                ?>
            </div>
            <div class="titles right">
                <p style="text-align: left;">
                    <?php echo $settings['upperTitle']; ?>
                </p>
                <h2 style="text-align: left;">
                    <?php echo $settings['title']; ?>
                </h2>
            </div>
            <!-- <div class="splitHero">
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

            <img src="<?php echo esc_url($settings['image']['url']); ?>" alt=""> -->

        </div>
        <?php
    }
}
