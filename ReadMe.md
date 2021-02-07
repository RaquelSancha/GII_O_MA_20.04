<h1 align="center">
  MEJORA DE LA HERRAMIENTA WEB DINÁMICA PARA LA CAPTACIÓN, TRATAMIENTO Y PRESENTACIÓN DE DATOS RELACIONADOS CON LA COYUNTURA ECONÓMICA DE BURGOS
</h1>
<p align="center">
  <a href="https://app.codacy.com/gh/RaquelSancha/GII17.0R_CoyunturaEconomica/dashboard?branch=master"><img src="https://app.codacy.com/project/badge/Grade/5a86b32c970a40a981b82a1324254596"/></a>
</p>
<h4 align="center">TFG de la <a href="https://www.ubu.es/">UBU</a></h4>
<h3 align="center">
  <img href="Docs/readme/escudoubu.jpg" alt="Escudo UBU"/> 
</h3>
<p align="center">
  <b>Autora</b><br>
  <i>Raquel Sancha Sánchez</i><br>
  <b>Tutores</b><br>
  <i>Carlos López Nozal</i><br>
  <i>Bruno Baruque Zanon</i><br>
  <i>Santiago Porras Alfonso</i><br>
  <i>Julio César Puche Regaliza</i><br>
</p>

# Descripción
Este trabajo es una ampliación de otro proyecto de fin de grado llamado <a href="https://github.com/NelsonParamo/GI16.M_ProyectoCoyuntura">_Herramienta web dinámica para la captación, tratamiento y presentación de datos relacionados con la coyuntura económica de Burgos_ </a>
Este proyecto fue creado para facilitar el trabajo del equipo que todos los años realiza unos boletines de coyuntura económica para informar de la situación de la economía burgalesa.
Esta aplicación permite la entrada de datos y su clasificación.
El objetivo de mi proyecto es mejorar la aplicación y añadir nuevas funcionalidades como la introducción de datos directamente de la página del INE o la capacidad de exportar las tablas a Excel.
## Comenzando 🚀
_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._
### Pre-requisitos 📋
Para instalar el software necesitas
* [Docker] (https://www.docker.com/products/docker-desktop) - Descargar Docker

### Instalación 🔧
Ve a la carpeta _laradock_ donde se encuentra el contenedor de Docker ya configurado
```
cd GII17.0R_CoyunturaEconomica/laradock
```
Carga y arranca las imágenes necesarias para que el proyecto funcione. La primera vez puede llevar unos minutos.
```
docker-compose up -d apache2 php-fpm workspace phpmyadmin mysql
```
## Ejecutando las pruebas ⚙️
Para ejecutar los tests del proyecto debemos abrir la consola del workspace de laradock
```
docker-compose exec workspace bash
```
Una vez dentro ejecutamos el comando
```
vendor/bin/phpunit
```
## Construido con 🛠️
* [Laravel](https://laravel.com/) - El framework web usado
* [Composer](https://getcomposer.org/) - El gestor de dependencias
