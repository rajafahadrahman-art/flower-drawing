# AGENTS.md — FlowerDrawings.com

This file defines the permanent rules for every AI agent, Cursor session, and code change in this repository.

## 1. Project identity

- **Website:** FlowerDrawings.com
- **Production URL:** `https://flowerdrawings.com`
- **Public email:** `ale298784@gmail.com`
- **Audience:** US-focused beginners, students, kids, teachers, hobby artists, and users looking for printable flower drawing worksheets.
- **Phase 1 goal:** Build a complete, fast, elegant WordPress landing site that is ready for new flower tutorial posts to be added one by one.
- **Long-term goal:** Add an interactive drawing tool later without rebuilding the site architecture.

## 2. Architecture is locked

The website must run on WordPress.

Do **not** create a Next.js runtime application.

Build a modern, Next.js-inspired interface using:

1. A Kadence child theme named `flowerdrawings-child`.
2. A site-specific WordPress plugin named `flowerdrawings-core`.
3. PHP template parts, modern CSS, and lightweight vanilla JavaScript.
4. The WordPress block editor and REST API where useful.

The parent Kadence theme is installed separately.

The plugin owns the Flower Tutorial custom post type and permalink rules. The theme owns presentation. Do not place permanent content-model logic inside the theme.

## 3. Never change supplied content

The homepage content is immutable.

Primary source:

`https://docs.google.com/document/d/1vhxJI6RCFhTgEhC1YBubhIHBzhw7ftMLIoAMvTvHilc/edit?usp=sharing`

Local fallback and repository source of truth:

`Pasted text(30).txt`

When the Google Doc and local file differ, use the local file.

Never rewrite, correct, shorten, expand, summarize, reorder, or improve:

- SEO title
- Meta description
- H1, H2, and H3 headings
- Paragraphs
- Lists
- FAQs
- Button labels
- Exact-match keywords
- Grammar or punctuation

Do not silently fix awkward wording or grammar. The user has intentionally edited the content.

Allowed transformations only:

- Convert headings to semantic HTML.
- Convert plain lists to HTML lists.
- Convert `Button: LABEL` lines into working buttons without changing the label.
- Add wrappers required for layout.
- Add accessibility attributes.
- Add schema that exactly matches visible content.

Keep the original content order.

## 4. Design system

The site must feel premium, modern, editorial, interactive, and lightweight.

### Primary visual direction

- Black and white are the dominant colors.
- Use soft off-white and light gray cards.
- Use thin borders, generous whitespace, and restrained shadows.
- Use a light sage accent for worksheet/download buttons.
- Use a soft blush accent sparingly.
- Avoid heavy gradients, glassmorphism overload, oversized typography, and crowded layouts.

### Color tokens

```css
--color-ink: #111111;
--color-background: #ffffff;
--color-surface: #f6f6f3;
--color-surface-strong: #ecece7;
--color-border: #d8d8d2;
--color-muted: #64645f;
--color-sage-light: #e4eee5;
--color-sage: #819a89;
--color-blush-light: #f6e2de;
--color-blush: #d98278;
```

### Layout rules

- Mobile-first.
- Maximum main content width: `1200px–1280px`.
- Reading width for long text: approximately `700px–760px`.
- Use card and bento-style layouts where they improve comprehension.
- Use `clamp()` for fluid typography and spacing.
- Minimum interactive target: `44px × 44px`.
- No horizontal overflow at any supported width.

### Typography

- Use system font stacks only.
- Do not load Google Fonts or remote fonts.
- Keep body text readable and editorial.
- Avoid excessively bold or oversized headings.

## 5. Uploaded assets

The repository contains these source files:

- `Flower Drawing.webp`
- `Flower Drawings hero Banner.webp`
- `Flower drawing worksheer.webp`
- `flowerdrawinglogo.webp`

Do not redesign, recolor, crop, regenerate, or add text to them.

Copy and rename them to:

```text
flowerdrawings-child/assets/images/brand/flowerdrawings-logo.webp
flowerdrawings-child/assets/images/flower-drawing/home/flower-drawing-hero.webp
flowerdrawings-child/assets/images/flower-drawing/home/flower-drawing.webp
flowerdrawings-child/assets/downloads/flower-drawing-worksheet.webp
flowerdrawings-child/assets/downloads/flower-drawing-worksheet.pdf
```

Generate these favicon files from the supplied square logo:

```text
flowerdrawings-child/assets/icons/site-icon-512.png
flowerdrawings-child/assets/icons/apple-touch-icon.png
flowerdrawings-child/assets/icons/favicon-32x32.png
flowerdrawings-child/assets/icons/favicon-16x16.png
flowerdrawings-child/assets/icons/favicon.ico
```

