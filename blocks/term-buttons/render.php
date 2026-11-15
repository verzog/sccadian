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
 * Server render for the Sub-category buttons block.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

$scca_term = get_queried_object();
if ( ! $scca_term instanceof WP_Term || ! is_taxonomy_hierarchical( $scca_term->taxonomy ) ) {
	return;
}
// On a sub-type's page, its brothers and sisters under the same main type.
$scca_main = $scca_term->parent ? get_term( $scca_term->parent, $scca_term->taxonomy ) : $scca_term;
if ( ! $scca_main instanceof WP_Term ) {
	return;
}
$scca_children = get_terms(
	[
		'taxonomy'   => $scca_term->taxonomy,
		'parent'     => $scca_main->term_id,
		'hide_empty' => true,
		'orderby'    => 'name',
	]
);
if ( ! is_array( $scca_children ) || ! $scca_children ) {
	return;
}
$scca_button = static function ( WP_Term $term, string $label, bool $current ): string {
	$link = get_term_link( $term );
	if ( ! is_string( $link ) ) {
		return '';
	}
	return '<li><a class="scca-term-buttons__button' . ( $current ? ' is-current' : '' ) . '" href="' . esc_url( $link ) . '"'
		. ( $current ? ' aria-current="page"' : '' ) . '>' . esc_html( $label ) . '</a></li>';
};
/* translators: %s: the main category or type, e.g. Courses. */
$scca_items = $scca_button( $scca_main, sprintf( __( 'All %s', 'scca' ), $scca_main->name ), $scca_main->term_id === $scca_term->term_id );
foreach ( $scca_children as $scca_child ) {
	$scca_items .= $scca_button( $scca_child, $scca_child->name, $scca_child->term_id === $scca_term->term_id );
}
printf(
	'<nav %1$s aria-label="%2$s"><ul class="scca-term-buttons__list">%3$s</ul></nav>',
	get_block_wrapper_attributes( [ 'class' => 'scca-term-buttons' ] ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped by WordPress.
	/* translators: %s: the main category or type, e.g. Courses. */
	esc_attr( sprintf( __( '%s types', 'scca' ), $scca_main->name ) ),
	$scca_items // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped as it is built.
);
