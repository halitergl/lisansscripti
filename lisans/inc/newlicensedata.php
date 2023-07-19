<?php 
require_once '../system/function.php';

if(isset($_SESSION['admin']) != @sha1(md5(IP().$_SESSION['id']))){
    session_destroy();
    go(site."/login.php");
   
}

if ($_POST){
    $pname = post('pname');
    $ldomain = post ('ldomain');
    $lcode = post ('lcode');
    $ltime = post ('ltime');
    $ldate = date('Y-m-d H:İ',strtotime($ltime));

    if(!$pname || !$ldomain || !$lcode || !$ltime){
        echo "empty";
    }else{
        $already = $db -> prepare("SELECT lisans_key FROM lisanslar WHERE lisans_key=:k");
        $already -> execute([':k' => $lcode]);
        if($already->rowCount()){
            echo 'already';
        }else{
            $add = $db -> prepare("INSERT INTO lisanslar SET
            lisans_key =:k,
            lisans_domain=:d,                      
            lisans_urun=:u,                      
            lisans_bitis=:b                      
            ");
            $add -> execute([':k' => $lcode, ':d' => $ldomain , ':u' => $pname , ':b' => $ldate]);
            if($add -> rowCount()){
                echo 'ok';
            }else{
                echo 'error';
            }
        }
    }
}










?>