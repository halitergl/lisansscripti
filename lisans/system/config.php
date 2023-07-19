<?php 

@session_start();
@ob_start();


try{
    $db = new PDO("mysql:host=localhost;dbname=lisans;charset=utf8;","root","");

}catch(PDOException $e){
    print_r($e->getMessage());
}
$site = "http://localhost/lisans";
define('site',$site);






?>