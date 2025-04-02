# 📄 CHANGELOG - CV Book

Este archivo documenta los cambios realizados por versión en el proyecto [CV Book](https://cvbook.online).

---

## [v1.1.3] - 2025-03-27
✨ Nuevas funcionalidades
Se implementó un sistema de slugs únicos legibles por humanos para reemplazar el uso de IDs en las URLs de los CVs.

Las URLs ahora son más limpias y fáciles de compartir, por ejemplo:
https://cvbook.com/cv/juan-perez-x4g7

🔧 Cambios técnicos
Se agregó el campo slug a la tabla cvs con generación automática.

El modelo CV fue actualizado para permitir la asignación masiva del campo slug.

Se modificaron las rutas (web.php) para usar {slug} en lugar de {id}.

El controlador CVController ahora busca los CVs por slug en lugar de ID.

Se actualizó la vista de índice (index.blade.php) para generar enlaces públicos usando el slug.

El formulario CvForm genera automáticamente slugs únicos en la creación.

🛡️ Seguridad y validación
Acceso validado para CVs privados: solo el dueño autenticado puede verlos, incluso con URL directa.
## [v1.1.2] - 2025-03-27

🛠 Restauración del Proyecto
Restauración del proyecto desde el servidor de producción (versión 1.1.1) a entorno local.

Nuevo repositorio: CVBookOfficial

Configuración inicial de Git y migraciones corregidas.

✅ Mejoras en CV
Se volvió a implementar el componente CvForm con los siguientes campos:

Datos personales: nombre, apellido, título, perfil, correo, teléfono, dirección, país, ciudad.

Imagen de perfil (subida y previsualización).

Habilidades (dinámicas).

Idiomas (selección múltiple).

Experiencia laboral y educación superior con campos dinámicos y validados.

Edición y creación reutilizan el mismo formulario dinámico.

Se agregó validación completa y manejo de errores.

Mejoras en la presentación del formulario (estilos, tamaños, mensajes de éxito).

🎨 Estética y diseño
Estilo mejorado para los botones de acciones en la vista Mis CVs (index.blade.php):

Botones de "Ver", "Copiar Enlace", "Editar", "Eliminar" ahora tienen el mismo ancho y alineación.

Mejora en la experiencia del usuario con animación de “Enlace copiado”.

🐞 Corrección de errores
Error de método Livewire [addSkill] not found corregido al agregar el método faltante en el componente.

Error de acceso denegado en base de datos corregido mediante edición de .env.
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

