<?php

namespace Standard\InfoBlock;

use \Standard\InfoBlock\InfoBlock;
use \Standard\InfoBlock\AbstractElement;
use \Standard\InfoBlock\AbstractSection;

abstract class AbstractInfoBlock implements InfoBlock
{
	/**
	 * Создать раздел
	 * @param array $params Свойста раздела
	 * @return int|null
	 */
	public static function createSection(array $params = []):?int
	{

	}

	/**
	 * Обновить раздел
	 * @param int $id ID раздела
	 * @param array $params Свойста раздела
	 * @return int|null
	 */
	public static function updateSection(int $id, array $params = []):?int
	{

	}

	/**
	 * Удалить раздел
	 * @param int $id ID раздела
	 * @return int|null
	 */
	public static function deleteSection(int $id):?int
	{

	}

	/**
	 * Получить список разделов по условиям
	 * @param array $filter Параметры поиска
	 * @return array
	 */
	public static function getSectionList(array $filter = []):array
	{

	}

	/**
	 * Получить раздел по его ID
	 * @param int $id ID
	 * @return array
	 */
	public static function getSectionById(int $id):array
	{

	}

	/**
	 * Получить раздел по его коду
	 * @param string $code CODE
	 * @return array
	 */
	public static function getSectionByCode(string $code):array
	{

	}

	/**
	 * Создать элемент
	 * @param array $params Свойста элемента
	 * @return int|null
	 */
	public static function createElement(array $params = []):?int
	{

	}

	/**
	 * Обновить элемент
	 * @param int $id ID элемента
	 * @param array $params Свойста элемента
	 * @return int|null
	 */
	public static function updateElement(int $id, array $params = []):?int
	{

	}

	/**
	 * Удалить элемент
	 * @param int $id ID элемента
	 * @return int|null
	 */
	public static function deleteElement(int $id):?int
	{

	}

	/**
	 * Получить список элементов по условиям
	 * @param array $filter Параметры поиска
	 * @return array
	 */
	public static function getElementList(array $filter = []):array
	{

	}

	/**
	 * Получить раздел по его ID
	 * @param int $id ID
	 * @return array
	 */
	public static function getElementById(int $id):array
	{

	}

	/**
	 * Получить раздел по его коду
	 * @param string $code CODE
	 * @return array
	 */
	public static function getElementByCode(string $code):array
	{

	}
}