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
          <span>Order Placed</span>
          <h2>Order Placed</h2>

        </div>

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="pricing-item featured">
                <h3>Plan "{{ $plan->title }}" for Category "{{ $planRequestInfo->category()->first()->title }}" is successfully subscribed</h3>
                <p>You will get <b>tag id</b> in your email soon, so you can use to create an item in your portal</p>
                <p>Enjoy Our Services!</p>
                </div>
            </div>

        </div>
    </div>
</section><!-- End Frequently Asked Questions Section -->
@endblock

@block("scripts")

@endblock