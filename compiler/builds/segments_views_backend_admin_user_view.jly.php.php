<?php class_exists('Jolly\Engine') or exit; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo setting('app.title', 'Quotations'); ?></title>
    
    <link rel="stylesheet" href="<?php echo url('assets/vendors/feather/feather.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/vendors/css/vendor.bundle.base.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/vertical-layout-light/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/vendors/dataTables.net-bs4/dataTables.bootstrap4.css'); ?>">

    

    <link rel="shortcut icon" href="<?php echo url(company()->logo); ?>" />
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="<?php echo url(company()->logo); ?>" class="mr-2" alt="<?php echo setting('app.title'); ?>" title="<?php echo setting('app.title'); ?>" /></a>
    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="<?php echo url(company()->logo); ?>" alt="<?php echo setting('app.title'); ?>" title="<?php echo setting('app.title'); ?>" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
          <i class="ti-user text-primary"></i> <?php echo auth()->first_name." ".auth()->last_name; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="<?php echo route('auth.logout'); ?>">
            <i class="ti-power-off text-primary"></i>
            Logout
          </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <?php if(auth()->role->name == 'admin') { ?>
      <li class="nav-item <?php echo (request()->currentPage() == '/admin/dashboard') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo route('admin.dashboard'); ?>">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item <?php echo (Bones\Str::contains(request()->currentPage(), '/admin/users/')) ? 'active' : ''; ?>">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">Users</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse <?php echo (Bones\Str::contains(request()->currentPage(), '/admin/users/')) ? 'show' : ''; ?>" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="<?php echo route('admin.users.create'); ?>"> Add </a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo route('admin.users.list'); ?>"> Users </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item <?php echo (Bones\Str::contains(request()->currentPage(), '/admin/category/')) ? 'active' : ''; ?>">
        <a class="nav-link" data-toggle="collapse" href="#user_category" aria-expanded="false" aria-controls="user_category">
          <i class="ti-list menu-icon"></i>
          <span class="menu-title">Category</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse <?php echo (Bones\Str::contains(request()->currentPage(), '/admin/category/')) ? 'show' : ''; ?>" id="user_category">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="<?php echo route('admin.category.create'); ?>"> Add </a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo route('admin.category.list'); ?>"> Categories </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item <?php echo (Bones\Str::contains(request()->currentPage(), '/admin/subscriptions/')) ? 'active' : ''; ?>">
        <a class="nav-link" data-toggle="collapse" href="#subscription_menu" aria-expanded="false" aria-controls="subscription_menu">
          <i class="ti-list menu-icon"></i>
          <span class="menu-title">Subscriptions</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse <?php echo (Bones\Str::contains(request()->currentPage(), '/admin/subscriptions/')) ? 'show' : ''; ?>" id="subscription_menu">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="<?php echo route('admin.subscriptions.create'); ?>"> Add </a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo route('admin.subscriptions.list'); ?>"> Subscriptions </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item <?php echo (request()->currentPage() == '/admin/company/index') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo route('admin.company.index'); ?>">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Company</span>
        </a>
      </li>

      <li class="nav-item <?php echo (request()->currentPage() == '/admin/pages/index') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo route('admin.pages.list'); ?>">
          <i class="ti-file menu-icon"></i>
          <span class="menu-title">Pages</span>
        </a>
      </li>

      <li class="nav-item <?php echo (request()->currentPage() == '/admin/faq/index') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo route('admin.faq.list'); ?>">
          <i class="ti-help menu-icon"></i>
          <span class="menu-title">Faq</span>
        </a>
      </li>

      <li class="nav-item <?php echo (Bones\Str::contains(request()->currentPage(), '/admin/socialmedia/')) ? 'active' : ''; ?>">
        <a class="nav-link" data-toggle="collapse" href="#socialmedia" aria-expanded="false" aria-controls="socialmedia">
          <i class="ti-list menu-icon"></i>
          <span class="menu-title">Social Media</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse <?php echo (Bones\Str::contains(request()->currentPage(), '/admin/socialmedia/')) ? 'show' : ''; ?>" id="socialmedia">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="<?php echo route('admin.socialmedia.create'); ?>"> Add </a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo route('admin.socialmedia.list'); ?>"> Social Media </a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item <?php echo (request()->currentPage() == '/admin/smssetting/index') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo route('admin.smssetting.index'); ?>">
          <i class="ti-email menu-icon"></i>
          <span class="menu-title">SMS Account Setting</span>
        </a>
      </li>

      <li class="nav-item <?php echo (request()->currentPage() == '/admin/messagesetting/index') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo route('admin.messagesetting.index'); ?>">
          <i class="ti-email menu-icon"></i>
          <span class="menu-title">Message Setting</span>
        </a>
      </li>

      <li class="nav-item <?php echo (request()->currentPage() == '/admin/renewalmailsetting/index') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo route('admin.renewalmailsetting.index'); ?>">
          <i class="ti-email menu-icon"></i>
          <span class="menu-title">Renewal Mail Setting</span>
        </a>
      </li>
    <?php } ?>
    <?php if(auth()->role->name == 'user') { ?>
      <li class="nav-item <?php echo (request()->currentPage() == '/user/dashboard') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo route('user.dashboard'); ?>">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item <?php echo (request()->currentPage() == '/user/items') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo route('user.items.index'); ?>">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">My Items</span>
        </a>
      </li>
    <?php } ?>

    <li class="nav-item">
      <a class="nav-link" href="<?php echo route('auth.logout'); ?>">
        <i class="icon-power menu-icon"></i>
        <span class="menu-title">Logout</span>
      </a>
    </li>
  </ul>
