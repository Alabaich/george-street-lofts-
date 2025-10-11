<?php

class Elementor_GalleryGrid extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'galleryGrid';
    }

    public function get_title()
    {
        return esc_html__('Gallery Grid', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-gallery-justified';
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
                'label' => esc_html__('General', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'upper_title',
            [
                'label' => esc_html__('Upper Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Outdoor Spaces', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Thoughtfully Restored Outdoor Spaces', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_gallery_images',
            [
                'label' => esc_html__('Gallery Images', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'gallery_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'gallery_images_list',
            [
                'label' => esc_html__('Images', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [], [], [], [], [], [],
                ],
                'title_field' => '{{{ gallery_image.url ? "Image Populated" : "Empty Image" }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        $images = $settings['gallery_images_list'];
        ?>
        <style>
            .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> {
                font-family: sans-serif;
                text-align: center;
            }
            .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .gallery-header-upper-title {
                font-size: 0.9rem;
                color: #888;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                margin-bottom: 10px;
            }
            .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .gallery-header-title {
                font-weight: normal;
                margin: 0 auto 40px auto;
            }
            .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .gallery-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }
            .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .gallery-item-link {
                display: block;
                cursor: pointer;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            }
            .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .gallery-image {
                width: 100%;
                height: 250px;
                object-fit: cover;
                display: block;
                transition: transform 0.4s ease;
            }
            .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .gallery-item-link:hover .gallery-image {
                transform: scale(1.05);
            }

            @media (max-width: 767px) {
                .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .gallery-header-title {
                    margin: 0 auto 25px auto;
                }
                .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .gallery-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 8px;
                }
                .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .gallery-image {
                    height: 180px;
                }
                .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .gallery-header-upper-title {
                    font-size: 0.8rem;
                    margin-bottom: 8px;
                }
            }

            @media (max-width: 480px) {
                .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .gallery-grid {
                    gap: 6px;
                }
                .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .gallery-image {
                    height: 150px;
                }
                .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .gallery-header-title {
                    margin: 0 auto 20px auto;
                }
            }

            .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .modal-lightbox {
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
            .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .modal-lightbox.active {
                opacity: 1;
                visibility: visible;
            }
            .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .modal-content {
                max-width: 90%;
                max-height: 90%;
            }
            .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .modal-image {
                width: auto;
                height: auto;
                max-width: 100%;
                max-height: 100%;
                border-radius: 8px;
            }
            .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .modal-close {
                position: absolute;
                top: 20px;
                right: 30px;
                font-size: 2.5rem;
                color: white;
                cursor: pointer;
                line-height: 1;
            }

            @media (max-width: 767px) {
                .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .modal-close {
                    top: 15px;
                    right: 20px;
                    font-size: 2rem;
                }
                .outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?> .modal-content {
                    max-width: 95%;
                    max-height: 95%;
                }
            }
        </style>

        <div id="outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?>" class="pageWidth outdoorSpacesGallery outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?>">
            <p class="gallery-header-upper-title"><?php echo esc_html($settings['upper_title']); ?></p>
            <h2 class="gallery-header-title"><?php echo esc_html($settings['title']); ?></h2>

            <?php if (!empty($images)) : ?>
            <div class="gallery-grid">
                <?php foreach ($images as $item) : ?>
                    <?php if (!empty($item['gallery_image']['url'])) : ?>
                        <a class="gallery-item-link" data-full-src="<?php echo esc_url($item['gallery_image']['url']); ?>">
                            <img src="<?php echo esc_url($item['gallery_image']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>" class="gallery-image">
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            
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
                const widget = document.querySelector('#outdoorSpacesGallery-<?php echo esc_attr($widget_id); ?>');
                if (!widget) return;

                const modal = widget.querySelector('.modal-lightbox');
                const modalImage = widget.querySelector('.modal-image');
                const closeModalBtn = widget.querySelector('.modal-close');
                const imageLinks = widget.querySelectorAll('.gallery-item-link');

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
                    setTimeout(() => {
                         modalImage.setAttribute('src', '');
                    }, 300);
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