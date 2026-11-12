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
 * Static checks for the theme that need no WordPress install.
 *
 * Run from the theme root: php tests/check-theme.php
 * Exits 1 and lists every problem if any check fails.
 *
 * Checks:
 * - theme.json is valid JSON, and its template parts and custom templates have files.
 * - Every block comment in templates, parts and patterns has valid JSON attributes,
 *   and every opening block comment has a matching closing one.
 * - Every pattern has Title, Slug and Categories headers, with a unique scca/ slug.
 * - Every pattern and template part a template references exists.
 * - style.css has the theme headers WordPress needs.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

// This is a CLI test script, not theme code: plain output and file reads are intended.
// phpcs:disable WordPress.WP.AlternativeFunctions, WordPress.Security.EscapeOutput.OutputNotEscaped
// phpcs:disable WordPress.PHP.YodaConditions.NotYoda

if ( 'cli' !== PHP_SAPI ) {
	exit( 1 );
}

$scca_root   = dirname( __DIR__ );
$scca_errors = [];

/**
 * Check one file's block markup: valid attribute JSON and balanced open/close comments.
 *
 * @param string $file     Path relative to the theme root, for messages.
 * @param string $markup   The block markup.
 * @param array  $errors   Error list, appended to.
 * @return array[] Every block found, each with 'name' and 'attrs'.
 */
function scca_check_markup( string $file, string $markup, array &$errors ): array {
	$blocks = [];
	$stack  = [];
	preg_match_all(
		'/<!--\s+(\/)?wp:([a-z][a-z0-9_-]*(?:\/[a-z][a-z0-9_-]*)?)\s+((?:\{.*?\})\s+)?(\/)?-->/s',
		$markup,
		$matches,
		PREG_SET_ORDER | PREG_OFFSET_CAPTURE
	);
	foreach ( $matches as $match ) {
		$closing   = '' !== ( $match[1][0] ?? '' );
		$name      = $match[2][0];
		$json      = trim( $match[3][0] ?? '' );
		$selfclose = '' !== ( $match[4][0] ?? '' );
		$line      = substr_count( substr( $markup, 0, $match[0][1] ), "\n" ) + 1;
		$attrs     = [];

		if ( '' !== $json ) {
			$attrs = json_decode( $json, true );
			if ( ! is_array( $attrs ) ) {
				$errors[] = "$file:$line: invalid JSON in wp:$name attributes (" . json_last_error_msg() . ').';
				$attrs    = [];
			}
		}

		if ( $closing ) {
			$open = array_pop( $stack );
			if ( null === $open ) {
				$errors[] = "$file:$line: closing /wp:$name has no opening comment.";
			} elseif ( $open !== $name ) {
				$errors[] = "$file:$line: closing /wp:$name, but wp:$open is still open.";
			}
			continue;
		}

		$blocks[] = [
			'name'  => $name,
			'attrs' => $attrs,
		];
		if ( ! $selfclose ) {
			$stack[] = $name;
		}
	}
	foreach ( $stack as $open ) {
		$errors[] = "$file: wp:$open is never closed.";
	}
	return $blocks;
}

// Theme.json: valid, and every file it names exists.
$scca_json = json_decode( (string) file_get_contents( "$scca_root/theme.json" ), true );
if ( ! is_array( $scca_json ) ) {
	$scca_errors[] = 'theme.json: invalid JSON (' . json_last_error_msg() . ').';
	$scca_json     = [];
}
foreach ( $scca_json['templateParts'] ?? [] as $scca_part ) {
	if ( ! is_file( "$scca_root/parts/{$scca_part['name']}.html" ) ) {
		$scca_errors[] = "theme.json: template part '{$scca_part['name']}' has no parts/{$scca_part['name']}.html.";
	}
}
foreach ( $scca_json['customTemplates'] ?? [] as $scca_template ) {
	if ( ! is_file( "$scca_root/templates/{$scca_template['name']}.html" ) ) {
		$scca_errors[] = "theme.json: custom template '{$scca_template['name']}' has no templates/{$scca_template['name']}.html.";
	}
}
foreach ( $scca_json['settings']['typography']['fontFamilies'] ?? [] as $scca_family ) {
	foreach ( $scca_family['fontFace'] ?? [] as $scca_face ) {
		foreach ( $scca_face['src'] ?? [] as $scca_src ) {
			if ( str_starts_with( $scca_src, 'file:./' ) && ! is_file( $scca_root . '/' . substr( $scca_src, 7 ) ) ) {
				$scca_errors[] = "theme.json: font file $scca_src does not exist.";
			}
		}
	}
}

