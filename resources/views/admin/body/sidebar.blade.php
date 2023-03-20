  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
      <!-- sidebar-->
      <section class="sidebar">
          <div class="user-profile">
              <div class="ulogo">
                  <a href="{{ route('admin.dashboard') }}">
                      <!-- logo for regular state and mobile devices -->
                      <div class="d-flex align-items-center justify-content-center">
                          <img src="{{ url::asset('../backend/images/logo/riser.svg') }}" width="90" height="50">
                          <h3><b>IMS </b></h3>
                      </div>
                  </a>
              </div>
          </div>
          <!-- sidebar menu-->
          <ul class="sidebar-menu" data-widget="tree">
              <li>
                  <a href="{{ route('admin.dashboard') }}">
                      <i data-feather="pie-chart"></i>
                      <span>Dashboard</span>
                  </a>
              </li>



              <li class="header nav-small-cap">Project</li>

              <li>
                  <a href="{{ URL::To('manage-customer') }}">
                      <i data-feather="briefcase"></i>
                      <span>Project Management</span>
                  </a>
              </li>

              <li class="header nav-small-cap">Material Management</li>




              <li>
                  <a href="{{ URL::To('manage-supplier') }}">
                      <i data-feather="user"></i>
                      <span>Material Supplier</span>
                  </a>
              </li>
              <li>
                  <a href="{{ URL::To('manage-product') }}">
                      <i data-feather="shopping-cart"></i>
                      <span>Manage Material</span>
                  </a>
              </li>
              <li>
                  <a href="{{ URL::To('manage-product-purchase') }}">
                      <i data-feather="plus-square"></i>
                      <span>Material Stock</span>
                  </a>
              </li>


              <li>
                  <a href="{{ URL::To('manage-product-sale') }}">
                      <i data-feather="minus-square"></i>
                      <span>Material Transfer</span>
                  </a>
              </li>

              <li class="header nav-small-cap">Prerequisite</li>

              <li>
                  <a href="{{ URL::To('manage-daily-cost-category') }}">
                      <i data-feather="list"></i>
                      <span>Daily Cost
                          Category</span>
                  </a>
              </li>

              <li>
                  <a href="{{ URL::To('manage-category') }}">
                      <i data-feather="git-pull-request"></i>
                      <span>Material Category</span>
                  </a>
              </li>
              <li>
                  <a href="{{ URL::To('manage-unit') }}">
                      <i data-feather="box"></i>
                      <span>Material Unit</span>
                  </a>
              </li>


              <li>
                  <a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                      <i data-feather="lock"></i>
                      <span>Log Out</span>
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>











              </li>
          </ul>
      </section>
      {{-- <div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div> --}}
  </aside>
