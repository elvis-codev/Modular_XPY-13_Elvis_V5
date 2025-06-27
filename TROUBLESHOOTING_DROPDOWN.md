# Solución: No se ve el dropdown "Content Type"

## 🔍 Problemas Posibles y Soluciones:

### 1. **Caché de Laravel (MÁS PROBABLE)**
```bash
# Limpiar todas las cachés
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# O limpiar todo de una vez
php artisan optimize:clear
```

### 2. **Verificar que la migración se ejecutó**
```bash
# Verificar si la columna embed_url existe
php artisan tinker
# Luego ejecutar:
Schema::hasColumn('course_module_lessons', 'embed_url')
# Debe devolver: true
```

### 3. **Verificar la ruta del archivo**
Asegúrate de estar editando lecciones en la ruta del instructor:
- ✅ **Correcto**: `/instructor/course-lesson/{course_id}/{module_id}`
- ❌ **Incorrecto**: `/admin/course-lesson/...` (tiene su propio archivo)

### 4. **Hard Refresh del navegador**
- **Ctrl + F5** (Windows)
- **Cmd + Shift + R** (Mac)
- O abrir en **ventana incógnita**

### 5. **Verificar consola del navegador**
- Presiona **F12** → **Console**
- Busca errores JavaScript que impidan cargar el dropdown

### 6. **Verificar que el módulo Course esté activo**
```bash
php artisan module:list
# Course debe estar "Enabled"
```

## 🎯 Solución Rápida:
1. **Ejecuta**: `php artisan optimize:clear`
2. **Hard refresh** del navegador (Ctrl+F5)
3. Ve a **Manage Course → Lesson List → Edit Lesson**

## 📍 ¿Dónde debe aparecer?
El dropdown "Content Type" debe aparecer:
- **ANTES** del campo "Video Source"
- En el modal "Edit Lesson"
- En el modal "Add Lesson"

## 🔧 Si aún no funciona:
Ejecuta este comando para verificar la estructura:
```bash
php artisan tinker
DB::select("DESCRIBE course_module_lessons");
```
Debe mostrar la columna `embed_url`.