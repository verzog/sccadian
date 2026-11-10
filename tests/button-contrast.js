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
 * CI check: every visible button on the homepage, on the front end and in the
 * Site Editor, has text that meets WCAG AA contrast (4.5:1) against its background.
 *
 * Usage: node tests/button-contrast.js <site-url> <admin-user> <admin-password>
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

const {chromium} = require('playwright');

const [site, user, pass] = process.argv.slice(2);
const MIN_RATIO = 4.5;

/**
 * Collect the colours of every visible button in a page or frame. Runs in the browser.
 *
 * @returns {Array<Object>} One entry per button: text, colour, background and matching CSS rules.
 */
function collectButtons() {
    const rulesFor = (el) => {
        const found = [];
        for (const sheet of document.styleSheets) {
            let rules;
            try {
                rules = sheet.cssRules;
            } catch (e) {
                continue;
            }
            for (const rule of rules || []) {
                if (rule.selectorText && rule.style && rule.style.color) {
                    try {
                        if (el.matches(rule.selectorText)) {
                            found.push(rule.selectorText + ' { color: ' + rule.style.color + ' }');
                        }
                    } catch (e) {
                        // Selectors with pseudo-elements cannot be matched.
                    }
                }
            }
        }
        return found;
    };
    return [...document.querySelectorAll('.wp-element-button, .wp-block-button__link')]
        .filter((el) => el.offsetParent !== null)
        .map((el) => {
            const style = getComputedStyle(el);
            return {
                text: (el.textContent || el.getAttribute('aria-label') || '').trim().slice(0, 40),
                color: style.color,
                background: style.backgroundColor,
                rules: rulesFor(el),
            };
        });
}

/**
 * Relative luminance of a CSS rgb()/rgba() colour.
 *
 * @param {string} css The colour.
 * @returns {number|null} Luminance, or null if the colour is transparent or unreadable.
 */
function luminance(css) {
    const m = css.match(/rgba?\(([\d.]+),\s*([\d.]+),\s*([\d.]+)(?:,\s*([\d.]+))?/);
    if (!m || (m[4] !== undefined && Number(m[4]) === 0)) {
        return null;
    }
    const [r, g, b] = [m[1], m[2], m[3]].map((v) => {
        const c = Number(v) / 255;
        return c <= 0.04045 ? c / 12.92 : Math.pow((c + 0.055) / 1.055, 2.4);
    });
    return 0.2126 * r + 0.7152 * g + 0.0722 * b;
}

/**
 * Report each button and return how many fail.
 *
 * @param {string} where Label for the output.
 * @param {Array<Object>} buttons From collectButtons().
 * @returns {number} Number of failing buttons.
 */
function report(where, buttons) {
    let failures = 0;
    console.log(`\n${where}: ${buttons.length} buttons`);
    if (buttons.length === 0) {
        console.log(`::error::${where}: no buttons found.`);
        return 1;
    }
    for (const b of buttons) {
        const fg = luminance(b.color);
        const bg = luminance(b.background);
        if (fg === null || bg === null) {
            console.log(`  SKIP "${b.text}": colour ${b.color} on ${b.background} (transparent)`);
            continue;
        }
        const ratio = (Math.max(fg, bg) + 0.05) / (Math.min(fg, bg) + 0.05);
        const ok = ratio >= MIN_RATIO;
        console.log(`  ${ok ? 'OK  ' : 'FAIL'} "${b.text}": ${b.color} on ${b.background} = ${ratio.toFixed(2)}:1`);
        if (!ok) {
            failures++;
            console.log(`::error::${where}: button "${b.text}" contrast ${ratio.toFixed(2)}:1, needs ${MIN_RATIO}:1.`);
            b.rules.forEach((r) => console.log(`         rule: ${r}`));
        }
    }
    return failures;
}

(async() => {
    const browser = await chromium.launch();
    const page = await browser.newPage({viewport: {width: 1440, height: 1000}});
    let failures = 0;

    await page.goto(`${site}/`);
    failures += report('Front end', await page.evaluate(collectButtons));

    await page.goto(`${site}/wp-login.php`);
    await page.fill('#user_login', user);
    await page.fill('#user_pass', pass);
    await Promise.all([page.waitForNavigation(), page.click('#wp-submit')]);

    await page.goto(`${site}/wp-admin/site-editor.php?postType=wp_template&postId=scca//front-page&canvas=edit`);
    const frameEl = await page.waitForSelector('iframe[name="editor-canvas"]', {timeout: 60000});
    const frame = await frameEl.contentFrame();
    await frame.waitForSelector('.wp-block-button__link', {timeout: 60000});
    failures += report('Site Editor', await frame.evaluate(collectButtons));

    await page.screenshot({path: 'site-editor.png'});
    await browser.close();
    process.exit(failures ? 1 : 0);
})().catch((e) => {
    console.log(`::error::${e.message}`);
    process.exit(1);
});
