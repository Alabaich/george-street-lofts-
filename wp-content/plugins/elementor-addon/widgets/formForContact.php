<?php
/**
 * Elementor Widget for a Contact Form Layout.
 *
 * A custom Elementor widget to display a contact form section with a
 * two-column layout, based on the provided screenshot.
 */
class Elementor_formForContact extends \Elementor\Widget_Base
{

    // Widget Handle
    public function get_name()
    {
        return 'formForContact';
    }

    // Widget Title
    public function get_title()
    {
        return esc_html__('Form For Contact', 'elementor-addon');
    }

    // Widget Icon
    public function get_icon()
    {
        return 'eicon-form-horizontal';
    }

    // Widget Categories
    public function get_categories()
    {
        return ['basic'];
    }

    // Register Widget Controls
    protected function register_controls()
    {

        // Section: General Content
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('General Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__("We're Excited To Hear From You!", 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Please fill out the form below and a member of our team will get back to you shortly to answer your questions and provide more details.', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        // Section: Left Column
        $this->start_controls_section(
            'section_left_column',
            [
                'label' => esc_html__('Left Column', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'map_iframe',
            [
                'label' => esc_html__('Google Maps Iframe', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('<iframe src="..."></iframe>', 'elementor-addon'),
                'description' => esc_html__('Go to Google Maps, find a location, click "Share", then "Embed a map", and copy the HTML.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'phone',
            [
                'label' => esc_html__('Phone', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('289-797-1604', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'email',
            [
                'label' => esc_html__('Email', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('lease@prismpm.ca', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        // Section: Social Media Links
        $this->start_controls_section(
            'section_social_media',
            [
                'label' => esc_html__('Social Media', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'social_icon',
            [
                'label' => esc_html__('Icon', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-instagram',
                    'library' => 'fa-brands',
                ],
            ]
        );

        $repeater->add_control(
            'social_link',
            [
                'label' => esc_html__('Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
                'default' => ['url' => '#'],
            ]
        );

        $this->add_control(
            'social_links_list',
            [
                'label' => esc_html__('Social Links', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['social_icon' => ['value' => 'fab fa-instagram', 'library' => 'fa-brands']],
                    ['social_icon' => ['value' => 'fab fa-facebook-f', 'library' => 'fa-brands']],
                    ['social_icon' => ['value' => 'fab fa-youtube', 'library' => 'fa-brands']],
                    ['social_icon' => ['value' => 'fab fa-linkedin-in', 'library' => 'fa-brands']],
                ],
                'title_field' => '{{{ social_icon.value }}}',
            ]
        );

        $this->end_controls_section();

        // Section: Form
        $this->start_controls_section(
            'section_form',
            [
                'label' => esc_html__('Form', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'form_shortcode',
            [
                'label' => esc_html__('Form Shortcode', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('[wpforms id="123"]', 'elementor-addon'),
                'description' => esc_html__('Enter the shortcode for your form (e.g., from WPForms, Contact Form 7).', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'privacy_policy_text',
            [
                'label' => esc_html__('Privacy Policy Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('"By clicking Submit button you agree to our <strong>Privacy Policy</strong> terms."', 'elementor-addon'),
                'description' => esc_html__('This text will appear next to the submit button. Positioning may vary depending on your form plugin\'s output.', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();
    }

    // Render Widget Output
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = 'cfl-' . $this->get_id();
        ?>
        <style>
            .<?php echo esc_attr($widget_id); ?> {
                font-family: sans-serif;
                color: #333;
                text-align: center;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-header h2 {
                font-family: "Serif", "Times New Roman", serif;
                font-size: 3rem;
                font-weight: normal;
                margin: 0 0 15px 0;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-header p {
                color: #555;
                line-height: 1.6;
                max-width: 600px;
                margin: 0 auto 50px auto;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-main-content {
                display: flex;
                gap: 50px;
                text-align: left;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-left-col,
            .<?php echo esc_attr($widget_id); ?> .cfl-right-col {
                flex: 1;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-map-container {
                margin-bottom: 30px;
                filter: grayscale(1) opacity(0.8);
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-map-container iframe {
                width: 100%;
                height: 350px;
                border: 0;
                display: block;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-contact-details {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-detail-item h4 {
                margin: 0 0 5px 0;
                font-size: 0.9rem;
                color: #777;
                font-weight: normal;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-detail-item p,
            .<?php echo esc_attr($widget_id); ?> .cfl-detail-item a {
                margin: 0;
                line-height: 1.5;
                color: #333;
                text-decoration: none;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-social-icons {
                display: flex;
                gap: 15px;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-social-icon-link {
                color: #333;
                font-size: 1.2rem;
                transition: color 0.3s;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-social-icon-link:hover {
                color: #000;
            }

            .cfl-form-container .wpforms-container .wpforms-form .wpforms-field.wpforms-field-name .wpforms-field-row,
            .cfl-form-container .wpforms-field,
            .cfl-form-container .wpforms-container-full,
            .cfl-form-container .wpforms-container input.wpforms-field-medium {
                min-width: 100%;
                max-width: 100%;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-form-container .wpforms-field,
            .<?php echo esc_attr($widget_id); ?> .cfl-form-container .wpcf7-form-control-wrap {
                margin-bottom: 0;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-form-container .wpforms-submit-container,
            .<?php echo esc_attr($widget_id); ?> .cfl-form-container .wpcf7-form-control.wpcf7-submit {
                display: inline-block;
                margin-right: 15px;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-form-wrapper {
                display: flex;
                flex-direction: column;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-form-footer {
                display: flex;
                align-items: center;
                gap: 20px;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-privacy-text {
                flex: 1;
                font-size: 0.8rem;
                color: #777;
                line-height: 1.5;
            }

            .<?php echo esc_attr($widget_id); ?> .cfl-privacy-text a,
            .<?php echo esc_attr($widget_id); ?> .cfl-privacy-text strong {
                color: #555;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .<?php echo esc_attr($widget_id); ?> .cfl-main-content {
                    flex-direction: column;
                }

                .<?php echo esc_attr($widget_id); ?> .cfl-contact-details {
                    grid-template-columns: 1fr;
                }

                .<?php echo esc_attr($widget_id); ?> .cfl-form-footer {
                    flex-direction: column;
                    align-items: flex-start;
                }
            }

            .cfl-main-content div.wpforms-container-full:not(:empty) {
                margin: 0;
                margin-bottom: 20px;
            }

            div.wpforms-container-full button {
                display: flex !important;
                width: 180px !important;
                height: 52px !important;
                padding: 16px 32px !important;
                justify-content: center !important;
                align-items: center !important;
                gap: 10px !important;
                border-radius: 4px !important;
                background: var(--Accent-color, #A67131) !important;
            }

                        div.wpforms-container-full button:active {
                border: none !important;
                outline: none !important;
            }

            .cfl-main-content .wpforms-container .wpforms-field{
                padding: 0 0 30px 0;
            }
        </style>

        <div class="<?php echo esc_attr($widget_id); ?> pageWidth">
            <div class="cfl-header">
                <h2><?php echo esc_html($settings['title']); ?></h2>
                <p><?php echo esc_html($settings['description']); ?></p>
            </div>

            <div class="cfl-main-content">
                <div class="cfl-left-col">
                    <?php if (!empty($settings['map_iframe'])): ?>
                        <div class="cfl-map-container">
                            <?php echo $settings['map_iframe']; ?>
                        </div>
                    <?php endif; ?>
                    <div class="cfl-contact-details">
                        <div class="cfl-detail-item">
                            <h4>Phone</h4>
                            <p><a
                                    href="tel:<?php echo esc_attr(preg_replace('/[^\d+]/', '', $settings['phone'])); ?>"><?php echo esc_html($settings['phone']); ?></a>
                            </p>
                        </div>
                        <div class="cfl-detail-item">
                            <h4>Email</h4>
                            <p><a
                                    href="mailto:<?php echo esc_attr($settings['email']); ?>"><?php echo esc_html($settings['email']); ?></a>
                            </p>
                        </div>
                        <?php if (!empty($settings['social_links_list'])): ?>
                            <div class="cfl-detail-item">
                                <h4>Social Media</h4>
                                <div class="cfl-social-icons">
                                    <?php foreach ($settings['social_links_list'] as $item): ?>
                                        <a href="<?php echo esc_url($item['social_link']['url']); ?>" class="cfl-social-icon-link" <?php if (!empty($item['social_link']['is_external'])) {
                                               echo 'target="_blank" rel="noopener noreferrer"';
                                           } ?>>
                                            <?php \Elementor\Icons_Manager::render_icon($item['social_icon'], ['aria-hidden' => 'true']); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="cfl-right-col">
                    <div class="cfl-form-wrapper">
                        <?php if (!empty($settings['form_shortcode'])): ?>
                            <div class="cfl-form-container">
                                <?php echo do_shortcode($settings['form_shortcode']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($settings['privacy_policy_text'])): ?>
                            <div class="cfl-form-footer">
                                <div class="cfl-privacy-text">
                                    <?php echo wp_kses_post($settings['privacy_policy_text']); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

