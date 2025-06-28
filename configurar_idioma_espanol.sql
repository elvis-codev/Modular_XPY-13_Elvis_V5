-- Script para configurar español como idioma por defecto
-- Ejecutar este script en la base de datos del LMS

-- 1. Insertar idioma español si no existe
INSERT IGNORE INTO `languages` (`id`, `lang_name`, `lang_code`, `lang_direction`, `is_default`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Español', 'es', 'left_to_right', 'No', 1, NOW(), NOW());

-- 2. Cambiar el inglés para que no sea por defecto
UPDATE `languages` SET `is_default` = 'No' WHERE `lang_code` = 'en';

-- 3. Configurar español como idioma por defecto
UPDATE `languages` SET `is_default` = 'Yes' WHERE `lang_code` = 'es';

-- 4. Verificar los cambios
SELECT * FROM `languages`;