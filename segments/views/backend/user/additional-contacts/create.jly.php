@extends('backend/app')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")
<style>
  .iti--separate-dial-code
    {
        width: 100% !important;
    }
</style>
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
      Create Contact
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('user.additional-contacts.store') }}" id="create-additional-contact-form" enctype="multipart/form-data">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Full Name</label>
              <input type="text" name="full_name" class="form-control" required/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Contact Phone number</label>
              <br>
              <input type="hidden" name="country_code" id="country_code">
              <input type="text" name="contact" id="contact" class="form-control" required/>
            </div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col">
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg">Save</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

@endblock

@block("scripts")

<script>

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

  var phoneInputField = document.querySelector("#contact");
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