<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * BB Hero Widget
 */
class BB_Hero_Widget extends \Elementor\Widget_Base {
	public function get_name() { return 'bb_hero'; }
	public function get_title() { return esc_html__( 'BB Hero', 'bb-astra-child' ); }
	public function get_icon() { return 'eicon-banner'; }
	public function get_categories() { return [ 'bb-theme-widgets' ]; }
	protected function register_controls() {
		$this->start_controls_section( 'content_section', [ 'label' => 'Hero Content', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
		$this->add_control( 'badge_text', [ 'label' => 'Badge', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Premium Quality Since Inception', 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'title', [ 'label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'BB Cigarettes', 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'subtitle', [ 'label' => 'Subtitle', 'type' => \Elementor\Controls_Manager::WYSIWYG, 'default' => 'Experience a <strong>smooth and rich</strong> premium smoking experience...' ] );
        $this->add_control( 'btn_1_text', [ 'label' => 'Button 1 Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Buy BB Cigarettes Online' ] );
        $this->add_control( 'btn_1_link', [ 'label' => 'Button 1 Link', 'type' => \Elementor\Controls_Manager::URL, 'placeholder' => 'https://your-link.com' ] );
        $this->add_control( 'btn_2_text', [ 'label' => 'Button 2 Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'View Products' ] );
        $this->add_control( 'btn_2_link', [ 'label' => 'Button 2 Link', 'type' => \Elementor\Controls_Manager::URL, 'placeholder' => 'https://your-link.com' ] );
        
        $this->add_control( 'show_calculator', [ 'label' => 'Show Calculator', 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes' ] );
        $this->add_control( 'carton_price', [ 'label' => 'Price Per Carton', 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 37 ] );
        $this->add_control( 'retail_price', [ 'label' => 'Retail Value (10 packs)', 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 60 ] );
        $this->add_control( 'image', [ 'label' => 'Hero Image', 'type' => \Elementor\Controls_Manager::MEDIA ] );
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="hero">
            <div class="hero-overlay"></div>
            <div class="hero-container">
                <div class="hero-content">
                    <?php if($settings['badge_text']): ?><span class="hero-badge"><?php echo esc_html($settings['badge_text']); ?></span><?php endif; ?>
                    <h1 class="hero-title"><?php echo esc_html($settings['title']); ?></h1>
                    <div class="hero-subtitle"><?php echo $settings['subtitle']; ?></div>
                    <div class="hero-ctas">
                        <?php if($settings['btn_1_text']): ?>
                            <a href="<?php echo esc_url($settings['btn_1_link']['url']); ?>" class="btn btn-primary"><?php echo esc_html($settings['btn_1_text']); ?></a>
                        <?php endif; ?>
                        <?php if($settings['btn_2_text']): ?>
                            <a href="<?php echo esc_url($settings['btn_2_link']['url']); ?>" class="btn btn-secondary"><?php echo esc_html($settings['btn_2_text']); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <?php if('yes' === $settings['show_calculator']): ?>
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

                <script>
                jQuery(document).ready(function($) {
                    const cartonQtyInput = $('#cartonQty');
                    const qtyMinusBtn = $('#qtyMinus');
                    const qtyPlusBtn = $('#qtyPlus');
                    const pricePerCartonEl = $('#pricePerCarton');
                    const totalPriceEl = $('#totalPrice');
                    const totalSavingsEl = $('#totalSavings');
                    const savingsNoteEl = $('#savingsNote');

                    const BASE_PACK_PRICE = 5.99;
                    const PACKS_PER_CARTON = 10;

                    function getPricePerCarton(qty) {
                        if (qty >= 50) return 31.00;
                        if (qty >= 40) return 32.00;
                        if (qty >= 30) return 33.00;
                        if (qty >= 20) return 34.00;
                        if (qty >= 10) return 35.00;
                        return 37.00;
                    }

                    function updateCalculator() {
                        let qty = parseInt(cartonQtyInput.val());
                        if (isNaN(qty) || qty < 1) qty = 1;

                        const cartonPrice = getPricePerCarton(qty);
                        const total = cartonPrice * qty;

                        const totalPacks = qty * PACKS_PER_CARTON;
                        const costAsPacks = totalPacks * BASE_PACK_PRICE;
                        const savings = costAsPacks - total;
                        const savingsPerPack = savings / totalPacks;

                        pricePerCartonEl.text('$' + cartonPrice.toFixed(2));
                        totalPriceEl.text('$' + total.toFixed(2));
                        totalSavingsEl.text('$' + savings.toFixed(2));
                        savingsNoteEl.text('You save $' + savingsPerPack.toFixed(2) + ' per pack!');
                    }

                    qtyMinusBtn.on('click', function() {
                        let qty = parseInt(cartonQtyInput.val());
                        if (qty > 1) {
                            cartonQtyInput.val(qty - 1);
                            updateCalculator();
                        }
                    });

                    qtyPlusBtn.on('click', function() {
                        let qty = parseInt(cartonQtyInput.val());
                        cartonQtyInput.val(qty + 1);
                        updateCalculator();
                    });

                    cartonQtyInput.on('input change', updateCalculator);
                    updateCalculator();
                });
                </script>
                <?php else: ?>
                <div class="hero-image">
                    <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'image' ); ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
		<?php
	}
}

/**
 * BB Intro Widget (Features)
 */
class BB_Intro_Widget extends \Elementor\Widget_Base {

	public function get_name() { return 'bb_intro'; }
	public function get_title() { return esc_html__( 'BB Intro & Features', 'bb-astra-child' ); }
	public function get_icon() { return 'eicon-bullet-list'; }
	public function get_categories() { return [ 'bb-theme-widgets' ]; }

	protected function register_controls() {
        // Content
		$this->start_controls_section( 'content_section', [ 'label' => 'Content', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
        
        $this->add_control( 'section_label', [ 'label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Introduction' ] );
        $this->add_control( 'title', [ 'label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'What Makes BB Smokes Stand Out' ] );
        $this->add_control( 'description', [ 'label' => 'Description', 'type' => \Elementor\Controls_Manager::WYSIWYG ] );

        // Repeater for features
        $repeater = new \Elementor\Repeater();
        $repeater->add_control( 'feature_title', [ 'label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Premium Tobacco' ] );
        $repeater->add_control( 'feature_desc', [ 'label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Robust tobacco blend...' ] );
        $repeater->add_control( 'feature_icon', [ 'label' => 'Icon', 'type' => \Elementor\Controls_Manager::ICONS, 'default' => [ 'value' => 'fas fa-leaf', 'library' => 'solid' ] ] );
        
        $this->add_control( 'features', [
			'label' => 'Features List',
			'type' => \Elementor\Controls_Manager::REPEATER,
			'fields' => $repeater->get_controls(),
            'default' => [ 
                ['feature_title' => 'Premium Quality', 'feature_desc' => 'Sourced from the finest growers.'],
                ['feature_title' => 'Rich Flavor', 'feature_desc' => 'A taste that stands apart.']
            ]
		] );

        $this->add_control( 'image', [ 'label' => 'Side Image', 'type' => \Elementor\Controls_Manager::MEDIA ] );

		$this->end_controls_section();
        
        // Styles
        $this->start_controls_section( 'style_section', [ 'label' => 'Styles', 'tab' => \Elementor\Controls_Manager::TAB_STYLE ] );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'title_typo', 'selector' => '{{WRAPPER}} .intro-content h2' ] );
        $this->add_control( 'accent_color', [ 'label' => 'Accent Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .feature-icon' => 'background-color: {{VALUE}}', '{{WRAPPER}} .feature-item' => 'border-left-color: {{VALUE}}' ] ] );
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
        <section class="introduction" id="about">
            <div class="container">
                <div class="intro-grid">
                    <div class="intro-content">
                        <span class="section-label"><?php echo esc_html($settings['section_label']); ?></span>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                        <div class="desc"><?php echo $settings['description']; ?></div>

                        <div class="intro-features">
                            <?php foreach ( $settings['features'] as $item ) : ?>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $item['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </div>
                                <div class="feature-text">
                                    <h4><?php echo esc_html($item['feature_title']); ?></h4>
                                    <p><?php echo esc_html($item['feature_desc']); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="intro-image">
                       <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'large', 'image' ); ?>
                    </div>
                </div>
            </div>
        </section>
		<?php
	}
}

/**
 * BB Brand Stats Widget
 */
class BB_Brand_Stats_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_brand_stats'; }
    public function get_title() { return 'BB Brand Stats'; }
    public function get_icon() { return 'eicon-counter'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }
    
    protected function register_controls() {
        $this->start_controls_section( 'content', [ 'label' => 'Content', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
        $this->add_control( 'section_label', [ 'label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'The Brand' ] );
        $this->add_control( 'title', [ 'label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'What Are BB Brand Cigarettes' ] );
        $this->add_control( 'desc', [ 'label' => 'Description', 'type' => \Elementor\Controls_Manager::WYSIWYG, 'default' => 'BB Brand Cigarettes represent a premium smoking product...' ] );
        
        $repeater = new \Elementor\Repeater();
        $repeater->add_control( 'number', [ 'label' => 'Number', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '3' ] );
        $repeater->add_control( 'label', [ 'label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Product Variants' ] );
        $this->add_control( 'stats', [ 'label' => 'Stats', 'type' => \Elementor\Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'default' => [['number'=>'3','label'=>'Product Variants'],['number'=>'100%','label'=>'Quality Controlled'],['number'=>'Canada','label'=>'Wide Availability']] ] );
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="brand-section">
            <div class="container">
                <div class="brand-content">
                    <span class="section-label"><?php echo esc_html($settings['section_label']); ?></span>
                    <h2><?php echo esc_html($settings['title']); ?></h2>
                    <div class="desc"><?php echo $settings['desc']; ?></div>
                    <div class="brand-stats">
                        <?php foreach($settings['stats'] as $item): ?>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo esc_html($item['number']); ?></span>
                            <span class="stat-label"><?php echo esc_html($item['label']); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}

/**
 * BB Quality Widget
 */
class BB_Quality_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_quality'; }
    public function get_title() { return 'BB Quality List'; }
    public function get_icon() { return 'eicon-check-circle'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }
    
    protected function register_controls() {
        $this->start_controls_section( 'content', [ 'label' => 'Content', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
        $this->add_control( 'image', [ 'label' => 'Image', 'type' => \Elementor\Controls_Manager::MEDIA ] );
        $this->add_control( 'section_label', [ 'label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Craftsmanship' ] );
        $this->add_control( 'title', [ 'label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Premium Quality & Tobacco Blend' ] );
        $this->add_control( 'desc', [ 'label' => 'Description', 'type' => \Elementor\Controls_Manager::WYSIWYG ] );
        
        $repeater = new \Elementor\Repeater();
        $repeater->add_control( 'text', [ 'label' => 'Text', 'type' => \Elementor\Controls_Manager::WYSIWYG, 'default' => '<strong>Feature:</strong> Description' ] );
        $this->add_control( 'items', [ 'label' => 'List Items', 'type' => \Elementor\Controls_Manager::REPEATER, 'fields' => $repeater->get_controls() ] );
        $this->add_control( 'btn_text', [ 'label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT ] );
        $this->add_control( 'btn_link', [ 'label' => 'Button Link', 'type' => \Elementor\Controls_Manager::URL ] );
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="quality-section" id="quality">
            <div class="container">
                <div class="quality-grid">
                    <div class="quality-image">
                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'large', 'image' ); ?>
                    </div>
                    <div class="quality-content">
                        <span class="section-label"><?php echo esc_html($settings['section_label']); ?></span>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                        <div class="desc"><?php echo $settings['desc']; ?></div>

                        <ul class="quality-list">
                            <?php foreach($settings['items'] as $item): ?>
                            <li>
                                <span class="list-icon"></span>
                                <span><?php echo $item['text']; ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <?php if($settings['btn_text']): ?>
                        <a href="<?php echo esc_url($settings['btn_link']['url']); ?>" class="btn btn-primary"><?php echo esc_html($settings['btn_text']); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}

/**
 * BB Variants Widget (Producs)
 */
class BB_Variants_Widget extends \Elementor\Widget_Base {

	public function get_name() { return 'bb_variants'; }
	public function get_title() { return esc_html__( 'BB Product List', 'bb-astra-child' ); }
	public function get_icon() { return 'eicon-products'; }
	public function get_categories() { return [ 'bb-theme-widgets' ]; }

	protected function register_controls() {
        $this->start_controls_section( 'content_section', [ 'label' => 'Products', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
        $this->add_control( 'section_label', [ 'label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Product Line' ] );
        $this->add_control( 'title', [ 'label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'BB Cigarettes Product Variants' ] );
        $this->add_control( 'desc', [ 'label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Three distinct options crafted for different preferences' ] );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control( 'image', [ 'label' => 'Product Image', 'type' => \Elementor\Controls_Manager::MEDIA ] );
        $repeater->add_control( 'label', [ 'label' => 'Small Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'SIGNATURE BLEND' ] );
        $repeater->add_control( 'name', [ 'label' => 'Product Name', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'BB Full Flavor' ] );
        $repeater->add_control( 'desc', [ 'label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'A bold definition of premium quality...' ] );
        $repeater->add_control( 'specs', [ 'label' => 'Specs (HTML)', 'type' => \Elementor\Controls_Manager::WYSIWYG, 'default' => '<ul><li><strong>Profile:</strong> Rich</li></ul>' ] );
        $repeater->add_control( 'btn_text', [ 'label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'View Details' ] );
        $repeater->add_control( 'btn_link', [ 'label' => 'Button Link', 'type' => \Elementor\Controls_Manager::URL ] );

        $this->add_control( 'products', [
			'label' => 'Product List',
			'type' => \Elementor\Controls_Manager::REPEATER,
			'fields' => $repeater->get_controls(),
            'default' => [
                [ 'name' => 'BB Full Flavor', 'label' => 'Signature Blend' ],
                [ 'name' => 'BB Light', 'label' => 'Smooth Blend' ]
            ]
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
        <section class="variants-section">
            <div class="container user-selectable-container">
                <div class="section-header">
                    <span class="section-label"><?php echo esc_html($settings['section_label']); ?></span>
                    <h2><?php echo esc_html($settings['title']); ?></h2>
                    <p><?php echo esc_html($settings['desc']); ?></p>
                </div>
                <div class="variants-grid">
                    <?php foreach ( $settings['products'] as $item ) : ?>
                    <div class="variant-card">
                        <div class="variant-image">
                             <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, 'large', 'image' ); ?>
                        </div>
                        <div class="variant-content">
                            <span class="variant-label"><?php echo esc_html($item['label']); ?></span>
                            <h3><?php echo esc_html($item['name']); ?></h3>
                            <p><?php echo esc_html($item['desc']); ?></p>
                            <div class="variant-specs">
                                <?php echo $item['specs']; // Allow HTML for the list ?>
                            </div>
                            <?php if($item['btn_text']): ?>
                            <a href="<?php echo esc_url($item['btn_link']['url']); ?>" class="btn btn-outline">
                                <?php echo esc_html($item['btn_text']); ?>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
		<?php
	}
}

/**
 * BB Benefits Widget
 */
class BB_Benefits_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_benefits'; }
    public function get_title() { return 'BB Benefits Grid'; }
    public function get_icon() { return 'eicon-info-box'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }
    
    protected function register_controls() { 
        $this->start_controls_section( 'content', [ 'label' => 'Content', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
        $this->add_control( 'section_label', [ 'label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Advantages' ] );
        $this->add_control( 'title', [ 'label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Why Choose BB Cigarettes' ] );
        $this->add_control( 'desc', [ 'label' => 'Subtitle', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Six reasons to experience BB Smokes' ] );
        
        $repeater = new \Elementor\Repeater();
        $repeater->add_control( 'num', [ 'label' => 'Number', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '01' ] );
        $repeater->add_control( 'title', [ 'label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Premium Tobacco' ] );
        $repeater->add_control( 'text', [ 'label' => 'Text', 'type' => \Elementor\Controls_Manager::TEXTAREA ] );
        
        $this->add_control( 'items', [ 'label' => 'Benefits', 'type' => \Elementor\Controls_Manager::REPEATER, 'fields' => $repeater->get_controls() ] );
        $this->end_controls_section();
    }
    
    protected function render() { 
        $settings = $this->get_settings_for_display();
        ?>
        <section class="benefits-section">
            <div class="container">
                <div class="section-header">
                    <span class="section-label"><?php echo esc_html($settings['section_label']); ?></span>
                    <h2><?php echo esc_html($settings['title']); ?></h2>
                    <p><?php echo esc_html($settings['desc']); ?></p>
                </div>
                <div class="benefits-grid">
                    <?php foreach($settings['items'] as $item): ?>
                    <div class="benefit-item">
                        <span class="benefit-number"><?php echo esc_html($item['num']); ?></span>
                        <h4><?php echo esc_html($item['title']); ?></h4>
                        <p><?php echo esc_html($item['text']); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}

/**
 * BB Purchase Steps Widget
 */
class BB_Purchase_Steps_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_purchase_steps'; }
    public function get_title() { return 'BB Purchase Steps'; }
    public function get_icon() { return 'eicon-number-field'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }
    
    protected function register_controls() {
        $this->start_controls_section( 'content', [ 'label' => 'Content', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
        $this->add_control( 'section_label', [ 'label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Purchase' ] );
        $this->add_control( 'title', [ 'label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Buy BB Cigarettes Online' ] );
        $this->add_control( 'text', [ 'label' => 'Text', 'type' => \Elementor\Controls_Manager::WYSIWYG ] );
        
        $repeater = new \Elementor\Repeater();
        $repeater->add_control( 'num', [ 'label' => 'Number', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '1' ] );
        $repeater->add_control( 'text', [ 'label' => 'Step Text', 'type' => \Elementor\Controls_Manager::TEXT ] );
        $this->add_control( 'steps', [ 'label' => 'Steps', 'type' => \Elementor\Controls_Manager::REPEATER, 'fields' => $repeater->get_controls() ] );
        
        $this->add_control( 'btn_text', [ 'label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT ] );
        $this->add_control( 'btn_link', [ 'label' => 'Button Link', 'type' => \Elementor\Controls_Manager::URL ] );
        $this->end_controls_section();
    }
    
    protected function render() { 
        $settings = $this->get_settings_for_display();
        ?>
        <section class="purchase-section" id="buy">
            <div class="container">
                <div class="purchase-grid">
                    <div class="purchase-content">
                        <span class="section-label"><?php echo esc_html($settings['section_label']); ?></span>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                        <div class="desc"><?php echo $settings['text']; ?></div>

                        <div class="purchase-steps">
                            <?php foreach($settings['steps'] as $item): ?>
                            <div class="step">
                                <span class="step-number"><?php echo esc_html($item['num']); ?></span>
                                <span class="step-text"><?php echo esc_html($item['text']); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <?php if($settings['btn_text']): ?>
                        <a href="<?php echo esc_url($settings['btn_link']['url']); ?>" class="btn btn-primary btn-large"><?php echo esc_html($settings['btn_text']); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}

/**
 * BB FAQ Widget
 */
class BB_FAQ_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_faq'; }
    public function get_title() { return 'BB FAQ'; }
    public function get_icon() { return 'eicon-accordion'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }
    
    protected function register_controls() {
        $this->start_controls_section( 'content', [ 'label' => 'Content', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
        $this->add_control( 'section_label', [ 'label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Information' ] );
        $this->add_control( 'title', [ 'label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Frequently Asked Questions' ] );
        $this->add_control( 'subtitle', [ 'label' => 'Subtitle', 'type' => \Elementor\Controls_Manager::TEXT ] );
        
        $repeater = new \Elementor\Repeater();
        $repeater->add_control( 'q', [ 'label' => 'Question', 'type' => \Elementor\Controls_Manager::TEXT ] );
        $repeater->add_control( 'a', [ 'label' => 'Answer', 'type' => \Elementor\Controls_Manager::TEXTAREA ] );
        $this->add_control( 'items', [ 'label' => 'FAQs', 'type' => \Elementor\Controls_Manager::REPEATER, 'fields' => $repeater->get_controls() ] );
        $this->end_controls_section();
    }
    
    protected function render() { 
        $settings = $this->get_settings_for_display();
        ?>
        <section class="faq-section" id="faq">
            <div class="container">
                <div class="section-header">
                    <span class="section-label"><?php echo esc_html($settings['section_label']); ?></span>
                    <h2><?php echo esc_html($settings['title']); ?></h2>
                    <p><?php echo esc_html($settings['subtitle']); ?></p>
                </div>

                <div class="faq-grid">
                    <?php foreach($settings['items'] as $item): ?>
                    <div class="faq-item">
                        <h4><?php echo esc_html($item['q']); ?></h4>
                        <p><?php echo esc_html($item['a']); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}

/**
 * BB CTA Widget
 */
class BB_CTA_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_cta'; }
    public function get_title() { return 'BB Bottom CTA'; }
    public function get_icon() { return 'eicon-call-to-action'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }
    
    protected function register_controls() {
        $this->start_controls_section( 'content', [ 'label' => 'Content', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
        $this->add_control( 'badge', [ 'label' => 'Badge', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Limited Time Offer' ] );
        $this->add_control( 'title', [ 'label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Get 10% Off Your First Bulk Order' ] );
        $this->add_control( 'text', [ 'label' => 'Text', 'type' => \Elementor\Controls_Manager::TEXTAREA ] );
        $this->add_control( 'btn_text', [ 'label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT ] );
        $this->add_control( 'btn_link', [ 'label' => 'Button Link', 'type' => \Elementor\Controls_Manager::URL ] );
        $this->end_controls_section();
    }
    
    protected function render() { 
        $settings = $this->get_settings_for_display();
        ?>
        <section class="final-cta">
            <div class="container">
                <div class="cta-content">
                    <span class="offer-badge"><?php echo esc_html($settings['badge']); ?></span>
                    <h2><?php echo esc_html($settings['title']); ?></h2>
                    <p><?php echo esc_html($settings['text']); ?></p>
                    <div class="cta-buttons">
                         <?php if($settings['btn_text']): ?>
                        <a href="<?php echo esc_url($settings['btn_link']['url']); ?>" class="btn-coupon"><?php echo esc_html($settings['btn_text']); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
