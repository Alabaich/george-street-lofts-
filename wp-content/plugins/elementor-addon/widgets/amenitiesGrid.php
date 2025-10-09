<?php

class Elementor_AmenitiesGridWidget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'AmenitiesGrid';
    }

    public function get_title()
    {
        return esc_html__('Amenities Grid', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-apps';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['amenities', 'walkscore', 'icons', 'grid', 'neighbourhood'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Neighbourhood', 'elementor-addon'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_title',
            [
                'label' => esc_html__('Category Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Grocery Stores', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'item_icon_svg',
            [
                'label' => esc_html__('Icon SVG Code', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'description' => esc_html__('Paste the full SVG code for the icon here.', 'elementor-addon'),
            ]
        );

        $list_repeater = new \Elementor\Repeater();

        $list_repeater->add_control(
            'list_name',
            [
                'label' => esc_html__('Place Name', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'FreshCo',
            ]
        );

        $list_repeater->add_control(
            'list_distance',
            [
                'label' => esc_html__('Distance Value', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '15',
            ]
        );

        $list_repeater->add_control(
            'list_unit',
            [
                'label' => esc_html__('Unit', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Minute Walk',
            ]
        );

        $repeater->add_control(
            'item_list',
            [
                'label' => esc_html__('Places List', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $list_repeater->get_controls(),
                'default' => [
                    ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                    ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                    ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                ],
                'title_field' => '{{{ list_name }}} ({{{ list_distance }}} {{{ list_unit }}}) ',
            ]
        );

        $this->add_control(
            'columns_list',
            [
                'label' => esc_html__('Amenity Columns', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_title' => 'Grocery Stores',
                        'item_icon_svg' => '<svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.6667 11.4583H43.3333M11.6667 11.4583L17.7083 43.5417C17.8444 44.2575 18.2574 44.9084 18.8837 45.3855C19.51 45.8626 20.3164 46.1362 21.1458 46.1362H33.8542C34.6836 46.1362 35.49 45.8626 36.1163 45.3855C36.7426 44.9084 37.1556 44.2575 37.2917 43.5417L43.3333 11.4583M11.6667 11.4583H3.75V7.70833H11.6667V11.4583ZM43.3333 11.4583H51.25V7.70833H43.3333V11.4583ZM21.875 19.375V37.5M33.125 19.375V37.5M27.5 19.375V37.5M19.7917 19.375H35.2083" stroke="#A87F58" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                        'item_list' => [
                            ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                            ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                            ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                        ],
                    ],
                    [
                        'item_title' => 'Parks',
                        'item_icon_svg' => '<svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.7083 40.2083L27.5 35.5L37.2917 40.2083M10.5188 35.8333L16.4812 40.2083M44.4812 35.8333L38.5188 40.2083M27.5 7.70833V35.5M27.5 7.70833C27.5 7.70833 32.2083 15.625 27.5 19.375C22.7917 23.125 27.5 31.0417 27.5 31.0417M27.5 19.375V31.0417M13.75 47.7083H41.25M17.7083 47.7083V40.2083M37.2917 47.7083V40.2083" stroke="#A87F58" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                        'item_list' => [
                            ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                            ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                            ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                        ],
                    ],
                    [
                        'item_title' => 'Transit Stops',
                        'item_icon_svg' => '<svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M46.75 34.375C46.75 40.9167 44.8333 42.8333 41.25 42.8333H13.75C10.1667 42.8333 8.25 40.9167 8.25 34.375V25.2083C8.25 24.3167 8.52083 23.4667 9.01458 22.7667L12.75 17.5V11.4583C12.75 10.5667 13.5167 9.79167 14.4083 9.79167H40.5917C41.4833 9.79167 42.25 10.5667 42.25 11.4583V17.5L45.9854 22.7667C46.4792 23.4667 46.75 24.3167 46.75 25.2083V34.375Z" stroke="#A87F58" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.625 42.8333C17.1354 42.8333 18.3333 41.6354 18.3333 40.125C18.3333 38.6146 17.1354 37.4167 15.625 37.4167C14.1146 37.4167 12.9167 38.6146 12.9167 40.125C12.9167 41.6354 14.1146 42.8333 15.625 42.8333ZM39.375 42.8333C40.8854 42.8333 42.0833 41.6354 42.0833 40.125C42.0833 38.6146 40.8854 37.4167 39.375 37.4167C37.8646 37.4167 36.6667 38.6146 36.6667 40.125C36.6667 41.6354 37.8646 42.8333 39.375 42.8333Z" stroke="#A87F58" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.75 24.5833H42.25M27.5 24.5833V20.8333" stroke="#A87F58" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                        'item_list' => [
                            ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                            ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                            ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                        ],
                    ],
                    [
                        'item_title' => 'Commute',
                        'item_icon_svg' => '<svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M27.5 7.70833L46.75 47.7083L27.5 40.2083L8.25 47.7083L27.5 7.70833Z" stroke="#A87F58" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M27.5 7.70833V40.2083M27.5 40.2083L46.75 47.7083M27.5 40.2083L8.25 47.7083" stroke="#A87F58" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                        'item_list' => [
                            ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                            ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                            ['list_name' => 'FreshCo', 'list_distance' => '15', 'list_unit' => 'Minute Walk'],
                        ],
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['columns_list'])) {
            return;
        }
?>

        <style>
            .neighbourhood-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .neighbourhood-title {
                color: #32302F;
                font-family: "Cormorant", serif;
                font-size: 48px;
                font-weight: 500;
                line-height: 110%;
                margin-bottom: 50px;
                text-align: center;
            }

            .amenity-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
                width: 100%;
            }

            @media (max-width: 768px) {
                .amenity-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 480px) {
                .amenity-grid {
                    grid-template-columns: 1fr;
                }
            }

            .amenity-column {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            .amenity-icon-wrap {
                width: 55px;
                height: 55px;
            }

            .amenity-icon-wrap svg {
                width: 100%;
                height: 100%;
            }

            .amenity-category-title {
                color: var(--Black, #32302F);
                font-family: "Cormorant", serif;
                font-size: 28px;
                font-style: normal;
                font-weight: 500;
                line-height: 130%;
                text-transform: capitalize;
            }

            .amenity-list {
                width: 100%;
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .amenity-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 0;
            }

            .amenity-item:nth-child(odd) {
                background-color: transparent;
            }

            .amenity-item-name-wrap {
                background-color: #F8F5F1;
                width: 100%;
                padding: 10px 0;
                margin-bottom: 5px;
            }

            .amenity-item-name {
                color: #A87F58;
                font-family: "Open Sans", sans-serif;
                font-size: 14px;
                font-weight: 700;
                line-height: 100%;
            }

            .amenity-item-value-wrap {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 5px 0 10px 0;
            }

            .amenity-item-distance {
                color: var(--Black, #32302F);
                text-align: center;
                font-family: "Cormorant", serif;
                font-size: 56px;
                font-style: normal;
                font-weight: 500;
                line-height: 110%;
                letter-spacing: -0.56px;
                text-transform: capitalize;
            }

            .amenity-item-unit {
                color: var(--Black, #32302F);
                font-family: "Cormorant", serif;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
            }
        </style>

        <div class="neighbourhood-container pageWidth">
            <h2 class="neighbourhood-title">
                <?php echo esc_html($settings['section_title']); ?>
            </h2>

            <div class="amenity-grid">
                <?php
                foreach ($settings['columns_list'] as $column) :
                    if (empty($column['item_list'])) {
                        continue;
                    }
                ?>
                    <div class="amenity-column">
                        <div class="amenity-icon-wrap">
                            <?php echo $column['item_icon_svg']; ?>
                        </div>
                        <h3 class="amenity-category-title">
                            <?php echo esc_html($column['item_title']); ?>
                        </h3>

                        <ul class="amenity-list">
                            <?php
                            foreach ($column['item_list'] as $item) :
                            ?>
                                <li class="amenity-item">
                                    <div class="amenity-item-name-wrap">
                                        <p class="amenity-item-name"><?php echo esc_html($item['list_name']); ?></p>
                                    </div>

                                    <div class="amenity-item-value-wrap">
                                        <p class="amenity-item-distance"><?php echo esc_html($item['list_distance']); ?></p>
                                        <p class="amenity-item-unit"><?php echo esc_html($item['list_unit']); ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

<?php
    }
}
