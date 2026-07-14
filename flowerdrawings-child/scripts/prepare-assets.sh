#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/../.." && pwd)"
THEME="$ROOT/flowerdrawings-child"
SOURCE="$ROOT/source-assets"

mkdir -p \
  "$THEME/assets/images/brand" \
  "$THEME/assets/images/flower-drawing/home" \
  "$THEME/assets/downloads" \
  "$THEME/assets/icons"

# Prefer project-root uploaded originals when present.
pick() {
  local preferred="$1"
  local fallback="$2"
  if [[ -f "$ROOT/$preferred" ]]; then
    echo "$ROOT/$preferred"
  elif [[ -f "$SOURCE/$preferred" ]]; then
    echo "$SOURCE/$preferred"
  elif [[ -f "$SOURCE/$fallback" ]]; then
    echo "$SOURCE/$fallback"
  else
    echo ""
  fi
}

if [[ ! -f "$SOURCE/Flower Drawing.webp" ]]; then
  python3 "$THEME/scripts/generate-source-assets.py"
fi

HERO="$(pick "Flower Drawings hero Banner.webp" "Flower Drawings hero Banner.webp")"
DRAWING="$(pick "Flower Drawing.webp" "Flower Drawing.webp")"
WORKSHEET="$(pick "Flower drawing worksheer.webp" "Flower drawing worksheer.webp")"
LOGO="$(pick "flowerdrawinglogo.webp" "flowerdrawinglogo.webp")"

cp "$HERO" "$THEME/assets/images/flower-drawing/home/flower-drawing-hero.webp"
cp "$DRAWING" "$THEME/assets/images/flower-drawing/home/flower-drawing.webp"
cp "$WORKSHEET" "$THEME/assets/downloads/flower-drawing-worksheet.webp"
cp "$LOGO" "$THEME/assets/images/brand/flowerdrawings-logo.webp"

python3 "$THEME/scripts/generate-icons.py"
python3 "$THEME/scripts/create-worksheet-pdf.py"

echo "Assets prepared."
