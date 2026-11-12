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
	register_block_pattern_category(
		'scca-layouts',
		[ 'label' => __( 'SCCA layouts (12-column grid)', 'scca' ) ]
	);
}
add_action( 'init', 'scca_register_pattern_category' );

/**
 * Register the theme's own blocks (carousel, card row).
 *
 * @return void
 */
function scca_register_blocks(): void {
	register_block_type( __DIR__ . '/blocks/carousel' );
	register_block_type( __DIR__ . '/blocks/card-row' );
}
add_action( 'init', 'scca_register_blocks' );

/**
 * Whether the current user may arrange pages into columns (administrators only).
 *
 * @return bool
 */
function scca_can_lay_out(): bool {
	return current_user_can( 'manage_options' );
}

/**
 * Register the column layouts in layouts/ (widths in twelfths, like a Bootstrap grid), for
 * administrators only: they are not in patterns/, which WordPress offers to everyone.
 *
 * @return void
 */
function scca_register_layout_patterns(): void {
	if ( ! scca_can_lay_out() ) {
		return;
	}
	foreach ( glob( __DIR__ . '/layouts/*.php' ) as $scca_file ) {
		$scca_data = get_file_data(
			$scca_file,
			[
				'title'       => 'Title',
				'slug'        => 'Slug',
				'categories'  => 'Categories',
				'description' => 'Description',
			]
		);
		if ( '' === $scca_data['slug'] || '' === $scca_data['title'] ) {
			continue;
		}
		ob_start();
		include $scca_file;
		register_block_pattern(
			$scca_data['slug'],
			[
				'title'       => $scca_data['title'],
				'description' => $scca_data['description'],
				'categories'  => array_map( 'trim', explode( ',', $scca_data['categories'] ) ),
				'content'     => (string) ob_get_clean(),
			]
		);
	}
}
add_action( 'init', 'scca_register_layout_patterns', 20 );

/**
 * Keep the Columns block out of the inserter for anyone but administrators. Columns already on
 * a page can still be edited.
 *
 * @param array $metadata Block metadata.
 * @return array
 */
function scca_columns_for_admins( $metadata ) {
	if ( is_array( $metadata ) && in_array( $metadata['name'] ?? '', [ 'core/columns', 'core/column' ], true ) && ! scca_can_lay_out() ) {
		$metadata['supports']             = is_array( $metadata['supports'] ?? null ) ? $metadata['supports'] : [];
		$metadata['supports']['inserter'] = false;
	}
	return $metadata;
}
add_filter( 'block_type_metadata', 'scca_columns_for_admins' );

/**
 * Only administrators can lock and unlock blocks, so the column layouts (inserted locked: their
 * columns cannot be moved or removed, and no column can be added, though what is in each column
 * stays editable) keep their shape for everyone else.
 *
 * @param array $settings Block editor settings.
 * @return array
 */
function scca_lock_blocks_for_admins( $settings ) {
	if ( is_array( $settings ) ) {
		$settings['canLockBlocks'] = scca_can_lay_out();
	}
	return $settings;
}
add_filter( 'block_editor_settings_all', 'scca_lock_blocks_for_admins' );

/**
 * The "Grid width" setting on columns in the editor, for administrators.
 *
 * @return void
 */
function scca_column_span_script(): void {
	if ( ! scca_can_lay_out() ) {
		return;
	}
	wp_enqueue_script(
		'scca-column-span',
		get_theme_file_uri( 'assets/js/column-span.js' ),
		[ 'wp-block-editor', 'wp-components', 'wp-compose', 'wp-element', 'wp-hooks', 'wp-i18n' ],
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'scca_column_span_script' );
