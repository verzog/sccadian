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
 * CI check: every theme pattern opens in the post editor without an invalid-block warning.
 *
 * CI creates a post containing every pattern (see ci.yml); this opens it in the editor,
 * waits for the patterns to expand, and fails on any "This block contains unexpected or
 * invalid content" warning. It also reports whether WordPress offers the new-story
 * layouts when starting a new post.
 *
 * Usage: node tests/editor-patterns.js <site-url> <admin-user> <admin-password> <post-id>
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

const {chromium} = require('playwright');

const [site, user, pass, postId] = process.argv.slice(2);

/**
 * The frame holding the editor content: the editor-canvas iframe if there is one, else the page.
 *
 * @param {import('playwright').Page} page The editor page.
 * @returns {Promise<import('playwright').Frame>} The content frame.
 */
async function canvas(page) {
	await page.waitForSelector('iframe[name="editor-canvas"], .editor-styles-wrapper', {timeout: 60000});
	const iframe = await page.$('iframe[name="editor-canvas"]');
	return iframe ? iframe.contentFrame() : page.mainFrame();
}

(async() => {
	const browser = await chromium.launch();
	const page = await browser.newPage({viewport: {width: 1440, height: 1000}});
	let failures = 0;

	const editUrl = `${site}/wp-admin/post.php?post=${postId}&action=edit`;
	await page.goto(`${site}/wp-login.php?redirect_to=${encodeURIComponent(editUrl)}`);
	await page.fill('#user_login', user);
	await page.fill('#user_pass', pass);
	await page.click('#wp-submit');
	await page.waitForURL(/post\.php/, {timeout: 60000});

	const frame = await canvas(page);
	await frame.waitForSelector('[data-type]', {timeout: 60000});
	// Pattern blocks expand into their content after loading; wait until none are left.
	await frame.waitForFunction(() => !document.querySelector('[data-type="core/pattern"]'), null, {timeout: 60000})
		.catch(() => {
			failures++;
			console.log('::error::Some patterns did not expand in the editor.');
		});
	await page.waitForTimeout(2000);

	const blocks = await frame.$$eval('[data-type]', (b) => b.length);
	const warnings = await frame.$$eval('.block-editor-warning', (w) => w.map((el) => {
		const block = el.closest('[data-type]');
		return `${block ? block.dataset.type : '?'}: ${el.textContent.trim().slice(0, 80)}`;
	}));
	console.log(`Pattern showcase: ${blocks} blocks, ${warnings.length} invalid-block warnings`);
	warnings.forEach((w) => console.log(`::error::Invalid block in a theme pattern: ${w}`));
	failures += warnings.length;
	if (blocks < 50) {
		failures++;
		console.log(`::error::Only ${blocks} blocks rendered; expected every pattern's blocks.`);
	}

	// Information only: does "Add New Post" offer the new-story layouts?
	await page.goto(`${site}/wp-admin/post-new.php`);
	await page.waitForTimeout(6000);
	const offered = await page.evaluate(() => {
		const modal = document.querySelector('.components-modal__frame');
		return modal ? modal.textContent : '';
	});
	const names = ['News story', 'Event recap', 'Member or research feature'].filter((n) => offered.includes(n));
	console.log(names.length
		? `New post: WordPress offers the layouts (${names.join(', ')}).`
		: 'New post: no layout chooser shown; the layouts are in the inserter under "SCCA new story layouts".');

	await browser.close();
	process.exit(failures ? 1 : 0);
})().catch((e) => {
	console.log(`::error::${e.message}`);
	process.exit(1);
});
