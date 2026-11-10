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
 * CI check, run inside WordPress with `wp eval-file`: the active theme registered
 * every pattern, the pattern category, every template and both template parts.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

// This is a WP-CLI test script, not theme code: plain output and file reads are intended.
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped

defined( 'ABSPATH' ) || exit( 1 );

$scca_theme_dir = get_stylesheet_directory();
$scca_errors    = [];

if ( 'scca' !== get_stylesheet() ) {
	$scca_errors[] = 'Active theme is ' . get_stylesheet() . ', not scca.';
}

if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( 'scca' ) ) {
	$scca_errors[] = 'Pattern category scca is not registered.';
}

if ( ! WP_Block_Type_Registry::get_instance()->is_registered( 'scca/carousel' ) ) {
	$scca_errors[] = 'Block scca/carousel is not registered.';
}

$scca_registry = WP_Block_Patterns_Registry::get_instance();
foreach ( glob( "$scca_theme_dir/patterns/*.php" ) as $scca_file ) {
	$scca_slug = 'scca/' . basename( $scca_file, '.php' );
	if ( ! $scca_registry->is_registered( $scca_slug ) ) {
		$scca_errors[] = "Pattern $scca_slug is not registered.";
		continue;
	}
	$scca_pattern = $scca_registry->get_registered( $scca_slug );
	if ( ! in_array( 'scca', $scca_pattern['categories'] ?? [], true ) ) {
		$scca_errors[] = "Pattern $scca_slug is not in the scca category.";
	}
	if ( '' === trim( do_blocks( $scca_pattern['content'] ) ) ) {
		$scca_errors[] = "Pattern $scca_slug renders nothing.";
	}
}

$scca_templates = wp_list_pluck( get_block_templates( [], 'wp_template' ), 'slug' );
foreach ( glob( "$scca_theme_dir/templates/*.html" ) as $scca_file ) {
	$scca_slug = basename( $scca_file, '.html' );
	if ( ! in_array( $scca_slug, $scca_templates, true ) ) {
		$scca_errors[] = "Template $scca_slug is not registered.";
	}
}

$scca_parts = wp_list_pluck( get_block_templates( [], 'wp_template_part' ), 'slug' );
foreach ( [ 'header', 'footer' ] as $scca_slug ) {
	if ( ! in_array( $scca_slug, $scca_parts, true ) ) {
		$scca_errors[] = "Template part $scca_slug is not registered.";
	}
}

if ( $scca_errors ) {
	WP_CLI::error( implode( PHP_EOL, $scca_errors ) );
}
WP_CLI::success( 'Patterns, templates and template parts are all registered.' );
