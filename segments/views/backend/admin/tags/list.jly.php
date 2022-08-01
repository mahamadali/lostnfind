@extends('backend/app')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")
@endblock

@block("content")

<div class="row">
  <div class="col-md-12">
    <div class="card card-inverse-light-with-black-text flatten-border">
      <div class="card-header">
        <div class="row">
          <div class="col-md-2">
            <h6>Tags</h6>
          </div>
          <div class="col">
            
            <a class="btn btn-md btn-primary float-right" href="{{ route('admin.tags.create') }}">
              Add Tag
            </a>
            <a class="btn btn-md btn-primary float-right mr-2" data-toggle="modal" data-target="#importModal" href="Javascript:void(0);">
              Import
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Tag Number</th>
              <th>Category</th>
              <th>Locked</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if (count($tags) > 0):
              @foreach ($tags as $tag):
              <tr>
                <td>{{ $tag->tag_number }}</td>
                <td>{{ $tag->category->prefix }}</td>
                <td>{{ $tag->is_locked ? 'Locked' : 'Available' }}</td>
                <td>
                  <a href="{{ url('admin/tags/edit/'.$tag->id) }}" class="btn btn-sm btn-info">
                    <span><i class="ti-pencil"></i></span>
                  </a>
                  <form method="post" action="{{ url('admin/tags/delete/'.$tag->id) }}" class="d-inline-block">
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

<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form method="post" action="{{ route('admin.tags.import') }}" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importModalLabel">Import Tags</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label>Choose CSV File: <small><a href="{{ url('assets/uploads/sample-tags.csv') }}">Sample Tags CSV File</a></small></label>
            <input type="file" name="csv" class="form-control" required>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Import</button>
      </div>
    </div>
  </form>
  </div>
</div>

@endblock

@block("scripts")
@endblock