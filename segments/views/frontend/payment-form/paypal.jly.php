<html>
    <head>
        <title>Paypal Payment</title>
    </head>
    <body>
  

    <form action="{{ setting('paypal.paypal_url') }}" method="post" id="paypal-form">
         <input type="hidden" name="cmd" value="_xclick"> 
         <input type="hidden" name="business" value="{{ setting('paypal.paypal_id'); }}"> 
         <input type="hidden" name="item_name" id="item_name" value="{{ $plan->title; }}">
            <input type="hidden" name="item_number" id="item_number" value="{{ $plan->id; }}">
          <input type="hidden" name="amount" value="{{ $plan->price; }}">   
          <input type="hidden" name="quantity" value="1"> 
          <input type="hidden" name="currency_code" value="{{ setting('paypal.currency'); }}">  
          
          <input type="hidden" name="rm" value="2" />

            <!-- Custom variable user ID -->
            <input type="hidden" name="custom" value="{{ $planRequest->id; }}">
            <!-- Specify urls -->
            <input type="hidden" name="cancel_return" value="{{ setting('paypal.paypal_cancel_url'); }}?plan_id={{ $plan->id; }}">
            <input type="hidden" name="return" value="{{ setting('paypal.paypal_return_url'); }}?plan_id={{ $plan->id; }}&request_id={{ $planRequest->id; }}">
            <input type="hidden" name="notify_url" value="{{ setting('paypal.paypal_notify_url'); }}">
    </form>

    <script>
        document.getElementById("paypal-form").submit();
    </script>
    </body>
</html>