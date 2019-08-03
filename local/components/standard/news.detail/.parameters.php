<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

if (!CModule::IncludeModule('iblock')) {
	return;
}

$arTypes = CIBlockParameters::GetIBlockTypes();

$arIBlocks = [];

$dbIblock = CIBlock::GetList([
	'SORT' => 'ASC'
], [
	'SITE_ID'   =>  $_REQUEST['site'],
	'TYPE'      =>  $arCurrentValues['IBLOCK_TYPE'] !== '-' ?? ''
]);

while ($arRes = $dbIblock->Fetch()) {
	$arIBlocks[$arRes['ID']] = '[' . $arRes['ID'] . '] ' . $arRes['NAME'];
}

$arProperty_LNS = [];
$rsProp = CIBlockProperty::GetList(
	[
		'sort' => 'asc',
		'name' => 'asc'
	],
	[
		'ACTIVE'    =>  'Y',
		'IBLOCK_ID' =>  isset($arCurrentValues['IBLOCK_ID']) ?? $arCurrentValues['ID']
	]
);

while ($arr = $rsProp->Fetch()) {
	$arProperty[$arr['CODE']] = '[' . $arr['CODE'] . '] ' . $arr['NAME'];
	
	if (in_array($arr['PROPERTY_TYPE'], ['L', 'N', 'S'])) {
		$arProperty_LNS[$arr['CODE']] = '[' . $arr['CODE'] . '] ' . $arr['NAME'];
	}
}

$arUGroupsEx = [];
$dbUGroups = CGroup::GetList($by = 'c_sort', $order = 'asc');

while($arUGroups = $dbUGroups -> Fetch()) {
	$arUGroupsEx[$arUGroups['ID']] = $arUGroups['NAME'];
}

