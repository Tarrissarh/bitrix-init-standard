<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Page\Asset;
use \Standard\Tools;

global $USER, $APPLICATION;

$assets = [
	'js' => [
		THEME_URL_ASSETS . '/js/libs/jquery-3.4.1.min.js',
		THEME_URL_ASSETS . '/js/libs/popper-1.14.7.min.js',
		THEME_URL_ASSETS . '/js/libs/bootstrap-4.3.1.min.js',
		THEME_URL_ASSETS . '/js/main.js',
	],
	'css' => [
		THEME_URL_ASSETS . '/css/libs/bootstrap-4.3.1.min.css',
		THEME_URL_ASSETS . '/css/main.css',
	],
];

$assetsInstance = Asset::getInstance();

foreach ($assets['js'] as $js) {
	$assetsInstance->addJs($js);
}

foreach ($assets['css'] as $css) {
	$assetsInstance->addCss($css);
}

$metaTitle = (!empty($arParams['META_TITLE']) ? $arParams['META_TITLE'] : GetMessage('META_TITLE'));
$metaDescription = (!empty($arParams['META_DESCRIPTION']) ? $arParams['META_DESCRIPTION'] : GetMessage('META_DESCRIPTION'));

?>

<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID;?>">
<head>
	<?php $APPLICATION->ShowHead(); ?>
	<title><?php $APPLICATION->ShowTitle(); ?></title>

	<link rel='shortcut icon' type='image/x-icon' href='/favicon.ico'>

	<meta charset='<?=LANG_CHARSET;?>'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta property='og:image' content='<?=Tools::createUrl('/local/templates/standard/images/sharing.jpg');?>'>
	<meta property='og:type' content='website'>
	<meta property='og:title' content='<?=$APPLICATION->GetPageProperty('title', $metaTitle);?>'>
	<meta property='og:url' content='<?=Tools::getFullUrl();?>'>
	<meta property='og:description' content='<?=$APPLICATION->GetPageProperty('description', $metaDescription);?>'>

	<?php if (APP_MODE === 'prod'):// For metrics ?>
		<script type="text/javascript"></script>
	<?php endif; ?>
</head>
<body class="<?=SITE_ID;?> <?=LANGUAGE_ID;?>">
	<?php if ($USER->IsAdmin()): ?>
		<div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>
	<?php endif; ?>

	<!--[if lte IE 9]>
		<div class="alert alert-warning" role="alert">Вы используете устаревший браузер. <a href="https://browsehappy.com/" target="_blank">Обновитесь</a></div>
	<![endif]-->
