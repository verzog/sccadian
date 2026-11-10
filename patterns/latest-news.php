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
 * Title: Latest news
 * Slug: scca/latest-news
 * Categories: scca
 * Description: The three most recent posts as cards with image, title, excerpt, date and a Read more button.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

?>
<!-- wp:group {"align":"full","className":"scca-section","backgroundColor":"grey-light","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull scca-section has-grey-light-background-color has-background"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:heading -->
<h2 class="wp-block-heading">Latest News</h2>
<!-- /wp:heading -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/news/">All News</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":1,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"scca-news"} -->
<div class="wp-block-query scca-news"><!-- wp:post-template {"className":"scca-news-grid","layout":{"type":"default"}} -->
<!-- wp:group {"className":"scca-card scca-card--bordered","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card scca-card--bordered"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9"} /-->

<!-- wp:group {"className":"scca-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card__body"><!-- wp:post-title {"level":3,"isLink":true} /-->

<!-- wp:post-excerpt {"excerptLength":30} /-->

<!-- wp:post-date {"format":"d/m/Y","className":"scca-news__date"} /-->

<!-- wp:read-more {"content":"Read more"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph -->
<p>No news has been published yet.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->
