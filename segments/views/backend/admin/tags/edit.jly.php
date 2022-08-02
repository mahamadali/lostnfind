@extends('backend/app')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
      Edit Tag
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.tags.update', ['tag' => $tag->id]) }}">
      {{ prevent_csrf() }}
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Cateogry</label>
              <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Choose</option>
                @foreach($categories as $category): 
                <option value="{{ $category->id }}" {{ $category->id == $tag->category_id ? 'selected' : '' }}>{{ $category->title }} ({{ $category->prefix }})</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Tag Number</label>
              <input type="text" class="form-control" name="tag_number" value="{{ $tag->tag_number }}" />
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