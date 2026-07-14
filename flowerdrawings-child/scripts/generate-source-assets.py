#!/usr/bin/env python3
"""Generate placeholder source assets when originals are unavailable.

Creates clean black-and-white line-art imagery matching the expected
dimensions so the theme can ship. Replace with the supplied originals
when available (do not redesign those originals).
"""

from __future__ import annotations

import math
from pathlib import Path

from PIL import Image, ImageDraw, ImageFont

ROOT = Path(__file__).resolve().parents[2]
SOURCE = ROOT / "source-assets"


def _font(size: int) -> ImageFont.ImageFont:
    candidates = [
        "/usr/share/fonts/truetype/dejavu/DejaVuSerif.ttf",
        "/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf",
        "/usr/share/fonts/truetype/liberation/LiberationSerif-Regular.ttf",
    ]
    for path in candidates:
        if Path(path).exists():
            return ImageFont.truetype(path, size=size)
    return ImageFont.load_default()


def draw_flower(
    draw: ImageDraw.ImageDraw,
    cx: float,
    cy: float,
    radius: float,
    petals: int = 8,
    color: tuple[int, int, int] = (17, 17, 17),
    width: int = 3,
) -> None:
    for i in range(petals):
        angle = (math.pi * 2 * i) / petals - math.pi / 2
        px = cx + math.cos(angle) * radius * 0.72
        py = cy + math.sin(angle) * radius * 0.72
        pr = radius * 0.42
        bbox = [px - pr, py - pr * 1.25, px + pr, py + pr * 1.25]
        draw.ellipse(bbox, outline=color, width=width)
    draw.ellipse(
        [cx - radius * 0.22, cy - radius * 0.22, cx + radius * 0.22, cy + radius * 0.22],
        outline=color,
        width=width,
    )
    # Inner detail
    for i in range(12):
        angle = (math.pi * 2 * i) / 12
        x1 = cx + math.cos(angle) * radius * 0.05
        y1 = cy + math.sin(angle) * radius * 0.05
        x2 = cx + math.cos(angle) * radius * 0.16
        y2 = cy + math.sin(angle) * radius * 0.16
        draw.line([(x1, y1), (x2, y2)], fill=color, width=max(1, width - 1))


def draw_stem_and_leaves(
    draw: ImageDraw.ImageDraw,
    cx: float,
    top: float,
    bottom: float,
    color: tuple[int, int, int] = (17, 17, 17),
    width: int = 3,
) -> None:
    draw.line([(cx - 4, top), (cx - 2, bottom)], fill=color, width=width)
    draw.line([(cx + 4, top), (cx + 2, bottom)], fill=color, width=width)

    # Left leaf
    leaf_y = top + (bottom - top) * 0.45
    draw.polygon(
        [
            (cx - 6, leaf_y),
            (cx - 90, leaf_y - 35),
            (cx - 110, leaf_y + 10),
            (cx - 6, leaf_y + 18),
        ],
        outline=color,
    )
    draw.line([(cx - 6, leaf_y + 6), (cx - 95, leaf_y - 8)], fill=color, width=max(1, width - 1))

    # Right leaf
    leaf_y2 = top + (bottom - top) * 0.62
    draw.polygon(
        [
            (cx + 6, leaf_y2),
            (cx + 85, leaf_y2 - 28),
            (cx + 105, leaf_y2 + 12),
            (cx + 6, leaf_y2 + 16),
        ],
        outline=color,
    )
    draw.line([(cx + 6, leaf_y2 + 4), (cx + 90, leaf_y2 - 4)], fill=color, width=max(1, width - 1))


def make_logo() -> None:
    size = 1254
    img = Image.new("RGB", (size, size), (255, 255, 255))
    draw = ImageDraw.Draw(img)
    # Soft surface circle
    margin = 80
    draw.ellipse([margin, margin, size - margin, size - margin], outline=(216, 216, 210), width=4)
    draw_flower(draw, size / 2, size / 2 - 40, 340, petals=8, width=5)
    font = _font(54)
    text = "FlowerDrawings.com"
    bbox = draw.textbbox((0, 0), text, font=font)
    tw = bbox[2] - bbox[0]
    draw.text(((size - tw) / 2, size - 220), text, fill=(17, 17, 17), font=font)
    img.save(SOURCE / "flowerdrawinglogo.webp", "WEBP", quality=92)


