<?php include('header.php');?>
<section>
<?php
$datos = array_map('str_getcsv', file('portafolio-academico.csv'));
// pero debo hacer un pequeño ajuste, para eliminar del arreglo el encabezado del imdb-movies.csv
array_walk($datos, function(&$a) use ($datos) {$a = array_combine($datos[0], $a);});
array_shift($datos);
?>
<h2><?php echo($descripcion_estudiantes);?></h2>
<h3>Puntajes</h3>
<p>Altos puntajes de selección de los estudiantes que ingresan al primer año de la carrera de Diseño de la Universidad de Chile:</p>
<img src="images/puntajes_maximos.png" class="img-responsive">
<p>Mínimo ponderado de selección de los estudiantes que ingresan al primer año de la carrera de Diseño de la Universidad de Chile:</p>
<img src="images/puntajes_minimos.png" class="img-responsive">

<h3>Matriculados</h3>
<p>Total de estudiantes matriculados en la carrera de Diseño de la Universidad de Chile:</p>
<img src="images/matriculados.png" class="img-responsive">

<h3>Egresados</h3>
<p>Número de estudiantes egresados de la carrera de Diseño de la Universidad de Chile:</p>
<img src="images/egresados.png" class="img-responsive">

<h3>Eliminados</h3>
<p>Total de eliminados de la carrera por razones académicas reglamentarias establecidas:</p>
<img src="images/expulsados.png" class="img-responsive">



</section>
<?php include('footer.php');?>
