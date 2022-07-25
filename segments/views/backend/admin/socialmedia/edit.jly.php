@extends('backend/app')

@block("title") {{ setting('app.title', 'Social Media') }} @endblock

@block("styles")
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
      Edit socialmedia
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.socialmedia.update') }}">
        <input type="hidden" name="id" value="{{ $socialmedia->id }}" />
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name="title" value="{{ $socialmedia->title }}" />
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label>Icon</label>
              <input type="text" class="form-control" name="icon" value="{{ htmlentities($socialmedia->icon) }}" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Url</label>
              <input type="text" class="form-control" name="url" value="{{ $socialmedia->url }}" />
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