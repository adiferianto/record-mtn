<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/dashboard') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fab fa-markdown"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Maintenance</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <?php if (session()->get('level') == '1') : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Manage Users
        </div>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/users'); ?>">
                <i class="fas fa-users"></i>
                <span>Users</span></a>
        </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manage Data
    </div>

    <!-- Nav Item - Pages Collapse Menu Air -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-tint"></i>
            <span>Air</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Components:</h6>
                <a class="collapse-item" href="<?= base_url('/airSumur'); ?>">Air Sumur</a>
                <a class="collapse-item" href="<?= base_url('/airProses'); ?>">Air Proses</a>
                <a class="collapse-item" href="<?= base_url('/airProduksi'); ?>">Air Produksi</a>
                <a class="collapse-item" href="<?= base_url('/airBoiler'); ?>">Air Boiler </a>
                <a class="collapse-item" href="<?= base_url('/wwtp'); ?>">WTP/WWTP Proses</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/gas'); ?>">
            <i class="fas fa-wind"></i>
            <span>Sludge Dryer / Boiler</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/steam'); ?>">
            <i class="fab fa-steam"></i>
            <span>Steam</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/kwh'); ?>">
            <i class="fas fa-charging-station"></i>
            <span>KWH / Listrik</span></a>
    </li>

</ul>