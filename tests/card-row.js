// Copyright (c) Skin Cancer College Australasia.
// All rights reserved.
//
// This file is part of a proprietary theme developed by Skin Cancer
// College Australasia for use with WordPress. It is NOT free software and is
// NOT released under the GNU General Public License.
//
// Unauthorised copying, distribution, modification, or use of this file,
// in whole or in part, via any medium, is strictly prohibited without the
// prior written permission of Skin Cancer College Australasia. The software
// is provided "as is", without warranty of any kind, express or implied.

/**
 * CI check of the Card row block in a real browser.
 *
 * Usage: node tests/card-row.js <page-url-containing-a-card-row>
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

const {chromium} = require('playwright');

const url = process.argv[2];
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

(async() => {
	const browser = await chromium.launch();
	// Reduced motion makes the arrows scroll instantly, so positions can be read straight away.
	const page = await browser.newPage({viewport: {width: 1280, height: 900}, reducedMotion: 'reduce'});
	const errors = [];
	page.on('pageerror', (e) => errors.push(e.message));
	await page.goto(url);

	const row = page.locator('.wp-block-scca-card-row').first();
	check(await row.count() === 1, 'Page has a card row');
	check(await row.evaluate((el) => el.classList.contains('is-initialised')), 'Card row script ran');

	const track = row.locator('.scca-card-row__track');
	const trackInfo = await track.evaluate((t) => ({role: t.getAttribute('role'), label: t.getAttribute('aria-label'), tab: t.tabIndex}));
	check(trackInfo.role === 'region' && !!trackInfo.label && trackInfo.tab === 0,
		`Row is a labelled region reachable by keyboard (${JSON.stringify(trackInfo)})`);

	// Give one card much more text, so button alignment is tested with uneven content.
	await track.evaluate((t) => {
		const p = t.children[1].querySelector('p');
		p.textContent = 'A much longer card description that wraps over several lines, to check that every card '
			+ 'stretches to the tallest one and the buttons still line up along the bottom of the row.';
	});
	const cards = await track.evaluate((t) => [...t.children].map((c) => {
		const img = c.querySelector('img');
		const btn = c.querySelector('.wp-block-button__link');
		return {
			width: Math.round(c.getBoundingClientRect().width),
			image: img ? Math.round(img.getBoundingClientRect().height) : 0,
			buttonBottom: btn ? Math.round(btn.getBoundingClientRect().bottom) : 0,
		};
	}));
	check(cards.length === 5, `Five cards (found ${cards.length})`);
	check(new Set(cards.map((c) => c.width)).size === 1 && cards[0].width === 300,
		`Medium cards are all 300px wide (${cards.map((c) => c.width).join(', ')})`);
	check(new Set(cards.map((c) => c.image)).size === 1 && cards[0].image === 170,
		`Images are cropped to one height, 170px (${cards.map((c) => c.image).join(', ')})`);
	check(new Set(cards.map((c) => c.buttonBottom)).size === 1,
		`Buttons line up even when one card has more text (${cards.map((c) => c.buttonBottom).join(', ')})`);

	const prev = row.locator('.scca-card-row__arrow--prev');
	const next = row.locator('.scca-card-row__arrow--next');
	check(await prev.isDisabled() && await next.isEnabled(), 'At the start: previous disabled, next enabled');
	await next.click();
	await page.waitForTimeout(300);
	const scrolled = await track.evaluate((t) => t.scrollLeft);
	check(scrolled > 200, `Next arrow scrolls one card along (scrollLeft ${Math.round(scrolled)})`);
	check(await prev.isEnabled(), 'After scrolling, previous is enabled');
	await prev.click();
	await page.waitForTimeout(300);
	check(await track.evaluate((t) => t.scrollLeft) <= 1, 'Previous arrow scrolls back to the start');

	await page.setViewportSize({width: 375, height: 800});
	await page.waitForTimeout(300);
	const phone = await track.evaluate((t) => ({overflow: t.scrollWidth > t.clientWidth, page: document.documentElement.scrollWidth}));
	check(phone.overflow, 'On a phone the row scrolls sideways');
	check(phone.page <= 375, `The page itself does not scroll sideways on a phone (width ${phone.page})`);

	check(errors.length === 0, `No JavaScript errors${errors.length ? ': ' + errors.join('; ') : ''}`);
	await browser.close();
	process.exit(failures ? 1 : 0);
})().catch((e) => {
	console.log(`::error::${e.message}`);
	process.exit(1);
});
