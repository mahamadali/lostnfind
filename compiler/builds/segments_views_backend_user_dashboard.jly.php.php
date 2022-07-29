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

          <?php if(auth()->role->name == 'user') { ?>
          <a class="dropdown-item" href="<?php echo url('user/profile/edit/'.auth()->id); ?>">
            <i class="ti-user text-primary"></i>
            Update Profile 
          </a>
          <?php } ?>
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

      <li class="nav-item <?php echo (request()->currentPage() == '/admin/messagesetting/list') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo route('admin.messagesetting.list'); ?>">
          <i class="ti-email menu-icon"></i>
          <span class="menu-title">Templates</span>
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
      <li class="nav-item <?php echo (request()->currentPage() == '/user/additional-contacts') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo route('user.additional-contacts.index'); ?>">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Additional Contacts</span>
        </a>
      </li>
      <li class="nav-item <?php echo (request()->currentPage() == '/user/my-plans') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo route('user.my-plans.index'); ?>">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">My Plan</span>
        </a>
      </li>
      <li class="nav-item <?php echo (request()->currentPage() == '/user/transactions') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo route('user.transactions.index'); ?>">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Transactions</span>
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
                    <div class="row">
  <div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Welcome <?php echo auth()->full_name; ?></h3>
        <h6 class="font-weight-normal mb-0">All systems are running smoothly!
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin transparent">
    <div class="row">
      <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-tale">
          <div class="card-body">
            <p class="mb-4">My Items</p>
            <p class="fs-30 mb-2"><?php echo $items; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">Total Transactions</p>
            <p class="fs-30 mb-2"><?php echo $transactions; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-dark-blue">
          <div class="card-body">
            <p class="mb-4">Current Plans</p>
            <p class="fs-30 mb-2"><?php echo $userPlans; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">Additional Contacts</p>
            <p class="fs-30 mb-2"><?php echo $contacts; ?></p>
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
    
</body>

</html>







