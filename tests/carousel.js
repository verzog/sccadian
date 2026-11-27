// This file is part of the SCCA WordPress theme.
//
// The SCCA theme is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// The SCCA theme is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with it. If not, see <https://www.gnu.org/licenses/>.

/**
 * CI check of the homepage carousel and feature-card grid in a real browser.
 *
 * Usage: node tests/carousel.js <site-url>
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

const {chromium} = require('playwright');

const site = process.argv[2];
let failures = 0;

/**
 * Record one check.
 *
 * @param {boolean} ok Whether it passed.
 * @param {string} message What was checked.
 */
function check(ok, message) {
	console.log(`${ok ? 'OK  ' : 'FAIL'} ${message}`);
	if (!ok) {
		failures++;
		console.log(`::error::${message}`);
	}
}

/**
 * Index of the slide that is showing, from which slide is not inert.
 *
 * @param {import('playwright').Page} page The page.
 * @returns {Promise<number>} Active slide index, or -1.
 */
function activeSlide(page) {
	return page.$$eval('.wp-block-scca-carousel .scca-carousel__track > *', (s) => s.findIndex((el) => !el.inert));
}

/**
 * Whether every slide's content (heading to button) lies fully inside the carousel's
 * visible box, measured vertically (slides sit side by side, so only height can clip).
 *
 * @param {import('playwright').Page} page The page.
 * @returns {Promise<boolean>} True if no slide's content is clipped.
 */
function contentFits(page) {
	return page.$eval('.wp-block-scca-carousel', (root) => {
		const box = root.getBoundingClientRect();
		return [...root.querySelectorAll('.scca-carousel__track .wp-block-cover__inner-container')].every((c) => {
			const r = c.getBoundingClientRect();
			return r.height > 0 && r.top >= box.top - 1 && r.bottom <= box.bottom + 1;
		});
	});
}

