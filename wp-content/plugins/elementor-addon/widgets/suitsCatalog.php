<?php

class Elementor_SuitesCatalog extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'SuitesCatalog';
    }

    public function get_title()
    {
        return esc_html__('Suites and Life Catalog', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
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
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Explore More', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Discover Suites, Stories, And Life At George Street Lofts', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cards',
            [
                'label' => esc_html__('Catalog Cards', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'card_title',
            [
                'label' => esc_html__('Card Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Suites', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'card_image',
            [
                'label' => esc_html__('Background Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'card_link',
            [
                'label' => esc_html__('Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'catalog_cards',
            [
                'label' => esc_html__('Catalog Items', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_fields(),
                'default' => [
                    ['card_title' => 'Suites'],
                    ['card_title' => 'News'],
                    ['card_title' => 'About Us'],
                    ['card_title' => 'Neighbourhood'],
                    ['card_title' => 'Gallery'],
                ],
                'title_field' => '{{{ card_title }}}',
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
            'card_text_color',
            [
                'label' => esc_html__('Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .catalog-card-title' => 'color: {{VALUE}};',
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
            .suites-catalog-section {
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 50px;
            }

            .catalog-subtitle {
                color: var(--Text-color, #5C5C5C);
                font-family: Arial;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
            }

            .catalog-grid {
                display: flex;
                justify-content: center;
                gap: 20px;
                flex-wrap: wrap;
            }

            .catalog-card {
                flex: 1 1 180px;
                height: 400px;
                border-radius: 8px;
                overflow: hidden;
                position: relative;
                text-decoration: none;
                color: #fff;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .catalog-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }

            .card-background {
                width: 100%;
                height: 100%;
                background-size: cover;
                background-position: center;
                position: absolute;
                transition: transform 0.6s ease;
            }

            .catalog-card:hover .card-background {
                transform: scale(1.05);
            }

            .card-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0) 50%);
                display: flex;
                align-items: flex-end;
                justify-content: center;
                padding: 20px;
            }

            .catalog-card-title {
                margin: 0;
                text-align: center;
                position: relative;
                z-index: 2;
                color: var(--White, #FFF);
                font-size: 24px;
                font-style: normal;
                font-weight: 500;
                line-height: 140%;
                text-transform: capitalize;
                transition: transform 0.3s ease;
                transform: translateY(0);
            }

            .catalog-card:hover .catalog-card-title {
                transform: translateY(-20px);
            }

            @media (max-width: 1024px) {
                .catalog-card {
                    flex: 1 1 calc(33.33% - 20px);
                    max-width: none;
                    height: 300px;
                }

                .catalog-grid {
                    justify-content: space-around;
                }
            }

            @media (max-width: 767px) {
                .catalog-title {
                    font-size: 30px;
                }

                .catalog-card {
                    flex: 1 1 calc(50% - 20px);
                    height: 250px;
                }

                .catalog-grid {
                    gap: 15px;
                }
            }

            @media (max-width: 480px) {
                .catalog-card {
                    flex: 1 1 100%;
                }
            }
        </style>

        <section class="suites-catalog-section pageWidth">
            <div class="catalog-header">
                <?php if ($settings['subtitle']) : ?>
                    <p class="catalog-subtitle"><?php echo esc_html($settings['subtitle']); ?></p>
                <?php endif; ?>
                <h2 class="catalog-title"><?php echo nl2br(esc_html($settings['title'])); ?></h2>
            </div>

            <div class="catalog-grid">
                <?php
                if ($settings['catalog_cards']) {
                    foreach ($settings['catalog_cards'] as $card) {
                        $image_url = $card['card_image']['url'] ? esc_url($card['card_image']['url']) : \Elementor\Utils::get_placeholder_image_src();
                        $link_url = $card['card_link']['url'] ? esc_url($card['card_link']['url']) : '#';
                        $target = $card['card_link']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $card['card_link']['nofollow'] ? ' rel="nofollow"' : '';

                        echo '<a href="' . $link_url . '" class="catalog-card"' . $target . $nofollow . '>';
                        echo '<div class="card-background" style="background-image: url(' . $image_url . ');"></div>';
                        echo '<div class="card-overlay">';
                        echo '<h3 class="catalog-card-title">' . esc_html($card['card_title']) . '</h3>';
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
