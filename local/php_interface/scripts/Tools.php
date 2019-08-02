<?php

namespace Standard;

use \CIBlock;
use \Bitrix\Main\{
	Type\DateTime,
	Application,
	Web\Cookie,
	SystemException,
	Loader,
    Localization\Loc
};

Loc::loadMessages(__FILE__);

// Подключаем модуль инфоблока
Loader::includeModule('iblock');

class Tools
{
	/**
	 * Local env
	 * @return bool
	 */
	public static function isLocal():bool
	{
		return APP_MODE === 'local';
	}

	/**
	 * Prod env
	 * @return bool
	 */
	public static function isProd():bool
	{
		return APP_MODE === 'prod';
	}

	/**
	 * Test env
	 * @return bool
	 */
	public static function isTest():bool
	{
		return APP_MODE === 'test';
	}

    /**
     * Dev env
     * @return bool
     */
    public static function isDev():bool
    {
        return self::isLocal() || self::isTest();
    }

	/**
	 * Проверить на AJAX страницу
	 *
	 * @return bool
	 */
	public static function isAjax():bool
	{
		return self::isJqueryAjax() || self::isBitrixAjax();
	}

	/**
	 * Проверить наличие jQuery AJAX запроса
	 */
	public static function isJqueryAjax():bool
	{
		return $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
	}

	/**
	 * Проверить наличие Bitrix AJAX запроса
	 */
	public static function isBitrixAjax():bool
	{
		return !self::isJqueryAjax() && isset($_REQUEST[BX_AJAX_PARAM_ID]);
	}

	/**
	 * Кастомизация вывода var_dump с остановкой запроса и сброса шаблона
	 * @param mixed ...$vars
	 */
	public static function varDumpStop(...$vars):void
	{
		global $APPLICATION;

		$APPLICATION->RestartBuffer();

		echo '<pre>';

		foreach ($vars as $var) {
			var_dump($var);
		}

		echo '</pre>';
		exit();
	}

	/**
	 * Кастомизация вывода var_dump без остановки и сброса шаблона
	 * @param mixed ...$vars
	 */
	public static function varDump(...$vars):void
	{
		echo '<pre>';

		foreach ($vars as $var) {
			var_dump($var);
		}

		echo '</pre>';
	}

	/**
	 * Получить домен сайта с/без http(s)
	 * @param bool $schema Показывать протокол
	 * @return string
	 */
	public static function getDomain(bool $schema = true):string
	{
		$urlPrefix          =   '';
		$urlWithoutSchema   =   $_SERVER['SERVER_NAME'] . $urlPrefix;

		if ($schema) {
			return $_SERVER['REQUEST_SCHEME'] . '://' . $urlWithoutSchema;
		}

		return $urlWithoutSchema;
	}

	/**
	 * Получить полный URL с/без http(s)
	 * @param bool $schema
	 * @return string
	 */
	public static function getFullUrl(bool $schema = true):string
	{
		return self::getDomain($schema) . $_SERVER['REQUEST_URI'];
	}

	/**
	 * Создать полный url адрес
	 * @param string $url Часть пути
	 * @param bool $schema Показывать протокол
	 * @return string
	 */
	public static function createUrl(string $url = '', bool $schema = true):string
	{
		if ($url !== '') {
			return self::getDomain($schema) . $url;
		}

		return self::getDomain($schema);
	}

	/**
	 * Получить ID инфоблока по его коду
	 * @param string $code Код инфоблока
	 * @param string $type Тип инфоблока
	 * @return int|null
	 */
	public static function getIdIblockByCode(string $code, string $type):?int
	{
		$result = CIBlock::GetList([
			'SORT' => 'ASC'
		], [
			'TYPE' => $type,
			'=CODE' => $code
		]);

		$data = $result->Fetch();

		if (!empty($data)) {
			return (int)$data['ID'];
		}

		return null;
	}

	/**
	 * Получить реальный IP пользователя
	 * @return string
	 */
	public static function getRealIP():string
	{
		$ip = false;

		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ips = explode (', ', $_SERVER['HTTP_X_FORWARDED_FOR']);

			for ($i = 0; $i <= count($ips) - 1; $i++) {
				if (!preg_match("/^(10|172\\.16|192\\.168)\\./", $ips[$i])) {
					$ip = $ips[$i];
					break;
				}
			}
		}

