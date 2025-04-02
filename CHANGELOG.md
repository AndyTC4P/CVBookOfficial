# 📄 CHANGELOG - CV Book

Este archivo documenta los cambios realizados por versión en el proyecto [CV Book](https://cvbook.online).

---

## [v1.1.0] - 2025-03-27

### 🔧 Corregido
- El checkbox "Hacer CV público" en el formulario de edición ahora refleja correctamente el estado actual del CV.
- Se solucionó el problema con la visualización de la imagen de perfil en producción: se ejecutó `php artisan storage:link` para permitir el acceso público a las imágenes subidas.

- Se corrigió un error que causaba que el modal de confirmación de eliminación se mostrara brevemente al cargar la vista de “Mis CVs”.

- ### 💄 Mejorado
- Se reemplazó el mensaje de sistema `alert()` al copiar enlace por un mensaje visual tipo toast usando AlpineJS, integrado al botón de “Copiar Enlace”.
- Se eliminó el uso del evento Livewire `copiar-enlace` en favor de una solución más directa y moderna.
- Se reemplazó el cuadro `confirm()` del navegador al eliminar un CV por un modal personalizado y estilizado con AlpineJS.
- Ahora la navegación móvil muestra correctamente las opciones:
  - 📄 Mis CVs
  - ✍️ Crear CV
  - 👤 Perfil
  - 🚪 Cerrar sesión
- Se añadió `x-init="showModal = false"` y `x-cloak` al modal para evitar que se muestre brevemente al navegar.
- Se añadió una ruta POST para `/logout` para compatibilidad con el nuevo formulario de cierre de sesión.
Vista de lista de CVs optimizada para dispositivos móviles. Los botones ahora se muestran en una cuadrícula 2x2 y se adaptan correctamente a pantallas pequeñas. (2025-03-27 11:38)




### 🔜 En proceso
- Revisión general de validaciones visuales
- Mejoras en presentación para formularios y vista del CV
---

## [v1.0.0] - 2025-03-26

### 🆕 Agregado
- Publicación inicial del sistema CV Book en producción (`cvbook.online`)
- Formulario de creación y edición de CVs con campos:
  - Nombres, Apellidos, Título/Profesión, Perfil Profesional
  - Imagen de perfil
  - Correo, Teléfono, Dirección
  - Experiencia laboral dinámica
  - Estudios superiores dinámicos
  - Checkbox de visibilidad pública del CV (`publico`)
- Subida del proyecto a servidor cPanel con PHP 8.2
- Configuración del dominio a `/cvbook_app/public`
- Soporte para assets generados por Vite (`public/build`)

