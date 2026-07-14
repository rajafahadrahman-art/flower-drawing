#!/usr/bin/env python3
"""Compare homepage template text against Pasted text(30).txt source of truth."""

from __future__ import annotations

import re
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
SOURCE = ROOT / "Pasted text(30).txt"
THEME = ROOT / "flowerdrawings-child"
SCAN_DIRS = [
    THEME / "template-parts" / "homepage",
    THEME / "inc",
]


def normalize(text: str) -> str:
    text = text.replace("\u201c", '"').replace("\u201d", '"').replace("\u2019", "'")
    text = re.sub(r"\s+", " ", text).strip()
    return text


def extract_php_strings(raw: str) -> list[str]:
    strings = re.findall(r"'(?:\\'|[^'])*'|\"(?:\\\"|[^\"])*\"", raw)
    cleaned: list[str] = []
    for item in strings:
        value = item[1:-1]
        value = value.replace("\\'", "'").replace('\\"', '"').replace("\\n", " ")
        value = normalize(value)
        if len(value) >= 3:
            cleaned.append(value)
    return cleaned


def strip_php_and_html(raw: str) -> str:
    php_strings = " ".join(extract_php_strings(raw))
    raw = re.sub(r"<\?php.*?\?>", " ", raw, flags=re.S)
    raw = re.sub(r"<script.*?</script>", " ", raw, flags=re.S | re.I)
    raw = re.sub(r"<style.*?</style>", " ", raw, flags=re.S | re.I)
    raw = re.sub(r"<[^>]+>", " ", raw)
    return normalize(raw + " " + php_strings)


def extract_source_phrases(source_text: str) -> list[str]:
    phrases: list[str] = []
    for line in source_text.splitlines():
        line = line.strip()
        if not line:
            continue
        if line.startswith("SEO Title:"):
            phrases.append(normalize(line.replace("SEO Title:", "", 1)))
            continue
        if line.startswith("Meta Description:"):
            phrases.append(normalize(line.replace("Meta Description:", "", 1)))
            continue
        if line.startswith("Button:"):
            phrases.append(normalize(line.replace("Button:", "", 1)))
            continue
        if line.startswith("* "):
            phrases.append(normalize(line[2:]))
            continue
        phrases.append(normalize(line))
    return [p for p in phrases if p]


def main() -> int:
    if not SOURCE.exists():
        print(f"FAIL: missing source file {SOURCE}")
        return 1

    source = SOURCE.read_text(encoding="utf-8")
    phrases = extract_source_phrases(source)

    combined = ""
    for directory in SCAN_DIRS:
        if not directory.exists():
            continue
        for path in sorted(directory.rglob("*.php")):
            combined += " " + strip_php_and_html(path.read_text(encoding="utf-8"))

    combined = normalize(combined)

    missing: list[str] = []
    for phrase in phrases:
        if phrase not in combined:
            missing.append(phrase)

    buttons = [
        "Explore Drawing Tutorials",
        "Download Practice Worksheets",
        "View Step-by-Step Drawing Guides",
        "Browse Drawing Worksheets",
        "Print a Practice Page",
        "View All Flower Tutorials",
        "Start Drawing",
        "View Practice Worksheets",
    ]
    for button in buttons:
        if button not in combined:
            missing.append(f"[button] {button}")

    print(f"Checked {len(phrases)} source phrases against homepage templates.")
    if missing:
        print(f"FAIL: {len(missing)} missing phrase(s):")
        for item in missing:
            print(f"  - {item}")
        return 1

    print("PASS: all source phrases found in homepage templates/helpers.")
    return 0


if __name__ == "__main__":
    sys.exit(main())
