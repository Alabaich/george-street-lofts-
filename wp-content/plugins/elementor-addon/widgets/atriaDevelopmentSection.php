<?php

class Elementor_AtriaDevelopmentSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'AtriaDevelopmentSection';
    }

    public function get_title()
    {
        return esc_html__('Atria Development Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-posts-carousel';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['atria', 'development', 'carousel', 'properties'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'atria_content_section',
            [
                'label' => esc_html__('Section Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'atria_logo',
            [
                'label' => esc_html__('Logo Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
            ]
        );

        $this->add_control(
            'atria_main_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Creating Developments That Matter To The Communities They Call Home.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'atria_main_description',
            [
                'label' => esc_html__('Main Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Atria Development Corp. has been building remarkable properties since 2000. Through vision, persistence, and development acumen, Atria has grown to become a recognized leader in the creation of purpose-built rental communities. As a multi-generational, family owned business, we take great pride in bringing innovative design, superior quality, and life enhancing features and amenities to the market.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'atria_email',
            [
                'label' => esc_html__('Email Address', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'lease@pelssppl.ca',
            ]
        );

        $this->add_control(
            'atria_phone',
            [
                'label' => esc_html__('Phone Number', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '289-797-1604',
            ]
        );

        $this->add_control(
            'atria_footer_button_text',
            [
                'label' => esc_html__('Footer Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Visit Website', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'atria_footer_button_url',
            [
                'label' => esc_html__('Footer Button URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => ['url' => '#'],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'atria_slides_section',
            [
                'label' => esc_html__('Property Slides', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'atria_slide_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => 'https://placehold.co/400x400/806450/FFF'],
            ]
        );

        $repeater->add_control(
            'atria_slide_title',
            [
                'label' => esc_html__('Property Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('New Property Name', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'atria_slide_button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Details', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'atria_slide_button_url',
            [
                'label' => esc_html__('Button URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-property-link.com', 'elementor-addon'),
                'default' => ['url' => 'https://your-property-link.com'],
            ]
        );

        $this->add_control(
            'atria_slides',
            [
                'label' => esc_html__('Slides', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'atria_slide_title' => '80 Bond, Oshawa',
                        'atria_slide_button_url' => ['url' => 'https://example.com/80-bond'],
                        'atria_slide_button_text' => 'Learn More',
                    ],
                    [
                        'atria_slide_title' => 'YLofts, Peterborough',
                        'atria_slide_button_url' => ['url' => 'https://example.com/ylofts'],
                        'atria_slide_button_text' => 'See Project',
                    ],
                    [
                        'atria_slide_title' => '100 Bond, Oshawa',
                        'atria_slide_button_url' => ['url' => 'https://example.com/100-bond'],
                        'atria_slide_button_text' => 'View Property',
                    ],
                ],
                'title_field' => '{{{ atria_slide_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $slides = $settings['atria_slides'];
        $slide_count = count($slides);
        $widget_id = $this->get_id();

?>
        <style>
            .atria-section {
                background-color: #4D4337;
                padding: 50px 0;
                color: #FFFFFF;
                font-family: "Open Sans", sans-serif;
            }

            .atria-section .atria-container {
                display: flex;
                flex-direction: column;
                gap: 50px;
            }

            .atria-header-content {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 50px;
            }

            .atria-logo-wrapper {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                max-width: 250px;
            }

            .atria-logo {
                max-width: 120px;
                height: auto;
            }

            .atria-contact-info {
                display: flex;
                flex-direction: column;
                margin-top: 20px;
                gap: 10px;
            }

            .atria-contact-info p {
                display: flex;
                align-items: center;
                gap: 10px;
                margin: 0;
                font-family: "Cormorant", serif;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
            }

            .atria-title-wrapper {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .atria-title-wrapper h2 {
                color: #fff;
                text-align: left;
            }

            .atria-title-wrapper p {
                color: #fff;
                text-align: left;
                margin: 0;
            }

            .atria-slides-wrapper-<?php echo esc_attr($widget_id); ?> {
                display: flex;
                overflow-x: scroll;
                -webkit-overflow-scrolling: touch;
                cursor: grab;
                user-select: none;
            }

            .atria-slides-wrapper-<?php echo esc_attr($widget_id); ?>.is-dragging {
                cursor: grabbing;
            }

            .atria-slides-wrapper-<?php echo esc_attr($widget_id); ?>::-webkit-scrollbar {
                display: none;
            }

            .atria-slides-wrapper-<?php echo esc_attr($widget_id); ?> {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }

            .atria-slide-track {
                display: flex;
            }

            .atria-slide {
                flex-shrink: 0;
                width: calc((100% - 50px) / 3);
                margin-right: 25px;
                position: relative;
                border-radius: 5px;
                overflow: hidden;
            }

            .atria-slide:last-child {
                margin-right: 0;
            }

            .atria-slide-image {
                width: 100%;
                height: 400px !important;
                object-fit: cover;
                display: block;
            }

            .atria-slide-footer {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                padding: 15px;
                background: linear-gradient(to top, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0));
                display: flex;
                justify-content: space-between;
                align-items: flex-end;
            }

            .atria-slide-title {
                font-size: 18px;
                font-weight: bold;
                margin: 0;
                line-height: 1.2;
                color: #fff;
                text-align: left;
            }

            .atria-slide-button:hover {
                background-color: transparent !important;
                color: #fff !important;
                border-color: #fff !important;
            }

            .atria-carousel-nav-<?php echo esc_attr($widget_id); ?> {
                display: flex;
                justify-content: center;
                margin-top: 30px;
                gap: 10px;
            }

            .atria-dot {
                width: 8px;
                height: 8px;
                background-color: #6C6258;
                border-radius: 50%;
                cursor: pointer;
                transition: background-color 0.3s, transform 0.3s;
            }

            .atria-dot.active {
                background-color: #FFFFFF;
                transform: scale(1.2);
            }

            .atria-footer-button-wrapper {
                text-align: center;
                justify-content: center;
                display: flex;
            }

            .atria-footer-button {
                width: fit-content;
                color: #fff !important;
            }

            .atria-footer-button:hover {
                opacity: 0.9;
                color: #2c2d2c !important;
            }

            @media (max-width: 992px) {
                .atria-header-content {
                    grid-template-columns: 1fr;
                    gap: 30px;
                }

                .atria-logo-wrapper {
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                    max-width: none;
                }

                .atria-contact-info {
                    flex-direction: row;
                    gap: 20px;
                    margin-top: 0;
                }

                .atria-slides-wrapper-<?php echo esc_attr($widget_id); ?> {
                    padding-bottom: 20px;
                }

                .atria-slide {
                    width: calc(100% - 25px);
                    max-width: 400px;
                }
            }

            @media (max-width: 576px) {
                .atria-section {
                    padding: 30px 0;
                }

                .atria-container {
                    padding: 0 15px;
                }

                .atria-header-content {
                    gap: 30px;
                }

                .atria-logo-wrapper {
                    flex-direction: column;
                    align-items: center;
                    max-width: none;
                }

                .atria-logo {
                    margin-bottom: 15px;
                }

                .atria-contact-info {
                    flex-direction: column;
                    align-items: center;
                    gap: 5px;
                    margin-top: 0;
                }

                .atria-title-wrapper {
                    text-align: center;
                    align-items: center;
                }

                .atria-title-wrapper h2 {
                    font-size: 24px;
                    text-align: center;
                }

                .atria-title-wrapper p {
                    font-size: 14px;
                    text-align: center;
                }

                .atria-slide {
                    width: calc(100% - 20px);
                    margin-right: 20px;
                }

                .atria-slides-wrapper-<?php echo esc_attr($widget_id); ?> {
                    margin: 0 -15px;
                    padding: 0 15px 20px 15px;
                }
            }
        </style>

        <div class="atria-section">
            <div class="atria-container pageWidth">
                <div class="atria-header-content">
                    <div class="atria-logo-wrapper">
                        <?php if ($settings['atria_logo']['url']) : ?>
                            <img src="<?php echo esc_url($settings['atria_logo']['url']); ?>" class="atria-logo" alt="Atria Development Logo">
                        <?php endif; ?>
                        <div class="atria-contact-info">
                            <?php if ($settings['atria_email']) : ?>
                                <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    <a href="mailto:<?php echo esc_attr($settings['atria_email']); ?>" style="color: #fff; text-decoration: none;"><?php echo esc_html($settings['atria_email']); ?></a>
                                </p>
                            <?php endif; ?>
                            <?php if ($settings['atria_phone']) : ?>
                                <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 16.92v3a2 2 2 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-5.32-5.32 19.79 19.79 0 0 1-3.07-8.63A2 2 0 0 1 3.08 2h3a2 2 0 0 1 2 1.72 17.5 17.5 0 0 0 .22 3.82 2 2 0 0 1-1.23 2.14l-1.39.75a17.9 17.9 0 0 0 8.01 8.01l.75-1.39a2 2 0 0 1 2.14-1.23 17.5 17.5 0 0 0 3.82.22 2 2 0 0 1 1.72 2v3z"></path>
                                    </svg>
                                    <a href="tel:<?php echo esc_attr($settings['atria_phone']); ?>" style="color: #fff; text-decoration: none;"><?php echo esc_html($settings['atria_phone']); ?></a>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="atria-title-wrapper">
                        <h2><?php echo esc_html($settings['atria_main_title']); ?></h2>
                        <p class="text"><?php echo esc_html($settings['atria_main_description']); ?></p>
                    </div>
                </div>

                <div class="atria-slides-wrapper atria-slides-wrapper-<?php echo esc_attr($widget_id); ?>">
                    <div class="atria-slide-track">
                        <?php foreach ($slides as $i => $slide) : ?>
                            <?php
                            $slide_title_with_break = str_replace(', ', ',<br>', esc_html($slide['atria_slide_title']));
                            ?>
                            <div class="atria-slide" data-slide-index="<?php echo $i; ?>">
                                <img src="<?php echo esc_url($slide['atria_slide_image']['url']); ?>" class="atria-slide-image" alt="<?php echo esc_attr($slide['atria_slide_title']); ?>">
                                <div class="atria-slide-footer">
                                    <p class="atria-slide-title"><?php echo $slide_title_with_break; ?></p>
                                    <?php
                                    $slide_button_url = $slide['atria_slide_button_url']['url'];
                                    $slide_button_text = $slide['atria_slide_button_text'];
                                    $is_external = $slide['atria_slide_button_url']['is_external'] ? '_blank' : '_self';
                                    ?>
                                    <?php if ($slide_button_url && $slide_button_text) : ?>
                                        <a href="<?php echo esc_url($slide_button_url); ?>" class="mainButton atria-slide-button" target="<?php echo $is_external; ?>">
                                            <?php echo esc_html($slide_button_text); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if ($slide_count > 0) : ?>
                    <div class="atria-carousel-nav atria-carousel-nav-<?php echo esc_attr($widget_id); ?>">
                        <?php for ($i = 0; $i < $slide_count; $i++) : ?>
                            <span class="atria-dot <?php echo $i === 0 ? 'active' : ''; ?>" data-slide-index="<?php echo $i; ?>"></span>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>

                <?php if ($settings['atria_footer_button_url']['url'] && $settings['atria_footer_button_text']) : ?>
                    <div class="atria-footer-button-wrapper">
                        <a href="<?php echo esc_url($settings['atria_footer_button_url']['url']); ?>" class="atria-footer-button secondaryButton" target="<?php echo $settings['atria_footer_button_url']['is_external'] ? '_blank' : '_self'; ?>">
                            <?php echo esc_html($settings['atria_footer_button_text']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const widgetId = '<?php echo esc_js($widget_id); ?>';
                const slidesWrapper = document.querySelector(`.atria-slides-wrapper-${widgetId}`);
                const dots = document.querySelectorAll(`.atria-carousel-nav-${widgetId} .atria-dot`);
                const slides = slidesWrapper ? slidesWrapper.querySelectorAll('.atria-slide') : [];

                if (slides.length === 0 || !slidesWrapper) return;

                let autoScrollInterval;
                const scrollTime = 2000;
                let isDragging = false;
                let dragStartX;
                let scrollStartX;

                function getScrollStep() {
                    if (slides.length > 0) {
                        const slide = slides[0];
                        const style = window.getComputedStyle(slide);
                        const marginRight = parseFloat(style.marginRight) || 0;
                        return slide.offsetWidth + marginRight;
                    }
                    return 0;
                }

                function updateDots() {
                    const scrollLeft = slidesWrapper.scrollLeft;
                    const scrollStep = getScrollStep();
                    let newIndex = 0;

                    if (scrollStep > 0) {
                        newIndex = Math.round(scrollLeft / scrollStep);
                    }

                    if (newIndex >= 0 && newIndex < slides.length) {
                        dots.forEach((dot, index) => {
                            dot.classList.remove('active');
                            if (index === newIndex) {
                                dot.classList.add('active');
                            }
                        });
                    }
                }

                function scrollToSlide(index) {
                    const scrollStep = getScrollStep();
                    slidesWrapper.scrollTo({
                        left: index * scrollStep,
                        behavior: 'smooth'
                    });
                }

                function startAutoScroll() {
                    clearInterval(autoScrollInterval);

                    autoScrollInterval = setInterval(() => {
                        const scrollStep = getScrollStep();
                        let currentScrollIndex = 0;
                        if (scrollStep > 0) {
                            currentScrollIndex = Math.round(slidesWrapper.scrollLeft / scrollStep);
                        }

                        let nextIndex = currentScrollIndex + 1;
                        if (nextIndex >= slides.length) {
                            nextIndex = 0;
                        }

                        slidesWrapper.scrollTo({
                            left: nextIndex * scrollStep,
                            behavior: 'smooth'
                        });
                    }, scrollTime);
                }

                function stopAutoScroll() {
                    clearInterval(autoScrollInterval);
                }

                startAutoScroll();

                slidesWrapper.addEventListener('mouseenter', stopAutoScroll);
                slidesWrapper.addEventListener('mouseleave', startAutoScroll);

                slidesWrapper.addEventListener('mousedown', (e) => {
                    isDragging = true;
                    slidesWrapper.classList.add('is-dragging');
                    dragStartX = e.pageX - slidesWrapper.offsetLeft;
                    scrollStartX = slidesWrapper.scrollLeft;
                    stopAutoScroll();
                });

                slidesWrapper.addEventListener('mouseleave', () => {
                    if (isDragging) {
                        isDragging = false;
                        slidesWrapper.classList.remove('is-dragging');
                    }
                });

                window.addEventListener('mouseup', () => {
                    if (isDragging) {
                        isDragging = false;
                        slidesWrapper.classList.remove('is-dragging');
                        updateDots();
                        startAutoScroll();
                    }
                });

                slidesWrapper.addEventListener('mousemove', (e) => {
                    if (!isDragging) return;
                    e.preventDefault();
                    const x = e.pageX - slidesWrapper.offsetLeft;
                    const walk = (x - dragStartX) * 1.5;
                    slidesWrapper.scrollLeft = scrollStartX - walk;
                });

                slidesWrapper.addEventListener('scroll', updateDots);

                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        stopAutoScroll();
                        scrollToSlide(index);
                        startAutoScroll();
                    });
                });

                window.addEventListener('resize', () => {
                    updateDots();
                    stopAutoScroll();
                    setTimeout(startAutoScroll, 500);
                });
            });
        </script>
<?php
    }
}
