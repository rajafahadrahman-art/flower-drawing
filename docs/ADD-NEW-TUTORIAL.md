# Add a New Flower Tutorial

This guide explains how to publish a new Flower Tutorial without editing the theme structure.

## 1. Create the post

1. In WordPress admin, open **Flower Tutorials → Add New**.
2. Set the title to the flower name readers should see.
3. Set the permalink slug to the focus-keyword slug only.

Examples:

- `rose-drawing`
- `sunflower-drawing`
- `hibiscus-flower-drawing`
- `tulip-drawing`

Final URL format:

`https://flowerdrawings.com/flower-drawing/{focus-keyword-slug}/`

Rules:

- lowercase only
- hyphen-separated words
- one main URL per flower intent
- do not create competing URLs such as `easy-rose-drawing` or `simple-rose-drawing`

## 2. Add tutorial metadata

In the Flower Tutorial meta box, fill in:

- **Focus Keyword** — exact primary phrase (example: `rose drawing`)
- **SEO Title** — optional custom title
- **Meta Description** — optional custom description
- **Difficulty** — Easy, Beginner, or Intermediate
- **Tutorial Time** — short estimate such as `15 minutes`
- **Step Count** — number of visible steps
- **Worksheet WebP URL** — preview image URL
- **Worksheet PDF URL** — downloadable PDF URL
- **Featured Image Alt** — short exact phrase (example: `rose drawing`)
- **Featured Image Title** — short exact phrase (example: `easy rose drawing`)

## 3. Upload step images

Store tutorial images under the theme or media library using this convention:

```text
assets/images/flower-drawing/{post-slug}/
├── {post-slug}.webp
├── {post-slug}-step-1.webp
├── {post-slug}-step-2.webp
└── ...
```

Example for Rose:

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

Use `.webp` only.

## 4. Set the featured image

- The completed final-step image must also be the featured image.
- For Rose, featured file is `rose-drawing.webp`.
- Do not upload a second duplicate file for the final step and featured image.
- Use the same source for both references.

Suggested featured attributes:

- Alt: `rose drawing`
- Title: `easy rose drawing`

## 5. Write the tutorial content

Use the block editor and/or the Flower Tutorial block pattern.

Include:

- short introduction
- completed final image reference
- numbered step sections with images
- practice tips
- optional FAQ blocks

## 6. Add worksheet files

1. Upload worksheet WebP and PDF to the Media Library (or theme downloads folder for site-wide assets).
2. Paste the WebP and PDF URLs into the tutorial meta fields.
3. Publish and confirm the single tutorial worksheet card appears.

## 7. Final checks

1. Permalink is `/flower-drawing/{slug}/`.
2. Featured image loads once as the final image.
3. Difficulty and step count appear on cards.
4. Worksheet download and print links work.
5. SEO title and meta description are correct if no SEO plugin overrides them.
6. Archive page `/flower-drawing/` lists the new tutorial automatically.
