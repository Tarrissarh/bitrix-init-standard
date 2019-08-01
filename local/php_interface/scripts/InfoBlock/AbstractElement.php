<?php

namespace Standard\InfoBlock;

use \Standard\InfoBlock\Element;

abstract class AbstractElement implements Element
{
	/**
	 * Создать элемент
	 * @param array $params Свойста элемента
	 * @return int|null
	 */
	public static function create(array $params = []):?int
	{

	}

	/**
	 * Обновить элемент
	 * @param int $id ID элемента
	 * @param array $params Свойста элемента
	 * @return int|null
	 */
	public static function update(int $id, array $params = []):?int
	{

	}

	/**
	 * Удалить элемент
	 * @param int $id ID элемента
	 * @return int|null
	 */
	public static function delete(int $id):?int
	{

	}

	/**
	 * Получить список элементов по условиям
	 * @param array $filter Параметры поиска
	 * @return array
	 */
	public static function getList(array $filter = []):array
	{

	}

	/**
	 * Получить элемент по его ID
	 * @param int $id ID
	 * @return array
	 */
	public static function getById(int $id):array
	{

	}

	/**
	 * Получить элемент по его коду
	 * @param string $code CODE
	 * @return array
	 */
	public static function getByCode(string $code):array
	{

	}
}