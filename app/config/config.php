<?php 

    try {
        $conn = new PDO('mysql:host=localhost;dbname=simabsensi','root','',array(PDO::ATTR_PERSISTENT => true));

    } catch (PDOException $e){
        echo $e->getMessage();
    }

    require_once 'Controller_Auth.php';


    $user = new Auth($conn);

?>