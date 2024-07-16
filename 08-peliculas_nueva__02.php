<?php
if ($_POST){
    include("00-conexion_peliculas.php");
    $search = $_REQUEST['search'];

    $url = "https://api.themoviedb.org/3/search/movie?api_key=$apikey&language=es&query=$search&page=1&include_adult=false";
    $resultado = file_get_contents($url);
    $items = json_decode($resultado, true);
    //print_r($items);
    echo "pagina " . $items['page'] .'<br>';
    echo "total_pages " . $items['total_pages'].'<br>';
    echo "total_results " . $items['total_results'].'<br>';
    echo '<hr>';
    $pelis = $items['results'];
    print_r($pelis);
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


