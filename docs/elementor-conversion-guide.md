# BB Cigarettes - WordPress Elementor Conversion Guide

## Overview

This guide provides step-by-step instructions to convert the BB Cigarettes static HTML website to WordPress using Elementor.

---

## Prerequisites

### Required Software
- WordPress 6.0+ installation
- Elementor Pro (recommended) or Free version
- FTP access or hosting file manager

### Recommended Plugins
1. **Elementor** - Page builder
2. **Elementor Pro** - Advanced features (recommended)
3. **Yoast SEO** or **Rank Math** - SEO management
4. **WP Rocket** or **LiteSpeed Cache** - Performance
5. **UpdraftPlus** - Backups

---

## Theme Selection

### Recommended Themes (Elementor-Compatible)
1. **Hello Elementor** (Free) - Minimal, fast, built for Elementor
2. **Astra** (Free/Pro) - Lightweight with many options
3. **OceanWP** (Free/Pro) - Feature-rich starter theme
4. **Neve** (Free/Pro) - Fast and flexible

### Theme Setup
1. Install WordPress on your hosting
2. Go to Appearance → Themes → Add New
3. Search for "Hello Elementor" and Install
4. Activate the theme
5. Install Elementor plugin

---

## Site Structure in WordPress

### Pages to Create
| Static File | WordPress Page |
|-------------|----------------|
| index.html | Home (Front Page) |
| bb-full-flavor.html | BB Full Flavor |
| bb-lights.html | BB Lights Cigarettes |
| bb-menthol.html | BB Menthol Cigarettes |
| buy-bb-cigarettes-online.html | Buy BB Cigarettes Online |

### Menu Structure
```
Primary Menu:
├── About (anchor: #about)
├── Quality (anchor: #quality)
├── Products (anchor: #products)
├── FAQ (anchor: #faq)
└── Buy Now (link to Buy Online page)
```

---

## Step-by-Step Conversion

### Step 1: Upload Media Files
1. Go to Media → Add New
2. Upload all images from the `images/` folder:
   - hero-product.png
   - intro-detail.png
   - tobacco-blend.png
   - full-flavor-pack.png
   - lights-pack.png
   - menthol-pack.png
   - online-order.png

### Step 2: Create Global Colors in Elementor
Go to Elementor → Site Settings → Global Colors
```
Primary: #c9a962 (Gold)
Secondary: #0a0a0a (Black)
Text: #f5f5f5 (Off-White)
Accent: #1a1a1a (Charcoal)
```

### Step 3: Create Global Fonts
Go to Elementor → Site Settings → Global Fonts
```
Primary (Headings): Cormorant Garamond, serif
Secondary (Body): Inter, sans-serif
```

### Step 4: Create Header/Footer Templates

#### Header Template
1. Go to Templates → Theme Builder → Header
2. Add Header template
3. Add Container with:
   - Site Logo (BB text + tagline)
   - Navigation Menu
   - Button (Buy Now CTA)
4. Set sticky position
5. Add scroll effect (background changes)

#### Footer Template
1. Go to Templates → Theme Builder → Footer
2. Create 4-column grid:
   - Column 1: Logo + description
   - Column 2: Quick Links
   - Column 3: Products
   - Column 4: Information
3. Add 18+ notice section
4. Add copyright row

### Step 5: Create Homepage

#### Sections to Build
1. **Hero Section**
   - Container: 2-column layout
   - Left: Heading, text, buttons
   - Right: Product image
   - Background: Gradient

2. **Introduction Section**
   - Container with 2-column grid
   - Left: Content + feature boxes
   - Right: Image

3. **Brand Section**
   - Centered text container
   - 3-column stats row

4. **Quality Section**
   - 2-column reversed layout
   - Left: Image
   - Right: Content + bullet list

5. **Product Variants**
   - Centered header
   - 3-column cards (use Posts widget or Inner Sections)

6. **Benefits Section**
   - Centered header
   - 6-item grid (3x2)

