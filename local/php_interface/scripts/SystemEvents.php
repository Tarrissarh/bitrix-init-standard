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
		//
	}
}