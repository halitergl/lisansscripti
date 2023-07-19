<?php require_once 'system/function.php';
if(isset($_SESSION['admin']) == @sha1(md5(IP().$_SESSION['id']))){
    go(site."/index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yönetici</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo site;?>/js/sweetalert/sweetalert.css" rel="stylesheet"/>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Yönetici Girişi</h1>
                                    </div>
                                    <form class="user" id="loginform" onsubmit="return false;">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Yönetici Mail">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="pass" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Yönetici Şifre">
                                        </div>
                                       <button type="submit" onclick="loginbutton();" class="btn btn-primary btn-user btn-block">
                                        Giriş Yap
                                        </button>
                                    </form>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo site;?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo site;?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo site;?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo site;?>/js/sb-admin-2.min.js"></script>
    <script src="<?php echo site;?>/js/sweetalert/sweetalert.min.js"></script>

    <script>

function loginbutton(){
    var data = $("#loginform").serialize();
    $.ajax({
        type : "POST",
        url: "<?php echo site;?>/inc/login.php",
        data:data,
        success : function(result){
            if($.trim(result) == "empty"){
                swal("Hata","Boş alan bırakmayınız","error");
            }else if($.trim(result) == "error"){
                swal("Hata","Hata oluştu","error");
            }else if($.trim(result) == "ok"){
                swal("Başarılı","Yönetici girişi başarılı","success");
                setTimeout(function(){   
        window.location="<?php echo site;?>";
        //3 saniye sonra yönlenecek
        }, 2000);
            }
        }
    })
}


</script>

</body>

</html>