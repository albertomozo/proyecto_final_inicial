<?php

    include("00-conexion_peliculas.php");
    $tmdbid = $_REQUEST['id'];  
    $query = "SELECT * FROM peliculas WHERE tmdb_id = '$tmdbid'";
    $resultado = mysqli_query($con,$query);
    if (mysqli_num_rows($resultado)==0)
    { 
        echo $url = "https://api.themoviedb.org/3/movie/$tmdbid?api_key=98fee347b91da83932ea8b9daa0edece&language=es";
        echo '<hr>';
        $resultado = file_get_contents($url);
        $items = json_decode($resultado, true);
        print_r($items);
        // comprobar si ya existe la pelicula en nuestra
        $tmdb_id = $items['id'];// generar registro en peliculas
        $query = "INSERT INTO peliculas (tmdb_id,titulo,poster,estado,estreno) values ('". $items['id'] . "','". $items['title'] ."','". $items['poster_path'] ."','D','". $items['release_date']."')";
        echo $query;
        $resultado = mysqli_query($con,$query);
        if ($resultado)
        {
            echo 'Ok';
            $lastid = mysqli_insert_id($con); // id del ultimo registro insertado
            // GRABAMOS EN LOS GENEROS EN LA TABLA peli_genero
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
            echo '$query';
        }
    } else {
        echo '<p>Upss lo siento, ya tenemos ese registro</p>';
    }
    mysqli_close($con);
?>
