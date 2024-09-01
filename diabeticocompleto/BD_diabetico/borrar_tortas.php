<?php 
    $host ='sql201.infinityfree.com';
    $BD ='if0_37072466_diabetico_goloso';
    $usuario ='si0_37072466';
    $clave ='';
    

    $hostPDO="mysql:host=$host;dbname=$BD;";
    $tuPDO=new PDO($hostPDO,$usuario,$clave);

    $codigo=isset($_REQUEST['Codigo'])? $_REQUEST['Codigo']: null;

    $eliminar = $tuPDO->prepare('DELETE FROM tortas WHERE Codigo = :Codigo');

    $eliminar->execute([
        'Codigo'=>$codigo
    ]);

    header('Location:consulBDtorta.php');
?>
