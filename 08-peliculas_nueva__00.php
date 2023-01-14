<?php
if ($_POST){
    include("00-conexion_peliculas.php");
    $search = $_REQUEST['search'];

    $url = "https://api.themoviedb.org/3/search/movie?api_key=$apikey&language=es&query=$search&page=1";
    echo $url;
    echo '<hr>';
    //$url = "https://inkorformacion.com";
    $resultado = file_get_contents($url);
    echo $resultado;
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


