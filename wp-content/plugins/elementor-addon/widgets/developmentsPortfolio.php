<?php

class Elementor_DevelopmentsPortfolioWidget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'DevelopmentsPortfolio';
    }

    public function get_title()
    {
        return esc_html__('Developments Portfolio', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['portfolio', 'developments', 'grid', 'filter'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General Settings', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Discover Atria’s Portfolio Of Developments', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__('Development Tabs & Items', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $item_repeater = new \Elementor\Repeater();

        $item_repeater->add_control(
            'dev_name',
            [
                'label' => esc_html__('Development Name', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'New Lofts',
            ]
        );

        $item_repeater->add_control(
            'dev_location',
            [
                'label' => esc_html__('Location', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '@ 123 Main St. Toronto ON',
            ]
        );

        $item_repeater->add_control(
            'dev_description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Converted historic industrial building offering stylish lofts with open layouts and high ceilings.',
            ]
        );

        $item_repeater->add_control(
            'dev_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
            ]
        );

        $item_repeater->add_control(
            'dev_button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Visit Website',
            ]
        );

        $item_repeater->add_control(
            'dev_button_link',
            [
                'label' => esc_html__('Button Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => ['url' => '#'],
                'options' => ['url', 'is_external', 'nofollow'],
            ]
        );

        $tab_repeater = new \Elementor\Repeater();

        $tab_repeater->add_control(
            'tab_label',
            [
                'label' => esc_html__('Tab Label (e.g., Completed)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Completed',
            ]
        );

        $tab_repeater->add_control(
            'tab_slug',
            [
                'label' => esc_html__('Tab Slug (e.g., completed_tab)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'completed',
            ]
        );

        $tab_repeater->add_control(
            'tab_items_list',
            [
                'label' => esc_html__('Developments in this Tab', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $item_repeater->get_controls(),
                'title_field' => '{{{ dev_name }}}',
            ]
        );

        $this->add_control(
            'development_tabs',
            [
                'label' => esc_html__('List of Development Tabs', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $tab_repeater->get_controls(),
                'default' => [
                    ['tab_label' => 'Completed', 'tab_slug' => 'completed'],
                    ['tab_label' => 'Under Construction', 'tab_slug' => 'construction'],
                    ['tab_label' => 'Upcoming', 'tab_slug' => 'upcoming'],
                ],
                'title_field' => '{{{ tab_label }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $tabs = $settings['development_tabs'];

        if (empty($tabs)) {
            return;
        }

        $all_items = [];
        $first_tab_slug = '';

        foreach ($tabs as $tab_index => $tab) {
            if ($tab_index === 0) {
                $first_tab_slug = $tab['tab_slug'];
            }
            if (!empty($tab['tab_items_list'])) {
                // Remove duplicates when merging into 'All' tab, based on name and location
                foreach ($tab['tab_items_list'] as $item) {
                    $dev_id = md5($item['dev_name'] . $item['dev_location']);
                    $all_items[$dev_id] = $item;
                }
            }
        }
        $all_items = array_values($all_items); // Reindex array after de-duplication

        // SVG code for the location pin
        $location_pin_svg = '
            <svg class="atria-dev-location-pin" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_737_1378)">
<path d="M16.6673 8.83317C16.6673 14.2498 10.0007 18.8332 10.0007 18.8332C10.0007 18.8332 3.33398 14.2498 3.33398 8.83317C3.33398 7.06506 4.03636 5.36937 5.28661 4.11913C6.53685 2.86888 8.23254 2.1665 10.0007 2.1665C11.7688 2.1665 13.4645 2.86888 14.7147 4.11913C15.9649 5.36937 16.6673 7.06506 16.6673 8.83317Z" stroke="#32302F" stroke-width="2"/>
<path d="M12.5 8.83301C12.5 9.49605 12.2366 10.1319 11.7678 10.6008C11.2989 11.0696 10.663 11.333 10 11.333C9.33696 11.333 8.70107 11.0696 8.23223 10.6008C7.76339 10.1319 7.5 9.49605 7.5 8.83301C7.5 8.16997 7.76339 7.53408 8.23223 7.06524C8.70107 6.5964 9.33696 6.33301 10 6.33301C10.663 6.33301 11.2989 6.5964 11.7678 7.06524C12.2366 7.53408 12.5 8.16997 12.5 8.83301Z" stroke="#32302F" stroke-width="2"/>
</g>
<defs>
<clipPath id="clip0_737_1378">
<rect width="20" height="20" fill="white" transform="translate(0 0.5)"/>
</clipPath>
</defs>
</svg>
';
?>

        <style>
            .atria-portfolio-container {
                display: flex;
                flex-direction: column;
                gap: 25px;
            }

            .atria-portfolio-title {
                text-align: center;
            }

            .atria-filter-tabs {
                display: flex;
                justify-content: center;
                gap: 10px;
            }

            .atria-tab-button {
                background-color: #F3F5F6;
                color: #2c2d2c;
                border: none;
                padding: 12px 20px;
                cursor: pointer;
                font-family: Arial, sans-serif;
                font-size: 14px;
                font-weight: 500;
                border-radius: 5px;
                transition: background-color 0.3s, color 0.3s;
            }

            .atria-tab-button:hover {
                background-color: #A87F58;
            }

            .atria-tab-button.active {
                background-color: #A87F58;
                color: #FFFFFF;
            }

            .atria-content-wrapper {
                min-height: 400px;
            }

            .atria-tab-content {
                display: none;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }

            .atria-tab-content.active {
                display: grid;
            }

            .atria-development-card {
                background-color: #F8F5F1;
                border-radius: 5px;
                overflow: hidden;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
                display: flex;
                flex-direction: column;
            }

            .atria-dev-image-wrap {
                width: 100%;
                height: 200px;
                overflow: hidden;
            }

            .atria-dev-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s;
            }

            .atria-development-card:hover .atria-dev-image {
                transform: scale(1.05);
            }

            .atria-dev-info {
                padding: 20px;
                display: flex;
                flex-direction: column;
                flex-grow: 1;
                gap: 10px;
            }

            .atria-dev-name {
                color: var(--Black, #32302F);
                font-family: Albra;
                font-size: 32px;
                font-style: normal;
                font-weight: 500;
                line-height: 110%;
                letter-spacing: -0.32px;
                text-transform: capitalize;
            }

            .atria-dev-location {
                color: var(--Black, #32302F);
                font-family: Albra;
                font-size: 18px;
                font-style: normal;
                font-weight: 500;
                line-height: 140%;
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .atria-dev-location-pin path {
                stroke: currentColor;
            }


            .atria-dev-description {
                color: var(--Text-color, #5C5C5C);
                font-family: Arial;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 140%;
                flex-grow: 1;
            }

            .atria-dev-button {
                width: fit-content;
                padding: 16px 32px;
            }

            .atria-dev-button.coming {
                background-color: #E6E1DC;
                color: #32302F;
                pointer-events: none;
            }

            @media (max-width: 992px) {
                .atria-tab-content {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 600px) {
                .atria-filter-tabs {
                    flex-wrap: wrap;
                }

                .atria-tab-button {
                    flex-grow: 1;
                }

                .atria-tab-content {
                    grid-template-columns: 1fr;
                }

                .atria-portfolio-title {
                    font-size: 30px;
                }
            }
        </style>

        <div class="atria-portfolio-container pageWidth">
            <h2 class="atria-portfolio-title"><?php echo esc_html($settings['section_title']); ?></h2>

            <div class="atria-filter-tabs">
                <button class="atria-tab-button active" data-tab-target="all">All</button>
                <?php foreach ($tabs as $tab) : ?>
                    <button class="atria-tab-button" data-tab-target="<?php echo esc_attr($tab['tab_slug']); ?>">
                        <?php echo esc_html($tab['tab_label']); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="atria-content-wrapper">

                <div id="all" class="atria-tab-content active">
                    <?php
                    foreach ($all_items as $item) :
                    ?>
                        <div class="atria-development-card">
                            <div class="atria-dev-image-wrap">
                                <?php if ($item['dev_image']['url']) : ?>
                                    <img src="<?php echo esc_url($item['dev_image']['url']); ?>" class="atria-dev-image" alt="<?php echo esc_attr($item['dev_name']); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="atria-dev-info">
                                <h3 class="atria-dev-name"><?php echo esc_html($item['dev_name']); ?></h3>
                                <p class="atria-dev-location">
                                    <?php echo $location_pin_svg; ?>
                                    <span><?php echo esc_html($item['dev_location']); ?></span>
                                </p>
                                <p class="atria-dev-description"><?php echo esc_html($item['dev_description']); ?></p>

                                <?php
                                $button_class = ($item['dev_button_text'] === 'Coming Soon') ? 'coming' : 'visit';
                                $button_link = ($button_class === 'visit' && $item['dev_button_link']['url']) ? esc_url($item['dev_button_link']['url']) : '#';
                                $target = $item['dev_button_link']['is_external'] ? ' target="_blank"' : '';
                                $nofollow = $item['dev_button_link']['nofollow'] ? ' rel="nofollow"' : '';
                                ?>
                                <a href="<?php echo $button_link; ?>" class="atria-dev-button mainButton <?php echo $button_class; ?>" <?php echo $target . $nofollow; ?>>
                                    <?php echo esc_html($item['dev_button_text']); ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php foreach ($tabs as $tab) : ?>
                    <div id="<?php echo esc_attr($tab['tab_slug']); ?>" class="atria-tab-content">
                        <?php if (!empty($tab['tab_items_list'])) : ?>
                            <?php foreach ($tab['tab_items_list'] as $item) : ?>
                                <div class="atria-development-card">
                                    <div class="atria-dev-image-wrap">
                                        <?php if ($item['dev_image']['url']) : ?>
                                            <img src="<?php echo esc_url($item['dev_image']['url']); ?>" class="atria-dev-image" alt="<?php echo esc_attr($item['dev_name']); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="atria-dev-info">
                                        <h3 class="atria-dev-name"><?php echo esc_html($item['dev_name']); ?></h3>
                                        <p class="atria-dev-location">
                                            <?php echo $location_pin_svg; ?>
                                            <span><?php echo esc_html($item['dev_location']); ?></span>
                                        </p>

                                        <p class="atria-dev-description"><?php echo esc_html($item['dev_description']); ?></p>

                                        <?php
                                        $button_class = ($item['dev_button_text'] === 'Coming Soon') ? 'coming' : 'visit';
                                        $button_link = ($button_class === 'visit' && $item['dev_button_link']['url']) ? esc_url($item['dev_button_link']['url']) : '#';
                                        $target = $item['dev_button_link']['is_external'] ? ' target="_blank"' : '';
                                        $nofollow = $item['dev_button_link']['nofollow'] ? ' rel="nofollow"' : '';
                                        ?>
                                        <a href="<?php echo $button_link; ?>" class="atria-dev-button <?php echo $button_class; ?>" <?php echo $target . $nofollow; ?>>
                                            <?php echo esc_html($item['dev_button_text']); ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p style="grid-column: 1 / -1; text-align: center; color: #7A7A7A;">No developments listed for this category.</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const container = document.querySelector('.elementor-widget-DevelopmentsPortfolio');
                // Use closest to find the container in case the render is inside an AJAX call or other wrapper
                if (!container) return;

                const tabs = container.querySelectorAll('.atria-tab-button');
                const contents = container.querySelectorAll('.atria-tab-content');

                function activateTab(targetId) {
                    tabs.forEach(tab => {
                        tab.classList.remove('active');
                        if (tab.getAttribute('data-tab-target') === targetId) {
                            tab.classList.add('active');
                        }
                    });

                    contents.forEach(content => {
                        content.classList.remove('active');
                        if (content.id === targetId) {
                            content.classList.add('active');
                        }
                    });
                }

                tabs.forEach(tab => {
                    tab.addEventListener('click', function() {
                        const targetId = this.getAttribute('data-tab-target');
                        activateTab(targetId);
                    });
                });

                // For Elementor Live Preview compatibility:
                // If Elementor is active, run the script logic immediately upon insertion
                if (window.elementorFrontend) {
                    window.elementorFrontend.hooks.addAction('frontend/element_ready/DevelopmentsPortfolio.default', function($scope) {
                        const widgetContainer = $scope[0];
                        const liveTabs = widgetContainer.querySelectorAll('.atria-tab-button');

                        liveTabs.forEach(tab => {
                            tab.addEventListener('click', function() {
                                const targetId = this.getAttribute('data-tab-target');
                                activateTab(targetId);
                            });
                        });

                        activateTab('all');
                    });
                }

                // Default activation for initial load
                activateTab('all');
            });
        </script>
<?php
    }
}
