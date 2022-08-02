@extends('frontend/app')

@block("title") {{ 'Provide Your Contacts - '.setting('app.title') }} @endblock

@block("styles")
<style>
    #pricing {
        margin-top: 50px;
    }
    .iti--separate-dial-code
    {
        width: 100% !important;
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
          <span>Provide Your Info</span>
          <h2>Provide Your Info</h2>

        </div>

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card featured">
                    <div class="card-body">
                        <h5>Enter Your Details: </h5>
                        <form method="post" action="{{ route('provider-contact-info.process', ['item' => $item->id]) }}" id="process-purchsase-plan-form">
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="form-group mt-3">
                                        <label>Name:</label>
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Email:</label>
                                        <input type="text" class="form-control" name="email" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Phone Number :</label>
                                        <input type="hidden" name="country_code" id="country_code">
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number">
                                    </div>
                                    <!-- <div class="form-group mt-3">
                                        <label>Address :</label>
                                        <input type="text" class="form-control" name="address" placeholder="Enter Address">
                                    </div> -->
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                    <button type="submit" class="buy-btn text-center" style="width:100%;">Notify Owner</button>
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
                    $(formObj)[0].reset();
                    $('#messages').append('<p align="center" style="color:green;">'+response.message+'</p>');
                    if(response.status == 200) {
                        window.location.href = response.redirectUrl;
                    }
                }
                $(btnObj).html('Notify Owner');
                $(btnObj).prop('disabled', false);
            },
            error: function() {
                $(btnObj).html('Notify Owner');
                $(btnObj).prop('disabled', false);
            }
        })
    });
});

function getIp(callback) {
  fetch("https://ipinfo.io/json?token=ee9dceccd60e6f", {
    headers: { Accept: "application/json" },
  })
    .then((resp) => resp.json())
    .catch(() => {
      return {
        country: "us",
      };
    })
    .then((resp) => callback(resp.country));
}

var phoneInputField = document.querySelector("#phone");
const phoneInput = window.intlTelInput(phoneInputField, {
    initialCountry: "auto",
    separateDialCode: true,
    geoIpLookup:getIp,
    autoPlaceholder: "aggressive",
    nationalMode: true,
    utilsScript: "{{ url('assets/js/utils.js') }}",
});

phoneInputField.addEventListener("countrychange",function() {
  $('#country_code').val(phoneInput.getSelectedCountryData()['dialCode']);
});
</script>
@endblock