# Plantilla Latex

La plantilla se compone de dos documentos maestros, uno para la memoría y otra para los anexos.

En la carpeta tex se encuentran los distintos documentos que forman los documentos maestros. 
Dichos documentos contienen las secciones y subsecciones a completar.
En el documento 3_Conceptos_teoricos.tex se encuentra una breve guía de como usar latex y los comandos propios de esta plantilla.
\footnote{Créditos a los proyectos de Álvaro López Cantero: Configurador de Presupuestos y Roberto Izquierdo Amo: PLQuiz}.



\section{Referencias}

Las referencias se incluyen en el texto usando cite \cite{wiki:latex}. Para citar webs, artículos o libros \cite{koza92}.


\section{Imágenes}

Se pueden incluir imágenes con los comandos standard de \LaTeX, pero esta plantilla dispone de comandos propios como por ejemplo el siguiente:

\imagen{escudoInfor}{Autómata para una expresión vacía}



\section{Listas de items}

Existen tres posibilidades:

\begin{itemize}
	\item primer item.
	\item segundo item.
\end{itemize}

\begin{enumerate}
	\item primer item.
	\item segundo item.
\end{enumerate}

\begin{description}
	\item[Primer item] más información sobre el primer item.
	\item[Segundo item] más información sobre el segundo item.
\end{description}
	
\begin{itemize}
\item 
\end{itemize}

\section{Tablas}

Igualmente se pueden usar los comandos específicos de \LaTeX o bien usar alguno de los comandos de la plantilla.

\tablaSmall{Herramientas y tecnologías utilizadas en cada parte del proyecto}{l c c c c}{herramientasportipodeuso}
{ \multicolumn{1}{l}{Herramientas} & App AngularJS & API REST & BD & Memoria \\}{ 
HTML5 & X & & &\\
CSS3 & X & & &\\
BOOTSTRAP & X & & &\\
JavaScript & X & & &\\
AngularJS & X & & &\\
Bower & X & & &\\
PHP & & X & &\\
Karma + Jasmine & X & & &\\
Slim framework & & X & &\\
Idiorm & & X & &\\
Composer & & X & &\\
JSON & X & X & &\\
PhpStorm & X & X & &\\
MySQL & & & X &\\
PhpMyAdmin & & & X &\\
Git + BitBucket & X & X & X & X\\
Mik\TeX{} & & & & X\\
\TeX{}Maker & & & & X\\
Astah & & & & X\\
Balsamiq Mockups & X & & &\\
VersionOne & X & X & X & X\\
} 

# Creación y edición de documentos en latex.

Latex es un lenguaje de marcado. Para crear y editar documentos en latex se necesita un editor de latex, que puede estar instalado en nuestro ordenador http://www.xm1math.net/texmaker/ o puede tratarse de un servicio web http://sharelatex.com/.

Un videotutorial de la instalación de Miktex + TexMaker en windows puede verse en 
https://www.youtube.com/watch?v=DIdHfVpIiAk

# Petición de cambios y sugerencias

Se ruega a los alumnos y tutores que detecten fallos o que quieran proponer una sugerencia que lo notifiquen mediante la creación de una issue https://github.com/ubutfgm/plantillaLatex/issues

# Gracias a los contribuidores
César Ignacio García Osorio, Álvar Arnaiz Gonzalez, José Francisco Díez Pastor, Carlos Lopez Nozal.
Álvaro López Cantero, Roberto Izquierdo Amo, David Miguel Lozano.

