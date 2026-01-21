<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="<?php echo $meta_desc; ?>">

    <title><?=$meta_title;?></title>
    <?php if ($bloginfo->search_engine_visibility == 0) { ?>
        <meta name="robots" content="noindex" />
    <?php } ?>

    <?php if($htmlfile):?>
    <meta property="og:url" content="<?php echo site_url($custom_blog_url); ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $blog_title; ?>" />
    <?php if(!empty($meta_desc)):?>
    <meta property="og:description" content="<?php echo $meta_desc; ?>" />
    <?php else:?>
    <meta property="og:description" content="<?php echo substr(strip_tags($generatedhtml), 0, 150); ?>" />
    <?php endif;?>
    <meta property="og:image" content="<?php echo ($blog_featured_image ? upload_url($blog_featured_image) : ''); ?>" />
    <?php endif;?>

    <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="The Genie Transportation Services" />
    <link rel="manifest" href="/favicon/site.webmanifest" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css?v=7">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body id="top">
     <header>
        <nav class="navbar navbar-expand-md">
            <div class="container-xl cntr">
                <a class="navbar-brand" href="/">
                    <img src="/images/the-genie-transportation-services.png" alt="The Genie Transportation Services">
                </a>

                <div class="navbar-wrap">
                    <div class="header-btns">
                        <a href="/booking.html" class="btn btn-blue">Book Now</a>
                    </div>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <b>MENU</b> <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="/" title="Home">Home</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" title="Services" role="button" data-bs-toggle="dropdown" aria-expanded="false">Services</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/orlando-airport-transportation.html" title="Orlando Airport Transportation">Orlando Airport Transportation</a></li>
                                    <li><a class="dropdown-item" href="/walt-disney-world-transportation.html" title="Walt Disney World Transportation">Walt Disney World Transportation</a></li>
                                    <li><a class="dropdown-item" href="/port-canaveral-transportation.html" title="Port Canaveral Transportation">Port Canaveral Transportation</a></li>
                                    <li><a class="dropdown-item" href="/universal-studios-transportation.html" title="Universal Studios Transportation">Universal Studios Transportation</a></li>
                                    <li><a class="dropdown-item" href="/disney-stroller-rental.html" title="Orlando Stroller Rentals">Orlando Stroller Rentals</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="/about.html" title="About">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="/rates.html" title="Rates">Rates</a></li>
                            <li class="nav-item"><a class="nav-link" href="/faq.html" title="FAQs">FAQs</a></li>
                            <li class="nav-item"><a class="nav-link active" href="/blog" title="Blog">Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="/contact.html" title="Contact Us">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <section class="banner banner--page">
        <div class="banner-img">
            <picture>
                <source media="(min-width: 576px)" srcset="/images/banner/the-genie-transportation-services.webp">
                <img src="/images/banner/mobile/the-genie-transportation-services.webp" alt="The Genie Transportation Services" loading="eager" fetchpriority="high">
            </picture>
        </div>
        <div class="banner-caption" data-aos="fade-left" data-aos-delay="400">
            <?php if($htmlfile):?>
                <h1><?=$blog_title;?></h1>
                <p><?=$blog_sub_title;?></p>
            <?php else:?>
                <h1>Travel Tips & Car Service Guides for Orlando, Disney and MCO</h1>
            <?php endif;?>
        </div>
    </section>