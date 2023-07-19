<?php 

require_once 'system/function.php';

if(IP() == "::1"){


$today = date('Y-m-d H:i');
$query = $db -> prepare("SELECT * FROM lisanslar WHERE lisans_durum=:d");
$query->execute([':d' => 1]);
if($query -> rowCount()){
    foreach($query as $row){

        $lisanslast = date ('Y-m-d H:i' , strtotime($row['lisans_bitis']));

        if($today == $lisanslast){

            $up = $db -> prepare("UPDATE lisanslar SET lisans_durum=:d WHERE lisans_id=:id");
            $up -> execute([':d' =>2, ':id' =>$row['lisans_id']]);
        }
    }
}

    
}













?>