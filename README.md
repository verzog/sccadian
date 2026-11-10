# SCCA block theme

A WordPress block theme that recreates the Skin Cancer College Australasia
website's look: the Mulish font, SCCA purple and orange, and the homepage
sections from the current iMIS RiSE site, each as a reusable block pattern.

## Requirements

* WordPress 6.6 or later (theme.json version 3).
* PHP 8.1 or later.

## Install via ZIP

1. In WordPress, go to *Appearance > Themes > Add New Theme > Upload Theme*.
2. Upload `scca-0.1.0.zip` and click *Install Now*, then *Activate*.

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

The **Upcoming events** pattern links out for now. The planned iMIS membership
plugin can later add a live events list read from an iMIS IQA.

## Accessibility note: the accent orange

White text on the brand orange (`#FF772E`) is about 2.6:1 contrast; WCAG AA
needs 4.5:1 for normal text. Buttons use the **Accent orange (buttons)** colour.
To make every button pass, change that one colour to `#C2410C` (about 5.2:1)
under *Appearance > Editor > Styles > Colours > Palette*, or in `theme.json`.

## Licence

Proprietary — Skin Cancer College Australasia, all rights reserved. See `LICENSE`.

## Third-party

* **Mulish** variable font, version 5.3.0 (via Fontsource), © 2016 The Mulish
  Project Authors, SIL Open Font License 1.1, unmodified.
  https://github.com/googlefonts/mulish — licence in `assets/fonts/OFL.txt`.
  It is bundled locally, so visitors' browsers never contact Google Fonts.
