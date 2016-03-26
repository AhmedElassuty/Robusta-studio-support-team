<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="assets/images/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    @include('layout.search_form')
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
      <li class="active"><a href="../Statics/feed.html"><i class="fa fa-dashboard"></i> <span>Feed</span></a></li>
      <li><a href="statistics.html"><i class="fa fa-pie-chart"></i> <span>Statistics</span></a></li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-ellipsis-h"></i> <span>Settings</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="#" data-toggle="modal" data-target="#create-department-modal"><i class="fa fa-plus"></i> <span>Create Department</span></a></li>
          <li><a href="#" data-toggle="modal" data-target="#create-customer-modal"><i class="fa fa-plus"></i> <span>Create Customer</span></a></li>
          <li><a href="#" data-toggle="modal" data-target="#create-agent-modal"><i class="fa fa-plus"></i> <span>Create Agent</span></a></li>
          <li><a href="#" data-toggle="modal" data-target="#create-label-modal"><i class="fa fa-plus"></i> <span>Create Label</span></a></li>
          <li><a href="#" data-toggle="modal" data-target="#create-priority-modal"><i class="fa fa-plus"></i> <span>Create Priority</span></a></li>
          <li><a href="#" data-toggle="modal" data-target="#create-ticket-modal"><i class="fa fa-plus"></i> <span>Create Ticket</span></a></li>
        </ul>
      </li>
      <li class="header">Spotlight</li>
      <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>VIP Tickets</span></a></li>
    </ul>
  </section>
</aside>