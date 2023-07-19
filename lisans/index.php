<?php require_once 'inc/header.php';


$products = $db->prepare("SELECT * FROM urunler");
$products->execute();

$licenses = $db->prepare("SELECT * FROM lisanslar");
$licenses->execute();


?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php require_once 'inc/menu.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php require_once 'inc/nav.php'; ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Lisans Paneli</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Ürünler</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $products->rowCount(); ?> Adet</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-gift fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Lisanslar</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $licenses->rowCount(); ?> Adet</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->



                <div class="row">

                    <!-- Area Chart -->
                    <div class="col-xl-6 col-lg-6">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">SON 10 ÜRÜN</h6>


                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <?php
                                $lastproducts = $db->prepare("SELECT * FROM urunler ORDER BY urun_id DESC LIMIT :lim");
                                $lastproducts->bindvalue(':lim', (int)10, PDO::PARAM_INT);
                                $lastproducts->execute();
                                if ($lastproducts->rowCount()) {

                                ?>


                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>ÜRÜN ADI</th>
                                                <th>TARİH</th>
                                                <th>DURUM</th>


                                            </thead>
                                            <tbody>
                                                <?php foreach ($lastproducts as $lastp) { ?>
                                                    <tr>
                                                        <td>#<?php echo $lastp['urun_id']; ?></td>
                                                        <td><?php echo $lastp['urun_adi']; ?></td>
                                                        <td><?php echo date('d.m.Y H:i', strtotime($lastp['urun_eklenme'])); ?></td>
                                                        <td><?php echo $lastp['urun_durum'] == 1 ? '<span class="badge badge-success">Aktif</span>'  : '<span class="badge badge-danger">Pasif</span>';?></td>
                                                        
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                <?php } else {
                                    alert('danger', 'Kayıt Bulunmuyor');
                                }
                                ?>
                            </div>
                        </div>
                    </div>





                    <!-- Area Chart -->
                    <div class="col-xl-6 col-lg-6">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">SON 10 LİSANS</h6>


                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <?php
                                $lastlicenses = $db->prepare("SELECT * FROM lisanslar ORDER BY lisans_id DESC LIMIT :lim");
                                $lastlicenses->bindvalue(':lim', (int)10, PDO::PARAM_INT);
                                $lastlicenses->execute();
                                if ($lastlicenses->rowCount()) {

                                ?>

                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>ALAN ADI</th>
                                                <th>E.TARİH</th>
                                                <th>B.TARİH</th>
                                                <th>DURUM</th>


                                            </thead>
                                            <tbody>
                                                <?php foreach ($lastlicenses as $lasts) { ?>
                                                    <tr>
                                                        <td>#<?php echo $lasts['lisans_id']; ?></td>
                                                        <td><?php echo $lasts['lisans_domain']; ?></td>
                                                        <td><?php echo date('d.m.Y H:i', strtotime($lasts['lisans_eklenme'])); ?></td>
                                                        <td><?php echo date('d.m.Y H:i:s', strtotime($lasts['lisans_bitis'])); ?></td>
                                                        <td><?php echo $lasts['lisans_durum'] == 1 ? '<span class="badge badge-success">Aktif</span>'  : '<span class="badge badge-danger">Pasif</span>';?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>

                                    <?php } else {
                                    alert('danger', 'Kayıt Bulunmuyor');
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">


                    <!-- Area Chart -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">LİSANS BİTİMİNE 15 GÜN KALAN DOMAİN</h6>


                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                            <?php
                                $last15day = $db->prepare("SELECT * FROM lisanslar WHERE lisans_bitis <= NOW() + INTERVAL 15 day ");
                                $last15day->execute();
                                if ($last15day->rowCount()) {

                                ?>

<div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>ALAN ADI</th>
                                                <th>E.TARİH</th>
                                                <th>B.TARİH</th>
                                                <th>KALAN GÜN</th>


                                            </thead>
                                            <tbody>
                                                <?php foreach ($last15day as $last15) { 
                                                    
                                                    $edate = new DateTime($last15['lisans_eklenme']);
                                                    $bdate = new DateTime($last15['lisans_bitis']);
                                                    $interval = $edate->diff($bdate);

                                                    ?>
                                                    <tr style="background:#b10021; color:#fff">
                                                        <td>#<?php echo $last15['lisans_id']; ?></td>
                                                        <td><?php echo $last15['lisans_domain']; ?></td>
                                                        <td><?php echo date('d.m.Y H:i', strtotime($last15['lisans_eklenme'])); ?></td>
                                                        <td><?php echo date('d.m.Y H:i:s', strtotime($last15['lisans_bitis'])); ?></td>
                                                        <td><?php echo  $interval->format('%a Gün kaldı.'); ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                    <?php } else {
                                    alert('danger', 'Kayıt Bulunmuyor');
                                }
                                ?>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->




        <?php require_once 'inc/footer.php'; ?>