<?php 
require_once '../system/function.php';

if(isset($_SESSION['admin']) != @sha1(md5(IP().$_SESSION['id']))){
    session_destroy();
    go(site."/login.php");
   
}


if($_POST){
    $akadi = post('pkadi');
    $amail = post('pmail');
    $apass = post('ppass');
    $crypt = sha1(md5($apass));

if(!$akadi ||!$amail){
    echo 'empty';
}else{
    if(!filter_var($amail,FILTER_VALIDATE_EMAIL)){
        echo 'format';
    }else{
        if(@$_POST['ppass']==""){
            $up = $db-> prepare("UPDATE admin SET 
            
            admin_kadi = :k,
            admin_posta=:p WHERE admin_id=:id
            ");
            $up -> execute([':k' => $akadi,':p' => $amail , ':id' => $_SESSION['id']]); 

        }else{
            $up = $db-> prepare("UPDATE admin SET 
            
            admin_kadi = :k,
            admin_posta=:p,
            admin_sifre=:s
             WHERE admin_id=:id
            ");
            $up -> execute([':k' => $akadi,':s' => $crypt,':p' => $amail , ':id' => $_SESSION['id']]); 

        }
        if($up){
            $_SESSION['email'] = $amail;
            $_SESSION['kadi'] = $akadi;
            echo 'ok';
        }else{
            echo 'error';
        }
    }
}
}




?>