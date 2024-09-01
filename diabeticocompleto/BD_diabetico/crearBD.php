<?php
    $host ='sql201.infinityfree.com';
    $usuario ='si0_37072466';
    $clave ='';
    

    try{
        $con= new PDO("mysql:host=$host;",$usuario, $clave);
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="CREATE DATABASE diabetico_goloso";
        $con->exec($sql);
        echo"BASE DE DATOS CREADA";
    }catch(PDOException $e){
        echo $sql."<br>". $e->getMessage();
    }
    $con=null;
?>