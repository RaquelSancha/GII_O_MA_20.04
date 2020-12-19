@extends('adminlte::layouts.app')
@section('main-content')
<h2><b>Ayuda de la aplicación Proyecto Coyuntura</b></h2>
<br>
<p><i>Gestión de datos</i></p>
<ul>
  <li><a href="#variables">Mostrar variables</a></li>
  <li><a href="#supercategorias">Mostrar super categorías</a></li>
  <li><a href="#categorias">Mostrar categorías</a></li>
  <li><a href="#ambitos">Mostrar ámbitos geográficos</a></li>
</ul>
<p><i>Tablas</i></p>
<ul>
  	<li><a href="#predefinidas">Tablas predefinidas</a></li>
  		<ul>
    	<li><a href="#ver">Ver tabla</a></li>
   	 	<li><a href="#modificar">Modificar tabla</a></li>
	   	 	<ul>
	    	<li><a href="#insertarBorrarAmbito">Insertar/Borrar ámbito</a></li>
	   	 	<li><a href="#insertarBorrarCategoria">Insertar/Borrar categoría</a></li>
	   	 	<li><a href="#insertBorrarAño">Insertar/Borrar año</a></li>
			</ul>
		</ul>
  	<li><a href="#crear">Crear tablas</a></li>
  	<ul>
    	<li><a href="#insertar">Insertar tabla con valores nuevos</a></li>
   	 	<li><a href="#crearCategorias">Crear tabla a partir de categorías existentes</a></li>
	</ul>
</ul>
<hr>
<h3>Gestión de datos</h3>
Desde la gestión de datos, se podrán <b>crear</b>, <b>modificar</b> y <b>borrar</b> todos los datos del sistema.
<div align="center">
    <img src="img/choose.jpg"  title="Variables almacenadas en el sistema">
</div>
<ul>
	<li><a name="variables"><h4>Mostrar variables</h4></a></li>
		<div align="justify">	
		    En este apartado se podrán modificar y borrar el <b>nombre</b>, la <b>descripción</b>, el <b>tipo</b> y la <b>fuente</b> de todas las variables que estén almacenadas en el sistema.
		    Si se desea modificar alguno de los valores de cualquiera de las variables, se deberá rellenar el siguiente formulario. Los campos que queden en blanco, permanecerán sin modificaciones.<br><br>
		    <div align="center">
                <img src="img/mostrarVariables.jpg"  title="Variables almacenadas en el sistema">
            </div>
	    </div>
	<br>
	<li><a name="supercategorias"><h4>Mostrar super categorías</h4></a></li>
	<div align="justify">	
		    La aplicación permite tanto crear, modificar y borrar las super categorías, como asignar o desagnirar categorías a las mismas.
		    Cuando se modifica una super categoría, se le pueden añadir o quitar categorías. 
		    Si se borra una super categoría, las categorías que tuviera asignadas pasarían a la super categoría <b>"Sin Categoría"</b>.
		    Al crear una super categoría se le puede asignar categorías que pertenecen a la super categoría <b>"Sin Categoría"</b>.<br>
		    <div align="center">
                <img src="img/mostrarSupercategoria.jpg" title="Super categorías del sistema">
            </div>
	    </div>
	<li><a name="categorias"><h4>Mostrar categorías</h4></a></li>
	<div align="justify">	
		    Desde este apartado se permite crear, modificar y borrar las categorías.
		    Cuando se modifica una categoría, se le puede cambiar el nombre y asignarla a otra super categoría
		    Al borra una categoría, se puede eliminarla tanto de una variable o variables especifica o se puede borrar de toda la aplicación.
		    Al crear una  categoría se le puede asignar una super categoría. <br>
		    <div align="center">
                <img src="img/mostrarCategoria.jpg " title="Categorías del sistema">
            </div>
	    </div>
	<li><a name="ambitos"><h4>Mostrar ámbitos geográficos</h4></a></li>
	<div align="justify">	
		   En este apartado se podrá crear, modificar y borrar los ámbitos geográficos de la aplicación.<br>
		    <div align="center">
                <img src="img/mostrarAmbitos.jpg" title="Ámbitos del sistema">
            </div>
	    </div>
</ul>
<hr>
<h3>Tablas</h3>
<ul>
	<li><a name="predefinidas"><h4>Tablas predefinidas</h4></a></li>
		<div align="justify">	
		Las tablas predefinidas son las variables almacenadas en el sistema, pero asignados los valores que corresponden a cada categoría en sus determinados ámbitos geográficos y años.
		En este apartado se muestran todas las variables, se pueden <b>ver</b>, <b>modificar</b> o <b>borrar</b>.  
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

	<li><a name="modificar"><h4>Modificar Tabla</h4></a></li>
		Los valores de las tablas predefinidas se pueden modificar, a parte, se pueden <b>añadir</b> y <b>quitar</b> ámbitos, categorías y años.
	<br><br>
	<li><a name="insertarBorrarAmbito"><h4>Insertar/Borrar ámbito</h4></a></li>	
		   <br>
				Si se desea añadir un ámbito geografico se deberá rellenar el siguiente formulario que aparecerá debajo de la tabla.
		        <div align="center">
                <img src="img/anadirAmbito.jpg"  title="Añadir ámbitos">
            	</div>
            	<br><br>
            	Si por el contrario, se desea borrar ámbitos geográficos se deberán seleccionar en el siguiente formulario.
                  <div align="center">
                <img src="img/borrarAmbito.jpg"  title="Borrar ámbito">
            	</div>	
	<br>
	<li><a name="insertarBorrarCategoria"><h4>Insertar/Borrar categoría</h4></a></li>	
		   <br>
				Si se desea añadir una categoría se debera rellenar el siguiente formulario.
		        <div align="center">
                <img src="img/anadirCategoria.jpg"  title="Añadir Categoría">
            	</div>
            	<br><br>
            	Si por el contrario, se desea borrar varias categorías, se deberán seleccionar en el siguiente formulario.
                  <div align="center">
                <img src="img/borrarCategoria.jpg"  title="Borrar Categoría">
            	</div>	

	<br>
	<li><a name="insertarBorrarAño"><h4>Insertar/Borrar año</h4></a></li>	
		   <br>
				Si se desea añadir un año se deberá rellenar el siguiente formulario que aparecerá a la derecha  de la tabla.
		        <div align="center">
                <img src="img/anadirAno.jpg"  title="Añadir Categoría">
            	</div>
            	<br><br>
            	Si por el contrario, se desea borrar varios años, se deberán seleccionar en el siguiente formulario.
                  <div align="center">
                <img src="img/borrarAno.jpg"  title="Borrar Categoría">
            	</div>	

	<br>
	<li><a name="crear"><h4>Crear tablas</h4></a></li>	
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
            	Se creará la tabla con los valores vacios, y se dará la oportunidad de rellenarlos, si la tabla nos convence, se puede almacenar en el sistema pinchando en <b>"Guardar"</b>
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
