<?php
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
 * SCCA block theme setup.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Set up theme supports.
 *
 * @return void
 */
function scca_setup(): void {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'scca_setup' );

/**
 * Load the theme stylesheet on the front end.
 *
 * @return void
 */
function scca_enqueue_styles(): void {
	wp_enqueue_style(
		'scca-style',
		get_stylesheet_uri(),
		[],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'scca_enqueue_styles' );

/**
 * Register the pattern categories the theme's patterns use.
 *
 * @return void
 */
function scca_register_pattern_category(): void {
	register_block_pattern_category(
		'scca',
		[ 'label' => __( 'SCCA sections', 'scca' ) ]
	);
	register_block_pattern_category(
		'scca-story',
		[ 'label' => __( 'SCCA story components', 'scca' ) ]
	);
	register_block_pattern_category(
		'scca-story-layouts',
		[ 'label' => __( 'SCCA new story layouts', 'scca' ) ]
	);
}
add_action( 'init', 'scca_register_pattern_category' );

/**
 * Register the theme's own blocks (the carousel).
 *
 * @return void
 */
function scca_register_blocks(): void {
	register_block_type( __DIR__ . '/blocks/carousel' );
}
add_action( 'init', 'scca_register_blocks' );
