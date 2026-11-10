# SCCA block theme

A WordPress block theme that recreates the Skin Cancer College Australasia
website's look: the Mulish font, SCCA purple and orange, and the homepage
sections from the current iMIS RiSE site, each as a reusable block pattern.

## Requirements

* WordPress 6.6 or later (theme.json version 3). CI tests 6.6, the latest
  release and nightly.
* PHP 8.1 or later. CI tests 8.1 to 8.4.

## Install via ZIP

1. In WordPress, go to *Appearance > Themes > Add New Theme > Upload Theme*.
2. Upload `scca-v<version>.zip` from the latest GitHub release (not the
   "Source code" zip, which has the wrong folder name) and click
   *Install Now*, then *Activate*.

## Install manually

Copy the `scca` folder to `wp-content/themes/scca`, then activate it under
*Appearance > Themes*.

## After activating

1. **Logo:** *Appearance > Editor > Patterns > Header*, select the Site Logo
   block and upload `SCCA-logo.webp`.
2. **Menu:** in the same Header part, select the Navigation block and build the
   main menu (About Us, Education, SkinPro CPD, Membership, Accreditation,
   Events, Contact).
3. **Homepage:** *Settings > Reading*, set the homepage to a static page. The
   `front-page.html` template then shows the SCCA sections in order.
4. **Images:** add a background image to the hero and each feature card
   (select the Cover block, then *Add media*).
5. **Placeholders:** replace every `[...]` text: testimonials, the SkinPro CPD
   description, footer contact details, and both acknowledgements. Use SCCA's
   current wording.
6. **Links:** the menu and buttons point to placeholder paths such as
   `/locate-a-doctor/` and `/cart/`. Point the iMIS-hosted ones (shop, cart,
   Locate a Doctor, event registration, profile) at the iMIS site for now.
7. **Social links:** the *Stay connected* strip and the footer link to the
   LinkedIn, Facebook and Instagram home pages. Replace them with SCCA's
   own profile URLs.

## Sections (block patterns)

All are under *SCCA sections* in the block inserter:

| Pattern | What it is |
|---|---|
| Hero banner | Purple cover with an orange heading and button |
| Stay connected | Lavender strip with social links |
| Feature cards | Four image cards |
| Latest news | The three newest posts |
| SkinPro CPD promotion | Magenta band with a white panel |
| Upcoming events | Heading and a link to the iMIS events calendar |
| Patient resources | Orange band linking to SCAN your Skin |
| Testimonials | Three quote cards |
| Post grid (hidden) | News cards with pagination, used by the blog, archive and search templates |

The **Upcoming events** pattern links out for now. The planned iMIS membership
plugin can later add a live events list read from an iMIS IQA.

## Accessibility note: the accent orange

White text on the brand orange (`#FF772E`) is about 2.6:1 contrast; WCAG AA
needs 4.5:1 for normal text. So buttons and the "Join" band use the
**Accent orange (buttons, accessible)** colour, `#C2410C` (about 5.2:1), and
darken to `#9A3412` on hover. The brand orange is still used where it passes:
the hero heading (large text on purple, 4.2:1) and the patient-resources band
(dark purple text, 5.8:1).

To go back to the brand orange on buttons (not recommended), change the accent
colour under *Appearance > Editor > Styles > Colours > Palette*.

## Development

CI runs on every push and pull request (`.github/workflows/ci.yml`):

* **Static checks:** PHP lint, WordPress Coding Standards (warnings fail),
  PHP 8.1 compatibility, and `tests/check-theme.php`, which checks block
  markup, pattern headers, template references and palette colours.
* **Smoke tests:** installs WordPress, activates the theme, checks every
  pattern, template and part is registered, loads each page type and fails on
  any PHP notice or deprecation.

Run the static checks locally:

```bash
composer install
composer lint
composer phpcs
php tests/check-theme.php
```

### Releasing

1. Bump `Version:` in `style.css` and merge to `main`; wait for CI to pass.
2. Publish a GitHub release tagged `v` + that version (e.g. `v0.1.1`).
3. The *Release zip* workflow checks the tag matches, builds
   `scca-v0.1.1.zip` with a `scca/` folder and attaches it to the release.

## Licence

Proprietary — Skin Cancer College Australasia, all rights reserved. See `LICENSE`.

## Third-party

* **Mulish** variable font, version 5.3.0 (via Fontsource), © 2016 The Mulish
  Project Authors, SIL Open Font License 1.1, unmodified.
  https://github.com/googlefonts/mulish — licence in `assets/fonts/OFL.txt`.
  It is bundled locally, so visitors' browsers never contact Google Fonts.
