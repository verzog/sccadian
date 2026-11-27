<?php
// This file is part of the SCCA WordPress theme.
//
// The SCCA theme is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// The SCCA theme is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with it. If not, see <https://www.gnu.org/licenses/>.

/**
 * CI check, run inside WordPress with `wp eval-file`: the active theme registered
 * every pattern, the pattern category, every template and both template parts.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This is a WP-CLI test script, not theme code: plain output and file reads are intended.
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped

defined( 'ABSPATH' ) || exit( 1 );

$scca_theme_dir = get_stylesheet_directory();
$scca_errors    = [];

if ( 'scca' !== get_stylesheet() ) {
	$scca_errors[] = 'Active theme is ' . get_stylesheet() . ', not scca.';
}

foreach ( [ 'scca', 'scca-story', 'scca-story-layouts' ] as $scca_category ) {
	if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $scca_category ) ) {
		$scca_errors[] = "Pattern category $scca_category is not registered.";
	}
}

foreach ( [ 'scca/carousel', 'scca/card-row' ] as $scca_block ) {
	if ( ! WP_Block_Type_Registry::get_instance()->is_registered( $scca_block ) ) {
		$scca_errors[] = "Block $scca_block is not registered.";
	}
}

$scca_registry = WP_Block_Patterns_Registry::get_instance();
foreach ( glob( "$scca_theme_dir/patterns/*.php" ) as $scca_file ) {
	$scca_slug = 'scca/' . basename( $scca_file, '.php' );
	if ( ! $scca_registry->is_registered( $scca_slug ) ) {
		$scca_errors[] = "Pattern $scca_slug is not registered.";
		continue;
	}
	$scca_pattern = $scca_registry->get_registered( $scca_slug );
	if ( ! array_filter( $scca_pattern['categories'] ?? [], fn( $c ) => str_starts_with( $c, 'scca' ) ) ) {
		$scca_errors[] = "Pattern $scca_slug is not in an SCCA category.";
	}
	if ( '' === trim( do_blocks( $scca_pattern['content'] ) ) ) {
		$scca_errors[] = "Pattern $scca_slug renders nothing.";
	}
}

// Column layouts are registered for administrators only.
if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( 'scca-layouts' ) ) {
	$scca_errors[] = 'Pattern category scca-layouts is not registered.';
}
if ( $scca_registry->is_registered( 'scca/layout-6-6' ) ) {
	$scca_errors[] = 'Column layouts are registered for someone who is not an administrator.';
}
$scca_admin = get_users(
	[
		'role'   => 'administrator',
		'number' => 1,
		'fields' => 'ID',
	]
);
wp_set_current_user( (int) ( $scca_admin[0] ?? 0 ) );
scca_register_layout_patterns();
foreach ( glob( "$scca_theme_dir/layouts/*.php" ) as $scca_file ) {
	$scca_slug = 'scca/layout-' . basename( $scca_file, '.php' );
	if ( ! $scca_registry->is_registered( $scca_slug ) ) {
		$scca_errors[] = "Layout $scca_slug is not registered for administrators.";
	} elseif ( '' === trim( do_blocks( $scca_registry->get_registered( $scca_slug )['content'] ) ) ) {
		$scca_errors[] = "Layout $scca_slug renders nothing.";
	}
}
$scca_columns = WP_Block_Type_Registry::get_instance()->get_registered( 'core/columns' );
if ( $scca_columns && false !== ( $scca_columns->supports['inserter'] ?? true ) ) {
	$scca_errors[] = 'The Columns block is in the inserter for someone who is not an administrator.';
}

$scca_templates = wp_list_pluck( get_block_templates( [], 'wp_template' ), 'slug' );
foreach ( glob( "$scca_theme_dir/templates/*.html" ) as $scca_file ) {
	$scca_slug = basename( $scca_file, '.html' );
	if ( ! in_array( $scca_slug, $scca_templates, true ) ) {
		$scca_errors[] = "Template $scca_slug is not registered.";
	}
}

$scca_titles = wp_list_pluck( get_block_templates( [], 'wp_template' ), 'title', 'slug' );
foreach ( scca_template_names() as $scca_slug => $scca_name ) {
	if ( isset( $scca_titles[ $scca_slug ] ) && $scca_name['title'] !== $scca_titles[ $scca_slug ] ) {
		$scca_errors[] = "Template $scca_slug is listed as {$scca_titles[ $scca_slug ]}, not {$scca_name['title']}.";
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
