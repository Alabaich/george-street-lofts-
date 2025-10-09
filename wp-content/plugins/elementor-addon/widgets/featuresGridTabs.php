<?php

class Elementor_FeaturesGridTabs extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'featuresGridTabs';
    }

    public function get_title()
    {
        return esc_html__('Features Grid Tabs', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-tabs';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_titles',
            [
                'label' => esc_html__('General Titles', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Features & Finishes', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Meets contemporary living with high ceilings, smart controls, premium finishes, and thoughtfully designed kitchens and baths.', 'elementor-addon'),
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

        $feature_repeater = new \Elementor\Repeater();

        $feature_repeater->add_control(
            'feature_icon',
            [
                'label' => esc_html__('Icon', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'eicon-apps',
                    'library' => 'solid',
                ],
                'recommended_groups' => [
                    'basic',
                ],
            ]
        );

        $feature_repeater->add_control(
            'feature_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Designed For Living Well', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $feature_repeater->add_control(
            'feature_description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('From restored heritage details to premium in-suite features.', 'elementor-addon'),
            ]
        );

        $tab_repeater = new \Elementor\Repeater();

        $tab_repeater->add_control(
            'tab_nav_title',
            [
                'label' => esc_html__('Tab Navigation Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Building Features', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $tab_repeater->add_control(
            'features_list',
            [
                'label' => esc_html__('Features Grid Items', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $feature_repeater->get_controls(),
                'default' => [
                    ['feature_title' => esc_html__('Feature 1', 'elementor-addon')],
                    ['feature_title' => esc_html__('Feature 2', 'elementor-addon')],
                    ['feature_title' => esc_html__('Feature 3', 'elementor-addon')],
                    ['feature_title' => esc_html__('Feature 4', 'elementor-addon')],
                    ['feature_title' => esc_html__('Feature 5', 'elementor-addon')],
                    ['feature_title' => esc_html__('Feature 6', 'elementor-addon')],
                ],
                'title_field' => 'Grid Items',
            ]
        );

        $this->add_control(
            'tabs_list',
            [
                'label' => esc_html__('Tab Items', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $tab_repeater->get_controls(),
                'default' => [
                    ['tab_nav_title' => esc_html__('Building Features', 'elementor-addon')],
                    ['tab_nav_title' => esc_html__('Interior Suite Features', 'elementor-addon')],
                    ['tab_nav_title' => esc_html__('Security Features', 'elementor-addon')],
                ],
                'title_field' => '{{{ tab_nav_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
?>
        <style>
            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> {
                font-family: sans-serif;
                background: #5A4E41;
                color: #FCF8F3;
                padding-top: 100px;
                padding-bottom: 100px;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-header {
                text-align: left;
                margin-bottom: 50px;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-header-title {
                font-size: 2.5rem;
                margin: 0 0 10px 0;
                color: #FCF8F3;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-header-subtitle {
                font-size: 1rem;
                color: #fff;
                max-width: 500px;
                margin: 0 auto;
                text-align: center;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-container {
                display: flex;
                gap: 50px;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-nav {
                flex-shrink: 0;
                width: 250px;
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tab-nav-button {
                background-color: transparent;
                border: none;
                padding: 15px 20px;
                cursor: pointer;
                text-align: left;
                font-size: 1rem;
                border-radius: 4px;
                transition: background-color 0.3s, color 0.3s;
                color: #FCF8F3;
                font-weight: 500;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tab-nav-button.active {
                background-color: #FCF8F3;
                color: #4D4337;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tab-nav-button:hover {
                opacity: 0.8;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-content-wrapper {
                flex-grow: 1;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tab-content-panel {
                display: none;
                animation: fadeIn 0.5s;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tab-content-panel.active {
                display: block;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .features-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .feature-item {
                background-color: #6C6057;
                padding: 30px;
                border-radius: 8px;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .feature-icon-wrapper {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                background-color: #FCF8F3;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 10px;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .feature-icon-wrapper svg {
                width: 26px;
                height: 26px;
                fill: #4D4337;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .feature-title {
                color: var(--White, #FFF);
                font-family: "Cormorant", serif;
                font-size: 28px;
                font-style: normal;
                font-weight: 500;
                line-height: 130%;
                text-transform: capitalize;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .feature-description {
                color: var(--Input, #F3F5F6);
                font-family: "Open Sans", sans-serif;
                font-size: 18px;
                font-style: normal;
                font-weight: 400;
                line-height: 140%;
            }

            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tab-nav-button:hover,
            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tab-nav-button.active,
            .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tab-nav-button.focus {
                background-color: #FCF8F3;
                color: #4D4337;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Mobile styles */
            @media (max-width: 767px) {
                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> {
                    padding-top: 60px;
                    padding-bottom: 60px;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-header {
                    text-align: center;
                    margin-bottom: 40px;
                    padding: 0 20px;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-header-title {
                    font-size: 2rem;
                    margin: 0 0 15px 0;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-header-subtitle {
                    font-size: 1rem;
                    max-width: 100%;
                    text-align: center;
                    line-height: 1.5;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-container {
                    flex-direction: column;
                    gap: 30px;
                    padding: 0 20px;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-nav {
                    width: 100%;
                    flex-direction: row;
                    gap: 10px;
                    overflow-x: auto;
                    padding-bottom: 10px;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-nav::-webkit-scrollbar {
                    display: none;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tab-nav-button {
                    text-align: center;
                    padding: 12px 20px;
                    white-space: nowrap;
                    flex-shrink: 0;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-content-wrapper {
                    width: 100%;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .features-grid {
                    grid-template-columns: 1fr;
                    gap: 15px;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .feature-item {
                    padding: 25px 20px;
                    gap: 12px;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .feature-title {
                    font-size: 22px;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .feature-description {
                    font-size: 16px;
                }
            }

            /* Tablet styles */
            @media (min-width: 768px) and (max-width: 1023px) {
                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> {
                    padding-top: 80px;
                    padding-bottom: 80px;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-container {
                    gap: 40px;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .tabs-nav {
                    width: 200px;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .features-grid {
                    gap: 15px;
                }

                .featuresGridTabs-<?php echo esc_attr($widget_id); ?> .feature-item {
                    padding: 25px;
                }
            }
        </style>

        <div id="featuresGridTabs-<?php echo esc_attr($widget_id); ?>" class="featuresGridTabs pageWidth featuresGridTabs-<?php echo esc_attr($widget_id); ?>">

            <div class="tabs-header">
                <h2 class="tabs-header-title"><?php echo esc_html($settings['title']); ?></h2>
                <p class="tabs-header-subtitle"><?php echo esc_html($settings['subtitle']); ?></p>
            </div>

            <?php if (!empty($settings['tabs_list'])) : ?>
                <div class="tabs-container">
                    <div class="tabs-nav">
                        <?php foreach ($settings['tabs_list'] as $index => $item) : ?>
                            <button class="tab-nav-button <?php echo ($index === 0) ? 'active' : ''; ?>" data-tab="<?php echo esc_attr($index); ?>">
                                <?php echo esc_html($item['tab_nav_title']); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <div class="tabs-content-wrapper">
                        <?php foreach ($settings['tabs_list'] as $index => $tab_item) : ?>
                            <div class="tab-content-panel <?php echo ($index === 0) ? 'active' : ''; ?>" data-tab-content="<?php echo esc_attr($index); ?>">

                                <div class="features-grid">
                                    <?php if (!empty($tab_item['features_list'])) : ?>
                                        <?php foreach ($tab_item['features_list'] as $feature_item) : ?>
                                            <div class="feature-item">
                                                <div class="feature-icon-wrapper">
                                                    <?php \Elementor\Icons_Manager::render_icon($feature_item['feature_icon'], ['aria-hidden' => 'true']); ?>
                                                </div>
                                                <h4 class="feature-title"><?php echo esc_html($feature_item['feature_title']); ?></h4>
                                                <p class="feature-description"><?php echo esc_html($feature_item['feature_description']); ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <script>
            (function() {
                const widgetContainer = document.querySelector('#featuresGridTabs-<?php echo esc_attr($widget_id); ?>');
                if (!widgetContainer) return;

                const tabButtons = widgetContainer.querySelectorAll('.tab-nav-button');
                const contentPanels = widgetContainer.querySelectorAll('.tab-content-panel');

                tabButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const tabIndex = this.getAttribute('data-tab');

                        tabButtons.forEach(btn => btn.classList.remove('active'));
                        contentPanels.forEach(panel => panel.classList.remove('active'));

                        this.classList.add('active');
                        widgetContainer.querySelector(`.tab-content-panel[data-tab-content="${tabIndex}"]`).classList.add('active');
                    });
                });
            })();
        </script>
<?php
    }
}