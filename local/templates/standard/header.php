<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Page\Asset;

$assets = [
	'js' => [
		THEME_URL_ASSETS . '/js/jquery-3.4.1.min.js',
		THEME_URL_ASSETS . '/js/main.js',
	],
	'css' => [
		THEME_URL_ASSETS . '/css/main.css',
	],
	'string' => [
		"<link rel='shortcut icon' type='image/x-icon' href='/favicon.ico'>",
		"<link href='https://fonts.googleapis.com/css?family=PT+Sans:400&subset=cyrillic' rel='stylesheet' type='text/css'>",
		"<meta charset='" . LANG_CHARSET . "'>",
	]
];

$assetsInstance = Asset::getInstance();

foreach ($assets['js'] as $js) {
	$assetsInstance->addJs($js);
}

foreach ($assets['css'] as $css) {
	$assetsInstance->addCss($css);
}

foreach ($assets['string'] as $string) {
	$assetsInstance->addString($string);
}

?>

<!DOCTYPE html>
<html>
<head>
	<?php $APPLICATION->ShowHead(); ?>
	<title><?php $APPLICATION->ShowTitle(); ?></title>
</head>
<body>
	<?php if ($USER->IsAdmin()): ?>
		<div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>
	<?php endif; ?>