The header logo, footer logo, WordPress site icon, Apple touch icon, and favicon must all use the same supplied logo artwork.

Create the worksheet PDF at exact A4 portrait proportions without stretching or cropping.

## 6. Image SEO rules

Use short, accurate exact-match phrases only when those phrases already exist in the visible page content.

Never keyword-stuff alt text.

Each image gets one concise alt phrase.

### Homepage assets

Hero image:

- File: `flower-drawing-hero.webp`
- Alt: `simple flower drawing`
- Title: `flower drawing easy`
- Loading: eager
- Fetch priority: high

Completed homepage drawing:

- File: `flower-drawing.webp`
- Alt: `flower drawing`
- Title: `easy flower drawing`

Worksheet:

- File: `flower-drawing-worksheet.webp`
- Alt: `flower drawing worksheets`
- Title: `download practice worksheets`

Logo:

- Alt: `FlowerDrawings.com`

Always include explicit image dimensions. Lazy-load below-the-fold images. Never use the hero as a CSS background.

## 7. Future tutorial image convention

Every flower tutorial uses this folder pattern:

```text
assets/images/flower-drawing/{post-slug}/
```

Example:

```text
assets/images/flower-drawing/rose-drawing/
├── rose-drawing.webp
├── rose-drawing-step-1.webp
├── rose-drawing-step-2.webp
├── rose-drawing-step-3.webp
├── rose-drawing-step-4.webp
├── rose-drawing-step-5.webp
├── rose-drawing-step-6.webp
├── rose-drawing-step-7.webp
├── rose-drawing-step-8.webp
└── rose-drawing-step-9.webp
```

Use `.webp`, never `.web`.

The completed final step image must also be the featured image.

Example for Rose:

- Featured file: `rose-drawing.webp`
- Featured alt: `rose drawing`
- Featured title: `easy rose drawing`

Do not create duplicate physical files for the final step and featured image.

## 8. Permalinks are fixed

Register the custom post type in `flowerdrawings-core`:

- Post type key: `flower_tutorial`
- Archive slug: `flower-drawing`
- REST API: enabled
- Block editor: enabled

Archive URL:

`https://flowerdrawings.com/flower-drawing/`

Single tutorial URL:

`https://flowerdrawings.com/flower-drawing/{focus-keyword-slug}/`

Examples:

- `/flower-drawing/rose-drawing/`
- `/flower-drawing/sunflower-drawing/`
- `/flower-drawing/hibiscus-flower-drawing/`
- `/flower-drawing/tulip-drawing/`

Rules:

- Lowercase only.
- Hyphen-separated words.
- Never use `/FlowerDrawing/`.
- Never create competing same-intent URLs such as `/easy-rose-drawing/` or `/simple-rose-drawing/`.
- Flush rewrite rules only on plugin activation or deactivation, never on normal requests.

## 9. Required project structure

### Child theme

```text
flowerdrawings-child/
├── style.css
├── functions.php
├── theme.json
├── front-page.php
├── header.php
├── footer.php
├── index.php
├── archive-flower_tutorial.php
├── single-flower_tutorial.php
├── search.php
├── 404.php
├── screenshot.png
├── README.md
├── assets/
│   ├── css/
│   ├── js/
│   ├── images/
│   ├── downloads/
│   └── icons/
├── inc/
├── template-parts/
│   ├── homepage/
│   └── tutorial/
└── scripts/
```

Theme header:

```css
Theme Name: FlowerDrawings Child
Template: kadence
Text Domain: flowerdrawings
Version: 1.0.0
```

Show a clear admin notice when Kadence is missing.

### Core plugin

```text
flowerdrawings-core/
├── flowerdrawings-core.php
├── uninstall.php
├── README.md
├── includes/
└── patterns/
```

The plugin must register:

- Flower Tutorials custom post type
- Archive and permalink logic
- Tutorial metadata fields
- Admin columns
- A reusable tutorial block pattern

Supported fields:

- `focus_keyword`
- `seo_title`
- `meta_description`
- `tutorial_difficulty`
- `tutorial_time`
- `tutorial_step_count`
- `worksheet_webp`
- `worksheet_pdf`
- `featured_image_alt`
- `featured_image_title`

Use nonces, capability checks, sanitization, and escaping.

## 10. Homepage requirements

The homepage must use the supplied content in its exact original order.

### Required sections

