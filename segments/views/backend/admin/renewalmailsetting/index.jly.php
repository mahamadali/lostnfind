@extends('backend/app')

@block("title") {{ setting('app.title', 'Renewal Mail Setting') }} @endblock

@block("styles")
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
     Renewal Mail Setting
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.renewalmailsetting.store') }}" enctype="multipart/form-data">
      {{ prevent_csrf() }}
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Days Before</label>
              <input type="number" class="form-control" name="days_before" value="{{ $renewalmailsetting->days_before ?? '' }}" />
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