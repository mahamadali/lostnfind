@extends('backend/auth-master')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")
        
@endblock

@block("content")
		<div class="container-scroller">
		    <div class="container-fluid page-body-wrapper full-page-wrapper">
		      <div class="content-wrapper d-flex align-items-center auth px-0">
		        <div class="row w-100 mx-0">
		          <div class="col-lg-4 mx-auto">
				  <center>
					<img src="{{ url(company()->logo) }}" class="mr-2 mb-2" height="100" alt="{{ setting('app.title') }}" title="{{ setting('app.title') }}" />
					</center>
		            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
		              <div class="brand-logo">
					  <h5>{{ setting('app.title', 'Quotations') }}</h5>
		              </div>
		              <h4>Reset password</h4>
		              <h6 class="font-weight-light">You will receive reset password link</h6>
					
					  @if (session()->hasFlash('error')):
						<div class="alert alert-danger">
							<span>{{ session()->flash('error') }}</span>
						</div>
					  @endif

					  @if (session()->hasFlash('success')):
						<div class="alert alert-success">
							<span>{{ session()->flash('success') }}</span>
						</div>
					  @endif

		              <form class="pt-3" method="post" action="{{ route('auth.forgot-password.submit') }}">
		                <div class="form-group">
		                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" required>
		                </div>
		                <div class="mt-3">
		                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Submit</button>
		                </div>
		              </form>
					  <center><a href="{{ route('auth.login') }}" class="text-right">Login</a></center>
		            </div>
		          </div>
		        </div>
		      </div>
		      <!-- content-wrapper ends -->
		    </div>
		    <!-- page-body-wrapper ends -->
		  </div>
@endblock

@block("scripts")
    
@endblock