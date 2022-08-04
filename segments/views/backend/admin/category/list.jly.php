@extends('backend/app')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")
@endblock

@block("content")

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <h6>Categories</h6>
          </div>
          <div class="col">
            <a class="btn btn-md btn-primary float-right" href="{{ route('admin.category.create') }}">
              Add Category
            </a>
        </div>
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Prefix</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if (count($categories) > 0):
                @foreach ($categories as $category):
                <tr>
                  <td>{{ $category->title }}</td>
                  <td>{{ $category->prefix }}</td>
                  <td>{{ $category->status }}</td>
                  <td>
                    <a href="{{ url('admin/category/edit/'.$category->id) }}" class="btn btn-sm btn-info">
                      <span><i class="ti-pencil"></i></span>
                    </a>
                    <form method="post" action="{{ url('admin/category/delete/'.$category->id) }}" class="d-inline-block">
                      {{ prevent_csrf() }}
                      <input type="hidden" name="_method" value="DELETE" />
                      <button type="submit" class="btn btn-sm btn-danger">
                        <span><i class="ti-trash"></i></span>
                        </a>
                    </form>
                  </td>
                </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="3" class="text-center text-muted">No data found</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
        
      </div>
    </div>
  </div>
</div>

@endblock

@block("scripts")
@endblock