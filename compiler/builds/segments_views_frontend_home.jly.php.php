<?php class_exists('Jolly\Engine') or exit; ?>
<html>
    <head>
        <title><?php echo setting('app.title'); ?></title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="<?php echo setting('app.title'); ?>" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="<?php echo url('assets/frontend/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo url('assets/frontend/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
        <link href="<?php echo url('assets/frontend/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo url('assets/frontend/vendor/glightbox/css/glightbox.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo url('assets/frontend/vendor/swiper/swiper-bundle.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo url('assets/frontend/vendor/aos/aos.css'); ?>" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="<?php echo url('assets/frontend/css/main.css'); ?>" rel="stylesheet">
        
    </head>
    <body>
          <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="<?php echo url('/'); ?>" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="<?php echo url(company()->logo); ?>" alt="">
        <h1><?php echo company()->name; ?></h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="<?php echo url('/'); ?>" class="active">Home</a></li>
            <?php foreach(pages() as $page) { ?> 
                <li><a href="<?php echo route('cms.page', ['page' => $page->title]); ?>"><?php echo $page->title_beautify; ?></a></li>
            <?php } ?>
            <li><a href="#faq">FAQ</a></li>
          <!-- <li><a href="about.html">About</a></li>
          <li><a href="services.html">Services</a></li>
          <li><a href="pricing.html">Pricing</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a href="contact.html">Contact</a></li> -->
          <li><a class="get-a-quote" href="#pricing">Pricing</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <!-- End Header -->
        <!-- ======= Hero Section ======= -->
 <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h2 data-aos="fade-up"><?php echo company()->name; ?></h2>
          <p data-aos="fade-up" data-aos-delay="100"><?php echo company()->info; ?></p>

          <form action="<?php echo route('frontend.search'); ?>" id="search-tag-form" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
            <input type="text" name="tag" class="form-control" placeholder="Enter TAG #">
            <button type="submit" class="btn btn-primary">Search</button>
          </form>

          <!-- <div class="row gy-4" data-aos="fade-up" data-aos-delay="400">

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                <p>Clients</p>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                <p>Projects</p>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
                <p>Support</p>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
                <p>Workers</p>
              </div>
            </div>

          </div> -->
        </div>

        <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
          <img src="<?php echo url('assets/frontend/img/hero-img.svg'); ?>" class="img-fluid mb-3 mb-lg-0" alt="">
        </div>

      </div>
    </div>
  </section><!-- End Hero Section -->
        <main id="main">
        <!-- ======= Featured Services Section ======= -->
