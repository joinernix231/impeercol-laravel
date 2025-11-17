@echo off
REM Script de instalación automática para Impeercol Laravel (Windows)
REM Uso: install.bat

echo.
echo ========================================
echo Instalacion de Impeercol Laravel
echo ========================================
echo.

REM Verificar PHP
where php >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] PHP no esta instalado. Por favor instalalo primero.
    pause
    exit /b 1
)
echo [OK] PHP encontrado
php -v | findstr /C:"PHP"
echo.

REM Verificar Composer
where composer >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Composer no esta instalado. Por favor instalalo primero.
    pause
    exit /b 1
)
echo [OK] Composer encontrado
composer --version
echo.

echo [1/7] Instalando dependencias de PHP...
composer install
if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Error al instalar dependencias de Composer
    pause
    exit /b 1
)
echo [OK] Dependencias de PHP instaladas
echo.

REM Configurar .env
if not exist .env (
    echo [2/7] Configurando archivo .env...
    copy .env.example .env
    php artisan key:generate
    echo [OK] Archivo .env creado
    echo.
    echo [IMPORTANTE] Edita el archivo .env y configura tu base de datos
    echo.
    pause
) else (
    echo [OK] Archivo .env ya existe
)
echo.

echo [3/7] Ejecutando migraciones...
php artisan migrate
if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Error al ejecutar migraciones. Verifica tu configuracion de base de datos.
    pause
    exit /b 1
)
echo [OK] Migraciones ejecutadas
echo.

REM CRITICO: Crear enlace de storage
echo [4/7] Creando enlace simbólico de storage (CRITICO)...
if exist "public\storage" (
    echo [AVISO] El enlace de storage ya existe. Eliminándolo...
    rmdir /s /q "public\storage"
)

php artisan storage:link
if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Error al crear el enlace de storage
    pause
    exit /b 1
)

if exist "public\storage" (
    echo [OK] Enlace de storage creado correctamente
) else (
    echo [ERROR] El enlace de storage no se creo correctamente
    pause
    exit /b 1
)
echo.

REM Instalar dependencias de Node.js
where npm >nul 2>nul
if %ERRORLEVEL% EQU 0 (
    echo [5/7] Instalando dependencias de Node.js...
    call npm install
    if %ERRORLEVEL% EQU 0 (
        echo [OK] Dependencias de Node.js instaladas
        echo.
        echo [6/7] Compilando assets...
        call npm run dev
        if %ERRORLEVEL% EQU 0 (
            echo [OK] Assets compilados
        )
    )
) else (
    echo [AVISO] NPM no esta instalado. Los assets frontend no se compilaran.
)
echo.

REM Limpiar cache
echo [7/7] Limpiando cache...
php artisan config:clear
php artisan cache:clear
php artisan view:clear
echo [OK] Cache limpiado
echo.

echo ========================================
echo [OK] Instalacion completada exitosamente!
echo ========================================
echo.
echo Proximos pasos:
echo.
echo 1. Verifica que el enlace de storage existe:
echo    dir public\storage
echo.
echo 2. Inicia el servidor de desarrollo:
echo    php artisan serve
echo.
echo 3. Abre tu navegador en: http://localhost:8000
echo.
echo 4. Prueba subir una imagen para verificar que todo funciona
echo.
echo [RECUERDA] Si cambias de servidor o clonas de nuevo, ejecuta:
echo    php artisan storage:link
echo.
pause

