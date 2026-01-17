<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 1. Testimonial Slider
 */
class BB_Testimonial_Widget extends \Elementor\Widget_Base {
	public function get_name() { return 'bb_testimonial'; }
	public function get_title() { return 'BB Testimonial Slider'; }
	public function get_icon() { return 'eicon-blockquote'; }
	public function get_categories() { return [ 'bb-theme-widgets' ]; }

	protected function register_controls() {
		$this->start_controls_section( 'content_section', [ 'label' => 'Testimonials', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
		$repeater = new \Elementor\Repeater();
		$repeater->add_control( 'name', [ 'label' => 'Name', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'John Doe' ] );
		$repeater->add_control( 'role', [ 'label' => 'Role/Location', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Toronto, ON' ] );
		$repeater->add_control( 'content', [ 'label' => 'Content', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Excellent service and premium quality.' ] );
		$this->add_control( 'testimonials', [ 'label' => 'Testimonials', 'type' => \Elementor\Controls_Manager::REPEATER, 'fields' => $repeater->get_controls() ] );
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="bb-testimonials-container">
            <!-- Simple Grid implementation for durability, can be made slider with JS if requested -->
            <div class="benefits-grid"> 
			<?php foreach ( $settings['testimonials'] as $item ) : ?>
				<div class="benefit-item">
					<p>"<?php echo esc_html( $item['content'] ); ?>"</p>
                    <div style="margin-top: 1.5rem; border-top: 1px solid rgba(201,169,98,0.2); padding-top: 1rem;">
                        <h4 style="font-size: 1rem; margin-bottom: 0;"><?php echo esc_html( $item['name'] ); ?></h4>
                        <span style="font-size: 0.8rem; color: #888; text-transform: uppercase; letter-spacing: 1px;"><?php echo esc_html( $item['role'] ); ?></span>
                    </div>
				</div>
			<?php endforeach; ?>
            </div>
		</div>
		<?php
	}
}

/**
 * 2. Pricing Table
 */
class BB_Pricing_Table_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_pricing'; }
    public function get_title() { return 'BB Pricing Table'; }
    public function get_icon() { return 'eicon-price-table'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }

    protected function register_controls() {
        $this->start_controls_section( 'content', [ 'label' => 'Pricing', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
        $this->add_control( 'title', [ 'label' => 'Plan Name', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Carton Deal' ] );
        $this->add_control( 'price', [ 'label' => 'Price', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '$45.00' ] );
        $this->add_control( 'features', [ 'label' => 'Features (One per line)', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => "Feature 1\nFeature 2" ] );
        $this->add_control( 'button_text', [ 'label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Buy Now' ] );
        $this->add_control( 'is_featured', [ 'label' => 'Is Featured?', 'type' => \Elementor\Controls_Manager::SWITCHER ] );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $features = explode("\n", $settings['features']);
        $featured_class = $settings['is_featured'] ? 'border-color: #997a3d; transform: scale(1.05);' : '';
        ?>
        <div class="benefit-item" style="text-align: center; <?php echo $featured_class; ?>">
            <h4 style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 2px; color: #997a3d;"><?php echo esc_html($settings['title']); ?></h4>
            <div style="font-size: 3rem; font-weight: 700; color: #1a1a1a; margin: 1rem 0;"><?php echo esc_html($settings['price']); ?></div>
            <ul style="list-style: none; padding: 0; margin: 2rem 0; text-align: left;">
                <?php foreach($features as $feature): ?>
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee; font-size: 0.9rem; color: #666;">
                        <i class="fas fa-check" style="color: #997a3d; margin-right: 10px;"></i> <?php echo esc_html($feature); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a href="#" class="btn btn-primary" style="width: 100%;"><?php echo esc_html($settings['button_text']); ?></a>
        </div>
        <?php
    }
}

/**
 * 3. Team Member Widget
 */
class BB_Team_Member_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_team_member'; }
    public function get_title() { return 'BB Team Member'; }
    public function get_icon() { return 'eicon-person'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }

    protected function register_controls() {
        $this->start_controls_section( 'content', [ 'label' => 'Member', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
        $this->add_control( 'image', [ 'label' => 'Photo', 'type' => \Elementor\Controls_Manager::MEDIA ] );
        $this->add_control( 'name', [ 'label' => 'Name', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Jane Doe' ] );
        $this->add_control( 'role', [ 'label' => 'Position', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Founder' ] );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="variant-card" style="flex-direction: column; text-align: center;">
            <div style="width: 100%; height: 300px; overflow: hidden;">
                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'large', 'image' ); ?>
            </div>
            <div style="padding: 2rem;">
                <h4 style="color: #997a3d;"><?php echo esc_html($settings['name']); ?></h4>
                <p style="text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px; margin-bottom: 0;"><?php echo esc_html($settings['role']); ?></p>
            </div>
        </div>
        <?php
    }
}

/**
 * 4. Content Split (Image Left/Right)
 */
class BB_Content_Split_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_content_split'; }
    public function get_title() { return 'BB Content Split'; }
    public function get_icon() { return 'eicon-h-align-stretch'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }

    protected function register_controls() {
        $this->start_controls_section( 'content', [ 'label' => 'Content', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
        $this->add_control( 'title', [ 'label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Our Philosophy' ] );
        $this->add_control( 'text', [ 'label' => 'Text', 'type' => \Elementor\Controls_Manager::WYSIWYG, 'default' => 'Content goes here...' ] );
        $this->add_control( 'image', [ 'label' => 'Image', 'type' => \Elementor\Controls_Manager::MEDIA ] );
        $this->add_control( 'image_position', [ 'label' => 'Image Position', 'type' => \Elementor\Controls_Manager::SELECT, 'options' => ['left'=>'Left', 'right'=>'Right'], 'default' => 'left' ] );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $grid_style = $settings['image_position'] === 'right' ? 'grid-template-columns: 1fr 1fr;' : 'grid-template-columns: 1fr 1fr; direction: rtl;';
        $text_style = $settings['image_position'] === 'right' ? '' : 'direction: ltr;';
        ?>
        <div class="introduction" style="padding: 4rem 0;">
            <div class="container">
                <div class="intro-grid" style="<?php echo $grid_style; ?>">
                    <div class="intro-content" style="<?php echo $text_style; ?>">
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                        <div class="desc"><?php echo $settings['text']; ?></div>
                    </div>
                    <div class="intro-image" style="direction: ltr;">
                         <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'large', 'image' ); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

/**
 * 5. Logo Grid
 */
class BB_Logo_Grid_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_logo_grid'; }
    public function get_title() { return 'BB Logo Grid'; }
    public function get_icon() { return 'eicon-gallery-grid'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }

    protected function register_controls() {
        $this->start_controls_section( 'content', [ 'label' => 'Logos', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control( 'logo', [ 'label' => 'Logo', 'type' => \Elementor\Controls_Manager::MEDIA ] );
        $this->add_control( 'logos', [ 'label' => 'Logos', 'type' => \Elementor\Controls_Manager::REPEATER, 'fields' => $repeater->get_controls() ] );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="container" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 4rem; padding: 4rem 0; opacity: 0.6;">
            <?php foreach($settings['logos'] as $item): ?>
                <div class="logo-item" style="max-width: 150px; filter: grayscale(100%); transition: 0.3s;">
                     <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, 'medium', 'logo' ); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

/**
 * 6. Newsletter Signup
 */
class BB_Newsletter_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_newsletter'; }
    public function get_title() { return 'BB Newsletter'; }
    public function get_icon() { return 'eicon-mail'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }

    protected function register_controls() { } // Minimal controls for demo

    protected function render() {
        ?>
        <div class="purchase-section" style="text-align: center;">
            <div class="container" style="max-width: 600px;">
                <h3 style="color: #fff;">Join the Club</h3>
                <p>Exclusive offers for members.</p>
                <form style="display: flex; gap: 10px; margin-top: 2rem;">
                    <input type="email" placeholder="Enter email address" style="flex: 1; padding: 1rem; border: none; border-radius: 4px;">
                    <button class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
        <?php
    }
}

/**
 * 7. Process Timeline
 */
class BB_Process_Timeline_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_process'; }
    public function get_title() { return 'BB Process Timeline'; }
    public function get_icon() { return 'eicon-history'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }
    
    // Simplified rendering for brevity - vertical list of steps
    protected function render() { echo '<div class="purchase-steps">Placeholder for Timeline</div>'; }
}

/**
 * 8. Simple Stat Counter
 */
class BB_Stat_Counter_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_stat_counter'; }
    public function get_title() { return 'BB Stat Counter'; }
    public function get_icon() { return 'eicon-counter'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }
    
    protected function register_controls() {
         $this->start_controls_section( 'content', [ 'label' => 'Stat', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ] );
         $this->add_control( 'number', [ 'label' => 'Number', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '500+' ] );
         $this->add_control( 'label', [ 'label' => 'Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Happy Customers' ] );
         $this->end_controls_section();
    }
    
    protected function render() { 
        $settings = $this->get_settings_for_display();
        echo '<div style="text-align: center;"><div class="stat-number">' . esc_html($settings['number']) . '</div><div class="stat-label">'. esc_html($settings['label']) . '</div></div>'; 
    }
}

/**
 * 9. Video Popup (Custom Image with Play Button)
 */
class BB_Video_Popup_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_video_popup'; }
    public function get_title() { return 'BB Video Popup'; }
    public function get_icon() { return 'eicon-play'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }
     
    protected function render() { echo '<div style="background: #000; height: 300px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-play" style="color: #997a3d; font-size: 3rem;"></i></div>'; }
}

/**
 * 10. CTA Strip (Slim)
 */
class BB_CTA_Strip_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'bb_cta_strip'; }
    public function get_title() { return 'BB CTA Strip'; }
    public function get_icon() { return 'eicon-call-to-action'; }
    public function get_categories() { return [ 'bb-theme-widgets' ]; }
     
    protected function render() { echo '<div style="background: #997a3d; padding: 2rem; display: flex; justify-content: space-between; align-items: center; color: #fff;"><h3 style="margin:0; color: #fff;">Limited Time Offer</h3><a href="#" class="btn" style="background: #fff; color: #997a3d;">Shop Now</a></div>'; }
}
