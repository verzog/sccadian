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
 * Title: Event grid
 * Slug: scca/event-grid
 * Categories: scca
 * Inserter: no
 * Description: Event cards for the events listing and event type pages (image, title, event type, summary, Event details), with pagination. No publish date: it is not the event's date.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

?>
<!-- wp:query {"queryId":3,"query":{"perPage":12,"pages":0,"offset":0,"postType":"wormiss_event","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"scca-news"} -->
<div class="wp-block-query scca-news"><!-- wp:post-template {"className":"scca-news-grid","layout":{"type":"default"}} -->
<!-- wp:group {"className":"scca-card scca-card--bordered","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card scca-card--bordered"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9"} /-->

<!-- wp:group {"className":"scca-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group scca-card__body"><!-- wp:post-title {"level":3,"isLink":true} /-->

<!-- wp:post-terms {"term":"wormiss_event_type","className":"scca-event__type"} /-->

<!-- wp:post-excerpt {"excerptLength":30} /-->

<!-- wp:read-more {"content":"Event details"} /--></div>
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
<p>No events to show yet.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
