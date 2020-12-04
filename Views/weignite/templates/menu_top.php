<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <ul class="navbar-nav theme-brand flex-row  text-center" style="background: white !important;">
            <li class="nav-item theme-logo">
                <a href="<?= base_url("admin") ?>">
                    <img src="<?= base_url("{$carpeta}/assets/images/logo.png") ?>" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="<?= base_url("admin") ?>" class="nav-link" style="color: gray !important;"> We Ignite </a>
            </li>
        </ul>

        <ul class="list-unstyled menu-categories ps ps--active-y" id="accordionExample">
            <li class="menu menu-heading">
                <div class="heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                    <span>Projects</span>
                </div>
            </li>
            <li class="menu">
                <a href="<?= base_url("project/dashboard") ?>" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">view_carousel</i>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="<?= base_url("project/list") ?>" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">inbox</i>
                        <span>Projects List</span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</div>
<!--  END SIDEBAR  -->
