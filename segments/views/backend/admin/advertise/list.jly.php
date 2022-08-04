@extends('backend/app')

@block("title") {{ setting('app.title', 'Advertise') }} @endblock


@block("styles")
@endblock


@block("content")

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <h6>Advertises</h6>
          </div>
          <div class="col">
            <a class="btn btn-md btn-primary float-right" href="{{ route('admin.advertise.create') }}">
              Add Advertise
            </a>
          </div>
        </div>
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>Name</th>
              <th>Image</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if (count($advertises) > 0):
              @foreach ($advertises as $advertise):
              <tr>
                <td>{{ $advertise->title }}</td>
                <td> <img src="{{ url($advertise->image) }}"></td>
                <td>{{ $advertise->description }}</td>
                <td>
                  <a href="{{ url('admin/advertise/edit/'.$advertise->id) }}" class="btn btn-sm btn-info">
                    <span><i class="ti-pencil"></i></span>
                  </a>
                  <form method="post" action="{{ url('admin/advertise/delete/'.$advertise->id) }}" class="d-inline-block">
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

@endblock

@block("scripts")
@endblock