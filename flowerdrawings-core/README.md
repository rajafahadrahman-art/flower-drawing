# FlowerDrawings Core

Site-specific WordPress plugin for FlowerDrawings.com.

## What it does

- Registers the `flower_tutorial` custom post type.
- Provides the fixed archive URL `/flower-drawing/`.
- Provides single tutorial URLs in the form `/flower-drawing/{post-slug}/`.
- Registers tutorial metadata for SEO, difficulty, timing, step count, worksheet URLs, and featured image attributes.
- Adds an admin meta box for editing tutorial metadata.
- Adds readable tutorial columns in the WordPress admin list table.
- Registers the `flowerdrawings` block pattern category and a reusable Flower Tutorial Structure pattern.

## Requirements

- WordPress 6.5 or newer.
- PHP 8.1 or newer.
- A theme that provides the front-end templates for `archive-flower_tutorial.php` and `single-flower_tutorial.php`.

## Custom post type

Post type key:

```text
flower_tutorial
```

Archive:

```text
/flower-drawing/
```

Single tutorial:

```text
/flower-drawing/{focus-keyword-slug}/
```

Supported editor features:

- Title
- Block editor content
- Featured image
- Excerpt
- Revisions
- Author
- Custom fields

## Registered metadata

The plugin registers these post meta keys for `flower_tutorial` posts:

| Key | Type | Notes |
| --- | --- | --- |
| `focus_keyword` | string | Primary exact-match keyword for the tutorial. |
| `seo_title` | string | Optional SEO title for theme-level metadata. |
| `meta_description` | string | Optional SEO meta description. |
| `tutorial_difficulty` | string | Allowed values: `Easy`, `Beginner`, `Intermediate`. |
| `tutorial_time` | string | Short time estimate, such as `15 minutes`. |
| `tutorial_step_count` | integer | Number of visible tutorial steps. |
| `worksheet_webp` | URL string | Worksheet preview image URL. |
| `worksheet_pdf` | URL string | Downloadable worksheet PDF URL. |
| `featured_image_alt` | string | Alt text for the final tutorial image. |
| `featured_image_title` | string | Title attribute for the final tutorial image. |

## Security

Admin metadata saves use:

- A WordPress nonce.
- `edit_post` capability checks.
- Autosave and revision guards.
- Field-specific sanitization.
- Escaped admin output.

## Rewrite rules

Rewrite rules are flushed only on plugin activation and deactivation.

The plugin does not flush rewrite rules on normal requests.

## Uninstall behavior

On uninstall, the plugin removes its stored version option only.

It does not delete Flower Tutorial posts, post meta, media files, or worksheet files by default because those are site-owned content.

## Installation

1. Upload `flowerdrawings-core` to `wp-content/plugins/`.
2. Activate **FlowerDrawings Core** in the WordPress admin.
3. Save WordPress permalinks once after first installation if the archive URL does not resolve immediately.
4. Confirm `/flower-drawing/` loads the tutorial archive.
