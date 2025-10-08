<?php

class Elementor_AwardsAndRecognition extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'awards_and_recognition';
    }

    public function get_title()
    {
        return esc_html__('Awards Grid', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-award';
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
                'label' => esc_html__('Header', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Our Awards & Recognition', 'elementor-addon'),
                'placeholder' => esc_html__('Enter main title', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('We are proud of our achievements and industry recognition', 'elementor-addon'),
                'placeholder' => esc_html__('Enter subtitle', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_awards',
            [
                'label' => esc_html__('Awards Items', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_type',
            [
                'label' => esc_html__('Item Type', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image_only',
                'options' => [
                    'image_only' => esc_html__('Image Only', 'elementor-addon'),
                    'with_text' => esc_html__('Image with Text', 'elementor-addon'),
                ],
            ]
        );

        $repeater->add_control(
            'award_title',
            [
                'label' => esc_html__('Award Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Award Name', 'elementor-addon'),
                'placeholder' => esc_html__('Enter award title', 'elementor-addon'),
                'label_block' => true,
                'condition' => [
                    'item_type' => 'with_text'
                ],
            ]
        );

        $repeater->add_control(
            'award_subtitle',
            [
                'label' => esc_html__('Award Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Short description of the award', 'elementor-addon'),
                'placeholder' => esc_html__('Enter award description', 'elementor-addon'),
                'label_block' => true,
                'condition' => [
                    'item_type' => 'with_text'
                ],
            ]
        );

        $repeater->add_control(
            'award_image',
            [
                'label' => esc_html__('Award Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'award_svg',
            [
                'label' => esc_html__('Award SVG Code', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::CODE,
                'language' => 'svg',
                'rows' => 10,
                'placeholder' => esc_html__('Paste SVG code here', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'award_link',
            [
                'label' => esc_html__('Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
                'options' => false,
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'awards_list',
            [
                'label' => esc_html__('Awards List', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_fields(),
                'default' => [
                    [
                        'item_type' => 'with_text',
                        'award_title' => esc_html__('Best Company 2024', 'elementor-addon'),
                        'award_subtitle' => esc_html__('Industry Excellence Award', 'elementor-addon'),
                        'award_image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                    [
                        'item_type' => 'image_only',
                        'award_image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                    [
                        'item_type' => 'image_only',
                        'award_svg' => '<svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 15L7 10H17L12 15Z" fill="currentColor"/></svg>',
                    ],
                ],
                'title_field' => '{{{ item_type }}} - {{{ award_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $awards = $settings['awards_list'];
?>
        <style>
            .gsl-awards-section {
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 50px;
            }

            .gsl-awards-grid {
                display: flex;
                flex-wrap: wrap;
                gap: 50px;
                align-items: start;
                justify-content: center;
            }

            .gsl-award-item {
                text-align: center;
                padding: 30px 20px;
                border-radius: 12px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                flex: 0 0 auto;
            }

            .gsl-award-item:hover {
                transform: translateY(-5px);
            }

            .gsl-award-item-image-only {
                padding: 20px;
            }

            .gsl-award-image-wrapper {
                width: 150px;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 12px;
            }

            .gsl-award-item-image-only .gsl-award-image-wrapper {
                margin-bottom: 0;
            }

            .gsl-award-image {
                display: block;
                max-width: 100%;
                max-height: 100%;
                height: auto;
                object-fit: contain;
            }

            .gsl-award-svg {
                width: 80px;
                height: 80px;
                color: #333;
            }

            @media (max-width: 767px) {
                .gsl-awards-grid {
                    flex-direction: column;
                    gap: 30px;
                    align-items: center;
                }

                .gsl-award-item {
                    width: 100%;
                    max-width: 300px;
                    padding: 20px 15px;
                }

                .gsl-award-item-image-only {
                    padding: 15px;
                }

                .gsl-award-image-wrapper {
                    width: 120px;
                }
            }
        </style>

        <div class="gsl-awards-section pageWidth">
            <div class="gsl-awards-header">
                <?php if (!empty($settings['main_title'])) : ?>
                    <h2 class="gsl-awards-main-title"><?php echo esc_html($settings['main_title']); ?></h2>
                <?php endif; ?>
                <?php if (!empty($settings['subtitle'])) : ?>
                    <p class="gsl-awards-subtitle"><?php echo esc_html($settings['subtitle']); ?></p>
                <?php endif; ?>
            </div>

            <?php if (!empty($awards)) : ?>
                <div class="gsl-awards-grid">
                    <?php foreach ($awards as $award) : ?>
                        <?php
                        $item_type = $award['item_type'];
                        $image_url = !empty($award['award_image']['url']) ? $award['award_image']['url'] : '';
                        $image_alt = !empty($award['award_image']['alt']) ? $award['award_image']['alt'] : esc_attr($award['award_title']);
                        $svg_code = !empty($award['award_svg']) ? $award['award_svg'] : '';
                        $link = $award['award_link'];
                        $link_url = !empty($link['url']) ? $link['url'] : '';
                        $target = !empty($link['is_external']) ? ' target="_blank"' : '';
                        $nofollow = !empty($link['nofollow']) ? ' rel="nofollow"' : '';
                        $item_class = $item_type === 'image_only' ? 'gsl-award-item gsl-award-item-image-only' : 'gsl-award-item';
                        ?>

                        <?php if ($link_url) : ?>
                            <a href="<?php echo esc_url($link_url); ?>" class="<?php echo $item_class; ?>" <?php echo $target . $nofollow; ?>>
                            <?php else : ?>
                                <div class="<?php echo $item_class; ?>">
                                <?php endif; ?>

                                <div class="gsl-award-image-wrapper">
                                    <?php if ($svg_code) : ?>
                                        <div class="gsl-award-svg"><?php echo $svg_code; ?></div>
                                    <?php elseif ($image_url) : ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="gsl-award-image">
                                    <?php endif; ?>
                                </div>

                                <?php if ($item_type === 'with_text') : ?>
                                    <?php if (!empty($award['award_title'])) : ?>
                                        <h3 class="gsl-award-title"><?php echo esc_html($award['award_title']); ?></h3>
                                    <?php endif; ?>

                                    <?php if (!empty($award['award_subtitle'])) : ?>
                                        <p class="gsl-award-subtitle"><?php echo esc_html($award['award_subtitle']); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if ($link_url) : ?>
                            </a>
                        <?php else : ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </div>
<?php
    }
}

add_action('elementor/widgets/register', function ($widgets_manager) {
    $widgets_manager->register(new \Elementor_AwardsAndRecognition());
});
