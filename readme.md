# Codigo PHP proyecto Peliculas 

Conjunto de ficheros php que acceden a las tablas de la base de datos peliculas, incluidas en el fichero peliculas.sql.

 Contiene las funcionalidades basicas  para incluir en el proyecto final del cursos de aplicaciones web.

# 00_conexion_peliculas.php

Conexión a la base de datos. Es un fichero incluido en todos los ficheros .php 

Hay que generar una apykey en la pagina web https://www.themoviedb.org/ e incluirla en la variable

Incluimos otras variables para poder acceder a la imagenes 

# peliculas.sql

Copntiene la estructura de la tablas necesarias y los datos de la tabla genero. Hay que ejecutar estas sentencias SQL  en el servidor

## 06-peliculas.php

index.php para web publica 

lista de la peliculas activas

## 07-peliculas_genero_estado_01.php

Lista de todas las peliculas. 

### 07-peliculas_genero_estado_01_A.php
cambiar estado pelicula a Activo (A)
### 07-peliculas_genero_estado_01_D.php
cambiar estado pelicula a Activo (D)

   ## 07-peliculas_genero_estado_02.php

Lista de todas las peliculas. 

   ### 07-peliculas_genero_estado_02_AD.php
cambiar estado pelicula a Activo (A) o Desactivado (D)

## 08-peliculas_nueva_XX.php -> 08-peliculas_nueva_grabar_XX.php

Distintas versiones del proceso de busqueda de peliculas en la API y grabacion  en la BD.

### 08-peliculas-nueva_XX.php

Formulario Busqueda -> acceso API -> mostrar resultados con enlace a grabar

```php	
<a href="09-peliculas_nueva_grabar_03.php?id='.$tmdbid.'">grabar</a>
```

### 09-peliculas-nueva_grabar_XX.php

Ordenes insert en tabla peliculas y peli_genero

Necesito usar 
```php	
  $lastid = mysqli_insert_id($con); 
  ```	

  Para conocer el último id automerico insertado en la conexion , lo que en este caso equivale al id asignado a la pelicula.

### 09-peliculas_nueva_grabar_03.php

Se ven las url de los videos y de los creditos de una pelicula. Valdria para peli_detalle.php

## 10-peliculas-editar.php

Accesible desde un enlace en el CRUD


```
	 echo '<a href="10-peliculas-editar.php?id='. $fila['id'].'">editar</a>';  ?> 
```

## 10-peliculas-editar-grabar.php

Ejecución SQL Update sobre peliculas

Manejo de checks

```php
/* borro todos los generos asociados a la peli */
$query = "DELETE FROM peli_genero WHERE peliculaid = $id";
```

e insercion de los check marcados

```php
/* inserto los generos que se han enviado */
foreach ($genero as $valor) {
    $query = "INSERT INTO peli_genero
    (peliculaid,generoid) VALUES ($id,$valor)";
    $resultado = mysqli_query($con,$query);
    if (!$resultado){ echo "<p>error $query </p>";}

   
}
mysqli_close($con);
```
Viene del boton grabar del formulario de 10-peliculas-editar.php


## 12-peliculas_votaciones_XX.php

Diferentes versiones de la obtención de datos de la tabla votaciones usando las funciones SQL de estadistica

```
echo $query = "select peliculas.titulo,votaciones.elemento_votado, AVG(votaciones.valoracion) AS media from votaciones,peliculas group by votaciones.elemento_votado order and peliculas.id = votaciones.elemento_votado order by AVG(votaciones.valoracion) DESC";
```

## 12-peliculas_votaciones_02.php

Acceso estadistiscas INE









# Toda la documentación para usar estos archivos la encontraras en 

https://github.com/albertomozo/proyectofinal2023

# autor : Alberto Mozo (2022)
