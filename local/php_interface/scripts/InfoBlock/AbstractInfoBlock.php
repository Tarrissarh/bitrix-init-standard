<?php

namespace Standard\InfoBlock;

use \Standard\InfoBlock\InfoBlock;
use \Standard\InfoBlock\AbstractElement;
use \Standard\InfoBlock\AbstractSection;
use \Standard\Tools;
use \CIBlockElement;
use \CIBlockSection;
use \CIBlock;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

abstract class AbstractInfoBlock implements InfoBlock
{
    protected static $selectElement             =   ['*'];
    protected static $selectSection             =   ['*'];
    protected static $ibBlockCode               =   '';
    protected static $ibBlockType               =   '';
    protected static $sort                      =   ['SORT' => 'ASC'];
    protected static $detailElementUrlTemplate  =   '';
    protected static $detailSectionUrlTemplate  =   '';

	/**
	 * Создать раздел
	 * @param array $fields Свойста раздела
	 * @return int|null
	 */
	public static function createSection(array $fields = []):?int
	{
        $section = new CIBlockSection();

        $fields = array_merge([
            'IBLOCK_ID' => Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType),
        ], $fields);

        $resultID = $section->Add($fields);

        if ($resultID > 0) {
            return (int)$resultID;
        }

        AddMessage2Log([$section->LAST_ERROR, $fields], self::class . '::createSection');

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
	public static function updateSection(int $id, array $fields = []):bool
	{
        global $APPLICATION;

        if (empty($id) || $id === null) {
            AddMessage2Log(Loc::getMessage('ID_NOT_SET'), self::class . '::updateSection');

            if (Tools::isDev()) {
                exit(Loc::getMessage('ID_NOT_SET'));
            }

            return false;
        }

        $sec = new CIBlockSection();

        if (!empty($fields)) {
            $result = $sec->Update($id, $fields);

            if (!$result) {
                AddMessage2Log([$APPLICATION->LAST_ERROR, $id, $fields], self::class . '::updateSection');

                if (Tools::isDev()) {
                    exit($APPLICATION->LAST_ERROR);
                }

                return false;
            }

            return true;
        }

        AddMessage2Log(Loc::getMessage('FIELDS_NOT_SET'), self::class . '::updateSection');

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
	public static function deleteSection(int $id):bool
	{
        global $DB, $APPLICATION;

        // Проверям права на удаление
        if (CIBlock::GetPermission(Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType)) >= 'W') {
            $DB->StartTransaction();

            if (!CIBlockSection::Delete($id)) {
                AddMessage2Log([$APPLICATION->LAST_ERROR, $id], self::class . '::deleteSection');

                $DB->Rollback();

                if (Tools::isDev()) {
                    exit($APPLICATION->LAST_ERROR);
                }

                return false;
            }

            $DB->Commit();

            return true;
        }

        AddMessage2Log(Loc::getMessage('NOT_NAVE_RIGHT'), self::class . '::deleteSection');

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
	public static function getSectionList(array $filter = [], array $sort = [], array $select = []):array
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

        $arSelect = static::$selectSection;

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
	public static function getSectionById(int $id):array
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
        $arSelect   =   static::$selectSection;
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
	public static function getSectionByCode(string $code):array
	{
        if (empty($code) && !is_string($code)) {
            exit(Loc::getMessage('ID_NOT_SET'));
        }

        $section    =   [];
        $arOrder    =   static::$sort;
        $arSelect   =   static::$selectSection;
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

	/**
	 * Создать элемент
	 * @param array $fields Базовые свойства элемента
     * @param array $properties Дополнительные свойства элемента
	 * @return int|null
	 */
	public static function createElement(array $fields = [], array $properties = []):?int
	{
        $el = new CIBlockElement();

        $fields = array_merge([
            'IBLOCK_ID' => Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType),
        ], $fields);

        $resultID = $el->Add($fields);

        if ($resultID) {
            foreach ($properties as $key => $property) {
                CIBlockElement::SetPropertyValuesEx($resultID, false, [$key => $property]);
            }

            return (int)$resultID;
        }

        AddMessage2Log([$el->LAST_ERROR, $fields, $properties], self::class . '::createElement');

        if (Tools::isDev()) {
            exit($el->LAST_ERROR);
        }

        return null;
	}

	/**
	 * Обновить элемент
	 * @param int $id ID элемента
	 * @param array $fields Базовые свойства элемента
     * @param array $properties Дополнительные свойства элемента
	 * @return bool
	 */
	public static function updateElement(int $id, array $fields = [], array $properties = []):bool
	{
	    global $APPLICATION;

        if (empty($id) || $id === null) {
            AddMessage2Log(Loc::getMessage('ID_NOT_SET'), self::class . '::updateElement');

            if (Tools::isDev()) {
                exit(Loc::getMessage('ID_NOT_SET'));
            }

            return false;
        }

        $el = new CIBlockElement();

        if (!empty($fields)) {
            $result = $el->Update($id, $fields);

            if (!$result) {
                AddMessage2Log([$APPLICATION->LAST_ERROR, $id, $fields], self::class . '::updateElement');

                if (Tools::isDev()) {
                    exit($APPLICATION->LAST_ERROR);
                }

                return false;
            }
        }

        if (!empty($properties)) {
            foreach ($properties as $key => $property) {
                CIBlockElement::SetPropertyValuesEx($id, false, [$key => $property]);
            }
        }

        return true;
	}

	/**
	 * Удалить элемент
	 * @param int $id ID элемента
	 * @return bool
	 */
	public static function deleteElement(int $id):bool
	{
        global $DB, $APPLICATION;

        // Проверям права на удаление
        if (CIBlock::GetPermission(Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType)) >= 'W') {
            $DB->StartTransaction();

            if (!CIBlockElement::Delete($id)) {
                AddMessage2Log([$APPLICATION->LAST_ERROR, $id], self::class . '::deleteElement');

                $DB->Rollback();

                if (Tools::isDev()) {
                    exit($APPLICATION->LAST_ERROR);
                }

                return false;
            }

            $DB->Commit();

            return true;
        }

        AddMessage2Log(Loc::getMessage('NOT_NAVE_RIGHT'), self::class . '::deleteElement');

        if (Tools::isDev()) {
            exit(Loc::getMessage('NOT_NAVE_RIGHT'));
        }

        return false;
	}

