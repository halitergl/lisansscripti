<?php require_once './system/function.php';
if(isset($_SESSION['admin']) != @sha1(md5(IP().$_SESSION['id']))){
    session_destroy();
    go(site."/login.php");
   
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

    <title>Lisans Paneli | Ergül Yazılım</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo site;?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo site;?>/js/sweetalert/sweetalert.css" rel="stylesheet"/>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">