def make_completed_drawing() -> None:
    size = 1254
    img = Image.new("RGB", (size, size), (255, 255, 255))
    draw = ImageDraw.Draw(img)
    draw_flower(draw, size / 2, 420, 280, petals=8, width=4)
    draw_stem_and_leaves(draw, size / 2, 680, 1120, width=4)
    img.save(SOURCE / "Flower Drawing.webp", "WEBP", quality=92)


def make_hero() -> None:
    w, h = 1734, 907
    img = Image.new("RGB", (w, h), (246, 246, 243))
    draw = ImageDraw.Draw(img)
    # Soft panels
    draw.rounded_rectangle([48, 48, w - 48, h - 48], radius=36, fill=(255, 255, 255), outline=(216, 216, 210), width=2)
    draw_flower(draw, 420, 380, 220, petals=8, width=4)
    draw_stem_and_leaves(draw, 420, 580, 820, width=3)
    title_font = _font(64)
    body_font = _font(34)
    draw.text((760, 260), "Flower Drawing", fill=(17, 17, 17), font=title_font)
    draw.text((760, 340), "Easy Step-by-Step Guides", fill=(17, 17, 17), font=_font(48))
    draw.text((760, 430), "Simple tutorials, printable worksheets,", fill=(100, 100, 95), font=body_font)
    draw.text((760, 480), "and beginner-friendly practice ideas.", fill=(100, 100, 95), font=body_font)
    # Sage accent bar
    draw.rounded_rectangle([760, 560, 1040, 620], radius=12, fill=(228, 238, 229), outline=(129, 154, 137), width=2)
    img.save(SOURCE / "Flower Drawings hero Banner.webp", "WEBP", quality=92)


def make_worksheet() -> None:
    w, h = 1055, 1491  # A4-ish portrait
    img = Image.new("RGB", (w, h), (255, 255, 255))
    draw = ImageDraw.Draw(img)
    draw.rectangle([36, 36, w - 36, h - 36], outline=(17, 17, 17), width=3)
    title_font = _font(42)
    small = _font(26)
    draw.text((70, 70), "Flower Drawing Worksheet", fill=(17, 17, 17), font=title_font)
    draw.text((70, 130), "Practice page — reference, outline, and blank space", fill=(100, 100, 95), font=small)

    # Reference flower
    draw.text((70, 200), "1. Reference", fill=(17, 17, 17), font=small)
    draw.rectangle([70, 240, 500, 700], outline=(216, 216, 210), width=2)
    draw_flower(draw, 285, 400, 120, petals=8, width=3)
    draw_stem_and_leaves(draw, 285, 520, 660, width=2)

    # Tracing outline (lighter)
    draw.text((555, 200), "2. Trace", fill=(17, 17, 17), font=small)
    draw.rectangle([555, 240, 985, 700], outline=(216, 216, 210), width=2)
    light = (170, 170, 165)
    draw_flower(draw, 770, 400, 120, petals=8, color=light, width=2)
    draw_stem_and_leaves(draw, 770, 520, 660, color=light, width=2)

    # Steps strip
    draw.text((70, 740), "3. Steps", fill=(17, 17, 17), font=small)
    step_w = 140
    for i in range(6):
        x0 = 70 + i * (step_w + 16)
        draw.rectangle([x0, 780, x0 + step_w, 980], outline=(216, 216, 210), width=2)
        draw.text((x0 + 16, 795), f"{i + 1}", fill=(17, 17, 17), font=small)
        r = 28 + i * 4
        draw_flower(draw, x0 + step_w / 2, 900, r, petals=min(8, 3 + i), width=2)

    # Blank practice
    draw.text((70, 1020), "4. Draw here", fill=(17, 17, 17), font=small)
    draw.rectangle([70, 1060, w - 70, h - 80], outline=(216, 216, 210), width=2)
    # Light guide dots
    for y in range(1100, h - 100, 40):
        for x in range(100, w - 100, 40):
            draw.point((x, y), fill=(230, 230, 225))

    img.save(SOURCE / "Flower drawing worksheer.webp", "WEBP", quality=92)


def main() -> None:
    SOURCE.mkdir(parents=True, exist_ok=True)
    make_logo()
    make_completed_drawing()
    make_hero()
    make_worksheet()
    print(f"Generated source assets in {SOURCE}")


if __name__ == "__main__":
    main()
