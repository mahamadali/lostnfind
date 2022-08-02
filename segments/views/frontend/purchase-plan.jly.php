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
          <span>Purchase Plan</span>
          <h2>Purchase Plan</h2>

        </div>

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="pricing-item featured">
                <h3>{{ $plan->title }} ({{ $plan->category->prefix }})</h3>
                <h4><sup>$</sup>{{ $plan->price }}<span> / {{ $plan->days }} Days</span></h4>
                <p>{{ $plan->description }}</p>
                </div>
            </div>

            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                <div class="card featured">
                    <div class="card-body">
                        <h5>Submit Below Information: </h5>
                        <form method="post" action="{{ route('purchase-plan.process', ['plan' => $plan->id]) }}" id="process-purchsase-plan-form">
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Your Email: <small>This email will use as your primary email for your account login</small></label>
                                        <input type="text" class="form-control" name="user_email" placeholder="Enter Your Email">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Choose Category</label>
                                        <select name="category" class="form-control" required>
                                            <option value="">Choose</option>
                                            @foreach($categories as $category): 
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            <input type="hidden" name="category" value="{{ $plan->category_id }}">
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                    <button type="submit" class="buy-btn text-center" style="width:100%;">Purchase Now</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div id="messages"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Frequently Asked Questions Section -->
@endblock

@block("scripts")
<script>
$(document).ready(function() {
    $('#process-purchsase-plan-form').submit(function(e) {
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
                    response.errors.forEach(error => {
                        $('#messages').append('<p align="center" style="color:red;">'+error+'</p>');
                    });
                } else {
                    if(response.status == 200) {
                        $(formObj)[0].reset();
                        $('#messages').append('<p align="center" style="color:green;">'+response.message+'</p>');
                        window.location.href = response.redirectUrl;
                    } else {
                        $('#messages').append('<p align="center" style="color:red;">'+response.message+'</p>');
                    }
                }
                $(btnObj).html('Purchase Now');
                $(btnObj).prop('disabled', false);
            },
            error: function() {
                $(btnObj).html('Purchase Now');
                $(btnObj).prop('disabled', false);
            }
        })
    });
})
</script>
@endblock