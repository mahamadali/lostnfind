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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">

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
            <li><a href="<?php echo url('/'); ?>#faq">FAQ</a></li>
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
          <!-- <li><a href="<?php echo route('frontend.advertisements'); ?>">Advertisements</a></li> -->
          <li><a class="get-a-quote" href="<?php echo route('frontend.pricing'); ?>">Pricing</a></li>
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
            <input type="text" name="tag" class="form-control" placeholder="Enter TAG #" autocomplete="off">
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
        <?php if(session()->hasFlash('error')) { ?>
  <div class="alert alert-danger">
    <span><?php echo session()->flash('error'); ?></span>
  </div>
<?php } ?>

<?php if(session()->hasFlash('success')) { ?>
  <div class="alert alert-success text-center">
    <span><?php echo session()->flash('success'); ?></span>
  </div>
<?php } ?>

<?php if(session()->hasFlash('warning')) { ?>
  <div class="alert alert-warning">
    <span><?php echo session()->flash('warning'); ?></span>
  </div>
<?php } ?>

<?php if(session()->hasFlash('info')) { ?>
  <div class="alert alert-info">
    <span><?php echo session()->flash('info'); ?></span>
  </div>
<?php } ?>
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
            <img src="<?php echo url('assets/frontend/img/FB.jpg'); ?>" class="img-fluid" alt="">
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
            <img src="<?php echo url('assets/frontend/img/FB.jpg'); ?>" class="img-fluid" alt="">
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

      </div>
    </section><!-- End Features Section -->

    

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
    <div class="col-lg-3 col-md-12 footer-info">
      <a href="<?php echo url('/'); ?>" class="logo d-flex align-items-center">
        <!-- <span>Logis</span> -->
        <img src="<?php echo url(company()->logo); ?>" height="50">
      </a>
      <p><?php echo company()->info; ?></p>
      <div class="social-links d-flex mt-4">
        <?php foreach(social_icons() as $icon) { ?> 
            <a href="<?php echo $icon->url; ?>" class="<?php echo $icon->title; ?>"><img src="<?php echo url($icon->icon); ?>" class="img-fluid" style="border-radius:50%" height="100%" weight="100%"> </a>
        <?php } ?>
      </div>
    </div>

    <div class="col-lg-3 col-6 footer-links">
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

    

    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
      <h4>Contact Us</h4>
      <p>
        <?php echo company()->address; ?>
        <strong>Phone:</strong>  <?php echo company()->phone_number; ?><br>
        <strong>Email:</strong> <?php echo company()->email; ?><br>
      </p>
    </div>

    <div class="col-lg-3 col-6 footer-links">
      <h4>Newsletter</h4>
      <form method="post" action="<?php echo route('newsletter.store'); ?>" id="newsletter-form">
      <?php echo prevent_csrf(); ?>
      <div class="input-group mb-3">
          <input type="email" class="form-control"name="email" id="newsletter_email" placeholder="Enter your email..." aria-label="Recipient's username" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button type="submit" class="btn btn-primary" style="height: -webkit-fill-available;border-radius: 0;">Submit</button>
          </div>
        </div>
      </form> 
      <div class="row mt-4">
          <div class="col-lg-12">
              <div id="messages"></div>
          </div>
      </div>
    </div>

  </div>
</div>

<div class="container mt-4">
  <div class="copyright">
    &copy; Copyright <strong><span><?php echo company()->name; ?></span></strong>. All Rights Reserved
  </div>
</div>

</footer>
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
        <script src="<?php echo url('assets/js/js-intlTelInput.min.js'); ?>"></script>

        <!-- Template Main JS File -->
        <script src="<?php echo url('assets/frontend/js/main.js'); ?>"></script>

        <script>
            $(document).ready(function() {
                $('#newsletter-form').submit(function(e) {
                    e.preventDefault();
                    var btnObj = $(this).find('button[type="submit"]');
                    var formObj = $(this);
                    $(btnObj).html('Processing...');
                    $(btnObj).prop('disabled', true);
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'post',
                        data: $(this).serializeArray(),
                        dataType: 'json',
                        success: function(response) {
                            $('#messages').html('');
                            if(response.status == 304) {
                                $('#messages').append('<p align="center" style="color:red;">'+response.error+'</p>');
                            } else {
                                $(formObj)[0].reset();
                                $('#messages').append('<p align="center" style="color:green;">'+response.message+'</p>');
                                // if(response.status == 200) {
                                //     window.location.href = response.redirectUrl;
                                // }
                            }
                            $(btnObj).html('Submit');
                            $(btnObj).prop('disabled', false);
                        },
                        error: function() {
                            $(btnObj).html('Submit');
                            $(btnObj).prop('disabled', false);
                        }
                    })
                });
            });
            </script>


        
    </body>
</html>









