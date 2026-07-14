# FlowerDrawings Child Theme

Kadence child theme for [FlowerDrawings.com](https://flowerdrawings.com).

## Requirements

- WordPress 6.5+
- PHP 8.1+
- Kadence parent theme
- FlowerDrawings Core plugin (for Flower Tutorial CPT and permalinks)

## Features

- Immutable homepage built from supplied content
- Premium sticky header and footer
- Accessible FAQ accordion and mobile navigation
- Worksheet download and print actions
- Flower Tutorial archive and single templates
- Basic SEO and schema when no SEO plugin is active
- Future drawing-tool hooks and inactive shell template

## Development scripts

```bash
# Prepare images, icons, and worksheet PDF
bash scripts/prepare-assets.sh

# Validate homepage text against Pasted text(30).txt
python3 scripts/validate-content.py

# Build installable ZIP packages into ../dist
bash scripts/build-zip.sh
```

## Notes

- Do not rewrite homepage copy from `Pasted text(30).txt`.
- Tutorial content model lives in the `flowerdrawings-core` plugin, not this theme.
