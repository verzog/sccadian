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
 * Title: News story
 * Slug: scca/layout-news-story
 * Categories: scca-story-layouts
 * Block Types: core/post-content
 * Post Types: post
 * Description: A news story: lead paragraph, zoomable image, body text, key points and a button.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

?>
<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size">[Lead paragraph: the story in one or two sentences.]</p>
<!-- /wp:paragraph -->

<!-- wp:image {"sizeSlug":"large","lightbox":{"enabled":true}} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/placeholder.svg' ) ); ?>" alt=""/><figcaption class="wp-element-caption">[Caption]</figcaption></figure>
<!-- /wp:image -->

<!-- wp:paragraph -->
<p>[Body text]</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>[Body text]</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"scca-callout","backgroundColor":"lavender","layout":{"type":"default"}} -->
<div class="wp-block-group scca-callout has-lavender-background-color has-background"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Key points</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li>[Key point]</li>
<!-- /wp:list-item --><!-- wp:list-item -->
<li>[Key point]</li>
<!-- /wp:list-item --><!-- wp:list-item -->
<li>[Key point]</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Find out more</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
