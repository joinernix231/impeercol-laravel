# 📄 Instrucciones para Convertir el Informe a PDF o Word

## Opción 1: Convertir HTML a PDF (Recomendado)

### Método A: Usando el Navegador (Más Fácil)
1. Abra el archivo `INFORME_ENTREGA_PROYECTO.html` en cualquier navegador (Chrome, Firefox, Edge, etc.)
2. Presione `Ctrl + P` (o `Cmd + P` en Mac) para abrir el diálogo de impresión
3. Seleccione "Guardar como PDF" como destino
4. Ajuste los márgenes si es necesario
5. Haga clic en "Guardar"

### Método B: Usando Herramientas Online
- Suba el archivo HTML a: https://www.ilovepdf.com/html-to-pdf
- O use: https://www.freeconvert.com/html-to-pdf

## Opción 2: Convertir Markdown a Word

### Método A: Usando Word Directamente
1. Abra Microsoft Word
2. Vaya a "Archivo" > "Abrir"
3. Seleccione el archivo `INFORME_ENTREGA_PROYECTO.md`
4. Word lo convertirá automáticamente
5. Guarde como `.docx`

### Método B: Usando Pandoc (Si está instalado)
```bash
pandoc INFORME_ENTREGA_PROYECTO.md -o INFORME_ENTREGA_PROYECTO.docx
```

### Método C: Usando Herramientas Online
- https://www.markdowntoword.com/
- https://cloudconvert.com/md-to-docx

## Opción 3: Convertir Markdown a PDF

### Método A: Usando Pandoc
```bash
pandoc INFORME_ENTREGA_PROYECTO.md -o INFORME_ENTREGA_PROYECTO.pdf
```

### Método B: Usando Herramientas Online
- https://www.markdowntopdf.com/
- https://cloudconvert.com/md-to-pdf

## Recomendación

**Para PDF:** Use el archivo HTML (`INFORME_ENTREGA_PROYECTO.html`) y el método del navegador. Es el más rápido y mantiene el formato perfecto.

**Para Word:** Use el archivo Markdown (`INFORME_ENTREGA_PROYECTO.md`) y ábralo directamente en Microsoft Word.

