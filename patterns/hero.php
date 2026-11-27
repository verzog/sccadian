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
 * Title: Hero carousel
 * Slug: scca/hero
 * Categories: scca
 * Description: Rotating full-width slides. Add an image to each; set speed, height, transition and controls in the sidebar.
 *
 * @package    scca
 * @copyright  © Skin Cancer College Australasia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

?>
<!-- wp:scca/carousel {"align":"full","className":"scca-hero"} -->
<div class="wp-block-scca-carousel alignfull is-transition-slide scca-hero" style="--scca-carousel-height:480px;--scca-carousel-height-mobile:420px;--scca-carousel-duration:600ms" data-autoplay="true" data-speed="6" data-arrows="true" data-dots="true"><div class="scca-carousel__track"><!-- wp:cover {"dimRatio":70,"overlayColor":"purple","isUserOverlayColor":true,"layout":{"type":"constrained"}} -->
<div class="wp-block-cover"><span aria-hidden="true" class="wp-block-cover__background has-purple-background-color has-background-dim-70 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">2027 Course Calendar Now Available</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"white","fontSize":"large"} -->
<p class="has-white-color has-text-color has-large-font-size">Whether you&#039;re seeking introductory or advanced skin cancer education, you&#039;re in the right place!</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/education/">View the course calendar</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"dimRatio":70,"overlayColor":"purple","isUserOverlayColor":true,"layout":{"type":"constrained"}} -->
<div class="wp-block-cover"><span aria-hidden="true" class="wp-block-cover__background has-purple-background-color has-background-dim-70 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Become a Member</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"white","fontSize":"large"} -->
<p class="has-white-color has-text-color has-large-font-size">Join our dedicated community of 1,300 skin cancer practitioners across Australia and New Zealand.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/membership/">Become a member</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover --></div></div>
<!-- /wp:scca/carousel -->
