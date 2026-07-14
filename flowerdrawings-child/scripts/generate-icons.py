#!/usr/bin/env python3
"""Generate favicon and site icon files from the supplied square logo."""

from __future__ import annotations

from pathlib import Path

from PIL import Image

THEME = Path(__file__).resolve().parents[1]
LOGO = THEME / "assets" / "images" / "brand" / "flowerdrawings-logo.webp"
ICONS = THEME / "assets" / "icons"


def main() -> None:
    if not LOGO.exists():
        raise SystemExit(f"Missing logo: {LOGO}")

    ICONS.mkdir(parents=True, exist_ok=True)
    src = Image.open(LOGO).convert("RGBA")

    sizes = {
        "site-icon-512.png": 512,
        "apple-touch-icon.png": 180,
        "favicon-32x32.png": 32,
        "favicon-16x16.png": 16,
    }

    for name, size in sizes.items():
        img = src.resize((size, size), Image.Resampling.LANCZOS)
        # Apple / site icons prefer opaque background
        if name in {"site-icon-512.png", "apple-touch-icon.png"}:
            bg = Image.new("RGBA", (size, size), (255, 255, 255, 255))
            bg.alpha_composite(img)
            img = bg.convert("RGB")
            img.save(ICONS / name, "PNG")
        else:
            img.save(ICONS / name, "PNG")

    # Multi-size ICO
    ico_sizes = [(16, 16), (32, 32), (48, 48)]
    ico_images = [src.resize(s, Image.Resampling.LANCZOS) for s in ico_sizes]
    ico_images[0].save(
        ICONS / "favicon.ico",
        format="ICO",
        sizes=ico_sizes,
        append_images=ico_images[1:],
    )
    print(f"Generated icons in {ICONS}")


if __name__ == "__main__":
    main()
