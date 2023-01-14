<?php
include ("00-conexion_peliculas.php");
echo $query = "select * from peliculas";
$resultado = mysqli_query($con,$query);
//print_r($resultado);
if(mysqli_num_rows($resultado)!=0){ ?>   
    <h2><?php echo "Nº resultados:" .mysqli_num_rows($resultado) ?></h2>    
    <?php 
    //echo $query;
    echo '<table>';
    ?>
    <tr><th>Id</th><th>tmdbId</th><th>Titulo </th><th>poster</th><th>estreno</th><th>generos</th><th>Activar</th><th>editar</th><th>Borrar</th></tr>
    <?php
    while($fila=mysqli_fetch_array($resultado)){  ?>   
        <tr>
            
                <td ><?php echo $fila["id"] ?> </td>
                 <td><?php echo $fila["tmdb_id"] ?></td>
                 <td><?php echo $fila["titulo"] ?></td>
                 <td>
                    <img src="https://image.tmdb.org/t/p/w154/<?php echo $fila["poster"] ?>" width="50px" title="<?php echo $fila["titulo"] ?>"/>
                    
                 </td>
                 <td><?php //echo date("d-m-Y",mktime($fila["estreno"])) 
                            echo $fila["estreno"];
                 ?></td>
                 <td>
                 <?php
                     //$query2= "select genero.genero as generop from genero,peli_genero where peli_genero.peliculaid = ".  $fila['id'] ." and peli_genero.generoid =genero.id";

                     $query2= "select * from genero,peli_genero where peli_genero.peliculaid = ".  $fila['id'] ." and peli_genero.generoid =genero.id";
                    $resultado2 = mysqli_query($con,$query2);
                    while($fila2=mysqli_fetch_array($resultado2)){
                        //echo $fila2['generop'] . ' ' ;
                        echo $fila2['genero'] . ' ' .  $fila2['id'] . ' | ' ;
                    }
                 ?>
                </td>
                <td>
                    <?php 
                    if ($fila['estado']=='A')
                    {
                        echo '<a href="07-peliculas_genero_estado_01_D.php?id='. $fila['id'].'">desactivar</a>';
                    } else {
                        echo '<a href="07-peliculas_genero_estado_01_A.php?id='. $fila['id'].'">activar</a>';
                    }
                    ?>
                </td>
                 <td>   
                <?php             
                 echo '<a href="10-peliculas-editar.php?id='. $fila['id'].'">editar</a>';
                 ?>
                 </td>
                 <td>borrar</td>
               
    </tr>
    <?php } // FIN WHILE ?> 
    </table>      
<?php 
 }else{ ?>     
          <article>
                <p class='precio'>Lo siento,  no hay resultados</p>
            </article>    
<?php } ?>     
<?php  mysqli_close($con);
?>

