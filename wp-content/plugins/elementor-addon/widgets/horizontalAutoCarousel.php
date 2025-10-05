<?php

class Elementor_HorizontalAutoCarousel extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'HorizontalAutoCarousel';
    }

    public function get_title()
    {
        return esc_html__('Horizontal Auto Carousel', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-slider-album';
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
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_description' => esc_html__('Add Images to Carousel.', 'elementor-addon'),
                    ]
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <style>

            .horizontalAutoCarousel {
                width: 100%;
                overflow: hidden;
                -webkit-mask-image: linear-gradient(to right,
                        transparent 0%,
                        black 10%,
                        black 90%,
                        transparent 100%);
                mask-image: linear-gradient(to right,
                        transparent 0%,
                        black 10%,
                        black 90%,
                        transparent 100%);
            }

            .carousel-track {
                display: flex;
                will-change: transform;
                animation: scroll-animation 40s linear infinite;
            }

            .horizontalAutoCarousel .carousel-item {
                height: 400px;
                width: auto;
                flex-shrink: 0;
                margin: 0 10px;
                object-fit: contain;
            }

            @keyframes scroll-animation {
                from {
                    transform: translateX(0);
                }

                to {
                    transform: translateX(-50%);
                }
            }

            /* Зупиняємо анімацію при наведенні миші */
            .horizontalAutoCarousel:hover .carousel-track {
                animation-play-state: paused;
            }
        </style>

        <section class="horizontalAutoCarousel pageWidth">
            <div class="carousel-track">
                <?php
                if ($settings['advantage_list']) {
                    foreach ($settings['advantage_list'] as $item) {
                        $this->add_render_attribute('list_item_' . $item['_id'], 'class', 'atria-advantage-item');
                        $this->add_render_attribute('item_description_' . $item['_id'], 'class', 'atria-advantage-description');

                        $image_url = !empty($item['item_image']['url']) ? esc_url($item['item_image']['url']) : '';
                        $image_alt = esc_attr($item['item_description']);
                        echo '<img class="carousel-item" src="' . $image_url . '" alt="' . $image_alt . '">';
                    }
                }
                ?>
            </div>
        </section>

            <script>
        // --- ЛОГІКА НА JAVASCRIPT ---

        const track = document.querySelector('.carousel-track');

        // Перевіряємо, чи є зображення в треку, перед тим як їх дублювати
        if (track.children.length > 0) {
            // Дублюємо всі існуючі зображення (які ви додали в HTML) для безшовного ефекту.
            const originalItems = Array.from(track.children);
            originalItems.forEach(item => {
                const clone = item.cloneNode(true);
                track.appendChild(clone);
            });
        }
        
    </script>
        <?php
    }
}
