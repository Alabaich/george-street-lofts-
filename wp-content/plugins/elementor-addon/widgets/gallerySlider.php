<?php

class Elementor_GallerySlider extends \Elementor\Widget_Base
{

    // Widget Name
    public function get_name()
    {
        return 'gallerySlider';
    }

    // Widget Title
    public function get_title()
    {
        return esc_html__('Gallery Slider', 'elementor-addon');
    }

    // Widget Icon
    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    // Widget Categories
    public function get_categories()
    {
        return ['basic'];
    }

    // Register Widget Controls
    protected function register_controls()
    {
        // Section: General Titles
        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'upper_title',
            [
                'label' => esc_html__('Upper Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('City Life', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Live In The Heart Of Peterborough', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Section: Repeater Cards
        $this->start_controls_section(
            'section_cards',
            [
                'label' => esc_html__('Gallery Cards', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'card_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'card_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Millennium Park', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'card_description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('A scenic riverside park with walking trails, summer festivals, and live events.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'gallery_list',
            [
                'label' => esc_html__('Cards', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['card_title' => esc_html__('Millennium Park', 'elementor-addon')],
                    ['card_title' => esc_html__('Otonabee River', 'elementor-addon')],
                    ['card_title' => esc_html__('Beavermead Park', 'elementor-addon')],
                ],
                'title_field' => '{{{ card_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    // Render Widget Output
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        $cards = $settings['gallery_list'];
        ?>
        <style>
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> {
                font-family: sans-serif;
                text-align: center;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .gallery-header-upper-title {
                font-size: 0.9rem;
                color: #888;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                margin-bottom: 10px;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .gallery-header-title {
                font-family: "Serif", "Times New Roman", serif;
                font-size: 2.8rem;
                font-weight: normal;
                margin: 0 auto 40px auto;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .slider-container {
                position: relative;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .slider-viewport {
                overflow: hidden;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .slider-track {
                display: flex;
                transition: transform 0.5s ease-in-out;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .slider-card {
                flex: 0 0 33.333%;
                box-sizing: border-box;
                padding: 0 15px;
                text-align: left;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .card-image-link {
                display: block;
                cursor: pointer;
                border-radius: 12px;
                overflow: hidden;
                margin-bottom: 20px;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .card-image {
                width: 100%;
                height: 280px;
                object-fit: cover;
                display: block;
                transition: transform 0.4s ease;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .card-image-link:hover .card-image {
                transform: scale(1.05);
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .card-title {
                font-family: "Serif", "Times New Roman", serif;
                font-size: 1.5rem;
                font-weight: normal;
                margin: 0 0 10px 0;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .card-description {
                font-size: 1rem;
                color: #555;
                line-height: 1.6;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .slider-nav {
                display: flex;
                justify-content: center;
                gap: 10px;
                margin-top: 30px;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .slider-nav-button {
                background: #fff;
                border: 1px solid #ddd;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                cursor: pointer;
                transition: background-color 0.3s, border-color 0.3s;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .slider-nav-button.next { background-color: #c5a47e; border-color: #c5a47e;}
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .slider-nav-button.next svg path { fill: #fff; }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .slider-nav-button:disabled { cursor: not-allowed; opacity: 0.5; }

            /* Modal Styles */
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .modal-lightbox {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.85);
                display: flex;
                justify-content: center;
                align-items: center;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s, visibility 0.3s;
                z-index: 9999;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .modal-lightbox.active {
                opacity: 1;
                visibility: visible;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .modal-content {
                max-width: 90%;
                max-height: 90%;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .modal-image {
                width: auto;
                height: auto;
                max-width: 100%;
                max-height: 100%;
                border-radius: 8px;
            }
            .cityLifeGallery-<?php echo esc_attr($widget_id); ?> .modal-close {
                position: absolute;
                top: 20px;
                right: 30px;
                font-size: 2.5rem;
                color: white;
                cursor: pointer;
                line-height: 1;
            }
        </style>

        <div id="cityLifeGallery-<?php echo esc_attr($widget_id); ?>" class="cityLifeGallery cityLifeGallery-<?php echo esc_attr($widget_id); ?>">
            <p class="gallery-header-upper-title"><?php echo esc_html($settings['upper_title']); ?></p>
            <h2 class="gallery-header-title"><?php echo esc_html($settings['title']); ?></h2>

            <?php if (!empty($cards)) : ?>
            <div class="slider-container">
                <div class="slider-viewport">
                    <div class="slider-track">
                        <?php foreach ($cards as $item) : ?>
                            <div class="slider-card">
                                <?php if (!empty($item['card_image']['url'])) : ?>
                                    <a class="card-image-link" data-full-src="<?php echo esc_url($item['card_image']['url']); ?>">
                                        <img src="<?php echo esc_url($item['card_image']['url']); ?>" alt="<?php echo esc_attr($item['card_title']); ?>" class="card-image">
                                    </a>
                                <?php endif; ?>
                                <h3 class="card-title"><?php echo esc_html($item['card_title']); ?></h3>
                                <p class="card-description"><?php echo esc_html($item['card_description']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="slider-nav">
                <button class="slider-nav-button prev">&lt;</button>
                <div class="slider-dots"></div>
                <button class="slider-nav-button next">&gt;</button>
            </div>
            
            <!-- Modal HTML Structure -->
            <div class="modal-lightbox">
                <span class="modal-close">&times;</span>
                <div class="modal-content">
                    <img src="" alt="Full size view" class="modal-image">
                </div>
            </div>
            <?php endif; ?>
        </div>

        <script>
            (function() {
                const widget = document.querySelector('#cityLifeGallery-<?php echo esc_attr($widget_id); ?>');
                if (!widget) return;

                const track = widget.querySelector('.slider-track');
                const cards = widget.querySelectorAll('.slider-card');
                const nextBtn = widget.querySelector('.slider-nav .next');
                const prevBtn = widget.querySelector('.slider-nav .prev');
                const dotsContainer = widget.querySelector('.slider-dots');
                
                const cardCount = cards.length;
                const slidesPerPage = 3;
                let currentIndex = 0;

                // --- Slider Logic ---
                function updateSlider() {
                    const offset = currentIndex * (100 / slidesPerPage);
                    track.style.transform = `translateX(-${offset}%)`;
                    updateNav();
                }

                function updateNav() {
                    prevBtn.disabled = currentIndex === 0;
                    nextBtn.disabled = currentIndex >= cardCount - slidesPerPage;

                    // Dots update
                    if (dotsContainer) {
                        dotsContainer.innerHTML = '';
                        const numDots = Math.ceil(cardCount / slidesPerPage);
                        for (let i = 0; i < numDots; i++) {
                            const dot = document.createElement('span');
                            dot.classList.add('dot');
                            if (i === Math.floor(currentIndex / slidesPerPage)) {
                                dot.classList.add('active');
                            }
                            dotsContainer.appendChild(dot);
                        }
                    }
                }

                if (nextBtn && prevBtn) {
                    nextBtn.addEventListener('click', () => {
                        if (currentIndex < cardCount - slidesPerPage) {
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
                }

                // --- Modal Logic ---
                const modal = widget.querySelector('.modal-lightbox');
                const modalImage = widget.querySelector('.modal-image');
                const closeModalBtn = widget.querySelector('.modal-close');
                const imageLinks = widget.querySelectorAll('.card-image-link');

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
                    modalImage.setAttribute('src', ''); // Clear src to stop loading
                }

                closeModalBtn.addEventListener('click', closeModal);
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) { // Close only if clicking on the background
                        closeModal();
                    }
                });

                // Initial setup
                if (cardCount > slidesPerPage) {
                    updateNav();
                } else {
                    widget.querySelector('.slider-nav').style.display = 'none';
                }
            })();
        </script>
        <?php
    }
}
