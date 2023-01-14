<?php
if ($_POST){
    include("00-conexion_peliculas.php");
    $search = $_REQUEST['search'];

    $url = "https://api.themoviedb.org/3/search/movie?api_key=$apikey&language=es&query=$search&page=1&include_adult=false";
    $resultado = file_get_contents($url);
    $items = json_decode($resultado, true);
    //print_r($items);
    echo $url;
    echo '<hr>';
    echo "paginas " . $items['page'];
    $pelis = $items['results']; // lista de peliculas
    foreach ($pelis as $valor){
        $tmdbid = $valor['id'];
       echo '<p>' . $valor['id'] . '-' . $valor['release_date'] . '-' .$valor['original_title'].' <a href="09-peliculas_nueva_grabar_03.php?id='.$tmdbid.'">grabar</a>' ;
       echo '<img src="'.$tmdb_ruta_poster.$valor['poster_path'].'" width="40px">';
       echo '</p>';
    }
    mysqli_close($con);
} else {
?>
    <form name="form1" action="" method="POST">
        <input type="text" name="search" id="search" placeholder="introduzca busqueda">
        <input type="submit" name="submit" value="buscar">
    </form>

<?php
}
?>


