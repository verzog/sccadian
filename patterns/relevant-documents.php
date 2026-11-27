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
 * Title: Relevant documents
 * Slug: scca/relevant-documents
 * Categories: scca
 * Description: A purple box headed "Relevant documents" with a button per document (e.g. the Board Charter and Constitution), for beside a page's introduction. Change each button's text and link to the document.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
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
