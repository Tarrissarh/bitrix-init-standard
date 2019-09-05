<?php

namespace Standard\InfoBlock\Abstracts;

use \Standard\InfoBlock\Interfaces\Section AS SectionInterface;
use \Standard\Tools;
use \CIBlockSection;
use \CIBlock;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

abstract class Section implements SectionInterface
{
    protected static $select            =   ['*'];
    protected static $ibBlockCode       =   '';
    protected static $ibBlockType       =   '';
    protected static $sort              =   ['SORT' => 'ASC'];
    protected static $detailUrlTemplate =   '';

	/**
	 * Создать раздел
	 * @param array $fields Свойста раздела
	 * @return int|null
	 */
	public static function create(array $fields = []):?int
	{
        $section = new CIBlockSection();

        $fields = array_merge([
            'IBLOCK_ID' => Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType),
        ], $fields);

        $resultID = $section->Add($fields);

        if ($resultID) {
            return (int)$resultID;
        }

        AddMessage2Log([$section->LAST_ERROR, $fields], self::class . '::create');

        if (Tools::isDev()) {
            exit($section->LAST_ERROR);
        }

        return null;
	}

	/**
	 * Обновить раздел
	 * @param int $id ID раздела
	 * @param array $fields Свойста раздела
	 * @return bool
	 */
	public static function update(int $id, array $fields = []):bool
	{
	    global $APPLICATION;

        if (empty($id) || $id === null) {
            AddMessage2Log(Loc::getMessage('ID_NOT_SET'), self::class . '::update');

            if (Tools::isDev()) {
                exit(Loc::getMessage('ID_NOT_SET'));
            }

            return false;
        }

        $sec = new CIBlockSection();

        if (!empty($fields)) {
            $result = $sec->Update($id, $fields);

            if (!$result) {
                AddMessage2Log([$APPLICATION->LAST_ERROR, $id, $fields], self::class . '::update');

                if (Tools::isDev()) {
                    exit($APPLICATION->LAST_ERROR);
                }

                return false;
            }

            return true;
        }

        AddMessage2Log(Loc::getMessage('FIELDS_NOT_SET'), self::class . '::update');

        if (Tools::isDev()) {
            exit(Loc::getMessage('FIELDS_NOT_SET'));
        }

        return false;
	}

	/**
	 * Удалить раздел
	 * @param int $id ID раздела
	 * @return bool
	 */
	public static function delete(int $id):bool
	{
        global $DB, $APPLICATION;

        // Проверям права на удаление
        if (CIBlock::GetPermission(Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType)) >= 'W') {
            $DB->StartTransaction();

            if (!CIBlockSection::Delete($id)) {
                AddMessage2Log([$APPLICATION->LAST_ERROR, $id], self::class . '::delete');

                $DB->Rollback();

                if (Tools::isDev()) {
                    exit($APPLICATION->LAST_ERROR);
                }

                return false;
            }

            $DB->Commit();

            return true;
        }

        AddMessage2Log(Loc::getMessage('NOT_NAVE_RIGHT'), self::class . '::delete');

        if (Tools::isDev()) {
            exit(Loc::getMessage('NOT_NAVE_RIGHT'));
        }

        return false;
	}

	/**
	 * Получить список разделов по условиям
	 * @param array $filter Параметры поиска
     * @param array $sort Параметры сортировки
     * @param array $select Параметры выборки
	 * @return array
	 */
	public static function getList(array $filter = [], array $sort = [], array $select = []):array
	{
        $sections   =   [];
        $arOrder    =   static::$sort;

        if (!empty($sort)) {
            $arOrder = array_merge(static::$sort, $sort);
        }

        $arFilter = [
            'IBLOCK_ID' => Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType)
        ];

        if (!empty($filter)) {
            $arFilter = array_merge($arFilter, $filter);
        }

        $arSelect = static::$select;

        if (!empty($select)) {
            $arSelect = array_merge($arSelect, $select);
        }

        $rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);

        while ($res = $rsSections->Fetch()) {
            $sections[] = $res;
        }

        return $sections;
	}

	/**
	 * Получить раздел по его ID
	 * @param int $id ID
	 * @return array
	 */
	public static function getById(int $id):array
	{
        if (empty($id) && !is_int($id)) {
            exit(Loc::getMessage('ID_NOT_SET'));
        }

        $section    =   [];
        $arOrder    =   static::$sort;
        $arFilter   =   [
            'IBLOCK_ID' =>  Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType),
            'ACTIVE'    =>  'Y',
            'ID'        =>  $id
        ];
        $arSelect   =   static::$select;
        $rsSections =   CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);

        if ($res = $rsSections->Fetch()) {
            $section = $res;
        }

        return $section;
	}

	/**
	 * Получить раздел по его коду
	 * @param string $code CODE
	 * @return array
	 */
	public static function getByCode(string $code):array
	{
        if (empty($code) && !is_string($code)) {
            exit(Loc::getMessage('ID_NOT_SET'));
        }

        $section    =   [];
        $arOrder    =   static::$sort;
        $arSelect   =   static::$select;
        $arFilter   =   [
            'IBLOCK_ID' =>  Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType),
            'ACTIVE'    =>  'Y',
            'CODE'      =>  $code
        ];

        $rsSections =   CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);

        if ($res = $rsSections->Fetch()) {
            $section = $res;
        }

        return $section;
	}
}