# The Genie Transportation - SEO Fixes for 6 New Service Pages

## Context
You are editing 6 HTML files for The Genie Transportation Services (thegenieorlando.com), an Orlando-based private car service. These pages were recently created and need metadata and schema corrections.

## Files to Edit
1. `disney-cruise-line-transportation.html`
2. `royal-caribbean-cruise-transportation.html`
3. `mco-to-epic-universe-transportation.html`
4. `mco-to-grand-floridian-transportation.html`
5. `mco-to-polynesian-resort-transportation.html`
6. `international-drive-hotel-transportation.html`

---

## TASK 1: Fix Title Tags (2 files only)

### disney-cruise-line-transportation.html
**Current (line 7):**
```html
<title>Disney Cruise Transportation Orlando | MCO to Port | The Genie</title>
```

**Change to:**
```html
<title>Disney Cruise Transportation | MCO to Port Canaveral | The Genie</title>
```

### royal-caribbean-cruise-transportation.html
**Current (line 7):**
```html
<title>Royal Caribbean Cruise Transfer | MCO to Port | The Genie</title>
```

**Change to:**
```html
<title>Royal Caribbean Cruise Transfer | Port Canaveral | The Genie</title>
```

---

## TASK 2: Add Open Graph Meta Tags (all 6 files)

Insert these OG tags immediately AFTER the `<meta name="description"...>` tag (around line 15) in each file. Customize the `og:title`, `og:description`, and `og:url` for each page as shown below.

### disney-cruise-line-transportation.html
```html
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="The Genie Transportation Services" />
    <meta property="og:title" content="Disney Cruise Transportation | MCO to Port Canaveral" />
    <meta property="og:description" content="Private transfers to Port Canaveral for Disney Cruise Line sailings. MCO airport pickup, free car seats, direct service to Terminal 8." />
    <meta property="og:url" content="https://www.thegenieorlando.com/disney-cruise-line-transportation.html" />
    <meta property="og:image" content="https://www.thegenieorlando.com/images/the-genie-transportation-services.png" />
    <meta name="twitter:card" content="summary_large_image" />
```

### royal-caribbean-cruise-transportation.html
```html
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="The Genie Transportation Services" />
    <meta property="og:title" content="Royal Caribbean Cruise Transfer | Port Canaveral" />
    <meta property="og:description" content="Private transfers from Orlando Airport to Royal Caribbean cruise terminal at Port Canaveral. Car seats included, flight tracking." />
    <meta property="og:url" content="https://www.thegenieorlando.com/royal-caribbean-cruise-transportation.html" />
    <meta property="og:image" content="https://www.thegenieorlando.com/images/the-genie-transportation-services.png" />
    <meta name="twitter:card" content="summary_large_image" />
```

### mco-to-epic-universe-transportation.html
```html
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="The Genie Transportation Services" />
    <meta property="og:title" content="MCO to Epic Universe Transportation | The Genie" />
    <meta property="og:description" content="Private car service from Orlando Airport to Universal's Epic Universe. Free car seats, flight tracking, direct transfers to new park." />
    <meta property="og:url" content="https://www.thegenieorlando.com/mco-to-epic-universe-transportation.html" />
    <meta property="og:image" content="https://www.thegenieorlando.com/images/the-genie-transportation-services.png" />
    <meta name="twitter:card" content="summary_large_image" />
```

### mco-to-grand-floridian-transportation.html
```html
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="The Genie Transportation Services" />
    <meta property="og:title" content="MCO to Grand Floridian Transportation | The Genie" />
    <meta property="og:description" content="Private car service from Orlando Airport to Disney's Grand Floridian Resort. Free car seats, flight tracking, meet & greet at MCO." />
    <meta property="og:url" content="https://www.thegenieorlando.com/mco-to-grand-floridian-transportation.html" />
    <meta property="og:image" content="https://www.thegenieorlando.com/images/the-genie-transportation-services.png" />
    <meta name="twitter:card" content="summary_large_image" />
```

### mco-to-polynesian-resort-transportation.html
```html
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="The Genie Transportation Services" />
    <meta property="og:title" content="MCO to Polynesian Resort Transportation | The Genie" />
    <meta property="og:description" content="Private car service from Orlando Airport to Disney's Polynesian Village Resort. Free car seats, flight tracking, meet & greet." />
    <meta property="og:url" content="https://www.thegenieorlando.com/mco-to-polynesian-resort-transportation.html" />
    <meta property="og:image" content="https://www.thegenieorlando.com/images/the-genie-transportation-services.png" />
    <meta name="twitter:card" content="summary_large_image" />
```