</nav>
            <div class="main-panel">
                <div class="content-wrapper">
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

<?php if(session()->hasFlash('warning')) { ?>
  <div class="alert alert-warning">
    <span><?php echo session()->flash('warning'); ?></span>
  </div>
<?php } ?>

<?php if(session()->hasFlash('info')) { ?>
  <div class="alert alert-info">
    <span><?php echo session()->flash('info'); ?></span>
  </div>
<?php } ?>
                    <div class="content-wrapper">
    <div class="row">
    <div class="col-12">
        <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="col-lg-4">
                <div class="border-bottom text-center pb-4">
                <img src="<?php echo $user->getAvatarProperty(); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>
                
                <div class="mb-3">
                    <h3><?php echo $user->getFullNameProperty(); ?></h3>
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
                    <?php echo $user->contact_number ?? 'N/A'; ?>
                    </span>
                </p>
                <p class="clearfix">
                    <span class="float-left">
                    Email
                    </span>
                    <span class="float-right text-muted">
                    <?php echo $user->email; ?>
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
                                <?php foreach($user->items() as $key => $item) { ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $item->name; ?></td>
                                        <td><?php echo $item->category->title; ?></td>
                                        <td><?php echo $item->tag_number; ?></td>
                                    </tr>
                                <?php } ?>
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
                </div>
                <footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date('Y'); ?>.  <a href="<?php echo url('/'); ?>" target="_blank"><?php echo setting('app.title'); ?></a>. All rights reserved.</span>
  </div>
</footer>
            </div>
        </div>
    </div>
    <script src="<?php echo url('assets/vendors/js/vendor.bundle.base.js'); ?>"></script>
    <script src="<?php echo url('assets/js/off-canvas.js'); ?>"></script>
    <script src="<?php echo url('assets/js/hoverable-collapse.js'); ?>"></script>
    <script src="<?php echo url('assets/js/template.js'); ?>"></script>
    <script src="<?php echo url('assets/js/settings.js'); ?>"></script>
    <script src="<?php echo url('assets/js/todolist.js'); ?>"></script>
    <script src="<?php echo url('assets/js/tabs.js'); ?>"></script>
    <script src="<?php echo url('assets/vendors/datatables.net/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js'); ?>"></script>

    
    

    <script type="text/javascript">
        var APP_BASE_URL = '<?php echo url("/"); ?>';
    </script>
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
</body>

</html>