Aspectos relevantes del desarrollo del proyecto
Este apartado pretende recoger los aspectos más interesantes del desarrollo del proyecto, comentados por los autores del mismo.
Debe incluir desde la exposición del ciclo de vida utilizado, hasta los detalles de mayor relevancia de las fases de análisis, diseño e implementación.
Se busca que no sea una mera operación de copiar y pegar diagramas y extractos del código fuente, sino que realmente se justifiquen los caminos de solución que se han tomado, especialmente aquellos que no sean triviales.
Puede ser el lugar más adecuado para documentar los aspectos más interesantes del diseño y de la implementación, con un mayor hincapié en aspectos tales como el tipo de arquitectura elegido, los índices de las tablas de la base de datos, normalización y desnormalización, distribución en ficheros3, reglas de negocio dentro de las bases de datos (EDVHV GH GDWRV DFWLYDV), aspectos de desarrollo relacionados con el WWW...
Este apartado, debe convertirse en el resumen de la experiencia práctica del proyecto, y por sí mismo justifica que la memoria se convierta en un documento útil, fuente de referencia para los autores, los tutores y futuros alumnos.


  
\subsection{Metadatos y datos}
Los datos y los metadatos hacen referencia al apartado {función} de la petición url antes vista.
\subsubsection{Metadatos}
La petición de metadatos sólo está disponible para el sistema Tempus3. Se pueden consultar estos tipos de metadatos:
\begin{enumerate}
    \item Operaciones\\ Para consultar todas las operaciones disponibles:\\ OPERACIONES\_DISPONIBLES.\\ La petición url sería esta:\\ https://servicios.ine.es/wstempus/js/ES/OPERACIONES\_DISPONIBLES\\ Y el output sería un JSON con información sobre todas las operaciones estadísticas disponibles como por ejemplo la del índice de precios de consumo\\
    \{"Id":25, "Cod\_IOE":"30138", "Nombre":"Índice de Precios de Consumo (IPC)", "Codigo":"IPC"\}.\\
    Para consultar una operación en concreto se usa la función OPERACIÓN y como input para identificar la operación se utilizan los códigos que sacamos del output anterior. Por ejemplo para consultar la operación del índice de precios de consumo (IPC), se pueden usar tres input diferentes:  IOE30138, IPC o 25.
    \item Variables\\
    Para obtener todas las variables: VARIABLES\\ https://servicios.ine.es/wstempus/js/ES/VARIABLES\\
    Para obtener las variables de una operación concreta se utiliza como función VARIABLES\_OPERACIÓN y como input cualquiera de los códigos de identificación de la operación antes mencionados. Ejemplo: https://servicios.ine.es/wstempus/js/ES/VARIABLES\_OPERACION/IPC \\
    \item Valores\\
    Se puede acceder a los valores de una variable con la función VALORES\_VARIABLE y con el input correspondiente al código de la operación.\\
    También se muestran los valores que tiene una variable para una operación en concreto con la función VALORES\_VARIABLEOPERACIÓN y el input de la operación que queramos mostrar. 
    \item Tablas\\
    Para obtener todas las tablas asociadas a una operación usamos TABLAS\_OPERACIÓN con el código identificativo de la operación como input.\\
    También podemos mostrar los grupos de una tabla con GRUPOS\_TABLA y usar VALORES\_GRUPOSTABLA para obtener los valores de cada uno de los grupos de una tabla usando además su código identificativo como output. Ejemplo:\\
    https://servicios.ine.es/wstempus/js/ES/GRUPOS\_TABLA/22350\\
    Con esta petición url sacamos los grupos de la tabla con el identificador 22350.\\
    Una fila del output correspondiente a los índices por comunidades autónomas sería esta:\\
    \{"Id":22350, "Nombre":"Índices por comunidades autónomas: general y de grupos ECOICOP", "Codigo":"2016\_NAC-CCAA", "FK\_Periodicidad":1, "FK\_Publicacion":8, "FK\_Periodo\_ini":1, "Anyo\_Periodo\_ini":"2002", "FechaRef\_fin":"null", "Ultima\_Modificacion":1607673600000\}\\
    Y para extraer los valores de ese grupo utilizaríamos la petición:\\
    \small servicios.ine.es/wstempus/js/ES/VALORES\_GRUPOSTABLA/22350/81497\\
    \item Series\\
    Una serie es un conjunto de observaciones medidas en un instante de tiempo determinado.\\ 
    La API JSON del INE nos permite usar las siguientes funciones para sacar información sobre las series:  
    \begin{description}
            \item [SERIE]
            Para formar esta url se usa la función y el input identificativo de la serie. Como output sale la información de la serie requerida.\\
            \item [SERIES\_OPERACION]
            La url se construye de la misma manera pero el output de esta son las series pertenecientes a una determinada operación.\\
            \item [VALORES\_SERIE]
            Con esta función obtenemos información de los metadatos que definen a la serie.\\
            \item [SERIES\_TABLA]
            Utilizando esta función conseguimos datos sobre las series de una tabla de la que pasamos el código identificativo como input.\\
            \item [SERIE\_METADATAOPERACION]
            Esta opción sirve para obtener información detallada sobre un conjunto de datos preciso de una operación. La operación se pasa como un input mediante su identificador.\\
    \end{description}
    \item Publicaciones\\
    Para este tipo de metadatos hay tres funciones muy sencillas: PUBLICACIONES que muestra una lista de todas las publicaciones existentes, PUBLICACIONES\_OPERACION que muestra las publicaciones de una determinada operación que se pasa como input y PUBLICACIONFECHA\_PUBLICACION que saca las fechas en las que se han añadido nuevos datos a una determinada publicación.\\
\end{enumerate}
\subsubsection{Datos}
Es la parte que realmente se trata dentro de la aplicación. Existen varios tipos:\\
\begin{enumerate}
    \item DATOS\_SERIE\\
    Con esta función obtenemos datos de una serie en concreto.\\
    \item DATOS\_TABLA\\
     Información y datos de las series contenidas en la tabla. Los valores vienen clasificados en función del periodo y del año. Puesto que en esta aplicación la forma de clasificar los datos es en tablas, esta función será la que usaremos.\\ 
     \item DATOS\_METADATAOPERACION\\
      Esta opción sirve para obtener información sobre un conjunto de datos preciso de una operación. La operación se pasa como un input mediante su identificador.\\
\end{enumerate}
