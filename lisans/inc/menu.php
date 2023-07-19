<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site; ?>">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Ergül Yazılım <sup>26.05</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?php echo site;?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Ana sayfa</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">



<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Ürünler</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Ürünler</h6>
            <a class="collapse-item" href="<?php echo site."/process.php?process=productlist";?>">Ürün Listesi</a>
            <a class="collapse-item" href="<?php echo site."/process.php?process=newproduct";?>">Yeni Ürün Ekle</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo2"
        aria-expanded="true" aria-controls="collapseTwo2">
        <i class="fas fa-fw fa-cog"></i>
        <span>Lisanslar</span>
    </a>
    <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Lisans</h6>
            <a class="collapse-item" href="<?php echo site."/process.php?process=licenselist";?>">Lisans Listesi</a>
            <a class="collapse-item" href="<?php echo site."/process.php?process=newlicense";?>">Yeni Lisans Ekle</a>
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