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
 * Title: Table
 * Slug: scca/story-table
 * Categories: scca-story
 * Description: A striped table with a header row and caption. Scrolls sideways on narrow screens.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

?>
<!-- wp:table {"hasFixedLayout":true,"className":"is-style-stripes"} -->
<figure class="wp-block-table is-style-stripes"><table class="has-fixed-layout"><thead><tr><th>Course</th><th>Date</th><th>Location</th></tr></thead><tbody><tr><td>[Course name]</td><td>[DD/MM/YYYY]</td><td>[City]</td></tr><tr><td>[Course name]</td><td>[DD/MM/YYYY]</td><td>[City]</td></tr><tr><td>[Course name]</td><td>[DD/MM/YYYY]</td><td>[City]</td></tr></tbody></table><figcaption class="wp-element-caption">[Table caption]</figcaption></figure>
<!-- /wp:table -->
