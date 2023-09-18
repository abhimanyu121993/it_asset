 <div class="sidebar-wrapper">
   <div>
     <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="{{asset('Backend/assets/images/logo/logo.png')}}" alt=""></a>
       <div class="back-btn"><i data-feather="grid"></i></div>
       <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
     </div>
     <div class="logo-icon-wrapper"><a href="index.html">
         <div class="icon-box-sidebar"><i data-feather="grid"></i></div>
       </a></div>
     <nav class="sidebar-main">
       <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
       <div id="sidebar-menu">
         <ul class="sidebar-links" id="simple-bar">
           <li class="back-btn">
             <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
           </li>
           <li class="pin-title sidebar-list">
             <h6>Pinned</h6>
           </li>
           <hr>
           <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="home"></i><span class="lan-3">Dashboard</span></a>
             <ul class="sidebar-submenu">
                <li><a href="{{ url('home')}}">min Dashboard</a></li>
               <li><a href="{{ url('user_dashboard')}}">User Dashboard</a></li>
             </ul>
           </li>
           @can('view_asset')
           <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="airplay"></i><span>Masters</span></a>
             <ul class="sidebar-submenu">
              @can('View_Department')
              <li><a href="{{ url('department')}}">Department</a></li>
              @endcan
              @can('view_designation')
              <li><a href="{{ url('designations')}}">Designation</a></li>
              @endcan
              <li><a href="{{ route('assets-type-index')}}">Asset Type</a></li>
               @can('view_asset')
               <li><a href="{{ url('assets')}}">Asset Name</a></li>
               @endcan
               @can('view_brand')
               <li><a href="{{ route('create-brand')}}">Brands</a></li>
               @endcan
               @can('view_brand_model')
               <li><a href="{{ url('brand-model')}}">Brand Models</a></li>
               @endcan
               @can('view_location')
               <li><a href="{{ url('location-index')}}">Locations</a></li>
               @endcan
               @can('view_sub_location')
               <li><a href="{{ url('sublocation-index')}}">Sub-Locations</a></li>
               @endcan
               @can('view_attributes')
               <li><a href="{{ url('attributes')}}">Attributes</a></li>
               @endcan
               @can('view_supplier')
               <li><a href="{{ url('suppliers')}}">Suppliers</a></li>
               @endcan
               @can('view_asset_status')
               <li><a href="{{url('add-status')}}">Asset Status</a></li>
               @endcan
               @can('view_transfer_reason')
               <li><a href="{{route('transfer-reasons.index')}}">Transfer Reasons</a></li>
               @endcan
             </ul>
           </li>
           @endcan
           @can('view_user')
           <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="layout"></i><span>User Management</span></a>
             <ul class="sidebar-submenu">
               @can('manage_user')<li><a href="{{url('users')}}">All Users</a></li>@endcan
               @can('create_user')
               <li><a href="{{route('users.create')}}">Add User</a></li>
               @endcan
               <!-- <li><a href="{{ url('show')}}">User Details</a></li> -->
               <!-- <li><a href="{{ url('users.user.profile')}}">User Card</a></li> -->
               @can('view_role')
               <li><a href="{{url('roles') }}">Add Role</a></li>
               @endcan
               @can('view_permission')
               <li><a href="{{url('view-permissions') }}">Add Permission</a></li>
               <li><a href="{{route('add.permission') }}">All Permission</a></li>
               @endcan
             </ul>
           </li>
           @endcan
           @can('view_stock')
           <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="home"></i><span>Stocks</span></a>
            <ul class="sidebar-submenu">
              <li><a href="{{ url('manage-stocks')}}">Manage Stocks</a></li>
              @can('manage_stock')<li><a href="{{ url('all-stock')}}">All Stocks</a></li>@endcan
              @can('create_stock')<li><a href="{{ url('stock')}}">Add Stocks</a></li>@endcan
            </ul>
          </li>
          @endcan
          @can('view_asset')
          <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="airplay"></i><span>Assets</span></a>
            <ul class="sidebar-submenu">
              <li><a href="{{ url('it-assets-stock')}}">IT Assets</a></li>
              <li><a href="{{url('non-it-asset')}}">Non-IT Assets</a></li>
              <li><a href="{{url('asset-components')}}">Assets Components</a></li>
              <li><a href="{{url('asset-software')}}">Software</a></li>
            </ul>
          </li>
          @endcan
           @can('view_general_setting')  

           <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="settings" class="fa fa-spin"></i><span>Bussiness Settings</span></a>
             <ul class="sidebar-submenu">
               <li><a href="{{route('settings.application')}}">General Settings</a></li>
               <li><a href="{{ url('/send-email') }}">Mail Configuration</a></li>
             </ul>
           </li>
           @endcan
           @can('view_issuence')   
           <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="box"></i><span>Issuence</span></a>
             <ul class="sidebar-submenu">
               <li><a href="{{ url('issuences')}}"> Add Issuence </a></li>
               <li><a href="{{ url('issuences/all') }}"> All Issuence </a></li>
             </ul>
           </li>
           @endcan
           @can('view_transfer')  
           <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="list"></i><span>Transfer</span></a>
             <ul class="sidebar-submenu">
               <li><a href="{{ url('transfer')}}">Add Transfer</a> </li>
             </ul>
           </li>
           @endcan
           @can('view_depreciation')  
           <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="trash"></i><span>Depreciation</span></a>
             <ul class="sidebar-submenu">
               <li><a href="{{ url('disposal')}}">Add Depreciation</a> </li>
             </ul>
           </li>
           @endcan
           <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="book-open"></i><span>Reports</span></a>
            <ul class="sidebar-submenu">
              <li><a href="{{url('all-reports')}}">All Reports</a> </li>
            </ul>
          </li>
           @can('view_maintenance')
           <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="plus-square"></i><span>Maintenance</span></a>
             <ul class="sidebar-submenu">
               <li><a href="{{route('assets-maintenances')}}">Add Maintenance</a></li>
               <li><a href="{{route('receive-maintenance')}}">Receive Maintenance</a></li>
              </ul>
            </li>
            @endcan
            @if (Auth::check() && Auth::user()->role_id == 2)
            <!-- Issuence menu -->
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="plus-square"></i><span>Issuence</span></a>
                <ul class="sidebar-submenu">
                    <li><a href="#">Issuence Requests</a></li>
                    <li><a href="#">All Issuence</a></li>
                </ul>
            </li>
            <!-- Transfer menu -->
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="plus-square"></i><span>Transfer</span></a>
                <ul class="sidebar-submenu">
                    <li><a href="#">Transfer Requests</a></li>
                    <li><a href="#">All Transfer</a></li>
                </ul>
            </li>
        @endif
         </ul>
       </div>
       <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
     </nav>
   </div>
 </div>
