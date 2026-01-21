<?php
    /* Your password */
    $password = 'Ariel';

    $redirect_after_login = 'keystothekingdomtravel.php';

    /* Will not ask password again for */
    $remember_password = strtotime('+1 day'); // 30 days

    if (isset($_POST['password'])) {        
        if($_POST['password'] == $password) {
            setcookie("password", $password, $remember_password);
            header('Location: ' . $redirect_after_login);
        } else {
            header('Location: ' . $redirect_after_login.'?password=false');
        }
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="robots" content="noindex">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keys To The Kingdom Travel</title>

    <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="The Genie Transportation Services" />
    <link rel="manifest" href="/favicon/site.webmanifest" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css?v=7">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body id="top">
    <header>
        <nav class="navbar navbar-expand-md">
            <div class="container-xl cntr">
                <a class="navbar-brand" href="/">
                    <img src="images/the-genie-transportation-services.png" alt="The Genie Transportation Services">
                </a>

                <div class="navbar-wrap">
                    <div class="header-btns">
                        <a href="booking.html" class="btn btn-blue">Book Now</a>
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
                                    <li><a class="dropdown-item" href="orlando-airport-transportation.html" title="Orlando Airport Transportation">Orlando Airport Transportation</a></li>
                                    <li><a class="dropdown-item" href="walt-disney-world-transportation.html" title="Walt Disney World Transportation">Walt Disney World Transportation</a></li>
                                    <li><a class="dropdown-item" href="port-canaveral-transportation.html" title="Port Canaveral Transportation">Port Canaveral Transportation</a></li>
                                    <li><a class="dropdown-item" href="universal-studios-transportation.html" title="Universal Studios Transportation">Universal Studios Transportation</a></li>
                                    <li><a class="dropdown-item" href="disney-stroller-rental.html" title="Orlando Stroller Rentals">Orlando Stroller Rentals</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="about.html" title="About">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="rates.html" title="Rates">Rates</a></li>
                            <li class="nav-item"><a class="nav-link" href="faq.html" title="FAQs">FAQs</a></li>
                            <li class="nav-item"><a class="nav-link" href="/blog" title="Blog">Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.html" title="Contact Us">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <section class="banner banner--page">
        <div class="banner-img">
            <picture>
                <source media="(min-width: 576px)" srcset="images/banner/the-genie-transportation-services.webp">
                <img src="images/banner/mobile/the-genie-transportation-services.webp" alt="The Genie Transportation Services" loading="eager" fetchpriority="high">
            </picture>
        </div>
        <div class="banner-caption" data-aos="fade-left" data-aos-delay="400">
            <h1>Keys To The Kingdom Travel</h1>
        </div>
    </section>

    <?php if (empty($_COOKIE['password']) || $_COOKIE['password'] !== $password) { ?>

    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-7 col-lg-5 py-5">
                <form action="" method="post">
                    <div class="row g-3">
                        <div class="col form-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                        </div>
                        <div class="col-auto text-center">
                            <button type="submit" class="btn btn-blue">Submit</button>
                        </div>
                    </div>
                    <?php
                        if (isset($_GET['password']) && $_GET['password'] == "false") {
                            echo '<div class="alert alert-danger" role="alert">Wrong password</div>';
                        }
                        ?>
                </form>
            </div>
        </div>
    </div>

    <?php } else { ?>


    <section class="py-4 py-sm-5 py-md-6">
        <div class="container-xxl">
            <h5 class="mb-4">Welcome and thank you for trusting The Genie Transportation Services with your clients.</h5>
            <p>
                Every time you send a traveler our way, you give us the chance to create an experience filled with the kind of magic that reminds us of beloved stories. The feeling of stepping into a carriage on the way to a royal celebration. The excitement of setting off on an adventure with friends by your side. The comfort of knowing a reliable guide is leading the way, just like any great hero would have on their journey.
            </p>
            <p>
                We put our heart into making every ride feel special. Whether your clients are wishing for a smooth arrival, a peaceful departure, or a moment of calm before their next chapter begins, we’re honored to help make that wish come true. Our team brings the same spirit of kindness, care, and wonder that makes those timeless tales so unforgettable.
            </p>
            <p>
                Thank you for being part of our story and for believing in the magic we work hard to deliver every day. We look forward to serving your clients and creating experiences that feel a little brighter, a little more enchanted, and filled with the joy that makes great adventures truly memorable.
            </p>
            <ol>
                <li>
                    <p>
                        Our most up to date rates and services can be viewed <u><a href="docs/DEC2025TAINFO.pdf" target="_blank">HERE</a></u>.
                    </p>
                </li>
                <li>
                    <p>
                        Please enter your <span style="color: red; font-weight: bold;">CLIENT INFORMATION only</span> when making a reservation. This includes name, phone, and email. Do NOT enter your personal information. <span style="font-weight: bold;">Enter your full name, phone number, and email address in the notes field ONLY</span>. We will then email you a copy of the reservation once it's confirmed.
                    </p>
                </li>
                <li>
                    <p>
                        The credit card entered for payment will be charged approximately 5 days before the initial leg of the reservation.
                    </p>
                </li>
                <li>
                    <p>
                        Our <u><a href="terms-conditions.html" target="_blank">Terms &amp; Conditions</a></u> have changed so please review them and ensure your clients understand. Especially our cancellation policy.
                    </p>
                </li>
                <li>
                    <p>
                        Clients will no longer receive a text message the evening prior. Instead, they will receive emails 5-7 days prior to their arrival and 24-48 hours prior to their arrival. You will also receive these emails, please also check your spam folder.
                    </p>
                </li>
                <li>
                    <p>
                        When entering pickup times, please enter the time your clients wants to be picked up. For airport arrivals, please enter an "estimated" pickup time.
                    </p>
                </li>
                <li>
                    <p>
                        If you have any additional questions please call/text 689-258-3572 or email <a href="mailto:info@thegenieorlando.com">info@thegenieorlando.com</a>
                    </p>
                </li>
            </ol>
            <div class="text-center">
                <script src='https://thegenietrans.mylimobiz.com/leads/new/forms/resize/expander.php' config='7'></script>
                <div id="artusmode_form_wrapper">Loading...</div>
            </div>
        </div>
    </section>
    <?php } ?>

    <footer>
        <div class="container-fluid">
            <div class="row justify-content-center gy-4">
                <div class="col-lg-8">
                    <div class="row row-cols-sm-2 row-cols-md-2 row-cols-lg-2 gy-4 gy-md-2 gy-lg-3 justify-content-center">
                        <div class="col-8">
                            <div class="contact-info">
                                <span class="icn-wrap"><i class="icon-location"></i></span>
                                <p>12129 Breda Ln,<br>
                                    Orlando FL 32827</p>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="contact-info">
                                <span class="icn-wrap"><i class="icon-phone"></i></span>
                                <p><a href="tel:689-258-3572">Call / Text :<br>
                                        689-258-3572</a></p>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="contact-info">
                                <span class="icn-wrap"><i class="icon-envelope"></i></span>
                                <p><a href="mailto:info@thegenieorlando.com">info@thegenieorlando.com</a></p>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="contact-info">
                                <span class="icn-wrap"><i class="icon-clock"></i></span>
                                <p>24/7 Transportation Service</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="social text-center text-lg-start">
                        <a href=""><i class="icon-google"></i></a>
                        <a href=""><i class="icon-facebook"></i></a>
                        <a href=""><i class="icon-instagram"></i></a>
                        <a href=""><i class="icon-youtube"></i></a>
                    </div>

                    <div class="pt-4 small text-center text-lg-start">
                        <a href="terms-conditions.html" class="inherit">Terms & Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer-copyright">
        Copyright © 2025. All Rights Reserved.<br>
        Web Design, SEO &amp; Hosting by <a href="https://www.rekmarketing.com/" target="_blank" class="text-decoration-none inherit">REK Marketing &amp; Design</a>
    </div>
    <a href="#top" class="totop">
        <i class="icon-angle-up"></i>
        <span>To Top</span>
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js" integrity="sha512-Znnj7n0C0Xz1tdk6ih39WPm3kSCTZEKnX/7WaNbySW7GFbwSjO5r9/uOAGLMbgv6llI1GdghC7xdaQsFUStM1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <script src="js/script.js"></script>
<!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-C633T1HLQK"></script>
    <script> window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); } gtag('js', new Date()); gtag('config', 'G-C633T1HLQK'); </script>
<script>
        nl_lang = "en";
        nl_pos = "bl";
        nl_compact = "1";
        nl_dir = "/vendor/nagishli/nl-files/";
    </script>
    <script src="/vendor/nagishli/nagishli.js?v=2.3" charset="utf-8" defer></script>
</body>

</html>