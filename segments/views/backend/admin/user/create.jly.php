@extends('backend/app')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
      Create User
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>First Name</label>
              <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Last Name</label>
              <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="email" value="{{ old('email') }}" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Expiration Date</label>
              <input type="date" class="form-control" name="expiration_date" value="{{ old('expiration_date') }}" />
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
              <label>Contact Number</label>
              <input type="text" class="form-control" name="contact_number" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Logo</label>
              <input type="file" class="form-control" name="logo" />
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
@endblock