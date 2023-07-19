<?php 

require_once '../system/function.php';
if($_POST){

    $email = post('email');
    $pass = post('pass');
    $crypt = sha1(md5($pass));

    if(!$email || !$pass){
        echo 'empty';
    }else{

        $query = $db -> prepare("SELECT * FROM admin WHERE admin_posta=:p AND admin_sifre=:s");

        $query ->execute([':p' =>$email, ':s' => $crypt]);
        if($query -> rowCount()){
            $arow = $query ->fetch(PDO::FETCH_OBJ);
            $generator = sha1(md5(IP().$arow->admin_id));
            $_SESSION['admin'] = $generator;
            $_SESSION['id'] = $arow -> admin_id;
            $_SESSION['kadi'] = $arow -> admin_kadi;
            $_SESSION['email'] = $arow -> admin_posta;
            echo 'ok';
        }else{
            echo 'error';
        }
    }
}










?>