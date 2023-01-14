<?php

    include("00-conexion_peliculas.php");
    $tmdbid = $_REQUEST['id'];

    $url = "https://api.themoviedb.org/3/movie/$tmdbid?api_key=98fee347b91da83932ea8b9daa0edece&language=es";
    $resultado = file_get_contents($url);
    $items = json_decode($resultado, true);
    print_r($items);
    foreach ($items as $key => $valor){
        if (is_array($valor))
        {
            echo "<p>$key";
            print_r ($valor);
            echo '</p>';
        } else {
            echo "<p>$key = $valor</p>";
        }
       
    }
    // generar registro en peliculas
    echo  $query = "INSERT INTO peliculas (`tmdb_id`,`titulo`,`poster`,`estado`,`estreno`) values ('". $items['id'] . "','". $items['title'] ."','". $items['poster_path'] ."','D','". $items['release_date']."')";
    $resultado = mysqli_query($con,$query);
    if ($resultado)
    {
        echo 'Ok';
    }else{
        echo '$query';
    }
    mysqli_close($con);
?>
