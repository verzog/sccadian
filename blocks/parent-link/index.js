/**
 * Back to parent page block: editor script. Plain JavaScript (no build step).
 *
 * The link is drawn on the server from the page's parent; the editor shows a stand-in.
 *
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

(function(wp) {
	'use strict';

	const el = wp.element.createElement;
	const {__} = wp.i18n;

	wp.blocks.registerBlockType('scca/parent-link', {
		/**
		 * The editor view: a stand-in for the link.
		 *
		 * @returns {Object} Element.
		 */
		edit: function() {
			return el(
				'p',
				wp.blockEditor.useBlockProps({className: 'scca-parent-link'}),
				el('a', {href: '#'}, '← ' + __('Back to the parent page', 'scca'))
			);
		},
		/**
		 * Drawn on the server.
		 *
		 * @returns {null} Nothing saved.
		 */
		save: function() {
			return null;
		}
	});
}(window.wp));
