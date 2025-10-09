<?php

class Elementor_ScoreCircleWidget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'ScoreCircleWidget';
    }

    public function get_title()
    {
        return esc_html__('Animated Score Indicators', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-skill-bar';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['score', 'walk', 'bike', 'animation', 'circle', 'progress'];
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
            'main_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Now Is The Time. This Is The Place.', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_indicators',
            [
                'label' => esc_html__('Score Indicators', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'score_icon',
            [
                'label' => esc_html__('Icon', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'eicon-person',
                    'library' => 'elementor',
                ],
            ]
        );

        $repeater->add_control(
            'score_value',
            [
                'label' => esc_html__('Score Value (0-100)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 95,
                ],
            ]
        );

        $repeater->add_control(
            'score_label',
            [
                'label' => esc_html__('Label', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('walk score', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'indicators_list',
            [
                'label' => esc_html__('Indicator List', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'score_icon' => ['value' => 'eicon-walk', 'library' => 'elementor'],
                        'score_value' => ['unit' => 'px', 'size' => 95],
                        'score_label' => 'walk score',
                    ],
                    [
                        'score_icon' => ['value' => 'eicon-bike', 'library' => 'elementor'],
                        'score_value' => ['unit' => 'px', 'size' => 80],
                        'score_label' => 'bike score',
                    ],
                ],
                'title_field' => '{{{ score_label }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_footer_text',
            [
                'label' => esc_html__('Footer Text', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'footer_text',
            [
                'label' => esc_html__('Text Below Indicators', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('George Street Lofts is located in the heart of Peterborough, a city known for its vibrant community and rich history. Offering modern loft living with easy access to local shops, cafes, parks, and cultural attractions. George Street Lofts combines historic charm with contemporary comfort. Once a hub of industry and heritage architecture, Peterborough has evolved into a thriving city with growing sectors in education, arts, technology, and professional services. With new developments, diverse dining, and unique local experiences, the neighbourhood around George Street Lofts is one of the most desirable places to live.', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();

        $radius = 80;
        $circumference = 2 * M_PI * $radius;
        $svg_size = 180;
        $viewbox = "0 0 {$svg_size} {$svg_size}";
        $center = $svg_size / 2;

        if (empty($settings['indicators_list'])) {
            return;
        }
?>
        <style>
            .score-section-container-<?php echo esc_attr($widget_id); ?> {
                background-color: #4D4337;
                color: white;
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 50px;
            }

            .indicators-wrapper {
                display: flex;
                justify-content: center;
                gap: 50px;
                flex-wrap: wrap;
            }

            .score-indicator-wrap {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .score-circle {
                position: relative;
                width: 200px;
                height: 200px;
                margin-bottom: 10px;
            }

            .score-circle .circle-background,
            .score-circle .circle-progress {
                fill: none;
                stroke-width: 8;
            }

            .score-circle .circle-background {
                stroke: rgba(255, 255, 255, 0.2);
            }

            .score-circle .circle-progress {
                stroke: white;
                stroke-linecap: round;
                transition: stroke-dashoffset 2s ease-out;
                stroke-dasharray: <?php echo esc_attr($circumference); ?>;
                stroke-dashoffset: <?php echo esc_attr($circumference); ?>;
                transform-origin: 50% 50%;
                transform: rotate(-90deg);
            }

            .score-circle .icon-overlay {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 1.2em;
            }

            .score-circle .icon-overlay i {
                color: white;
            }

            .score-details-row {
                display: flex;
                align-items: baseline;
                justify-content: center;
                gap: 10px;
                margin-bottom: 5px;
            }

            .score-value {
                color: #FFF;
                text-align: center;
                font-family: "Cormorant", serif;
                font-size: 48px;
                font-style: normal;
                font-weight: 500;
                line-height: 110%;
                letter-spacing: -0.48px;
                text-transform: capitalize;
            }

            .score-label {
                color: #FFF;
                text-align: center;
                font-family: "Cormorant", serif;
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 130%;
                letter-spacing: -0.2px;
            }

            .animate .circle-progress {
                stroke-dashoffset: var(--dash-offset);
            }

            .score-footer-text {
                max-width: 800px;
                margin: 0 auto;
                color: #FFF;
                text-align: center;
                font-family: "Cormorant", serif;
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 130%;
                letter-spacing: -0.2px;
            }

            @media (max-width: 500px) {
                .indicators-wrapper {
                    flex-direction: column;
                    gap: 40px;
                }
            }
        </style>

        <div class="pageWidth score-section-container-<?php echo esc_attr($widget_id); ?>">
            <h2 style="color: #fff;">
                <?php echo esc_html($settings['main_title']); ?>
            </h2>

            <div class="indicators-wrapper" id="indicators-<?php echo esc_attr($widget_id); ?>">
                <?php
                foreach ($settings['indicators_list'] as $index => $item) :
                    $score_percent = $item['score_value']['size'];
                    $offset = $circumference * (1 - ($score_percent / 100));
                ?>
                    <div class="score-indicator-wrap">
                        <div class="score-circle">
                            <svg viewBox="<?php echo esc_attr($viewbox); ?>">
                                <circle class="circle-background" cx="<?php echo esc_attr($center); ?>" cy="<?php echo esc_attr($center); ?>" r="<?php echo esc_attr($radius); ?>"></circle>
                                <circle class="circle-progress" cx="<?php echo esc_attr($center); ?>" cy="<?php echo esc_attr($center); ?>" r="<?php echo esc_attr($radius); ?>"
                                    data-offset="<?php echo esc_attr($offset); ?>"></circle>
                            </svg>
                            <div class="icon-overlay">
                                <?php \Elementor\Icons_Manager::render_icon($item['score_icon'], ['aria-hidden' => 'true']); ?>
                            </div>
                        </div>

                        <div class="score-details-row">
                            <div class="score-value">
                                <?php echo esc_html($score_percent); ?>
                            </div>
                            <div class="score-label">
                                <?php echo esc_html($item['score_label']); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="score-footer-text">
                <?php echo esc_html($settings['footer_text']); ?>
            </div>
        </div>

        <script>
            (function() {
                var widgetContainer = document.getElementById('indicators-<?php echo esc_attr($widget_id); ?>');
                if (!widgetContainer) return;

                var observer = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate');

                            var progressCircles = entry.target.querySelectorAll('.circle-progress');
                            progressCircles.forEach(function(circle) {
                                var offset = circle.getAttribute('data-offset');
                                circle.style.setProperty('--dash-offset', offset + 'px');
                            });

                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.5
                });

                observer.observe(widgetContainer);
            })();
        </script>
<?php
    }
}
