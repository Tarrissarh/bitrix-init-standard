<?php

// Определяем окружение, если оно не указан
if (!defined('APP_MODE')) {
	define('APP_MODE', 'local');
}

// Определяем URL путь к стилям, скриптам и т.д., если он не указан
if (!defined('THEME_URL_ASSETS')) {
	define('THEME_URL_ASSETS', '/local/templates/standard/assets');
}

// Определяем путь к файлу лога, если он не указан
if (!defined('LOG_FILENAME')) {
	define('LOG_FILENAME', $_SERVER['DOCUMENT_ROOT'] . '/php_interface/logs/bitrix_log_standard.log');
}

// Для тестирования корректности подключения переводов
define('BX_MESS_LOG', $_SERVER['DOCUMENT_ROOT'] . '/php_interface/logs/localization.log');