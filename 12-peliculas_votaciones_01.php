<?php
include ("00-conexion_peliculas.php");
include ("00-funciones.php");
echo $query = "select peliculas.titulo,votaciones.elemento_votado, AVG(votaciones.valoracion) AS media from votaciones,peliculas group by votaciones.elemento_votado order and peliculas.id = votaciones.elemento_votado order by AVG(votaciones.valoracion) DESC";
$resultado = mysqli_query($con,$query);
if(mysqli_num_rows($resultado)!=0){ ?>   
    <h2><?php echo "Nº resultados:" .mysqli_num_rows($resultado) ?></h2>    
    <?php 
    echo '<table>';
    ?>
    <tr><th>Id</th><th>Titulo</th><th>media</th></tr>
    <?php
    while($fila=mysqli_fetch_array($resultado)){  ?>   
        <tr>       
                <?php 
                $query2="select titulo from peliculas where id = " .  $fila["id"];
                $resultado2 = mysqli_query($con,$query2);
                $titulo ='No encontrado';
                if(mysqli_num_rows($resultado2)!=0){ 
                    $fila2 = mysql_fetch_assoc($resultado);
                    $titulo = $fila2['titulo'];
                }  
                ?>

                ?>
                <td ><?php echo $fila["id"] ?> </td>
                <td ><?php echo $titulo ?> </td>
                 <td><?php echo $fila["media"] ?></td>
                 
               
    </tr>
    <?php } // FIN WHILE ?> 
    </table>      
<?php  }else{ ?>     
          <article>
                <p class='precio'>Lo siento,  no hay registros</p>
            </article>    
<?php } ?>     
<?php  mysqli_close($con); ?>

