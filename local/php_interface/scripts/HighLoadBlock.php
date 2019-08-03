<?php

namespace Standard;

use \Bitrix\Highloadblock as HL;
use \Exception;
use \Bitrix\Main\{
	ArgumentException,
	ObjectPropertyException,
	SystemException,
	Entity\Base,
	Loader
};

// Подключаем модуль highloadblock
Loader::includeModule('highloadblock');

class HighLoadBlock
{
	/**
	 * @var Base
	 */
	public $entity;

	/**
	 * @var int
	 */
	private $id;

	/**
	 * HighLoadBlock constructor.
	 * @param string $name
	 * @throws ArgumentException
	 * @throws ObjectPropertyException
	 * @throws SystemException
	 */
	public function __construct(string $name)
	{
		$blockEl = HL\HighloadBlockTable::getList([
			'filter' => ['NAME' => $name]
		])->Fetch();

		$this->id       =   (int)$blockEl['ID'];
		$this->entity   =   HL\HighloadBlockTable::compileEntity($blockEl);
	}

	/**
	 * Get ID highload block
	 * @return int
	 */
	public function getID():int
	{
		return $this->id;
	}

	/**
	 * Получить данные из таблицы
	 * @param array $params Параметры запроса
	 * @param bool $isGetAll Выводить один или все доступные элементы
	 * @return array|bool
	 * @throws ArgumentException
	 * @throws ObjectPropertyException
	 * @throws SystemException
	 */
	public function get(array $params = [], bool $isGetAll = true)
	{
		if (empty($params['sort'])) {
			$params['sort'] = [
				'ID' => 'ASC'
			];
		}

		$data = $this->entity->getDataClass()::getList($params);

		if ($isGetAll) {
			return $data->Fetch();
		}

		return $data->FetchAll();
	}

	/**
	 * Добавить данные в таблицу
	 * @param array $params Свойства
	 * @return int|null
	 * @throws Exception
	 */
	public function add(array $params = []):?int
	{
		$entityDataClass = $this->entity->getDataClass();

		try {
			$id = $entityDataClass::add($params)->getId();
		} catch (Exception $exception) {
			AddMessage2Log('Message: ' . $exception->getMessage() . ' Code: ' . $exception->getCode(), 'HighLoadBlock:add');
			throw $exception;
		}

		return $id;
	}

	/**
	 * Обновить данные в таблице
	 * @param int $id ID
	 * @param array $params Свойства
	 * @return int
	 * @throws Exception
	 */
	public function update(int $id, array $params = []):int
	{
		$entityDataClass = $this->entity->getDataClass();

		try {
			$resultId = $entityDataClass::update($id, $params)->getId();
		} catch (Exception $exception) {
			AddMessage2Log('Message: ' . $exception->getMessage() . ' Code: ' . $exception->getCode(), 'HighLoadBlock:update');
			throw $exception;
		}

		return $resultId;
	}

	/**
	 * Удалить данные из таблицы по ID
	 * @param int $id ID
	 * @return bool
	 * @throws Exception
	 */
	public function delete(int $id):bool
	{
		$entityDataClass = $this->entity->getDataClass();

		try {
			$result = $entityDataClass::delete($id);
		} catch (Exception $exception) {
			AddMessage2Log('Message: ' . $exception->getMessage() . ' Code: ' . $exception->getCode(), 'HighLoadBlock:delete');
			throw $exception;
		}

		return $result->isSuccess();
	}
}