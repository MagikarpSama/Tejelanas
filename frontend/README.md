# Frontend Tejelanas

Este frontend es la interfaz web del proyecto **Tejelanas**, diseñado para mostrar servicios/productos, información institucional y preguntas frecuentes, y permitir el contacto con el emprendimiento. Utiliza HTML, CSS, JavaScript (con [Vue 3](https://vuejs.org/)), Bootstrap y SwiperJS.

## Guía de Buenas Prácticas

- Usa nombres descriptivos y en inglés para variables y componentes.
- Estructura los archivos por funcionalidad (componentes, assets, páginas).
- Aplica validación en todos los formularios (cliente y servidor).
- Usa etiquetas semánticas y atributos ARIA para accesibilidad.
- Mantén el código modular y reutilizable.
- Realiza commits frecuentes y descriptivos.
- Utiliza ramas para nuevas funcionalidades y revisa el código antes de fusionar.

## Estructura de Carpetas

```
frontend/
├── index.html
├── app.js
├── README.md
├── assets/
│   ├── css/
│   │   └── main.css
│   └── img/
├── components/
│   ├── AboutUs.js
│   ├── ContactForm.js
│   ├── FaqList.js
│   └── ServiceCard.js
└── pages/
    ├── about.php
    └── contact.php
```

## Funcionalidades Principales

- **Catálogo de servicios/productos:**  
  Muestra los servicios/productos obtenidos desde el backend, con imágenes y descripciones.

- **Información institucional:**  
  Sección "¿Quiénes somos?" con información sobre Tejelanas Vivi.

- **Preguntas frecuentes:**  
  Sección de FAQs desplegable, obtenida dinámicamente del backend.

- **Formulario de contacto:**  
  Permite a los usuarios enviar consultas, asociando el producto/servicio de interés.

- **Navegación SPA:**  
  Navegación fluida entre secciones usando Vue 3.

- **Responsive Design:**  
  Adaptado para dispositivos móviles y escritorio usando Bootstrap.

## Componentes Vue

- **ServiceCard:**  
  Tarjeta para mostrar cada servicio/producto.

- **AboutUs:**  
  Muestra la información institucional.

- **FaqList:**  
  Lista de preguntas frecuentes en formato acordeón.

- **ContactForm:**  
  Formulario de contacto con validación básica.

## Consumo de API

El frontend consume la API RESTful del backend a través de `proxy.php` para obtener:

- Servicios/productos (`/v1/products-services`)
- Información institucional (`/v1/about-us`)
- Preguntas frecuentes (`/v1/faq`)

## Tecnologías Utilizadas

- [Vue 3 (CDN)](https://vuejs.org/)
- [Bootstrap 5](https://getbootstrap.com/)
- [SwiperJS](https://swiperjs.com/) (carrusel de productos)
- HTML5, CSS3, JavaScript

## Personalización

- Las imágenes de productos deben estar en `assets/img/`.
- Los estilos personalizados están en `assets/css/main.css`.
- Puedes modificar los componentes en la carpeta `components/`.

## Notas

- El frontend está preparado para integrarse fácilmente con el backend y puede adaptarse a nuevas funcionalidades.
- Para pruebas locales, asegúrate de que el backend esté corriendo y accesible desde el navegador.

##Repositorio https://github.com/MagikarpSama/Tejelanas