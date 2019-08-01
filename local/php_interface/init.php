<?php

$envFile = $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/env.php';

// Подключаем файл окружения
if (file_exists($envFile)) {
	require_once $envFile;
}

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

/*
 * Устанавливаем возможность локализации даты
 * Для вывода даты используем strftime(string $format, [, int $timestamp = time()]);
 * @link https://www.php.net/manual/ru/function.strftime.php
 */
if (LANGUAGE_ID === 'ru') {
	setlocale(LC_ALL, 'russian');
}

// Подключаем дополнительные скрипты
\Bitrix\Main\Loader::registerAutoLoadClasses(null, [
	\Standard\Tools::class          =>  '/local/php_interface/scripts/Tools.php',
	\Standard\SystemEvents::class   =>  '/local/php_interface/scripts/SystemEvents.php',
	\Standard\HighLoadBlock::class  =>  '/local/php_interface/scripts/HighLoadBlock.php',
	\Standard\CUserExtended::class  =>  '/local/php_interface/scripts/CUserExtended.php',

	\Standard\InfoBlock\Section::class      =>  '/local/php_interface/scripts/InfoBlock/Interface/Section.php',
	\Standard\InfoBlock\Element::class      =>  '/local/php_interface/scripts/InfoBlock/Interface/Element.php',
	\Standard\InfoBlock\InfoBlock::class    =>  '/local/php_interface/scripts/InfoBlock/Interface/InfoBlock.php',
]);

// Подключаем обработчики событий
AddEventHandler('main', 'OnBeforeProlog', [\Standard\SystemEvents::class, 'onBeforeProlog'], 10);