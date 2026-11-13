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
 * Title: Blog grid
 * Slug: scca/blog-grid
 * Categories: scca
 * Inserter: no
 * Description: Members' blog cards for the current listing (Wormiss blog home, category or topic): picture, date and author, title, summary, category and level badges, topics; 12 a page with pagination.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

?>
<!-- wp:query {"queryId":3,"query":{"perPage":12,"pages":0,"offset":0,"postType":"wormiss_blog","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"scca-news scca-blog-list"} -->
<div class="wp-block-query scca-news scca-blog-list"><!-- wp:post-template {"className":"scca-news-grid","layout":{"type":"default"}} -->
<!-- wp:group {"className":"scca-card scca-card--bordered scca-blog-card","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card scca-card--bordered scca-blog-card"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3"} /-->

<!-- wp:group {"className":"scca-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card__body"><!-- wp:group {"className":"scca-blog-card__meta","layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group scca-blog-card__meta"><!-- wp:post-date {"format":"d/m/Y"} /-->

<!-- wp:post-author-name /--></div>
<!-- /wp:group -->

<!-- wp:post-title {"level":3,"isLink":true,"className":"scca-blog-card__title"} /-->

<!-- wp:post-excerpt {"excerptLength":20,"className":"scca-blog-card__summary"} /-->

<!-- wp:post-terms {"term":"wormiss_blog_category","className":"scca-blog-badges"} /-->

<!-- wp:post-terms {"term":"wormiss_blog_topic","className":"scca-blog-card__topics"} /--></div>
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
<p>No blog posts found.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
