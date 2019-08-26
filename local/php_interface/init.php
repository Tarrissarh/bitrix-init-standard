<?php

$phpInterfacePath   =   $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/';
$envFile            =   $phpInterfacePath . 'env.php';
$definesFile        =   $phpInterfacePath . 'defines.php';

// Подключаем файл окружения
if (file_exists($envFile)) {
	require_once $envFile;
}

// Подключаем файл констант
if (file_exists($definesFile)) {
	require_once $definesFile;
}

/*
 * Устанавливаем возможность локализации даты
 * Для вывода даты нужно использовать strftime(string $format, [, int $timestamp = time()]);
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

	\Standard\HighLoadBlock\Settings::class =>  '/local/php_interface/scripts/InfoBlock/HighLoadBlock/Settings.php',
	\Standard\HighLoadBlock\Metrics::class  =>  '/local/php_interface/scripts/InfoBlock/HighLoadBlock/Metrics.php',
]);

// Подключаем обработчики событий
AddEventHandler('main', 'OnBeforeProlog', [\Standard\SystemEvents::class, 'onBeforeProlog'], 10);