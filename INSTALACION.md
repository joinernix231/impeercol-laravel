# 📖 Guía de Instalación Rápida - Impeercol Laravel

Esta guía te ayudará a instalar el proyecto paso a paso y evitar el error común de carga de imágenes.

## ⚡ Instalación Rápida (5 minutos)

### Paso 1: Clonar e Instalar

```bash
# 1. Clonar el repositorio
git clone <url-del-repositorio>
cd impeercol-laravel

# 2. Instalar dependencias PHP
composer install

# 3. Configurar entorno
cp .env.example .env
php artisan key:generate
```

### Paso 2: Configurar Base de Datos

Edita `.env` y configura tu base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

Luego ejecuta:

```bash
php artisan migrate
```

### Paso 3: ⚠️ CREAR ENLACE DE STORAGE (OBLIGATORIO)

**Este es el paso más importante.** Sin esto, las imágenes NO funcionarán:

```bash
php artisan storage:link
```

✅ **Verificación:** Debe existir la carpeta `public/storage`

### Paso 4: Instalar y Compilar Assets

```bash
npm install
npm run dev
```

### Paso 5: Iniciar Servidor

```bash
php artisan serve
```

¡Listo! El proyecto está en `http://localhost:8000`

---

## 🚨 Error: "No se pudo cargar la imagen"

### Síntomas
- Al subir una imagen aparece: "No se pudo cargar la imagen. Verifica que la ruta sea correcta"
- Las imágenes no se muestran en el sitio
- Error 404 al intentar acceder a `/storage/...`

### Solución

**1. Verifica que el enlace existe:**

```bash
# Windows
dir public\storage

# Linux/Mac
ls -la public/storage
```

**2. Si NO existe, créalo:**

```bash
php artisan storage:link
```

**3. Si existe pero está roto, elimínalo y créalo de nuevo:**

```bash
# Eliminar enlace roto
rm public/storage  # o rmdir public\storage en Windows

# Crear nuevo enlace
php artisan storage:link
```

**4. Verifica permisos (solo Linux/Mac):**

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

**5. Limpia caché:**

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## 📋 Checklist de Instalación

Marca cada paso cuando lo completes:

- [ ] Clonado el repositorio
- [ ] Ejecutado `composer install`
- [ ] Creado y configurado archivo `.env`
- [ ] Ejecutado `php artisan key:generate`
- [ ] Configurada la base de datos en `.env`
- [ ] Ejecutado `php artisan migrate`
- [ ] **Ejecutado `php artisan storage:link`** ⚠️
- [ ] Verificado que existe `public/storage`
- [ ] Ejecutado `npm install`
- [ ] Ejecutado `npm run dev`
- [ ] Iniciado servidor con `php artisan serve`
- [ ] Probado subir una imagen (debe funcionar)

---

## 🔍 Verificación Final

Después de la instalación, verifica:

1. **Enlace de Storage:**
   ```bash
   # Debe existir esta carpeta
   ls public/storage
   ```

2. **Base de Datos:**
   ```bash
   php artisan migrate:status
   ```

3. **Servidor:**
   - Abre `http://localhost:8000`
   - Debe cargar sin errores

4. **Subida de Imágenes:**
   - Intenta subir una imagen en el panel admin
   - Debe funcionar sin errores

---

## 💡 Tips

- **Siempre ejecuta `storage:link`** después de clonar o actualizar el proyecto
- Si cambias de servidor, recuerda ejecutar `storage:link` de nuevo
- En Windows, el enlace funciona igual que en Linux/Mac
- Si tienes problemas, limpia la caché: `php artisan cache:clear`

---

## 🆘 ¿Necesitas Ayuda?

Si después de seguir estos pasos sigues teniendo problemas:

1. Verifica que PHP 8.2+ esté instalado: `php -v`
2. Verifica que Composer esté instalado: `composer -v`
3. Revisa los logs: `storage/logs/laravel.log`
4. Verifica que el servidor de base de datos esté corriendo

---

**Recuerda:** El comando `php artisan storage:link` es **OBLIGATORIO** para que las imágenes funcionen.

