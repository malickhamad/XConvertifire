# PageSpeed fixes, 8 November 2026

## Report reviewed before changes

https://pagespeed.web.dev/analysis/https-xconvertifire-com/enh598hol3

| Metric | Mobile | Desktop |
| --- | --- | --- |
| Performance | 93 | 70 |
| Accessibility | 98 | 94 |
| Best Practices | 96 | 96 |
| SEO | 100 | 100 |
| FCP | 1.8 s | 1.0 s |
| LCP | 1.8 s | 1.0 s |
| TBT | 220 ms | 340 ms |
| CLS | 0 | 0.244 |

These are the user's latest lab measurements, not post-change results or field
Core Web Vitals. Earlier tests varied. No score improvement is claimed until
the deployed version is tested again.

## Changes

- Serve the four existing technology logos locally with intrinsic dimensions
  and lazy loading. This removes the Wikimedia requests that returned 429.
- Give the footer logo an explicit containing width and aspect ratio, fixing
  its percentage width inside a shrink-to-fit link. Lighthouse identified this
  logo in the desktop layout-shift diagnostic.
- Use H2 for footer section headings while keeping the existing CSS class.
- Darken the Request a Tool button for white-text contrast.
- Keep GA4 through the existing GTM container; remove its duplicate direct
  gtag loader/configuration. Live reports showed GTM loading the same GA4 ID.
- Serve Bootstrap, Font Awesome and Inter's font definitions locally. Inter's
  font files and Font Awesome's fonts still come from their original CDNs;
  they are not falsely described as self-hosted fonts. Font display uses
  optional for Inter and swap for Font Awesome.
- Ship smaller Bootstrap and Font Awesome styles for the homepage. Other
  routes keep full vendor CSS. Load noncritical AOS styles with preload.
- Minify the site's shared CSS and add a cache version to changed shared
  assets. Cache public assets for seven days, without caching private files.
- Start decorative MP4 loading after visitor interaction, at idle, with the
  existing desktop/reduced-motion/data-saver/intersection checks. This removes
  the automatic initial 14 MB desktop payload; it does not claim the original
  video file has been compressed.
- Build www redirects from THE_REQUEST rather than Hostinger's internally
  rewritten REQUEST_URI. Redirect explicit /x-convertifire/public paths back
  to the public origin while preserving the query string.

## Build and deployment

After changing shared CSS, homepage classes, navbar or footer, regenerate:

```sh
node scripts/build-public-styles.cjs
node tests/Frontend/home-media.test.cjs
```

Commit generated CSS alongside its source. Deploy all vendor and brand assets,
not just Blade templates. Run `php artisan view:cache` on the server. Clear the
hosting/CDN cache after deployment, then test both PageSpeed profiles again.
Verify the www homepage and a www tool URL retain their original public paths
and query strings. Confirm GA4 receives one page_view via GTM.

Validation completed locally: media behavior checks (desktop, mobile, reduced
motion, data saver, early interaction), JavaScript syntax, CSS generation,
Blade compilation, and a rendered homepage check for headings, image dimensions,
local asset paths and duplicate Analytics. PHPUnit could not open its bootstrap
because of local PHP file-readability restrictions. Browser-based local preview
was blocked by the environment's network and file-URL restrictions. No fresh
post-deployment PageSpeed results are claimed.

Third-party scripts can still report unused JavaScript and cache limitations.
AdSense and GTM remain enabled; arbitrary restrictive CSP/HSTS policies were
not introduced just to silence unscored suggestions.

## Asset sources

The brand SVGs are the same files already used by the site, downloaded from
Wikimedia's Amazon_Web_Services_Logo.svg, Microsoft_Azure_Logo.svg,
Google_Cloud_logo.svg and Apple_logo_black.svg entries. Logos remain the marks
of their respective owners. Bootstrap 5.3.2 and Font Awesome Free 6.4.0 retain
their upstream license notices in the vendored stylesheets. Inter font URLs
remain Google's original URLs.
