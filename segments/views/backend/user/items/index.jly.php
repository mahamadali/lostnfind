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
            <h6>My Items</h6>
          </div>
          <div class="col">
            <a class="btn btn-md btn-primary float-right" href="{{ route('user.items.create') }}">
              Add Item
            </a>
          </div>
        </div>
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>Image</th>
              <th>Tag #</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if ($totalItems > 0):
              @foreach ($items as $item):
              <tr>
                <td>
                    @if(!empty($item->images[0])):
                    <img src="{{ url($item->images[0]->path) }}">
                    @endif
                </td>
                <td>{{ $item->tag_number }}</td>
                <td>{{ $item->name }}</td>
                <td>
                  <a href="{{ url('user/items/view/'.$item->id) }}" class="btn btn-sm btn-success">
                    <span><i class="ti-eye"></i></span>
                  </a>
                  <a href="{{ url('user/items/edit/'.$item->id) }}" class="btn btn-sm btn-info">
                    <span><i class="ti-pencil"></i></span>
                  </a>
                  <!-- <form method="post" action="{{ route('user.items.delete', ['item' => $item->id]) }}" class="d-inline-block">
                  {{ prevent_csrf() }}
                    <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit" class="btn btn-sm btn-danger">
                      <span><i class="ti-trash"></i></span>
                      </a>
                  </form> -->
                </td>
              </tr>
              @endforeach
            @else
              <tr>
                <td colspan="4" class="text-center text-muted">No data found</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endblock

@block("scripts")
@endblock