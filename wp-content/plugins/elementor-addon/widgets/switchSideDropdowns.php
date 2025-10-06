<?php

class Elementor_SwitchSideDropdowns extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'switchSideDropdowns';
    }

    public function get_title()
    {
        return esc_html__('Switch Side Dropdowns', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-ehp-forms';
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
            'upperTitle',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

        $this->add_control(
            'textForButton',
            [
                'label' => esc_html__('Text For Button', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('insert text for button', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => esc_html__('URL to embed', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('This is a Title of the item.', 'elementor-addon'),
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
            'dropdowns',
            [
                'label' => esc_html__('Advantage List', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_title' => esc_html__('Advantage Title #1', 'elementor-addon'),
                        'item_description' => esc_html__('Advantage description text.', 'elementor-addon'),
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
            .switchSideDropdowns {
                display: flex;
                justify-content: space-between;
                align-items: start;
                gap: 50px;
            }

            .accordion-container {
                width: 50%;
                max-width: 50%;
                background-color: white;
                overflow: hidden;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                gap: 15px;
            }

            .switchSideDropdownsText{
                display: flex;
                justify-content: start;
                align-items: start;
                flex-direction: column;
                gap: 15px;
                width: 50%;
            }

            .accordion-item {
                background: #FCF8F3;
                border-radius: 12px;
                width: 100%;
            }

            .accordion-title {
                color: #333;
                cursor: pointer;
                padding: 18px 20px;
                width: 100%;
                border: none;
                text-align: left;
                outline: none;
                font-size: 1.8rem;
                font-weight: 500;
                display: flex;
                justify-content: space-between;
                align-items: center;
                transition: background-color 0.3s ease;
            }

            .accordion-title:hover,
            .accordion-title:active,
            .accordion-title:focus {
                background: #e5dcd1ff;
                color: #333;
                border-radius: 12px;
            }


            .accordion-title::after {
                content: '+';
                font-size: 20px;
                color: #888;
                transition: transform 0.3s ease-in-out;
            }

            .accordion-title.active {
                font-weight: 600;
            }

            .accordion-content {
                background-color: white;
                overflow: hidden;
                transition: max-height 0.3s ease-out;
                max-height: 0;
            }

            .accordion-content p {
                margin: 0;
                padding: 20px;
                font-size: 15px;
                line-height: 1.6;
                color: #555;
            }

                    .accordion-title.active::after {
            content: '−'; /* Змінюємо плюсик на мінус */
            transform: rotate(180deg);
        }
        </style>

        <section class="switchSideDropdowns pageWidth">
            <div class="switchSideDropdownsText">
                <p><?php echo $settings['upperTitle']; ?></p>
                <h2 style="text-align: left;">
                    <?php echo $settings['title']; ?>
                </h2>
                <p><?php echo $settings['description']; ?></p>
                <?php if (!empty($settings['url'])) {
                    ?>
                    <div class="buttonHeroSection">
                        <a class="customButton" href="<?php echo esc_url($settings['url']); ?>">
                            <?php echo esc_html($settings['textForButton']); ?>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="accordion-container">
                <?php
                if (!empty($settings['dropdowns'])) {
                    foreach ($settings['dropdowns'] as $item) {
                        $item_title = esc_html($item['item_title']);
                        $item_description = wp_kses_post($item['item_description']);
                        ?>
                        <div class="accordion-item">
                            <button class="accordion-title"><?php echo $item_title; ?></button>
                            <div class="accordion-content">
                                <p><?php echo $item_description; ?></p>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </section>

        <script>
            const accordionTitles = document.querySelectorAll('.accordion-title');
            accordionTitles.forEach(title => {
                title.addEventListener('click', () => {
                    title.classList.toggle('active');
                    const content = title.nextElementSibling;
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                    }
                });
            });
        </script>

        <?php
    }
}
