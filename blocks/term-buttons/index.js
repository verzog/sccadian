/**
 * Sub-category buttons block: editor script. Plain JavaScript (no build step).
 *
 * The buttons are drawn on the server from the page's category or type; the editor shows a stand-in.
 *
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

(function(wp) {
	'use strict';

	const el = wp.element.createElement;
	const {__} = wp.i18n;

	wp.blocks.registerBlockType('scca/term-buttons', {
		/**
		 * The editor view: a stand-in row of buttons.
		 *
		 * @returns {Object} Element.
		 */
		edit: function() {
			const button = function(label, current) {
				return el('li', {key: label}, el('span', {
					className: 'scca-term-buttons__button' + (current ? ' is-current' : '')
				}, label));
			};
			return el(
				'nav',
				wp.blockEditor.useBlockProps({className: 'scca-term-buttons'}),
				el('ul', {className: 'scca-term-buttons__list'}, [
					button(__('All', 'scca'), true),
					button(__('Sub-category', 'scca'), false),
					button(__('Sub-category', 'scca') + ' 2', false)
				])
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
