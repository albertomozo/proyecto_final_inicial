<!DOCTYPE html>
<?php
include ("00-conexion_peliculas.php");
foreach ($_REQUEST as $key => $valor )
{
     if (is_array($valor)){
        //print_r($valor);
        //echo "<ul>$key";
        foreach ($valor as  $valor1 )
        {
            
            //echo "<li> $valor1</li>";

        }
        echo '</ul>';  
    } else {
    //echo "<p>$key = $valor </p>";
    $$key = $valor;
    }
}
$genero = [];
if (isset($_REQUEST['genero'])){$genero = $_REQUEST['genero'];}

$query = 
"UPDATE peliculas
 SET titulo = '$titulo',
     estreno = '$estreno',
     estado = '$estado',
     overview= '$overview',
     opinion = '$opinion'
 WHERE id = $id";


 $resultado = mysqli_query($con,$query);
 if (!$resultado){ echo "<p>error $query </p>";}

/* borro todos los generos asociados a la peli */
$query = "DELETE FROM peli_genero WHERE peliculaid = $id";
$resultado = mysqli_query($con,$query);
if (!$resultado){ echo "<p>error $query </p>";}


/* inserto los generos que se han enviado */
foreach ($genero as $valor) {
    $query = "INSERT INTO peli_genero
    (peliculaid,generoid) VALUES ($id,$valor)";
    $resultado = mysqli_query($con,$query);
    if (!$resultado){ echo "<p>error $query </p>";}

   
}

mysqli_close($con);
?>
<a href="07-peliculas_genero_estado_02.php">Ir a lista</a>


