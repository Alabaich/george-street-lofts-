<?php
if (! defined('ABSPATH')) {
    exit;
}

if (! hello_get_header_display()) {
    return;
}

$is_editor = isset($_GET['elementor-preview']);
$site_name = get_bloginfo('name');
$tagline   = get_bloginfo('description', 'display');
$header_class = did_action('elementor/loaded') ? hello_get_header_layout_class() : '';
$menu_args = [
    'theme_location' => 'menu-1',
    'fallback_cb' => false,
    'container' => 'div',
    'container_class' => 'menu-container',
    'echo' => false,
];
$header_nav_menu = wp_nav_menu($menu_args);
$header_mobile_nav_menu = wp_nav_menu($menu_args);
?>

<style>
    .headr {
        /* FIXED: Retained for mobile (needed for dropdown script to work as you implemented) */
        position: fixed; 
        top: 0;
        width: 100%;
        z-index: 1000;
        background: #fff;
        padding: 1rem 0;
        box-shadow: 0 1px 10px rgba(0, 0, 0, 0.05);
    }

    .headr-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 0 10%;
        box-sizing: border-box;
    }

    .headr-logo {
        display: flex;
        align-items: center;
        flex: 0 0 auto;
    }

    .site-logo {
        max-width: 120px;
        width: 100%;
        height: auto;
    }

    .site-logo img {
        width: 100%;
        height: auto;
        max-height: 40px;
        object-fit: contain;
    }

    .headr-nav {
        display: flex;
        gap: 2rem;
        flex: 0 0 auto;
    }

    .headr-nav a {
        color: var(--Black, #32302F);
        font-family: "Cormorant", serif;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%;
        text-decoration: none;
    }

    .headr-nav a:hover {
        color: rgba(77, 67, 55, 0.7);
    }

    .right-block {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .headr .btn {
        border-radius: 4px;
        border: 1.5px solid #A67131;
        display: flex;
        padding: 14px 24px;
        justify-content: center;
        align-items: center;
        gap: 10px;
        color: #A67131;
        background: transparent;
        text-decoration: none;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        font-weight: 400;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        transition: all 0.3s ease;
        flex: 0 0 auto;
    }

    .headr .btn:hover {
        background: #A67131;
        color: #fff;
    }

    .site-navigation-toggle-holder {
        display: none;
    }

    .site-navigation-toggle {
        background: none !important;
        border: none !important;
        padding: 0 !important;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        outline: none;
    }

    .site-navigation-toggle svg {
        width: 100%;
        height: 100%;
    }

    .site-navigation-toggle svg path {
        stroke: #4D4337;
        transition: all 0.3s ease;
        transform-origin: center;
    }

    /* Burger to X animation (YOUR PREFERRED VERSION) */
    .site-navigation-toggle[aria-expanded="true"] path:nth-child(1) {
        transform: translateY(6px) rotate(45deg);
    }

    .site-navigation-toggle[aria-expanded="true"] path:nth-child(2) {
        opacity: 0;
    }

    .site-navigation-toggle[aria-expanded="true"] path:nth-child(3) {
        transform: translateY(-3px) rotate(-45deg);
    }

    .site-navigation-dropdown {
        position: fixed;
        top: 64px;
        left: 0;
        right: 0;
        bottom: 0;
        background: #fff;
        z-index: 998;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        box-shadow: 0 8px 10px rgba(0, 0, 0, 0.05);
        padding: 0 10%;
    }

    .site-navigation-dropdown[aria-hidden="false"] {
        max-height: 100%;
        overflow-y: auto;
        padding-top: 20px;
        padding-bottom: 20px;
        margin: 0;
    }

    .site-navigation-dropdown ul.menu li a {
        font-family: "Cormorant", serif;
        font-size: 20px;
    }

    .site-navigation-dropdown ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .site-navigation-dropdown ul a {
        color: var(--Black, #32302F);
        font-family: "Cormorant", serif;
        font-size: 18px;
        font-weight: 500;
        display: block;
        padding: 8px 0;
        text-decoration: none;
    }

    /* --- PC FIX --- */
    @media (min-width: 1025px) {
        .headr {
            position: static !important; /* Убираем фиксацию для ПК */
        }
    }
    /* -------------- */

    @media (max-width: 1600px) {
        .headr-container {
            padding: 0 25px;
        }
    }

    @media (max-width: 1024px) {
        .headr {
            padding: 1.5rem 0;
        }

        .site-navigation-dropdown {
            top: 64px;
        }

        .headr-nav {
            display: none;
        }

        .site-logo {
            max-width: 100px;
        }

        .headr .btn {
            padding: 12px 20px;
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {
        .headr-container {
            padding: 0 15px;
        }

        .site-logo {
            max-width: 80px;
        }

        .headr {
            min-height: 56px;
            padding: 10px 0;
        }

        .site-navigation-dropdown {
            top: 56px;
            padding-left: 15px;
            padding-right: 15px;
        }

        .site-navigation-toggle-holder {
            display: block;
        }

        .headr .btn {
            padding: 10px 16px;
            font-size: 11px;
        }
    }

    @media (max-width: 480px) {
        .headr {
            padding: 8px 0;
        }

        .headr-container {
            padding: 0 10px;
        }

        .site-logo {
            max-width: 60px;
        }

        .headr .btn {
            padding: 8px 12px;
            font-size: 10px;
        }
    }
</style>

<header id="site-header" class="headr site-header dynamic-header <?php echo esc_attr($header_class); ?>">
    <div class="headr-container">
        <div class="headr-logo site-branding show-<?php echo esc_attr(hello_elementor_get_setting('hello_header_logo_type')); ?>">
            <?php if (has_custom_logo()) : ?>
                <div class="site-logo">
                    <?php the_custom_logo(); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($header_nav_menu) : ?>
            <nav class="site-navigation headr-nav" aria-label="<?php echo esc_attr__('Main menu', 'hello-elementor'); ?>">
                <?php echo $header_nav_menu; ?>
            </nav>
        <?php endif; ?>

        <div class="right-block">
            <a class="btn" href="#contact">
                Contact
            </a>

            <?php if ($header_mobile_nav_menu) : ?>
                <div class="site-navigation-toggle-holder">
                    <button type="button" class="site-navigation-toggle" aria-label="<?php echo esc_attr('Menu', 'hello-elementor'); ?>" aria-controls="mobile-menu-dropdown" aria-expanded="false">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M28 10H4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M28 16H4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M28 22H4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($header_mobile_nav_menu) : ?>
        <nav id="mobile-menu-dropdown" class="site-navigation-dropdown" aria-label="<?php echo esc_attr__('Mobile menu', 'hello-elementor'); ?>" aria-hidden="true" inert>
            <?php echo $header_mobile_nav_menu; ?>
        </nav>
    <?php endif; ?>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.querySelector('.site-navigation-toggle');
        const mobileMenu = document.getElementById('mobile-menu-dropdown');
        const header = document.getElementById('site-header');
        const body = document.body;

        if (toggleButton && mobileMenu) {
            toggleButton.addEventListener('click', function() {
                const isExpanded = this.getAttribute('aria-expanded') === 'true' || false;

                this.setAttribute('aria-expanded', !isExpanded);
                mobileMenu.setAttribute('aria-hidden', isExpanded);

                if (!isExpanded) {
                    // Open menu
                    mobileMenu.removeAttribute('inert');

                    // Get current scroll position
                    const scrollPosition = window.pageYOffset;

                    // Lock the body and set scroll back to the top (visually)
                    body.style.overflow = 'hidden';
                    body.style.height = '100vh';

                    // Save the scroll position and apply negative margin to simulate fixed body
                    body.setAttribute('data-scroll-position', scrollPosition);
                    body.style.marginTop = `-${scrollPosition}px`;

                } else {
                    // Close menu
                    mobileMenu.setAttribute('inert', '');

                    // Get saved scroll position
                    const scrollPosition = body.getAttribute('data-scroll-position') || 0;

                    // Unlock the body
                    body.style.removeProperty('overflow');
                    body.style.removeProperty('height');
                    body.style.removeProperty('margin-top');

                    // Restore scroll position
                    window.scrollTo(0, parseInt(scrollPosition));
                    body.removeAttribute('data-scroll-position');
                }
            });
        }
    });
</script>