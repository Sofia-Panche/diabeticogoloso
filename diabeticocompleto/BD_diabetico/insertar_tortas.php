<?php
     $host ='127.0.0.1';
     $BD ='diabetico_goloso';
     $usuario ='root';
     $clave ='';
    

    try{
        $conexion= new PDO("mysql:host=$host; dbname=diabetico_goloso",$usuario, $clave);
        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $conexion->beginTransaction();

        $conexion->exec("INSERT INTO tortas(Codigo,Porciones, Sabores_tortas, Sabores_relleno, Sabores_crema, Precios)
        VALUES ('1','5','Maracuyá con amapola\nNaranja con amapola\nChocolate\nFrutos rojos\nZanahoria con arándanos','Arequipe\nArequipe y maní\nJalea frutos rojos\nJalea frutos amarillos','Café\nMaracuyá\nVainilla\nFrutos rojos\nChocolate','48.000')");
        $conexion->exec("INSERT INTO tortas(Codigo,Porciones, Sabores_tortas, Sabores_relleno, Sabores_crema, Precios)
        VALUES ('2','10','Maracuyá con amapola\nNaranja con amapola\nChocolate\nFrutos rojos\nZanahoria con arándanos','Arequipe\nArequipe y maní\n Jalea frutos rojos\nJalea frutos amarillos','Café\nMaracuyá\nVainilla\nFrutos rojos\nChocolate','78.000')");
        $conexion->exec("INSERT INTO tortas(Codigo,Porciones, Sabores_tortas, Sabores_relleno, Sabores_crema, Precios)
        VALUES ('3','15','Maracuyá con amapola\nNaranja con amapola\nChocolate\nFrutos rojos\nZanahoria con arándanos','Arequipe\nArequipe y maní\n Jalea frutos rojos\nJalea frutos amarillos','Café\nMaracuyá\nVainilla\nFrutos rojos\nChocolate','110.000')");
        $conexion->exec("INSERT INTO tortas(Codigo,Porciones, Sabores_tortas, Sabores_relleno, Sabores_crema, Precios)
        VALUES ('4','20','Maracuyá con amapola\nNaranja con amapola\nChocolate\nFrutos rojos\nZanahoria con arándanos','Arequipe\nArequipe y maní\n Jalea frutos rojos\nJalea frutos amarillos','Café\nMaracuyá\nVainilla\nFrutos rojos\nChocolate','145.000')");

        $conexion->commit();
        echo "Resgistros insertados";
    }catch(PDOException $e){
        $conexion->rollback();
        echo "Error:" .$e->getMessages();
    }
    $conexion=null;
?>

 