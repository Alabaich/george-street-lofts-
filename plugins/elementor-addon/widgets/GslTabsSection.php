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
        // Content Tab
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

        // Tabs Repeater Tab
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
                    ['gsl_tab_title' => esc_html__('Building Finishes', 'elementor-addon')],
                    ['gsl_tab_title' => esc_html__('Kitchen', 'elementor-addon')],
                    ['gsl_tab_title' => esc_html__('Bath', 'elementor-addon')],
                    ['gsl_tab_title' => esc_html__('Interior Suite Finishes', 'elementor-addon')]
                ],
                'title_field' => '{{{ gsl_tab_title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Tab
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
                margin: 0 auto;
                margin-bottom: 2px;
            }

            .gsl-tabs-menu {
                display: flex;
                justify-content: center;
                gap: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .gsl-tab-menu-item {
                font-weight: bold;
                cursor: pointer;
                padding: 0.5rem 0;
                position: relative;
                color: #999;
                transition: color 0.3s ease;
            }

            .gsl-tab-menu-item:after {
                content: '';
                position: absolute;
                bottom: 0;
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
                position: relative;
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
            }

            .gsl-info-box-header {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-bottom: 1rem;
            }

            .gsl-info-box-icon {
                color: #A87F58;
                font-size: 1.5rem;
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
            }

            .gsl-info-box li:before {
                content: '• ';
                color: #A87F58;
            }

            .gsl-info-box a {
                display: inline-block;
                margin-top: 1rem;
                color: #A87F58;
                text-decoration: none;
                font-weight: bold;
            }

            .gsl-info-box a:hover {
                text-decoration: underline;
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
                                <?php \Elementor\Icons_Manager::render_icon($item['gsl_info_icon'], ['aria-hidden' => 'true', 'class' => 'gsl-info-box-icon']); ?>
                                <h3><?php echo esc_html($item['gsl_info_title']); ?></h3>
                            </div>
                            <ul>
                                <?php foreach ($item['gsl_features_list'] as $feature) : ?>
                                    <li><?php echo esc_html($feature['gsl_feature_text']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php if ($item['gsl_button_text'] && $item['gsl_button_url']['url']) : ?>
                                <a href="<?php echo esc_url($item['gsl_button_url']['url']); ?>">
                                    <?php echo esc_html($item['gsl_button_text']); ?>
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
                        // Remove 'active' class from all menu items and content
                        menuItems.forEach(item => item.classList.remove('active'));
                        contentItems.forEach(item => item.classList.remove('active'));

                        // Add 'active' class to the clicked menu item and corresponding content
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
