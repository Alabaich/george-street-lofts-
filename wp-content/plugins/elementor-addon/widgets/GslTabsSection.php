<?php

class Elementor_GslTabsSection extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'GslTabsSection';
    }

    public function get_title()
    {
        return esc_html__('GSL Tabs Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-tabs';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['tabs', 'gallery', 'features', 'george', 'street'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'gsl_content_section',
            [
                'label' => esc_html__('Section Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gsl_main_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('George Street Lofts Offers A Unique Living Experience', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'gsl_main_description',
            [
                'label' => esc_html__('Main Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('The three-storey French Second Empire-style property features spacious, meticulously designed suites just steps from the city\'s vibrant attractions.', 'elementor-addon'),
            ]
        );

        // New Controls for the Button
        $this->add_control(
            'gsl_section_button_text',
            [
                'label' => esc_html__('Section Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Floor Plans', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gsl_section_button_url',
            [
                'label' => esc_html__('Section Button URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );
        // End New Controls

        $this->end_controls_section();

        $this->start_controls_section(
            'gsl_tabs_section',
            [
                'label' => esc_html__('Tabs Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'gsl_tab_title',
            [
                'label' => esc_html__('Tab Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Building Finishes', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'gsl_tab_image',
            [
                'label' => esc_html__('Background Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => 'https://placehold.co/1200x600/A87F58/FFF'],
            ]
        );

        $repeater->add_control(
            'gsl_info_icon',
            [
                'label' => esc_html__('Info Box Icon', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => ['value' => 'eicon-info-circle-o', 'library' => 'eicons'],
            ]
        );

        $repeater->add_control(
            'gsl_info_title',
            [
                'label' => esc_html__('Info Box Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Building Finishes', 'elementor-addon'),
            ]
        );

        $features_repeater = new \Elementor\Repeater();

        $features_repeater->add_control(
            'gsl_feature_text',
            [
                'label' => esc_html__('Feature Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Olmsted 3-storey heritage structure built in 1879 in the French Second Empire style.', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'gsl_features_list',
            [
                'label' => esc_html__('Features List', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $features_repeater->get_controls(),
                'default' => [
                    [
                        'gsl_feature_text' => esc_html__('Olmsted 3-storey heritage structure built in 1879 in the French Second Empire style.', 'elementor-addon'),
                    ],
                    [
                        'gsl_feature_text' => esc_html__('Updated finishing details in corridors and entranceways.', 'elementor-addon'),
                    ],
                    [
                        'gsl_feature_text' => esc_html__('State-of-the-art building access system.', 'elementor-addon'),
                    ],
                    [
                        'gsl_feature_text' => esc_html__('Sprinkler system throughout the building.', 'elementor-addon'),
                    ]
                ],
                'title_field' => '{{{ gsl_feature_text }}}',
            ]
        );

        $repeater->add_control(
            'gsl_button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Contact us', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'gsl_button_url',
            [
                'label' => esc_html__('Button URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'gsl_tabs',
            [
                'label' => esc_html__('Tabs', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'gsl_tab_title' => esc_html__('Building Finishes', 'elementor-addon'),
                        'gsl_info_title' => esc_html__('Building Finishes', 'elementor-addon'),
                        'gsl_features_list' => [
                            ['gsl_feature_text' => esc_html__('Olmsted 3-storey heritage structure built in 1879 in the French Second Empire style.', 'elementor-addon')],
                            ['gsl_feature_text' => esc_html__('Updated finishing details in corridors and entranceways.', 'elementor-addon')],
                            ['gsl_feature_text' => esc_html__('State-of-the-art building access system.', 'elementor-addon')],
                            ['gsl_feature_text' => esc_html__('Sprinkler system throughout the building.', 'elementor-addon')]
                        ]
                    ],
                    [
                        'gsl_tab_title' => esc_html__('Kitchen', 'elementor-addon'),
                        'gsl_info_title' => esc_html__('Kitchen Features', 'elementor-addon'),
                        'gsl_features_list' => [
                            ['gsl_feature_text' => esc_html__('Modern stainless steel appliances.', 'elementor-addon')],
                            ['gsl_feature_text' => esc_html__('Quartz countertops with waterfall edge.', 'elementor-addon')],
                            ['gsl_feature_text' => esc_html__('Custom soft-close cabinetry.', 'elementor-addon')],
                            ['gsl_feature_text' => esc_html__('Undermount LED lighting.', 'elementor-addon')]
                        ]
                    ],
                    [
                        'gsl_tab_title' => esc_html__('Bath', 'elementor-addon'),
                        'gsl_info_title' => esc_html__('Bathroom Features', 'elementor-addon'),
                        'gsl_features_list' => [
                            ['gsl_feature_text' => esc_html__('Heated marble flooring.', 'elementor-addon')],
                            ['gsl_feature_text' => esc_html__('Rainfall showerhead with body jets.', 'elementor-addon')],
                            ['gsl_feature_text' => esc_html__('Floating vanity with dual sinks.', 'elementor-addon')],
                            ['gsl_feature_text' => esc_html__('Anti-fog mirror with built-in LED lighting.', 'elementor-addon')]
                        ]
                    ],
                    [
                        'gsl_tab_title' => esc_html__('Interior Suite Finishes', 'elementor-addon'),
                        'gsl_info_title' => esc_html__('Interior Finishes', 'elementor-addon'),
                        'gsl_features_list' => [
                            ['gsl_feature_text' => esc_html__('Wide-plank European oak flooring.', 'elementor-addon')],
                            ['gsl_feature_text' => esc_html__('Floor-to-ceiling windows with motorized blinds.', 'elementor-addon')],
                            ['gsl_feature_text' => esc_html__('Smart home automation system.', 'elementor-addon')],
                            ['gsl_feature_text' => esc_html__('Custom built-in storage solutions.', 'elementor-addon')]
                        ]
                    ]
                ],
                'title_field' => '{{{ gsl_tab_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'gsl_style_section',
            [
                'label' => esc_html__('Styling', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

        <style>
            .gsl-tabs-section {
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 50px;
            }

            .gsl-heading-wrapper {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 10px;
                max-width: 900px;
                margin: 0 auto;
                text-align: center;
            }

            .gsl-tabs-menu {
                display: flex;
                justify-content: space-between;
                width: 100%;
                border-bottom: 1px solid #e5e5e5;
                overflow-x: hidden;
            }

            .gsl-tab-menu-item {
                font-weight: bold;
                cursor: pointer;
                padding: 1rem 0;
                position: relative;
                color: #999;
                transition: color 0.3s ease;
                flex: 1;
                text-align: center;
                white-space: nowrap;
                font-size: initial;
            }

            .gsl-tab-menu-item:after {
                content: '';
                position: absolute;
                bottom: -1px;
                left: 0;
                width: 100%;
                height: 2px;
                background-color: transparent;
                transition: background-color 0.3s ease;
            }

            .gsl-tab-menu-item.active {
                color: #A87F58;
            }

            .gsl-tab-menu-item.active:after {
                background-color: #A87F58;
            }

            .gsl-tabs-content {
                position: relative;
                overflow: hidden;
                margin-bottom: 0;
            }

            .gsl-tab-content-item {
                display: none;
                width: 100%;
                transition: opacity 0.5s ease-in-out;
            }

            .gsl-tab-content-item.active {
                display: block;
                opacity: 1;
            }

            .gsl-tab-image {
                width: 100%;
                height: auto;
                border-radius: 0.75rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }

            .gsl-info-box {
                position: absolute;
                bottom: 1.5rem;
                right: 1.5rem;
                background-color: rgba(255, 255, 255, 0.9);
                padding: 1.5rem;
                border-radius: 0.5rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                max-width: 350px;
                text-align: left;
                margin: 0;
            }

            .gsl-info-box-header {
                display: flex;
                gap: 10px;
                margin-bottom: 1rem;
                flex-direction: row;
                align-items: center;
            }

            .gsl-info-box-icon-wrapper {
                flex-shrink: 0;
                width: 40px;
                height: 40px;
                background-color: #4D4337;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .gsl-info-box-icon {
                color: white;
                font-size: 1.25rem;
            }

            .gsl-info-box h3 {
                font-size: 1.25rem;
                font-weight: bold;
                margin: 0;
            }

            .gsl-info-box ul {
                list-style: none;
                padding: 0;
                margin: 0;
                line-height: 1.6;
                font-size: initial;
            }

            .gsl-info-box li:before {
                content: '• ';
                color: #A87F58;
            }

            .gsl-info-box-link {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-top: 1rem;
                color: #A67131;
                text-decoration: none;
                font-family: "Albra Book TRIAL", sans-serif;
                font-size: 16px;
                font-weight: 500;
                line-height: 110%;
                transition: opacity 0.3s ease;
            }

            .gsl-info-box-link:hover {
                opacity: 0.8;
            }

            .gsl-button-wrapper {
                text-align: center;
                width: 100%;
                display: flex;
                justify-content: center;
            }

            @media (max-width: 768px) {
                .gsl-tabs-section {
                    padding: 0 15px;
                    gap: 30px;
                }

                .gsl-button-wrapper {
                    padding: 0 15px;
                }

                .gsl-tabs-menu {
                    justify-content: flex-start;
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                    overflow-y: hidden;
                }

                .gsl-tab-menu-item {
                    padding: 1rem 15px;
                    flex-shrink: 0;
                    flex: initial;
                    font-size: 14px;
                }

                .gsl-tab-content-item {
                    display: none;
                    flex-direction: column;
                    gap: 20px;
                }

                .gsl-tab-content-item.active {
                    display: flex;
                }

                .gsl-tab-image {
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                }

                .gsl-info-box {
                    position: static;
                    background-color: #ffffff;
                    box-shadow: none;
                    max-width: 100%;
                }

                .gsl-info-box-icon-wrapper {
                    width: 35px;
                    height: 35px;
                }

                .gsl-info-box h3 {
                    font-size: 1.1rem;
                }

                .gsl-info-box ul {
                    font-size: 14px;
                }
            }
        </style>

        <div class="gsl-tabs-section pageWidth">
            <div class="gsl-heading-wrapper">
                <h1 class="gsl-section-title"><?php echo esc_html($settings['gsl_main_title']); ?></h1>
                <p class="text"><?php echo esc_html($settings['gsl_main_description']); ?></p>
            </div>

            <div class="gsl-tabs-menu">
                <?php foreach ($settings['gsl_tabs'] as $i => $item) : ?>
                    <div class="gsl-tab-menu-item <?php echo $i === 0 ? 'active' : ''; ?>" data-tab-index="<?php echo $i; ?>">
                        <?php echo esc_html($item['gsl_tab_title']); ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="gsl-tabs-content">
                <?php foreach ($settings['gsl_tabs'] as $i => $item) : ?>
                    <div class="gsl-tab-content-item <?php echo $i === 0 ? 'active' : ''; ?>" data-tab-index="<?php echo $i; ?>">
                        <img src="<?php echo esc_url($item['gsl_tab_image']['url']); ?>" class="gsl-tab-image" alt="<?php echo esc_attr($item['gsl_tab_title']); ?> Image">
                        <div class="gsl-info-box">
                            <div class="gsl-info-box-header">
                                <div class="gsl-info-box-icon-wrapper">
                                    <?php \Elementor\Icons_Manager::render_icon($item['gsl_info_icon'], ['class' => 'gsl-info-box-icon'], 'svg'); ?>
                                </div>
                                <h3><?php echo esc_html($item['gsl_info_title']); ?></h3>
                            </div>
                            <ul>
                                <?php foreach ($item['gsl_features_list'] as $feature) :
                                    if (!empty(trim($feature['gsl_feature_text']))) : ?>
                                        <li><?php echo esc_html($feature['gsl_feature_text']); ?></li>
                                <?php endif;
                                endforeach; ?>
                            </ul>
                            <?php if ($item['gsl_button_text'] && $item['gsl_button_url']['url']) : ?>
                                <a href="<?php echo esc_url($item['gsl_button_url']['url']); ?>" class="gsl-info-box-link">
                                    <?php echo esc_html($item['gsl_button_text']); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.91591 16.0978C7.56088 16.4528 6.98528 16.4528 6.63026 16.0978C6.27524 15.7428 6.27524 15.1672 6.63026 14.8122L11.442 10.0005L6.63026 5.18876C6.27524 4.83373 6.27524 4.25813 6.63026 3.90311C6.98528 3.54809 7.56088 3.54809 7.91591 3.90311L13.3705 9.35765C13.7255 9.71268 13.7255 10.2883 13.3705 10.6433L7.91591 16.0978Z" fill="#A67131" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($settings['gsl_section_button_text'] && $settings['gsl_section_button_url']['url']) : ?>
                <div class="gsl-button-wrapper">
                    <a href="<?php echo esc_url($settings['gsl_section_button_url']['url']); ?>"
                        class="mainButton" <?php echo $settings['gsl_section_button_url']['is_external'] ? 'target="_blank"' : ''; ?>
                        <?php echo $settings['gsl_section_button_url']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                        <?php echo esc_html($settings['gsl_section_button_text']); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const menuItems = document.querySelectorAll('.gsl-tab-menu-item');
                const contentItems = document.querySelectorAll('.gsl-tab-content-item');

                menuItems.forEach(menuItem => {
                    menuItem.addEventListener('click', () => {
                        menuItems.forEach(item => item.classList.remove('active'));
                        contentItems.forEach(item => item.classList.remove('active'));

                        const tabIndex = menuItem.getAttribute('data-tab-index');
                        menuItem.classList.add('active');
                        contentItems[tabIndex].classList.add('active');
                    });
                });
            });
        </script>
<?php
    }
}
