Стандартная система для развертки проекта на базе 1C-Bitrix.

В `local/php_interface/` создать файл `env.php` со следующим содержимым (меняя на нужные значения):
```
<?php

<?php

define('APP_MODE', 'local');//test, prod
define('THEME_URL_ASSETS', '/local/templates/standard/assets');
define('LOG_FILENAME', $_SERVER['DOCUMENT_ROOT'] . '/php_interface/logs/main.log');
define('HTTPS_REDIRECT_PROD', true);// Enable https redirect on production
define('HTTPS_REDIRECT_TEST', true);// Enable https redirect on test/qa

```