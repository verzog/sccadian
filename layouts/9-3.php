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
 * Title: Three quarters and quarter (9 + 3)
 * Slug: scca/layout-9-3
 * Categories: scca-layouts
 * Description: A wide column on the left, a narrow one on the right. Widths in twelfths of the page, like a Bootstrap grid. Stacks on phones.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

?>
<!-- wp:columns {"lock":{"move":true,"remove":true},"templateLock":"all","className":"scca-layout"} -->
<div class="wp-block-columns scca-layout"><!-- wp:column {"width":"75%","lock":{"move":true,"remove":true},"templateLock":false} -->
<div class="wp-block-column" style="flex-basis:75%"><!-- wp:paragraph -->
<p>[Content, 9 of 12 columns]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"25%","lock":{"move":true,"remove":true},"templateLock":false} -->
<div class="wp-block-column" style="flex-basis:25%"><!-- wp:paragraph -->
<p>[Content, 3 of 12 columns]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
