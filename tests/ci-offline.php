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
 * CI-only must-use plugin: no update checks, and no waiting on wordpress.org.
 *
 * The single-threaded test server blocks while WordPress calls wordpress.org (update
 * checks, dashboard feeds, the pattern directory), which made logins time out. Update
 * checks are switched off (CI never needs them, and a failed check writes a warning to
 * debug.log), and any other wordpress.org request is declined at once. Never shipped
 * in the theme.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

defined( 'ABSPATH' ) || exit;

// Update checks: hooked in wp-includes/update.php, which loads before must-use plugins.
remove_action( 'admin_init', '_maybe_update_core' );
remove_action( 'admin_init', '_maybe_update_plugins' );
remove_action( 'admin_init', '_maybe_update_themes' );
remove_action( 'wp_version_check', 'wp_version_check' );
remove_action( 'wp_update_plugins', 'wp_update_plugins' );
remove_action( 'wp_update_themes', 'wp_update_themes' );
remove_action( 'wp_maybe_auto_update', 'wp_maybe_auto_update' );
remove_action( 'init', 'wp_schedule_update_checks' );

add_filter(
	'pre_http_request',
	static function ( $pre, $args, $url ) {
		unset( $args );
		$host = (string) wp_parse_url( $url, PHP_URL_HOST );
		if ( 'wordpress.org' === $host || str_ends_with( $host, '.wordpress.org' ) ) {
			return new WP_Error( 'scca_ci_offline', 'wordpress.org is not contacted in CI.' );
		}
		return $pre;
	},
	10,
	3
);