	/**
	 * Получить список элементов по условиям
	 * @param array $filter Параметры поиска
     * @param array $sort Параметры сортировки
     * @param array $select Параметры выборки
	 * @return array
	 */
	public static function getElementList(array $filter = [], array $sort = [], array $select = []):array
	{
        $key        =   0;
        $elements   =   [];

        if (empty($select)) {
            $arSelect = static::$selectElement;
        } else {
            $arSelect = $select;
        }

        if (empty($sort)) {
            $arOrder = static::$sort;
        } else {
            $arOrder = $sort;
        }

        $arFilter = array_merge(['IBLOCK_ID' => Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType)], $filter);

        $elementsList = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

        $elementsList->SetUrlTemplates(static::$detailElementUrlTemplate, static::$detailSectionUrlTemplate);

        while ($el = $elementsList->GetNextElement()) {
            $elements[$key]                 =   $el->GetFields();
            $elements[$key]['PROPERTIES']   =   $el->GetProperties();
            $key++;
        }

        return $elements;
	}

	/**
	 * Получить раздел по его ID
	 * @param int $id ID
	 * @return array
	 */
	public static function getElementById(int $id):array
	{
        if (empty($id) && !is_int($id)) {
            exit(Loc::getMessage('ID_NOT_SET'));
        }

        $elements   =   [];
        $arOrder    =   static::$sort;
        $arSelect   =   static::$selectElement;
        $arFilter   =   [
            'IBLOCK_ID' =>  Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType),
            'ACTIVE'    =>  'Y',
            'ID'        =>  $id
        ];

        $elementsList = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

        $elementsList->SetUrlTemplates(static::$detailElementUrlTemplate, static::$detailSectionUrlTemplate);

        if ($el = $elementsList->GetNextElement()) {
            $elements               =   $el->GetFields();
            $elements['PROPERTIES'] =   $el->GetProperties();
        }

        return $elements;
	}

	/**
	 * Получить раздел по его коду
	 * @param string $code CODE
	 * @return array
	 */
	public static function getElementByCode(string $code):array
	{
        if (empty($code) && !is_string($code)) {
            exit(Loc::getMessage('ID_NOT_SET'));
        }

        $elements   =   [];
        $arOrder    =   static::$sort;
        $arSelect   =   static::$selectElement;
        $arFilter   =   [
            'IBLOCK_ID' =>  Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType),
            'ACTIVE'    =>  'Y',
            'CODE'      =>  $code
        ];

        $elementsList = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

        $elementsList->SetUrlTemplates(static::$detailElementUrlTemplate, static::$detailSectionUrlTemplate);

        if ($el = $elementsList->GetNextElement()) {
            $elements               =   $el->GetFields();
            $elements['PROPERTIES'] =   $el->GetProperties();
        }

        return $elements;
	}
}