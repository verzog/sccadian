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
 * Title: Post grid
 * Slug: scca/post-grid
 * Categories: scca
 * Inserter: no
 * Description: News cards for the current listing (blog, archive or search), with pagination. Used by the index, archive and search templates.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

?>
<!-- wp:query {"queryId":2,"query":{"perPage":12,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"scca-news"} -->
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

<!-- wp:query-pagination -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph -->
<p>Nothing found.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
