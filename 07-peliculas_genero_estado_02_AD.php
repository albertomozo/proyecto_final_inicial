<!-- invocado en  07-peliculas_genero_estado_02.PHP -->
<?php
include ("00-conexion_peliculas.php");
$id = $_REQUEST['id']; 
$estado = $_REQUEST['estado']; // VIENEN DE 07-peliculas_genero_estado_02.PHP
$query = "update  peliculas set estado = '".$estado."'  where id = $id";
$resultado = mysqli_query($con,$query);
if ($resultado){
    header("location:07-peliculas_genero_estado_02.php");
} else {
    echo $query;
}
?>