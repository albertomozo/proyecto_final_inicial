<!-- index.php para web publica -->
<?php
include ("00-conexion_peliculas.php");
include ("00-funciones.php");
echo $query = "select * from peliculas  where estado = 'A'";
$resultado = mysqli_query($con,$query);
if(mysqli_num_rows($resultado)!=0){ ?>   
    <h2><?php echo "Nº resultados:" .mysqli_num_rows($resultado) ?></h2>    
    <?php 
    echo '<table>';
    ?>
    <tr><th>Id</th><th>tmdbId</th><th>Titulo </th><th>poster</th><th>estreno</th><th>editar</th><th>Borrar</th></tr>
    <?php
    while($fila=mysqli_fetch_array($resultado)){  ?>   
        <tr>       
                <td ><?php echo $fila["id"] ?> </td>
                 <td><?php echo $fila["tmdb_id"] ?></td>
                 <td><?php echo $fila["titulo"] ?></td>
                 <td>
                    <img src="<?php echo $tmdb_ruta_poster . $fila["poster"] ?>" />
                    
                    
                 
                 </td>
                 <td><?php echo $fila["estreno"] ?></td>
                 <td>
                 editar</td>
                 <td>borrar</td>
               
    </tr>
    <?php } // FIN WHILE ?> 
    </table>      
<?php  }else{ ?>     
          <article>
                <p class='precio'>Lo siento,  no hay registros</p>
            </article>    
<?php } ?>     
<?php  mysqli_close($con); ?>