<!-- <section id="featured-services" class="featured-services">
      <div class="container">

        <div class="row gy-4">

          

        </div>

      </div>
    </section> -->
    <!-- End Featured Services Section -->

    <!-- ======= About Us Section ======= -->
    <!-- <section id="about" class="about pt-0">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">
          <div class="col-lg-6 position-relative align-self-start order-lg-last order-first">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
            <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
          </div>
          <div class="col-lg-6 content order-last  order-lg-first">
            <h3>About Us</h3>
            <p>
              Dolor iure expedita id fuga asperiores qui sunt consequatur minima. Quidem voluptas deleniti. Sit quia molestiae quia quas qui magnam itaque veritatis dolores. Corrupti totam ut eius incidunt reiciendis veritatis asperiores placeat.
            </p>
            <ul>
              <li data-aos="fade-up" data-aos-delay="100">
                <i class="bi bi-diagram-3"></i>
                <div>
                  <h5>Ullamco laboris nisi ut aliquip consequat</h5>
                  <p>Magni facilis facilis repellendus cum excepturi quaerat praesentium libre trade</p>
                </div>
              </li>
              <li data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-fullscreen-exit"></i>
                <div>
                  <h5>Magnam soluta odio exercitationem reprehenderi</h5>
                  <p>Quo totam dolorum at pariatur aut distinctio dolorum laudantium illo direna pasata redi</p>
                </div>
              </li>
              <li data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-broadcast"></i>
                <div>
                  <h5>Voluptatem et qui exercitationem</h5>
                  <p>Et velit et eos maiores est tempora et quos dolorem autem tempora incidunt maxime veniam</p>
                </div>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </section> -->
    <!-- End About Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="service" class="services pt-0">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <span>Our Services</span>
          <h2>Our Services</h2>

        </div>

        <div class="row gy-4">
            <?php foreach($categories as $category) { ?> 
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                    <h3><?php echo $category->title; ?></h3>
                    </div>
                </div><!-- End Card Item -->
            <?php } ?>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action" class="call-to-action">
      <div class="container" data-aos="zoom-out">

        <div class="row justify-content-center">
          <div class="col-lg-8 text-center">
            <h3>Call To Action</h3>
            <p><?php echo setting('app.description'); ?></p>
            <a class="cta-btn" href="#">Call To Action</a>
            </dic>
          </div>

        </div>
    </section><!-- End Call To Action Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="row gy-4 align-items-center features-item" data-aos="fade-up">

          <div class="col-md-5">
            <img src="<?php echo url('assets/frontend/img/features-1.jpg'); ?>" class="img-fluid" alt="">
          </div>
          <div class="col-md-7">
            <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <ul>
              <li><i class="bi bi-check"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
              <li><i class="bi bi-check"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
              <li><i class="bi bi-check"></i> Ullam est qui quos consequatur eos accusamus.</li>
            </ul>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-center features-item" data-aos="fade-up">
          <div class="col-md-5 order-1 order-md-2">
            <img src="<?php echo url('assets/frontend/img/features-2.jpg'); ?>" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 order-2 order-md-1">
            <h3>Corporis temporibus maiores provident</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum
            </p>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-center features-item" data-aos="fade-up">
          <div class="col-md-5">
            <img src="<?php echo url('assets/frontend/img/features-3.jpg'); ?>" class="img-fluid" alt="">
          </div>
          <div class="col-md-7">
            <h3>Sunt consequatur ad ut est nulla consectetur reiciendis animi voluptas</h3>
            <p>Cupiditate placeat cupiditate placeat est ipsam culpa. Delectus quia minima quod. Sunt saepe odit aut quia voluptatem hic voluptas dolor doloremque.</p>
            <ul>
              <li><i class="bi bi-check"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
              <li><i class="bi bi-check"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
              <li><i class="bi bi-check"></i> Facilis ut et voluptatem aperiam. Autem soluta ad fugiat.</li>
            </ul>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-center features-item" data-aos="fade-up">
          <div class="col-md-5 order-1 order-md-2">
            <img src="<?php echo url('assets/frontend/img/features-4.jpg'); ?>" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 order-2 order-md-1">
            <h3>Quas et necessitatibus eaque impedit ipsum animi consequatur incidunt in</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum
            </p>
          </div>
        </div><!-- Features Item -->

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing pt-0">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <span>Pricing</span>
          <h2>Pricing</h2>

        </div>

        <div class="row gy-4">
            <?php foreach($plans as $plan) { ?> 
                <div class="col-lg-4 m-auto" data-aos="fade-up" data-aos-delay="200">
                    <div class="pricing-item featured">
                    <h3><?php echo $plan->title; ?></h3>
                    <h4><sup>$</sup><?php echo $plan->price; ?><span> / <?php echo $plan->days; ?> Days</span></h4>
                    <p><?php echo $plan->description; ?></p>
                    <!-- <ul>
                        <li><i class="bi bi-check"></i> Quam adipiscing vitae proin</li>
                        <li><i class="bi bi-check"></i> Nec feugiat nisl pretium</li>
                        <li><i class="bi bi-check"></i> Nulla at volutpat diam uteera</li>
                        <li><i class="bi bi-check"></i> Pharetra massa massa ultricies</li>
                        <li><i class="bi bi-check"></i> Massa ultricies mi quis hendrerit</li>
                    </ul> -->
                    <a href="<?php echo route('purchase-plan.index', ['plan' => $plan->id]); ?>" class="buy-btn text-center" style="width:100%;">Purchase Now</a>
                    </div>
                </div>
            <?php } ?>
        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Testimonials Section ======= -->
    <!-- <section id="testimonials" class="testimonials">
      <div class="container">

        <div class="slides-1 swiper" data-aos="fade-up">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div>

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section> -->
    <!-- End Testimonials Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <span>Frequently Asked Questions</span>
          <h2>Frequently Asked Questions</h2>

        </div>

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-10">

            <div class="accordion accordion-flush" id="faqlist">
                <?php foreach($faqs as $faq) { ?>
                <div class="accordion-item">
                    <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-<?php echo $faq->id; ?>">
                        <i class="bi bi-question-circle question-icon"></i>
                        <?php echo $faq->title; ?>
                    </button>
                    </h3>
                    <div id="faq-content-<?php echo $faq->id; ?>" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                    <div class="accordion-body">
                    <?php echo $faq->description; ?>
                    </div>
                    </div>
                </div>
                <?php } ?>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->
        </main>
        <!-- ======= Footer ======= -->
