<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        {{-- <img class="app-sidebar__user-avatar" src="img/IMG.jpg" alt="User Image" width="60px"> --}}
        <div>
          <p class="app-sidebar__user-name">Sagar Gantyala</p>
          <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="{{ route('home')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item" href="{{ route('adminstaff.categories')}}"><i class="app-menu__icon fa fa-pencil-square-o"></i><span class="app-menu__label">Categories</span></a></li>
        <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Requests</span></a></li>
        <li><a class="app-menu__item" href="{{ route('adminstaff.products')}}"><i class="app-menu__icon fa fa-plus-circle"></i><span class="app-menu__label">Add Products</span></a></li>
        <li><a class="app-menu__item" href="userlist.html"><i class="app-menu__icon fa fa-address-book-o"></i><span class="app-menu__label">Users List</span></a></li>
        <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Reports</span></a></li>
        <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Logs</span></a></li>
        <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-question-circle"></i><span class="app-menu__label">Help Page</span></a></li>
      </ul>
    </aside>
