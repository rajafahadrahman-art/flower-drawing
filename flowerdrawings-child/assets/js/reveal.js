(function () {
	"use strict";

	function ready(callback) {
		if (document.readyState === "loading") {
			document.addEventListener("DOMContentLoaded", callback, { once: true });
			return;
		}

		callback();
	}

	function revealAll(elements) {
		elements.forEach(function (element) {
			element.classList.add("is-visible");
		});
	}

	ready(function () {
		var elements = Array.prototype.slice.call(document.querySelectorAll(".fd-reveal"));

		if (!elements.length) {
			return;
		}

		var reduceMotion = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

		if (reduceMotion || !("IntersectionObserver" in window)) {
			revealAll(elements);
			return;
		}

		document.documentElement.classList.add("fd-reveal-ready");

		var observer = new IntersectionObserver(
			function (entries, instance) {
				entries.forEach(function (entry) {
					if (!entry.isIntersecting) {
						return;
					}

					entry.target.classList.add("is-visible");
					instance.unobserve(entry.target);
				});
			},
			{
				root: null,
				rootMargin: "0px 0px -8% 0px",
				threshold: 0.12
			}
		);

		elements.forEach(function (element) {
			observer.observe(element);
		});
	});
})();
