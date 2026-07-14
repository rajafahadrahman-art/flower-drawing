# FlowerDrawings.com Installation Guide

Installable packages:

- `dist/flowerdrawings-core.zip`
- `dist/flowerdrawings-child.zip`

## Installation order

1. Install and activate the **Kadence** parent theme.
2. Upload and activate `flowerdrawings-core.zip`.
3. Upload and activate `flowerdrawings-child.zip`.
4. Go to **Settings → Permalinks** and click **Save** once.
5. Verify the homepage at `/`.
6. Verify the tutorial archive at `/flower-drawing/`.
7. Set the public site URL to `https://flowerdrawings.com`.
8. Confirm the contact email is `ale298784@gmail.com`.
9. Test worksheet download and print buttons.
10. Clear cache if a caching plugin is active.

## After install checks

- Header logo, footer logo, favicon, and site icon all use the supplied logo artwork.
- Homepage SEO title and meta description match the supplied source exactly.
- FAQ accordion is keyboard accessible.
- Mobile navigation works at 320px width with no horizontal overflow.
- `/flower-drawing/{slug}/` is ready for future Flower Tutorial posts.

## Adding tutorials

See `docs/ADD-NEW-TUTORIAL.md`.

## Package notes

- The child-theme ZIP contains the `flowerdrawings-child/` folder at its root.
- The plugin ZIP contains the `flowerdrawings-core/` folder at its root.
- Flush rewrite rules only by saving permalinks or by activating/deactivating the core plugin.
