@extends('frontend/app')

@block("title") {{ setting('app.title') }} @endblock

@block("styles")
@endblock

@block("hero")
@include('frontend/layouts/hero')
@endblock

@block("content")
    <!-- ======= Services Section ======= -->
    <section id="service" class="services pt-0">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <span>Our Services</span>
          <h2>Our Services</h2>

        </div>

        <div class="row gy-4">
            @foreach($categories as $category): 
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                    <h3>{{ $category->title }}</h3>
                    </div>
                </div><!-- End Card Item -->
            @endforeach

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action" class="call-to-action">
      <div class="container" data-aos="zoom-out">

        <div class="row justify-content-center">
          <div class="col-lg-8 text-center">
            <h3>Call To Action</h3>
            <p>{{ setting('app.description') }}</p>
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
            <img src="{{ url('assets/frontend/img/FB.jpg') }}" class="img-fluid" alt="">
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
            <img src="{{ url('assets/frontend/img/FB.jpg') }}" class="img-fluid" alt="">
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
                @foreach($faqs as $faq):
                <div class="accordion-item">
                    <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-{{ $faq->id }}">
                        <i class="bi bi-question-circle question-icon"></i>
                        {{ $faq->title }}
                    </button>
                    </h3>
                    <div id="faq-content-{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                    <div class="accordion-body">
                    {{ $faq->description }}
                    </div>
                    </div>
                </div>
                @endforeach
            </div>

          </div>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->
@endblock

@block("scripts")
@endblock