<?php
/**
 * Template Name: Homepage
 * Description: BB Cigarettes homepage with all sections
 */

get_header();
?>

<main id="main-content" class="site-main">

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-container">
            <div class="hero-content">
                <span class="hero-badge">Premium Quality Since Inception</span>
                <h1 class="hero-title">BB Cigarettes</h1>
                <p class="hero-subtitle">Experience a <strong>smooth and rich</strong> premium smoking experience crafted with the <strong>highest quality ingredients</strong> for a <strong>consistent and satisfying</strong> taste.</p>
                <div class="hero-ctas">
                    <a href="https://1smokes.ca/bb-cigarettes/" class="btn btn-primary">Buy BB Cigarettes Online</a>
                    <a href="https://1smokes.ca/bb-cigarettes/" class="btn btn-secondary">View Products</a>
                </div>
            </div>
            <div class="hero-calculator">
                <div class="calc-header">
                    <h3>Bulk Savings Calculator</h3>
                    <p>See how much you save with our carton deals</p>
                </div>

                <div class="calc-input-group">
                    <label for="cartonQty">Number of Cartons (1 carton = 10 packs)</label>
                    <div class="qty-control">
                        <button class="qty-btn minus" id="qtyMinus">-</button>
                        <input type="number" id="cartonQty" value="1" min="1" max="100">
                        <button class="qty-btn plus" id="qtyPlus">+</button>
                    </div>
                </div>

                <div class="calc-breakdown">
                    <div class="calc-row">
                        <span>Price Per Carton:</span>
                        <span class="calc-value" id="pricePerCarton">$37.00</span>
                    </div>
                    <div class="calc-row">
                        <span>Total Price:</span>
                        <span class="calc-value highlight" id="totalPrice">$37.00</span>
                    </div>
                    <div class="calc-row savings-row">
                        <span>Your Savings:</span>
                        <span class="calc-value savings" id="totalSavings">$22.90</span>
                    </div>
                    <p class="savings-note" id="savingsNote">You save $2.29 per pack!</p>
                </div>

                <a href="https://1smokes.ca/bb-cigarettes/" class="btn btn-primary btn-block">Buy Now & Save</a>
            </div>
        </div>
    </section>

    <!-- INTRODUCTION SECTION -->
    <section class="introduction" id="about">
        <div class="container">
            <div class="intro-grid">
                <div class="intro-content">
                    <span class="section-label">Introduction</span>
                    <h2>What Makes BB Smokes Stand Out</h2>
                    <p>BB Cigarettes deliver a <strong>full flavoured cigarettes</strong> experience through a meticulous combination of premium tobacco, precision-engineered filters, and quality paper. Each BB Cigarette provides smooth inhalation and rich flavour delivery from first light to last draw.</p>

                    <div class="intro-features">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" />
                                </svg>
                            </div>
                            <div class="feature-text">
                                <h4>Premium Tobacco</h4>
                                <p>Robust tobacco blend sourced from select growing regions</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                            </div>
                            <div class="feature-text">
                                <h4>Precision Filters</h4>
                                <p>Engineered for optimal draw and smooth finish</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <path d="M9 9h6v6H9z" />
                                </svg>
                            </div>
                            <div class="feature-text">
                                <h4>Quality Paper</h4>
                                <p>Slow-burning paper for consistent smoking experience</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="intro-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/intro-detail.png" alt="BB Smokes Premium Tobacco Detail">
                </div>
            </div>
        </div>
    </section>

    <!-- BRAND SECTION -->
    <section class="brand-section">
        <div class="container">
            <div class="brand-content">
                <span class="section-label">The Brand</span>
                <h2>What Are BB Brand Cigarettes</h2>
                <p>BB Brand Cigarettes represent a premium smoking product positioned for discerning Canadian smokers who prioritize quality over quantity. Available across Canada, BB Cigarettes maintain strict quality standards across their entire product line.</p>
                <p>The brand focuses on delivering a <strong>consistent and satisfying</strong> smoking experience through careful tobacco selection and modern manufacturing processes. BB Cigarettes are available at authorized retailers and online platforms serving Natives Smokes Canada markets.</p>
                <div class="brand-stats">
                    <div class="stat-item">
                        <span class="stat-number">3</span>
                        <span class="stat-label">Product Variants</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">100%</span>
                        <span class="stat-label">Quality Controlled</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">Canada</span>
                        <span class="stat-label">Wide Availability</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUALITY SECTION -->
    <section class="quality-section" id="quality">
        <div class="container">
            <div class="quality-grid">
                <div class="quality-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/tobacco-blend.png" alt="BB Cigarettes Robust Tobacco Blend">
                </div>
                <div class="quality-content">
                    <span class="section-label">Craftsmanship</span>
                    <h2>Premium Quality & Tobacco Blend</h2>
                    <p>Every BB Cigarette begins with the <strong>highest quality ingredients</strong>. The <strong>robust tobacco blend</strong> combines carefully selected leaves to create a profile that balances strength with smoothness.</p>

                    <ul class="quality-list">
                        <li>
                            <span class="list-icon"></span>
                            <span><strong>Smooth Inhalation:</strong> Engineered airflow for effortless draw</span>
                        </li>
                        <li>
                            <span class="list-icon"></span>
                            <span><strong>Rich Flavour Delivery:</strong> Full-bodied taste from start to finish</span>
                        </li>
                        <li>
                            <span class="list-icon"></span>
                            <span><strong>Consistent Burn:</strong> Even combustion throughout each cigarette</span>
                        </li>
                        <li>
                            <span class="list-icon"></span>
                            <span><strong>Quality Filtration:</strong> Balanced smoke with reduced harshness</span>
                        </li>
                    </ul>

                    <a href="https://1smokes.ca/bb-cigarettes-online/" class="btn btn-primary">View BB Full Flavor</a>
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCT VARIANTS -->
    <section class="variants-section" id="products">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Product Line</span>
                <h2>BB Cigarettes Product Variants</h2>
                <p>Three distinct options crafted for different preferences</p>
            </div>

            <div class="variants-grid">
                <!-- BB Full Flavor -->
                <div class="variant-card">
                    <div class="variant-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/full-flavor-pack.png" alt="BB Full Flavor Cigarettes Pack">
                    </div>
                    <div class="variant-content">
                        <span class="variant-label">Classic Choice</span>
                        <h3><a href="https://1smokes.ca/bb-cigarettes-online/">BB Full Flavor</a></h3>
                        <p>The flagship BB Full Flavour Cigarettes deliver the complete <strong>premium smoking experience</strong>. Built for smokers who appreciate bold, uncompromised tobacco character.</p>
                        <ul class="variant-specs">
                            <li><strong>Flavor Profile:</strong> Bold, robust, full-bodied</li>
                            <li><strong>Intensity:</strong> Full strength</li>
                            <li><strong>Ideal For:</strong> Experienced smokers seeking rich, satisfying taste</li>
                        </ul>
                        <a href="https://1smokes.ca/bb-cigarettes-online/" class="btn btn-outline">View BB Full Flavor</a>
                    </div>
                </div>

                <!-- BB Lights -->
                <div class="variant-card">
                    <div class="variant-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/lights-pack.png" alt="BB Lights Cigarettes Pack">
                    </div>
                    <div class="variant-content">
                        <span class="variant-label">Refined Balance</span>
                        <h3><a href="https://1smokes.ca/bb-lights-cigarettes/">BB Lights Cigarettes</a></h3>
                        <p>BB Lights Cigarettes offer a <strong>lighter smoking experience</strong> without sacrificing flavor integrity. The same quality tobacco with a gentler approach.</p>
                        <ul class="variant-specs">
                            <li><strong>Flavor Profile:</strong> Smooth, mellow, balanced</li>
                            <li><strong>Intensity:</strong> Reduced strength</li>
                            <li><strong>Ideal For:</strong> Smokers preferring subtle, refined taste</li>
                        </ul>
                        <a href="https://1smokes.ca/bb-lights-cigarettes/" class="btn btn-outline">View BB Lights</a>
                    </div>
                </div>

                <!-- BB Menthol -->
                <div class="variant-card">
                    <div class="variant-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/menthol-pack.png" alt="BB Menthol Cigarettes Pack">
                    </div>
                    <div class="variant-content">
                        <span class="variant-label">Cool Refresh</span>
                        <h3><a href="https://1smokes.ca/bb-canadian-blend-cigarettes-menthol/">BB Menthol Cigarettes</a></h3>
                        <p>BB Menthol Cigarettes feature a <strong>distinctively minty flavour</strong> that combines cooling sensation with premium tobacco quality for a refreshing experience.</p>
                        <ul class="variant-specs">
                            <li><strong>Flavor Profile:</strong> Cool, minty, refreshing</li>
                            <li><strong>Intensity:</strong> Medium strength with cooling</li>
                            <li><strong>Ideal For:</strong> Those seeking menthol freshness with quality tobacco</li>
                        </ul>
                        <a href="https://1smokes.ca/bb-canadian-blend-cigarettes-menthol/" class="btn btn-outline">View BB Menthol</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BENEFITS -->
    <section class="benefits-section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Advantages</span>
                <h2>Why Choose BB Cigarettes</h2>
                <p>Six reasons to experience BB Smokes</p>
            </div>

            <div class="benefits-grid">
                <div class="benefit-item">
                    <span class="benefit-number">01</span>
                    <h4>Premium Tobacco Selection</h4>
                    <p>100% of tobacco leaves undergo quality inspection before processing</p>
                </div>
                <div class="benefit-item">
                    <span class="benefit-number">02</span>
                    <h4>Consistent Pack Quality</h4>
                    <p>Each pack contains 20 cigarettes manufactured to identical specifications</p>
                </div>
                <div class="benefit-item">
                    <span class="benefit-number">03</span>
                    <h4>Three Distinct Variants</h4>
                    <p>Full Flavor, Lights, and Menthol options to match individual preferences</p>
                </div>
                <div class="benefit-item">
                    <span class="benefit-number">04</span>
                    <h4>Canadian Availability</h4>
                    <p>Available at authorized retailers and online platforms across Canada</p>
                </div>
                <div class="benefit-item">
                    <span class="benefit-number">05</span>
                    <h4>Quality Controlled Production</h4>
                    <p>Manufacturing processes monitored at every stage for consistency</p>
                </div>
                <div class="benefit-item">
                    <span class="benefit-number">06</span>
                    <h4>Secure Packaging</h4>
                    <p>Freshness-sealed packaging maintains product integrity until opening</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PURCHASE SECTION -->
    <section class="purchase-section" id="buy">
        <div class="container">
            <div class="purchase-grid">
                <div class="purchase-content">
                    <span class="section-label">Purchase</span>
                    <h2>Buy BB Cigarettes Online in Canada</h2>
                    <p>Purchasing BB Cigarettes Online provides convenient access to the complete product range. Through authorized affiliate partners, Canadian customers can browse available variants, select preferred quantities, and complete secure transactions from any device.</p>
                    <p>Online ordering offers the advantage of home delivery, product variety visibility, and access to BB Full Flavor, BB Lights Cigarettes, and BB Menthol Cigarettes without visiting physical retail locations.</p>

                    <div class="purchase-steps">
                        <div class="step">
                            <span class="step-number">1</span>
                            <span class="step-text">Select your preferred BB Cigarettes variant</span>
                        </div>
                        <div class="step">
                            <span class="step-number">2</span>
                            <span class="step-text">Verify age and complete checkout</span>
                        </div>
                        <div class="step">
                            <span class="step-number">3</span>
                            <span class="step-text">Receive delivery to your Canadian address</span>
                        </div>
                    </div>

                    <a href="https://1smokes.ca/bb-cigarettes/" class="btn btn-primary btn-large">Buy BB Cigarettes Online</a>
                </div>

            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="faq-section" id="faq">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Information</span>
                <h2>Frequently Asked Questions</h2>
                <p>Common questions about BB Cigarettes answered directly</p>
            </div>

            <div class="faq-grid">
                <div class="faq-item">
                    <h4>What are BB Cigarettes?</h4>
                    <p>BB Cigarettes are premium tobacco products manufactured with high-quality ingredients, available in Full Flavor, Lights, and Menthol variants. The brand focuses on delivering a smooth and rich smoking experience through robust tobacco blends and precision engineering.</p>
                </div>

                <div class="faq-item">
                    <h4>Where are BB Cigarettes made?</h4>
                    <p>BB Cigarettes are produced in facilities that meet Canadian manufacturing standards. Production follows quality control protocols to ensure consistency across all product batches.</p>
                </div>

                <div class="faq-item">
                    <h4>Who makes BB Cigarettes?</h4>
                    <p>BB Brand Cigarettes are manufactured by a dedicated tobacco company specializing in premium cigarette production for the Canadian market.</p>
                </div>

                <div class="faq-item">
                    <h4>Are BB Cigarettes available in Canada?</h4>
                    <p>Yes. BB Cigarettes are available across Canada through authorized retail locations and online platforms. Customers can purchase BB Full Flavor, BB Lights Cigarettes, and BB Menthol Cigarettes through these channels.</p>
                </div>

                <div class="faq-item">
                    <h4>What is the difference between BB Full Flavor and BB Lights?</h4>
                    <p>BB Full Flavor delivers the complete robust tobacco experience with full strength and bold taste. BB Lights Cigarettes offer a lighter smoking experience with reduced intensity while maintaining the same quality tobacco blend and smooth inhalation characteristics.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FINAL CTA -->
    <section class="final-cta">
        <div class="container">
            <div class="cta-content">
                <span class="offer-badge">Limited Time Offer</span>
                <h2>Experience BB Cigarettes Today</h2>
                <p>Discover the premium smoking experience that defines BB Brand Cigarettes. Available now across Canada.</p>
                <div class="cta-buttons">
                    <a href="https://1smokes.ca/bb-cigarettes/" class="btn btn-primary btn-large">Buy BB Cigarettes Online</a>
                    <a href="https://1smokes.ca/bb-cigarettes/" class="btn btn-coupon">Claim Coupon Code</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
