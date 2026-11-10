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
 * Title: Event recap
 * Slug: scca/layout-event-recap
 * Categories: scca-story-layouts
 * Block Types: core/post-content
 * Post Types: post
 * Description: An event recap: lead paragraph, photo cards, a quote and the next event.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

?>
<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size">[What happened, in one or two sentences.]</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"scca-card-grid","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card-grid"><!-- wp:group {"className":"scca-card scca-card--bordered","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card scca-card--bordered"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/placeholder.svg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"scca-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card__body"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">[Photo title]</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>[Short caption]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"scca-card scca-card--bordered","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card scca-card--bordered"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/placeholder.svg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"scca-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card__body"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">[Photo title]</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>[Short caption]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"scca-card scca-card--bordered","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card scca-card--bordered"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/placeholder.svg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"scca-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card__body"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">[Photo title]</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>[Short caption]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><!-- wp:paragraph -->
<p>[Quote from a speaker or attendee]</p>
<!-- /wp:paragraph --><cite>[Name, role]</cite></blockquote>
<!-- /wp:quote -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Next event</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"scca-banner","backgroundColor":"purple","textColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group scca-banner has-white-color has-text-color has-purple-background-color has-background"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading -->
<h2 class="wp-block-heading">[Event title]</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size">Presented by [Speaker name]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size"><strong>[DD/MM/YYYY]</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>[Time, e.g. 7:00pm AEDT]</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/events/">Register now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
