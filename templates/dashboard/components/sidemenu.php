<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <?php if ($_SESSION['user']->hasRoleByName("CLIENT") || $_SESSION['user']->hasRoleByName("VENDOR")) { ?>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/applications">
                    <span data-feather="home"></span>
                    Aplicarile mele
                </a>
            </li>
            <?php } ?>
            <?php if ($_SESSION['user']->hasRoleByName("ADMIN")) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/users">
                        <span data-feather="home"></span>
                        Utilizatori platforma
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
