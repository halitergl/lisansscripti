<?php require_once 'inc/header.php';

if (isset($_GET['process'])) {
    if ($_GET['process'] == 'productlist') {
        $title = "Ürün Listesi";
    } else if (get('process') == "licenselist") {
        $title = "Lisans listesi";
    } else if (get('process') == "newproduct") {
        $title = "Yeni Ürün Ekleme";
    } else if (get('process') == "newlicense") {
        $title = "Yeni Lisans";
    } else if (get('process') == "productedit") {
        $title = "Ürün Düzenleme";
    } else if (get('process') == "profile") {
        $title = "Profil Düzenleme";
    } else {
        $title = "Lisans Paneli";
    }
}

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
                <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
                    </div>
                    <div class="card-body">
                        <?php

                        $process = get('process');

                        if (!$process) {
                            go(site);
                        }
                        switch ($process) {

                            case 'profile':
?>


<form action="" method="POST" id="aform" onsubmit="return false;">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Admin Kullanıcı Adı</label>
                                        <input type="text" class="form-control" value="<?php echo $_SESSION['kadi'];?>" name="pkadi" placeholder="Kullanıcı Adı">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Admin Posta</label>
                                        <input type="text" class="form-control" value="<?php echo $_SESSION['email'];?>" name="pmail" placeholder="E-Posta">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Admin Şifre</label>
                                        <input type="password" class="form-control" name="ppas" placeholder="Şifreniz">
                                        <span style="color:#b10021; font-weight:bold">Değiştirmek istemiyorsanız boş bırakın</span>

                                    </div>

                                    <button type="submit" onclick="abutton();" id="abuton" class="btn btn-primary"><i class="fa fa-plus"></i> Profil Güncelle </button>
                                    <a href="<?php echo site; ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Ana sayfa </a>
                                </form>


<?php



                                break;

                                case 'logout':
                                    session_destroy();
                                    go(site);

                                    break;



                            case 'licenseedit':
                                $lkey = get('key');
                                if (!$lkey) {
                                    go(site);
                                }
                                $query = $db->prepare("SELECT * FROM lisanslar WHERE lisans_key=:k");
                                $query->execute([':k' => $lkey]);
                                if ($query->rowCount()) {
                                    $row = $query->fetch(PDO::FETCH_OBJ);
                                }
                        ?>
                                <form action="" method="POST" id="lupform" onsubmit="return false;">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Lisans Adı</label>
                                        <select name="pname" class="form-control">
                                            <?php
                                            $plist = $db->prepare("SELECT * FROM urunler WHERE urun_durum=:d");
                                            $plist->execute([':d' => 1]);
                                            if ($plist->rowCount()) {
                                                foreach ($plist as $pli) {
                                                    ?>
                                                   <option value="<?php echo $pli['urun_key'];?>" <?php echo $pli['urun_key'] == $row ->lisans_urun ? 'selected' : null;?>><?php echo $pli['urun_adi'];?></option>
                                                   <?php
                                                }
                                            }



                                            ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="pkey">Lisans Domain</label>
                                        <input type="text" class="form-control" value="<?php echo $row ->lisans_domain ?>" name="ldomain" placeholder="Lisans Domain">

                                    </div>

                                    <div class="form-group">
                                        <label for="pkey">Lisans Key</label>
                                        <input type="text" class="form-control" value="<?php echo $row ->lisans_key ?>"  name="lcode" id="pkey" placeholder="Lisans Anahtarı">
                                        <small class="form-text text-muted"><a onclick="randomString('32','pkey'); return false;" href="#"> Anahtarı Üret</a></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="pkey">Lisans Bitiş Tarihi</label>
                                        <input type="datetime-local" value="<?php echo $row ->lisans_bitis; ?>"  name="ltime" class="form-control">
                                    </div>

                                     <div class="form-group">
                                            <label for="exampleInputEmail1">Lisans Durum</label>
                                            <select name="lstatus" class="form-control">
                                                <option value="1" <?php echo $row->lisans_durum == 1 ? 'selected' : null; ?>>Aktif</option>
                                                <option value="2" <?php echo $row->lisans_durum == 2 ? 'selected' : null; ?>>Pasif</option>

                                            </select>

                                        </div>
<input type="hidden" value="<?php echo $row->lisans_id;?>" name="lid"/>
                                    <button type="submit" id="lupbuton" onclick="lupbutton();" class="btn btn-primary"><i class="fa fa-plus"></i> Lisans Güncelle </button>
                                    <a href="<?php echo site."/process.php?process=licenselist"; ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Geri Dön </a>
                                </form>


                                <?php
                                break;

                            case 'productedit':
                                $pkey = get('key');
                                if (!$pkey) {
                                    go(site);
                                }
                                $query = $db->prepare("SELECT * FROM urunler WHERE urun_key=:k");
                                $query->execute([':k' => $pkey]);
                                if ($query->rowCount()) {
                                    $row = $query->fetch(PDO::FETCH_OBJ);
                                ?>
                                    <form action="" method="POST" id="pupform" onsubmit="return false;">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ürün Adı</label>
                                            <input type="text" class="form-control" value="<?php echo $row->urun_adi; ?>" name="pname" placeholder="Ürün Adı">

                                        </div>
                                        <div class="form-group">
                                            <label for="pkey">Ürün Key</label>
                                            <input type="text" class="form-control" value="<?php echo $row->urun_key; ?>" name="pcode" id="pkey" placeholder="Ürün Anahtarı">
                                            <small class="form-text text-muted"><a onclick="randomString('12','pkey'); return false;" href="#">Anahtar Üret</a></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ürün Durum</label>
                                            <select name="pstatus" class="form-control">
                                                <option value="1" <?php echo $row->urun_durum == 1 ? 'selected' : null; ?>>Aktif</option>
                                                <option value="2" <?php echo $row->urun_durum == 2 ? 'selected' : null; ?>>Pasif</option>

                                            </select>

                                        </div>
                                        <input type="hidden" value="<?php echo $row->urun_id; ?>" name="pid" />
                                        <button type="submit" onclick="pupbutton();" id="pupbuton" class="btn btn-primary"><i class="fa fa-plus"></i> Ürün Güncelle </button>
                                        <a href="<?php echo site . "/process.php?process=productlist"; ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i>Geri Gön </a>
                                    </form>




                                <?php
                                } else {
                                    go(site);
                                }


                                break;

                            case 'deletelicense':

                                $pkey = get('key');
                                if (!$pkey) {
                                    go(site);
                                }
                                $query = $db->prepare("SELECT lisans_key FROM lisanslar WHERE lisans_key=:k");
                                $query->execute([':k' => $pkey]);
                                if ($query->rowCount()) {
                                    $up = $db->prepare("UPDATE lisanslar SET lisans_durum=:d WHERE lisans_key=:k");
                                    $up->execute([':d' => 2, ':k' => $pkey]);
                                    if ($up) {
                                        alert("success", "Lisans pasif duruma alınmıştır..");
                                        go(site . '/process.php?process=licenselist', 2);
                                    } else {
                                        alert('danger', 'Hata Oluştu');
                                    }
                                }


                                break;

                            case 'deleteproduct':

                                $pkey = get('key');
                                if (!$pkey) {
                                    go(site);
                                }
                                $query = $db->prepare("SELECT urun_key FROM urunler WHERE urun_key=:k");
                                $query->execute([':k' => $pkey]);
                                if ($query->rowCount()) {
                                    $up = $db->prepare("UPDATE urunler SET urun_durum=:d WHERE urun_key=:k");
                                    $up->execute([':d' => 2, ':k' => $pkey]);
                                    if ($up) {
                                        $upp = $db->prepare("UPDATE lisanslar SET lisans_durum=:d WHERE lisans_urun=:u");
                                        $upp->execute([':d' => 2, ':u' => $pkey]);
                                        alert("success", "Ürün ve ürüne ait olan lisanslar pasif duruma alınmıştır..");
                                        go(site . '/process.php?process=productlist', 2);
                                    } else {
                                        alert('danger', 'Hata Oluştu');
                                    }
                                }


                                break;

                            case 'newlicense':

                                ?>
                                <form action="" method="POST" id="lform" onsubmit="return false;">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Lisans Adı</label>
                                        <select name="pname" class="form-control">
                                            <?php
                                            $plist = $db->prepare("SELECT * FROM urunler WHERE urun_durum=:d");
                                            $plist->execute([':d' => 1]);
                                            if ($plist->rowCount()) {
                                                foreach ($plist as $pli) {
                                                    echo '<option value="' . $pli['urun_key'] . '">' . $pli['urun_adi'] . '</option>';
                                                }
                                            }



                                            ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="pkey">Lisans Domain</label>
                                        <input type="text" class="form-control" name="ldomain" placeholder="Lisans Domain">

                                    </div>

                                    <div class="form-group">
                                        <label for="pkey">Lisans Key</label>
                                        <input type="text" class="form-control" name="lcode" id="pkey" placeholder="Lisans Anahtarı">
                                        <small class="form-text text-muted"><a onclick="randomString('32','pkey'); return false;" href="#"> Anahtarı Üret</a></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="pkey">Lisans Bitiş Tarihi</label>
                                        <input type="datetime-local" name="ltime" class="form-control">

                                    </div>

                                    <button type="submit" id="lbuton" onclick="lbutton();" class="btn btn-primary"><i class="fa fa-plus"></i> Lisans Ekle </button>
                                    <a href="<?php echo site; ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i>Ana sayfa </a>
                                </form>



                            <?php


                                break;



                            case 'newproduct':
                            ?>
                                <form action="" method="POST" id="pform" onsubmit="return false;">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ürün Adı</label>
                                        <input type="text" class="form-control" name="pname" placeholder="Ürün Adı">

                                    </div>
                                    <div class="form-group">
                                        <label for="pkey">Ürün Key</label>
                                        <input type="text" class="form-control" name="pcode" id="pkey" placeholder="Ürün Anahtarı">
                                        <small class="form-text text-muted"><a onclick="randomString('12','pkey'); return false;" href="#">Anahtar Üret</a></small>
                                    </div>

                                    <button type="submit" onclick="pbutton();" class="btn btn-primary"><i class="fa fa-plus"></i> Ürün Ekle </button>
                                    <a href="<?php echo site; ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i>Ana sayfa </a>
                                </form>



                                <?php

                                break;

                            case 'productlist':

                                $s = @intval(get('s'));
                                if (!$s) {
                                    $s = 1;
                                }

                                $query = $db->prepare("SELECT * FROM urunler ORDER BY urun_id DESC");
                                $query->execute();

                                $total = $query->rowCount(); //toplam ürün sayım
                                $lim = 20;
                                $show = $s * $lim - $lim;

                                $query = $db->prepare("SELECT * FROM urunler ORDER BY urun_id DESC LIMIT :show , :lim");
                                $query->bindValue(':show', (int) $show, PDO::PARAM_INT);
                                $query->bindValue(':lim', (int) $lim, PDO::PARAM_INT);
                                $query->execute();

                                if ($s > ceil($total / $lim)) {
                                    $s = 1;
                                }

                                if ($query->rowCount()) {
                                ?>
                                    <form action="<?php echo site."/productsearch.php";?>" method="GET">
                                        <input class="form-control" type="text" name="q" placeholder="Ürün adı giriniz ve entera basınız"></input>

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
                                                        <td><a href="<?php echo site . "/process.php?process=productedit&key=" . $row['urun_key']; ?>"><i class="fa fa-edit"></i></a> | <a onclick="return confirm('Onaylıyor musunuz ?');" href="<?php echo site . "/process.php?process=deleteproduct&key=" . $row['urun_key']; ?>"><i class="fa fa-eraser"></i></a></td>

                                                    </tr>


                                                <?php } ?>

                                            </tbody>
                                        </table>


                                    </div>
                                    <div class="pagination">
                                        <ul>
                                            <?php
                                            if ($total > $lim) {
                                                pagination($s, ceil($total / $lim), 'process.php?process=productlist&s=');
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                <?php

                                } else {
                                    alert('danger', 'Kayıt Bulunamadı');
                                }

                                break;


                            case 'licenselist':

                                $s = @intval(get('s'));
                                if (!$s) {
                                    $s = 1;
                                }

                                $query = $db->prepare("SELECT * FROM lisanslar ORDER BY lisans_id DESC");
                                $query->execute();

                                $total = $query->rowCount(); //toplam ürün sayım
                                $lim = 20;
                                $show = $s * $lim - $lim;

                                $query = $db->prepare("SELECT * FROM lisanslar ORDER BY lisans_id DESC LIMIT :show , :lim");
                                $query->bindValue(':show', (int) $show, PDO::PARAM_INT);
                                $query->bindValue(':lim', (int) $lim, PDO::PARAM_INT);
                                $query->execute();

                                if ($s > ceil($total / $lim)) {
                                    $s = 1;
                                }

                                if ($query->rowCount()) {
                                ?>
                                    <form action="<?php echo site."/licensesearch.php";?>" method="GET">
                                        <input class="form-control" type="text" name="q" placeholder="Alan adı giriniz ve entera basınız"></input>

                                    </form><br>
                                    <div class="table-responsive">
                                        <table class="table tale-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>ALAN ADI</th>
                                                <th>LİSANS KEY</th>
                                                <th>E.TARİH</th>
                                                <th>B.TARİH</th>
                                                <th>KALAN GÜN</th>
                                                <th>DURUM</th>
                                                <th>İŞLEMLER</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($query as $row) {

                                                    $edate = new DateTime($row['lisans_eklenme']);
                                                    $bdate = new DateTime($row['lisans_bitis']);
                                                    $interval = $edate->diff($bdate);
                                                ?>

                                                    <tr>
                                                        <td><?php echo $row['lisans_id']; ?></td>
                                                        <td><?php echo $row['lisans_domain']; ?></td>
                                                        <td><?php echo $row['lisans_key']; ?></td>
                                                        <td><?php echo date('d.m.y H:i', strtotime($row['lisans_eklenme'])); ?></td>
                                                        <td><?php echo date('d.m.y H:i', strtotime($row['lisans_bitis'])); ?></td>

                                                        <td><?php echo  $interval->format('%a Gün kaldı.'); ?></td>

                                                        <td><?php echo $row['lisans_durum'] == 1 ? '<span class="badge badge-success">Aktif</span>'  : '<span class="badge badge-danger">Pasif</span>'; ?></td>

                                                        <td><a href="<?php echo site . "/process.php?process=licenseedit&key=" . $row['lisans_key']; ?>"><i class="fa fa-edit"></i></a> | <a href="<?php echo site . "/process.php?process=deletelicense&key=" . $row['lisans_key']; ?>"><i class="fa fa-eraser"></i></a></td>

                                                    </tr>


                                                <?php } ?>

                                            </tbody>
                                        </table>


                                    </div>
                                    <div class="pagination">
                                        <ul>
                                            <?php
                                            if ($total > $lim) {
                                                pagination($s, ceil($total / $lim), 'process.php?process=licenselist&s=');
                                            }
                                            ?>
                                        </ul>
                                    </div>
                        <?php

                                } else {
                                    alert('danger', 'Kayıt Bulunamadı');
                                }

                                break;
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


            function abutton() {
                var data = $("#aform").serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site; ?>/inc/admineditdata.php",
                    data: data,
                    success: function(result) {
                        if ($.trim(result) == "empty") {
                            swal("Hata", "Boş alan bırakmayınız", "error");
                        } else if ($.trim(result) == "format") {
                            swal("Hata", "E-Posta formatı hatalı", "error");
                        } else if ($.trim(result) == "error") {
                            swal("Hata", "Hata oluştu", "error");
                        } else if ($.trim(result) == "ok") {
                            swal("Bşarılı", "Profiliniz başarıyla güncellendi", "success");
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