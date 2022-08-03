@extends('frontend/app')

@block("title") {{ 'Purchase Plan - '.setting('app.title') }} @endblock

@block("styles")
<style>
    #pricing {
        margin-top: 50px;
    }
</style>
@endblock

@block("hero")
@endblock

@block("content")
<section id="pricing" class="pricing">
    <div class="container" data-aos="fade-up">
        @include('frontend/layouts/alert')
        <div class="section-header">
          <span>Advertisements</span>
          <h2>Advertisements</h2>
        </div>

        @foreach($advertises as $advertise):
        <div class="row justify-content-center mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                <div class="row pricing-item featured">
                    <div class="col-lg-4">
                        <img src="{{ url($advertise->image) }}" class="img-fluid">
                    </div>
                    <div class="col-lg-8">
                        <h5>{{ $advertise->title }}</h5>
                        <p>{{ $advertise->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section><!-- End Frequently Asked Questions Section -->
@endblock

@block("scripts")
@endblock