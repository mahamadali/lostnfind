@extends('backend/app')

@block("title") {{ setting('app.title', 'Social Media') }} @endblock

@block("styles")
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
      Create Social Media Footer Menu
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.socialmedia.store') }}">
      {{ prevent_csrf() }}
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name="title" value="{{ old('title') }}" />
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label>Icon</label>
              <input type="text" class="form-control" name="icon" value="{{ old('icon') }}" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Url</label>
              <input type="text" class="form-control" name="url" value="{{ old('url') }}" />
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