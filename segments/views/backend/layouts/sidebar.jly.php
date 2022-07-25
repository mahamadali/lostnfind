<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    @if (auth()->role->name == 'admin'):
      <li class="nav-item {{ (request()->currentPage() == '/admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item {{ (Bones\Str::contains(request()->currentPage(), '/admin/users/')) ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">Users</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ (Bones\Str::contains(request()->currentPage(), '/admin/users/')) ? 'show' : '' }}" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.users.create') }}"> Add </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.users.list') }}"> Users </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ (Bones\Str::contains(request()->currentPage(), '/admin/category/')) ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#user_category" aria-expanded="false" aria-controls="user_category">
          <i class="ti-list menu-icon"></i>
          <span class="menu-title">Category</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ (Bones\Str::contains(request()->currentPage(), '/admin/category/')) ? 'show' : '' }}" id="user_category">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.category.create') }}"> Add </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.category.list') }}"> Categories </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ (Bones\Str::contains(request()->currentPage(), '/admin/subscriptions/')) ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#subscription_menu" aria-expanded="false" aria-controls="subscription_menu">
          <i class="ti-list menu-icon"></i>
          <span class="menu-title">Subscriptions</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ (Bones\Str::contains(request()->currentPage(), '/admin/subscriptions/')) ? 'show' : '' }}" id="subscription_menu">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.subscriptions.create') }}"> Add </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.subscriptions.list') }}"> Subscriptions </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ (request()->currentPage() == '/admin/company/index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.company.index') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Company</span>
        </a>
      </li>
      <li class="nav-item {{ (request()->currentPage() == '/admin/smssetting/index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.smssetting.index') }}">
          <i class="ti-email menu-icon"></i>
          <span class="menu-title">SMS Account Setting</span>
        </a>
      </li>

      <li class="nav-item {{ (Bones\Str::contains(request()->currentPage(), '/admin/category/')) ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#socialmedia" aria-expanded="false" aria-controls="socialmedia">
          <i class="ti-list menu-icon"></i>
          <span class="menu-title">Social Media</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ (Bones\Str::contains(request()->currentPage(), '/admin/socialmedia/')) ? 'show' : '' }}" id="socialmedia">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.socialmedia.create') }}"> Add </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.socialmedia.list') }}"> Social Media </a></li>
          </ul>
        </div>
      </li>

    @endif
    @if (auth()->role->name == 'user'):
      <li class="nav-item {{ (request()->currentPage() == '/user/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.dashboard') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
    @endif

    <li class="nav-item">
      <a class="nav-link" href="{{ route('auth.logout') }}">
        <i class="icon-power menu-icon"></i>
        <span class="menu-title">Logout</span>
      </a>
    </li>
  </ul>
</nav>