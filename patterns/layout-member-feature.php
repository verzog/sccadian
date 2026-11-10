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
 * Title: Member or research feature
 * Slug: scca/layout-member-feature
 * Categories: scca-story-layouts
 * Block Types: core/post-content
 * Post Types: post
 * Description: A feature article: image and introduction, questions and answers, and a table.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

?>
<!-- wp:media-text {"mediaType":"image"} -->
<div class="wp-block-media-text is-stacked-on-mobile"><figure class="wp-block-media-text__media"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/placeholder.svg' ) ); ?>" alt=""/></figure><div class="wp-block-media-text__content"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">[Name or project]</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>[Introduction]</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:media-text -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Questions and answers</h2>
<!-- /wp:heading -->

<!-- wp:details -->
<details class="wp-block-details"><summary>[Question 1]</summary><!-- wp:paragraph -->
<p>[Answer]</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary>[Question 2]</summary><!-- wp:paragraph -->
<p>[Answer]</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary>[Question 3]</summary><!-- wp:paragraph -->
<p>[Answer]</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:table {"hasFixedLayout":true,"className":"is-style-stripes"} -->
<figure class="wp-block-table is-style-stripes"><table class="has-fixed-layout"><thead><tr><th>Course</th><th>Date</th><th>Location</th></tr></thead><tbody><tr><td>[Course name]</td><td>[DD/MM/YYYY]</td><td>[City]</td></tr><tr><td>[Course name]</td><td>[DD/MM/YYYY]</td><td>[City]</td></tr><tr><td>[Course name]</td><td>[DD/MM/YYYY]</td><td>[City]</td></tr></tbody></table><figcaption class="wp-element-caption">[Table caption]</figcaption></figure>
<!-- /wp:table -->
