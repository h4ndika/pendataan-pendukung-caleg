@php
    $uri = $_SERVER['REQUEST_URI'];
@endphp
<!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?=($uri === '/admin') ? '' : 'collapsed'?>" href="{{url('')}}/admin">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link <?=(preg_match('/timses/',$uri)) ? '' : 'collapsed'?>" href="{{url('')}}/admin/timses">
          <i class="fa-solid fa-list"></i>
          <span>Data Ketua Timses</span>
        </a>
      </li>


    </ul>

  </aside><!-- End Sidebar-->
