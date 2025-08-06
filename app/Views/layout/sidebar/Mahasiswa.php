<?php
$currentPath = service('uri')->getPath();
?>
<nav class="mt-2">
    <!--begin::Sidebar Menu-->
    <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="navigation"
        aria-label="Main navigation"
        data-accordion="false"
        id="navigation">
        <li class="nav-item">
            <a href="/dashboard/Mahasiswa" class="nav-link <?= $currentPath == '/dashboard/Mahasiswa' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-people"></i>
                <p>Welcome</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/dashboard/Mahasiswa/survey-dosen" class="nav-link <?= $currentPath == '/dashboard/Mahasiswa/survey-dosen' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-people"></i>
                <p>Survey Dosen</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/dashboard/Mahasiswa/survey-prasarana" class="nav-link <?= $currentPath == '/dashboard/Mahasiswa/survey-prasarana' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-building"></i>
                <p>Survey Prasarana</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/dashboard/Mahasiswa/survey-tenaga-pendidik" class="nav-link <?= $currentPath == '/dashboard/Mahasiswa/survey-tenaga-pendidik' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-person-badge"></i>
                <p>Survey Tenaga Pendidik</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/logout" class="nav-link">
                <i class="nav-icon bi-arrow-bar-left"></i>
                <p>Logout</p>
            </a>
        </li>
    </ul>
    <!--end::Sidebar Menu-->
</nav>