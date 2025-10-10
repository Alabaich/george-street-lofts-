<?php

class Elementor_ImagesTabs extends \Elementor\Widget_Base
{

    // Widget Name
    public function get_name()
    {
        return 'imagesTabs';
    }

    // Widget Title
    public function get_title()
    {
        return esc_html__('Image Tabs', 'elementor-addon');
    }

    // Widget Icon
    public function get_icon()
    {
        return 'eicon-tabs';
    }

    // Widget Categories
    public function get_categories()
    {
        return ['basic'];
    }

    // Register Widget Controls
    protected function register_controls()
    {
        // Section: General Titles
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
                'default' => esc_html__('Amenities', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Thoughtfully designed features to enhance your living experience', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        // Section: Repeater Tabs
        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__('Tabs', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tab_nav_title',
            [
                'label' => esc_html__('Tab Navigation Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Lobby Lounge', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'upper_title',
            [
                'label' => esc_html__('Upper Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Lorem Ipsum', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Lobby & Lounge', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('George Street Lofts features a spacious double height lobby enclosed in glass offering that creates an impressive entrance with security desk and ample seating...', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tabs_list',
            [
                'label' => esc_html__('Tab Items', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['tab_nav_title' => esc_html__('Lobby Lounge', 'elementor-addon')],
                    ['tab_nav_title' => esc_html__('Gym', 'elementor-addon')],
                    ['tab_nav_title' => esc_html__('Terrace', 'elementor-addon')],
                ],
                'title_field' => '{{{ tab_nav_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    // Render Widget Output
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        ?>
        <style>
            .imagesTabs-<?php echo esc_attr($widget_id); ?> {
                font-family: sans-serif;
                background: var(--Brown-bg);
                padding-top: 100px;
                padding-bottom: 100px;
            }
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .tabs-header {
                text-align: center;
                margin-bottom: 50px;
            }
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .tabs-header-title {
                font-size: 2.5rem;
                margin: 0 0 10px 0;
                color: #fff;
            }
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .tabs-header-subtitle {
                font-size: 1rem;
                color: #fff;
                max-width: 500px;
                margin: 0 auto;
            }
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .tabs-container {
                display: flex;
                gap: 100px;
            }
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .tabs-nav {
                flex: 1;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .tab-nav-button {
                background-color: transparent;
                border: none;
                padding: 15px 20px;
                cursor: pointer;
                text-align: left;
                font-size: 1rem;
                border-radius: 8px;
                transition: all 0.3s, color 0.3s;
                color: #FCF8F3;
            }
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .tab-nav-button:hover,
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .tab-nav-button.active,
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .tab-nav-button.focus {
                background-color: #FCF8F3;
                color: #4D4337;
            }
            
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .tabs-content-wrapper {
                flex: 3;
            }
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .tab-content-panel {
                display: none;
                animation: fadeIn 0.5s;
            }
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .tab-content-panel.active {
                display: block;
            }
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .content-upper-title {
                font-size: 0.9rem;
                color: #fff;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-bottom: 5px;
            }
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .content-title {
                font-size: 1.8rem;
                margin: 0 0 15px 0;
                color: #fff;
            }
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .content-description {
                line-height: 1.6;
                color: #fff;
                margin-bottom: 25px;
            }
            .imagesTabs-<?php echo esc_attr($widget_id); ?> .content-image {
                width: 100%;
                height: auto;
                border-radius: 8px;
                aspect-ratio: 16/9;
                object-fit: cover;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }

            @media (max-width: 768px){
                .imagesTabs .tabs-container{
                    flex-direction: column;
                    gap: 25px;
                }

                .imagesTabs-f137d2e .tabs-nav{
                    flex-direction: row;
                    overflow-x: scroll;
                }
            }

            .imagesTabs .tabs-content-wrapper .content-description *{
                color: #fff;
            }
        </style>

        <div id="imagesTabs-<?php echo esc_attr($widget_id); ?>" class="imagesTabs pageWidth imagesTabs-<?php echo esc_attr($widget_id); ?>">
            
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
                        <?php foreach ($settings['tabs_list'] as $index => $item) : ?>
                            <div class="tab-content-panel <?php echo ($index === 0) ? 'active' : ''; ?>" data-tab-content="<?php echo esc_attr($index); ?>">
                                <p class="content-upper-title"><?php echo esc_html($item['upper_title']); ?></p>
                                <h3 class="content-title"><?php echo esc_html($item['title']); ?></h3>
                                <div class="content-description"><?php echo wp_kses_post($item['description']); ?></div>
                                <?php if (!empty($item['image']['url'])) : ?>
                                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>" class="content-image">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <script>
            (function() {
                const widgetContainer = document.querySelector('#imagesTabs-<?php echo esc_attr($widget_id); ?>');
                if (!widgetContainer) return;

                const tabButtons = widgetContainer.querySelectorAll('.tab-nav-button');
                const contentPanels = widgetContainer.querySelectorAll('.tab-content-panel');

                tabButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const tabIndex = this.getAttribute('data-tab');

                        // Deactivate all buttons and panels
                        tabButtons.forEach(btn => btn.classList.remove('active'));
                        contentPanels.forEach(panel => panel.classList.remove('active'));

                        // Activate the clicked button and corresponding panel
                        this.classList.add('active');
                        widgetContainer.querySelector(`.tab-content-panel[data-tab-content="${tabIndex}"]`).classList.add('active');
                    });
                });
            })();
        </script>
        <?php
    }
}
