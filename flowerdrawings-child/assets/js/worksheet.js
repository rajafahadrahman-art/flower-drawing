(function () {
	"use strict";

	function ready(callback) {
		if (document.readyState === "loading") {
			document.addEventListener("DOMContentLoaded", callback, { once: true });
			return;
		}

		callback();
	}

	function isWorksheetFile(href) {
		var value = (href || "").toLowerCase().split("#")[0].split("?")[0];
		return value.indexOf("worksheet") !== -1 && (value.endsWith(".pdf") || value.endsWith(".webp"));
	}

	function isPdf(href) {
		return (href || "").toLowerCase().split("#")[0].split("?")[0].endsWith(".pdf");
	}

	function getLabel(element) {
		return (element.getAttribute("aria-label") || element.textContent || "").toLowerCase().trim();
	}

	ready(function () {
		var links = Array.prototype.slice.call(document.querySelectorAll("a[href]"));
		var reduceMotion = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

		links.forEach(function (link) {
			var href = link.getAttribute("href") || "";
			var label = getLabel(link);
			var action = (link.getAttribute("data-worksheet-action") || link.getAttribute("data-fd-worksheet-action") || "").toLowerCase();
			var shouldPrint =
				action === "print" ||
				link.hasAttribute("data-fd-worksheet-print") ||
				link.hasAttribute("data-fd-print-worksheet") ||
				label.indexOf("print") !== -1;
			var shouldDownload =
				action === "download" ||
				link.hasAttribute("data-fd-worksheet-download") ||
				label.indexOf("download") !== -1 ||
				label.indexOf("browse drawing worksheets") !== -1;

			if (isWorksheetFile(href) && shouldDownload && !shouldPrint) {
				link.setAttribute("download", link.getAttribute("download") || "");
			}

			if (isPdf(href) && shouldPrint) {
				link.setAttribute("target", "_blank");
				link.setAttribute("rel", "noopener");

				link.addEventListener("click", function (event) {
					event.preventDefault();
					var opened = window.open(link.href, "_blank", "noopener");

					if (opened) {
						opened.opener = null;
					} else {
						window.location.href = link.href;
					}
				});
			}

			if (href === "#worksheets" || href.slice(-11) === "#worksheets") {
				link.addEventListener("click", function (event) {
					var target = document.getElementById("worksheets");

					if (!target || reduceMotion) {
						return;
					}

					var samePath = link.pathname === window.location.pathname || link.pathname === "";
					var sameHost = !link.host || link.host === window.location.host;

					if (!samePath || !sameHost) {
						return;
					}

					event.preventDefault();
					target.scrollIntoView({ behavior: "smooth", block: "start" });

					if (history.pushState) {
						history.pushState(null, "", "#worksheets");
					}
				});
			}
		});
	});
})();
