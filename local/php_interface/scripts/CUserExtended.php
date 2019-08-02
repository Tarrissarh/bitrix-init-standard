<?php

namespace Standard;

use \CUser;

class CUserExtended extends CUser
{
	/**
	 * Get user full name
	 * @param array $arUser
	 * @return string
	 */
	public static function getUserFullName(array $arUser):string
	{
		$fullName = $arUser['NAME'];

		if (!empty($arUser['LAST_NAME'])) {
			$fullName = $arUser['LAST_NAME'] . ' ' . $arUser['NAME'];
		}

		if (!empty($arUser['SECOND_NAME'])) {
			$fullName .= ' ' . $arUser['SECOND_NAME'];
		}

		return $fullName;
	}
}