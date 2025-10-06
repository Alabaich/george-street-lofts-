<?php

class Elementor_ContactUsPageForm extends \Elementor\Widget_Base
{

    // Widget Name
    public function get_name()
    {
        return 'contactUsPageForm';
    }

    // Widget Title
    public function get_title()
    {
        return esc_html__('Contact Form & Map', 'elementor-addon');
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
                'label' => esc_html__('Content', 'elementor-addon'),
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
        
        // Section: Contact Details
        $this->start_controls_section(
            'section_contact_details',
            [
                'label' => esc_html__('Contact Details', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'phone',
			[
				'label' => esc_html__( 'Phone', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '289-797-1604', 'elementor-addon' ),
			]
		);

        $this->add_control(
			'email',
			[
				'label' => esc_html__( 'Email', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'lease@prismpm.ca', 'elementor-addon' ),
			]
		);

        $this->add_control(
			'address',
			[
				'label' => esc_html__( 'Address', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( '442 George St N. Peterborough, ON, K9H 3R7', 'elementor-addon' ),
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
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        
        $this->add_control(
			'social_links_list',
			[
				'label' => esc_html__( 'Social Links', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[ 'social_icon' => [ 'value' => 'fab fa-instagram', 'library' => 'fa-brands' ] ],
                    [ 'social_icon' => [ 'value' => 'fab fa-facebook-f', 'library' => 'fa-brands' ] ],
                    [ 'social_icon' => [ 'value' => 'fab fa-youtube', 'library' => 'fa-brands' ] ],
                    [ 'social_icon' => [ 'value' => 'fab fa-linkedin-in', 'library' => 'fa-brands' ] ],
				],
				'title_field' => '{{{ social_icon.value }}}',
			]
		);

        $this->end_controls_section();

        // Section: Form & Map
        $this->start_controls_section(
            'section_integrations',
            [
                'label' => esc_html__('Form & Map', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'form_shortcode',
			[
				'label' => esc_html__( 'WPForms Shortcode', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
				'placeholder' => esc_html__( '[wpforms id="123"]', 'elementor-addon' ),
                'description' => esc_html__( 'Enter the shortcode for your WPForms form.', 'elementor-addon' ),
			]
		);

        $this->add_control(
			'map_iframe',
			[
				'label' => esc_html__( 'Google Maps Iframe', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
				'placeholder' => esc_html__( '<iframe src="..."></iframe>', 'elementor-addon' ),
                'description' => esc_html__( 'Go to Google Maps, find a location, click "Share", then "Embed a map", and copy the HTML.', 'elementor-addon' ),
			]
		);

        $this->end_controls_section();
    }

    // Render Widget Output
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        ?>
        <style>
            .contactFormMap-<?php echo esc_attr($widget_id); ?> {
                font-family: sans-serif;
                color: #333;
            }
            .contactFormMap-<?php echo esc_attr($widget_id); ?> .contact-wrapper {
                display: flex;
                gap: 50px;
                margin-bottom: 50px;
            }
            .contactFormMap-<?php echo esc_attr($widget_id); ?> .contact-info-col,
            .contactFormMap-<?php echo esc_attr($widget_id); ?> .contact-form-col {
                flex: 1;
            }
            .contactFormMap-<?php echo esc_attr($widget_id); ?> .main-title {
                font-family: "Serif", "Times New Roman", serif;
                font-size: 3rem;
                font-weight: normal;
                margin: 0 0 15px 0;
            }
            .contactFormMap-<?php echo esc_attr($widget_id); ?> .description {
                color: #555;
                line-height: 1.6;
                margin-bottom: 40px;
                max-width: 450px;
            }
            .contactFormMap-<?php echo esc_attr($widget_id); ?> .contact-details-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 30px;
                margin-bottom: 40px;
            }
            .contactFormMap-<?php echo esc_attr($widget_id); ?> .detail-item h4 {
                margin: 0 0 5px 0;
                font-size: 0.9rem;
                color: #777;
            }
            .contactFormMap-<?php echo esc_attr($widget_id); ?> .detail-item p {
                margin: 0;
                line-height: 1.5;
            }
            .contactFormMap-<?php echo esc_attr($widget_id); ?> .social-media h4 {
                 margin: 0 0 10px 0;
                font-size: 0.9rem;
                color: #777;
            }
            .contactFormMap-<?php echo esc_attr($widget_id); ?> .social-icons {
                display: flex;
                gap: 15px;
            }
            .contactFormMap-<?php echo esc_attr($widget_id); ?> .social-icon-link {
                color: #333;
                font-size: 1.2rem;
                transition: color 0.3s;
            }
            .contactFormMap-<?php echo esc_attr($widget_id); ?> .social-icon-link:hover {
                color: #000;
            }
             .contactFormMap-<?php echo esc_attr($widget_id); ?> .map-container {
                width: 100%;
                filter: grayscale(1) opacity(0.8);
             }
             .contactFormMap-<?php echo esc_attr($widget_id); ?> .map-container iframe {
                width: 100%;
                height: 450px;
                border: 0;
             }
        </style>

        <div id="contactFormMap-<?php echo esc_attr($widget_id); ?>" class="contactFormMap contactFormMap-<?php echo esc_attr($widget_id); ?>">
            <div class="contact-wrapper">
                <div class="contact-info-col">
                    <h2 class="main-title"><?php echo esc_html($settings['title']); ?></h2>
                    <p class="description"><?php echo esc_html($settings['description']); ?></p>

                    <div class="contact-details-grid">
                        <div class="detail-item"><h4>Phone</h4><p><?php echo esc_html($settings['phone']); ?></p></div>
                        <div class="detail-item"><h4>Email</h4><p><?php echo esc_html($settings['email']); ?></p></div>
                        <div class="detail-item"><h4>Address</h4><p><?php echo nl2br(esc_html($settings['address'])); ?></p></div>
                    </div>

                    <?php if (!empty($settings['social_links_list'])) : ?>
                    <div class="social-media">
                        <h4>Social Media</h4>
                        <div class="social-icons">
                            <?php foreach ($settings['social_links_list'] as $item) : ?>
                                <a href="<?php echo esc_url($item['social_link']['url']); ?>" class="social-icon-link" <?php if($item['social_link']['is_external']) { echo 'target="_blank"'; } ?>>
                                    <?php \Elementor\Icons_Manager::render_icon($item['social_icon'], ['aria-hidden' => 'true']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="contact-form-col">
                    <?php 
                    if (!empty($settings['form_shortcode'])) {
                        echo do_shortcode($settings['form_shortcode']);
                    }
                    ?>
                </div>
            </div>

            <?php if (!empty($settings['map_iframe'])) : ?>
            <div class="map-container">
                <?php echo $settings['map_iframe']; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php
    }
}
