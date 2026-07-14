#!/usr/bin/env python3
"""Create an A4 portrait PDF from the worksheet WebP without stretching or cropping."""

from __future__ import annotations

from io import BytesIO
from pathlib import Path

import img2pdf
from PIL import Image

THEME = Path(__file__).resolve().parents[1]
WEBP = THEME / "assets" / "downloads" / "flower-drawing-worksheet.webp"
PDF = THEME / "assets" / "downloads" / "flower-drawing-worksheet.pdf"

# A4 in points (1 pt = 1/72 in)
A4_WIDTH_PT = img2pdf.mm_to_pt(210)
A4_HEIGHT_PT = img2pdf.mm_to_pt(297)


def main() -> None:
    if not WEBP.exists():
        raise SystemExit(f"Missing worksheet image: {WEBP}")

    PDF.parent.mkdir(parents=True, exist_ok=True)

    with Image.open(WEBP) as img:
        rgb = img.convert("RGB")
        buf = BytesIO()
        rgb.save(buf, format="JPEG", quality=95)
        jpeg_bytes = buf.getvalue()

    # Fit inside A4 while preserving aspect ratio (letterbox with white margins).
    layout = img2pdf.get_layout_fun(
        pagesize=(A4_WIDTH_PT, A4_HEIGHT_PT),
        fit=img2pdf.FitMode.into,
    )
    pdf_bytes = img2pdf.convert(jpeg_bytes, layout_fun=layout)
    PDF.write_bytes(pdf_bytes)
    print(f"Created A4 PDF: {PDF}")


if __name__ == "__main__":
    main()
