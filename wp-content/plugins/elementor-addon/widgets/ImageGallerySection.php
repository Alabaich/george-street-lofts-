<?php

class Elementor_ImageGallerySection extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'ImageGallerySection';
    }

    public function get_title()
    {
        return esc_html__('Image Gallery Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-photo-gallery';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['gallery', 'images', 'section', 'intro'];
    }

    protected function register_controls()
    {
        // Content Tab Start
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
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Experience George Street Lofts', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Downtown Peterborough rental lofts inside a reimagined 1879 landmark.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'button_1_text',
            [
                'label' => esc_html__('Button 1 Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Discover George Street Lofts', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'button_1_url',
            [
                'label' => esc_html__('Button 1 URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'button_2_text',
            [
                'label' => esc_html__('Button 2 Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Contact us', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'button_2_url',
            [
                'label' => esc_html__('Button 2 URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'image_1',
            [
                'label' => esc_html__('Image 1', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => 'https://placehold.co/400x500/A87F58/FFF'],
            ]
        );

        $this->add_control(
            'image_2',
            [
                'label' => esc_html__('Image 2', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => 'https://placehold.co/400x500/A87F58/FFF'],
            ]
        );

        $this->add_control(
            'image_3',
            [
                'label' => esc_html__('Image 3', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => 'https://placehold.co/400x500/A87F58/FFF'],
            ]
        );

        $this->add_control(
            'image_4',
            [
                'label' => esc_html__('Image 4', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => 'https://placehold.co/400x500/A87F58/FFF'],
            ]
        );

        $this->end_controls_section();
        // End of Content Tab

        // Style Tab Start
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Styling', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();
        // End of Style Tab

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <style>
            .gsl-gallery-section {
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 50px;
            }

            .gsl-heading-wrapper {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 10px;
                max-width: 900px;
                margin: 0 auto;
                margin-bottom: 2px;
            }

            .button-wrapper {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 1rem;
            }

            @media (min-width: 640px) {
                .button-wrapper {
                    flex-direction: row;
                }
            }

            .gallery {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            @media (min-width: 768px) {
                .gallery {
                    grid-template-columns: repeat(4, 1fr);
                    gap: 1rem;
                    align-items: end;
                }
            }

            .gallery img {
                width: 100%;
                height: auto;
                border-radius: 0.75rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                object-fit: cover;
                transition: opacity 0.5s ease-in-out;
            }

            .gallery img.faded {
                opacity: 0;
            }

            @media (min-width: 768px) {

                .gallery img:nth-child(2),
                .gallery img:nth-child(3) {
                    height: calc(100% - 15px);
                }
            }
        </style>

        <div class="gsl-gallery-section pageWidth">
            <div class="gsl-heading-wrapper">
                <h1><?php echo esc_html($settings['title']); ?></h1>
                <p class="text"><?php echo $settings['description']; ?></p>
                <div class="button-wrapper">
                    <?php if ($settings['button_1_text'] && $settings['button_1_url']['url']) : ?>
                        <a href="<?php echo esc_url($settings['button_1_url']['url']); ?>"
                            class="mainButton">
                            <?php echo esc_html($settings['button_1_text']); ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($settings['button_2_text'] && $settings['button_2_url']['url']) : ?>
                        <a href="<?php echo esc_url($settings['button_2_url']['url']); ?>"
                            class="secondaryButton">
                            <?php echo esc_html($settings['button_2_text']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="gallery" id="image-gallery">
                <img class="gallery-image" src="<?php echo esc_url($settings['image_1']['url']); ?>" alt="Gallery Image 1">
                <img class="gallery-image" src="<?php echo esc_url($settings['image_2']['url']); ?>" alt="Gallery Image 2">
                <img class="gallery-image" src="<?php echo esc_url($settings['image_3']['url']); ?>" alt="Gallery Image 3">
                <img class="gallery-image" src="<?php echo esc_url($settings['image_4']['url']); ?>" alt="Gallery Image 4">
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const images = document.querySelectorAll('#image-gallery .gallery-image');
                let sources = Array.from(images).map(img => img.src);
                const order = [3, 1, 0, 2];

                function changeImages() {
                    sources.unshift(sources.pop());

                    order.forEach((imgIndex, i) => {
                        setTimeout(() => {
                            images[imgIndex].classList.add('faded');
                            setTimeout(() => {
                                images[imgIndex].src = sources[imgIndex];
                                images[imgIndex].classList.remove('faded');
                            }, 500);
                        }, i * 1000);
                    });
                }

                changeImages();

                setInterval(changeImages, 5000);
            });
        </script>
<?php
    }
}
