<?php

namespace Standard\InfoBlock;

use \Standard\InfoBlock\Section;
use \Standard\InfoBlock\Element;

interface InfoBlock
{
	/**
	 * Создать раздел
	 * @param array $params Свойста раздела
	 * @return int|null
	 */
	public static function createSection(array $params = []):?int;

	/**
	 * Обновить раздел
	 * @param int $id ID раздела
	 * @param array $fields Свойста раздела
	 * @return bool
	 */
	public static function updateSection(int $id, array $fields = []):bool;

	/**
	 * Удалить раздел
	 * @param int $id ID раздела
	 * @return bool
	 */
	public static function deleteSection(int $id):bool;

	/**
	 * Получить список разделов по условиям
	 * @param array $filter Параметры поиска
     * @param array $sort Параметры сортировки
     * @param array $select Параметры выборки
	 * @return array
	 */
	public static function getSectionList(array $filter = [], array $sort = [], array $select = []):array;

	/**
	 * Получить раздел по его ID
	 * @param int $id ID
	 * @return array
	 */
	public static function getSectionById(int $id):array;

	/**
	 * Получить раздел по его коду
	 * @param string $code CODE
	 * @return array
	 */
	public static function getSectionByCode(string $code):array;

	/**
	 * Создать элемент
	 * @param array $fields Базовые свойства элемента
     * @param array $properties Дополнительные свойства элемента
	 * @return int|null
	 */
	public static function createElement(array $fields = [], array $properties = []):?int;

	/**
	 * Обновить элемент
	 * @param int $id ID элемента
	 * @param array $fields Базовые свойства элемента
     * @param array $properties Дополнительные свойства элемента
	 * @return bool
	 */
	public static function updateElement(int $id, array $fields = [], array $properties = []):bool;

	/**
	 * Удалить элемент
	 * @param int $id ID элемента
	 * @return bool
	 */
	public static function deleteElement(int $id):bool;

	/**
	 * Получить список элементов по условиям
	 * @param array $filter Параметры поиска
	 * @param array $sort Параметры сортировки
	 * @param array $select Параметры выборки
	 * @return array
	 */
	public static function getElementList(array $filter = [], array $sort = [], array $select = []):array;

	/**
	 * Получить раздел по его ID
	 * @param int $id ID
	 * @return array
	 */
	public static function getElementById(int $id):array;

	/**
	 * Получить раздел по его коду
	 * @param string $code CODE
	 * @return array
	 */
	public static function getElementByCode(string $code):array;
}