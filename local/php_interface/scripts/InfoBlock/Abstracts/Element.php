<?php

namespace Standard\InfoBlock\Abstracts;

use \Standard\InfoBlock\Interfaces\Element AS ElementInterface;
use \Standard\Tools;
use \CIBlockElement;
use \CIBlock;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

abstract class Element implements ElementInterface
{
    protected static $select            =   ['*'];
    protected static $ibBlockCode       =   '';
    protected static $ibBlockType       =   '';
    protected static $sort              =   ['SORT' => 'ASC'];
    protected static $detailUrlTemplate =   '';

	/**
	 * Создать элемент
	 * @param array $fields Базовые свойства элемента
	 * @param array $properties Дополнительные свойства элемента
	 * @return int|null
	 */
	public static function create(array $fields = [], array $properties = []):?int
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

        AddMessage2Log([$el->LAST_ERROR, $fields, $properties], self::class . '::create');

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
	public static function update(int $id, array $fields = [], array $properties = []):bool
	{
        global $APPLICATION;

        if (empty($id) || $id === null) {
            AddMessage2Log(Loc::getMessage('ID_NOT_SET'), self::class . '::update');

            if (Tools::isDev()) {
                exit(Loc::getMessage('ID_NOT_SET'));
            }

            return false;
        }

        $el = new CIBlockElement();

        if (!empty($fields)) {
            $result = $el->Update($id, $fields);

            if (!$result) {
                AddMessage2Log([$APPLICATION->LAST_ERROR, $id, $fields], self::class . '::update');

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
	public static function delete(int $id):bool
	{
	    global $DB, $APPLICATION;

	    // Проверям права на удаление
	    if (CIBlock::GetPermission(Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType)) >= 'W') {
            $DB->StartTransaction();

            if (!CIBlockElement::Delete($id)) {
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
	 * Получить список элементов по условиям
	 * @param array $filter Параметры поиска
     * @param array $sort Параметры сортировки
     * @param array $select Параметры выборки
	 * @return array
	 */
	public static function getList(array $filter = [], array $sort = [], array $select = []):array
	{
        $key        =   0;
        $elements   =   [];

        if (empty($select)) {
            $arSelect = static::$select;
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

        $elementsList->SetUrlTemplates(static::$detailUrlTemplate);

        while ($el = $elementsList->GetNextElement()) {
            $elements[$key]                 =   $el->GetFields();
            $elements[$key]['PROPERTIES']   =   $el->GetProperties();
            $key++;
        }

        return $elements;
	}

	/**
	 * Получить элемент по его ID
	 * @param int $id ID
	 * @return array
	 */
	public static function getById(int $id):array
	{
        if (empty($id) && !is_int($id)) {
            exit(Loc::getMessage('ID_NOT_SET'));
        }

        $elements   =   [];
        $arOrder    =   static::$sort;
        $arSelect   =   static::$select;
        $arFilter   =   [
            'IBLOCK_ID' =>  Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType),
            'ACTIVE'    =>  'Y',
            'ID'        =>  $id
        ];

        $elementsList = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

        $elementsList->SetUrlTemplates(static::$detailUrlTemplate);

        if ($el = $elementsList->GetNextElement()) {
            $elements               =   $el->GetFields();
            $elements['PROPERTIES'] =   $el->GetProperties();
        }

        return $elements;
	}

	/**
	 * Получить элемент по его коду
	 * @param string $code CODE
	 * @return array
	 */
	public static function getByCode(string $code):array
	{
        if (empty($code) && !is_string($code)) {
            exit(Loc::getMessage('CODE_NOT_SET'));
        }

        $elements   =   [];
        $arOrder    =   static::$sort;
        $arSelect   =   static::$select;
        $arFilter   =   [
            'IBLOCK_ID' =>  Tools::getIDIblockByCode(static::$ibBlockCode, static::$ibBlockType),
            'ACTIVE'    =>  'Y',
            'CODE'      =>  $code
        ];

        $elementsList = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

        $elementsList->SetUrlTemplates(static::$detailUrlTemplate);

        if ($el = $elementsList->GetNextElement()) {
            $elements               =   $el->GetFields();
            $elements['PROPERTIES'] =   $el->GetProperties();
        }

        return $elements;
	}
}