1. Hero banner
2. Homepage introduction
3. Explore Easy Flower Drawing Tutorial
4. How to Draw a Flower Step by Step
5. Simple Flower Drawing Ideas to Practice
6. Flower Drawing for Beginners
7. From Basic Shapes to a Beautiful Flower Drawing
8. Sketching Flowers with Pencil
9. Download Worksheets for Practice
10. Skill-level cards
11. Drawing tips
12. Explore More Easy Flowers Drawing Ideas
13. FAQ
14. Final CTA

### Layout behavior

- Use the supplied hero image without cropping.
- Use the completed flower drawing prominently in the tutorial section.
- Render drawing steps as interactive cards.
- Render idea sections as a bento/card grid.
- Render FAQs as accessible accordions.
- Render the tutorial collection dynamically from `flower_tutorial` posts.
- If there are no tutorial posts, hide only the empty grid. Do not invent cards or fake tutorials.
- Keep the worksheet preview large and readable.
- The worksheet section must use `id="worksheets"`.
- The FAQ section must use `id="faq"`.

### Button destinations

Keep labels exactly as supplied and map them as follows:

- `Explore Drawing Tutorials` → `/flower-drawing/`
- `Download Practice Worksheets` → worksheet PDF with download behavior
- `View Step-by-Step Drawing Guides` → `/flower-drawing/`
- `Browse Drawing Worksheets` → worksheet PDF with download behavior
- `Print a Practice Page` → open worksheet PDF in a new tab
- `View All Flower Tutorials` → `/flower-drawing/`
- `Start Drawing` → `/flower-drawing/`
- `View Practice Worksheets` → `#worksheets`

Do not rename buttons.

## 11. Header and footer

### Header

- Sticky, compact, premium.
- White translucent background with subtle blur.
- Thin bottom border.
- Logo on the left.
- Navigation and a light-sage Worksheets button.

Navigation:

- Home → `/`
- Drawing Tutorials → `/flower-drawing/`
- Worksheets → `/#worksheets`
- FAQ → `/#faq`
- Contact → `mailto:ale298784@gmail.com`

Mobile menu requirements:

- Accessible menu button.
- Correct `aria-expanded` state.
- Close on Escape.
- Lock body scroll while open.
- Work without layout overflow.

### Footer

Include:

- Supplied logo
- FlowerDrawings.com
- Home
- Drawing Tutorials
- Worksheets
- FAQ
- Contact email
- Dynamic copyright year
- Accessible back-to-top button

Do not invent a long brand biography.

## 12. Tutorial archive and single template

### Archive

`archive-flower_tutorial.php` must include:

- Clean heading
- Responsive tutorial grid
- Featured final-step image
- Difficulty
- Step count
- Excerpt
- Pagination
- Search/filter-ready markup for the future drawing tool
- Honest empty state without fake posts

Do not write archive copy that competes with the homepage keyword target.

### Single tutorial

`single-flower_tutorial.php` must include:

- Breadcrumbs
- H1
- Tutorial metadata cards
- Featured/final image
- Main editor content
- Step-by-step image sections
- Worksheet download card
- FAQs when present
- Related tutorials
- Previous/next navigation

Future-tool hooks:

```php
do_action( 'flowerdrawings_before_tutorial_content' );
do_action( 'flowerdrawings_after_tutorial_content' );
do_action( 'flowerdrawings_before_worksheet' );
do_action( 'flowerdrawings_after_worksheet' );
```

Create an inactive template part:

`template-parts/tutorial/drawing-tool-shell.php`

Do not show a public “coming soon” tool message.

## 13. SEO rules

Homepage title and meta description must exactly match the supplied source.

Provide basic SEO only when an SEO plugin is not active.

Detect common SEO plugins and avoid duplicate metadata:

- Yoast SEO
- Rank Math
- All in One SEO

Required output when no SEO plugin handles it:

- Canonical URL
- Meta description
- Open Graph title
- Open Graph description
- Open Graph image
- Twitter card metadata
- WebSite JSON-LD
- WebPage JSON-LD
- FAQPage JSON-LD matching visible FAQs exactly

Do not add:

- Product schema
- Course schema
- Review schema
- SoftwareApplication schema
- Hidden FAQ schema

Use WordPress native sitemap and robots compatibility.

## 14. Accessibility

Aim for WCAG 2.2 AA.

Required:

- Skip-to-content link
- Semantic landmarks
- Correct heading hierarchy
- Visible focus states
- Keyboard-accessible accordion
- Keyboard-accessible mobile menu
- Accurate alt text
- Sufficient contrast
- Reduced-motion support
- Meaningful links
- 44px minimum touch targets