<footer id="footer" class="footer">

<div class="container">
  <div class="row gy-4">
    <div class="col-lg-5 col-md-12 footer-info">
      <a href="<?php echo url('/'); ?>" class="logo d-flex align-items-center">
        <!-- <span>Logis</span> -->
        <img src="<?php echo url(company()->logo); ?>" height="50">
      </a>
      <p><?php echo company()->info; ?></p>
      <div class="social-links d-flex mt-4">
        <?php foreach(social_icons() as $icon) { ?> 
            <a href="<?php echo $icon->url; ?>" class="<?php echo $icon->title; ?>"><i class="bi <?php echo $icon->icon; ?>"></i></a>
        <?php } ?>
      </div>
    </div>

    <div class="col-lg-2 col-6 footer-links">
      <h4>Useful Links</h4>
      <ul>
        <?php foreach(pages() as $page) { ?> 
        <li><a href="<?php echo route('cms.page', ['page' => $page->title]); ?>"><?php echo $page->title_beautify; ?></a></li>
        <?php } ?>
        <!-- <li><a href="#">Home</a></li>
        <li><a href="#">About us</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Terms of service</a></li>
        <li><a href="#">Privacy policy</a></li> -->
      </ul>
    </div>

    <div class="col-lg-2 col-6 footer-links">
      <!-- <h4>Our Services</h4>
      <ul>
        <li><a href="#">Web Design</a></li>
        <li><a href="#">Web Development</a></li>
        <li><a href="#">Product Management</a></li>
        <li><a href="#">Marketing</a></li>
        <li><a href="#">Graphic Design</a></li>
      </ul> -->
    </div>

    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
      <h4>Contact Us</h4>
      <p>
        <?php echo company()->address; ?>
        <strong>Phone:</strong>  <?php echo company()->phone_number; ?><br>
        <strong>Email:</strong> <?php echo company()->email; ?><br>
      </p>

    </div>

  </div>
</div>

<div class="container mt-4">
  <div class="copyright">
    &copy; Copyright <strong><span><?php echo company()->name; ?></span></strong>. All Rights Reserved
  </div>
  <!-- <div class="credits"> -->
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/ -->
    <!-- Designed by <a href="<?php echo url('/'); ?>">BootstrapMade</a> -->
  <!-- </div> -->
</div>

</footer><!-- End Footer -->
<!-- End Footer -->
        <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
        <script src="<?php echo url('assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
        <script src="<?php echo url('assets/frontend/vendor/purecounter/purecounter_vanilla.js'); ?>"></script>
        <script src="<?php echo url('assets/frontend/vendor/glightbox/js/glightbox.min.js'); ?>"></script>
        <script src="<?php echo url('assets/frontend/vendor/swiper/swiper-bundle.min.js'); ?>"></script>
        <script src="<?php echo url('assets/frontend/vendor/aos/aos.js'); ?>"></script>
        <script src="<?php echo url('assets/frontend/vendor/php-email-form/validate.js'); ?>"></script>

        <!-- Template Main JS File -->
        <script src="<?php echo url('assets/frontend/js/main.js'); ?>"></script>
        
    </body>
</html>









