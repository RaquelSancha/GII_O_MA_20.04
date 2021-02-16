@extends('adminlte::layouts.app')
@section('main-content')
<h2><b>Ayuda de la aplicación Proyecto Coyuntura</b></h2>
<br>
<p><i>Tablas</i></p>
<ul>
  	<li><a href="#predefinidas">Tablas predefinidas</a></li>
  		<ul>
    	<li><a href="#ver">Ver tabla</a></li>
	<li><a href="#predecir">Predicción de datos</a></li>
</ul>
<hr>

<ul>
	<a name="predefinidas"><h3>Tablas predefinidas</h3></a>
		<div align="justify">	
		Las tablas predefinidas son las variables almacenadas en el sistema, pero asignados los valores que corresponden a cada categoría en sus determinados ámbitos geográficos y años.
		En este apartado se muestran todas las variables.  
		   <br><br>
		    <div align="center">
                <img src="img/mostrarPredefinidas.jpg"  title="Variables predefinidas del sistema">
            </div>
	    </div>
	<br>

	<li><a name="ver"><h4>Ver tabla</h4></a></li>
		<div align="justify">	
		Se debe completar el siguiente formulario en donde se filtran los valores por <b>categorías</b>, <b>años</b>, <b>ámbitos geográficos</b> y según como se desea visualizar los datos (meses, trimestres o años).
		    <br><br>
		    <div align="center">
                <img src="img/verPredefinidas.jpg"  title="Formulario para filtrar datos de las tablas">
            </div>
        Una vez rellenado el formulario y enviados los datos, las tablas se mostrarán de la siguiente manera:
	        <br><br>
	        <div align="center">
	                <img src="img/verTabla.jpg"  title="Tabla predefinida" style="border-width:1px;">
	            </div>
		    </div>
		Existe la posibilidad de exportar la tabla creada a formato <b>".xls"</b>.
		Por defecto, se mostrará un gráfico de barras con todos los datos introducidos, pero se puede modificar el gráfico rellenando el formulario.
		Se podrán mostrar gráficos de <b>barras</b>, <b>lineas</b> y <b>radios</b>.
		<br><br>
	        <div align="center">
	                <img src="img/verGrafico.jpg"  title="Grafico de barras creado automaticamente.">
	                <img src="img/verGrafico2.jpg"  title="Grafico de barras creado automaticamente.">
	         </div>
	<br>

</ul>

<ul>
<a name="predecir"><h3>Predicción de datos</h3></a>
<div align="justify">	
		La opción "Predicción de datos" permite predecir el siguiente año de los datos de una variable.  
		   <br><br>
		    <div align="center">
                <img src="img/predecirInicio.jpg"  title="Variables predefinidas del sistema">
            </div>
	    </div>
		Se podrá seleccionar la variable de la que se quiera hacer predicciones.
		<br><br>
	        <div align="center">
	                <img src="img/predecirElegir.jpg"  title="Elegir el ámbito y la categoría a predecir">
	         </div>
			 <div align="center">
	                <img src="img/pantallaPredecir1.jpg"  title="Resultados de la predicción">
					<img src="img/pantallaPredecir2.jpg"  title="Resultados de la predicción">
					<img src="img/pantallaPredecir3.jpg"  title="Resultados de la predicción">
	         </div>
	<br>
	<br>
</ul>

@endsection
