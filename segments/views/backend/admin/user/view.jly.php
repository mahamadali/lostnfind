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
                <img src="{{ $user->getAvatarProperty()  }}" alt="profile" class="img-lg rounded-circle mb-3"/>
                
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
                <div class="d-block d-md-flex justify-content-between mt-4 mt-md-0">
                <div class="text-center mt-4 mt-md-0">
                    <button class="btn btn-outline-primary">Update</button>
                    <button class="btn btn-primary">Send Message</button>
                    <button class="btn btn-primary">Send Email </button>
                    <button class="btn btn-primary">Resend Activation Link</button>
                </div>
                </div>
              
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
                          <p>Plan</p>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                      <div class="media">
                        
                        <div class="media-body">
                          <p>
                             Contact
                          </p>
                         
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane fade" id="pills-transaction" role="tabpanel" aria-labelledby="pills-transaction-tab">
                      <div class="media">
                        <div class="media-body">
                          <p>
                          Transaction
                          </p>
                          
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