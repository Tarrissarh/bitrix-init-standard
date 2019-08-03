<?php

namespace Standard\HighLoadBlock;

use Standard\HighLoadBlock;
use \Bitrix\Main\{
	ArgumentException,
	ObjectPropertyException,
	SystemException
};

class Metrics
{
	private static $metrics;

	/**
	 * Set settings HighLoadBlock
	 * @throws ArgumentException
	 * @throws ObjectPropertyException
	 * @throws SystemException
	 */
	private static function setSettings():void
	{
		self::$metrics = new HighLoadBlock('Metrics');
	}


	/**
	 * Get all metrics
	 * @return array
	 * @throws ArgumentException
	 * @throws ObjectPropertyException
	 * @throws SystemException
	 */
	public static function getAll():array
	{
		self::setSettings();

		return self::$metrics->get([
			'filter' => [
				'=UF_SITE_ID'   =>  SITE_ID,
				'=UF_ACTIVE'    =>  true,
			]
		], false);
	}

	/**
	 * Get metric script by name
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
		$setting = self::$metrics->get([
			'filter' => [
				'=UF_NAME'      =>  $name,
				'=UF_SITE_ID'   =>  SITE_ID,
				'=UF_ACTIVE'    =>  true,
			]
		]);

		if (!empty($setting)) {
			$value = $setting['UF_VALUE'];
		}

		return $value;
	}
}