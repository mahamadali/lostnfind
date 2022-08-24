@extends('backend/app')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")
@endblock

@block("content")

<div class="content-wrapper">
    <div class="row">
    <div class="col-12">
        <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="col-lg-4">
                <div class="border-bottom text-center pb-4">
                <img src="{{ $user->logo ? url($user->logo) : $user->getAvatarProperty() }}" alt="profile" class="img-lg rounded-circle mb-3"/>
                
                <div class="mb-3">
                    <h3>{{ $user->getFullNameProperty()  }}</h3>
                    <div class="d-flex align-items-center justify-content-center">
                    </div>
                </div>
                
                </div>
                
                <div class="py-4">
                <p class="clearfix">
                    <span class="float-left">
                    Status
                    </span>
                    <span class="float-right text-muted">
                    Active
                    </span>
                </p>
                <p class="clearfix">
                    <span class="float-left">
                    Phone Number
                    </span>
                    <span class="float-right text-muted">
                    {{ $user->contact_number ?? 'N/A'  }}
                    </span>
                </p>
                <p class="clearfix">
                    <span class="float-left">
                    Email
                    </span>
                    <span class="float-right text-muted">
                    {{ $user->email  }}
                    </span>
                </p>
                </div>
            </div>
            <div class="col-lg-8">
              <div class="card">
                <div class="card-body">
                  <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-item-tab" data-id="pills-item" data-bs-toggle="pill" href="#pills-item" role="tab" aria-controls="pills-item" aria-selected="true">Item</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-plan-tab" data-id="pills-plan" data-bs-toggle="pill" href="#pills-plan" role="tab" aria-controls="pills-plan" aria-selected="false">Plan</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-contact-tab" data-id="pills-contact" data-bs-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Additional Contact</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-transaction-tab" data-id="pills-transaction" data-bs-toggle="pill" href="#pills-transaction" role="tab" aria-controls="pills-transaction" aria-selected="false">Transactions</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-item" role="tabpanel" aria-labelledby="pills-item-tab">
                      <div class="media">
                        <div class="media-body">
                        <div class="table-responsive">  
                          <table id="item-listing" class="table dataTable no-footer">
                            <thead>
                                <th class="sorting_asc">#</th>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Tag Number</th>
                            </thead>
                            <tbody>
                                @foreach($user->items() as $key => $item):
                                    <tr>
                                        <td>{{  $key + 1}}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category->title }}</td>
                                        <td>{{ $item->tag_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                        </div>
                      </div>
                    </div>



                    <div class="tab-pane fade" id="pills-plan" role="tabpanel" aria-labelledby="pills-plan-tab">
                      <div class="media">
                       
                        <div class="media-body">
                        <div class="row">
                              @if(!empty($plans)):
                                  @foreach($plans as $plan): 
                                      @if($plan->transaction->owner_id == $user->id):
                                      <div class="col-md-4 mb-4 stretch-card transparent">
                                          <div class="card card-tale">
                                          <div class="card-body">
                                              <p class="fs-30 mb-2">{{ !empty($plan) ? $plan->title : '' }}</p>

                                              <p class="mb-2">{{ $plan->description }}</p>
                                              
                                              <p class="mb-5">{{ !empty($plan) ? $plan->days. " Days" : 'No Plan Active' }} </p>

                                              <p class="fs-30 mb-2">{{ $plan->category }}</p>

                                              <p class="mb-2">Plan activated on {{ date('M d, Y', strtotime($plan->transaction->valid_from)) }}</p>

                                              @if(strtotime($plan->transaction->valid_to) > strtotime(date('Y-m-d H:i:s'))):
                                                  <p class="mb-2">Will expire on {{ date('M d, Y', strtotime($plan->transaction->valid_to)) }}</p>
                                              @else
                                                  <p class="mb-4 fs-30 text-pink">Expired!</p>
                                                  <a href="#" class="btn btn-primary">Renew</a>
                                              @endif
                                              

                                          </div>
                                          </div>
                                      </div>
                                    @endif
                                  @endforeach
                              @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                      <div class="media">
                        
                        <div class="media-body">
                          <div class="table-responsive">  
                            <table id="item-listing" class="table dataTable no-footer">
                              <thead>
                                <tr>
                                  <th>Full Name</th>
                                  <th>Email</th>
                                  <th>Contact No.</th>
                                </tr>
                              </thead>
                              <tbody>
                              @if ($totalContacts > 0):
                                @foreach ($additionalContacts as $contact):
                                <tr>
                                  <td>{{ $contact->full_name }}</td>
                                  <td>{{ $contact->email }}</td>
                                  <td>{{ $contact->contact }}</td>
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

                    <div class="tab-pane fade" id="pills-transaction" role="tabpanel" aria-labelledby="pills-transaction-tab">
                      <div class="media">
                        <div class="media-body" style="width: 100%;">
                          <div class="table-responsive">  
                              <table id="item-listing" class="table dataTable no-footer">
                                <thead>
                                  <tr>
                                    <th>TX ID</th>
                                    <th>Subscriber Id</th>
                                    <th>Payment Method</th>
                                    <th>Payment Status</th>
                                    <th>Plan</th>
                                    <th>Interval</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Amount</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @if ($totalTransactions > 0):
                                    @foreach ($transactions->get() as $transaction):
                                    <tr>
                                      <td>{{ $transaction->txn_id }}</td>
                                      <td>{{ $transaction->paypal_subscr_id }}</td>
                                      <td>{{ $transaction->payment_method }}</td>
                                      <td>{{ $transaction->payment_status }}</td>
                                      <td>{{ $transaction->plan()->title }}</td>
                                      <td>{{ $transaction->subscr_interval_count }} {{ $transaction->subscr_interval }}</td>
                                      <td>{{ date('M d, Y', strtotime($transaction->valid_from)) }}</td>
                                      <td>{{ date('M d, Y', strtotime($transaction->valid_to)) }}</td>
                                      <td>{{ $transaction->plan()->price }} {{ $transaction->currency_code }}</td>
                                    </tr>
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

                  </div>
                </div>
              </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

@endblock

@block("scripts")
<script>
    $('.nav-link').click(function(){
        var current = $(this).data('id');
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        $('.tab-pane').removeClass('active');
        $('.tab-pane').removeClass('show');
        $('#'+current).addClass('active show');
    })


    

    $(function($) {
      'use strict';
      $(function() {
        $('#item-listing').DataTable({
          "aLengthMenu": [
            [5, 10, 15, -1],
            [5, 10, 15, "All"]
          ],
          "iDisplayLength": 10,
          "language": {
            search: ""
          }
        });
        $('#item-listing').each(function() {
          var datatable = $(this);
          // SEARCH - Add the placeholder for Search and Turn this into in-line form control
          var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
          search_input.attr('placeholder', 'Search');
          search_input.removeClass('form-control-sm');
          // LENGTH - Inline-Form control
          var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
          length_sel.removeClass('form-control-sm');
        });
      });
    });

</script>
@endblock