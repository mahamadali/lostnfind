<?php class_exists('Jolly\Engine') or exit; ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo setting('app.title', 'Quotations'); ?></title>
        
        <!-- plugins:css -->
      <link rel="stylesheet" href="<?php echo url('assets/vendors/feather/feather.css'); ?>">
      <link rel="stylesheet" href="<?php echo url('assets/vendors/ti-icons/css/themify-icons.css'); ?>">
      <link rel="stylesheet" href="<?php echo url('assets/vendors/css/vendor.bundle.base.css'); ?>">
      <!-- endinject -->
      <!-- Plugin css for this page -->
      <!-- End plugin css for this page -->
      <!-- inject:css -->
      <link rel="stylesheet" href="<?php echo url('assets/css/vertical-layout-light/style.css'); ?>">
      <!-- endinject -->
      <link rel="shortcut icon" href="<?php echo url('assets/images/favicon.png'); ?>" />
    </head>
    <body>
        <div class="container-scroller">
		    <div class="container-fluid page-body-wrapper full-page-wrapper">
		      <div class="content-wrapper d-flex align-items-center auth px-0">
		        <div class="row w-100 mx-0">
		          <div class="col-lg-4 mx-auto">
				  <center>
					<img src="<?php echo url(company()->logo); ?>" class="mr-2 mb-2" height="100" alt="<?php echo setting('app.title'); ?>" title="<?php echo setting('app.title'); ?>" />
					</center>
		            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
		              <div class="brand-logo">
					  <h5><?php echo setting('app.title', 'Quotations'); ?></h5>
		              </div>
		              <h4>Hello! let's get started</h4>
		              <h6 class="font-weight-light">Sign in to continue.</h6>
					
					  <?php if(session()->hasFlash('error')) { ?>
						<div class="alert alert-danger">
							<span><?php echo session()->flash('error'); ?></span>
						</div>
					  <?php } ?>

					  <?php if(session()->hasFlash('success')) { ?>
						<div class="alert alert-success">
							<span><?php echo session()->flash('success'); ?></span>
						</div>
					  <?php } ?>

		              <form class="pt-3" method="post" action="<?php echo route('auth.check.login'); ?>">
		                <div class="form-group">
		                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
		                </div>
		                <div class="form-group">
		                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
		                </div>
		                <div class="mt-3">
		                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
		                </div>
		              </form>
					  <center><a href="<?php echo route('auth.forgot-password'); ?>" class="text-right">Forgot password?</a></center>
		            </div>
		          </div>
		        </div>
		      </div>
		      <!-- content-wrapper ends -->
		    </div>
		    <!-- page-body-wrapper ends -->
		  </div>
        <script src="<?php echo url('assets/vendors/js/vendor.bundle.base.js'); ?>"></script>
        <script src="<?php echo url('assets/js/off-canvas.js'); ?>"></script>
        <script src="<?php echo url('assets/js/hoverable-collapse.js'); ?>"></script>
        <script src="<?php echo url('assets/js/template.js'); ?>./"></script>
        <script src="<?php echo url('assets/js/settings.js'); ?>"></script>
        <script src="<?php echo url('assets/js/todolist.js'); ?>"></script>
        
    </body>
</html>







