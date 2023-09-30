@php
    $uri = $_SERVER['REQUEST_URI'];
@endphp
<!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?=($uri === '/anggota') ? '' : 'collapsed'?>" href="{{url('')}}/anggota">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link <?=(preg_match('/wilayah/',$uri)) ? '' : 'collapsed'?>" href="{{url('')}}/anggota/wilayah">
          <i class="fa-solid fa-list"></i>
          <span>Data Wilayah</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?=(preg_match('/pendukung/',$uri)) ? '' : 'collapsed'?>" href="{{url('')}}/anggota/pendukung">
          <i class="fa-solid fa-list"></i>
          <span>Data Pendukung</span>
        </a>
      </li>


    </ul>

  </aside><!-- End Sidebar-->
