@extends('backend/app')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
      Create Subscription Plan
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.subscriptions.store') }}">
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
              <label>Title</label>
              <input type="text" class="form-control" name="title" value="{{ old('title') }}" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" name="description">{{ old('description') }}</textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Price</label>
              <input type="text" class="form-control" name="price" value="{{ old('price') }}" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Days</label>
              <select name="days" class="form-control">
                <option value="365">365 Days</option>
                <option value="30">30 Days</option>
                <option value="7">7 Days</option>
              </select>
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