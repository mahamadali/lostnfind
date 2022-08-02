@extends('backend/app')

@block("title") {{ setting('app.title', 'SMS Setting') }} @endblock

@block("styles")
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
      Sms Setting
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.smssetting.store') }}" enctype="multipart/form-data">
      {{ prevent_csrf() }}
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>SID</label>
              <input type="text" class="form-control" name="sid" value="{{ $smssetting->sid ?? '' }}" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Token</label>
              <input type="text" class="form-control" name="token" value="{{ $smssetting->token ?? '' }}" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>From No</label>
              <input type="text" class="form-control" name="from_no" value="{{ $smssetting->from_no ?? '' }}" />
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