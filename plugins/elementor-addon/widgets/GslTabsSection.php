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
            }

            .gsl-heading-wrapper {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 10px;
                max-width: 900px;
                margin: 0 auto 50px;
                text-align: center;
            }

            .gsl-tabs-menu {
                display: flex;
                justify-content: space-between;
                width: 100%;
                margin-bottom: 1.5rem;
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

            @media (max-width: 768px) {
                .gsl-tabs-section {
                    padding: 0 15px;
                }

                .gsl-heading-wrapper {
                    margin-bottom: 30px;
                }

                .gsl-tabs-menu {
                    justify-content: flex-start;
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
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
                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.584 1.25403C12.6391 1.25424 14.3424 2.75912 14.6543 4.72668H16.6592C17.1515 4.72668 17.5041 4.72328 17.8096 4.79114C18.8279 5.01757 19.6233 5.81285 19.8496 6.83118C19.9174 7.13658 19.9131 7.48933 19.9131 7.98157C19.9131 8.47358 19.9174 8.82566 19.8496 9.13098C19.7275 9.68045 19.4381 10.1632 19.0391 10.5284C19.0407 10.5472 19.0459 10.5659 19.0459 10.5851V11.879C19.0459 13.0089 19.0464 13.8957 18.9883 14.6075C18.9295 15.327 18.8067 15.9253 18.5303 16.4679C18.0774 17.3568 17.3547 18.0794 16.4658 18.5323C15.9232 18.8088 15.325 18.9316 14.6055 18.9904C13.8935 19.0485 13.0069 19.048 11.877 19.048H9.28906C8.15909 19.048 7.27247 19.0485 6.56055 18.9904C5.84098 18.9316 5.24285 18.8088 4.7002 18.5323C3.81131 18.0794 3.08866 17.3568 2.63574 16.4679C2.35932 15.9253 2.23652 15.327 2.17773 14.6075C2.1196 13.8957 2.12012 13.0089 2.12012 11.879L2.12012 10.5851C2.12012 10.5659 2.12337 10.5472 2.125 10.5284C1.72648 10.1633 1.4384 9.67999 1.31641 9.13098C1.24858 8.82565 1.25195 8.47361 1.25195 7.98157C1.25195 7.48933 1.24858 7.13658 1.31641 6.83118C1.54276 5.8128 2.33807 5.0175 3.35645 4.79114C3.66188 4.72328 4.01453 4.72668 4.50684 4.72668H6.5127C6.82472 2.75898 8.52868 1.25403 10.584 1.25403ZM17.7451 11.1808C17.4543 11.2351 17.1175 11.2355 16.6592 11.2355H14.7061V11.4562C14.7059 11.8151 14.4146 12.1056 14.0557 12.1056C13.6968 12.1056 13.4054 11.8151 13.4053 11.4562V11.2355L7.76172 11.2355V11.4562C7.7616 11.8151 7.47024 12.1056 7.11133 12.1056C6.75242 12.1056 6.46106 11.8151 6.46094 11.4562V11.2355H4.50684C4.04847 11.2355 3.71175 11.2351 3.4209 11.1808L3.4209 11.879C3.4209 13.0304 3.42081 13.8554 3.47363 14.5021C3.52585 15.141 3.62646 15.5493 3.79395 15.8781C4.1222 16.5222 4.64593 17.0459 5.29004 17.3741C5.61885 17.5417 6.02698 17.6422 6.66602 17.6945C7.31275 17.7473 8.13757 17.7472 9.28906 17.7472H11.877C13.0284 17.7472 13.8533 17.7473 14.5 17.6945C15.139 17.6422 15.5472 17.5417 15.876 17.3741C16.5201 17.0459 17.0438 16.5222 17.3721 15.8781C17.5396 15.5493 17.6402 15.141 17.6924 14.5021C17.7452 13.8554 17.7451 13.0304 17.7451 11.879V11.1808ZM4.50684 6.02747C3.94517 6.02747 3.76971 6.0306 3.63867 6.05969C3.11287 6.17652 2.70178 6.5876 2.58496 7.1134C2.55589 7.24443 2.55273 7.42007 2.55273 7.98157C2.55274 8.54243 2.55594 8.71778 2.58496 8.84875C2.70181 9.37451 3.1129 9.78566 3.63867 9.90247C3.76972 9.93157 3.94511 9.93567 4.50684 9.93567H6.46094V9.71985C6.461 9.36092 6.75238 9.06946 7.11133 9.06946C7.47027 9.06946 7.76165 9.36092 7.76172 9.71985V9.93567L13.4053 9.93567V9.71985C13.4053 9.36092 13.6967 9.06946 14.0557 9.06946C14.4146 9.06946 14.706 9.36092 14.7061 9.71985V9.93567H16.6592C17.221 9.93567 17.3963 9.93158 17.5273 9.90247C18.053 9.78561 18.4632 9.37446 18.5801 8.84875C18.6091 8.71776 18.6133 8.54266 18.6133 7.98157C18.6133 7.4199 18.6092 7.24444 18.5801 7.1134C18.4633 6.58765 18.0531 6.17654 17.5273 6.05969C17.3963 6.03058 17.221 6.02747 16.6592 6.02747L4.50684 6.02747ZM10.584 2.55481C9.24946 2.55481 8.13483 3.48197 7.84082 4.72668L13.3271 4.72668C13.0331 3.4821 11.9183 2.55501 10.584 2.55481Z" fill="white" />
                                    </svg>
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
