-- Script para configurar español como idioma por defecto manteniendo sistema translate.
-- Ejecutar este script en la base de datos del LMS

-- 1. Verificar idiomas existentes
SELECT * FROM `languages`;

-- 2. Insertar idioma español si no existe (con ID 2)
INSERT IGNORE INTO `languages` (`id`, `lang_name`, `lang_code`, `lang_direction`, `is_default`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Español', 'es', 'left_to_right', 'No', 1, NOW(), NOW());

-- 3. Cambiar inglés para que no sea por defecto
UPDATE `languages` SET `is_default` = 'No' WHERE `lang_code` = 'en';

-- 4. Configurar español como idioma por defecto
UPDATE `languages` SET `is_default` = 'Yes' WHERE `lang_code` = 'es';

-- 5. Verificar los cambios
SELECT `id`, `lang_name`, `lang_code`, `is_default`, `status` FROM `languages`;

-- IMPORTANTE: 
-- Después de ejecutar este script, el sistema usará el archivo /lang/es/translate.php
-- que ya contiene todas las traducciones al español.