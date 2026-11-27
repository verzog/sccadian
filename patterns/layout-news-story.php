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
 * Title: News story
 * Slug: scca/layout-news-story
 * Categories: scca-story-layouts
 * Block Types: core/post-content
 * Post Types: post
 * Description: A news story: lead paragraph, zoomable image, body text, key points and a button.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
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
