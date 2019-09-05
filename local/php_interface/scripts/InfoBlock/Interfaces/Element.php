<?php

namespace Standard\InfoBlock\Interfaces;

interface Element
{
	/**
	 * Создать элемент
	 * @param array $fields Базовые свойства элемента
     * @param array $properties Дополнительные свойства элемента
	 * @return int|null
	 */
	public static function create(array $fields = [], array $properties = []):?int;

	/**
	 * Обновить элемент
	 * @param int $id ID элемента
	 * @param array $fields Базовые свойства элемента
     * @param array $properties Дополнительные свойства элемента
	 * @return bool
	 */
	public static function update(int $id, array $fields = [], array $properties = []):bool;

	/**
	 * Удалить элемент
	 * @param int $id ID элемента
	 * @return bool
	 */
	public static function delete(int $id):bool;

	/**
	 * Получить список элементов по условиям
	 * @param array $filter Параметры поиска
     * @param array $sort Параметры сортировки
     * @param array $select Параметры выборки
	 * @return array
	 */
	public static function getList(array $filter = [], array $sort = [], array $select = []):array;

	/**
	 * Получить элемент по его ID
	 * @param int $id ID
	 * @return array
	 */
	public static function getById(int $id):array;

	/**
	 * Получить элемент по его коду
	 * @param string $code CODE
	 * @return array
	 */
	public static function getByCode(string $code):array;
}