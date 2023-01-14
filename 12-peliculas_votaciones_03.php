<?php
include ("00-conexion_peliculas.php");
include ("00-funciones.php");
echo $query = " select elemento_votado, AVG(valoracion) media from votaciones group by elemento_votado order by AVG(valoracion) DESC";
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
                echo $query2="select titulo from peliculas where id = " .  $fila["elemento_votado"];
                $resultado2 = mysqli_query($con,$query2);
                $titulo ='No encontrado';
                if(mysqli_num_rows($resultado2)!=0){ 
                    $fila2 = mysqli_fetch_assoc($resultado2);
                    $titulo = $fila2['titulo'];
                }  
                ?>
                <td ><?php echo $fila["elemento_votado"] ?> </td>
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

