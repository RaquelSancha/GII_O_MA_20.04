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
