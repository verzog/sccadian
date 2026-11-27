/**
 * Carousel block: front-end behaviour. Plain JavaScript (no build step).
 *
 * Without JavaScript the slides simply stack. With it, each carousel gets
 * previous/next arrows, dots and a pause button, and plays automatically if
 * set to. Autoplay pauses on hover and keyboard focus, and never starts for
 * visitors who prefer reduced motion (WCAG 2.2.2).
 *
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

(function() {
	'use strict';

	const __ = (window.wp && window.wp.i18n) ? window.wp.i18n.__ : (s) => s;
	const sprintf = (window.wp && window.wp.i18n) ? window.wp.i18n.sprintf : (s, ...a) => {
		let i = 0;
		return s.replace(/%(\d\$)?d/g, () => a[i++]);
	};
	const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

	/**
	 * Make a button with an accessible name.
	 *
	 * @param {string} className CSS class.
	 * @param {string} label Accessible name.
	 * @param {string} text Visible text (an arrow or icon character).
	 * @returns {HTMLButtonElement} The button.
	 */
	function button(className, label, text) {
		const b = document.createElement('button');
		b.type = 'button';
		b.className = className;
		b.setAttribute('aria-label', label);
		const span = document.createElement('span');
		span.setAttribute('aria-hidden', 'true');
		span.textContent = text;
		b.appendChild(span);
		return b;
	}

	/**
	 * Turn one carousel block into a working carousel.
	 *
	 * @param {HTMLElement} root The .wp-block-scca-carousel element.
	 */
	function init(root) {
		const track = root.querySelector('.scca-carousel__track');
		const slides = track ? Array.from(track.children) : [];
		if (slides.length < 2) {
			return;
		}

		const speed = Math.max(3, Number(root.dataset.speed) || 6) * 1000;
		const wantsAutoplay = root.dataset.autoplay === 'true';
		// With no autoplay, arrows or dots there is no way to reach the other slides: leave them stacked.
		if (!wantsAutoplay && root.dataset.arrows === 'false' && root.dataset.dots === 'false') {
			return;
		}
		let index = 0;
		let timer = null;
		let paused = !wantsAutoplay || reducedMotion.matches;
		let hovering = false;
		let focused = false;

		root.setAttribute('role', 'region');
		root.setAttribute('aria-roledescription', __('carousel', 'scca'));
		root.setAttribute('aria-label', root.dataset.label || __('Featured', 'scca'));
		slides.forEach((s, i) => {
			s.setAttribute('role', 'group');
			s.setAttribute('aria-roledescription', __('slide', 'scca'));
			s.setAttribute('aria-label', sprintf(__('%1$d of %2$d', 'scca'), i + 1, slides.length));
		});

		const controls = document.createElement('div');
		controls.className = 'scca-carousel__controls';

		const pauseBtn = button('scca-carousel__pause', '', '');
		controls.appendChild(pauseBtn);

		let prev = null;
		let next = null;
		if (root.dataset.arrows !== 'false') {
			prev = button('scca-carousel__arrow scca-carousel__arrow--prev', __('Previous slide', 'scca'), '←');
			next = button('scca-carousel__arrow scca-carousel__arrow--next', __('Next slide', 'scca'), '→');
			root.appendChild(prev);
			root.appendChild(next);
		}

		const dots = [];
		if (root.dataset.dots !== 'false') {
			const list = document.createElement('div');
			list.className = 'scca-carousel__dots';
			slides.forEach((s, i) => {
				const d = button('scca-carousel__dot', sprintf(__('Go to slide %d', 'scca'), i + 1), '');
				d.addEventListener('click', () => {
					go(i);
				});
				dots.push(d);
				list.appendChild(d);
			});
			controls.appendChild(list);
		}
		root.insertBefore(controls, root.firstChild);

		/**
		 * Show slide i: move or fade the track, and hide the others from keyboard and screen readers.
		 *
		 * @param {number} i Slide index; wraps around.
		 */
		function go(i) {
			index = (i + slides.length) % slides.length;
			track.style.setProperty('--scca-carousel-index', String(index));
			slides.forEach((s, n) => {
				const active = n === index;
				s.classList.toggle('is-active', active);
				s.inert = !active;
				s.setAttribute('aria-hidden', active ? 'false' : 'true');
			});
			dots.forEach((d, n) => {
				if (n === index) {
					d.setAttribute('aria-current', 'true');
				} else {
					d.removeAttribute('aria-current');
				}
			});
		}

		/**
		 * Start or stop the timer to match the paused, hover and focus state.
		 */
		function sync() {
			const running = !paused && !hovering && !focused;
			if (running && !timer) {
				timer = window.setInterval(() => {
					go(index + 1);
				}, speed);
			} else if (!running && timer) {
				window.clearInterval(timer);
				timer = null;
			}
			// Announce slide changes only when the visitor is driving them.
			track.setAttribute('aria-live', running ? 'off' : 'polite');
			pauseBtn.setAttribute('aria-label', paused ? __('Play slides', 'scca') : __('Pause slides', 'scca'));
			pauseBtn.firstChild.textContent = paused ? '▶' : '❚❚';
			pauseBtn.hidden = !wantsAutoplay;
		}

		pauseBtn.addEventListener('click', () => {
			paused = !paused;
			sync();
		});
		if (prev) {
			prev.addEventListener('click', () => {
				go(index - 1);
			});
			next.addEventListener('click', () => {
				go(index + 1);
			});
		}
		root.addEventListener('mouseenter', () => {
			hovering = true;
			sync();
		});
		root.addEventListener('mouseleave', () => {
			hovering = false;
			sync();
		});
		root.addEventListener('focusin', () => {
			focused = true;
			sync();
		});
		root.addEventListener('focusout', (e) => {
			focused = root.contains(e.relatedTarget);
			sync();
		});
		reducedMotion.addEventListener('change', () => {
			if (reducedMotion.matches) {
				paused = true;
			}
			sync();
		});

		root.classList.add('is-initialised');
		go(0);
		sync();
	}

	/**
	 * Initialise every carousel on the page.
	 */
	function start() {
		document.querySelectorAll('.wp-block-scca-carousel').forEach(init);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', start);
	} else {
		start();
	}
})();
