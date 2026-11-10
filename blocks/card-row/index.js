/**
 * Card row block: editor script. Plain JavaScript (no build step).
 *
 * Each card is a Group block (image, heading, text, button), so editors change
 * colours, images and text with WordPress's normal tools.
 *
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

(function(wp) {
	'use strict';

	const el = wp.element.createElement;
	const {__} = wp.i18n;
	const {registerBlockType} = wp.blocks;
	const {useBlockProps, useInnerBlocksProps, InspectorControls} = wp.blockEditor;
	const {PanelBody, ToggleControl, SelectControl, TextControl} = wp.components;

	const card = [
		'core/group',
		{className: 'scca-card scca-card--bordered', layout: {type: 'default'}},
		[
			['core/image', {sizeSlug: 'large'}],
			['core/group', {className: 'scca-card__body', layout: {type: 'default'}}, [
				['core/heading', {level: 3, placeholder: __('Card heading', 'scca')}],
				['core/paragraph', {placeholder: __('Card text', 'scca')}],
				['core/buttons', {}, [['core/button', {placeholder: __('Button text', 'scca')}]]],
			]],
		],
	];

	/**
	 * Wrapper classes shared by the editor and saved markup.
	 *
	 * @param {Object} a Block attributes.
	 * @returns {Object} Props for the wrapper element.
	 */
	const wrapperProps = (a) => ({
		className: [
			'is-size-' + a.cardSize,
			a.shadow ? 'has-card-shadow' : '',
			a.rounded ? 'has-rounded-cards' : '',
		].filter(Boolean).join(' '),
	});

	registerBlockType('scca/card-row', {
		edit: function Edit(props) {
			const a = props.attributes;
			const set = props.setAttributes;
			const blockProps = useBlockProps(wrapperProps(a));
			const innerProps = useInnerBlocksProps(
				{className: 'scca-card-row__track'},
				{allowedBlocks: ['core/group'], template: [card, card, card, card], orientation: 'horizontal'}
			);

			return el(
				wp.element.Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{title: __('Cards', 'scca')},
						el(SelectControl, {
							label: __('Card size', 'scca'),
							help: __('Every card is the same width; images are cropped to the same height.', 'scca'),
							value: a.cardSize,
							options: [
								{label: __('Small', 'scca'), value: 'small'},
								{label: __('Medium', 'scca'), value: 'medium'},
								{label: __('Large', 'scca'), value: 'large'},
							],
							onChange: (v) => set({cardSize: v}),
							__nextHasNoMarginBottom: true,
						}),
						el(ToggleControl, {
							label: __('Drop shadow', 'scca'),
							checked: a.shadow,
							onChange: (v) => set({shadow: v}),
							__nextHasNoMarginBottom: true,
						}),
						el(ToggleControl, {
							label: __('Rounded corners', 'scca'),
							checked: a.rounded,
							onChange: (v) => set({rounded: v}),
							__nextHasNoMarginBottom: true,
						})
					),
					el(
						PanelBody,
						{title: __('Controls', 'scca')},
						el(ToggleControl, {
							label: __('Show previous and next arrows', 'scca'),
							help: __('Visitors can always swipe, use a trackpad, or scroll with the keyboard.', 'scca'),
							checked: a.showArrows,
							onChange: (v) => set({showArrows: v}),
							__nextHasNoMarginBottom: true,
						}),
						el(TextControl, {
							label: __('Name for screen readers', 'scca'),
							help: __('Read out before the cards, e.g. "Upcoming courses". Defaults to "Cards".', 'scca'),
							value: a.label,
							onChange: (v) => set({label: v}),
							__nextHasNoMarginBottom: true,
						})
					)
				),
				el('div', blockProps, el('div', innerProps))
			);
		},

		save: function Save(props) {
			const a = props.attributes;
			const blockProps = wp.blockEditor.useBlockProps.save(Object.assign(wrapperProps(a), {
				'data-arrows': a.showArrows ? 'true' : 'false',
				'data-label': a.label || undefined,
			}));
			return el('div', blockProps, el('div', wp.blockEditor.useInnerBlocksProps.save({className: 'scca-card-row__track'})));
		},
	});
})(window.wp);
