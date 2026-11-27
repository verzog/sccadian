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
 * Server render for the Back to parent page block.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$scca_post   = get_post( (int) ( $block->context['postId'] ?? get_the_ID() ) );
$scca_parent = $scca_post instanceof WP_Post && $scca_post->post_parent ? get_post( $scca_post->post_parent ) : null;
if ( $scca_parent instanceof WP_Post && 'publish' === $scca_parent->post_status ) {
	printf(
		'<p %1$s><a href="%2$s"><span aria-hidden="true">&larr;</span> %3$s</a></p>',
		get_block_wrapper_attributes( [ 'class' => 'scca-parent-link' ] ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped by WordPress.
		esc_url( (string) get_permalink( $scca_parent ) ),
		/* translators: %s: the parent page's title, e.g. Our Board. */
		esc_html( sprintf( __( 'Back to %s', 'scca' ), get_the_title( $scca_parent ) ) )
	);
}
