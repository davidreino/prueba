Proyecto prueba para DAPDA
==========================

Instrucciones de instalación
----------------------------

Este es un ejemplo de una instalación del proyecto usando xampp en windows.

Hay que seguir los siguientes pasos para su instalación.

 1. Descargar este repositorio:
    * cd \xampp\htdocs
    * git clone https://github.com/davidreino/prueba.git
    * Se habra creado un directiorio llamado prueba.
 
 2. Instalar dependencias:
    
    * cd \prueba
    * composer install
  
 3. Activar servidor de apache en xampp y cambiar url local.
    
    * Editar archivo c:\xampp\apache\conf\extra\httpd-vhost.conf he introducir:
    
    ```php
    <VirtualHost *:80>
       DocumentRoot "C:/xampp/htdocs/dapda/web/app_dev.php"
       ServerName landing.local
    </VirtualHost>
    ```
    * Editar archivo C:\Windows\System32\drivers\etc\host he introducir:
    
    ```php
    127.0.0.1               landing.local
    ```
    * Reiniciar apache.
    
4. En el caso de error con la creacion de las tablas de la base de datos:

   * Si los datos de la Base de datos no son correctos habria que cambiarlos en el archivo:
   prueba/app/config/parameters.yml
   * La tabla relacionada con el entity se llama datos_dapda y contiene los siguientes datos
   * Los campos son los siguientes:
      - nombre Varchar(255) no nulo
      - apellidos Varchar(255) no nulo
      - telefono Varchar(9) nulo
      - email Varchar(255) no nulo
      - tipo Varchar(255) no nulo
      - vehiculo Varchar(255) no nulo
      - preferencia Varchar(255) no nulo
