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
4. **Images:** add a background image to each carousel slide and each
   feature card (select the Cover block, then *Add media*).
5. **Placeholders:** replace every `[...]` text: testimonials, the SkinPro CPD
   description, footer contact details, and both acknowledgements. Use SCCA's
   current wording.
6. **Links:** the menu and buttons point to placeholder paths such as
   `/locate-a-doctor/` and `/cart/`. Point the iMIS-hosted ones (shop, cart,
   Locate a Doctor, event registration, profile) at the iMIS site for now.
   The **Member login** link in the top bar and **Portal login** in the
   footer both use `/portal-login/`; point them at the iMIS login page.
7. **Social links:** the *Stay connected* strip and the footer link to the
   LinkedIn, Facebook and Instagram home pages. Replace them with SCCA's
   own profile URLs.

## Sections (block patterns)

All are under *SCCA sections* in the block inserter:

| Pattern | What it is |
|---|---|
| Hero carousel | Rotating slides, each with an image, orange heading, text and button |
| Stay connected | Lavender strip with social links |
| Feature cards | Four image cards with a heading, text and button: 4 across on large screens, 2 on tablets, 1 on phones |
| Latest news | The three newest posts as cards (image, title, excerpt, date, Read more), with an All News button: 3 across, 2 on tablets, 1 on phones |
| SkinPro CPD promotion | Magenta band with a white panel |
| Upcoming events | Heading and a link to the iMIS events calendar |
| Patient resources | Orange band linking to SCAN your Skin |
| Testimonials | Three quote cards |
| Post grid (hidden) | The same news cards with pagination, used by the blog, archive and search templates |
| Event grid (hidden) | Event cards (image, title, event type, summary, Event details) with pagination, used by the events listing and event type pages |

## Event pages (Wormiss)

With the Wormiss plugin active, its Events use their own templates:

* **Single event** (`single-wormiss_event.html`): title, event type, featured image, then the page content. Wormiss puts the event details (when, where, event code, registration closes, places left) and the Register button at the top of the content. No publish date or previous/next links, as neither is the event's.
* **Events listing** (`archive-wormiss_event.html`, at `/events/`) and **event type pages** (`taxonomy-wormiss_event_type.html`, at `/event-type/<type>/`): event cards from the *Event grid* pattern.

## Story components and new-story layouts

For news stories and other posts, the block inserter (the **+** button) has two
more pattern sections, built from WordPress's own blocks:

**SCCA story components:** Two columns, Three columns, Card group, Card row, Image with
zoom (opens full size when clicked), Image and text, Video and text (paste a
YouTube or Vimeo link), Jumbotron, Accordion, Table, Event banner and Key
points. Insert one, then replace the `[...]` text and the placeholder images
(add alt text to each image).

**SCCA new story layouts:** News story, Event recap and Member or research
feature: whole-post starting points. Depending on the WordPress version, *Posts
> Add New Post* may offer them straight away; otherwise insert them from the
inserter.

**Card row** is a theme block (also under *Design* in the inserter): a row of
cards that scrolls sideways, with previous and next arrows, and swipe on
phones. Select the card row (List View helps) to set the card size (small,
medium or large: every card the same width, images cropped to the same
height), drop shadow, rounded corners and arrows. Each card is a Group block,
so change its colours in the sidebar; duplicate a card to add another.

**Hiding the featured image on a story:** the featured image still shows on
the news cards, but on the story's own page you can leave it out. Open the
story, then in the sidebar under *Post* select *Template* and choose **Story
without featured image**. Choose the default template (*Single Posts*) to show it again.

These replace the Bootstrap components of the Moodle `tiny_bootstrap` plugin.
Bootstrap itself is not loaded: the theme's own styles cover the same layouts,
and grids collapse at Bootstrap's breakpoints (768px and 992px).

## Column layouts (administrators only)

To arrange a page's content side by side, administrators insert a layout from
**Patterns → SCCA layouts (12-column grid)**. Widths are in twelfths of the page,
as in a Bootstrap grid: 6 + 6, 4 + 8, 8 + 4, 3 + 9, 9 + 3, 4 + 4 + 4,
3 + 3 + 3 + 3 and 3 + 6 + 3. Columns stack one under another on phones.

Any column's width can be set exactly: select the column, then **Grid width →
Columns of 12** in the block settings (widths in a row should add up to 12).

The layouts, the Grid width setting and the Columns block are offered to
administrators only. Other users can still edit the text inside columns already
on a page, but cannot add or rearrange columns.

## Carousel block

The hero is a **Carousel** block (also in the inserter under *Design*). Each
slide is a Cover block: select one to change its image, overlay colour and
opacity, or text. To add a slide, select the last slide and press *Duplicate*
(or add a Cover block inside the carousel).

Select the carousel itself (use the *List View* or the breadcrumb at the bottom
of the editor) to change its settings in the sidebar:

| Setting | Default |
|---|---|
| Play automatically | On |
| Seconds per slide | 6 |
| Transition (slide or fade) and its length | Slide, 600 ms |
| Minimum height on computers / on phones | 480 px / 420 px (slides grow if their text needs more room) |
| Show arrows, show dots | On, on |
| Name for screen readers | "Featured" |

Leave each slide's own *Minimum height* empty, or it overrides the carousel
height. If autoplay, arrows and dots are all turned off, the slides are shown
one under another, because visitors would otherwise have no way to reach them. In the editor the slides are shown one under another so each can be
edited; on the site they rotate.

Accessibility: autoplay pauses while the mouse is over the carousel or a
keyboard user is inside it, there is always a pause button, and it never plays
automatically for visitors whose device asks for reduced motion.

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
