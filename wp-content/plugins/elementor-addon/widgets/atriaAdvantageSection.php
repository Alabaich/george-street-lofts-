<?php

class Elementor_AtriaAdvantageSection extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'atriaAdvantageSection';
    }

    public function get_title()
    {
        return esc_html__('Atria Advantage Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-bullet-list';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['advantage', 'blocks', 'repeater', 'image', 'text'];
    }

    protected function register_controls()
    {

        // Content Tab Start - Main Title
        $this->start_controls_section(
            'section_main_title',
            [
                'label' => esc_html__('Section Header', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('The Atria Advantage', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'main_subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Celebrating excellence in development and community building.', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        // Content Tab Start - Repeater Blocks
        $this->start_controls_section(
            'section_content_blocks',
            [
                'label' => esc_html__('Content Blocks', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Block Title', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'item_text',
            [
                'label' => esc_html__('Text Content', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Enter the description for this block here.', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'item_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'reverse_layout',
            [
                'label' => esc_html__(
                    'Reverse Layout (Image on Left)',
                    'elementor-addon'
                ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'elementor-addon'),
                'label_off' => esc_html__('No', 'elementor-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'content_list',
            [
                'label' => esc_html__('Advantage Items', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_title' => esc_html__('Sustainability', 'elementor-addon'),
                        'item_text' => esc_html__('With each new project, Atria sets ambitious sustainability goals and uses technologies suitable to its particular circumstances, often pioneering their use in their respective markets.', 'elementor-addon'),
                    ],
                    [
                        'item_title' => esc_html__('Technology', 'elementor-addon'),
                        'item_text' => esc_html__('Atria integrates technologies that help residents manage their environment and security, book amenities, request maintenance calls and more, while at home or away, from their smartphones.', 'elementor-addon'),
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Tab Start - Header Styling
        $this->start_controls_section(
            'section_header_style',
            [
                'label' => esc_html__('Header Style', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'main_title_color',
            [
                'label' => esc_html__('Title Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .atria-main-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'main_title_typography',
                'selector' => '{{WRAPPER}} .atria-main-title',
            ]
        );

        $this->add_control(
            'main_subtitle_color',
            [
                'label' => esc_html__('Subtitle Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .atria-main-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - Content Block Styling
        $this->start_controls_section(
            'section_block_style',
            [
                'label' => esc_html__('Content Block Style', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'block_title_color',
            [
                'label' => esc_html__('Block Title Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .atria-block-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'block_title_typography',
                'selector' => '{{WRAPPER}} .atria-block-title',
            ]
        );

        $this->add_control(
            'block_text_color',
            [
                'label' => esc_html__('Block Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .atria-block-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'block_text_typography',
                'selector' => '{{WRAPPER}} .atria-block-text',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['content_list'])) {
            return;
        }
?>
        <style>
            .atria-advantage-container {
                display: flex;
                flex-direction: column;
                gap: 50px;
            }

            .atria-header {
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .atria-block {
                display: flex;
                align-items: center;
                gap: 40px;
            }

            .atria-block-reverse {
                flex-direction: row-reverse;
            }

            .atria-content,
            .atria-image-wrap {
                flex: 1;
                min-width: 0;
                display: flex;
                flex-direction: column;
                gap: 25px;
            }

            .atria-image-wrap img {
                width: 100%;
                height: auto;
                display: block;
                object-fit: cover;
                border-radius: 4px;
            }

            .atria-block-title {
                color: var(--Black, #32302F);
                font-feature-settings: 'salt' on;
                font-family: Arial, sans-serif;
                font-size: 48px;
                font-style: normal;
                font-weight: 500;
                line-height: 110%;
                letter-spacing: -0.48px;
                text-transform: capitalize;
                text-align: left;
            }

            .atria-block-text {
                color: var(--Text-color, #5C5C5C);
                font-family: Arial;
                font-size: 18px;
                font-style: normal;
                font-weight: 400;
                line-height: 140%;
            }

            @media (max-width: 768px) {

                .atria-block,
                .atria-block-reverse {
                    flex-direction: column;
                    gap: 20px;
                }

                .atria-content,
                .atria-image-wrap {
                    width: 100%;
                }

                .atria-block-title {
                    font-size: 2em;
                }
            }
        </style>

        <div class="atria-advantage-container pageWidth">
            <div class="atria-header">
                <h2><?php echo esc_html($settings['main_title']); ?></h2>
                <p class="text"><?php echo esc_html($settings['main_subtitle']); ?></p>
            </div>

            <?php
            foreach ($settings['content_list'] as $item) :
                $block_class = 'atria-block';
                if ($item['reverse_layout'] === 'yes') {
                    $block_class .= ' atria-block-reverse';
                }
            ?>
                <div class="<?php echo esc_attr($block_class); ?>">
                    <div class="atria-content">
                        <h2 class="atria-block-title"><?php echo esc_html($item['item_title']); ?></h2>
                        <p class="atria-block-text"><?php echo esc_html($item['item_text']); ?></p>
                    </div>
                    <div class="atria-image-wrap">
                        <?php if ($item['item_image']['url']) : ?>
                            <img src="<?php echo esc_url($item['item_image']['url']); ?>" alt="<?php echo esc_attr($item['item_title']); ?>">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
<?php
    }
}
