<?php require_once 'inc/header.php';

$s = @intval(get('s'));
if (!$s) {
    $s = 1;
}

 $q = get('q');
if (!$q) {
    $q = 1;
    go(site."/process.php?process=productlist");
}

$query = $db->prepare("SELECT * FROM urunler WHERE urun_adi LIKE :adi ORDER BY  urun_id DESC");
$query->execute([':adi' => '%' .$q. '%']);


$total = $query->rowCount(); //toplam ürün sayım
$lim = 20;
$show = $s * $lim - $lim;

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

            <?php require_once 'inc/nav.php'; ?>

            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800"><?php echo get('q'). " | Arama Sonuçları (".$total.")"; ?></h1>


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo get('q')." | Arama Sonuçları (".$total.")"; ?></h6>
                    </div>
                    <div class="card-body">
                        <?php

         $query = $db->prepare("SELECT * FROM urunler WHERE urun_adi LIKE :adi ORDER BY urun_id DESC LIMIT :show , :lim");
         $query->bindValue(':show', (int) $show, PDO::PARAM_INT);
         $query->bindValue(':lim', (int) $lim, PDO::PARAM_INT);
         $query->bindValue(':adi' ,'%' .$q. '%', PDO::PARAM_STR);
         $query->execute();

         if ($s > ceil($total / $lim)) {
             $s = 1;
         }

         if ($query->rowCount()) {
         ?>
             <form action="<?php echo site."/productsearch.php";?>" method="GET">
                 <input class="form-control" type="text" name="pname" placeholder="Ürün adı giriniz ve entera basınız"></input>

             </form><br>
             <div class="table-responsive">
                 <table class="table tale-hover">
                     <thead>
                         <th>ID</th>
                         <th>ÜRÜN ADI</th>
                         <th>ÜRÜN KODU</th>
                         <th>TARİH</th>
                         <th>DURUM</th>
                         <th>İŞLEMLER</th>
                     </thead>
                     <tbody>
                         <?php foreach ($query as $row) { ?>



                             <tr>
                                 <td><?php echo $row['urun_id']; ?></td>
                                 <td><?php echo $row['urun_adi']; ?></td>
                                 <td><?php echo $row['urun_key']; ?></td>
                                 <td><?php echo date('d.m.y H:i', strtotime($row['urun_eklenme'])); ?></td>
                                 <td><?php echo $row['urun_durum'] == 1 ? '<span class="badge badge-success">Aktif</span>'  : '<span class="badge badge-danger">Pasif</span>'; ?></td>
                                 <td><a href="<?php echo site . "/process.php?process=productedit&key=" . $row['urun_key']; ?>"><i class="fa fa-edit"></i></a> | <a href="<?php echo site . "/process.php?process=deleteproduct&key=" . $row['urun_key']; ?>"><i class="fa fa-eraser"></i></a></td>

                             </tr>


                         <?php } ?>

                     </tbody>
                 </table>


             </div>
             <div class="pagination">
                 <ul>
                     <?php
                     if ($total > $lim) {
                         pagination($s, ceil($total / $lim), 'productsearch.php?q='.$q.'&s=');
                     }
                     ?>
                 </ul>
             </div>
         <?php

         } else {
             alert('danger', 'Aranan Değere Uygun Kayıt Bulunamadı');
         }

      
                       
                           ?>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->




        <!-- Scroll to Top Button-->
        <?php require_once 'inc/footer.php'; ?>

        <script>
            function randomString(sl, dv) {
                var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
                var string_length = sl;
                var randomstring = '';
                for (var i = 0; i < string_length; i++) {
                    var rnum = Math.floor(Math.random() * chars.length);
                    randomstring += chars.substring(rnum, rnum + 1);
                }
                document.getElementById(dv).value = randomstring;
            }



            function pbutton() {
                var data = $("#pform").serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site; ?>/inc/newproductdata.php",
                    data: data,
                    success: function(result) {
                        if ($.trim(result) == "empty") {
                            swal("Hata", "Boş alan bırakmayınız", "error");
                        } else if ($.trim(result) == "already") {
                            swal("Hata", "Ürün kodu zaten kayıtlı", "error");
                        } else if ($.trim(result) == "error") {
                            swal("Hata", "Hata oluştu", "error");
                        } else if ($.trim(result) == "ok") {
                            swal("Bşarılı", "Ürün başarıyla eklendi", "success");
                            setTimeout(function() {
                                window.location = "<?php echo site; ?>/process.php?process=productlist";
                                //3 saniye sonra yönlenecek
                            }, 2000);
                        }
                    }
                })
            }




            function lbutton() {
                var data = $("#lform").serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site; ?>/inc/newlicensedata.php",
                    data: data,
                    success: function(result) {
                        if ($.trim(result) == "empty") {
                            swal("Hata", "Boş alan bırakmayınız", "error");
                        } else if ($.trim(result) == "already") {
                            swal("Hata", "Lisans kodu zaten kayıtlı", "error");
                        } else if ($.trim(result) == "error") {
                            swal("Hata", "Hata oluştu", "error");
                        } else if ($.trim(result) == "ok") {
                            swal("Bşarılı", "Lisans başarıyla eklendi", "success");
                            setTimeout(function() {
                                window.location = "<?php echo site; ?>/process.php?process=licenselist";
                                //3 saniye sonra yönlenecek
                            }, 2000);
                        }
                    }
                })
            }

            function pupbutton() {
                var data = $("#pupform").serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site; ?>/inc/producteditdata.php",
                    data: data,
                    success: function(result) {
                        if ($.trim(result) == "empty") {
                            swal("Hata", "Boş alan bırakmayınız", "error");
                        } else if ($.trim(result) == "already") {
                            swal("Hata", "Ürün kodu zaten kayıtlı", "error");
                        } else if ($.trim(result) == "error") {
                            swal("Hata", "Hata oluştu", "error");
                        } else if ($.trim(result) == "ok") {
                            swal("Bşarılı", "Ürün başarıyla güncellendi", "success");
                            setTimeout(function() {
                                window.location.reload();
                                //3 saniye sonra yönlenecek
                            }, 2000);
                        }
                    }
                })
            }

             function lupbutton() {
                var data = $("#lupform").serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site; ?>/inc/licenseeditdata.php",
                    data: data,
                    success: function(result) {
                        if ($.trim(result) == "empty") {
                            swal("Hata", "Boş alan bırakmayınız", "error");
                        } else if ($.trim(result) == "already") {
                            swal("Hata", "Lisans kodu zaten kayıtlı", "error");
                        } else if ($.trim(result) == "error") {
                            swal("Hata", "Hata oluştu", "error");
                        } else if ($.trim(result) == "ok") {
                            swal("Bşarılı", "Lisans başarıyla güncellendi", "success");
                            setTimeout(function() {
                                window.location = "<?php echo site; ?>/process.php?process=licenselist";
                                //3 saniye sonra yönlenecek
                            }, 2000);
                        }
                    }
                })
            }
        </script>