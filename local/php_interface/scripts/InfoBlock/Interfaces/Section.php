<?php

namespace Standard\InfoBlock\Interfaces;

interface Section
{
	/**
	 * Создать раздел
	 * @param array $fields Свойста раздела
	 * @return int|null
	 */
	public static function create(array $fields = []):?int;

	/**
	 * Обновить раздел
	 * @param int $id ID раздела
	 * @param array $fields Свойста раздела
	 * @return bool
	 */
	public static function update(int $id, array $fields = []):bool;

	/**
	 * Удалить раздел
	 * @param int $id ID раздела
	 * @return bool
	 */
	public static function delete(int $id):bool;

	/**
	 * Получить список разделов по условиям
	 * @param array $filter Параметры поиска
	 * @return array
	 */
	public static function getList(array $filter = []):array;

	/**
	 * Получить раздел по его ID
	 * @param int $id ID
	 * @return array
	 */
	public static function getById(int $id):array;

	/**
	 * Получить раздел по его коду
	 * @param string $code CODE
	 * @return array
	 */
	public static function getByCode(string $code):array;
}