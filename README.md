# Impeercol Laravel - Sistema de Gestión

Sistema de gestión web desarrollado con Laravel 11 para la administración de proyectos, productos y categorías.

## 📋 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- **PHP 8.2 o superior**
- **Composer** (gestor de dependencias de PHP)
- **Node.js y NPM** (para assets frontend)
- **Base de datos** (MySQL, PostgreSQL, SQLite, etc.)
- **Git** (para clonar el repositorio)

## 🚀 Instalación Paso a Paso

### 1. Clonar el Repositorio

```bash
git clone <url-del-repositorio>
cd impeercol-laravel
```

### 2. Instalar Dependencias de PHP

```bash
composer install
```

### 3. Configurar Variables de Entorno

```bash
# Copiar el archivo de ejemplo
cp .env.example .env

# Generar la clave de aplicación
php artisan key:generate
```

### 4. Configurar la Base de Datos

Edita el archivo `.env` y configura tu base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 5. Ejecutar Migraciones y Seeders

```bash
# Ejecutar migraciones
php artisan migrate

# (Opcional) Ejecutar seeders para datos de prueba
php artisan db:seed
```

### 6. ⚠️ CREAR ENLACE SIMBÓLICO DE STORAGE (CRÍTICO)

**Este paso es OBLIGATORIO** para que las imágenes y archivos se carguen correctamente. Sin este paso, verás el error:

> "No se pudo cargar la imagen. Verifica que la ruta sea correcta"

```bash
php artisan storage:link
```

Este comando crea un enlace simbólico desde `public/storage` hacia `storage/app/public`, permitiendo que los archivos almacenados sean accesibles públicamente.

**Verificación:**
Después de ejecutar el comando, verifica que existe el enlace:
- En Windows: Debe existir la carpeta `public/storage`
- En Linux/Mac: `ls -la public/storage` debe mostrar el enlace simbólico

### 7. Configurar Permisos (Solo Linux/Mac)

Si estás en Linux o Mac, asegúrate de que las carpetas tengan los permisos correctos:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 8. Instalar Dependencias de Node.js

```bash
npm install
```

### 9. Compilar Assets (Desarrollo)

```bash
npm run dev
```

O para producción:

```bash
npm run build
```

### 10. Iniciar el Servidor de Desarrollo

```bash
php artisan serve
```

El proyecto estará disponible en: `http://localhost:8000`

## 🔧 Solución de Problemas Comunes

### Error: "No se pudo cargar la imagen. Verifica que la ruta sea correcta"

**Causa:** No se ha ejecutado `php artisan storage:link` o el enlace se ha roto.

**Solución:**

1. Elimina el enlace existente (si existe):
   ```bash
   # Windows (Git Bash o PowerShell)
   rm public/storage
   
   # Linux/Mac
   rm public/storage
   ```

2. Crea el enlace nuevamente:
   ```bash
   php artisan storage:link
   ```

3. Verifica que el enlace existe:
   - Debe existir la carpeta `public/storage`
   - Debe apuntar a `storage/app/public`

### Error: "The stream or file could not be opened"

**Causa:** Permisos incorrectos en las carpetas de storage.

**Solución (Linux/Mac):**
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Error: "Class not found" o errores de autoload

**Solución:**
```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

### Error: "SQLSTATE[HY000] [2002] No connection could be made"

**Causa:** La base de datos no está configurada correctamente o el servidor no está corriendo.

**Solución:**
1. Verifica que tu servidor de base de datos esté corriendo
2. Revisa la configuración en `.env`
3. Prueba la conexión manualmente

## 📁 Estructura de Almacenamiento de Archivos

El proyecto almacena archivos en las siguientes ubicaciones:

```
storage/app/public/
├── projects/
│   ├── images/          # Imágenes de proyectos
│   └── documents/       # Documentos de proyectos
├── products/            # Imágenes de productos
└── categories/          # Imágenes de categorías
```

Los archivos se acceden públicamente mediante:
- `/storage/projects/images/...`
- `/storage/products/...`
- `/storage/categories/...`

**Importante:** Estos archivos solo son accesibles si el enlace simbólico está creado (`php artisan storage:link`).

## 🗄️ Base de Datos

### Tablas Principales

- `users` - Usuarios del sistema
- `projects` - Proyectos
- `products` - Productos
- `product_variants` - Variantes de productos
- `categories` - Categorías

### Seeders Disponibles

```bash
# Ejecutar todos los seeders
php artisan db:seed

# Ejecutar un seeder específico
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=ProjectSeeder
```

## 🔐 Autenticación

El sistema incluye autenticación de usuarios. Para crear un usuario administrador, puedes:

1. Usar un seeder personalizado
2. Crearlo manualmente desde la base de datos
3. Usar Tinker:
   ```bash
   php artisan tinker
   ```
   ```php
   User::create([
       'name' => 'Admin',
       'email' => 'admin@example.com',
       'password' => bcrypt('password'),
       'role' => 'admin'
   ]);
   ```

## 🛠️ Comandos Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Optimizar aplicación
php artisan optimize

# Ver rutas disponibles
php artisan route:list

# Ejecutar migraciones
php artisan migrate
php artisan migrate:fresh  # Elimina y recrea todas las tablas
php artisan migrate:rollback  # Revierte la última migración

# Acceder a Tinker (consola interactiva)
php artisan tinker
```

## 📝 Notas Importantes

1. **Storage Link:** Siempre ejecuta `php artisan storage:link` después de clonar o actualizar el proyecto.

2. **Variables de Entorno:** Nunca subas el archivo `.env` al repositorio. Usa `.env.example` como referencia.

3. **Permisos:** En servidores Linux/Mac, asegúrate de configurar los permisos correctos para `storage` y `bootstrap/cache`.

4. **Base de Datos:** Si cambias la estructura de la base de datos, crea una migración en lugar de modificar directamente.

## 👥 Contribución

Para contribuir al proyecto:

1. Crea una rama nueva para tu feature
2. Realiza tus cambios
3. Asegúrate de que todo funcione correctamente
4. Crea un Pull Request

## 📞 Soporte

Si encuentras algún problema durante la instalación o el uso del sistema, verifica:

1. ✅ Que todos los requisitos previos estén instalados
2. ✅ Que el archivo `.env` esté configurado correctamente
3. ✅ Que el enlace simbólico de storage esté creado (`php artisan storage:link`)
4. ✅ Que los permisos de las carpetas sean correctos (Linux/Mac)
5. ✅ Que la base de datos esté corriendo y accesible

## 📄 Licencia

Este proyecto es privado y de uso exclusivo para Impeercol.

---

**Última actualización:** 2025
