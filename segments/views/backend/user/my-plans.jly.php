@extends('backend/app')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")

@endblock

@block("content")

<div class="row">
    @if(!empty($plans)):
        @foreach($plans as $plan): 
            @if($plan->transaction->owner_id == auth()->id):
                
            <div class="col-md-4 mb-4 stretch-card transparent">
                <div class="card card-tale">
                <div class="card-body">
                    <p class="fs-30 mb-2">{{ !empty($plan) ? $plan->title : '' }}</p>

                    <p class="mb-2">{{ $plan->description }}</p>
                    
                    <p class="mb-5">{{ !empty($plan) ? $plan->days. " Days" : 'No Plan Active' }} </p>

                    <!-- <p class="fs-30 mb-4">{{ $plan->category }}</p> -->

                    <p class="fs-30 mb-2">{{ $plan->transaction->tag_number }}</p>

                    <p class="mb-2">Plan activated on {{ date('M d, Y', strtotime($plan->transaction->valid_from)) }}</p>

                    @if(!empty($plan->transaction->valid_to)):
                    
                    @if(strtotime($plan->transaction->valid_to) > strtotime(date('Y-m-d H:i:s'))):
                        <p class="mb-2">Will expire on {{ date('M d, Y', strtotime($plan->transaction->valid_to)) }}</p>
                    @else
                        <p class="mt-4 mb-4 fs-30 text-pink">{{ $plan->transaction->status }}</p>
                       
                            <a href="{{ route('paypal.plan-renew', ['plan_request' => $plan->transaction->user_id]) }}" class="btn btn-primary">Activate</a>
                       
                    @endif

                    @else
                    <p class="mb-2">Life Time</p>
                    @endif
                </div>
                </div>
            </div>
            @endif
        @endforeach
    @endif
</div>

@endblock

@block("scripts")

@endblock