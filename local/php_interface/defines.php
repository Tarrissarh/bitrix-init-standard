<?php

// Определяем окружение, если оно не указан
if (!defined('APP_MODE')) {
	define('APP_MODE', 'local');//test, prod
}

// Определяем URL путь к стилям, скриптам и т.д., если он не указан
if (!defined('THEME_URL_ASSETS')) {
	define('THEME_URL_ASSETS', '/local/templates/standard/assets');
}

// Определяем путь к файлу лога, если он не указан
if (!defined('LOG_FILENAME')) {
	define('LOG_FILENAME', $_SERVER['DOCUMENT_ROOT'] . '/php_interface/logs/main.log');
}

// Включить редирект на https для боевого сервереа
if (!defined('HTTPS_REDIRECT_PROD')) {
    define('HTTPS_REDIRECT_PROD', true);
}

// Включить редирект на https для тестового сервера
if (!defined('HTTPS_REDIRECT_TEST')) {
    define('HTTPS_REDIRECT_TEST', true);
}

// Для тестирования корректности подключения переводов
define('BX_MESS_LOG', $_SERVER['DOCUMENT_ROOT'] . '/php_interface/logs/localization.log');