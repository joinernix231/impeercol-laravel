#!/bin/bash

# Script de instalación automática para Impeercol Laravel
# Uso: bash install.sh

echo "🚀 Iniciando instalación de Impeercol Laravel..."
echo ""

# Colores para output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Función para verificar si un comando existe
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Verificar requisitos
echo "📋 Verificando requisitos previos..."
echo ""

if ! command_exists php; then
    echo -e "${RED}❌ PHP no está instalado. Por favor instálalo primero.${NC}"
    exit 1
fi

PHP_VERSION=$(php -r 'echo PHP_VERSION;' | cut -d. -f1,2)
if (( $(echo "$PHP_VERSION < 8.2" | bc -l) )); then
    echo -e "${RED}❌ Se requiere PHP 8.2 o superior. Versión actual: $PHP_VERSION${NC}"
    exit 1
fi

echo -e "${GREEN}✅ PHP encontrado: $(php -v | head -n 1)${NC}"

if ! command_exists composer; then
    echo -e "${RED}❌ Composer no está instalado. Por favor instálalo primero.${NC}"
    exit 1
fi

echo -e "${GREEN}✅ Composer encontrado: $(composer --version | head -n 1)${NC}"

if ! command_exists npm; then
    echo -e "${YELLOW}⚠️  NPM no está instalado. Los assets frontend no se compilarán.${NC}"
fi

echo ""
echo "📦 Instalando dependencias de PHP..."
composer install

if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Error al instalar dependencias de Composer${NC}"
    exit 1
fi

echo -e "${GREEN}✅ Dependencias de PHP instaladas${NC}"
echo ""

# Configurar .env
if [ ! -f .env ]; then
    echo "⚙️  Configurando archivo .env..."
    cp .env.example .env
    php artisan key:generate
    echo -e "${GREEN}✅ Archivo .env creado${NC}"
    echo -e "${YELLOW}⚠️  IMPORTANTE: Edita el archivo .env y configura tu base de datos antes de continuar${NC}"
    echo ""
    read -p "¿Has configurado la base de datos en .env? (s/n): " -n 1 -r
    echo ""
    if [[ ! $REPLY =~ ^[Ss]$ ]]; then
        echo -e "${YELLOW}⏸️  Instalación pausada. Configura .env y ejecuta este script de nuevo.${NC}"
        exit 0
    fi
else
    echo -e "${GREEN}✅ Archivo .env ya existe${NC}"
fi

echo ""
echo "🗄️  Ejecutando migraciones..."
php artisan migrate

if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Error al ejecutar migraciones. Verifica tu configuración de base de datos.${NC}"
    exit 1
fi

echo -e "${GREEN}✅ Migraciones ejecutadas${NC}"
echo ""

# CRÍTICO: Crear enlace de storage
echo "🔗 Creando enlace simbólico de storage..."
if [ -L "public/storage" ] || [ -d "public/storage" ]; then
    echo -e "${YELLOW}⚠️  El enlace de storage ya existe. Eliminándolo...${NC}"
    rm -rf public/storage
fi

php artisan storage:link

if [ $? -eq 0 ]; then
    if [ -L "public/storage" ] || [ -d "public/storage" ]; then
        echo -e "${GREEN}✅ Enlace de storage creado correctamente${NC}"
    else
        echo -e "${RED}❌ Error: El enlace de storage no se creó correctamente${NC}"
        exit 1
    fi
else
    echo -e "${RED}❌ Error al crear el enlace de storage${NC}"
    exit 1
fi

echo ""

# Configurar permisos (solo Linux/Mac)
if [[ "$OSTYPE" != "msys" && "$OSTYPE" != "win32" ]]; then
    echo "🔐 Configurando permisos..."
    chmod -R 775 storage
    chmod -R 775 bootstrap/cache
    echo -e "${GREEN}✅ Permisos configurados${NC}"
    echo ""
fi

# Instalar dependencias de Node.js
if command_exists npm; then
    echo "📦 Instalando dependencias de Node.js..."
    npm install
    
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✅ Dependencias de Node.js instaladas${NC}"
        echo ""
        echo "🔨 Compilando assets..."
        npm run dev
        if [ $? -eq 0 ]; then
            echo -e "${GREEN}✅ Assets compilados${NC}"
        fi
    fi
    echo ""
fi

# Limpiar caché
echo "🧹 Limpiando caché..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
echo -e "${GREEN}✅ Caché limpiado${NC}"
echo ""

echo -e "${GREEN}═══════════════════════════════════════════════════════════${NC}"
echo -e "${GREEN}✅ ¡Instalación completada exitosamente!${NC}"
echo -e "${GREEN}═══════════════════════════════════════════════════════════${NC}"
echo ""
echo "📝 Próximos pasos:"
echo ""
echo "1. Verifica que el enlace de storage existe:"
echo "   ls -la public/storage"
echo ""
echo "2. Inicia el servidor de desarrollo:"
echo "   php artisan serve"
echo ""
echo "3. Abre tu navegador en: http://localhost:8000"
echo ""
echo "4. Prueba subir una imagen para verificar que todo funciona"
echo ""
echo -e "${YELLOW}⚠️  RECUERDA: Si cambias de servidor o clonas de nuevo, ejecuta:${NC}"
echo -e "${YELLOW}   php artisan storage:link${NC}"
echo ""

