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
 * Title: Blog grid
 * Slug: scca/blog-grid
 * Categories: scca
 * Inserter: no
 * Description: Members' blog cards for the current listing (Wormiss blog home, category or topic), as on the iMIS blog: picture, date and author with the comment count, title, summary, category and level badges, topics; 12 a page with pagination.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

?>
<!-- wp:query {"queryId":3,"query":{"perPage":12,"pages":0,"offset":0,"postType":"wormiss_blog","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"scca-news scca-blog-list"} -->
<div class="wp-block-query scca-news scca-blog-list"><!-- wp:post-template {"className":"scca-news-grid","layout":{"type":"default"}} -->
<!-- wp:group {"className":"scca-card scca-card--bordered scca-blog-card","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card scca-card--bordered scca-blog-card"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2"} /-->

<!-- wp:group {"className":"scca-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card__body"><!-- wp:group {"className":"scca-blog-card__meta","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group scca-blog-card__meta"><!-- wp:group {"className":"scca-blog-card__byline","layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group scca-blog-card__byline"><!-- wp:post-date {"format":"j M Y"} /-->

<!-- wp:post-author-name /--></div>
<!-- /wp:group -->

<!-- wp:wormiss/blog-meta {"show":"comments"} /--></div>
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
