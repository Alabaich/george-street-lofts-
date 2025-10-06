<?php

class Elementor_SecondGallerySlider extends \Elementor\Widget_Base
{

    // Widget Name
    public function get_name()
    {
        return 'secondGallerySlider';
    }

    // Widget Title
    public function get_title()
    {
        return esc_html__('Indoor Spaces Slider', 'elementor-addon');
    }

    // Widget Icon
    public function get_icon()
    {
        return 'eicon-slider-push';
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

        // Section: Repeater Images
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

    // Render Widget Output
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        $slides = $settings['slider_images_list'];
        ?>
        <style>
            .indoorSlider-<?php echo esc_attr($widget_id); ?> {
                font-family: sans-serif;
                display: flex;
                align-items: center;
                gap: 50px;
                overflow: hidden; /* Important for the cut-off effect */
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
                font-family: "Serif", "Times New Roman", serif;
                font-size: 2.8rem;
                font-weight: normal;
                line-height: 1.2;
                margin: 0 0 20px 0;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .content-description {
                font-size: 1rem;
                color: #555;
                line-height: 1.6;
                margin-bottom: 30px;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-nav {
                display: flex;
                gap: 10px;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-nav-button {
                background: #fff;
                border: 1px solid #ddd;
                border-radius: 8px;
                width: 45px;
                height: 45px;
                cursor: pointer;
                transition: background-color 0.3s, border-color 0.3s;
            }
             .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-nav-button.next {
                background-color: #c5a47e;
                border-color: #c5a47e;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-nav-button svg path {
                fill: #888;
                transition: fill 0.3s;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-nav-button.next svg path {
                fill: #fff;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-nav-button:disabled {
                cursor: not-allowed;
                border-color: #eee;
            }
             .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-nav-button:disabled svg path {
                fill: #ccc;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-image-col {
                flex-basis: 60%;
                overflow: hidden; /* Hides parts of slides outside this column */
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-track {
                display: flex;
                transition: transform 0.5s ease-in-out;
            }
            .indoorSlider-<?php echo esc_attr($widget_id); ?> .slider-slide {
                flex: 0 0 80%; /* Each slide takes 80% of the container width */
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
             /* Modal Styles - Scoped to this widget */
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
        </style>

        <div id="indoorSlider-<?php echo esc_attr($widget_id); ?>" class="indoorSlider indoorSlider-<?php echo esc_attr($widget_id); ?>">
            <div class="slider-content-col">
                <p class="content-upper-title"><?php echo esc_html($settings['upper_title']); ?></p>
                <h2 class="content-title"><?php echo wp_kses_post($settings['title']); ?></h2>
                <div class="content-description"><?php echo wp_kses_post($settings['description']); ?></div>
                <div class="slider-nav">
                     <button class="slider-nav-button prev"><svg width="8" height="14" viewBox="0 0 8 14" xmlns="http://www.w3.org/2000/svg"><path d="M7 13L1 7L7 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                    <button class="slider-nav-button next"><svg width="8" height="14" viewBox="0 0 8 14" xmlns="http://www.w3.org/2000/svg"><path d="M1 13L7 7L1 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
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
            
            <!-- Modal HTML Structure specific to this widget -->
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
                const nextBtn = widget.querySelector('.slider-nav .next');
                const prevBtn = widget.querySelector('.slider-nav .prev');
                const slideCount = slides.length;
                let currentIndex = 0;

                // --- Slider Logic ---
                function updateSlider() {
                    const slideWidth = slides[0].offsetWidth;
                    const offset = currentIndex * (slideWidth + 20); // 20 is the margin-right
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

                // --- Modal Logic ---
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
