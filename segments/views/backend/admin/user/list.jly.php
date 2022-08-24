@extends('backend/app')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")
@endblock

@block("content")

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-md-2">
            <h6>Users</h6>
          </div>
          <div class="col">
            <a class="btn btn-md btn-primary float-right" href="{{ route('admin.users.create') }}">
              Add User
            </a>
          </div>
        </div>
        <div class="table-responsive">
        <table class="table datatable">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Contact Number</th>
              <th>Create At</th>
              <th>Expired At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            
            @if ($totalUsers > 0):
              @foreach ($users as $user):
              <tr>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ formatPhoneNumber($user->contact_number) ?? 'N/A' }}</td>
                <td>{{ date('M d, Y H:i', strtotime($user->created_at)) }}</td>
                <td>{{ $user->expiration_date != '' ? date('M d, Y', strtotime($user->expiration_date)) : '' }}</td>
                <td>
                  <a href="{{ url('admin/users/view/'.$user->id) }}" class="btn btn-sm btn-success">
                    <span><i class="ti-eye"></i></span>
                  </a>
                  <a href="{{ url('admin/users/edit/'.$user->id) }}" class="btn btn-sm btn-info">
                    <span><i class="ti-pencil"></i></span>
                  </a>
                  <form method="post" action="{{ url('admin/users/delete/'.$user->id) }}" class="d-inline-block">
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
              <td colspan="4" class="text-center text-muted">No data found</td>
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