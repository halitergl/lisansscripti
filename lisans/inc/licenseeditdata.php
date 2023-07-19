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
    $ldate = date('Y-m-d H:i',strtotime($ltime));
    $lstatus = post('lstatus');  
    $lid = post('lid');  

  $squery=$db ->prepare("SELECT lisans_id FROM lisanslar WHERE lisans_id=:id");
  $squery->execute([':id' => $lid]);
  if($squery->rowcount()){


    if(!$pname || !$ldomain || !$lcode || !$ltime || !$lstatus || !$lid){
        echo "empty";
    }else{
        $already = $db -> prepare("SELECT lisans_id,lisans_key FROM lisanslar WHERE lisans_key=:k AND lisans_id !=:id");
        $already -> execute([':k' => $lcode, ':id' => $lid]);
        if($already->rowCount()){
            echo 'already';
        }else{
           $up = $db->prepare("UPDATE lisanslar SET
           lisans_key =:k,
           lisans_domain=:d,
           lisans_urun=:u,
           lisans_bitis=:b,
           lisans_durum=:dd WHERE  lisans_id =:id
           ");
           $up ->execute([':k' => $lcode,':d' =>$ldomain,':u' => $pname , ':b' => $ldate, ':dd' => $lstatus,':id' =>$lid]);
           if($up){
            echo 'ok';
           }else{
            echo 'error';
           }
        }
    }

  }else{
    echo 'error';
  }
}










?>