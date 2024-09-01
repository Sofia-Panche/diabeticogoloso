<?php
     $host ='127.0.0.1';
     $BD ='diabetico_goloso';
     $usuario ='root';
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