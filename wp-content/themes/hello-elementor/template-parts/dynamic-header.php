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
	'container' => false,
	'echo' => false,
];
$header_nav_menu = wp_nav_menu($menu_args);
$header_mobile_nav_menu = wp_nav_menu($menu_args);
?>

<style>
	.headr {
		position: relative;
		width: 100%;
		z-index: 1000;
		background: #fff;
		padding: 1rem 0;
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
	}

	.headr-nav a:hover {
		color: rgba(77, 67, 55, 0.7);
	}

	.headr .btn {
		border-radius: 4px;
		border: 1.5px solid #4D4337;
		display: flex;
		padding: 15px 30px;
		justify-content: center;
		align-items: center;
		gap: 10px;
		color: #4D4337;
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
		background: #4D4337;
		color: #fff;
	}

	.site-navigation-toggle-holder {
		display: none;
		margin-left: 15px;
	}

	.site-navigation-toggle {
		background: none !important;
		border: none !important;
		padding: 0 !important;
		cursor: pointer;
		display: flex;
		align-items: center;
		justify-content: center;
		width: 24px;
		height: 24px;
	}

	.site-navigation-toggle svg {
		width: 100%;
		height: 100%;
	}

	.site-navigation-toggle svg path {
		stroke: #4D4337;
		transition: stroke 0.3s ease;
	}

	.site-navigation-dropdown {
		position: absolute;
		top: 100%;
		left: 0;
		right: 0;
		background: #fff;
		z-index: 999;
		max-height: 0;
		overflow: hidden;
		transition: max-height 0.3s ease;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
	}

	.site-navigation-dropdown[aria-hidden="false"] {
		max-height: calc(100vh - 80px);
		overflow-y: auto;
	}

	@media (max-width: 1600px) {
		.headr-container {
			padding: 0 25px;
		}
	}

	@media (max-width: 1024px) {
		.headr {
			padding: 1.5rem 0;
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
			display: block !important;
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
			padding: 1rem 0;
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

	.site-navigation-toggle-holder {
		display: none;
	}

	.site-navigation-toggle {
		background: none;
		border: none;
		padding: 0;
		cursor: pointer;
		display: flex;
		align-items: center;
		justify-content: center;
		width: 36px;
		height: 36px;
	}

	.site-navigation-toggle svg {
		width: 100%;
		height: 100%;
		stroke: #4D4337;
		transition: stroke 0.3s ease;
	}

	@media (max-width: 768px) {
		.site-navigation-toggle-holder {
			display: block;
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
					<button type="button" class="site-navigation-toggle" aria-label="<?php echo esc_attr('Menu', 'hello-elementor'); ?>">
						<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M31.5 15H10.5M31.5 9H4.5M31.5 21H4.5M31.5 27H10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</button>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ($header_mobile_nav_menu) : ?>
		<nav class="site-navigation-dropdown" aria-label="<?php echo esc_attr__('Mobile menu', 'hello-elementor'); ?>" aria-hidden="true" inert>
			<?php echo $header_mobile_nav_menu; ?>
		</nav>
	<?php endif; ?>
</header>