$arComponentParameters = [
	'GROUPS'        =>  [],
	'PARAMETERS'    =>  [
		'AJAX_MODE'                 =>  [],
		'IBLOCK_TYPE'               =>  [
			'PARENT'    =>  'BASE',
			'NAME'      =>  GetMessage('T_IBLOCK_DESC_LIST_TYPE'),
			'TYPE'      =>  'LIST',
			'VALUES'    =>  $arTypes,
			'DEFAULT'   =>  'news',
			'REFRESH'   =>  'Y',
		],
		'IBLOCK_ID'                 =>  [
			'PARENT'            =>  'BASE',
			'NAME'              =>  GetMessage('T_IBLOCK_DESC_LIST_ID'),
			'TYPE'              =>  'LIST',
			'VALUES'            =>  $arIBlocks,
			'DEFAULT'           =>  '',
			'ADDITIONAL_VALUES' =>  'Y',
			'REFRESH'           =>  'Y',
		],
		'ELEMENT_ID'                =>  [
			'PARENT'    =>  'BASE',
			'NAME'      =>  GetMessage('ELEMENT_ID'),
			'TYPE'      =>  'STRING',
			'DEFAULT'   =>  "={$_REQUEST['ELEMENT_ID']}",
		],
		'ELEMENT_CODE'              =>  [
			'PARENT'    =>  'BASE',
			'NAME'      =>  GetMessage('ELEMENT_CODE'),
			'TYPE'      =>  'STRING',
			'DEFAULT'   =>  '',
		],
		'CHECK_DATES'               =>  [
			'PARENT'    =>  'DATA_SOURCE',
			'NAME'      =>  GetMessage('T_IBLOCK_DESC_CHECK_DATES'),
			'TYPE'      =>  'CHECKBOX',
			'DEFAULT'   =>  'Y',
		],
		'FIELD_CODE'                =>  CIBlockParameters::GetFieldCode(GetMessage('IBLOCK_FIELD'), 'DATA_SOURCE'),
		'PROPERTY_CODE'             =>  [
			'PARENT'            =>  'DATA_SOURCE',
			'NAME'              =>  GetMessage('T_IBLOCK_PROPERTY'),
			'TYPE'              =>  'LIST',
			'MULTIPLE'          =>  'Y',
			'VALUES'            =>  $arProperty_LNS,
			'ADDITIONAL_VALUES' =>  'Y',
		],
		'IBLOCK_URL'                =>  CIBlockParameters::GetPathTemplateParam(
			'LIST',
			'IBLOCK_URL',
			GetMessage('T_IBLOCK_DESC_LIST_PAGE_URL'),
			'',
			'URL_TEMPLATES'
		),
		'DETAIL_URL'                =>  CIBlockParameters::GetPathTemplateParam(
			'DETAIL',
			'DETAIL_URL',
			GetMessage('DETAIL_URL'),
			'',
			'URL_TEMPLATES'
		),
		'SET_TITLE'                 =>  [],
		'SET_CANONICAL_URL'         =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('SET_CANONICAL_URL'),
			'TYPE'      =>  'CHECKBOX',
			'DEFAULT'   =>  'N',
		],
		'SET_BROWSER_TITLE'         =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('SET_BROWSER_TITLE'),
			'TYPE'      =>  'CHECKBOX',
			'DEFAULT'   =>  'Y',
			'REFRESH'   =>  'Y'
		],
		'BROWSER_TITLE'             =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('BROWSER_TITLE'),
			'TYPE'      =>  'LIST',
			'MULTIPLE'  =>  'N',
			'DEFAULT'   =>  '-',
			'VALUES'    =>  array_merge(['-' => ' ', 'NAME' => GetMessage('IBLOCK_FIELD_NAME')], $arProperty_LNS),
			'HIDDEN'    =>  (isset($arCurrentValues['SET_BROWSER_TITLE']) && $arCurrentValues['SET_BROWSER_TITLE'] === 'N') ? 'Y' : 'N'
		],
		'SET_META_KEYWORDS'         =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('SET_META_KEYWORDS'),
			'TYPE'      =>  'CHECKBOX',
			'DEFAULT'   =>  'Y',
			'REFRESH'   =>  'Y',
		],
		'META_KEYWORDS'             =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('T_IBLOCK_DESC_KEYWORDS'),
			'TYPE'      =>  'LIST',
			'MULTIPLE'  =>  'N',
			'DEFAULT'   =>  '-',
			'VALUES'    =>  array_merge(['-' => ' '],$arProperty_LNS),
			'HIDDEN'    => (isset($arCurrentValues['SET_META_KEYWORDS']) && $arCurrentValues['SET_META_KEYWORDS'] === 'N') ? 'Y' : 'N'
		],
		'SET_META_DESCRIPTION'      =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('SET_META_DESCRIPTION'),
			'TYPE'      =>  'CHECKBOX',
			'DEFAULT'   =>  'Y',
			'REFRESH'   =>  'Y'
		],
		'META_DESCRIPTION'          =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('T_IBLOCK_DESC_DESCRIPTION'),
			'TYPE'      =>  'LIST',
			'MULTIPLE'  =>  'N',
			'DEFAULT'   =>  '-',
			'VALUES'    =>  array_merge(['-' => ' '],$arProperty_LNS),
			'HIDDEN'    =>  (isset($arCurrentValues['SET_META_DESCRIPTION']) && $arCurrentValues['SET_META_DESCRIPTION'] === 'N') ? 'Y' : 'N'
		],
		'SET_LAST_MODIFIED'         =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('SET_LAST_MODIFIED'),
			'TYPE'      =>  'CHECKBOX',
			'DEFAULT'   =>  'N',
		],
		'INCLUDE_IBLOCK_INTO_CHAIN' =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('T_IBLOCK_DESC_INCLUDE_IBLOCK_INTO_CHAIN'),
			'TYPE'      =>  'CHECKBOX',
			'DEFAULT'   =>  'Y',
		],
		'ADD_SECTIONS_CHAIN'        =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('T_IBLOCK_DESC_ADD_SECTIONS_CHAIN'),
			'TYPE'      =>  'CHECKBOX',
			'DEFAULT'   =>  'Y',
		],
		'ADD_ELEMENT_CHAIN'         =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('T_IBLOCK_DESC_ADD_ELEMENT_CHAIN'),
			'TYPE'      =>  'CHECKBOX',
			'DEFAULT'   =>  'N'
		],
		'ACTIVE_DATE_FORMAT'        =>  CIBlockParameters::GetDateFormat(GetMessage('T_IBLOCK_DESC_ACTIVE_DATE_FORMAT'), 'ADDITIONAL_SETTINGS'),
		'USE_PERMISSIONS'           =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('T_IBLOCK_DESC_USE_PERMISSIONS'),
			'TYPE'      =>  'CHECKBOX',
			'DEFAULT'   =>  'N',
			'REFRESH'   =>  'Y',
		],
		'GROUP_PERMISSIONS'         =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('T_IBLOCK_DESC_GROUP_PERMISSIONS'),
			'TYPE'      =>  'LIST',
			'VALUES'    =>  $arUGroupsEx,
			'DEFAULT'   =>  [1],
			'MULTIPLE'  =>  'Y',
		],
		'STRICT_SECTION_CHECK'      =>  [
			'PARENT'    =>  'ADDITIONAL_SETTINGS',
			'NAME'      =>  GetMessage('STRICT_SECTION_CHECK'),
			'TYPE'      =>  'CHECKBOX',
			'DEFAULT'   =>  'N',
		],
		'CACHE_TIME'                =>  ['DEFAULT' => 36000000],
		'CACHE_GROUPS'              =>  [
			'PARENT'    =>  'CACHE_SETTINGS',
			'NAME'      =>  GetMessage('CACHE_GROUPS'),
			'TYPE'      =>  'CHECKBOX',
			'DEFAULT'   =>  'Y',
		],
	],
];

CIBlockParameters::AddPagerSettings(
	$arComponentParameters,
	GetMessage('T_IBLOCK_DESC_PAGER_PAGE'), //$pager_title
	false, //$bDescNumbering
	true, //$bShowAllParam
	true, //$bBaseLink
	$arCurrentValues['PAGER_BASE_LINK_ENABLE'] === 'Y' //$bBaseLinkEnabled
);
unset($arComponentParameters['PARAMETERS']['PAGER_SHOW_ALWAYS']);

CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);

if ($arCurrentValues['USE_PERMISSIONS'] !== 'Y') {
	unset($arComponentParameters['PARAMETERS']['GROUP_PERMISSIONS']);	
}
