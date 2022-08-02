@extends('backend/app')

@block("title") {{ setting('app.title', 'Social Media') }} @endblock


@block("styles")
@endblock


@block("content")

<div class="row">
  <div class="col-md-12">
    <div class="card card-inverse-light-with-black-text flatten-border">
      <div class="card-header">
        <div class="row">
          <div class="col-md-2">
            <h6>Social Media Footer Menu</h6>
          </div>
          <div class="col">
            <a class="btn btn-md btn-primary float-right" href="{{ route('admin.socialmedia.create') }}">
              Add Menu
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Icon</th>
              <th>Url</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if (count($socialmedia) > 0):
              @foreach ($socialmedia as $smedia):
              <tr>
                <td>{{ $smedia->title }}</td>
                <td>{{ $smedia->icon }}</td>
                <td>{{ $smedia->url }}</td>
                <td>
                  <a href="{{ url('admin/socialmedia/edit/'.$smedia->id) }}" class="btn btn-sm btn-info">
                    <span><i class="ti-pencil"></i></span>
                  </a>
                  <form method="post" action="{{ url('admin/socialmedia/delete/'.$smedia->id) }}" class="d-inline-block">
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