@extends('backend/app')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
      Create Tag
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.tags.store') }}">
      {{ prevent_csrf() }}
        <div class="row">
          <div class="col">
            <div class="form-group">
            <label>Cateogry</label>
            <select name="category_id" id="category_id" class="form-control" required>
              <option value="">Choose</option>
              @foreach($categories as $category): 
              <option value="{{ $category->id }}">{{ $category->title }} ({{ $category->prefix }})</option>
              @endforeach
            </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Tag Number</label>
              <input type="text" class="form-control" name="tag_number" value="{{ old('tag_number') }}" />
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