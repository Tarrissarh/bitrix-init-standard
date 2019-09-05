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

	\Standard\InfoBlock\Interfaces\Section::class   =>  '/local/php_interface/scripts/InfoBlock/Interfaces/Section.php',
	\Standard\InfoBlock\Interfaces\Element::class   =>  '/local/php_interface/scripts/InfoBlock/Interfaces/Element.php',
	\Standard\InfoBlock\Interfaces\InfoBlock::class =>  '/local/php_interface/scripts/InfoBlock/Interfaces/InfoBlock.php',

    \Standard\InfoBlock\Abstracts\Section::class    =>  '/local/php_interface/scripts/InfoBlock/Abstracts/Section.php',
    \Standard\InfoBlock\Abstracts\Element::class    =>  '/local/php_interface/scripts/InfoBlock/Abstracts/Element.php',
    \Standard\InfoBlock\Abstracts\InfoBlock::class  =>  '/local/php_interface/scripts/InfoBlock/Abstracts/InfoBlock.php',

	\Standard\HighLoadBlock\Interfaces\SimpleHighLoadBlock::class   =>  '/local/php_interface/scripts/InfoBlock/HighLoadBlock/Interfaces/SimpleHighLoadBlock.php',
	\Standard\HighLoadBlock\Abstracts\SimpleHighLoadBlock::class    =>  '/local/php_interface/scripts/InfoBlock/HighLoadBlock/Abstracts/SimpleHighLoadBlock.php',
	\Standard\HighLoadBlock\Settings::class                         =>  '/local/php_interface/scripts/InfoBlock/HighLoadBlock/Settings.php',
	\Standard\HighLoadBlock\Metrics::class                          =>  '/local/php_interface/scripts/InfoBlock/HighLoadBlock/Metrics.php',
]);

// Подключаем обработчики событий
AddEventHandler('main', 'OnBeforeProlog', [\Standard\SystemEvents::class, 'onBeforeProlog'], 1);