  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">
        <div class="user-profile">
			<div class="ulogo">
				 <a href="{{route('admin.dashboard')}}">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">
						  <img src="{{url::asset('../backend/images/logo/riser.svg')}}"  width="90" height="50" >
					<h3><b>IMS </b></h3>
					 </div>
				</a>
			</div>
        </div>
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">
		<li>
          <a href="{{route('admin.dashboard')}}">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i data-feather="users"></i>
            <span>View Contacts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{URL::To('manage-shop')}}"><i class="ti-more"></i>View Shop</a></li>
            <li><a href="{{URL::To('manage-supplier')}}"><i class="ti-more"></i>View Supplier</a></li>

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i data-feather="users"></i>
            <span>Project Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{URL::To('manage-customer')}}"><i class="ti-more"></i>View Project</a></li>
          </ul>
        </li>




        <li class="treeview">
          <a href="#">
            <i data-feather="layers"></i>
			<span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="{{URL::To('manage-product-sale')}}"><i class="ti-more"></i>Manage Transfer</a></li>

            <li><a href="{{URL::To('manage-product-purchase')}}"><i class="ti-more"></i>Manage Stock</a></li>

            <li><a href="{{URL::To('manage-product')}}"><i class="ti-more"></i>Manage Product</a></li>

            <li class="treeview">
              <a href="#">Product Data
                <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{URL::To('manage-category')}}"><i class="ti-more"></i>View Category</a></li>



              </ul>
            </li>
          </ul>
        </li>


        <li class="header nav-small-cap">Additional Panel</li>
        <li class="treeview">
          <a href="#">
            <i data-feather="grid"></i>
            <span>Other</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{URL::To('manage-location')}}"><i class="ti-more"></i>View Location</a></li>
            <li><a href="{{URL::To('manage-daily-cost-category')}}"><i class="ti-more"></i>View Daily Cost Category</a></li>

            <li><a href="{{URL::To('manage-unit')}}"><i class="ti-more"></i>View Unit</a></li>

          </ul>
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
	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>