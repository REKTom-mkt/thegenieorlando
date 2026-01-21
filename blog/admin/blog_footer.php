<?php //Blog Informations 
$bloginfo = blog_info();
?>  
	<footer>
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-md-2 gy-4">
                <div class="col order-md-2 pt-md-5">
                    <div class="d-block d-md-none text-center text-md-start">
                        <h3 class="font2 mb-3">Questions?</h3>

                        <div class="mb-4 mb-md-45">
                            <p>Have questions about our top-tier Disney World transportation? Curious about our Port Canaveral transportation or Orlando private transportation? Let's chat!</p>

                            <p>We're here to answer all your questions and ensure you have all the information you need. Reach out to us via call, text, or email – we're eager to help!</p>
                        </div>
                    </div>
                    <form action="" method="post" id="contactForm" novalidate>
                        <div class="row row-cols-1 row-cols-sm-2 g-3 mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="fname" placeholder="First name*" class="form-control" required>
                                    <p class="help-block mb-0"></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="lname" placeholder="Last name*" class="form-control" required>
                                    <p class="help-block mb-0"></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="email" placeholder="Email*" class="form-control" required>
                                    <p class="help-block mb-0"></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="phone" placeholder="Phone Number*" class="form-control" required>
                                    <p class="help-block mb-0"></p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea name="msg" placeholder="Message*" class="form-control" rows="3" required></textarea>
                                    <p class="help-block mb-0"></p>
                                </div>
                            </div>
                        </div>

                        <div id="success"></div>
                        <div class="text-center text-md-start">
                            <button class="btn btn-blue px-45">Send Message</button>
                        </div>
                        <input type="hidden" id="token" name="token">
                        <span class="d-none invisible" style="display: none;"><input type="text" name="spam"></span>
                    </form>
                </div>

                <div class="col">
                    <div class="d-none d-md-block">
                        <h3 class="font2 mb-3">Questions?</h3>

                        <div class="mb-4 mb-md-45">
                            <p>Have questions about our top-tier Disney World transportation? Curious about our Port Canaveral transportation or Orlando private transportation? Let's chat!</p>

                            <p>We're here to answer all your questions and ensure you have all the information you need. Reach out to us via call, text, or email – we're eager to help!</p>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-1 row-cols-lg-2 gy-4 gy-md-2 gy-lg-4 mb-4 justify-content-center">
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

                    <div class="social">
                        <a href=""><i class="icon-google"></i></a>
                        <a href="https://www.facebook.com/TheGenieOrlando" target="_blank"><i class="icon-facebook"></i></a>
                    </div>

                    <div class="pt-4 small text-center text-md-start">
                        <a href="/terms-conditions.html" class="inherit">Terms & Conditions</a>
                        <a href="/privacy-policy.html" class="inherit ms-3">Privacy Policy</a>
                    </div>
                </div>

            </div>
        </div>
    </footer>
    <div class="footer-copyright">
        Copyright © 2025. All Rights Reserved.<br>
        Web Design, SEO & Hosting by <a href="https://www.rekmarketing.com/" target="_blank" class="text-decoration-none inherit">REK Marketing & Design</a>
    </div>
    <a href="#top" class="totop">
        <i class="icon-angle-up"></i>
        <span>To Top</span>
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js" integrity="sha512-Znnj7n0C0Xz1tdk6ih39WPm3kSCTZEKnX/7WaNbySW7GFbwSjO5r9/uOAGLMbgv6llI1GdghC7xdaQsFUStM1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <script src="/js/script.js"></script>

    <script src="https://www.google.com/recaptcha/api.js?render=6Ld3Cx4sAAAAAM5kv7OTxQxMHMFuVweziAMgMJrE"></script>
    <script src="/js/jqBootstrapValidation.js"></script>
    <script src="/js/contact.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js" integrity="sha512-/bOVV1DV1AQXcypckRwsR9ThoCj7FqTV2/0Bm79bL3YSyLkVideFLE3MIZkq1u5t28ke1c0n31WYCOrO01dsUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">      
      $('.main_heading').matchHeight();
      
      $(document).on('click', '.paginate_button', function(){
        $.fn.matchHeight._update();
      });
    </script>
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