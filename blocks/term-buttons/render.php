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
 * Server render for the Sub-category buttons block.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$scca_term = get_queried_object();
if ( ! $scca_term instanceof WP_Term || ! is_taxonomy_hierarchical( $scca_term->taxonomy ) ) {
	return;
}
// On a sub-category's page, its brothers and sisters under the same main category.
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
	esc_attr( sprintf( __( '%s categories', 'scca' ), $scca_main->name ) ),
	$scca_items // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped as it is built.
);
