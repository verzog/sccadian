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
 * Title: Card group
 * Slug: scca/story-card-group
 * Categories: scca-story
 * Description: Three cards with an image, title and text: 3 across, 2 on tablets, 1 on phones. Replace each image and add alt text.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

?>
<!-- wp:group {"className":"scca-card-grid","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card-grid"><!-- wp:group {"className":"scca-card scca-card--bordered","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card scca-card--bordered"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/placeholder.svg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"scca-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card__body"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">[Card title]</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>[Card text]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"scca-card scca-card--bordered","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card scca-card--bordered"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/placeholder.svg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"scca-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card__body"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">[Card title]</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>[Card text]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"scca-card scca-card--bordered","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card scca-card--bordered"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/placeholder.svg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"scca-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card__body"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">[Card title]</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>[Card text]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
