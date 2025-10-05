<?php
class Elementor_LandAcknowledgementSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'LandAcknowledgementSection';
    }

    public function get_title()
    {
        return esc_html__('Land Acknowledgement Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-text-area';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['land', 'acknowledgement', 'culture', 'indigenous'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Section Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Land Acknowledgement', 'elementor-addon'),
                'placeholder' => esc_html__('Type your title here', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'main_description',
            [
                'label' => esc_html__('Main Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 3,
                'default' => esc_html__('We respectfully acknowledge that we are gathered on the traditional territories of the Mississaugas Anishinaabeg.', 'elementor-addon'),
                'placeholder' => esc_html__('Enter a description for the section', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'left_column_section',
            [
                'label' => esc_html__('Left Column (Durham Region)', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'left_column_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'left_column_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Durham Region', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'left_column_description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => esc_html__('Priam Property Management operates on the traditional territory of the Mississaugas of Scugog Island First Nation, part of the Mississaugas Anishinaabeg and the Williams Treaties First Nations.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'left_column_learn_more_html',
            [
                'label' => esc_html__('Learn More Text (WYSIWYG)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('To learn more, visit:', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'right_column_section',
            [
                'label' => esc_html__('Right Column (Peterborough)', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'right_column_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'right_column_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Peterborough (Nogojiwanong)', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'right_column_description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => esc_html__('George Street Lofts is located on the traditional territory of the Michi Saagiig Anishinaabeg, covered by Treaty 20 and the Williams Treaties. This land is home to the Curve Lake, Hiawatha, and Alderville First Nations.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'right_column_learn_more_html',
            [
                'label' => esc_html__('Learn More Text (WYSIWYG)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('To learn more, visit:', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <style>
            .land-ack-section {
                color: #333;
                text-align: center;
            }

            .land-ack-container {
                display: flex;
                flex-direction: column;
                gap: 50px;
            }

            .land-ack-columns {
                display: flex;
                gap: 50px;
                justify-content: center;
                flex-wrap: wrap;
            }

            .land-ack-column {
                flex: 1;
                text-align: left;
                display: flex;
                flex-direction: column;
                gap: 15px;
                cursor: pointer;
            }

            .land-ack-image-zoom {
                overflow: hidden;
                border-radius: 4px;
            }

            .land-ack-column:hover .land-ack-image-zoom img {
                transform: scale(1.05);
            }

            .land-ack-column img {
                width: 100%;
                height: 350px;
                object-fit: cover;
                border-radius: 4px;
                transition: transform 0.4s ease-in-out;
            }

            .land-ack-column-title {
                color: var(--Black, #32302F);
                font-family: "Albra Book TRIAL";
                font-size: 32px;
                font-style: normal;
                font-weight: 500;
                line-height: 110%;
                letter-spacing: -0.32px;
                text-transform: capitalize;
            }

            .land-ack-column-description {
                color: var(--Text-color, #5C5C5C);
                font-family: Arial;
                font-size: 18px;
                font-style: normal;
                font-weight: 400;
                line-height: 140%;
            }

            .land-ack-learn-more-wrapper {
                font-family: Arial;
                font-size: 18px;
                font-style: normal;
                font-weight: 400;
                line-height: 140%;
                text-align: left;
            }

            .land-ack-learn-more-wrapper a {
                color: var(--Black, #32302F);
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .land-ack-learn-more-wrapper a:hover {
                color: #0056b3;
                text-decoration: underline;
            }

            @media (max-width: 768px) {
                .land-ack-main-title {
                    font-size: 36px;
                }
                .land-ack-container {
                    gap: 25px;
                }

                .land-ack-columns {
                    flex-direction: column;
                    align-items: center;
                    gap: 30px;
                }

                .land-ack-column {
                    width: 100%;
                    max-width: 500px;
                    flex: none;
                }
            }

            @media (max-width: 480px) {
                .land-ack-main-title {
                    font-size: 30px;
                }

                .land-ack-column img {
                    height: 250px;
                }
            }
        </style>

        <section class="land-ack-section pageWidth">
            <div class="land-ack-container">
                <div class="gsl-heading-wrapper">
                    <?php if (!empty($settings['main_title'])) : ?>
                        <h2 class="land-ack-main-title"><?php echo esc_html($settings['main_title']); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($settings['main_description'])) : ?>
                        <p class="land-ack-main-description"><?php echo esc_html($settings['main_description']); ?></p>
                    <?php endif; ?>
                </div>

                <div class="land-ack-columns">
                    <div class="land-ack-column">
                        <?php if (!empty($settings['left_column_image']['url'])) : ?>
                            <div class="land-ack-image-zoom">
                                <img src="<?php echo esc_url($settings['left_column_image']['url']); ?>" alt="<?php echo esc_attr($settings['left_column_title']); ?>">
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($settings['left_column_title'])) : ?>
                            <h3 class="land-ack-column-title"><?php echo esc_html($settings['left_column_title']); ?></h3>
                        <?php endif; ?>

                        <?php if (!empty($settings['left_column_description'])) : ?>
                            <p class="land-ack-column-description"><?php echo esc_html($settings['left_column_description']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($settings['left_column_learn_more_html'])) : ?>
                            <div class="land-ack-learn-more-wrapper">
                                <?php
                                echo $settings['left_column_learn_more_html'];
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="land-ack-column">
                        <?php if (!empty($settings['right_column_image']['url'])) : ?>
                            <div class="land-ack-image-zoom">
                                <img src="<?php echo esc_url($settings['right_column_image']['url']); ?>" alt="<?php echo esc_attr($settings['right_column_title']); ?>">
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($settings['right_column_title'])) : ?>
                            <h3 class="land-ack-column-title"><?php echo esc_html($settings['right_column_title']); ?></h3>
                        <?php endif; ?>

                        <?php if (!empty($settings['right_column_description'])) : ?>
                            <p class="land-ack-column-description"><?php echo esc_html($settings['right_column_description']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($settings['right_column_learn_more_html'])) : ?>
                            <div class="land-ack-learn-more-wrapper">
                                <?php
                                echo $settings['right_column_learn_more_html'];
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
