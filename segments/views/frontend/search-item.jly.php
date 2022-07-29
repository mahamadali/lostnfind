@extends('frontend/app')

@block("title") {{ 'Purchase Plan - '.setting('app.title') }} @endblock

@block("styles")
<style>
    #pricing {
        margin-top: 50px;
    }
    .hero {
        min-height: auto;
        padding: 0px 0px 0px 0px;
    }
</style>
@endblock

@block("hero")
@endblock

@block("content")
<section id="pricing" class="">
    <div class="container" data-aos="fade-up">
        @include('frontend/layouts/alert')
        <div class="section-header">
          <span>Search Item</span>
          <h2>Search Item</h2>

        </div>

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="pricing-item featured hero">
                    <form action="{{ route('frontend.search') }}" id="search-tag-form" class="form-search d-flex align-items-stretch mb-3 form" data-aos="fade-up" data-aos-delay="200">
                        <input type="text" name="tag" class="form-control" placeholder="Enter TAG #" value="{{ !empty($_GET['tag']) ? $_GET['tag'] : '' }}" autocomplete="off">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>

            @if(!empty($item)):
            <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                <div class="card featured">
                    <div class="card-body">
                        <h5>{{ $item->name }}</h5>
                        
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-12 mt-5" data-aos="fade-up" data-aos-delay="200">
                <center><h5>NO ITEM FOUND!</h5></center>
            </div>
            @endif
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
                    $(formObj)[0].reset();
                    $('#messages').append('<p align="center" style="color:green;">'+response.message+'</p>');
                    if(response.status == 200) {
                        window.location.href = response.redirectUrl;
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