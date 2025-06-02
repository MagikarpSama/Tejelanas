# Backend Tejelanas

Este backend implementa una API RESTful para el proyecto **Tejelanas**, permitiendo gestionar servicios/productos, información institucional y preguntas frecuentes. Está desarrollado en PHP puro, siguiendo una estructura MVC simple.

## Estructura de Carpetas


backend/
├── README.md
├── Tejelanas.postman_collection.json
└── api/
    ├── .htaccess
    ├── index.php
    ├── proxy.php
    ├── controllers/
    │   ├── AboutUsController.php
    │   ├── FaqController.php
    │   └── ServicioController.php
    ├── models/
    │   ├── AboutUs.php
    │   ├── Faq.php
    │   └── Servicio.php
    └── routes/
        └── routes.php


## Endpoints Principales

Todos los endpoints requieren el header:

Authorization: Bearer ipss.get


### Servicios / Productos

- **GET `/v1/products-services`**  
  Lista todos los servicios/productos.

- **GET `/v1/products-services/{id}`**  
  Obtiene un servicio/producto por su ID.

- **POST `/v1/products-services`**  
  Crea un nuevo servicio/producto.  
  Body (JSON):  
  ```json
  { "nombre": "Nombre", "descripcion": "Descripción" }
  ```

- **PUT `/v1/products-services/{id}`**  
  Actualiza un servicio/producto existente.  
  Body (JSON):  
  ```json
  { "nombre": "Nuevo nombre", "descripcion": "Nueva descripción" }
  ```

- **DELETE `/v1/products-services/{id}`**  
  Elimina un servicio/producto.

### Información Institucional

- **GET `/v1/about-us`**  
  Devuelve información sobre Tejelanas Vivi.

### Preguntas Frecuentes

- **GET `/v1/faq`**  
  Devuelve una lista de preguntas frecuentes.

## Archivos Clave

- **index.php**  
  Punto de entrada principal de la API. Maneja CORS, autenticación y enruta las peticiones.

- **routes.php**  
  Define las rutas y métodos HTTP soportados.

- **api/controllers/**  
  Lógica de control para cada recurso (Servicios, AboutUs, FAQ).

- **api/models/**  
  Lógica de datos (actualmente en memoria, fácilmente adaptable a base de datos).

- **proxy.php**  
  Proxy para consumir endpoints externos (por ejemplo, en producción).

## Pruebas

Incluye una colección de Postman (Tejelanas.postman_collection.json) para probar todos los endpoints.

## Notas

- El backend está preparado para ser extendido fácilmente a una base de datos real.
- El archivo .htaccess permite URLs limpias y enruta todas las peticiones a index.php.
- El sistema de autenticación es básico (token fijo), solo para propósitos de desarrollo.

