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
      Edit User
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.users.update') }}" enctype="multipart/form-data">
      {{ prevent_csrf() }}
        <input type="hidden" name="id" value="{{ $user->id }}" />
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>First Name</label>
              <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Last Name</label>
              <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="email" value="{{ $user->email }}" @if(auth()->role->name == 'user'): disabled @endif />
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label>Contact Number</label>
              <input type="hidden" name="country_code" id="country_code" value="{{ $user->country_code }}">
              <input type="text" class="form-control" id="contact" name="contact_number" value="{{ $user->contact_number }}" />
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Confirm Password</label>
              <input type="password" class="form-control" name="confirm_password" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Logo</label>
              <input type="file" class="form-control" name="logo" />
            </div>
          </div>
          <div class="col">
              @if(!empty($user->logo)):
              <img src="{{ url($user->logo) }}" height="70" class="mt-2">
              @endif
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

  phoneInput.setNumber("+<?php echo $user->country_code." ".$user->contact_number; ?>");

</script>
@endblock