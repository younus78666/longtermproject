<?php
/**
 * Template Name: BB Lights Product Page
 */

get_header();
?>

<main id="main-content" class="site-main">
    
    <!-- Product Hero -->
    <section class="product-hero">
        <div class="container">
            <div class="product-hero-grid">
                <div class="product-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/lights-pack.png" alt="BB Lights Cigarettes">
                </div>
                <div class="product-details">
                    <span class="product-category">Refined Balance</span>
                    <h1>BB Lights Cigarettes</h1>
                    <p class="product-subtitle">BB Lights Cigarettes offer a lighter smoking experience without sacrificing flavor integrity. The same quality tobacco with a gentler approach.</p>
                    
                    <div class="product-specs">
                        <h3>Specifications</h3>
                        <ul>
                            <li><strong>Flavor Profile:</strong> Smooth, mellow, balanced</li>
                            <li><strong>Intensity:</strong> Reduced strength</li>
                            <li><strong>Pack Size:</strong> 20 cigarettes per pack</li>
                            <li><strong>Carton:</strong> 10 packs (200 cigarettes)</li>
                            <li><strong>Filter Type:</strong> Light filter</li>
                        </ul>
                    </div>

                    <div class="product-cta">
                        <a href="https://1smokes.ca/bb-lights-cigarettes/" class="btn btn-primary btn-large">Buy BB Lights Online</a>
                        <p class="age-notice">18+ Only. Must be of legal smoking age in your jurisdiction.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Features -->
    <section class="product-features">
        <div class="container">
            <h2>Why Choose BB Lights</h2>
            <div class="features-grid">
                <div class="feature">
                    <h4>Lighter Experience</h4>
                    <p>Reduced tar and nicotine while maintaining premium tobacco quality</p>
                </div>
                <div class="feature">
                    <h4>Smooth Taste</h4>
                    <p>Mellow flavor profile perfect for those preferring subtle enjoyment</p>
                </div>
                <div class="feature">
                    <h4>Same Quality Standards</h4>
                    <p>Manufactured with identical quality controls as BB Full Flavor</p>
                </div>
                <div class="feature">
                    <h4>Refined Smoking</h4>
                    <p>Balanced smoke delivery for a sophisticated experience</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Canadian Compliance Notice -->
    <section class="compliance-notice">
        <div class="container">
            <div class="notice-box">
                <h3>⚠️ Important Canadian Tobacco Information</h3>
                <p><strong>Legal Age Requirements:</strong> You must be 18 years of age or older (19+ in some provinces including British Columbia, Nova Scotia, New Brunswick, Newfoundland and Labrador, Northwest Territories, Nunavut, and Yukon) to purchase tobacco products in Canada.</p>
                <p><strong>Health Warning:</strong> Tobacco use can be harmful to your health. This product contains nicotine, an addictive substance.</p>
                <p><strong>Provincial Regulations:</strong> Tobacco product availability and regulations vary by province and territory. Please ensure compliance with your local laws.</p>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
