@extends('app')

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
            <h6>Suppliers</h6>
          </div>
          <div class="col">
            <a class="btn btn-md btn-primary float-right" href="{{ route('admin.suppliers.create') }}">
              Add Supplier
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Create At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if (count($suppliers) > 0):
            @foreach ($suppliers as $supplier):
            <tr>
              <td>{{ $supplier->full_name }}</td>
              <td>{{ $supplier->email }}</td>
              <td>{{ $supplier->created_at }}</td>
              <td>
                <a href="{{ url('admin/suppliers/edit/'.$supplier->id) }}" class="btn btn-sm btn-info">
                  <span><i class="ti-pencil"></i></span>
                </a>
                <form method="post" action="{{ url('admin/suppliers/delete/'.$supplier->id) }}" class="d-inline-block">
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