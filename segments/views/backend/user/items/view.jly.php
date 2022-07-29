@extends('backend/app')

@block("title") {{ setting('app.title', 'Item') }} @endblock

@block("styles")
<style>
  .td_bold{
    font-weight:bold;
  }
  #item_info_table td{
    border:1px solid grey;

  }
</style>
@endblock

@block("content")

<div class="content-wrapper">
    <div class="row">
    <div class="col-12">
        <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="col-lg-4">
                <div class=" text-center pb-4">
                
                @if(!empty($item->images[0])):
                  <img src="{{ url($item->images[0]->path) }}" alt="profile" class="mb-3" width="200" height="200"/>
                @endif
               
                
                <div class="mb-3">
                    <h3>{{ $item->name  }}</h3>
                    <div class="d-flex align-items-center justify-content-center">
                    </div>
                </div>
                
                </div>
            </div>
            <div class="col-lg-8">
              <div class="card">
              <table class="table table-bordered" id="item_info_table">
                      <tbody>
                        <tr >
                          <td class="td_bold table-info">ID</td>
                          <td class="table-primary">{{ $item->id }}</td>
                          <td class="td_bold table-info"> ePet ID </td>
                          <td class="table-primary"> {{ $item->tag_number }}</td>
                        </tr>
                        <tr>
                          <td class="td_bold table-info"> Description</td>
                          <td colspan="3" class="table-primary"> {{ $item->description }}</td>
                        </tr>
                        <tr>
                          <td class="td_bold table-info"> Name </td>
                          <td class="table-primary"> {{ $item->name }}</td>
                          <td class="td_bold table-info"> Breed</td>
                          <td class="table-primary"> {{ $item->breed }} </td>
                        </tr>
                        <tr>
                          <td class="td_bold table-info"> Preferred pet food</td>
                          <td class="table-primary"> {{ $item->preferred_pet_food }}</td>
                          <td class="td_bold table-info"> Any distingushing marks</td>
                          <td class="table-primary"> {{ $item->distinguishing_marks }} </td>
                        </tr>
                        <tr>
                          <td class="td_bold table-info">Additional Notes</td>
                          <td  class="table-primary"> {{ $item->notes }}</td>
                          <td class="td_bold table-info">Date of birth</td>
                          <td  class="table-primary">{{ $item->date_of_birth }}</td>
                        </tr>
                        <tr>
                          <td class="td_bold table-info">Gender</td>
                          <td  class="table-primary"> {{ $item->gender }}</td>
                          <td class="td_bold table-info">Height</td>
                          <td  class="table-primary">{{ $item->height }}</td>
                        </tr>
                        <tr>
                          <td class="td_bold table-info">Weight</td>
                          <td  class="table-primary"> {{ $item->weight }}</td>
                          <td class="td_bold table-info">Lenght of tail</td>
                          <td  class="table-primary">{{ $item->length }}</td>
                        </tr>
                        <tr>
                          <td class="td_bold table-info">Type</td>
                          <td  class="table-primary"> {{ $item->type }}</td>
                          <td class="td_bold table-info">Create Time</td>
                          <td  class="table-primary">{{ $item->created_at }}</td>
                        </tr>
                        <tr>
                          <td class="td_bold table-info">Created By</td>
                          <td  class="table-primary"> {{ $item->user()->first_name }}</td>
                        </tr>
                      </tbody>
                    </table>
              </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>

  <br>
    <div class="row">
    <div class="col-12">
        <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="col-lg-12">
              <div class="card">
              <div class="card-body">
                  <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-item-tab" data-id="pills-plan" data-bs-toggle="pill" href="#pills-plan" role="tab" aria-controls="pills-plan" aria-selected="true">User Plan</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-transaction-tab" data-id="pills-transaction" data-bs-toggle="pill" href="#pills-transaction" role="tab" aria-controls="pills-transaction" aria-selected="false">Transactions</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-plan" role="tabpanel" aria-labelledby="pills-plan-tab">
                      <div class="media">
                        <div class="media-body">
                        <div class="table-responsive">  
                          <table id="item-listing" class="table dataTable no-footer">
                            <thead>
                                <th class="sorting_asc">#</th>
                                <th>Amount</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Plan</th>
                            </thead>
                            <tbody>
                                  <tr>
                                      <td>1</td>
                                      <td>TestA</td>
                                      <td>TestB</td>
                                      <td>11111</td>
                                      <td>11111</td>
                                  </tr>
                            </tbody>
                          </table>
                        </div>
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