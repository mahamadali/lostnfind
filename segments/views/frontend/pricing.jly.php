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

<!-- ======= Pricing Section ======= -->
<section id="pricing" class="pricing">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
        <span>Pricing</span>
        <h2>Pricing</h2>

        </div>

        <div class="row gy-4">
            @foreach($plans as $plan): 
                <div class="col-lg-4 m-auto" data-aos="fade-up" data-aos-delay="200">
                    <div class="pricing-item featured">
                    <h3>{{ $plan->title }} ({{ $plan->category->prefix }})</h3>
                    <h4><sup>$</sup>{{ $plan->price }}<span> / {{ $plan->days }} Days</span></h4>
                    <p>{{ $plan->description }}</p>
                    <!-- <ul>
                        <li><i class="bi bi-check"></i> Quam adipiscing vitae proin</li>
                        <li><i class="bi bi-check"></i> Nec feugiat nisl pretium</li>
                        <li><i class="bi bi-check"></i> Nulla at volutpat diam uteera</li>
                        <li><i class="bi bi-check"></i> Pharetra massa massa ultricies</li>
                        <li><i class="bi bi-check"></i> Massa ultricies mi quis hendrerit</li>
                    </ul> -->
                    <a href="{{ route('purchase-plan.index', ['plan' => $plan->id]) }}" class="buy-btn text-center" style="width:100%;">Purchase Now</a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section><!-- End Pricing Section -->

@endblock

@block("scripts")

@endblock