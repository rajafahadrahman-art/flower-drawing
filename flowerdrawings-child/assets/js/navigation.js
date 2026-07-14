(function () {
	"use strict";

	function ready(callback) {
		if (document.readyState === "loading") {
			document.addEventListener("DOMContentLoaded", callback, { once: true });
			return;
		}

		callback();
	}

	ready(function () {
		var toggle = document.querySelector(".fd-nav-toggle");
		var nav = document.querySelector(".fd-nav");

		if (!toggle || !nav) {
			return;
		}

		var desktopQuery = window.matchMedia("(min-width: 900px)");
		var lastFocused = null;
		var id = nav.getAttribute("id");

		if (!id) {
			id = "fd-primary-navigation";
			nav.setAttribute("id", id);
		}

		toggle.setAttribute("aria-controls", id);
		toggle.setAttribute("aria-expanded", "false");
		nav.setAttribute("aria-hidden", desktopQuery.matches ? "false" : "true");

		function getFocusable() {
			return Array.prototype.slice.call(
				nav.querySelectorAll(
					'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
				)
			).filter(function (element) {
				return element.offsetParent !== null || element === document.activeElement;
			});
		}

		function isOpen() {
			return toggle.getAttribute("aria-expanded") === "true";
		}

		function openMenu() {
			if (desktopQuery.matches || isOpen()) {
				return;
			}

			lastFocused = document.activeElement;
			document.body.classList.add("fd-nav-open");
			nav.classList.add("is-open");
			toggle.setAttribute("aria-expanded", "true");
			nav.setAttribute("aria-hidden", "false");

			var focusable = getFocusable();
			if (focusable.length) {
				focusable[0].focus({ preventScroll: true });
			}
		}

		function closeMenu(options) {
			if (!isOpen()) {
				return;
			}

			var settings = options || {};
			document.body.classList.remove("fd-nav-open");
			nav.classList.remove("is-open");
			toggle.setAttribute("aria-expanded", "false");
			nav.setAttribute("aria-hidden", desktopQuery.matches ? "false" : "true");

			if (settings.restoreFocus !== false && lastFocused && typeof lastFocused.focus === "function") {
				lastFocused.focus({ preventScroll: true });
			}
		}

		function toggleMenu() {
			if (isOpen()) {
				closeMenu();
			} else {
				openMenu();
			}
		}

		toggle.addEventListener("click", function () {
			toggleMenu();
		});

		nav.addEventListener("click", function (event) {
			var link = event.target.closest("a");

			if (link && !desktopQuery.matches) {
				closeMenu({ restoreFocus: false });
			}
		});

		document.addEventListener("click", function (event) {
			if (!isOpen()) {
				return;
			}

			if (!nav.contains(event.target) && !toggle.contains(event.target)) {
				closeMenu();
			}
		});

		document.addEventListener("keydown", function (event) {
			if (!isOpen()) {
				return;
			}

			if (event.key === "Escape") {
				event.preventDefault();
				closeMenu();
				return;
			}

			if (event.key !== "Tab") {
				return;
			}

			var focusable = getFocusable();
			if (!focusable.length) {
				event.preventDefault();
				toggle.focus({ preventScroll: true });
				return;
			}

			var first = focusable[0];
			var last = focusable[focusable.length - 1];

			if (event.shiftKey && document.activeElement === first) {
				event.preventDefault();
				toggle.focus({ preventScroll: true });
			} else if (!event.shiftKey && document.activeElement === last) {
				event.preventDefault();
				toggle.focus({ preventScroll: true });
			} else if (!event.shiftKey && document.activeElement === toggle) {
				event.preventDefault();
				first.focus({ preventScroll: true });
			}
		});

		function handleViewportChange() {
			if (desktopQuery.matches) {
				document.body.classList.remove("fd-nav-open");
				nav.classList.remove("is-open");
				toggle.setAttribute("aria-expanded", "false");
				nav.setAttribute("aria-hidden", "false");
				return;
			}

			nav.setAttribute("aria-hidden", isOpen() ? "false" : "true");
		}

		if (typeof desktopQuery.addEventListener === "function") {
			desktopQuery.addEventListener("change", handleViewportChange);
		} else if (typeof desktopQuery.addListener === "function") {
			desktopQuery.addListener(handleViewportChange);
		}
	});
})();
