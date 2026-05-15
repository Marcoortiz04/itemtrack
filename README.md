# ItemTrack - Sistema de Gestión de Inventario

Este proyecto es una aplicación web Full-Stack diseñada para la gestión de productos en tiempo real. 

## 🚀 Demo en Vivo
Puedes ver la aplicación funcionando aquí: http://itemtrack-marco.xo.je

## 🛠️ Tecnologías utilizadas
- **Frontend:** HTML5, JavaScript (ES6) y Bootstrap 5.
- **Backend:** PHP 8.x.
- **Base de Datos:** MySQL.
- **Hosting:** InfinityFree (Cloud Hosting).

## 🔒 Seguridad y Acceso
El panel de administración está protegido mediante sesiones de PHP.
- **Usuario:** admin
- **Password:** admin1234

## ✅ Tests de Calidad y Seguridad
Para asegurar el correcto funcionamiento de la aplicación, se han realizado los siguientes tests:

1. **Test de Control de Acceso (Seguridad):** Se intentó acceder directamente a `admin.php` sin iniciar sesión. El sistema verificó la ausencia de la variable de sesión y redirigió correctamente al usuario a `login.php`.
2. **Test de Integridad de Datos (CRUD):** Se comprobó que al eliminar un producto, este desaparece tanto de la vista de administrador como de la base de datos MySQL.
3. **Test de Interfaz (UI):** Se verificó que el buscador dinámico filtra correctamente los productos en tiempo real sin necesidad de recargar la página.
