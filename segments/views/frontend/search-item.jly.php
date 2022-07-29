@extends('frontend/app')

@block("title") {{ 'Search Item - '.setting('app.title') }} @endblock

@block("styles")
<style>
    #pricing {
        margin-top: 50px;
    }
    .hero {
        min-height: auto;
        padding: 16px 10px 1px 10px;
    }
    .td_bold {
        font-weight: bold;
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
          <p>IF YOU FOUND A PET PLEASE ENTER THE TAG BELOW</p>

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
            <div class="col-lg-12 mt-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card featured" style="border: none;">
                    <div class="card-body">
                    <div class="row">
                    <div class="col-lg-4">
                        <div class=" text-center pb-4">
                        
                        @if(!empty($item->images[0])):
                        <img src="{{ url($item->images[0]->path) }}" alt="profile" class="mb-3" width="200" height="200"/>
                        @endif
                    
                        
                        <div class="mb-3">
                            <h3>{{ $item->name  }}</h3>
                            <div class="d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        
                        </div>
                    </div>
                    <div class="col-lg-8">
                    <div class="card" style="box-shadow: 0 10px 16px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%) !important;padding: 21px;">
                        <table class="table table-borderless" id="item_info_table" style="font-size: 12px;">
                                <tbody>
                                    <tr >
                                    <td class="td_bold"> Tag ID </td>
                                    <td class=""> {{ $item->tag_number }}</td>
                                    </tr>
                                    <tr >
                                    <td class="td_bold"> Category</td>
                                    <td class=""> {{ $item->category->title }} </td>
                                    </tr>
                                    <tr>
                                    <td class="td_bold"> Name </td>
                                    <td class=""> {{ $item->name }}</td>
                                    </tr>
                                    <tr>
                                    <td class="td_bold"> Description</td>
                                    <td > {{ $item->description }}</td>
                                    </tr>
                                    @if($item->category->title == 'Pets'):
                                    <tr>
                                    <td class="td_bold"> Breed</td>
                                    <td class=""> {{ $item->breed }} </td>
                                    </tr>
                                    <tr>
                                    <td class="td_bold"> Preferred pet food</td>
                                    <td class=""> {{ $item->preferred_pet_food }}</td>
                                    <td class="td_bold"> Any distingushing marks</td>
                                    <td class=""> {{ $item->distinguishing_marks }} </td>
                                    </tr>
                                    <tr>
                                    <td class="td_bold">Additional Notes</td>
                                    <td  class=""> {{ $item->notes }}</td>
                                    <td class="td_bold">Date of birth</td>
                                    <td  class="">{{ $item->date_of_birth }}</td>
                                    </tr>
                                    <tr>
                                    <td class="td_bold">Gender</td>
                                    <td  class=""> {{ $item->gender }}</td>
                                    <td class="td_bold">Height</td>
                                    <td  class="">{{ $item->height }}</td>
                                    </tr>
                                    <tr>
                                    <td class="td_bold">Weight</td>
                                    <td  class=""> {{ $item->weight }}</td>
                                    <td class="td_bold">Lenght of tail</td>
                                    <td  class="">{{ $item->length }}</td>
                                    </tr>
                                    <tr>
                                    <td class="td_bold">Type</td>
                                    <td  class=""> {{ $item->type }}</td>
                                    <td class="td_bold">Create Time</td>
                                    <td  class="">{{ $item->created_at }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                    <td class="td_bold">Created By</td>
                                    <td  class=""> {{ $item->user()->first_name }}</td>
                                    </tr>
                                </tbody>
                                </table>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <p>To notify the pet owner, click on below button and enter your contact details</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('provider-contact-info.form', ['item' => $item->id]) }}" class="btn btn-primary">CONTACT DETAILS</a>
                            </div>
                        </div>

                        </div>
                        </div>
                                
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