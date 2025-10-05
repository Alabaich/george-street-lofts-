<?php

class Elementor_HotspotViewer extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'HotspotViewer';
    }

    public function get_title()
    {
        return esc_html__('Interactive Hotspots Image', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-image-hotspot';
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
                'default' => esc_html__('Suite Highlights', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle/Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Where charm meets contemporary living with high ceilings, smart controls, premium finishes, and thoughtfully designed kitchens and baths.', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__('Tabs', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => esc_html__('Tab Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('All', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'tab_image',
            [
                'label' => esc_html__('Tab Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'hotspots',
            [
                'label' => esc_html__('Hotspots', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'hotspot_description',
                        'label' => esc_html__('Description Text', 'elementor-addon'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => esc_html__('Premium finishes, high ceilings, and smart home controls.', 'elementor-addon'),
                    ],
                    [
                        'name' => 'hotspot_left',
                        'label' => esc_html__('Position Left (%)', 'elementor-addon'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['%'],
                        'range' => [
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                            'size' => 50,
                        ],
                    ],
                    [
                        'name' => 'hotspot_top',
                        'label' => esc_html__('Position Top (%)', 'elementor-addon'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['%'],
                        'range' => [
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                            'size' => 50,
                        ],
                    ],
                ],
                'title_field' => '{{{ hotspot_description }}}',
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => esc_html__('Tabs', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_fields(),
                'default' => [
                    [
                        'tab_title' => esc_html__('All', 'elementor-addon'),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image',
            [
                'label' => esc_html__('Image Settings', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'max_image_height',
            [
                'label' => esc_html__('Max Image Height', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 1000,
                        'step' => 10,
                    ],
                    'vh' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 600,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gsl-hotspot-container' => 'max-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_header',
            [
                'label' => esc_html__('Header Styles', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gsl-hotspot-viewer-title' => 'color: {{VALUE}};',
                ],
                'default' => '#333333',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Subtitle Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gsl-hotspot-viewer-subtitle' => 'color: {{VALUE}};',
                ],
                'default' => '#777777',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_tabs',
            [
                'label' => esc_html__('Tab Styles', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tab_background_color',
            [
                'label' => esc_html__('Tab Background', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gsl-hotspot-tabs' => 'background-color: {{VALUE}};',
                ],
                'default' => '#f8f8f8',
            ]
        );

        $this->add_control(
            'tab_text_color',
            [
                'label' => esc_html__('Tab Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gsl-hotspot-tab' => 'color: {{VALUE}};',
                ],
                'default' => '#333333',
            ]
        );

        $this->add_control(
            'tab_active_background_color',
            [
                'label' => esc_html__('Active Tab Background', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gsl-hotspot-tab.active' => 'background-color: {{VALUE}};',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->add_control(
            'tab_active_text_color',
            [
                'label' => esc_html__('Active Tab Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gsl-hotspot-tab.active' => 'color: {{VALUE}};',
                ],
                'default' => '#333333',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_hotspots',
            [
                'label' => esc_html__('Hotspot Styles', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'hotspot_color',
            [
                'label' => esc_html__('Dot Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gsl-hotspot-dot' => 'background-color: {{VALUE}};',
                ],
                'default' => '#FFFFFF',
            ]
        );

        $this->add_control(
            'tooltip_background_color',
            [
                'label' => esc_html__('Tooltip Background', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gsl-hotspot-tooltip' => 'background-color: {{VALUE}};',
                ],
                'default' => '#FCF8F3',
            ]
        );

        $this->add_control(
            'tooltip_text_color',
            [
                'label' => esc_html__('Tooltip Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gsl-hotspot-tooltip-desc' => 'color: {{VALUE}};',
                ],
                'default' => '#32302F',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $tabs = $settings['tabs'];
?>
        <style>
            .hotdots {
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 50px;
                align-items: center;
            }

            .hotdots .gsl-hotspot-tabs {
                display: inline-flex;
                padding: 8px;
                align-items: center;
                gap: 4px;
                border-radius: 12px;
                background: #f8f8f8;
                flex-wrap: wrap;
                justify-content: center;
            }

            .hotdots .gsl-hotspot-tab {
                display: flex;
                padding: 12px 20px;
                justify-content: center;
                align-items: center;
                gap: 8px;
                border-radius: 8px;
                background: transparent;
                border: none;
                color: #333;
                font-size: 16px;
                font-weight: 500;
                line-height: 1.4;
                cursor: pointer;
                transition: all 0.3s ease;
                white-space: nowrap;
            }

            .hotdots .gsl-hotspot-tab:hover {
                background: rgba(255, 255, 255, 0.5);
            }

            .hotdots .gsl-hotspot-tab.active {
                background: #fff;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }

            .hotdots .gsl-hotspot-container {
                position: relative;
                overflow: hidden;
                width: 100%;
                height: 100%;
                border-radius: 8px;
            }

            .hotdots .gsl-hotspot-image {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: cover;
                max-height: 500px;
            }

            .hotdots .gsl-hotspot-content {
                display: none;
            }

            .hotdots .gsl-hotspot-content.active {
                display: block;
            }

            .hotdots .gsl-hotspot {
                position: absolute;
                z-index: 10;
                cursor: pointer;
                transform: translate(-50%, -50%);
            }

            .hotdots .gsl-hotspot.active .gsl-hotspot-dot {
                box-shadow: 0 0 0 8px rgba(255, 255, 255, 0.6);
            }

            .hotdots .gsl-hotspot-dot {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background-color: #FFF;
                position: relative;
                box-shadow: 0 0 0 5px rgba(255, 255, 255, 0.4);
                transition: box-shadow 0.3s ease-in-out;
            }

            .hotdots .gsl-hotspot:hover .gsl-hotspot-dot {
                box-shadow: 0 0 0 8px rgba(255, 255, 255, 0.6);
            }

            .hotdots .gsl-hotspot-tooltip {
                position: absolute;
                min-width: 250px;
                max-width: 300px;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s, visibility 0.3s;
                z-index: 30;
                text-align: left;
                border-radius: 8px;
                background-color: #FCF8F3;
                display: flex;
                padding: 16px 20px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                box-sizing: border-box;
            }

            .hotdots .gsl-hotspot-tooltip.top {
                bottom: calc(100% + 15px);
                left: 50%;
                transform: translateX(-50%);
            }

            .hotdots .gsl-hotspot-tooltip.bottom {
                top: calc(100% + 15px);
                left: 50%;
                transform: translateX(-50%);
            }

            .hotdots .gsl-hotspot-tooltip.left {
                right: calc(100% + 15px);
                top: 50%;
                transform: translateY(-50%);
            }

            .hotdots .gsl-hotspot-tooltip.right {
                left: calc(100% + 15px);
                top: 50%;
                transform: translateY(-50%);
            }

            .hotdots .gsl-heading-wrapper {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 10px;
                max-width: 900px;
                text-align: center;
            }

            .hotdots .gsl-hotspot:hover .gsl-hotspot-tooltip {
                opacity: 1;
                visibility: visible;
            }

            .hotdots .gsl-hotspot-tooltip-desc {
                color: #32302F;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 140%;
                margin: 0;
                word-wrap: break-word;
            }

            @media (max-width: 767px) {
                .hotdots {
                    gap: 30px;
                    padding: 0 15px;
                }

                .hotdots .gsl-hotspot-tabs {
                    padding: 6px;
                    gap: 2px;
                    width: fit-content;
                    overflow-x: auto;
                    justify-content: flex-start;
                }

                .hotdots .gsl-hotspot-tab {
                    padding: 10px 16px;
                    font-size: 14px;
                    flex-shrink: 0;
                }

                .hotdots .gsl-hotspot-container {
                    margin: 0;
                }

                .hotdots .gsl-hotspot-image {
                    max-height: 400px;
                }

                .hotdots .gsl-hotspot-tooltip {
                    position: absolute !important;
                    top: unset !important;
                    left: unset !important;
                    right: unset !important;
                    bottom: unset !important;
                    transform: unset !important;
                    bottom: calc(100% + 15px) !important;
                    max-width: 90vw !important;
                    width: auto !important;
                    min-width: 150px !important;
                    margin: 0 !important;
                    z-index: 10000 !important;
                    padding: 12px 16px !important;
                    box-sizing: border-box;
                }

                .hotdots .gsl-hotspot.active .gsl-hotspot-tooltip {
                    left: 50%;
                    transform: translateX(-50%);
                    opacity: 1;
                    visibility: visible;
                }

                .hotdots .gsl-hotspot-tooltip-desc {
                    font-size: 14px;
                    text-align: left;
                    word-break: break-word;
                    overflow-wrap: break-word;
                }

                .hotdots .gsl-hotspot-tooltip.shift-left {
                    left: 0 !important;
                    transform: translateX(0) !important;
                }

                .hotdots .gsl-hotspot-tooltip.shift-right {
                    left: 100% !important;
                    transform: translateX(-100%) !important;
                }
            }

            @media (min-width: 768px) {
                .hotdots .gsl-hotspot-tooltip {
                    min-width: 250px;
                    max-width: 300px;
                }
            }
        </style>

        <div class="hotdots gsl-hotspot-viewer-wrapper pageWidth">
            <div class="gsl-heading-wrapper">
                <h2 class="gsl-hotspot-viewer-title"><?php echo esc_html($settings['title']); ?></h2>
                <p class="gsl-hotspot-viewer-subtitle text"><?php echo esc_html($settings['subtitle']); ?></p>
            </div>

            <?php if (!empty($tabs)) : ?>
                <div class="gsl-hotspot-tabs">
                    <?php foreach ($tabs as $index => $tab) : ?>
                        <button class="gsl-hotspot-tab <?php echo $index === 0 ? 'active' : ''; ?>"
                            data-tab="<?php echo esc_attr($index); ?>">
                            <?php echo esc_html($tab['tab_title']); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="gsl-hotspot-container">
                <?php foreach ($tabs as $index => $tab) : ?>
                    <?php
                    $image_url = $tab['tab_image']['url'] ? esc_url($tab['tab_image']['url']) : \Elementor\Utils::get_placeholder_image_src();
                    $hotspots = $tab['hotspots'] ?? [];
                    ?>
                    <div class="gsl-hotspot-content <?php echo $index === 0 ? 'active' : ''; ?>" data-tab-content="<?php echo esc_attr($index); ?>">
                        <img src="<?php echo $image_url; ?>" alt="<?php echo esc_attr($tab['tab_title']); ?>" class="gsl-hotspot-image">

                        <?php if (!empty($hotspots)) : ?>
                            <?php foreach ($hotspots as $hotspot_index => $hotspot) : ?>
                                <?php
                                $top = isset($hotspot['hotspot_top']['size']) ? $hotspot['hotspot_top']['size'] : 50;
                                $left = isset($hotspot['hotspot_left']['size']) ? $hotspot['hotspot_left']['size'] : 50;
                                $tooltip_position = $this->get_tooltip_position($top, $left);
                                ?>
                                <div class="gsl-hotspot" style="top: <?php echo esc_attr($top); ?>%; left: <?php echo esc_attr($left); ?>%;">
                                    <div class="gsl-hotspot-dot"></div>
                                    <div class="gsl-hotspot-tooltip <?php echo esc_attr($tooltip_position); ?>">
                                        <p class="gsl-hotspot-tooltip-desc"><?php echo esc_html($hotspot['hotspot_description']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tabs = document.querySelectorAll('.gsl-hotspot-tab');
                const contents = document.querySelectorAll('.gsl-hotspot-content');

                tabs.forEach(tab => {
                    tab.addEventListener('click', function() {
                        const tabId = this.getAttribute('data-tab');

                        tabs.forEach(t => t.classList.remove('active'));
                        contents.forEach(c => c.classList.remove('active'));

                        this.classList.add('active');
                        document.querySelector(`.gsl-hotspot-content[data-tab-content="${tabId}"]`).classList.add('active');
                    });
                });

                const isMobile = window.innerWidth <= 767;
                const hotspots = document.querySelectorAll('.gsl-hotspot');

                function adjustTooltipPosition(tooltip) {
                    tooltip.classList.remove('shift-left', 'shift-right');

                    const container = tooltip.closest('.gsl-hotspot-container');
                    if (!container) return;

                    const containerRect = container.getBoundingClientRect();
                    const tooltipRect = tooltip.getBoundingClientRect();

                    if (tooltipRect.left < containerRect.left + 10) {
                        tooltip.classList.add('shift-left');
                    } else if (tooltipRect.right > containerRect.right - 10) {
                        tooltip.classList.add('shift-right');
                    }
                }

                hotspots.forEach(hotspot => {
                    const tooltip = hotspot.querySelector('.gsl-hotspot-tooltip');
                    if (!tooltip) return;

                    if (!isMobile) {
                        hotspot.addEventListener('mouseenter', () => {
                            adjustTooltipPosition(tooltip);
                        });
                    } else {
                        hotspot.addEventListener('click', function(e) {
                            e.stopPropagation();
                            const wasActive = this.classList.contains('active');

                            document.querySelectorAll('.gsl-hotspot').forEach(h => {
                                h.classList.remove('active');
                            });

                            if (!wasActive) {
                                this.classList.add('active');
                                setTimeout(() => adjustTooltipPosition(tooltip), 0);
                            }
                        });
                    }
                });

                if (isMobile) {
                    document.addEventListener('click', function(e) {
                        if (!e.target.closest('.gsl-hotspot')) {
                            document.querySelectorAll('.gsl-hotspot.active').forEach(h => {
                                h.classList.remove('active');
                            });
                        }
                    });
                }
            });
        </script>
<?php
    }

    private function get_tooltip_position($top, $left)
    {
        if ($left < 50) {
            return 'right';
        } else {
            return 'left';
        }
    }
}
