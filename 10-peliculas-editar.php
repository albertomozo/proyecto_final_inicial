<!DOCTYPE html>
<?php
include ("00-conexion_peliculas.php");
if (isset($_GET['id'])){
    $id=$_GET['id'];
} else {
    echo 'No hay nada que modificar';
    exit;
}

echo $query = "select * from peliculas where id = $id";
$resultado = mysqli_query($con,$query);
//print_r($resultado);
if(mysqli_num_rows($resultado)!=0){    
    echo '<form name="form1" action="10-peliculas-editar-grabar.php" method="post">';
    while($fila=mysqli_fetch_array($resultado)){  ?>   
        Id : <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>"><br/>
        tmdid : <input type="hidden" name="tmdbid"  id="tmdbid" value="<?php echo $fila["tmdb_id"]; ?>" ><br/>
        titulo : <input type="text" name="titulo"  id="titulo" value="<?php echo $fila["titulo"]; ?>" ><br/>
        estreno : <input type="date" name="estreno"  id="estreno" value="<?php echo $fila["estreno"]; ?>" ><br/>   
        <hr>
                
                
             <!--     <td>
                    <img src="https://image.tmdb.org/t/p/w154/<?php echo $fila["poster"] ?>" width="50px"/>
                    
                 </td> -->
             
                 <?php
                     $query2= "select *  from genero";
                    $resultado2 = mysqli_query($con,$query2);
                    while($fila2=mysqli_fetch_array($resultado2)){
                        $generoid= $fila2['id'];
                        $genero= $fila2['genero'];
                        
                       $query3 = "select * from peli_genero where peliculaid = $id and generoid= $generoid";
                        $resultado3 = mysqli_query($con,$query3);
                        $chequeado = "";
                        if (mysqli_num_rows($resultado3)>0)
                        {
                           $chequeado = "checked";
                        }
                        echo $fila2['genero'] . ' : '  ;
                        ?>
                        <input type="checkbox" name=genero[] value="<?php echo $generoid; ?>"  <?php echo $chequeado ?> >

                        <?php
                    

                    }
                 ?>
                <br>
                <hr>
                Activo : <input type="radio" name="estado" value="A" <?php if($fila['estado']=='A') {echo 'CHECKED';}?> >
                Desactivo  : <input type="radio" name="estado" value="D" <?php if($fila['estado']=='D') {echo 'CHECKED';}?> >
                Suspendido  : <input type="radio" name="estado" value="S" <?php if($fila['estado']=='S') {echo 'CHECKED';}?>>
                <hr>
                Overwiew <textarea name="overview" col="200"><?php echo $fila["overview"];?></textarea><br>
                Opinion <textarea name="opinion" col="400"><?php echo $fila["opinion"];?></textarea><br>
            
  
    <?php } // FIN WHILE ?> 
    <input type="submit" name="submit" value="grabar"?>
    </form>      
<?php 
 }else{ ?>     
          <article>
                <p class='precio'>Lo siento,  no hay resultados</p>
            </article>    
<?php } ?>     
<?php  mysqli_close($con);
?>

