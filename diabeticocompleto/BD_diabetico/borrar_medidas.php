<?php 
     $host ='127.0.0.1';
     $BD ='diabetico_goloso';
     $usuario ='root';
     $clave ='';
    

    $hostPDO="mysql:host=$host;dbname=$BD;";
    $tuPDO=new PDO($hostPDO,$usuario,$clave);

    $codigo=isset($_REQUEST['Codigo'])? $_REQUEST['Codigo']: null;

    $eliminar = $tuPDO->prepare('DELETE FROM ingredientes WHERE Codigo = :Codigo');

    $eliminar->execute([
        'Codigo'=>$codigo
    ]);

    header('Location:consulBDmedidas.php');
?>
