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
          <h4 class="card-title">My Transactions</h4>
        </div>
      </div>
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>TX ID</th>
              <th>Payer ID</th>
              <th>Payment Method</th>
              <th>Payment Status</th>
              <th>Plan</th>
              <!-- <th>Interval</th> -->
              <!-- <th>Start</th>
              <th>End</th> -->
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            @if ($totalTransactions > 0):
              @foreach (user()->transactions()->get() as $main_transaction):

                
              @foreach($main_transaction->log_transactions()->get() as $transaction):
                
              <tr>
                <td>{{ $transaction->txn_id }}</td>
                <td>{{ $transaction->paypal_id }}</td>
                <td>{{ $transaction->payment_method }}</td>
                <td>{{ $transaction->payment_status }}</td>
                <td>{{ $main_transaction->plan()->title }}</td>
               <!-- <td>{{ date('M d, Y', strtotime($main_transaction->valid_from)) }}</td>
                <td>{{ date('M d, Y', strtotime($main_transaction->valid_to)) }}</td>  -->
                <td>{{ $transaction->paid_amount }} {{ $transaction->currency_code }}</td>
              </tr>
              @endforeach

              @endforeach
            @else
              <tr>
                <td colspan="9" class="text-center text-muted">No data found</td>
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