### international-drive-hotel-transportation.html
```html
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="The Genie Transportation Services" />
    <meta property="og:title" content="International Drive Hotel Transportation | The Genie" />
    <meta property="og:description" content="Private car service from Orlando Airport to International Drive hotels. Free car seats, flight tracking, direct transfers to I-Drive." />
    <meta property="og:url" content="https://www.thegenieorlando.com/international-drive-hotel-transportation.html" />
    <meta property="og:image" content="https://www.thegenieorlando.com/images/the-genie-transportation-services.png" />
    <meta name="twitter:card" content="summary_large_image" />
```

---

## TASK 3: Enhance Schema Markup (all 6 files)

Replace the existing `<script type="application/ld+json">` block (located near the end of each file, before the jQuery script tag) with the enhanced version below. Customize the `serviceType` and `description` for each page.

### disney-cruise-line-transportation.html
```html
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Service",
      "serviceType": "Disney Cruise Transportation",
      "name": "Disney Cruise Line Transportation from Orlando",
      "provider": {
        "@type": "LocalBusiness",
        "@id": "https://www.thegenieorlando.com/#organization",
        "name": "The Genie Transportation Services",
        "telephone": "689-258-3572",
        "url": "https://www.thegenieorlando.com",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "12129 Breda Ln",
          "addressLocality": "Orlando",
          "addressRegion": "FL",
          "postalCode": "32827",
          "addressCountry": "US"
        },
        "geo": {
          "@type": "GeoCoordinates",
          "latitude": 28.3747,
          "longitude": -81.2497
        },
        "aggregateRating": {
          "@type": "AggregateRating",
          "ratingValue": "5.0",
          "reviewCount": "89",
          "bestRating": "5",
          "worstRating": "1"
        },
        "priceRange": "$$"
      },
      "areaServed": {
        "@type": "City",
        "name": "Orlando",
        "sameAs": "https://en.wikipedia.org/wiki/Orlando,_Florida"
      },
      "description": "Private transfers from Orlando International Airport (MCO) and Walt Disney World resorts to Port Canaveral for Disney Cruise Line sailings.",
      "url": "https://www.thegenieorlando.com/disney-cruise-line-transportation.html"
    }
    </script>
```

### royal-caribbean-cruise-transportation.html
```html
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Service",
      "serviceType": "Royal Caribbean Cruise Transportation",
      "name": "Royal Caribbean Cruise Transfer from Orlando",
      "provider": {
        "@type": "LocalBusiness",
        "@id": "https://www.thegenieorlando.com/#organization",
        "name": "The Genie Transportation Services",
        "telephone": "689-258-3572",
        "url": "https://www.thegenieorlando.com",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "12129 Breda Ln",
          "addressLocality": "Orlando",
          "addressRegion": "FL",
          "postalCode": "32827",
          "addressCountry": "US"
        },
        "geo": {
          "@type": "GeoCoordinates",
          "latitude": 28.3747,
          "longitude": -81.2497
        },
        "aggregateRating": {
          "@type": "AggregateRating",
          "ratingValue": "5.0",
          "reviewCount": "89",
          "bestRating": "5",
          "worstRating": "1"
        },
        "priceRange": "$$"
      },
      "areaServed": {
        "@type": "City",
        "name": "Orlando",
        "sameAs": "https://en.wikipedia.org/wiki/Orlando,_Florida"
      },
      "description": "Private transfers from Orlando International Airport (MCO) to Royal Caribbean cruise terminals at Port Canaveral with complimentary car seats.",
      "url": "https://www.thegenieorlando.com/royal-caribbean-cruise-transportation.html"
    }
    </script>
```

### mco-to-epic-universe-transportation.html
```html
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Service",
      "serviceType": "Airport Transportation",
      "name": "MCO to Epic Universe Transportation",
      "provider": {
        "@type": "LocalBusiness",
        "@id": "https://www.thegenieorlando.com/#organization",
        "name": "The Genie Transportation Services",
        "telephone": "689-258-3572",
        "url": "https://www.thegenieorlando.com",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "12129 Breda Ln",
          "addressLocality": "Orlando",
          "addressRegion": "FL",
          "postalCode": "32827",
          "addressCountry": "US"
        },
        "geo": {
          "@type": "GeoCoordinates",
          "latitude": 28.3747,
          "longitude": -81.2497
        },
        "aggregateRating": {
          "@type": "AggregateRating",
          "ratingValue": "5.0",
          "reviewCount": "89",
          "bestRating": "5",
          "worstRating": "1"
        },
        "priceRange": "$$"
      },
      "areaServed": {
        "@type": "City",
        "name": "Orlando",
        "sameAs": "https://en.wikipedia.org/wiki/Orlando,_Florida"
      },
      "description": "Private car service from Orlando International Airport (MCO) to Universal's Epic Universe theme park and on-site hotels.",
      "url": "https://www.thegenieorlando.com/mco-to-epic-universe-transportation.html"
    }
    </script>
```

