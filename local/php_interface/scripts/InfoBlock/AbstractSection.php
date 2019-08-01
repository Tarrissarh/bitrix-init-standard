<?php

namespace Standard\InfoBlock;

use \Standard\InfoBlock\Section;

abstract class AbstractSection implements Section
{
	/**
	 * Создать раздел
	 * @param array $params Свойста раздела
	 * @return int|null
	 */
	public static function create(array $params = []):?int
	{

	}

	/**
	 * Обновить раздел
	 * @param int $id ID раздела
	 * @param array $params Свойста раздела
	 * @return int|null
	 */
	public static function update(int $id, array $params = []):?int
	{

	}

	/**
	 * Удалить раздел
	 * @param int $id ID раздела
	 * @return int|null
	 */
	public static function delete(int $id):?int
	{

	}

	/**
	 * Получить список разделов по условиям
	 * @param array $filter Параметры поиска
	 * @return array
	 */
	public static function getList(array $filter = []):array
	{

	}

	/**
	 * Получить раздел по его ID
	 * @param int $id ID
	 * @return array
	 */
	public static function getById(int $id):array
	{

	}

	/**
	 * Получить раздел по его коду
	 * @param string $code CODE
	 * @return array
	 */
	public static function getByCode(string $code):array
	{

	}
}