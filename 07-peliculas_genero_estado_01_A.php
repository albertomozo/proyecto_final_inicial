<?php
include ("00-conexion_peliculas.php");
$id = $_GET['id'];
$query = "update  peliculas set estado = 'A'  where id = $id";
$resultado = mysqli_query($con,$query);
if ($resultado){
    header("location:07-peliculas_genero_estado_01.php");
} else {
    echo $query;
}
?>