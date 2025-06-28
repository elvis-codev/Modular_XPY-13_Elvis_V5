-- Script para configurar el idioma correctamente
-- El código del idioma sigue siendo 'en' pero el contenido está en español

-- 1. Actualizar la información del idioma inglés para que se muestre como "Español"
UPDATE `languages` SET 
    `lang_name` = 'Español',
    `is_default` = 'Yes',
    `status` = 1
WHERE `lang_code` = 'en';

-- 2. Si existe un idioma español separado, desactivarlo para evitar conflictos
UPDATE `languages` SET 
    `is_default` = 'No',
    `status` = 0
WHERE `lang_code` = 'es';

-- 3. Verificar el resultado
SELECT `id`, `lang_name`, `lang_code`, `is_default`, `status` FROM `languages`;

-- Nota: Los archivos de traducción en /lang/en/ ya contienen todas las traducciones en español
-- Por lo tanto, el sistema seguirá usando el código 'en' pero mostrará contenido en español