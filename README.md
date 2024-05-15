<a name="readme-top"></a>

<br />
<div align="center">
  <a href="https://github.com/DavidPrDev/meteoMap-1.2">
    <img src="img/logo.png" alt="Logo" width="80" height="80">
  </a>

  [![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?logo=linkedin&logoColor=white)](https://www.linkedin.com/in/david-pérez-romero-b8a57a292/)

  <h3 align="center">Meteo map</h3>
  <p align="center">
      <img src="img/meteoImg.png" alt="Texto alternativo de la imagen" width="400" height="200" style="border-radius:10px;">   
  </p>
      <a href="https://meteomap.david-pr.com/">Visita la web </a>
</div>

<details>
  <summary>Contenido de la aplicación</summary>
  <ol>
    <li>
      <a href="#Sobre-el-proyecto">Sobre el proyecto</a>
      <ul>
        <li><a href="#Tecnologías-empleadas">Tecnologías</a></li>
      </ul>
    </li>
    <li>
      <a href="#Empezando">Empezando</a>
      <ul>
        <li><a href="#Prerrequisitos">Prerrequisitos</a></li>
        <li><a href="#Backend"> Instalacion Backend </a>
        <li><a href="#Frontend"> Instalacion Frontend </a>
        <li><a href="#Características-del-proyecto">Caracteristicas</a></li>
      </ul>
    </li>
   
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## Sobre el proyecto 


Meteomap es una aplicación meteorológica construida en laravel y react como frontal ,consumiendo la API rest de <a href="[#Caracteristicas Api](https://opendata.aemet.es/centrodedescargas/inicio)">AEMET Open data</a>.


<p align="right">(<a href="#readme-top">Volver al incio</a>)</p>



### Tecnologías empleadas

Este proyecto está construido con react como frontal y laravel mediante un asset bundle basico.


* [![Laravel](https://img.shields.io/badge/-Laravel-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com/)

* [![React](https://img.shields.io/badge/react-blue?logo=react)](https://es.reactjs.org/)


* [![Mysql](https://shields.io/badge/MySQL-lightgrey?logo=mysql&style=plastic&logoColor=white&labelColor=blue)](https://www.mysql.com/)

<p align="right">(<a href="#readme-top">Volver al incio</a>)</p>



<!-- GETTING STARTED -->
## Empezando

Para iniciar este proyecto necesitamos copiar el repositorio  instalar el backend y el frontend como se describe más adelante.

### Prerrequisitos

Empezaremos clonando el repositiorio .
* clonar repositorio 
  ```sh
  git clone https://github.com/DavidPrDev/meteoMap-1.2.git
  ```

### Backend

Para instalar el backend de laravel seguiremos estos pasos:

1. Instalar laravel y los demas paquetes.
   ```sh
   composer install
   ```

2. Configurar el fichero .env con las credenciales de nuestra bd.

3. Realizaremos las migraciones
   ```sh
   php artisan migrate
   ```

4. Cargar el script sql meteo-map-bd.sql que se encuentra en el repositorio , esto carga los códigos de los municipios , unos 8000 registros de todo el país necesarios para la api de aemet.

      <p align="right">(<a href="#readme-top">Volver al incio</a>)</p>

### Frontend

Para instalar nuestro frontal de react ejecutaremos el siguiente comando:

   ```sh
   npm install
   ```

## Características del proyecto

Algunas de las características más destacables del proyecto son :
 
 * Asset bundle con react.

 *Abstracción de servicios.

 * Custom validator para validar los datos de aemet.


<p align="right">(<a href="#readme-top">Volver al incio</a>)</p>