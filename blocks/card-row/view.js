/**
 * Card row block: front-end behaviour. Plain JavaScript (no build step).
 *
 * The row is a native horizontal scroller, so swipe, trackpad and keyboard
 * scrolling work without JavaScript. This script makes the row a labelled,
 * focusable region and adds previous/next arrows that scroll one card at a
 * time and are disabled at either end.
 *
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

(function() {
	'use strict';

	const __ = (window.wp && window.wp.i18n) ? window.wp.i18n.__ : (s) => s;
	const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

	/**
	 * Make an arrow button.
	 *
	 * @param {string} modifier "prev" or "next".
	 * @param {string} label Accessible name.
	 * @param {string} text Visible arrow.
	 * @returns {HTMLButtonElement} The button.
	 */
	function arrow(modifier, label, text) {
		const b = document.createElement('button');
		b.type = 'button';
		b.className = 'scca-card-row__arrow scca-card-row__arrow--' + modifier;
		b.setAttribute('aria-label', label);
		const span = document.createElement('span');
		span.setAttribute('aria-hidden', 'true');
		span.textContent = text;
		b.appendChild(span);
		return b;
	}

	/**
	 * Set up one card row.
	 *
	 * @param {HTMLElement} root The .wp-block-scca-card-row element.
	 */
	function init(root) {
		const track = root.querySelector('.scca-card-row__track');
		if (!track) {
			return;
		}
		track.tabIndex = 0;
		track.setAttribute('role', 'region');
		track.setAttribute('aria-label', root.dataset.label || __('Cards', 'scca'));
		root.classList.add('is-initialised');

		if (root.dataset.arrows === 'false') {
			return;
		}
		const prev = arrow('prev', __('Previous cards', 'scca'), '←');
		const next = arrow('next', __('Next cards', 'scca'), '→');
		const controls = document.createElement('div');
		controls.className = 'scca-card-row__controls';
		controls.appendChild(prev);
		controls.appendChild(next);
		root.appendChild(controls);

		/**
		 * Scroll by one card (plus the gap) in the given direction.
		 *
		 * @param {number} direction -1 for back, 1 for forward.
		 */
		function step(direction) {
			const first = track.firstElementChild;
			const gap = parseFloat(getComputedStyle(track).columnGap) || 0;
			const width = first ? first.getBoundingClientRect().width + gap : track.clientWidth;
			track.scrollBy({left: direction * width, behavior: reducedMotion.matches ? 'auto' : 'smooth'});
		}

		/**
		 * Disable an arrow at its end of the row; hide both if everything fits.
		 */
		function update() {
			const max = track.scrollWidth - track.clientWidth;
			controls.hidden = max <= 1;
			prev.disabled = track.scrollLeft <= 1;
			next.disabled = track.scrollLeft >= max - 1;
		}

		prev.addEventListener('click', () => {
			step(-1);
		});
		next.addEventListener('click', () => {
			step(1);
		});
		track.addEventListener('scroll', update, {passive: true});
		window.addEventListener('resize', update);
		update();
	}

	/**
	 * Set up every card row on the page.
	 */
	function start() {
		document.querySelectorAll('.wp-block-scca-card-row').forEach(init);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', start);
	} else {
		start();
	}
})();
