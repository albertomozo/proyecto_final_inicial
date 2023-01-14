<?php

    include("00-conexion_peliculas.php");
    $tmdbid = $_REQUEST['id'];
    /************************************************
     *   OBTENCION DE DATOS DE API                  *
     ***********************************************/
    $url = "https://api.themoviedb.org/3/movie/$tmdbid?api_key=98fee347b91da83932ea8b9daa0edece&language=es";
    echo '<h3>Datos  de una peli</h3>';
    echo "<p>$url : $url </p>";
    $resultado = file_get_contents($url);
    $items = json_decode($resultado, true);
    print_r ($items);
    echo '<hr>';
    // ACCESO A OTRO ENDPOINT (trailer)
    $url2 = "https://api.themoviedb.org/3/movie/$tmdbid/videos?api_key=98fee347b91da83932ea8b9daa0edece&language=es";
    echo '<h3>Videos de una peli</h3>';
    echo "<p>url : $url2 </p>";
    $resultado2 = file_get_contents($url2);
    $items2 = json_decode($resultado2, true);

    $results2 = $items2['results'];
    echo '<br>';
    print_r($results2);
    echo '<br>';
    if (isset($results2[0]['key'])){
        $trailer = $results2[0]['key'];
        echo '<p>$results2[0][\'key\'] = '. $trailer . '</p>';
    } else {
        $trailer = '';
        echo '<p>No hay video</p>';
    }
    echo '<hr>';
    echo '<h3>Lista videos</h3>';
    foreach ($results2 as $key => $valor)
    {
       
            echo '<p>'. $valor['key'] .' | ' . $valor['site'] . ' | ' .$valor['type']. ' | ' .$valor['official'] . '</p> ';
        
    }
     echo '<hr>';
     // acceso a CREDITS https://api.themoviedb.org/3/movie/{movie_id}/credits?api_key=<<api_key>>&language=en-US
     $url3 = "https://api.themoviedb.org/3/movie/$tmdbid/credits?api_key=98fee347b91da83932ea8b9daa0edece&language=es";
    echo '<h3>Creditos de una peli</h3>';
    echo "<p>url : $url3 </p>";
     $resultado3 = file_get_contents($url3);
    $items3 = json_decode($resultado3, true);
    print_r($items3);
    echo '<hr>';
    echo '<h3>Actores de una peli</h3>';
    $cast = $items3['cast'];
    foreach ($cast as $key => $valor)
    {
        if ($valor['known_for_department']=='Acting')
        {
            echo '<p>'. $valor['id'] .' | ' . $valor['original_name'] . ' | ' .$valor['character'] . '</p> ';
        }
    }




    /*************************************************** *
    * generar registro en peliculas                      *
    *****************************************************/

        
      $query = "INSERT INTO peliculas (tmdb_id,titulo,poster,estado,estreno,overview) values ('". $items['id'] . "','". addslashes($items['title']) ."','". $items['poster_path'] ."','D','". $items['release_date']."','". addslashes($items['overview'])."' )";
      echo $query;
    $resultado = mysqli_query($con,$query);
    if ($resultado)
    {
        echo 'Ok';
        $lastid = mysqli_insert_id($con); // id del ultimo registro insertado
       // generos  
        echo '<hr>';
        $generos = $items['genres'];
        foreach ($generos as $key => $valor) {
            echo '<p>'. $valor['id'] .' = ' . $valor['name'] . '</p>';
            $queryi= "INSERT INTO peli_genero (peliculaid,generoid) VALUES ($lastid,".$valor['id'] .")";
            $resultado1 = mysqli_query($con,$queryi);
            if ($resultado1) {

            }else {
                echo "<p>$queryi</p>";
            }
            
        }


    }else{
        echo "$query";
        echo 'Error ';
    }
    mysqli_close($con);
?>
