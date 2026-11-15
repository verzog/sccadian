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
 * Title: Relevant documents
 * Slug: scca/relevant-documents
 * Categories: scca
 * Description: A purple box headed "Relevant documents" with a button per document (e.g. the Board Charter and Constitution), for beside a page's introduction. Change each button's text and link to the document.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    Proprietary — Skin Cancer College Australasia, all rights reserved
 */

?>
<!-- wp:group {"className":"scca-documents","layout":{"type":"default"}} -->
<div class="wp-block-group scca-documents"><!-- wp:heading {"level":2,"className":"scca-documents__title"} -->
<h2 class="wp-block-heading scca-documents__title">Relevant documents</h2>
<!-- /wp:heading -->

<!-- wp:buttons {"className":"scca-documents__list","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-buttons scca-documents__list"><!-- wp:button {"width":100} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="#">SCCA Board Charter</a></div>
<!-- /wp:button -->

<!-- wp:button {"width":100} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="#">SCCA Constitution</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
