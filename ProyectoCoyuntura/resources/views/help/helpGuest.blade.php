@extends('adminlte::layouts.app')
@section('main-content')
<h2><b>Ayuda de la aplicación Proyecto Coyuntura</b></h2>
<br>
<p><i>Tablas</i></p>
<ul>
  	<li><a href="#predefinidas">Tablas predefinidas</a></li>
  		<ul>
    	<li><a href="#ver">Ver tabla</a></li>
</ul>
<u1>
  		<li><a href="#crear">Crear tablas</a></li>
  	<ul>
    	<li><a href="#insertar">Insertar tabla con valores nuevos</a></li>
   	 	<li><a href="#crearCategorias">Crear tabla a partir de categorías existentes</a></li>
	</ul>
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

	<a name="crear"><h3>Crear tablas</h3></a>
		   <br>
            	Desde este apartado se podran introducir <b>nuevas tablas</b> a la aplicación o si se desea, crear una tabla nueva a partir de <b>cualquier categoría</b> que se enuentre en el sistema
                  <div align="center">
                <img src="img/crear.jpg"  title="Formulario crear tablas">
            	</div>	

	<br>
	
	<li><a name="insertar"><h4>Insertar tabla con valores nuevos</h4></a></li>	
		   <br>
            	Para introducir una tabla nueva en la aplicación se deberá rellenar este formulario:
                  <div align="center">
                <img src="img/insertar.jpg"  title="Formulario crear tablas">
            	</div>	
            	<br><br>
            	Se creará la tabla con los valores vacios, y se dará la oportunidad de rellenarlos.
                <img src="img/insertarForm.jpg"  title="formulario para crear tablas de cero">	

	<br>
	<li><a name="crearCategorias"><h4>Crear tabla a partir de categorías existentes</h4></a></li>	
		   <br>
            	Para crear una tabla con cualquier categoría que esté en la aplicación se rellenará el siguiente formulario. 
                 <div align="center">
                <img src="img/crearCategorias.jpg"  title="Formulario crear categorias">
            	</div>	
	<br>
</ul>	

	
@endsection
