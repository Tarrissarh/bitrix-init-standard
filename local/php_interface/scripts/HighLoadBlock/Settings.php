<?php

namespace Standard\HighLoadBlock;

use Standard\HighLoadBlock\Abstracts\SimpleHighLoadBlock;
use Standard\HighLoadBlock;
use \Bitrix\Main\{
	ArgumentException,
	ObjectPropertyException,
	SystemException
};

class Settings extends SimpleHighLoadBlock
{
    protected static $highLoadBlockName = 'Settings';
}