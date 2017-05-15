<?php include('header.php');?>
<section>
<?php
$datos = array_map('str_getcsv', file('portafolio-academico.csv'));
// pero debo hacer un pequeño ajuste, para eliminar del arreglo el encabezado del imdb-movies.csv
array_walk($datos, function(&$a) use ($datos) {$a = array_combine($datos[0], $a);});
array_shift($datos);
?>
<h2><?php echo($descripcion_index);?></h2>
<h3>Jornadas Académicas</h3>
<p>Esta es la cantidad de horas destinadas a actividades académicas por cada profesional:</p>
<p>El promedio de horas que cada docente destina a sus actividades en la Universidad de Chile es de <strong>24 horas.</strong></p>
<img src="images/cantidad_horas.png" class="img-responsive">

<h3>Analizando el CSV, podemos obtener distintos números.</h3>
<p>Pero antes de revisar los números conviene saber que, según el Reglamento general de carrera académica de la Universidad de Chile, son tres las Categorías Académicas:</p>
<ol>
<li>La <a href="http://www.uchile.cl/portal/presentacion/normativa-y-reglamentos/4860/titulo-ii-de-la-categoria-y-carrera-academica-ordinaria">Categoría Académica Ordinaria</a>, con cinco rangos consecutivos: Ayudante, Instructor, Profesor Asistente, Profesor Asociado y Profesor Titular.</li>
<li>La <a href="http://www.uchile.cl/portal/presentacion/normativa-y-reglamentos/4861/titulo-iii-de-la-categoria-y-carrera-academica-docente">Categoría Académica Docente</a>, con tres rangos consecutivos: Profesor Asistente de Docencia, Profesor Asociado de Docencia y Profesor Titular de Docencia.</li>
<li>La <a href="http://www.uchile.cl/portal/presentacion/normativa-y-reglamentos/4863/titulo-iv-de-la-categoria-academica-adjunta">Categoría Académica Adjunta</a>, con dos rangos: Instructor Adjunto y Profesor Adjunto.</li>
</ol>
<?php
$adjunta = 0;
$ordinaria = 0;
$docente = 0;
for ($a = 0; $a < $all = count($datos); $a++) {
  if(substr_count($datos[$a]['Rango'],'Adjunto') > 0){
    $adjunta++;
  }elseif(substr_count($datos[$a]['Rango'],'Docencia') > 0){
    $docente++;
  }else{
    $ordinaria++;
  }
}
;?>
<p><strong>Diseño dispone de <?php echo $all;?> académicos</strong>. <?php echo $ordinaria;?> de ellos están en la Categoría Académica Ordinaria, <?php echo $docente;?> están en la Categoría Académica Docente, y <?php echo $adjunta;?> están en la Categoría Académica Adjunta.</p>
<?php
$full_time = 0;
for ($b = 0; $b < $all; $b++) {
if((substr_count($datos[$b]['Rango'],'Adjunto') == 0) && (substr_count($datos[$b]['Rango'],'Docencia') == 0) && ($datos[$b]['Horas'])==44){
$full_time++;
    }
};?>
<img src="images/categorias_academicas.png" class="img-responsive">

<h3>Jornadas Académicas / Análisis Detallado</h3>
<p>De los <?php echo $ordinaria;?> académicos en Categoría Académica Ordinaria, <?php echo $full_time;?> tienen jornada completa. Ellos son:</p>
<ol>
<?php
for ($c = 0; $c < $all; $c++) {
  if((substr_count($datos[$c]['Rango'],'Adjunto') == 0) && (substr_count($datos[$c]['Rango'],'Docencia') == 0) && ($datos[$c]['Horas'])==44){
    echo '<li>'.$datos[$c]["Nombres"].' '.$datos[$c]["Apellidos"].' ('.$datos[$c]["Rango"].')</li>';
  }
};?>
</ol>
<p>Pero si reducimos el listado recién presentado a los que "han demostrado una actividad académica sostenida, capacidad y aptitudes para realizarla en forma autónoma y creativa y dominio de su especialidad", sólo tenemos:</p>
<ol>
<?php
for ($d = 0; $d < $all; $d++) {
  if((($datos[$d]['Rango']) == "Profesor Asociado") && ($datos[$d]['Horas'])==44){
    echo '<li>'.strstr($datos[$d]["Nombres"], ' ', true).' '.$datos[$d]["Apellidos"].' ('.$datos[$d]["Rango"].')</li>';
  }
};?>
</ol>
<p>Los profesores que "han demostrado una actividad docente sostenida, realizándola en forma autónoma y creativa, con pleno dominio de su especialidad, dando a conocer su experiencia en textos de uso docente", serían:</p>
<ol>
<?php
for ($d = 0; $d < $all; $d++) {
  if((($datos[$d]['Textos']) ==Si)&& ($datos[$d]['Horas'])==44){
    echo '<li>'.strstr($datos[$d]["Nombres"], ' ', true).' '.$datos[$d]["Apellidos"].' ('.$datos[$d]["Horas"].')</li>';
  }
};?>
</ol>
<img src="images/cantidad de textos_jerarquia.png" class="img-responsive">
<p>Relación entre jerarquía y textos escritos.</p>
</section>
<?php include('footer.php');?>
