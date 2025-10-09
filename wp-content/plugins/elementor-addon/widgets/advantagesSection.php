<?php

class Elementor_AdvantagesSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'AdvantagesSection';
    }

    public function get_title()
    {
        return esc_html__('Explore Advantages Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-info-box';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_general_content',
            [
                'label' => esc_html__('Section Titles', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Explore Our Advantages', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Look what you can have with Atria', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_advantage_items',
            [
                'label' => esc_html__('Advantage Items', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_image',
            [
                'label' => esc_html__('Image/SVG Icon', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'item_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Advantage Title', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'item_description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('This is a description of a key advantage.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'advantage_list',
            [
                'label' => esc_html__('Advantage List', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_fields(),
                'default' => [
                    [
                        'item_title' => esc_html__('Smart Home', 'elementor-addon'),
                        'item_description' => esc_html__('Enjoy smartphone-controlled features like thermostats and lighting.', 'elementor-addon'),
                    ],
                    [
                        'item_title' => esc_html__('Ecofriendly', 'elementor-addon'),
                        'item_description' => esc_html__('Buildings are energy-efficient and often include EV charging stations.', 'elementor-addon'),
                    ],
                    [
                        'item_title' => esc_html__('Resident Amenities', 'elementor-addon'),
                        'item_description' => esc_html__('Access to gyms, pools, media rooms, and relaxing rooftop terraces.', 'elementor-addon'),
                    ],
                    [
                        'item_title' => esc_html__('Convenient Locations', 'elementor-addon'),
                        'item_description' => esc_html__('Properties are strategically located near major highways and public transit.', 'elementor-addon'),
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
?>
        <style>
            .atria-advantages-section {
                background-color: #4D4337;
                color: #fff;
                display: flex;
                flex-direction: column;
                gap: 50px;
                padding-top: 75px;
                padding-bottom: 75px;
            }

            .atria-advantages-header {
                text-align: center;
            }

            .atria-advantages-title {
                color: #fff;
            }

            .atria-advantages-subtitle {
                color: var(--Input, #F3F5F6);
                text-align: center;
                font-family: "Open Sans", sans-serif;
                font-size: 18px;
                font-style: normal;
                font-weight: 400;
                line-height: 140%;
            }

            .atria-advantages-grid {
                display: flex;
                gap: 20px;
                justify-content: center;
                flex-wrap: wrap;
            }

            .atria-advantage-item {
                display: flex;
                padding: 32px 20px;
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                flex: 1 0 0;
                border-radius: 4px;
                background: var(--Light-Brown, #5A5147);
            }

            .atria-advantage-item .atria-advantage-icon-wrapper {
                line-height: 1;
            }

            .atria-advantage-item .atria-advantage-icon-wrapper img,
            .atria-advantage-item .atria-advantage-icon-wrapper svg {
                width: 35px;
                height: 35px;
                display: block;
                color: #f7f4f0;
                fill: #f7f4f0;
            }

            .atria-advantage-title {
                color: var(--White, #FFF);
                font-family: "Cormorant", serif;
                font-size: 24px;
                font-style: normal;
                font-weight: 500;
                line-height: 140%;
                text-transform: capitalize;
            }

            .atria-advantage-description {
                color: var(--Input, #F3F5F6);
                font-family: "Open Sans", sans-serif;
                font-size: 18px;
                font-style: normal;
                font-weight: 400;
                line-height: 140%;
                text-align: left;
            }

            @media (max-width: 1024px) {
                .atria-advantages-title {
                    font-size: 36px;
                }

                .atria-advantage-item {
                    flex: 1 1 calc(50% - 15px);
                    max-width: calc(50% - 15px);
                    min-height: 220px;
                }
            }

            @media (max-width: 767px) {
                .atria-advantages-section {
                    padding: 40px 0;
                }

                .atria-advantages-title {
                    font-size: 30px;
                }

                .atria-advantages-grid {
                    flex-direction: column;
                    align-items: center;
                    gap: 15px;
                }

                .atria-advantage-item {
                    flex: 0 0 100%;
                    max-width: 90%;
                    min-height: auto;
                    padding: 25px;
                    text-align: left;
                }
            }
        </style>

        <section class="atria-advantages-section pageWidth">
            <div class="atria-advantages-header gsl-heading-wrapper">
                <h2 class="atria-advantages-title"><?php echo esc_html($settings['main_title']); ?></h2>
                <p class="atria-advantages-subtitle"><?php echo esc_html($settings['subtitle']); ?></p>
            </div>

            <div class="atria-advantages-grid">
                <?php
                if ($settings['advantage_list']) {
                    foreach ($settings['advantage_list'] as $item) {
                        $this->add_render_attribute('list_item_' . $item['_id'], 'class', 'atria-advantage-item');
                        $this->add_render_attribute('item_title_' . $item['_id'], 'class', 'atria-advantage-title');
                        $this->add_render_attribute('item_description_' . $item['_id'], 'class', 'atria-advantage-description');

                        $image_url = !empty($item['item_image']['url']) ? esc_url($item['item_image']['url']) : '';
                        $image_alt = esc_attr($item['item_title']);

                        echo '<div ' . $this->get_render_attribute_string('list_item_' . $item['_id']) . '>';

                        if ($image_url) {
                            echo '<div class="atria-advantage-icon-wrapper">';
                            echo '<img src="' . $image_url . '" alt="' . $image_alt . '">';
                            echo '</div>';
                        }

                        echo '<h3 ' . $this->get_render_attribute_string('item_title_' . $item['_id']) . '>' . esc_html($item['item_title']) . '</h3>';
                        echo '<p ' . $this->get_render_attribute_string('item_description_' . $item['_id']) . '>' . esc_html($item['item_description']) . '</p>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </section>
<?php
    }
}
