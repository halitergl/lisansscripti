<?php 
require_once 'system/function.php';
if(IP() == "::1");{


$key = get('key');
$product = get('product');
$domain = get('domain');

$arr = [];


if(!$key || !$product || !$domain){

    $arr ['license_key'] = "#ERROR_1";
    $arr ['license_product'] = "#ERROR_2";
    $arr ['license_domin'] = $domain ? $domain : "#ERROR_3";

}else{


    $query = $db->prepare("SELECT * FROM lisanslar WHERE 
    
    lisans_key =:k,
    lisans_domain =:d,
    lisans_urun =:u
    ");

    $query->execute([
        ':k' => $key,
        ':d' => $domain,
        ':u' => $product
    ]);

    if($query -> rowcount()){

        $row = $query -> fetch(PDO::FETCH_OBJ);
        $arr ['license_key'] = $row -> lisans_key;
        $arr ['license_product'] = $row -> lisans_domain;
        $arr ['license_domin'] = $row -> lisans_urun;
    }else{
        $arr ['license_key'] = "#ERROR_4";
        $arr ['license_product'] = "#ERROR_5";
        $arr ['license_domin'] = $domain ? $domain : "#ERROR_6";
    }


echo json_encode($arr);




}

}

















?>