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
            <h6>Subscriptions Plan</h6>
          </div>
          <div class="col">
            <a class="btn btn-md btn-primary float-right" href="{{ route('admin.subscriptions.create') }}">
              Add Plan
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Price</th>
              <th>Days</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if (count($subscriptions) > 0):
              @foreach ($subscriptions as $subscription):
              <tr>
                <td>{{ $subscription->title }}</td>
                <td>{{ $subscription->description }}</td>
                <td>${{ $subscription->price }}</td>
                <td>{{ $subscription->days }}</td>
                <td>
                  <a href="{{ url('admin/subscriptions/edit/'.$subscription->id) }}" class="btn btn-sm btn-info">
                    <span><i class="ti-pencil"></i></span>
                  </a>
                  <form method="post" action="{{ url('admin/subscriptions/delete/'.$subscription->id) }}" class="d-inline-block">
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