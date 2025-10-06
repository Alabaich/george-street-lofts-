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

        for ($i = 1; $i <= 8; $i++) {
            $this->add_control(
                'image_' . $i,
                [
                    'label' => esc_html__('Image ' . $i, 'elementor-addon'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => ['url' => 'https://placehold.co/400x500/A87F58/FFF'],
                ]
            );
        }

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Styling', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        
        $available_images = [];
        for ($i = 1; $i <= 8; $i++) {
            $image_key = 'image_' . $i;
            if (!empty($settings[$image_key]['url'])) {
                $available_images[] = $settings[$image_key]['url'];
            }
        }
        
        while (count($available_images) < 4) {
            $available_images[] = 'https://placehold.co/400x500/A87F58/FFF';
        }
        
        $unique_images = array_unique($available_images);
        shuffle($unique_images);
        $initial_images = array_slice($unique_images, 0, 4);

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

            .gallery-item {
                position: relative;
                width: 100%;
                border-radius: 0.75rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                overflow: hidden;
            }

            @media (min-width: 768px) {
                .gallery-item:nth-child(1),
                .gallery-item:nth-child(4) {
                    height: 400px;
                }
                .gallery-item:nth-child(2),
                .gallery-item:nth-child(3) {
                    height: 370px;
                }
            }

            .gallery-image {
                width: 100%;
                height: 100% !important;
                object-fit: cover;
                object-position: center;
                transition: opacity 0.5s ease-in-out;
            }

            .gallery-image.faded {
                opacity: 0;
            }

            @media (max-width: 767px) {
                .gallery-item {
                    height: 250px;
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
                <?php for ($i = 0; $i < 4; $i++): ?>
                    <div class="gallery-item">
                        <img class="gallery-image" src="<?php echo esc_url($initial_images[$i] ?? 'https://placehold.co/400x500/A87F58/FFF'); ?>" alt="Gallery Image <?php echo $i + 1; ?>">
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const images = document.querySelectorAll('#image-gallery .gallery-image');
                
                const allImagesPool = [
                    <?php foreach ($available_images as $image_url): ?>
                        "<?php echo esc_url($image_url); ?>",
                    <?php endforeach; ?>
                ];
                
                let currentImageURLs = Array.from(images).map(img => img.src);
                let imageIndexToUpdate = 0;

                function getNonRepeatingRandomImage(currentURLs) {
                    let availablePool = allImagesPool.filter(url => !currentURLs.includes(url));
                    
                    if (availablePool.length === 0) {
                        availablePool = allImagesPool;
                    }
                    
                    const newImageURL = availablePool[Math.floor(Math.random() * availablePool.length)];
                    return newImageURL;
                }

                function changeSingleImage() {
                    if (images.length === 0) return;
                    
                    const imgToFade = images[imageIndexToUpdate];
                    
                    currentImageURLs = Array.from(images).map(img => img.src);
                    
                    const newImageURL = getNonRepeatingRandomImage(currentImageURLs);

                    imgToFade.classList.add('faded');

                    setTimeout(() => {
                        imgToFade.src = newImageURL;
                        imgToFade.classList.remove('faded');
                        
                        imageIndexToUpdate = (imageIndexToUpdate + 1) % 4;
                    }, 500);
                }
                
                if (allImagesPool.length > 4) {
                    setInterval(changeSingleImage, 3000);
                }
            });
        </script>
<?php
    }
}