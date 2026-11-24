# CRMrh
# Sistema de Recursos Humanos (RH)

## Descripción

Sistema web para la administración y gestión de empleados. Permite consultar el personal registrado, gestionar su estatus, visualizar contratos y consultar la ubicación geográfica de cada empleado.

## Tecnologías utilizadas

PHP 8.2: lenguaje de programación del backend.

MySQL / MariaDB: gestión de base de datos.

HTML5 y CSS3: estructura y estilos de la aplicación.

JavaScript y jQuery: funcionalidades dinámicas.

Bootstrap 5: diseño de interfaces y componentes.

DataTables: búsqueda, ordenamiento y paginación de registros.

Leaflet: visualización de mapas interactivos.

GeoJSON: información geográfica de los estados de México.

XAMPP: entorno de desarrollo local.

## Funcionalidades principales

### Gestión de empleados

- Consulta del listado de empleados activos.
- Visualización de información general.
- Consulta de CURP y tipo de nómina.
- Cambio de estatus del empleado.
- Eliminación de registros.

### Gestión de contratos

- Consulta de contratos asociados a cada empleado.
- Acceso al documento del empleado mediante su identificador.

### Ubicación geográfica

- Visualización de la ubicación de los empleados.
- Consulta mediante coordenadas de latitud y longitud.
- Identificación del estado correspondiente.
- Visualización de marcadores en el mapa de México.
- Delimitación geográfica de las entidades federativas mediante GeoJSON.

### Recomendaciones

- Consulta de recomendaciones.
- Registro de nuevas recomendaciones mediante peticiones AJAX.

## Requisitos del sistema

Para ejecutar el proyecto localmente se requiere:

- Windows.
- XAMPP.
- Apache.
- PHP 8.2 o compatible.
- MySQL o MariaDB.
- Navegador web actualizado.
- Conexión a Internet para cargar las bibliotecas externas utilizadas por la aplicación.

## Instalación

### 1. Clonar el repositorio

Abrir una terminal y ejecutar:

cd C:\xampp\htdocs
git clone https://github.com/jucasa18/CRMrh.git


### 2. Iniciar XAMPP

Abrir el panel de control de XAMPP e iniciar:

- Apache
- MySQL

### 3. Configurar la base de datos

1. Abrir phpMyAdmin.
2. Crear o seleccionar la base de datos `rh`.
3. Importar el respaldo SQL del proyecto, si está disponible.
4. Verificar que las tablas y los registros se hayan importado correctamente.

### 4. Configurar la conexión

Revisar el archivo PHP donde se establece la conexión a la base de datos.

Configurar los siguientes parámetros de acuerdo con el entorno local:

- Servidor de base de datos.
- Puerto.
- Nombre de la base de datos.
- Usuario.
- Contraseña.

**Nota:** En este entorno de desarrollo, MariaDB puede utilizar el puerto `13307`, por lo que debe verificarse la configuración real de XAMPP.

### 5. Verificar los archivos geográficos

Comprobar que exista el siguiente archivo:


assets/geojson/estados_mexico.geojson


Este archivo contiene la información geográfica utilizada para dibujar los estados de México.

### 6. Ejecutar el sistema

Abrir el navegador y acceder a:

http://localhost/rh/


## Estructura general del proyecto

rh/
│
├── acciones/
│   ├── ajax/
│   └── ins/
│
├── assets/
│   └── geojson/
│       └── estados_mexico.geojson
│
├── css/
│   └── datatables/
│
├── html2/
│   └── contrato.php
│
├── header.php
├── footer.php
├── empleados.php
├── estatus.php
├── dalete_empleado.php
└── README.md

