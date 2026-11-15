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
 * SCCA block theme setup.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Set up theme supports.
 *
 * @return void
 */
function scca_setup(): void {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
	// Pages get an excerpt box: a board member's role (e.g. President) goes there.
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'scca_setup' );

/**
 * Load the theme stylesheet on the front end.
 *
 * @return void
 */
function scca_enqueue_styles(): void {
	wp_enqueue_style(
		'scca-style',
		get_stylesheet_uri(),
		[],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'scca_enqueue_styles' );

/**
 * Register the pattern categories the theme's patterns use.
 *
 * @return void
 */
function scca_register_pattern_category(): void {
	register_block_pattern_category(
		'scca',
		[ 'label' => __( 'SCCA sections', 'scca' ) ]
	);
	register_block_pattern_category(
		'scca-story',
		[ 'label' => __( 'SCCA story components', 'scca' ) ]
	);
	register_block_pattern_category(
		'scca-story-layouts',
		[ 'label' => __( 'SCCA new story layouts', 'scca' ) ]
	);
	register_block_pattern_category(
		'scca-layouts',
		[ 'label' => __( 'SCCA layouts (12-column grid)', 'scca' ) ]
	);
}
add_action( 'init', 'scca_register_pattern_category' );

/**
 * Friendly names for the theme's Wormiss templates (and the posts page), so the Site Editor's
 * template list says "Blog post" rather than single-wormiss_blog.
 *
 * @return array[] Template slug => title and description.
 */
function scca_template_names(): array {
	return [
		'home'                           => [
			'title'       => __( 'News list (Blog Home)', 'scca' ),
			'description' => __( 'The News page: the latest news posts as cards. WordPress calls it Blog Home; it is not the members\' blog.', 'scca' ),
		],
		'single-wormiss_blog'            => [
			'title'       => __( 'Blog post', 'scca' ),
			'description' => __( 'One members\' blog post: the blog intro and drop-downs, the post, its badges, author card, rail and discussion.', 'scca' ),
		],
		'archive-wormiss_blog'           => [
			'title'       => __( 'Blog home', 'scca' ),
			'description' => __( 'The members\' blog at /blogs/: the filters, then the post cards.', 'scca' ),
		],
		'taxonomy-wormiss_blog_category' => [
			'title'       => __( 'Blog category', 'scca' ),
			'description' => __( 'The members\' blog posts in one category or level.', 'scca' ),
		],
		'taxonomy-wormiss_blog_topic'    => [
			'title'       => __( 'Blog topic', 'scca' ),
			'description' => __( 'The members\' blog posts with one topic (tag).', 'scca' ),
		],
		'single-wormiss_event'           => [
			'title'       => __( 'Event', 'scca' ),
			'description' => __( 'One event page, with its details and registration.', 'scca' ),
		],
		'archive-wormiss_event'          => [
			'title'       => __( 'Events list', 'scca' ),
			'description' => __( 'All upcoming events.', 'scca' ),
		],
		'taxonomy-wormiss_event_type'    => [
			'title'       => __( 'Event type', 'scca' ),
			'description' => __( 'The events of one event type.', 'scca' ),
		],
	];
}

/**
 * Give WordPress the friendly template names.
 *
 * @param array $types Template types: slug => title and description.
 * @return array
 */
function scca_default_template_types( $types ): array {
	return array_merge( (array) $types, scca_template_names() );
}
add_filter( 'default_template_types', 'scca_default_template_types' );

/**
 * Register the theme's own blocks (carousel, card row).
 *
 * @return void
 */
function scca_register_blocks(): void {
	register_block_type( __DIR__ . '/blocks/carousel' );
	register_block_type( __DIR__ . '/blocks/card-row' );
	register_block_type( __DIR__ . '/blocks/parent-link' );
	register_block_type( __DIR__ . '/blocks/term-buttons' );
}
add_action( 'init', 'scca_register_blocks' );

/**
 * Whether the current user may arrange pages into columns (administrators only).
 *
 * @return bool
 */
function scca_can_lay_out(): bool {
	return current_user_can( 'manage_options' );
}

/**
 * Register the column layouts in layouts/ (widths in twelfths, like a Bootstrap grid), for
 * administrators only: they are not in patterns/, which WordPress offers to everyone.
 *
 * @return void
 */
function scca_register_layout_patterns(): void {
	if ( ! scca_can_lay_out() ) {
		return;
	}
	foreach ( glob( __DIR__ . '/layouts/*.php' ) as $scca_file ) {
		$scca_data = get_file_data(
			$scca_file,
			[
				'title'       => 'Title',
				'slug'        => 'Slug',
				'categories'  => 'Categories',
				'description' => 'Description',
			]
		);
		if ( '' === $scca_data['slug'] || '' === $scca_data['title'] ) {
			continue;
		}
		ob_start();
		include $scca_file;
		register_block_pattern(
			$scca_data['slug'],
			[
				'title'       => $scca_data['title'],
				'description' => $scca_data['description'],
				'categories'  => array_map( 'trim', explode( ',', $scca_data['categories'] ) ),
				'content'     => (string) ob_get_clean(),
			]
		);
	}
}
add_action( 'init', 'scca_register_layout_patterns', 20 );

/**
 * Keep the Columns block out of the inserter for anyone but administrators. Columns already on
 * a page can still be edited.
 *
 * @param array $metadata Block metadata.
 * @return array
 */
function scca_columns_for_admins( $metadata ) {
	if ( is_array( $metadata ) && in_array( $metadata['name'] ?? '', [ 'core/columns', 'core/column' ], true ) && ! scca_can_lay_out() ) {
		$metadata['supports']             = is_array( $metadata['supports'] ?? null ) ? $metadata['supports'] : [];
		$metadata['supports']['inserter'] = false;
	}
	return $metadata;
}
add_filter( 'block_type_metadata', 'scca_columns_for_admins' );

/**
 * Only administrators can lock and unlock blocks, so the column layouts (inserted locked: their
 * columns cannot be moved or removed, and no column can be added, though what is in each column
 * stays editable) keep their shape for everyone else.
 *
 * @param array $settings Block editor settings.
 * @return array
 */
function scca_lock_blocks_for_admins( $settings ) {
	if ( is_array( $settings ) ) {
		$settings['canLockBlocks'] = scca_can_lay_out();
	}
	return $settings;
}
add_filter( 'block_editor_settings_all', 'scca_lock_blocks_for_admins' );

/**
 * The "Grid width" setting on columns in the editor, for administrators.
 *
 * @return void
 */
function scca_column_span_script(): void {
	if ( ! scca_can_lay_out() ) {
		return;
	}
	wp_enqueue_script(
		'scca-column-span',
		get_theme_file_uri( 'assets/js/column-span.js' ),
		[ 'wp-block-editor', 'wp-components', 'wp-compose', 'wp-element', 'wp-hooks', 'wp-i18n' ],
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'scca_column_span_script' );

/**
 * A query marked "sccaChildrenOf": "current" (the Board page's grid) lists the pages under the
 * page being viewed, so each board member is a page under Our Board and shows up by itself.
 *
 * @param array    $query Query variables.
 * @param WP_Block $block The Post Template block.
 * @return array
 */
function scca_children_query( $query, $block ): array {
	$query = (array) $query;
	if ( ! $block instanceof WP_Block || 'current' !== ( $block->context['query']['sccaChildrenOf'] ?? '' ) ) {
		return $query;
	}
	$query['post_type']   = 'page';
	$query['post_status'] = 'publish';
	if ( is_page() ) {
		$query['post_parent'] = (int) get_queried_object_id();
	} else {
		// Anywhere but a page (such as a search), nothing.
		$query['post__in'] = [ 0 ];
	}
	return $query;
}
add_filter( 'query_loop_block_query_vars', 'scca_children_query', 10, 2 );
