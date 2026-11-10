/**
 * Carousel block: editor script. Plain JavaScript (no build step).
 *
 * In the editor the slides are shown one under another so each can be edited;
 * on the site, view.js turns them into a carousel.
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
	const {PanelBody, ToggleControl, RangeControl, SelectControl, TextControl} = wp.components;

	/**
	 * Slide template: a purple Cover with a heading, text and a button.
	 *
	 * @param {number} level Heading level.
	 * @returns {Array} Block template entry.
	 */
	const slide = (level) => [
		'core/cover',
		{overlayColor: 'purple', isUserOverlayColor: true, dimRatio: 70, layout: {type: 'constrained'}},
		[
			['core/heading', {level: level, placeholder: __('Slide heading', 'scca')}],
			['core/paragraph', {placeholder: __('Slide text', 'scca'), fontSize: 'large'}],
			['core/buttons', {}, [['core/button', {placeholder: __('Button text', 'scca')}]]],
		],
	];

	/**
	 * Wrapper attributes shared by the editor and saved markup.
	 *
	 * @param {Object} a Block attributes.
	 * @returns {Object} Props for the wrapper element.
	 */
	const wrapperProps = (a) => ({
		className: 'is-transition-' + a.transition,
		style: {
			'--scca-carousel-height': a.height + 'px',
			'--scca-carousel-height-mobile': a.mobileHeight + 'px',
			'--scca-carousel-duration': a.transitionDuration + 'ms',
		},
	});

	registerBlockType('scca/carousel', {
		edit: function Edit(props) {
			const a = props.attributes;
			const set = props.setAttributes;
			const blockProps = useBlockProps(wrapperProps(a));
			const innerProps = useInnerBlocksProps(
				{className: 'scca-carousel__track'},
				{allowedBlocks: ['core/cover'], template: [slide(1), slide(2)], orientation: 'vertical'}
			);

			return el(
				wp.element.Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{title: __('Playback', 'scca')},
						el(ToggleControl, {
							label: __('Play automatically', 'scca'),
							help: __('Pauses on hover and keyboard focus, and has a pause button. Never plays for visitors '
								+ 'who have asked their device to reduce motion.', 'scca'),
							checked: a.autoplay,
							onChange: (v) => set({autoplay: v}),
							__nextHasNoMarginBottom: true,
						}),
						a.autoplay && el(RangeControl, {
							label: __('Seconds per slide', 'scca'),
							value: a.speed,
							min: 3,
							max: 15,
							onChange: (v) => set({speed: v || 6}),
							__nextHasNoMarginBottom: true,
						}),
						el(SelectControl, {
							label: __('Transition', 'scca'),
							value: a.transition,
							options: [
								{label: __('Slide', 'scca'), value: 'slide'},
								{label: __('Fade', 'scca'), value: 'fade'},
							],
							onChange: (v) => set({transition: v}),
							__nextHasNoMarginBottom: true,
						}),
						el(RangeControl, {
							label: __('Transition length (milliseconds)', 'scca'),
							value: a.transitionDuration,
							min: 200,
							max: 1500,
							step: 100,
							onChange: (v) => set({transitionDuration: v || 600}),
							__nextHasNoMarginBottom: true,
						})
					),
					el(
						PanelBody,
						{title: __('Size', 'scca')},
						el(RangeControl, {
							label: __('Minimum height on computers (px)', 'scca'),
							value: a.height,
							min: 240,
							max: 900,
							step: 10,
							onChange: (v) => set({height: v || 480}),
							__nextHasNoMarginBottom: true,
						}),
						el(RangeControl, {
							label: __('Minimum height on phones (px)', 'scca'),
							help: __('Used on screens narrower than 782px. Slides grow taller if their text needs more room. '
								+ 'Leave each slide\'s own Minimum height empty, or it overrides these.', 'scca'),
							value: a.mobileHeight,
							min: 240,
							max: 900,
							step: 10,
							onChange: (v) => set({mobileHeight: v || 420}),
							__nextHasNoMarginBottom: true,
						})
					),
					el(
						PanelBody,
						{title: __('Controls', 'scca')},
						el(ToggleControl, {
							label: __('Show previous and next arrows', 'scca'),
							checked: a.showArrows,
							onChange: (v) => set({showArrows: v}),
							__nextHasNoMarginBottom: true,
						}),
						el(ToggleControl, {
							label: __('Show slide dots', 'scca'),
							help: (!a.autoplay && !a.showArrows && !a.showDots)
								? __('With autoplay, arrows and dots all off, visitors could not reach the other slides, '
									+ 'so the slides are shown one under another instead.', 'scca')
								: undefined,
							checked: a.showDots,
							onChange: (v) => set({showDots: v}),
							__nextHasNoMarginBottom: true,
						}),
						el(TextControl, {
							label: __('Name for screen readers', 'scca'),
							help: __('Read out before the slides, e.g. "Featured courses". Defaults to "Featured".', 'scca'),
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
				'data-autoplay': a.autoplay ? 'true' : 'false',
				'data-speed': String(a.speed),
				'data-arrows': a.showArrows ? 'true' : 'false',
				'data-dots': a.showDots ? 'true' : 'false',
				'data-label': a.label || undefined,
			}));
			return el('div', blockProps, el('div', wp.blockEditor.useInnerBlocksProps.save({className: 'scca-carousel__track'})));
		},
	});
})(window.wp);