		return ($ip ?: $_SERVER['REMOTE_ADDR']);
	}

	/**
	 * Получить массив случайных чисел
	 * @param int $min Минимальное число
	 * @param int $max Максимальное число
	 * @param int $quantity Размер массива
	 * @return array
	 */
	public static function getRandomArray(int $min, int $max, int $quantity):array
	{
		$numbers = range($min, $max);

		shuffle($numbers);

		return array_slice($numbers, 0, $quantity);
	}

	/**
	 * Форматирование номера телефона
	 * @param string $phoneNumber
	 * @return string|string[]|null
	 */
	public static function formatPhoneNumber(string $phoneNumber)
	{
		$phoneNumber = preg_replace('/[\D]/','',$phoneNumber);

		if (strlen($phoneNumber) > 10) {
			$countryCode    =   substr($phoneNumber, 0, strlen($phoneNumber) - 10);
			$areaCode       =   substr($phoneNumber, -10, 3);
			$nextThree      =   substr($phoneNumber, -7, 3);
			$lastFour       =   substr($phoneNumber, -4, 4);

			if ($countryCode !== '8') {
				$countryCode = '+' . $countryCode;
			}

			$phoneNumber    =   $countryCode . ' (' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
		} elseif (strlen($phoneNumber) === 10) {
			$areaCode       =   substr($phoneNumber, 0, 3);
			$nextThree      =   substr($phoneNumber, 3, 3);
			$lastFour       =   substr($phoneNumber, 6, 4);

			$phoneNumber    =   '+7 (' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
		} elseif (strlen($phoneNumber) === 7) {
			$nextThree      =   substr($phoneNumber, 0, 3);
			$lastFour       =   substr($phoneNumber, 3, 4);

			$phoneNumber    =   $nextThree . '-' . $lastFour;
		}

		return $phoneNumber;
	}

	/**
	 * Форматирование окончания текста
	 * @param int $countData Кол-во данных
	 * @param array $words Массив слов для склонения
	 * @return string
	 */
	public static function findTextFormat(int $countData = 0, array $words = [Loc::getMessage('PRODUCT_1'), Loc::getMessage('PRODUCT_2'), Loc::getMessage('PRODUCTS')]):string
	{
		$num = $countData % 100;

		if ($num > 19) {
			$num = $countData % 10;
		}

		switch ($num) {
			case 1:
				return $words[0];
				break;
			case 2:
			case 3:
			case 4:
				return $words[1];
				break;
			default:
				return $words[2];
				break;
		}
	}

	/**
	 * Формат дня недели на вопрос: "Когда?"
	 * @param string $dayNumber
	 * @return string
	 */
	public static function getDateIn(string $dayNumber = ''):string
	{
		$days_arr_format = [
			1 => Loc::getMessage('IN_MONDAY'),
			2 => Loc::getMessage('IN_TUESDAY'),
			3 => Loc::getMessage('IN_WEDNESDAY'),
			4 => Loc::getMessage('IN_THURSDAY'),
			5 => Loc::getMessage('IN_FRIDAY'),
			6 => Loc::getMessage('IN_SATURDAY'),
			7 => Loc::getMessage('IN_SUNDAY')
		];

		return $days_arr_format[$dayNumber];
	}

	/**
	 * htmlspecialcharsbx для вложенных массивов
	 * @param array $request $_REQUEST массив
	 * @return array
	 */
	public static function requestParse(array $request = []):array
	{
		foreach ($request as $key => $item) {
			if (is_array($item)) {
				$request[$key] = self::requestParse($item);
			} else {
				$request[$key] = htmlspecialcharsbx($item);
			}
		}

		return $request;
	}

	/**
	 * Время последнего изменения файла
	 * @param string $pathToFile Путь к файлу
	 * @return string
	 */
	public static function lastModifyTime(string $pathToFile = ''):string
	{
		return $pathToFile . '?version=' . filemtime($pathToFile);
	}

	/**
	 * Приведение цены в правильный формат
	 * @param float $price Цена
	 * @param int $decimals Кол-во чисел после разделителя
	 * @param string $decPoint Разделитель
	 * @param string $thousandsSep Разделитель тыся
	 * @return string
	 */
	public static function priceToDefault(float $price = 0.0, int $decimals = 2, string $decPoint = '.', string $thousandsSep = ' '):string
	{
		return number_format($price, $decimals, $decPoint, $thousandsSep);
	}
}