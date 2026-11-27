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
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
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
