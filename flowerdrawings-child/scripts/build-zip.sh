#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/../.." && pwd)"
DIST="$ROOT/dist"
THEME_NAME="flowerdrawings-child"
PLUGIN_NAME="flowerdrawings-core"

mkdir -p "$DIST"
rm -f "$DIST/${THEME_NAME}.zip" "$DIST/${PLUGIN_NAME}.zip"

# Ensure assets exist.
bash "$ROOT/$THEME_NAME/scripts/prepare-assets.sh"

# Theme ZIP with theme folder at root.
(
  cd "$ROOT"
  zip -r "$DIST/${THEME_NAME}.zip" "$THEME_NAME" \
    -x "*/.DS_Store" \
    -x "*/__pycache__/*" \
    -x "*.pyc"
)

# Plugin ZIP with plugin folder at root.
(
  cd "$ROOT"
  zip -r "$DIST/${PLUGIN_NAME}.zip" "$PLUGIN_NAME" \
    -x "*/.DS_Store" \
    -x "*/__pycache__/*" \
    -x "*.pyc"
)

echo "Created:"
ls -lh "$DIST/${THEME_NAME}.zip" "$DIST/${PLUGIN_NAME}.zip"
unzip -l "$DIST/${THEME_NAME}.zip" | head -20
unzip -l "$DIST/${PLUGIN_NAME}.zip" | head -20