(async() => {
	const browser = await chromium.launch();

	// Desktop: carousel behaviour and a 4-column grid.
	const page = await browser.newPage({viewport: {width: 1280, height: 900}, reducedMotion: 'no-preference'});
	const errors = [];
	page.on('pageerror', (e) => errors.push(e.message));
	await page.goto(`${site}/`);

	const carousel = page.locator('.wp-block-scca-carousel');
	check(await carousel.count() === 1, 'Homepage has one carousel');
	check(await carousel.evaluate((el) => el.classList.contains('is-initialised')), 'Carousel script ran');
	check(await carousel.getAttribute('aria-roledescription') === 'carousel', 'Carousel is announced as a carousel');

	const slides = await page.$$('.wp-block-scca-carousel .scca-carousel__track > *');
	check(slides.length === 2, `Carousel has 2 slides (found ${slides.length})`);
	check(await activeSlide(page) === 0, 'First slide shows first');
	check(await page.locator('.scca-carousel__dot').count() === slides.length, 'One dot per slide');

	await page.click('.scca-carousel__arrow--next');
	check(await activeSlide(page) === 1, 'Next arrow shows slide 2');
	await page.click('.scca-carousel__arrow--prev');
	check(await activeSlide(page) === 0, 'Previous arrow returns to slide 1');
	await page.click('.scca-carousel__dot >> nth=1');
	check(await activeSlide(page) === 1, 'Second dot shows slide 2');

	const hiddenLinks = await page.$$eval(
		'.wp-block-scca-carousel .scca-carousel__track > [aria-hidden="true"] a',
		(links) => links.length
	);
	const inertHidden = await page.$$eval(
		'.wp-block-scca-carousel .scca-carousel__track > [aria-hidden="true"]',
		(s) => s.every((el) => el.inert)
	);
	check(hiddenLinks > 0 && inertHidden, 'Hidden slides are inert, so their links cannot be tabbed to');

	const pause = page.locator('.scca-carousel__pause');
	check(await pause.isVisible(), 'Pause button is visible while autoplay is on');
	const before = await pause.getAttribute('aria-label');
	await pause.click();
	const after = await pause.getAttribute('aria-label');
	check(before === 'Pause slides' && after === 'Play slides', `Pause button toggles (${before} -> ${after})`);

	const height = await page.$eval('.wp-block-scca-carousel .scca-carousel__track', (t) => t.getBoundingClientRect().height);
	check(Math.round(height) >= 480, `Carousel is at least 480px tall on desktop (got ${Math.round(height)})`);
	check(await contentFits(page), 'Desktop: every slide\'s content fits inside the carousel');

	/**
	 * Number of columns the feature grid shows.
	 *
	 * @returns {Promise<number>} Column count.
	 */
	const columns = () => page.$eval('.scca-feature-grid', (g) => getComputedStyle(g).gridTemplateColumns.split(' ').length);
	/**
	 * Number of columns the news grid shows.
	 *
	 * @returns {Promise<number>} Column count.
	 */
	const newsColumns = () => page.$eval('.scca-news-grid', (g) => getComputedStyle(g).gridTemplateColumns.split(' ').length);
	const readMore = await page.$$eval('.scca-news-grid .wp-block-read-more', (links) => links.map((a) => ({
		text: a.textContent.trim(),
		title: (a.closest('.scca-card').querySelector('.wp-block-post-title') || {}).textContent || '',
	})));
	check(readMore.length > 0, `News cards have Read more buttons (found ${readMore.length})`);
	check(readMore.every((r) => r.title.trim() && r.text.includes(r.title.trim())),
		'Each Read more includes its story title for screen readers');

	check(await page.locator('.scca-feature-grid .wp-block-button__link').count() === 4, 'Four feature cards with buttons');
	check(await columns() === 4, `Feature grid: 4 columns at 1280px (got ${await columns()})`);
	check(await newsColumns() === 3, `News grid: 3 columns at 1280px (got ${await newsColumns()})`);
	await page.setViewportSize({width: 800, height: 900});
	check(await columns() === 2, `Feature grid: 2 columns at 800px (got ${await columns()})`);
	check(await newsColumns() === 2, `News grid: 2 columns at 800px (got ${await newsColumns()})`);
	await page.setViewportSize({width: 375, height: 800});
	check(await columns() === 1, `Feature grid: 1 column at 375px (got ${await columns()})`);
	check(await newsColumns() === 1, `News grid: 1 column at 375px (got ${await newsColumns()})`);
	const mobileHeight = await page.$eval('.wp-block-scca-carousel .scca-carousel__track', (t) => t.getBoundingClientRect().height);
	check(Math.round(mobileHeight) >= 420, `Carousel is at least 420px tall on phones (got ${Math.round(mobileHeight)})`);
	check(await contentFits(page), 'Phone: every slide\'s heading, text and button fit (not clipped)');

	check(errors.length === 0, `No JavaScript errors${errors.length ? ': ' + errors.join('; ') : ''}`);

	// Reduced motion: autoplay must not start.
	const calm = await browser.newPage({reducedMotion: 'reduce'});
	await calm.goto(`${site}/`);
	const calmLabel = await calm.locator('.scca-carousel__pause').getAttribute('aria-label');
	check(calmLabel === 'Play slides', `Reduced motion: carousel starts paused (${calmLabel})`);

	// Screenshots for people to look at (uploaded by CI).
	for (const [name, width] of [['desktop', 1280], ['tablet', 800], ['phone', 375]]) {
		const shot = await browser.newPage({viewport: {width: width, height: 900}, deviceScaleFactor: 2, reducedMotion: 'reduce'});
		await shot.goto(`${site}/`);
		await shot.screenshot({path: `homepage-${name}.png`, fullPage: true});
		await shot.close();
	}

	await browser.close();
	process.exit(failures ? 1 : 0);
})().catch((e) => {
	console.log(`::error::${e.message}`);
	process.exit(1);
});
