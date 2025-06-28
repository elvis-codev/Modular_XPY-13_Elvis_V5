-- Script para solucionar el problema del idioma español
-- Ejecutar este script en phpMyAdmin o desde línea de comandos MySQL

-- 1. Primero verificar los idiomas existentes
SELECT id, lang_name, lang_code, lang_direction, is_default, status, created_at, updated_at FROM languages;

-- 2. Eliminar cualquier registro duplicado de español si existe
DELETE FROM languages WHERE lang_code = 'es';
DELETE FROM languages WHERE lang_code = 'ES';

-- 3. Insertar el idioma español correctamente
INSERT INTO languages (lang_name, lang_code, lang_direction, is_default, status, created_at, updated_at) 
VALUES ('Spanish', 'es', 'left_to_right', 'No', 1, NOW(), NOW());

-- 4. Verificar que el idioma se insertó correctamente
SELECT id, lang_name, lang_code, lang_direction, is_default, status FROM languages WHERE lang_code = 'es';

-- 5. Verificar todos los idiomas activos
SELECT id, lang_name, lang_code, status FROM languages WHERE status = 1;