### mco-to-grand-floridian-transportation.html
```html
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Service",
      "serviceType": "Airport Transportation",
      "name": "MCO to Grand Floridian Resort Transportation",
      "provider": {
        "@type": "LocalBusiness",
        "@id": "https://www.thegenieorlando.com/#organization",
        "name": "The Genie Transportation Services",
        "telephone": "689-258-3572",
        "url": "https://www.thegenieorlando.com",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "12129 Breda Ln",
          "addressLocality": "Orlando",
          "addressRegion": "FL",
          "postalCode": "32827",
          "addressCountry": "US"
        },
        "geo": {
          "@type": "GeoCoordinates",
          "latitude": 28.3747,
          "longitude": -81.2497
        },
        "aggregateRating": {
          "@type": "AggregateRating",
          "ratingValue": "5.0",
          "reviewCount": "89",
          "bestRating": "5",
          "worstRating": "1"
        },
        "priceRange": "$$"
      },
      "areaServed": {
        "@type": "City",
        "name": "Orlando",
        "sameAs": "https://en.wikipedia.org/wiki/Orlando,_Florida"
      },
      "description": "Private car service from Orlando International Airport (MCO) to Disney's Grand Floridian Resort & Spa with complimentary car seats and meet & greet service.",
      "url": "https://www.thegenieorlando.com/mco-to-grand-floridian-transportation.html"
    }
    </script>
```

### mco-to-polynesian-resort-transportation.html
```html
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Service",
      "serviceType": "Airport Transportation",
      "name": "MCO to Polynesian Village Resort Transportation",
      "provider": {
        "@type": "LocalBusiness",
        "@id": "https://www.thegenieorlando.com/#organization",
        "name": "The Genie Transportation Services",
        "telephone": "689-258-3572",
        "url": "https://www.thegenieorlando.com",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "12129 Breda Ln",
          "addressLocality": "Orlando",
          "addressRegion": "FL",
          "postalCode": "32827",
          "addressCountry": "US"
        },
        "geo": {
          "@type": "GeoCoordinates",
          "latitude": 28.3747,
          "longitude": -81.2497
        },
        "aggregateRating": {
          "@type": "AggregateRating",
          "ratingValue": "5.0",
          "reviewCount": "89",
          "bestRating": "5",
          "worstRating": "1"
        },
        "priceRange": "$$"
      },
      "areaServed": {
        "@type": "City",
        "name": "Orlando",
        "sameAs": "https://en.wikipedia.org/wiki/Orlando,_Florida"
      },
      "description": "Private car service from Orlando International Airport (MCO) to Disney's Polynesian Village Resort with complimentary car seats and meet & greet service.",
      "url": "https://www.thegenieorlando.com/mco-to-polynesian-resort-transportation.html"
    }
    </script>
```

### international-drive-hotel-transportation.html
```html
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Service",
      "serviceType": "Airport Transportation",
      "name": "International Drive Hotel Transportation",
      "provider": {
        "@type": "LocalBusiness",
        "@id": "https://www.thegenieorlando.com/#organization",
        "name": "The Genie Transportation Services",
        "telephone": "689-258-3572",
        "url": "https://www.thegenieorlando.com",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "12129 Breda Ln",
          "addressLocality": "Orlando",
          "addressRegion": "FL",
          "postalCode": "32827",
          "addressCountry": "US"
        },
        "geo": {
          "@type": "GeoCoordinates",
          "latitude": 28.3747,
          "longitude": -81.2497
        },
        "aggregateRating": {
          "@type": "AggregateRating",
          "ratingValue": "5.0",
          "reviewCount": "89",
          "bestRating": "5",
          "worstRating": "1"
        },
        "priceRange": "$$"
      },
      "areaServed": {
        "@type": "City",
        "name": "Orlando",
        "sameAs": "https://en.wikipedia.org/wiki/Orlando,_Florida"
      },
      "description": "Private car service from Orlando International Airport (MCO) to International Drive hotels with complimentary car seats and meet & greet service.",
      "url": "https://www.thegenieorlando.com/international-drive-hotel-transportation.html"
    }
    </script>
```

---

## Validation Checklist

After making all changes, verify:

1. **Title tags** - Both cruise pages now include "Port Canaveral" (not just "Port")
2. **OG tags** - All 6 files have OG meta tags after the description meta tag
3. **Schema** - All 6 files have enhanced schema with:
   - `@id` reference linking to homepage organization
   - `aggregateRating` with 89 reviews / 5.0 rating
   - `geo` coordinates
   - `url` property pointing to specific page
   - `name` property for the service

4. **No syntax errors** - JSON-LD has no trailing commas or missing brackets

---

## Business Details Reference
- **Business Name:** The Genie Transportation Services
- **Phone:** 689-258-3572
- **Address:** 12129 Breda Ln, Orlando, FL 32827
- **Google Reviews:** 89 reviews, 5.0 rating
- **Google Place ID:** 8868904268788693943
- **Website:** https://www.thegenieorlando.com
