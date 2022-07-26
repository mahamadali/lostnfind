<?php class_exists('Jolly\Engine') or exit; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo setting('app.title', 'Social Media'); ?></title>
    
    <link rel="stylesheet" href="<?php echo url('assets/vendors/feather/feather.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/vendors/css/vendor.bundle.base.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/vertical-layout-light/style.css'); ?>">
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
  <div class="col-md-12">
    <div class="card card-inverse-light-with-black-text flatten-border">
      <div class="card-header">
        <div class="row">
          <div class="col-md-2">
            <h6>Social Media Footer Menu</h6>
          </div>
          <div class="col">
            <a class="btn btn-md btn-primary float-right" href="<?php echo route('admin.socialmedia.create'); ?>">
              Add Menu
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Icon</th>
              <th>Url</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($socialmedia) > 0) { ?>
              <?php foreach($socialmedia as $smedia) { ?>
              <tr>
                <td><?php echo $smedia->title; ?></td>
                <td><?php echo $smedia->icon; ?></td>
                <td><?php echo $smedia->url; ?></td>
                <td>
                  <a href="<?php echo url('admin/socialmedia/edit/'.$smedia->id); ?>" class="btn btn-sm btn-info">
                    <span><i class="ti-pencil"></i></span>
                  </a>
                  <form method="post" action="<?php echo url('admin/socialmedia/delete/'.$smedia->id); ?>" class="d-inline-block">
                    <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit" class="btn btn-sm btn-danger">
                      <span><i class="ti-trash"></i></span>
                      </a>
                  </form>
                </td>
              </tr>
              <?php } ?>
            <?php } else { ?>
              <tr>
                <td colspan="3" class="text-center text-muted">No data found</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
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
    <script type="text/javascript">
        var APP_BASE_URL = '<?php echo url("/"); ?>';
    </script>
    
</body>

</html>









