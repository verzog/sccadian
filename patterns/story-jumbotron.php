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
 * Title: Jumbotron
 * Slug: scca/story-jumbotron
 * Categories: scca-story
 * Description: A purple banner with a heading, lead text and button. Add a background image in the sidebar.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

?>
<!-- wp:cover {"dimRatio":70,"overlayColor":"purple","isUserOverlayColor":true,"minHeight":360,"minHeightUnit":"px","className":"scca-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-cover scca-hero" style="min-height:360px"><span aria-hidden="true" class="wp-block-cover__background has-purple-background-color has-background-dim-70 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading -->
<h2 class="wp-block-heading">[Headline]</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size">[Lead text]</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Find out more</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->
