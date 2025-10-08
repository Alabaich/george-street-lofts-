<?php

class Elementor_TestimonialsSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'TestimonialsSection';
    }

    public function get_title()
    {
        return esc_html__('Resident Testimonials', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General Content (Large Quote)', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'testimonial_title',
            [
                'label' => esc_html__('Section Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Why Residents Love Living Here?', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'testimonial_quote_text',
            [
                'label' => esc_html__('Large Quote Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('“We Absolutely Love Living Here! The Management And Maintenance Team Are Not Only Friendly And Efficient, But They Also Go Above And Beyond By Hosting Resident Events Throughout The Year. It Truly Feels Like Home.”', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'testimonial_author',
            [
                'label' => esc_html__('Large Quote Author', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Warren And Lorraine', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'testimonial_location',
            [
                'label' => esc_html__('Large Quote Location', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('George Street Lofts', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'testimonial_rating',
            [
                'label' => esc_html__(
                    'Large Quote Rating (1-5)',
                    'elementor-addon'
                ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 5,
            ]
        );

        $this->add_control(
            'testimonial_image',
            [
                'label' => esc_html__(
                    'Image (Author/Scene)',
                    'elementor-addon'
                ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_small_testimonials',
            [
                'label' => esc_html__('Small Testimonials Grid', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'small_quote_text',
            [
                'label' => esc_html__('Quote Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('“This community is fantastic. The apartments are gorgeous and the location can\'t be beat!”', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'small_quote_author',
            [
                'label' => esc_html__('Author', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('A Happy Resident', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'small_quote_location',
            [
                'label' => esc_html__('Location', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Apartment 201', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'small_quote_rating',
            [
                'label' => esc_html__('Rating (1-5)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 5,
            ]
        );

        $this->add_control(
            'small_testimonials_list',
            [
                'label' => esc_html__('Testimonials', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['small_quote_text' => '“The maintenance team is prompt and efficient.”', 'small_quote_author' => 'Mark T.', 'small_quote_location' => 'Unit 1A'],
                    ['small_quote_text' => '“Great location, close to everything I need.”', 'small_quote_author' => 'Sarah K.', 'small_quote_location' => 'Unit 3B'],
                    ['small_quote_text' => '“Love the amenities and the friendly staff.”', 'small_quote_author' => 'David L.', 'small_quote_location' => 'Unit 5C'],
                ],
                'title_field' => '{{{ small_quote_author }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $star_svg_template = '<svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.802 6.26166C13.2254 4.95835 15.0693 4.95835 15.4928 6.26166L17.0058 10.9183C17.1952 11.5012 17.7383 11.8958 18.3512 11.8958H23.2475C24.6179 11.8958 25.1877 13.6494 24.079 14.4549L20.1178 17.3329C19.622 17.6931 19.4145 18.3316 19.6039 18.9145L21.117 23.5712C21.5404 24.8745 20.0487 25.9583 18.9401 25.1528L14.9789 22.2748C14.4831 21.9146 13.8117 21.9146 13.3159 22.2748L9.35466 25.1528C8.246 25.9583 6.7543 24.8745 7.17778 23.5712L8.69082 18.9145C8.8802 18.3316 8.67274 17.6931 8.17693 17.3329L4.21573 14.4549C3.10706 13.6494 3.67684 11.8958 5.04722 11.8958H9.94354C10.5564 11.8958 11.0995 11.5012 11.2889 10.9183L12.802 6.26166Z" fill="#FFE66A"/></svg>';

        $get_rating_stars = function ($rating_value) use ($star_svg_template) {
            $rating_stars_html = '';
            $rating = max(1, min(5, (int)$rating_value));
            for ($i = 0; $i < 5; $i++) {
                $fill_color = $i < $rating ? '#FFE66A' : '#E0E0E0';
                $rating_stars_html .= str_replace('fill="#FFE66A"', 'fill="' . $fill_color . '"', $star_svg_template);
            }
            return $rating_stars_html;
        };

        $large_quote_stars = $get_rating_stars($settings['testimonial_rating']);
?>
        <style>
            .atria-testimonials-section {
                font-family: Arial, sans-serif;
            }

            .atria-reviews-container {
                display: flex;
                flex-direction: column;
                gap: 25px;
            }

            .atria-section-title {
                text-align: center;
                margin-bottom: 50px;
                font-size: 36px;
                font-weight: bold;
                color: #2c2d2c;
            }

            .atria-reviews-container>.atria-section-title {
                margin-bottom: 50px;
            }

            .atria-reviews-container>.atria-testimonial-block {
                margin-top: -25px;
            }


            .atria-testimonial-block {
                display: flex;
                gap: 25px;
                align-items: stretch;
                margin-bottom: 0;
            }

            .atria-testimonial-image-wrapper {
                flex: 1;
                max-width: 50%;
                border-radius: 5px;
                overflow: hidden;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                height: 100%;
            }

            .atria-testimonial-image {
                width: 100%;
                height: 100%;
                display: block;
                object-fit: cover;
            }

            .atria-testimonial-quote-wrapper {
                flex: 1;
                max-width: 50%;
                display: flex;
                flex-direction: column;
                position: relative;
                padding: 30px;
                background-color: #f7f4f0;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                text-align: center;
                justify-content: center;
                gap: 50px;
            }

            .atria-quote-icon {
                position: absolute;
                top: -25px;
                right: -1%;
                transform: translateX(-50%);
                font-size: 100px;
                color: #4D4337;
                line-height: 1;
                opacity: 0.5;
            }

            .atria-quote-text {
                font-size: 20px;
                line-height: 1.4;
                font-style: italic;
                color: #4D4337;
                text-align: center;
            }

            .atria-quote-meta-wrapper {
                display: flex;
                flex-direction: column;
                gap: 10px;
                align-items: center;
            }

            .atria-quote-author {
                color: var(--Black, #32302F);
                font-family: "Albra Book TRIAL";
                font-size: 24px;
                font-style: normal;
                font-weight: 500;
                line-height: 140%;
                text-transform: capitalize;
                margin-bottom: 0;
            }

            .atria-quote-location {
                color: var(--Black, #32302F);
                font-family: Arial;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
                margin-bottom: 0;
            }

            .atria-rating-stars {
                display: flex;
                gap: 5px;
                justify-content: center;
                margin-top: 0;
            }

            .atria-rating-stars svg {
                width: 20px;
                height: 20px;
                vertical-align: middle;
            }

            .atria-small-quotes {
                display: flex;
                gap: 25px;
                justify-content: space-between;
                margin-top: 0;
            }

            .atria-small-quote-item {
                flex: 1;
                padding: 20px;
                background-color: #f7f4f0;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 10px;
                justify-content: space-between;
                min-height: 200px;
            }

            .atria-small-quote-text {
                color: var(--Black, #32302F);
                text-align: center;
                font-family: "Albra Book TRIAL";
                font-size: 18px;
                font-style: normal;
                font-weight: 500;
                line-height: 140%;
                flex-grow: 1;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .atria-small-quote-author {
                color: var(--Black, #32302F);
                font-family: "Albra Book TRIAL";
                font-size: 18px;
                font-style: normal;
                font-weight: 500;
                line-height: 140%;
                margin-bottom: 0;
            }

            .atria-small-quote-location {
                color: var(--Black, #32302F);
                font-family: Arial;
                font-size: 14px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
                letter-spacing: 0.14px;
                margin-bottom: 0;
            }

            @media (max-width: 992px) {
                .atria-testimonial-block {
                    flex-direction: column;
                    align-items: center;
                }

                .atria-testimonial-image-wrapper,
                .atria-testimonial-quote-wrapper {
                    max-width: 100%;
                }

                .atria-testimonial-quote-wrapper {
                    padding-left: 30px;
                    padding-right: 30px;
                    margin-top: 30px;
                    height: auto;
                }

                .atria-testimonial-image-wrapper {
                    height: auto;
                }

                .atria-testimonial-image {
                    height: auto;
                    object-fit: contain;
                }

                .atria-quote-icon {
                    top: -40px;
                    left: 90%;
                    transform: translateX(-50%);
                    right: auto;
                }

                .atria-small-quotes {
                    flex-wrap: wrap;
                    gap: 15px;
                }

                .atria-small-quote-item {
                    min-height: auto;
                    flex: 1 1 calc(50% - 10px);
                }

                .atria-small-quote-text {
                    flex-grow: 0;
                }
            }

            @media (max-width: 768px) {
                .atria-section-title {
                    font-size: 30px;
                    margin-bottom: 30px;
                }

                .atria-reviews-container {
                    gap: 25px;
                }

                .atria-testimonial-block {
                    gap: 25px;
                }

                .atria-testimonial-quote-wrapper {
                    padding: 20px;
                    height: auto;
                }

                .atria-small-quotes {
                    flex-direction: column;
                    gap: 15px;
                }

                .atria-small-quote-item {
                    flex: none;
                    width: 100%;
                    min-height: 180px;
                }

                .atria-small-quote-text {
                    flex-grow: 1;
                }
            }
        </style>

        <section class="atria-testimonials-section">
            <div class="atria-reviews-container pageWidth">
                <h2 class="atria-section-title"><?php echo esc_html($settings['testimonial_title']); ?></h2>

                <div class="atria-testimonial-block">
                    <div class="atria-testimonial-image-wrapper">
                        <?php if ($settings['testimonial_image']['url']) : ?>
                            <img src="<?php echo esc_url($settings['testimonial_image']['url']); ?>" class="atria-testimonial-image" alt="Residents photo">
                        <?php endif; ?>
                    </div>
                    <div class="atria-testimonial-quote-wrapper">
                        <span class="atria-quote-icon">“</span>
                        <p class="atria-quote-text"><?php echo nl2br(esc_html($settings['testimonial_quote_text'])); ?></p>
                        <div class="atria-quote-meta-wrapper">
                            <p class="atria-quote-author"><?php echo esc_html($settings['testimonial_author']); ?></p>
                            <p class="atria-quote-location"><?php echo esc_html($settings['testimonial_location']); ?></p>
                            <div class="atria-rating-stars">
                                <?php echo $large_quote_stars; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($settings['small_testimonials_list']) : ?>
                    <div class="atria-small-quotes">
                        <?php foreach ($settings['small_testimonials_list'] as $item) : ?>
                            <div class="atria-small-quote-item">
                                <p class="atria-small-quote-text"><?php echo nl2br(esc_html($item['small_quote_text'])); ?></p>
                                <div class="atria-quote-meta-wrapper">
                                    <p class="atria-small-quote-author"><?php echo esc_html($item['small_quote_author']); ?></p>
                                    <p class="atria-small-quote-location"><?php echo esc_html($item['small_quote_location']); ?></p>
                                    <div class="atria-rating-stars">
                                        <?php echo $get_rating_stars($item['small_quote_rating']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
<?php
    }
}