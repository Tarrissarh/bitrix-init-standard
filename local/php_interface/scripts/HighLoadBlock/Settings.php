<?php

namespace Standard\HighLoadBlock;

use Standard\HighLoadBlock;
use \Bitrix\Main\{
	ArgumentException,
	ObjectPropertyException,
	SystemException
};

class Settings
{
	private static $settings;

	/**
	 * Set settings HighLoadBlock
	 * @throws ArgumentException
	 * @throws ObjectPropertyException
	 * @throws SystemException
	 */
	private static function setSettings():void
	{
		self::$settings = new HighLoadBlock('Settings');
	}


	/**
	 * Get all settings
	 * @return array
	 * @throws ArgumentException
	 * @throws ObjectPropertyException
	 * @throws SystemException
	 */
	public static function getAll():array
	{
		self::setSettings();

		return self::$settings->get([
			'filter' => [
				'=UF_SITE_ID' => SITE_ID
			]
		], false);
	}

	/**
	 * Get setting value by name
	 * @param string $name
	 * @return string
	 * @throws ArgumentException
	 * @throws ObjectPropertyException
	 * @throws SystemException
	 */
	public static function getValueByName(string $name):string
	{
		self::setSettings();

		$value = '';
		$setting = self::$settings->get([
			'filter' => [
				'=UF_NAME' => $name,
				'=UF_SITE_ID' => SITE_ID
			]
		]);

		if (!empty($setting)) {
			$value = $setting['UF_VALUE'];
		}

		return $value;
	}
}