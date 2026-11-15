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
 * Server render for the Back to parent page block.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
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
