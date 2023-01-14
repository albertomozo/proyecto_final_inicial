<?php
$servidor="localhost";
$bduser="root";
$bdclave="";
$bdnombre="peliculas";
$con=mysqli_connect($servidor,$bduser,$bdclave,$bdnombre) ; // id de conexión (link)
if ($con) 
{ //echo 'Conexión Ok';
    mysqli_set_charset($con,'utf8');
}
else {
    //echo 'Conexión Error';
}
/* valores tmdb themovie.org */
$apikey='<< ir a https://www.themoviedb.org/ >>';
$tmdb_ruta_poster = 'https://image.tmdb.org/t/p/w300/'; // carpetada donde estan las imagenes de poster 

?>