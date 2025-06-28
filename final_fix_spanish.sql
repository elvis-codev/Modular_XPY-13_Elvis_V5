-- Script final para corregir el idioma español
-- Ejecutar en phpMyAdmin

-- 1. Eliminar cualquier registro duplicado o problemático
DELETE FROM `languages` WHERE `lang_code` = 'ES';
DELETE FROM `languages` WHERE `lang_code` = 'es';

-- 2. Insertar el idioma español correctamente
INSERT INTO `languages` (`lang_name`, `lang_code`, `lang_direction`, `is_default`, `status`, `created_at`, `updated_at`) VALUES
('Spanish', 'es', 'left_to_right', 'No', 1, NOW(), NOW());

-- 3. Verificar que el registro se insertó correctamente
SELECT * FROM `languages` WHERE `lang_code` = 'es';

-- 4. Limpiar caché (ejecutar después en terminal)
-- php artisan cache:clear
-- php artisan config:clear
-- php artisan view:clear