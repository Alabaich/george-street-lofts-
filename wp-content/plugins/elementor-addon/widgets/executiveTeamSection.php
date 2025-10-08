<?php

class Elementor_ExecutiveTeamSection extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'executiveTeamSection';
    }

    public function get_title()
    {
        return esc_html__('Executive Team Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-person';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['team', 'executive', 'people', 'card'];
    }

    protected function register_controls()
    {

        // Content Tab - Section Header
        $this->start_controls_section(
            'section_header',
            [
                'label' => esc_html__('Section Header', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Executive Team', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'main_subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Celebrating excellence in development and community building.', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        // Content Tab - Team Members Repeater
        $this->start_controls_section(
            'section_team_members',
            [
                'label' => esc_html__('Team Members', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'member_image',
            [
                'label' => esc_html__('Photo', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'member_name',
            [
                'label' => esc_html__('Name', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('New Team Member', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'member_title',
            [
                'label' => esc_html__('Title/Position', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Position', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'member_description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 3,
                'default' => esc_html__('Leads the company with a vision to blend heritage architecture with modern urban design.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'team_list',
            [
                'label' => esc_html__('Team Members List', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['member_name' => 'Hans Jain', 'member_title' => 'President of ATG Development'],
                    ['member_name' => 'Vipin Jain', 'member_title' => 'Vice President of ATG Development'],
                    ['member_name' => 'Hitesh Gajiwala', 'member_title' => 'Executive Vice President of Development & Construction'],
                ],
                'title_field' => '{{{ member_name }}}',
            ]
        );

        $this->end_controls_section();

        // Style Tab - Header Styling
        $this->start_controls_section(
            'section_header_style',
            [
                'label' => esc_html__('Header Style', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'main_title_color',
            [
                'label' => esc_html__('Title Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-main-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'main_title_typography',
                'selector' => '{{WRAPPER}} .team-main-title',
            ]
        );

        $this->add_control(
            'main_subtitle_color',
            [
                'label' => esc_html__('Subtitle Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-main-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - Member Card Styling
        $this->start_controls_section(
            'section_card_style',
            [
                'label' => esc_html__('Member Card Style', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'member_name_color',
            [
                'label' => esc_html__('Name Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-member-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'member_name_typography',
                'selector' => '{{WRAPPER}} .team-member-name',
            ]
        );

        $this->add_control(
            'member_title_color',
            [
                'label' => esc_html__('Title Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-member-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'member_description_color',
            [
                'label' => esc_html__('Description Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-member-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['team_list'])) {
            return;
        }
?>
        <style>
            .executive-team-container {
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 50px;
            }

            .executive-team-container .textContainer {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .team-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 30px;
                margin-top: 30px;
            }

            .team-member-card {
                text-align: left;
            }

            .member-image-wrap {
                width: 100%;
                aspect-ratio: 1 / 1;
                overflow: hidden;
                border-radius: 4px;
                margin-bottom: 20px;
            }

            .member-image-wrap img {
                width: 100%;
                height: 100%;
                display: block;
                object-fit: cover;
            }

            .team-member-name {
                color: var(--Black, #32302F);
                text-align: center;
                font-family: Arial, sans-serif;
                font-size: 32px;
                font-style: normal;
                font-weight: 500;
                line-height: 110%;
                letter-spacing: -0.32px;
                text-transform: capitalize;
                text-align: left;
            }

            .team-member-title {
                color: var(--Black, #32302F);
                font-family: Arial;
                font-size: 14px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
                letter-spacing: 0.14px;
            }

            .team-member-description {
                color: var(--Color-Grey, #9E9E9E);
                font-family: Arial;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
            }

            @media (max-width: 992px) {
                .team-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 576px) {
                .team-grid {
                    grid-template-columns: 1fr;
                    gap: 40px;
                }
            }
        </style>

        <div class="executive-team-container pageWidth">
            <div class="team-header">
                <h2><?php echo esc_html($settings['main_title']); ?></h2>
                <p class="text"><?php echo esc_html($settings['main_subtitle']); ?></p>
            </div>

            <div class="team-grid">
                <?php
                foreach ($settings['team_list'] as $item) :
                ?>
                    <div class="team-member-card">
                        <div class="member-image-wrap">
                            <?php if ($item['member_image']['url']) : ?>
                                <img src="<?php echo esc_url($item['member_image']['url']); ?>" alt="<?php echo esc_attr($item['member_name']); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="textContainer">
                            <h3 class="team-member-name"><?php echo esc_html($item['member_name']); ?></h3>
                            <p class="team-member-title"><?php echo esc_html($item['member_title']); ?></p>
                            <p class="team-member-description"><?php echo esc_html($item['member_description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }
}
