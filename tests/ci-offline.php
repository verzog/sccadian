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
 * CI-only must-use plugin: answer requests to wordpress.org (update checks, dashboard
 * feeds) at once with an empty reply, so the single-threaded test server never waits on
 * them and failed checks never write warnings to debug.log. Never shipped in the theme.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

defined( 'ABSPATH' ) || exit;

add_filter(
	'pre_http_request',
	static function ( $pre, $args, $url ) {
		unset( $args );
		$host = (string) wp_parse_url( $url, PHP_URL_HOST );
		if ( 'wordpress.org' !== $host && ! str_ends_with( $host, '.wordpress.org' ) ) {
			return $pre;
		}
		return [
			'headers'  => [],
			'body'     => '{}',
			'response' => [
				'code'    => 200,
				'message' => 'OK',
			],
			'cookies'  => [],
			'filename' => null,
		];
	},
	10,
	3
);
