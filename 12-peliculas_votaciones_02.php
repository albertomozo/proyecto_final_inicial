<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Char.js</title>
    <style>
       .container{
            padding: 100px;
            font-family: helvetica;
           
        }
       
        
        
    </style>
    <!--  https://www.chartjs.org/docs/latest/getting-started/   -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



</head>
<body>
   <div id="capa"></div>
   
        <!-- FIN    -->
       
        
   
       
</div> 
<script>
  
    var array =  new(Array) ;
    var arraypob =  new(Array) ;
    var arraymuj =  new(Array) ;
    var arrayhom =  new(Array) ;
   fetch("https://servicios.ine.es/wstempus/js/es/DATOS_TABLA/2852?tip=AM&")
  .then(response => {
    if (response.ok)
      return response.text()
    else
      throw new Error(response.status);
  })
  .then(data1 => {
   // console.log("Datos: " + data);
    var pobl = JSON.parse(data1);
    console.log (pobl[0].Data);
 
    for (const item of pobl[0].Data)
    {
        arrayano.unshift(`${item.Anyo}`);
        arraypob.unshift(`${item.Valor}`);
    } 
    console.log( pobl[2].Data);
    for (const item of pobl[2].Data)
    {
       // arrayano.unshift(`${item.Anyo}`);
        arraymuj.unshift(`${item.Valor}`);
    } 
    for (const item of pobl[1].Data)
    {
       // arrayano.unshift(`${item.Anyo}`);
        arrayhom.unshift(`${item.Valor}`);
    } 
    


    console.log('arrayano ' + arrayano);
   console.log ('arraypob ' + arraypob);

    /* estructura de datos para CHART.JS */
   const data = {
      labels: arraypel,
      datasets: [{
        label: 'Peliculas',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data : arrayvot ,
      }
    
    
    
    ]
    }; 
  
    const config = {
      //type: 'line',
      type:'bar',
      data: data,
      options: {}
    };

    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );


  })
  .catch(err => {
    console.error("ERROR: ", err.message)
  });










 

    
  </script>  
</body>
</html>



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
    <div class="container">
       
       <h1>Char.js</h1>
       <p>
          Libreria de Gráficos
        </p>
       
        <!-- codigo  HTML para insertar la grafica -->
        <div>
           <canvas id="myChart"></canvas> 

        </div>
        <!-- FIN    -->
       
        
   
       
    </div> 
    <script>
          /* estructura de datos para CHART.JS */
   const data = {
      labels: arrayano,
      datasets: [{
        label: 'Habitantes',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data : arraypob ,
      },
      {
        label: 'Mujeres',
        backgroundColor: 'rgb(125, 99, 132)',
        borderColor: 'rgb(125, 99, 132)',
        data : arraymuj ,
      },
      {
        label: 'Hombres',
        backgroundColor: 'rgb(7, 56, 33)',
        borderColor: 'rgb(60, 99, 132)',
        data : arrayhom ,
      },
    
    
    
    ]
    }; 
  
    const config = {
      //type: 'line',
      type:'bar',
      data: data,
      options: {}
    };

    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );


    </script>
    



<?php  }else{ ?>     
          <article>
                <p class='precio'>Lo siento,  no hay registros</p>
            </article>    
<?php } ?>     
<?php  mysqli_close($con); ?>