7. **Purchase Section**
   - 2-column layout
   - Steps with icons

8. **FAQ Section**
   - 2-column FAQ cards
   - Or use Accordion widget

9. **Final CTA**
   - Centered container
   - Heading + CTA button

### Step 6: Create Product Pages Template

1. Go to Templates → Saved Templates → Add New
2. Create "Product Page" template
3. Structure:
   - Breadcrumb
   - Product Hero (2-column)
   - Product Details (2-column)
   - Other Variants (2-column cards)
   - Final CTA

4. Save and use for all 3 product pages

### Step 7: Create Buy Online Page

Follow same structure as static page:
- Hero with features
- 3 product cards
- How to order steps
- 6 benefits grid
- Final CTA

---

## SEO Setup

### Yoast/RankMath Configuration

#### Homepage
- Focus Keyphrase: BB Cigarettes
- SEO Title: BB Cigarettes | Premium Smoking Experience | Buy Online in Canada
- Meta Description: (copy from index.html)

#### Product Pages
- BB Full Flavor: Focus on "BB Full Flavor"
- BB Lights: Focus on "BB Lights Cigarettes"
- BB Menthol: Focus on "BB Menthol Cigarettes"

#### Buy Online Page
- Focus: "Buy BB Cigarettes Online"

### Schema Markup
1. Install **Schema Pro** or **Rank Math** (has built-in schema)
2. Configure:
   - Organization schema (site-wide)
   - Product schema (product pages)
   - FAQ schema (homepage FAQ section)

### XML Sitemap
Yoast/RankMath auto-generates sitemap at:
`https://yourdomain.com/sitemap_index.xml`

---

## Custom CSS

Add to Appearance → Customize → Additional CSS:

```css
/* BB Cigarettes Custom Styles */
:root {
    --bb-gold: #c9a962;
    --bb-black: #0a0a0a;
    --bb-charcoal: #1a1a1a;
}

/* Section labels */
.bb-section-label {
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--bb-gold);
    padding-left: 2rem;
    position: relative;
}

.bb-section-label::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 1.5rem;
    height: 1px;
    background: var(--bb-gold);
}

/* Gold buttons */
.bb-btn-gold {
    background: linear-gradient(135deg, #c9a962 0%, #a88a45 100%);
    color: #0a0a0a;
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
}

.bb-btn-gold:hover {
    background: linear-gradient(135deg, #d4b97a 0%, #c9a962 100%);
    transform: translateY(-2px);
}
```

---

## Performance Optimization

1. **Enable caching** via WP Rocket or LiteSpeed
2. **Optimize images** with ShortPixel or Imagify
3. **Minify CSS/JS** through cache plugin
4. **Enable lazy loading** for images
5. **Use CDN** (Cloudflare recommended)

---

## Age Verification Popup

### Plugin Option
Install **Age Gate** or **Age Verification** plugin

### Manual Option (Elementor Pro)
1. Create Popup template
2. Design age verification modal
3. Set trigger: On page load
4. Add display conditions: Entire Site
5. Use cookies to remember verification

---

## Checklist

- [ ] WordPress installed with Hello Elementor theme
- [ ] Elementor (Pro) installed and activated
- [ ] All images uploaded to Media Library
- [ ] Global colors and fonts configured
- [ ] Header template created
- [ ] Footer template created
- [ ] Homepage built with all sections
- [ ] 3 product pages created
- [ ] Buy Online page created
- [ ] Menu configured
- [ ] SEO plugin configured with meta tags
- [ ] Schema markup implemented
- [ ] Age verification popup added
- [ ] SSL certificate installed (HTTPS)
- [ ] Sitemap submitted to Google Search Console
- [ ] Performance optimization applied

---

## Support Resources

- [Elementor Documentation](https://elementor.com/help/)
- [Yoast SEO Guide](https://yoast.com/wordpress/plugins/seo/)
- [WordPress Tutorials](https://learn.wordpress.org/)
