<?php

class Elementor_3DSuiteViewer extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return '3DSuiteViewer';
    }

    public function get_title()
    {
        return esc_html__('3D Suite/Unit Catalog', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-global-settings';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_header',
            [
                'label' => esc_html__('Section Header', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Explore 3D Space', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_units',
            [
                'label' => esc_html__('3D Unit Cards', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'unit_title',
            [
                'label' => esc_html__('Unit Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Unit 201 - Studio', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'unit_image',
            [
                'label' => esc_html__('Poster Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'unit_link',
            [
                'label' => esc_html__('3D Tour Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-3d-tour-link.com', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'unit_cards_list',
            [
                'label' => esc_html__('Unit/3D Tours List', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_fields(),
                'default' => [
                    ['unit_title' => 'Unit 201 - Studio'],
                    ['unit_title' => 'Unit 202 - Studio'],
                    ['unit_title' => 'Unit 203 - Studio'],
                    ['unit_title' => 'Unit 204 - Studio'],
                ],
                'title_field' => '{{{ unit_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_cards',
            [
                'label' => esc_html__('Card Styles', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_max_height',
            [
                'label' => esc_html__('Card Max Height (px)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 800,
                        'step' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 450,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gsl-unit-card' => 'max-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_title_color',
            [
                'label' => esc_html__('Title Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gsl-unit-card-title' => 'color: {{VALUE}};',
                ],
                'default' => '#FFFFFF',
            ]
        );

        $this->add_control(
            'play_icon_color',
            [
                'label' => esc_html__('Play Icon Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gsl-play-icon-circle' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .gsl-play-icon-triangle' => 'border-left-color: {{VALUE}};',
                ],
                'default' => '#FFFFFF',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <style>
        {{WRAPPER}} .gsl-suite-viewer-section {
        text-align: center;
        display: flex;
        flex-direction: column;
        gap: 50px;
        }

        {{WRAPPER}} .gsl-unit-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        }

        {{WRAPPER}} .gsl-unit-card {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        display: block;
        aspect-ratio: 16 / 9;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        {{WRAPPER}} .gsl-unit-image-poster {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        transition: transform 0.4s ease-in-out;
        }

        {{WRAPPER}} .gsl-unit-card:hover .gsl-unit-image-poster {
        transform: scale(1.05);
        }

        {{WRAPPER}} .gsl-card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
        }

        {{WRAPPER}} .gsl-play-icon {
        position: relative;
        z-index: 10;
        cursor: pointer;
        opacity: 0.9;
        transition: opacity 0.3s ease;
        }

        {{WRAPPER}} .gsl-unit-card:hover .gsl-play-icon {
        opacity: 1;
        }

        {{WRAPPER}} .gsl-play-icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 2px solid #FFF;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(2px);
        }

        {{WRAPPER}} .gsl-play-icon-triangle {
        width: 0;
        height: 0;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        border-left: 15px solid #FFF;
        margin-left: 3px;
        }

        {{WRAPPER}} .gsl-unit-card-title {
        color: #FFF;
        font-size: 20px;
        font-weight: 500;
        line-height: 1.4;
        text-align: center;
        position: relative;
        margin-bottom: 15px;
        z-index: 10;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        @media (max-width: 767px) {
        {{WRAPPER}} {
        overflow: auto !important;
        }

        {{WRAPPER}} .gsl-suite-viewer-section {
        margin-bottom: 150px !important;
        gap: 30px;
        }

        {{WRAPPER}} .gsl-unit-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        }

        {{WRAPPER}} .gsl-viewer-catalog-title {
        font-size: 24px;
        }

        {{WRAPPER}} .gsl-unit-card-title {
        font-size: 16px;
        margin-bottom: 10px;
        }

        {{WRAPPER}} .gsl-play-icon-circle {
        width: 50px;
        height: 50px;
        }
        }

        @media (max-width: 480px) {
        {{WRAPPER}} .gsl-unit-grid {
        grid-template-columns: repeat(2, 1fr);
        }
        }
        </style>

        <section class="gsl-suite-viewer-section pageWidth">
            <h2 class="gsl-viewer-catalog-title"><?php echo esc_html($settings['title']); ?></h2>

            <div class="gsl-unit-grid">
                <?php
                if (!empty($settings['unit_cards_list'])) {
                    foreach ($settings['unit_cards_list'] as $card) {
                        $image_url = $card['unit_image']['url'] ? esc_url($card['unit_image']['url']) : \Elementor\Utils::get_placeholder_image_src();
                        $link_url = $card['unit_link']['url'] ? esc_url($card['unit_link']['url']) : '#';
                        $target = $card['unit_link']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $card['unit_link']['nofollow'] ? ' rel="nofollow"' : '';

                        echo '<a href="' . $link_url . '" class="gsl-unit-card" ' . $target . $nofollow . '>';
                        echo '<div class="gsl-unit-image-poster" style="background-image: url(' . $image_url . ');"></div>';

                        echo '<div class="gsl-card-overlay">';
                        echo '<h3 class="gsl-unit-card-title">' . esc_html($card['unit_title']) . '</h3>';
                        echo '<div class="gsl-play-icon">';
                        echo '<div class="gsl-play-icon-circle">';
                        echo '<div class="gsl-play-icon-triangle"></div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        echo '</a>';
                    }
                }
                ?>
            </div>
        </section>
<?php
    }
}
