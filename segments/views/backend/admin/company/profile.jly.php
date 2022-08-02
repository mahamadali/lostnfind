@extends('backend/app')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
      Company Profile
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.company.store') }}" enctype="multipart/form-data">
        {{ prevent_csrf() }}
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ $company->name ?? '' }}" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Logo</label>
              <input type="file" class="form-control" name="logo" />
              @if(!empty($company->logo)):
              <img src="{{ url($company->logo) }}" height="70" class="mt-2">
              @endif
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Company Info</label>
              <textarea rows="3"  class="form-control" name="info">{{ $company->info ?? '' }}</textarea>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="email" value="{{ $company->email ?? '' }}" />
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label>Phone Number</label>
              <input type="text" class="form-control" name="phone_number" value="{{ $company->phone_number ?? '' }}" />
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Address</label>
              <input type="text" class="form-control" name="address" value="{{ $company->address ?? '' }}" />
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