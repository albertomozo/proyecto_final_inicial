<?php

    include("00-conexion_peliculas.php");
    $tmdbid = $_REQUEST['id'];

    $url = "https://api.themoviedb.org/3/movie/$tmdbid?api_key=$apikey&language=es";
    echo $url;
    echo '<hr>';
    $resultado = file_get_contents($url);
    $items = json_decode($resultado, true);
    print_r($items);
    foreach ($items as $key => $valor){
       echo "<p>$key = $valor</p>";
    }
    mysqli_close($con);
?>
