(function () {
	"use strict";

	function ready(callback) {
		if (document.readyState === "loading") {
			document.addEventListener("DOMContentLoaded", callback, { once: true });
			return;
		}

		callback();
	}

	function toArray(nodeList) {
		return Array.prototype.slice.call(nodeList);
	}

	ready(function () {
		var accordions = toArray(document.querySelectorAll(".fd-accordion"));

		if (!accordions.length) {
			return;
		}

		accordions.forEach(function (accordion, accordionIndex) {
			var triggers = toArray(accordion.querySelectorAll(".fd-accordion__trigger"));

			triggers.forEach(function (trigger, triggerIndex) {
				var item = trigger.closest(".fd-accordion__item");
				var panel = null;
				var panelId = trigger.getAttribute("aria-controls");
				var triggerId = trigger.getAttribute("id");

				if (panelId) {
					panel = document.getElementById(panelId);
				}

				if (!panel && item) {
					panel = item.querySelector(".fd-accordion__panel");
				}

				if (!panel) {
					return;
				}

				if (!triggerId) {
					triggerId = "fd-accordion-trigger-" + accordionIndex + "-" + triggerIndex;
					trigger.setAttribute("id", triggerId);
				}

				if (!panelId) {
					panelId = "fd-accordion-panel-" + accordionIndex + "-" + triggerIndex;
					panel.setAttribute("id", panelId);
				}

				trigger.setAttribute("aria-controls", panelId);
				panel.setAttribute("role", "region");
				panel.setAttribute("aria-labelledby", triggerId);

				var startsOpen = trigger.getAttribute("aria-expanded") === "true" || (item && item.classList.contains("is-open"));
				trigger.setAttribute("aria-expanded", startsOpen ? "true" : "false");
				panel.hidden = !startsOpen;

				if (item) {
					item.classList.toggle("is-open", startsOpen);
				}

				trigger.addEventListener("click", function () {
					var expanded = trigger.getAttribute("aria-expanded") === "true";
					var nextState = !expanded;

					trigger.setAttribute("aria-expanded", nextState ? "true" : "false");
					panel.hidden = !nextState;

					if (item) {
						item.classList.toggle("is-open", nextState);
					}
				});
			});

			accordion.addEventListener("keydown", function (event) {
				if (event.key !== "ArrowDown" && event.key !== "ArrowUp" && event.key !== "Home" && event.key !== "End") {
					return;
				}

				var activeTriggers = triggers.filter(function (trigger) {
					return !trigger.disabled && trigger.offsetParent !== null;
				});
				var currentIndex = activeTriggers.indexOf(document.activeElement);

				if (currentIndex === -1) {
					return;
				}

				event.preventDefault();

				if (event.key === "Home") {
					activeTriggers[0].focus();
					return;
				}

				if (event.key === "End") {
					activeTriggers[activeTriggers.length - 1].focus();
					return;
				}

				var direction = event.key === "ArrowDown" ? 1 : -1;
				var nextIndex = (currentIndex + direction + activeTriggers.length) % activeTriggers.length;
				activeTriggers[nextIndex].focus();
			});
		});
	});
})();
