В `local/php_interface/` создать файл `env.php` со следующим содержимым (меняя на нунжные значения):
```
<?php

$constants = [
    'APP_MODE'          =>  'local',//test, prod
    'THEME_URL_ASSETS'  =>  '/local/templates/standard/assets',
    'LOG_FILENAME'      =>  $_SERVER['DOCUMENT_ROOT'] . '/php_interface/logs/bitrix_log_standard.log'
];

foreach ($constants as $key => $value) {
    define($key, $value);
}

```