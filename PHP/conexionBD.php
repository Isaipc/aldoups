<?php
    $servidor = "localhost";
    $usuario = "root";
    $contra = "";
    $bd = "aldoups_proyecto";

    $conexion = new mysqli($servidor,$usuario,$contra,$bd);

    if(isset($_POST["nombre"])){
        $nombre = $_POST ["nombre"];
        $precio = $_POST ["precio"];
        $cantidad = $_POST ["cantidad"];
        $descripcion = $_POST ["descripcion"];
        $categoria = $_POST["categoria"];
        $fecha_ingreso = $_POST ["fecha"];

        $sql = "INSERT INTO agregar(nombre,precio,cantidad,descripcion,categoria,fecha) values('$nombre','$precio','$cantidad','$descripcion','$categoria','$fecha_ingreso')";
        mysqli_query($conexion,$sql);    
    }

    try{
        $sql == $conn->prepare('SELECT * FROM agregar');
        $sql ->execute();

        $result = $sql->fetchAll();

        echo json_encode($result);

    }catch (PDOException $e) {
        die('ERROR'. $e->getMessage());
    }
?>