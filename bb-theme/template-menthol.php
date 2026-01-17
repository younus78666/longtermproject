<?php
/**
 * Template Name: BB Menthol Product Page
 */

get_header();
?>

<main id="main-content" class="site-main">
    
    <!-- Product Hero -->
    <section class="product-hero">
        <div class="container">
            <div class="product-hero-grid">
                <div class="product-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/menthol-pack.png" alt="BB Menthol Cigarettes">
                </div>
                <div class="product-details">
                    <span class="product-category">Cool Refresh</span>
                    <h1>BB Menthol Cigarettes</h1>
                    <p class="product-subtitle">BB Menthol Cigarettes feature a distinctively minty flavour that combines cooling sensation with premium tobacco quality for a refreshing experience.</p>
                    
                    <div class="product-specs">
                        <h3>Specifications</h3>
                        <ul>
                            <li><strong>Flavor Profile:</strong> Cool, minty, refreshing</li>
                            <li><strong>Intensity:</strong> Medium strength with cooling</li>
                            <li><strong>Pack Size:</strong> 20 cigarettes per pack</li>
                            <li><strong>Carton:</strong> 10 packs (200 cigarettes)</li>
                            <li><strong>Filter Type:</strong> Menthol filter</li>
                        </ul>
                    </div>

                    <div class="product-cta">
                        <a href="https://1smokes.ca/bb-canadian-blend-cigarettes-menthol/" class="btn btn-primary btn-large">Buy BB Menthol Online</a>
                        <p class="age-notice">18+ Only. Must be of legal smoking age in your jurisdiction.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Features -->
    <section class="product-features">
        <div class="container">
            <h2>Why Choose BB Menthol</h2>
            <div class="features-grid">
                <div class="feature">
                    <h4>Menthol Freshness</h4>
                    <p>Distinctive cooling sensation from quality menthol infusion</p>
                </div>
                <div class="feature">
                    <h4>Premium Tobacco Base</h4>
                    <p>Same high-quality tobacco blend as other BB varieties</p>
                </div>
                <div class="feature">
                    <h4>Refreshing Experience</h4>
                    <p>Perfect balance of minty coolness and tobacco richness</p>
                </div>
                <div class="feature">
                    <h4>Smooth Cooling</h4>
                    <p>Consistent menthol delivery throughout each cigarette</p>
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
                <p><strong>Note:</strong> Menthol tobacco regulations vary by province. Some provinces have restrictions on menthol cigarette sales. Please verify local regulations before purchasing.</p>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
