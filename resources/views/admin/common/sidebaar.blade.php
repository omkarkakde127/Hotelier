<!-- Sidebar Start -->
<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="./index.html" class="text-nowrap logo-img">
        <img src="{{asset('dashboard/assets/images/logos/dark-logo.svg')}}" width="180" alt="" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('dashboard')}}" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">UI COMPONENTS</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('home_slider')}}" aria-expanded="false">
            <span>
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">Home_slider</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('about') }}" aria-expanded="false">
            <span>
              <i class="ti ti-alert-circle"></i>
            </span>
            <span class="hide-menu">About</span>
          </a>
        </li>
        
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('room')}}" aria-expanded="false">
            <span>
              <i class="ti ti-cards"></i>
            </span>
            <span class="hide-menu">Room</span>
          </a>
        </li>
        
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('services')}}" aria-expanded="false">
            <span>
              <i class="ti ti-file-description"></i>
            </span>
            <span class="hide-menu">Our Services</span>
          </a>
        </li>
        
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('testimonial')}}" aria-expanded="false">
            <span>
              <i class="ti ti-typography"></i>
            </span>
            <span class="hide-menu">Testimonial</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('luxury')}}" aria-expanded="false">
            <span>
              <i class="ti ti-cards"></i>
            </span>
            <span class="hide-menu">Luxury</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('team')}}" aria-expanded="false">
            <span>
              <i class="ti ti-cards"></i>
            </span>
            <span class="hide-menu">Team</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="{{asset('admin/booking')}}" aria-expanded="false">
            <span>
              <i class="ti ti-typography"></i>
            </span>
            <span class="hide-menu">Booking</span>
          </a>
        </li>
        
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">AUTH</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
            <span>
              <i class="ti ti-login"></i>
            </span>
            <span class="hide-menu">Login</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
            <span>
              <i class="ti ti-user-plus"></i>
            </span>
            <span class="hide-menu">Register</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">EXTRA</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
            <span>
              <i class="ti ti-mood-happy"></i>
            </span>
            <span class="hide-menu">Icons</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
            <span>
              <i class="ti ti-aperture"></i>
            </span>
            <span class="hide-menu">Sample Page</span>
          </a>
        </li>
      </ul>
      <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
        <div class="d-flex">
          <div class="unlimited-access-title me-3">
            <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Upgrade to pro</h6>
            <a href="https://adminmart.com/product/modernize-bootstrap-5-admin-template/" target="_blank"
              class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
          </div>
          <div class="unlimited-access-img">
            <img src="{{asset('dashboard/assets/images/backgrounds/rocket.png')}}" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->

