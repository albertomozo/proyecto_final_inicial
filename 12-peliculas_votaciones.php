<?php
include ("00-conexion_peliculas.php");
include ("00-funciones.php");
echo $query = "select elemento_votado, AVG(valoracion) AS media from votaciones group by elemento_votado order by AVG(valoracion) DESC";
$resultado = mysqli_query($con,$query);
if(mysqli_num_rows($resultado)!=0){ ?>   
    <h2><?php echo "Nº resultados:" .mysqli_num_rows($resultado) ?></h2>    
    <?php 
    echo '<table>';
    ?>
    <tr><th>Id</th><th>media</th></tr>
    <?php
    while($fila=mysqli_fetch_array($resultado)){  ?>   
        <tr>       
                <td ><?php echo $fila["elemento_votado"]; ?> </td>
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

