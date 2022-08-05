@extends('backend/app')

@block("title") {{ setting('app.title', 'Pages') }} @endblock

@block("styles")
@endblock

@block("content")

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <h6>Newsletters</h6>
          </div>
         
        </div>
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>Email</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @if (count($newsletters) > 0):
              @foreach ($newsletters as $newsletter):
              <tr>
                <td>{{ $newsletter->email }}</td>
                <td>{{ $newsletter->status }}</td>
              </tr>
              @endforeach
            @else
              <tr>
                <td colspan="2" class="text-center text-muted">No data found</td>
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