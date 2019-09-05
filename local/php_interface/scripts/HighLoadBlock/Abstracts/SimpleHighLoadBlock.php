<?php

namespace Standard\HighLoadBlock\Abstracts;

use Standard\HighLoadBlock\Interfaces\SimpleHighLoadBlock AS SimpleHighLoadBlockInterface;
use Standard\HighLoadBlock AS HL;
use \Bitrix\Main\{
    ArgumentException,
    ObjectPropertyException,
    SystemException,
    Localization\Loc
};

Loc::loadMessages(__FILE__);

abstract class SimpleHighLoadBlock implements SimpleHighLoadBlockInterface
{
    private static $highLoadBlock       =   null;
    protected static $highLoadBlockName =   null;

    /**
     * Set HighLoadBlock
     * @param string $name Название HighLoad блока
     * @throws SystemException
     */
    public static function set(string $name):void
    {
        if ($name === '' && self::$highLoadBlockName === null) {
            throw new SystemException(Loc::getMessage('NAME_NOT_SET'));
        }

        self::$highLoadBlock = new HL($name);
    }

    /**
     * Get all metrics
     * @return array
     */
    public static function getAll():array
    {
        return self::$highLoadBlock->get([
            'filter' => [
                '=UF_SITE_ID'   =>  SITE_ID,
                '=UF_ACTIVE'    =>  true,
            ]
        ], false);
    }

    /**
     * Get metric script by name
     * @param string $name Название параметра
     * @return string
     */
    public static function getValueByName(string $name):string
    {
        $value = '';

        $setting = self::$highLoadBlock->get([
            'filter' => [
                '=UF_NAME'      =>  $name,
                '=UF_SITE_ID'   =>  SITE_ID,
                '=UF_ACTIVE'    =>  true,
            ]
        ]);

        if (!empty($setting)) {
            $value = $setting['UF_VALUE'];
        }

        return $value;
    }
}