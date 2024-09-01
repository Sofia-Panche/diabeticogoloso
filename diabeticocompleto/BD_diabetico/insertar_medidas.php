<?php
    $host ='sql201.infinityfree.com';
    $BD ='if0_37072466_diabetico_goloso';
    $usuario ='si0_37072466';
    $clave ='';
    

    try{
        $conexion= new PDO("mysql:host=$host; dbname=diabetico_goloso",$usuario, $clave);
        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $conexion->beginTransaction();

        $conexion->exec("INSERT INTO medidas(Codigo,Porciones, Ingredientes, Cantidades)
        VALUES ('1','5','Harina\n Huevos A\n Aceite\n Polvo de hornear\n Agua o jugo','250gr\n75gr\n75gr\n4gr\n62.5gr')");
        $conexion->exec("INSERT INTO medidas(Codigo,Porciones, Ingredientes, Cantidades)
        VALUES ('2','10','Harina\nHuevos A\nAceite\nPolvo de hornear\nAgua o jugo','500gr\n150gr\n150gr\n4gr\n125gr')");
        $conexion->exec("INSERT INTO medidas(Codigo,Porciones, Ingredientes, Cantidades)
        VALUES ('3','15','Harina\nHuevos A\nAceite\nPolvo de hornear\nAgua o jugo','750gr\n225gr\n225gr\n4gr\n187.5gr')");
        $conexion->exec("INSERT INTO medidas(Codigo,Porciones, Ingredientes, Cantidades)
        VALUES ('4','20','Harina\nHuevos A\nAceite\nPolvo de hornear\nAgua o jugo','1000gr\n300gr\n300gr\n4gr\n250gr')");

        $conexion->commit();
        echo "Resgistros insertados";
    }catch(PDOException $e){
        $conexion->rollback();
        echo "Error:" . $e->getMessages();
    }
    $conexion =null;
?>