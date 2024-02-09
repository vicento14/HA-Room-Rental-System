<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <?php include('brand_logo.php'); ?>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <?php if ($_SERVER['REQUEST_URI'] == "/harrs/admin/dashboard.php") {?>
    <li class="nav-item active">
    <?php } else {?>
    <li class="nav-item">
    <?php } ?>
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Accounts -->
    <?php if ($_SERVER['REQUEST_URI'] == "/harrs/admin/accounts.php") {?>
    <li class="nav-item active">
    <?php } else {?>
    <li class="nav-item">
    <?php } ?>
        <a class="nav-link" href="accounts.php">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Accounts</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Room Management
    </div>

    <!-- Nav Item - Rooms -->
    <?php if ($_SERVER['REQUEST_URI'] == "/harrs/admin/rooms.php") {?>
    <li class="nav-item active">
    <?php } else {?>
    <li class="nav-item">
    <?php } ?>
        <a class="nav-link" href="rooms.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Rooms</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Tables
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <?php if ($_SERVER['REQUEST_URI'] == "/harrs/admin/tables.php") {?>
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
    <?php } else {?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
    <?php } ?>
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span>
        </a>
        <?php if ($_SERVER['REQUEST_URI'] == "/harrs/admin/tables.php") {?>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <?php } else {?>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <?php } ?>
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Table 1</h6>
                <?php if ($_SERVER['REQUEST_URI'] == "/harrs/admin/tables.php") {?>
                <a class="collapse-item active" href="tables.php">Table 1</a>
                <?php } else {?>
                <a class="collapse-item" href="tables.php">Table 1</a>
                <?php } ?>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Table 2</h6>
                <a class="collapse-item" href="tables.php">Table 2</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->