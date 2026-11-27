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
 * Title: Course Education Pathway
 * Slug: scca/course-pathway
 * Categories: scca
 * Description: A page of courses by level, as on the iMIS Course Education Pathway: a purple title band, the introduction with a "Find your Course" box, then a section each for Introductory, Essential, Advanced and Capstone courses and the Fellowship pathway. Each section lists that event category's events still open for enrolment (Wormiss "Open events" block); make the event categories Introductory, Essential, Advanced, Capstone and Fellowship (sub-categories of Course) and give events those types.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

?>
<!-- wp:group {"align":"full","className":"scca-pathway__band","backgroundColor":"purple","textColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull scca-pathway__band has-white-color has-purple-background-color has-text-color has-background"><!-- wp:paragraph {"className":"scca-pathway__kicker"} -->
<p class="scca-pathway__kicker">SCCA</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"scca-pathway__title"} -->
<h1 class="wp-block-heading scca-pathway__title">Course Education Pathway</h1>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"scca-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group scca-section"><!-- wp:columns {"className":"scca-pathway__intro"} -->
<div class="wp-block-columns scca-pathway__intro"><!-- wp:column {"width":"64%"} -->
<div class="wp-block-column" style="flex-basis:64%"><!-- wp:heading {"className":"scca-pathway__lead"} -->
<h2 class="wp-block-heading scca-pathway__lead">Whether you're seeking introductory or advanced skin cancer education, you are in the right place!</h2>
<!-- /wp:heading -->

<!-- wp:list {"className":"scca-pathway__points"} -->
<ul class="wp-block-list scca-pathway__points"><!-- wp:list-item -->
<li>We support you on your journey as a skin cancer professional</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Only skin cancer education pathway to offer Accreditation &amp; Fellowship</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>We focus on clinical skills directly applicable to your everyday practice</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Interactive learning is reinforced through robust assessment</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>SCCA directs earnings back into education, advocacy &amp; research</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>SCCA offers everything from online-only short courses that teach the fundamentals, all the way through to advanced peer-to-peer training for experienced skin cancer practitioners looking to master their surgical skills.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"scca-pathway__explore"} -->
<p class="scca-pathway__explore">Explore SCCA's course offering below to find your best starting point.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"36%"} -->
<div class="wp-block-column" style="flex-basis:36%"><!-- wp:group {"className":"scca-documents scca-pathway__finder","layout":{"type":"default"}} -->
<div class="wp-block-group scca-documents scca-pathway__finder"><!-- wp:heading {"className":"scca-documents__title"} -->
<h2 class="wp-block-heading scca-documents__title">Find your Course</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true,"className":"scca-pathway__steps"} -->
<ol class="wp-block-list scca-pathway__steps"><!-- wp:list-item -->
<li><a href="#introductory">Introductory Course</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#essential">Essential Courses</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#advanced">Advanced Courses</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#capstone">Capstone Course</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#fellowship">Fellowship Pathway</a></li>
<!-- /wp:list-item --></ol>
<!-- /wp:list -->

<!-- wp:buttons {"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-buttons"><!-- wp:button {"width":100} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="/events/">Explore Upcoming Courses</a></div>
<!-- /wp:button -->

<!-- wp:button {"width":100,"className":"is-style-outline"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button" href="#">Submit Course Enquiry</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","anchor":"introductory","className":"scca-section scca-pathway__level scca-pathway__level--shaded","layout":{"type":"constrained"}} -->
<div id="introductory" class="wp-block-group alignfull scca-section scca-pathway__level scca-pathway__level--shaded"><!-- wp:heading {"className":"scca-pathway__level-title"} -->
<h2 class="wp-block-heading scca-pathway__level-title">Introductory Course</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Foundation learning for clinical practitioners unfamiliar with skin cancer and those with non-clinical backgrounds.</p>
<!-- /wp:paragraph -->

<!-- wp:wormiss/open-events {"type":"introductory","emptyText":"No dates are open for enrolment at the moment. Please check back soon."} /--></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","anchor":"essential","className":"scca-section scca-pathway__level","layout":{"type":"constrained"}} -->
<div id="essential" class="wp-block-group alignfull scca-section scca-pathway__level"><!-- wp:heading {"className":"scca-pathway__level-title"} -->
<h2 class="wp-block-heading scca-pathway__level-title">Essential Courses</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Starting point for doctors or nurses new to skin cancer medicine or those looking to consolidate their skills.</p>
<!-- /wp:paragraph -->

<!-- wp:wormiss/open-events {"type":"essential","emptyText":"No dates are open for enrolment at the moment. Please check back soon."} /--></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","anchor":"advanced","className":"scca-section scca-pathway__level scca-pathway__level--shaded","layout":{"type":"constrained"}} -->
<div id="advanced" class="wp-block-group alignfull scca-section scca-pathway__level scca-pathway__level--shaded"><!-- wp:heading {"className":"scca-pathway__level-title"} -->
<h2 class="wp-block-heading scca-pathway__level-title">Advanced Courses</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Available to those who have completed Essential Courses looking to advance their skin cancer medicine skills.</p>
<!-- /wp:paragraph -->

<!-- wp:wormiss/open-events {"type":"advanced","emptyText":"No dates are open for enrolment at the moment. Please check back soon."} /--></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","anchor":"capstone","className":"scca-section scca-pathway__level","layout":{"type":"constrained"}} -->
<div id="capstone" class="wp-block-group alignfull scca-section scca-pathway__level"><!-- wp:heading {"className":"scca-pathway__level-title"} -->
<h2 class="wp-block-heading scca-pathway__level-title">Capstone Course</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Optional learning for doctors looking to elevate their skills to the highest level.</p>
<!-- /wp:paragraph -->

<!-- wp:wormiss/open-events {"type":"capstone","emptyText":"No dates are open for enrolment at the moment. Please check back soon."} /--></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","anchor":"fellowship","className":"scca-section scca-pathway__level scca-pathway__level--shaded","layout":{"type":"constrained"}} -->
<div id="fellowship" class="wp-block-group alignfull scca-section scca-pathway__level scca-pathway__level--shaded"><!-- wp:heading {"className":"scca-pathway__level-title"} -->
<h2 class="wp-block-heading scca-pathway__level-title">Fellowship Pathway</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>For doctors aiming to reach the pinnacle of primary care skin cancer medicine.</p>
<!-- /wp:paragraph -->

<!-- wp:wormiss/open-events {"type":"fellowship","emptyText":"No dates are open for enrolment at the moment. Please check back soon."} /--></div>
<!-- /wp:group -->
