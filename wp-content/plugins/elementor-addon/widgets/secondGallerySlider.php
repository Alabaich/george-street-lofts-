<?php

class Elementor_SecondGallerySlider extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'secondGallerySlider';
    }

    public function get_title()
    {
        return esc_html__('Indoor Spaces Slider', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
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
                'label' => esc_html__('Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'upper_title',
            [
                'label' => esc_html__('Upper Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Indoor Spaces', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Elegant Interiors With Modern Finishes', 'elementor-addon'),
            ]
        );
        
        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum was conceived as filler text, formatted in a certain way to enable the presentation.', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_images',
            [
                'label' => esc_html__('Slider Images', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'slider_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'slider_images_list',
            [
                'label' => esc_html__('Images', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [ [], [], [] ],
                'title_field' => '{{{ slider_image.url ? "Image Populated" : "Empty Image" }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        $slides = $settings['slider_images_list'];
        
        $svg_prev_arrow = '<svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.9301 18.9889C14.3369 19.3957 14.9964 19.3957 15.4032 18.9889C15.81 18.5822 15.81 17.9226 15.4032 17.5158L9.8898 12.0024L15.4032 6.48893C15.81 6.08213 15.81 5.42259 15.4032 5.01579C14.9964 4.60899 14.3369 4.60899 13.9301 5.01579L7.6801 11.2658C7.2733 11.6726 7.2733 12.3321 7.6801 12.7389L13.9301 18.9889Z" fill="currentColor" /></svg>';
        $svg_next_arrow = '<svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.15292 18.9889C8.74612 19.3957 8.08658 19.3957 7.67978 18.9889C7.27299 18.5822 7.27299 17.9226 7.67978 17.5158L13.1932 12.0024L7.67978 6.48893C7.27299 6.08213 7.27299 5.42259 7.67978 5.01579C8.08658 4.60899 8.74612 4.60899 9.15292 5.01579L15.4029 11.2658C15.8097 11.6726 15.8097 12.3321 15.4029 12.7389L9.15292 18.9889Z" fill="currentColor" /></svg>';
        ?>
        <style>
            .indoorSlider-<?php echo esc_attr($widget_id); ?> {
                font-family: sans-serif;
                display: flex;
                align-items: center;
                gap: 50px;
                overflow: hidden;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-content-col {
                flex-basis: 40%;
                flex-shrink: 0;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .content-upper-title {
                font-size: 0.9rem;
                color: #888;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                margin-bottom: 10px;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .content-title {
                margin: 0 0 20px 0;
                text-align: left;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .content-description {
                font-size: 1rem;
                color: #555;
                line-height: 1.6;
                margin-bottom: 30px;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-nav {
                display: flex;
                gap: 15px;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .nav-arrow {
                width: 48px;
                height: 48px;
                border-radius: 4px;
                border: 1px solid var(--Color-Grey, #9E9E9E);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s;
                color: #A87F58;
                background: #fff;
                text-decoration: none;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .nav-arrow svg path {
                fill: #2c2d2c;
                transition: fill 0.3s;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .nav-arrow:hover {
                background: #A87F58;
                color: #fff;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .nav-arrow:hover svg path {
                fill: #fff;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .nav-arrow:disabled {
                cursor: not-allowed;
                opacity: 0.5;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .nav-arrow:disabled:hover {
                background: #fff;
                color: #A87F58;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .nav-arrow:disabled:hover svg path {
                fill: #2c2d2c;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-image-col {
                flex-basis: 60%;
                overflow: hidden;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-track {
                display: flex;
                transition: transform 0.5s ease-in-out;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-slide {
                flex: 0 0 80%;
                margin-right: 20px;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slide-image-link {
                display: block;
                cursor: pointer;
                border-radius: 12px;
                overflow: hidden;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slide-image {
                width: 100%;
                height: 450px;
                object-fit: cover;
                display: block;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .modal-lightbox {
                position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                background-color: rgba(0,0,0,0.85); display: flex; justify-content: center;
                align-items: center; opacity: 0; visibility: hidden;
                transition: opacity 0.3s, visibility 0.3s; z-index: 9999;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .modal-lightbox.active { opacity: 1; visibility: visible; }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .modal-content { max-width: 90%; max-height: 90%; }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .modal-image { width: auto; height: auto; max-width: 100%; max-height: 100%; border-radius: 8px; }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .modal-close { position: absolute; top: 20px; right: 30px; font-size: 2.5rem; color: white; cursor: pointer; line-height: 1; }

            @media (max-width: 767px) {
                .indoorSlider-<?php echo esc_attr($widget_id); ?> {
                    flex-direction: column;
                    gap: 30px;
                }
                .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-content-col {
                    flex-basis: 100%;
                    text-align: center;
                }
                .indoorSlider-<?php echo esc_attr($widget_id); ?> .content-title {
                    text-align: center;
                }
                .indoorSlider-<?php echo esc_attr($widget_id); ?> .content-description {
                    text-align: center;
                }
                .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-nav {
                    justify-content: center;
                }
                .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-image-col {
                    flex-basis: 100%;
                    width: 100%;
                }
                .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-slide {
                    flex: 0 0 85%;
                    margin-right: 15px;
                }
                .indoorSlider-<?php echo esc_attr($widget_id); ?> .slide-image {
                    height: 300px;
                }
            }

            @media (max-width: 480px) {
                .indoorSlider-<?php echo esc_attr($widget_id); ?> {
                    gap: 20px;
                }
                .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-slide {
                    flex: 0 0 90%;
                    margin-right: 10px;
                }
                .indoorSlider-<?php echo esc_attr($widget_id); ?> .slide-image {
                    height: 250px;
                }
            }
        </style>

        <div id="indoorSlider-<?php echo esc_attr($widget_id); ?>" class="pageWidth indoorSlider indoorSlider-<?php echo esc_attr($widget_id); ?>">
            <div class="slider-content-col">
                <p class="content-upper-title"><?php echo esc_html($settings['upper_title']); ?></p>
                <h2 class="content-title"><?php echo wp_kses_post($settings['title']); ?></h2>
                <div class="content-description"><?php echo wp_kses_post($settings['description']); ?></div>
                <div class="slider-nav">
                    <button class="nav-arrow prev">
                        <?php echo $svg_prev_arrow; ?>
                    </button>
                    <button class="nav-arrow next">
                        <?php echo $svg_next_arrow; ?>
                    </button>
                </div>
            </div>

            <div class="slider-image-col">
                <?php if (!empty($slides)) : ?>
                <div class="slider-track">
                    <?php foreach ($slides as $item) : ?>
                        <?php if (!empty($item['slider_image']['url'])) : ?>
                            <div class="slider-slide">
                                <a class="slide-image-link" data-full-src="<?php echo esc_url($item['slider_image']['url']); ?>">
                                    <img src="<?php echo esc_url($item['slider_image']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>" class="slide-image">
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="modal-lightbox">
                <span class="modal-close">&times;</span>
                <div class="modal-content">
                    <img src="" alt="Full size view" class="modal-image">
                </div>
            </div>
        </div>

        <script>
            (function() {
                const widget = document.querySelector('#indoorSlider-<?php echo esc_attr($widget_id); ?>');
                if (!widget) return;

                const track = widget.querySelector('.slider-track');
                const slides = widget.querySelectorAll('.slider-slide');
                const nextBtn = widget.querySelector('.nav-arrow.next');
                const prevBtn = widget.querySelector('.nav-arrow.prev');
                const slideCount = slides.length;
                let currentIndex = 0;

                function updateSlider() {
                    const slideWidth = slides[0].offsetWidth;
                    const offset = currentIndex * (slideWidth + 20);
                    track.style.transform = `translateX(-${offset}px)`;
                    updateNav();
                }

                function updateNav() {
                    prevBtn.disabled = currentIndex === 0;
                    nextBtn.disabled = currentIndex >= slideCount - 1;
                }

                if (nextBtn && prevBtn && slideCount > 1) {
                    nextBtn.addEventListener('click', () => {
                        if (currentIndex < slideCount - 1) {
                            currentIndex++;
                            updateSlider();
                        }
                    });
                    prevBtn.addEventListener('click', () => {
                        if (currentIndex > 0) {
                            currentIndex--;
                            updateSlider();
                        }
                    });
                    updateNav();
                } else if (nextBtn && prevBtn) {
                    nextBtn.style.display = 'none';
                    prevBtn.style.display = 'none';
                }

                const modal = widget.querySelector('.modal-lightbox');
                const modalImage = widget.querySelector('.modal-image');
                const closeModalBtn = widget.querySelector('.modal-close');
                const imageLinks = widget.querySelectorAll('.slide-image-link');

                imageLinks.forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        const fullSrc = link.dataset.fullSrc;
                        if (fullSrc) {
                            modalImage.setAttribute('src', fullSrc);
                            modal.classList.add('active');
                        }
                    });
                });

                function closeModal() {
                    modal.classList.remove('active');
                    setTimeout(() => { modalImage.setAttribute('src', ''); }, 300);
                }

                closeModalBtn.addEventListener('click', closeModal);
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closeModal();
                    }
                });
            })();
        </script>
        <?php
    }
}