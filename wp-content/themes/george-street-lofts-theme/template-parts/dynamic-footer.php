<?php
if (! defined('ABSPATH')) {
    exit;
}

$footer_menu_args = [
    'theme_location' => 'menu-1',
    'fallback_cb' => false,
    'container' => false,
    'echo' => false,
    'menu_class' => 'footer-menu',
    'depth' => 1,
];
$footer_navigate_menu = wp_nav_menu($footer_menu_args);
?>

<style>
    .george-footer {
        background: #fff;
        color: #333;
        max-width: 100% !important;
        padding-bottom: 0;
    }

    .footer-main {
        padding: 0 10%;
        border-bottom: 1px solid #e5e5e5;
        border-top: 1px solid var(--Stroke, #D3D3D3);
    }

    .footer-container {
        display: flex;
        gap: 20rem;
        padding: 4rem 0;
        font-family: Arial;
    }

    .footer-container .brand-column {
        justify-content: space-between;
    }

    .footer-container .brand-column .footer-brand {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .footer-bottom {
        padding: 0 10%;
        background: #fff;
    }

    .footer-bottom-container {
        padding: 1.5rem 0;
    }

    .footer-logo .site-logo {
        max-width: 200px;
        width: 100%;
        height: auto;
    }

    .footer-logo .site-logo img {
        width: 100%;
        height: auto;
        max-height: 60px;
        object-fit: contain;
    }

    .brand-column {
        flex: 0 0 300px;
    }

    .footer-columns-wrapper {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 80px;
        flex: 1;
    }

    .brand-description {
        font-size: 1rem;
        line-height: 1.5;
        color: #666;
    }

    .newsletter-section {
        gap: 15px;
        display: flex;
        flex-direction: column;
    }

    .newsletter-title {
        font-size: 1rem;
        font-weight: 600;
        color: #1a1a1a;
    }

    .newsletter-subtitle {
        font-size: 0.9rem;
        color: #666;
    }

    .newsletter-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .input-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-wrapper input[type="email"] {
        flex: 1;
        padding: 0.75rem 3rem 0.75rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 0.9rem;
        font-family: Arial;
        color: #666;
    }

    .input-wrapper input[type="email"]::placeholder {
        color: #666;
    }

    .submit-svg {
        position: absolute;
        right: 0.5rem;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .submit-svg svg {
        width: 20px;
        height: 20px;
    }

    .footer-column .column-title {
        font-size: 1rem;
        font-weight: 600;
        color: #1a1a1a;
    }

    .footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 0.5rem;
    }
    
    .footer-menu li {
        list-style: none;
        margin-bottom: 8px;
    }
    
    .footer-menu a {
        color: #666;
        text-decoration: none;
        font-size: 0.9rem;
        display: block;
        padding: 0.1rem 0;
    }

    .footer-menu a:hover {
        color: #1a1a1a;
    }

    .footer-column {
        gap: 15px;
        display: flex;
        flex-direction: column;
    }

    .location-text {
        font-size: 0.9rem;
        line-height: 1.5;
        color: #666;
		text-align: left;
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: #666;
    }

    .contact-item svg {
        width: 16px;
        height: 16px;
    }

    .hours-grid {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .hours-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
    }

    .hours-row .day {
        color: #666;
    }

    .hours-row .hours {
        color: #32302F;
    }

    .social-links {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .social-link {
        color: #666;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .social-link:hover {
        color: #1a1a1a;
    }

    .footer-legal {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .copyright {
        color: var(--Black, #32302F);
        font-family: Arial;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%;
        letter-spacing: 0.14px;
    }

    .legal-links {
        display: flex;
        gap: 2rem;
    }

    .legal-link {
        color: var(--Black, #32302F);
        font-family: Arial;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%;
        letter-spacing: 0.14px;
    }

    .legal-link:hover {
        color: #1a1a1a;
    }

    @media (max-width: 1600px) {
        .footer-main {
            padding: 0 25px;
        }

        .footer-bottom {
            padding: 0 25px;
        }
    }

    @media (max-width: 768px) {
        .footer-main {
            padding: 0 15px;
        }

        .footer-bottom {
            padding: 0 15px;
        }

        .footer-container {
            flex-direction: column;
            gap: 2rem;
        }

        .brand-column {
            flex: none;
        }

        .footer-columns-wrapper {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .footer-legal {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .footer-main {
            padding: 0 10px;
        }

        .footer-bottom {
            padding: 0 10px;
        }

        .footer-columns-wrapper {
            grid-template-columns: 1fr;
        }

        .legal-links {
            flex-direction: column;
            gap: 0.5rem;
        }
    }
</style>

<footer id="site-footer" class="site-footer george-footer">
    <div class="footer-main">
        <div class="footer-container">
            <div class="footer-column brand-column">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <?php if (has_custom_logo()) : ?>
                            <div class="site-logo">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <p class="brand-description">Get in touch today to learn more about available suites, floor plans, and leasing opportunities.</p>
                </div>

                <div class="newsletter-section">
                    <h4 class="newsletter-title">Newsletter:</h4>
                    <p class="newsletter-subtitle">Subscribe to our Newsletter to get a 5% discount.</p>
                    <form class="newsletter-form">
                        <div class="input-group">
                            <div class="input-wrapper">
                                <input type="email" placeholder="Your Email" required>
                                <button type="submit" class="submit-svg">
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.8783 12.3004H5.93989M5.77157 13.0789L4.79047 16.0096C4.25313 17.6147 3.98446 18.4172 4.17727 18.9114C4.3447 19.3407 4.70432 19.666 5.14806 19.7899C5.65905 19.9325 6.43084 19.5852 7.97442 18.8906L17.8702 14.4375C19.3768 13.7595 20.1302 13.4205 20.363 12.9496C20.5653 12.5405 20.5653 12.0603 20.363 11.6512C20.1302 11.1804 19.3768 10.8413 17.8702 10.1633L7.95735 5.70258C6.41842 5.01007 5.64897 4.66381 5.13849 4.80586C4.69516 4.92921 4.33558 5.25373 4.16756 5.68213C3.97409 6.17543 4.23989 6.97625 4.7715 8.57788L5.77347 11.5967C5.86477 11.8718 5.91043 12.0094 5.92845 12.15C5.94444 12.2749 5.94427 12.4012 5.92797 12.526C5.90958 12.6666 5.86358 12.804 5.77157 13.0789Z" stroke="#32302F" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="footer-columns-wrapper">
                <div class="footer-column">
                    <h4 class="column-title">Navigate</h4>
                    <?php if ($footer_navigate_menu) : ?>
                        <?php echo $footer_navigate_menu; ?>
                    <?php else : ?>
                        <p>Menu not found</p>
                    <?php endif; ?>
                </div>

                <div class="footer-column">
                    <h4 class="column-title">Location</h4>
                    <p class="location-text">442 George St N<br>Peterborough, ON K9H 3R7</p>
                </div>

                <div class="footer-column">
                    <h4 class="column-title">Contact Us</h4>
                    <div class="contact-info">
                        <p class="contact-item">
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.4167 17.9932C8.283 17.9932 2.5 12.2102 2.5 5.0765C2.5 4.75465 2.51175 4.43555 2.53492 4.1196C2.5615 3.75701 2.57475 3.57571 2.66975 3.41069C2.74841 3.27401 2.88792 3.14438 3.03 3.07587C3.2015 2.99316 3.40158 2.99316 3.80167 2.99316L6.14942 2.99316C6.48592 2.99316 6.65417 2.99316 6.79833 3.04854C6.92575 3.09746 7.03917 3.17691 7.12867 3.27991C7.23 3.39652 7.2875 3.55463 7.4025 3.87084L8.37425 6.54321C8.508 6.91111 8.57492 7.09506 8.56358 7.26958C8.55358 7.42347 8.501 7.57156 8.41183 7.69738C8.31075 7.84006 8.14292 7.94077 7.80717 8.14218L6.66667 8.8265C7.66675 11.0347 9.45925 12.8249 11.6667 13.8265L12.351 12.686C12.5524 12.3502 12.6531 12.1824 12.7958 12.0813C12.9216 11.9922 13.0697 11.9396 13.2236 11.9296C13.3981 11.9182 13.5821 11.9852 13.95 12.1189L16.6223 13.0907C16.9385 13.2057 17.0966 13.2632 17.2132 13.3645C17.3163 13.454 17.3957 13.5674 17.4446 13.6948C17.5 13.839 17.5 14.0072 17.5 14.3437V16.6915C17.5 17.0916 17.5 17.2917 17.4173 17.4632C17.3488 17.6052 17.2192 17.7447 17.0825 17.8234C16.9174 17.9184 16.7362 17.9317 16.3736 17.9582C16.0576 17.9814 15.7385 17.9932 15.4167 17.9932Z" stroke="#A67131" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            289-797-1604
                        </p>
                        <p class="contact-item">
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 7.16016L14.5327 8.80867C12.8783 9.72774 12.0512 10.1873 11.1752 10.3675C10.3998 10.5269 9.60017 10.5269 8.82483 10.3675C7.94887 10.1873 7.12169 9.72774 5.46733 8.80867L2.5 7.16016M5.16667 16.3268H14.8333C15.7667 16.3268 16.2335 16.3268 16.59 16.1452C16.9036 15.9854 17.1586 15.7304 17.3183 15.4168C17.5 15.0603 17.5 14.5936 17.5 13.6602V7.32682C17.5 6.39341 17.5 5.92669 17.3183 5.57017C17.1586 5.25656 16.9036 5.0016 16.59 4.84181C16.2335 4.66016 15.7667 4.66016 14.8333 4.66016H5.16667C4.23325 4.66016 3.76653 4.66016 3.41002 4.84181C3.09641 5.0016 2.84144 5.25656 2.68166 5.57017C2.5 5.92669 2.5 6.3934 2.5 7.32682V13.6602C2.5 14.5936 2.5 15.0603 2.68166 15.4168C2.84144 15.7304 3.09641 15.9854 3.41002 16.1452C3.76653 16.3268 4.23324 16.3268 5.16667 16.3268Z" stroke="#A67131" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            lease@prismpm.ca
                        </p>
                    </div>
                </div>

                <div class="footer-column">
                    <h4 class="column-title">Office Hours</h4>
                    <div class="hours-grid">
                        <div class="hours-row">
                            <span class="day">Mon</span>
                            <span class="hours">9:00am-5:00pm</span>
                        </div>
                        <div class="hours-row">
                            <span class="day">Tue</span>
                            <span class="hours">9:00am-5:00pm</span>
                        </div>
                        <div class="hours-row">
                            <span class="day">Wed</span>
                            <span class="hours">9:00am-5:00pm</span>
                        </div>
                        <div class="hours-row">
                            <span class="day">Thu</span>
                            <span class="hours">9:00am-5:00pm</span>
                        </div>
                        <div class="hours-row">
                            <span class="day">Fri</span>
                            <span class="hours">9:00am-5:00pm</span>
                        </div>
                        <div class="hours-row">
                            <span class="day">Sat</span>
                            <span class="hours">10:00am-2:00pm</span>
                        </div>
                        <div class="hours-row">
                            <span class="day">Sun</span>
                            <span class="hours">By appointment only</span>
                        </div>
                    </div>
                </div>

                <div class="footer-column">
                    <h4 class="column-title">Social media</h4>
                    <div class="social-links">
                        <a href="#" class="social-link">YouTube</a>
                        <a href="#" class="social-link">Instagram</a>
                        <a href="#" class="social-link">Facebook</a>
                        <a href="#" class="social-link">LinkedIn</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="footer-bottom-container">
            <div class="footer-legal">
                <span class="copyright">©2025 by George Street Lofts. All rights reserved.</span>
                <div class="legal-links">
                    <a href="#" class="legal-link">Terms of Service</a>
                    <a href="#" class="legal-link">Privacy Policy</a>
                    <a href="#" class="legal-link">Cookies</a>
                </div>
            </div>
        </div>
    </div>
</footer>