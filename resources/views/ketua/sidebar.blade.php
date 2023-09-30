@php
    $uri = $_SERVER['REQUEST_URI'];
@endphp
<!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?=($uri === '/ketua') ? '' : 'collapsed'?>" href="{{url('')}}/ketua">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link <?=(preg_match('/anggota/',$uri)) ? '' : 'collapsed'?>" href="{{url('')}}/ketua/anggota">
          <i class="fa-solid fa-list"></i>
          <span>Data Anggota</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?=(preg_match('/pendukung/',$uri)) ? '' : 'collapsed'?>" href="{{url('')}}/ketua/pendukung">
          <i class="fa-solid fa-list"></i>
          <span>Data Pendukung</span>
        </a>
      </li>


    </ul>

  </aside><!-- End Sidebar-->