// Patterns: headers present, slugs unique, markup valid.
$scca_patterns = [];
$scca_blocks   = [];
// Column layouts (layouts/, administrators only) are patterns too.
foreach ( array_merge( glob( "$scca_root/patterns/*.php" ), glob( "$scca_root/layouts/*.php" ) ) as $scca_path ) {
	$scca_file   = basename( dirname( $scca_path ) ) . '/' . basename( $scca_path );
	$scca_source = (string) file_get_contents( $scca_path );
	foreach ( [ 'Title', 'Slug', 'Categories' ] as $scca_header ) {
		if ( ! preg_match( '/^\s*\*\s*' . $scca_header . ':\s*(\S.*)$/m', $scca_source, $scca_m ) ) {
			$scca_errors[] = "$scca_file: missing '$scca_header:' header.";
			continue;
		}
		if ( 'Slug' === $scca_header ) {
			$scca_slug = trim( $scca_m[1] );
			if ( ! str_starts_with( $scca_slug, 'scca/' ) ) {
				$scca_errors[] = "$scca_file: slug '$scca_slug' must start with scca/.";
			}
			if ( isset( $scca_patterns[ $scca_slug ] ) ) {
				$scca_errors[] = "$scca_file: slug '$scca_slug' is also used by {$scca_patterns[$scca_slug]}.";
			}
			$scca_patterns[ $scca_slug ] = $scca_file;
		}
	}
	$scca_markup = substr( $scca_source, (int) strpos( $scca_source, '?>' ) + 2 );
	$scca_blocks = array_merge( $scca_blocks, scca_check_markup( $scca_file, $scca_markup, $scca_errors ) );
}

// Templates and parts: markup valid, references resolve.
$scca_files = array_merge( glob( "$scca_root/templates/*.html" ), glob( "$scca_root/parts/*.html" ) );
foreach ( $scca_files as $scca_path ) {
	$scca_file   = basename( dirname( $scca_path ) ) . '/' . basename( $scca_path );
	$scca_found  = scca_check_markup( $scca_file, (string) file_get_contents( $scca_path ), $scca_errors );
	$scca_blocks = array_merge( $scca_blocks, $scca_found );
	foreach ( $scca_found as $scca_block ) {
		if ( 'pattern' === $scca_block['name'] && ! isset( $scca_patterns[ $scca_block['attrs']['slug'] ?? '' ] ) ) {
			$scca_errors[] = "$scca_file: pattern '" . ( $scca_block['attrs']['slug'] ?? '' ) . "' does not exist.";
		}
		if ( 'template-part' === $scca_block['name'] ) {
			$scca_slug = $scca_block['attrs']['slug'] ?? '';
			if ( ! is_file( "$scca_root/parts/$scca_slug.html" ) ) {
				$scca_errors[] = "$scca_file: template part '$scca_slug' does not exist.";
			}
		}
	}
}

// Colour slugs used in markup must be in the theme.json palette.
$scca_palette = array_column( $scca_json['settings']['color']['palette'] ?? [], 'slug' );
foreach ( $scca_blocks as $scca_block ) {
	foreach ( [ 'backgroundColor', 'textColor', 'overlayColor', 'iconColor', 'iconBackgroundColor' ] as $scca_key ) {
		$scca_slug = $scca_block['attrs'][ $scca_key ] ?? null;
		if ( null !== $scca_slug && ! in_array( $scca_slug, $scca_palette, true ) ) {
			$scca_errors[] = "wp:{$scca_block['name']}: $scca_key '$scca_slug' is not in the theme.json palette.";
		}
	}
}

// Style.css: the headers WordPress reads.
$scca_style = (string) file_get_contents( "$scca_root/style.css" );
foreach ( [ 'Theme Name', 'Version', 'Requires at least', 'Requires PHP', 'Text Domain' ] as $scca_header ) {
	if ( ! preg_match( '/^' . $scca_header . ':\s*\S/m', $scca_style ) ) {
		$scca_errors[] = "style.css: missing '$scca_header:' header.";
	}
}

if ( $scca_errors ) {
	echo implode( PHP_EOL, array_unique( $scca_errors ) ) . PHP_EOL;
	echo count( array_unique( $scca_errors ) ) . ' problem(s) found.' . PHP_EOL;
	exit( 1 );
}
echo 'Theme checks passed: ' . count( $scca_patterns ) . ' patterns, ' . count( $scca_files ) . ' templates and parts, '
	. count( $scca_blocks ) . ' blocks.' . PHP_EOL;
