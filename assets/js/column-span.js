/**
 * "Grid width" for a column in the editor: its width in twelfths of the row, like a Bootstrap
 * grid (e.g. 4 of 12 is a third). Plain JavaScript (no build step). Loaded for administrators only.
 *
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

(function(wp) {
	'use strict';

	const el = wp.element.createElement;
	const {__, sprintf} = wp.i18n;
	const {InspectorControls} = wp.blockEditor;
	const {PanelBody, SelectControl} = wp.components;

	/**
	 * A column width for a number of twelfths, e.g. 4 gives "33.33%".
	 *
	 * @param {number} span Twelfths, 1 to 12.
	 * @returns {string} Width.
	 */
	function width(span) {
		return String(Math.round(span * 10000 / 12) / 100) + '%';
	}

	/**
	 * The twelfths a width is, or '' when it is not a whole number of them.
	 *
	 * @param {string} value Width, e.g. "33.33%".
	 * @returns {string} Twelfths, or ''.
	 */
	function span(value) {
		if (!value || !String(value).endsWith('%')) {
			return '';
		}
		for (let n = 1; n <= 12; n++) {
			if (width(n) === String(value)) {
				return String(n);
			}
		}
		return '';
	}

	const options = [{label: __('Automatic (share the row)', 'scca'), value: ''}];
	for (let n = 1; n <= 12; n++) {
		options.push({label: sprintf(__('%1$d of 12 (%2$s)', 'scca'), n, width(n)), value: String(n)});
	}

	const withSpan = wp.compose.createHigherOrderComponent((BlockEdit) => (props) => {
		if (props.name !== 'core/column') {
			return el(BlockEdit, props);
		}
		return el(
			wp.element.Fragment,
			null,
			el(BlockEdit, props),
			el(
				InspectorControls,
				null,
				el(
					PanelBody,
					{title: __('Grid width', 'scca')},
					el(SelectControl, {
						label: __('Columns of 12', 'scca'),
						help: __('Widths in a row should add up to 12. Columns stack on phones.', 'scca'),
						value: span(props.attributes.width),
						options: options,
						onChange: (value) => props.setAttributes({width: value ? width(parseInt(value, 10)) : undefined}),
						__nextHasNoMarginBottom: true,
					})
				)
			)
		);
	}, 'withSccaColumnSpan');

	wp.hooks.addFilter('editor.BlockEdit', 'scca/column-span', withSpan);
})(window.wp);
