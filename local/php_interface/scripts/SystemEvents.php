<?php

namespace Standard;

use \CUser;
use \CEvent;
use \Bitrix\Main\{
	Loader,
	Application,
	Web\Cookie,
	Localization\Loc
};

Loc::loadMessages(__FILE__);

// Подключаем модуль инфоблока
Loader::includeModule('iblock');

class SystemEvents
{
	/**
	 * Событие перед инициализацией проекта
	 */
	public function onBeforeProlog():void
	{
        // Redirect to HTTPS
        if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
            $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

            if ((HTTPS_REDIRECT_PROD && Tools::isProd()) || (HTTPS_REDIRECT_TEST && Tools::isTest())) {
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: ' . $location);

                exit;
            }
        }
	}
}