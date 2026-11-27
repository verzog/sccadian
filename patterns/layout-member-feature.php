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
 * Title: Member or research feature
 * Slug: scca/layout-member-feature
 * Categories: scca-story-layouts
 * Block Types: core/post-content
 * Post Types: post
 * Description: A feature article: image and introduction, questions and answers, and a table.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
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