The site must remain usable when JavaScript is disabled.

## 15. Performance

Targets:

- Lighthouse Performance: 90+
- Accessibility: 95+
- Best Practices: 95+
- SEO: 95+

Rules:

- No page builder dependency.
- No React runtime.
- No jQuery for new interactions.
- No GSAP, Framer Motion, heavy sliders, parallax, or autoplay carousels.
- Use vanilla JavaScript and IntersectionObserver.
- Keep animations subtle and under approximately 250ms.
- Defer non-critical scripts.
- Use explicit image dimensions.
- Lazy-load below-the-fold images.
- Prioritize the hero image.
- Avoid layout shifts.
- Avoid external render-blocking resources.

## 16. WordPress coding standards

Prefix all project functions, classes, hooks, options, and handles with:

`flowerdrawings_`

Use:

- `esc_html()`
- `esc_attr()`
- `esc_url()`
- `wp_kses_post()`
- `sanitize_text_field()`
- `sanitize_textarea_field()`
- `wp_nonce_field()`
- `check_admin_referer()`
- Capability checks

Never hardcode localhost URLs.

Use WordPress URL helpers such as:

- `home_url()`
- `get_stylesheet_directory_uri()`
- `plugin_dir_url()`
- `wp_upload_dir()`

Compatibility:

- WordPress 6.5+
- PHP 8.1+
- Current Chrome, Safari, Firefox, and Edge

## 17. Responsive validation

Test at:

- 320px
- 360px
- 390px
- 430px
- 768px
- 1024px
- 1280px
- 1440px
- 1920px

Must have:

- No horizontal scrolling
- No cropped hero text
- No cropped worksheet content
- No overlapping navigation
- No cut-off buttons
- Readable body text
- Natural card stacking
- Correct image aspect ratios
- Usable mobile header

## 18. Installation artifacts

Always build:

```text
dist/flowerdrawings-child.zip
dist/flowerdrawings-core.zip
README-INSTALL.md
```

ZIP rules:

- The child-theme ZIP contains the theme folder at its root.
- The plugin ZIP contains the plugin folder at its root.
- Do not create unnecessary nested wrapper folders.

Installation order:

1. Install and activate Kadence.
2. Upload and activate `flowerdrawings-core.zip`.
3. Upload and activate `flowerdrawings-child.zip`.
4. Save WordPress permalinks once.
5. Verify `/` and `/flower-drawing/`.
6. Test worksheet download and print actions.
7. Verify favicon, site icon, header logo, and footer logo.

## 19. Required documentation

Maintain:

- `README-INSTALL.md`
- `docs/ADD-NEW-TUTORIAL.md`
- Theme README
- Plugin README

`docs/ADD-NEW-TUTORIAL.md` must explain:

- Creating a Flower Tutorial post
- Setting the focus keyword slug
- Uploading step images
- Using the final step as the featured image
- Adding worksheet WebP and PDF files
- Setting SEO title and meta description
- Setting alt and title attributes
- Checking the final permalink

## 20. Validation before completion

Before declaring a task complete:

1. Validate every PHP file with `php -l`.
2. Check all includes and file paths.
3. Check JavaScript for console errors.
4. Check CSS asset paths.
5. Verify all supplied homepage images load.
6. Verify logo and favicon assets load.
7. Verify worksheet WebP and PDF downloads.
8. Verify print action opens the PDF.
9. Compare homepage text with `Pasted text(30).txt`.
10. Confirm no supplied content changed.
11. Confirm title and meta description are exact.
12. Confirm FAQ schema matches visible FAQs.
13. Confirm no duplicate SEO metadata.
14. Confirm `/flower-drawing/` works.
15. Confirm single tutorial permalinks use `/flower-drawing/{slug}/`.
16. Test the site at 320px and all required breakpoints.
17. Confirm no horizontal overflow.
18. Confirm all buttons work.
19. Confirm image alt and title values are correct.
20. Confirm both ZIP packages install correctly.
21. Provide a final file tree and installation summary.

## 21. Agent behavior

When working in this repository:

- Inspect existing files before editing.
- Preserve working code unless a change is necessary.
- Make the smallest safe change that solves the request.
- Do not replace the chosen architecture.
- Do not add dependencies without a clear need.
- Do not invent posts, testimonials, reviews, traffic claims, qualifications, or statistics.
- Do not alter the user's SEO keyword strategy.
- Do not create new URLs that cause cannibalization.
- Do not stop after mockups or partial snippets when the task asks for working files.
- Do not claim validation passed unless it was actually run.
- Keep all code production-ready, secure, maintainable, and documented.

