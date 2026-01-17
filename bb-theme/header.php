<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- AGE VERIFICATION POPUP -->
<?php if ( bb_check_age_verification() ) : ?>
<div class="age-verification-overlay" id="ageVerification">
    <div class="age-verification-modal">
        <div class="age-modal-content">
            <div class="age-logo">BB</div>
            <h2>Age Verification Required</h2>
            <p>You must be of legal smoking age in your jurisdiction to enter this website.</p>
            <p class="age-question">Are you 18 years of age or older?</p>
            <div class="age-buttons">
                <button class="btn btn-primary" id="ageYes">Yes, I am 18+</button>
                <button class="btn btn-secondary" id="ageNo">No, I am under 18</button>
            </div>
            <p class="age-disclaimer">By entering this site, you agree to our Terms of Service and acknowledge that tobacco products are intended for adults only.</p>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- HEADER NAVIGATION -->
<header class="header" id="header">
    <div class="header-container">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo">
            <span class="logo-text">BB</span>
            <span class="logo-tagline">Cigarettes</span>
        </a>
        <nav class="header-nav">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_class'     => 'nav-list',
                'container'      => false,
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>
        <a href="https://1smokes.ca/bb-cigarettes/" class="btn btn-primary header-cta">Buy Now</a>
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<!-- MOBILE NAVIGATION -->
<div class="mobile-nav" id="mobileNav">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'menu_class'     => 'mobile-nav-list',
        'container'      => false,
        'fallback_cb'    => false,
    ) );
    ?>
</div>
