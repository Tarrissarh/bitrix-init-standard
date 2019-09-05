<?php

namespace Standard\HighLoadBlock\Interfaces;

interface SimpleHighLoadBlock
{
    /**
     * Set HighLoadBlock
     * @param string $name Название HighLoad блока
     */
    public static function set(string $name):void;

    /**
     * Get all
     * @return array
     */
    public static function getAll():array;

    /**
     * Get by name
     * @param string $name Название параметра
     * @return string
     */
    public static function getValueByName(string $name):string;
}