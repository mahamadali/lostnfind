@extends('backend/app')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
      Assign To user
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.tags.store-assign-to-user', ['tag' => $tag->id]) }}">
      {{ prevent_csrf() }}
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>User</label>
              <select name="user_id" id="user_id" class="form-control">
                <option value="">Choose</option>
                @foreach($users as $user): 
                <option value="{{ $user->id }}">{{ $user->first_name.' '.$user->last_name  }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="row email_section">
          <div class="col">
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="email"  />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Plan Type</label>
              <select name="plan_type" id="plan_type" class="form-control" required>
                <option value="">Choose</option>
                <option value="life_time">Life Time</option>
                <option value="365">365 Days</option>
                <option value="custom">Custom</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row expired_date_section">
          <div class="col">
            <div class="form-group">
              <label>Plan Expiration Date</label>
              <input type="date" class="form-control" name="expired_date"  />
            </div>
          </div>
        </div>

        <div class="row renew_price_section">
          <div class="col">
            <div class="form-group">
              <label>Renew Price</label>
              <input type="text" class="form-control" name="renew_price"  />
            </div>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col">
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg">Save</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

@endblock

@block("scripts")

<script>

    $(document).ready(function(){
        $('.expired_date_section').hide();
        $('.renew_price_section').hide();
    })
    
    $(document).on('change','#user_id',function(){
        if($(this).val() == ''){
            $('.email_section').show();
        }else{
            $('.email_section').hide();
        }
    })

    $(document).on('change','#plan_type',function(){
        if($(this).val() == 'custom'){
            $('.expired_date_section').show();
            $('.renew_price_section').show();
        }
        else if($(this).val() == '365'){
            $('.expired_date_section').hide();
            $('.renew_price_section').show();
        }
        else if($(this).val() == 'life_time'){
            $('.expired_date_section').hide();
            $('.renew_price_section').hide();
        }
    })

</script>
@endblock