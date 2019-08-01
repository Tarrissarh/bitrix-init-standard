<?php

namespace Standard;

use \CUser;
use \CEvent;
use \CIBlockElement;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Main\Web\Cookie;

// Подключаем модуль инфоблока
Loader::includeModule('iblock');

class SystemEvents
{
	/**
	 * Событие перед инициализацией проекта
	 */
	public function onBeforeProlog():void
	{
		//
	}
}