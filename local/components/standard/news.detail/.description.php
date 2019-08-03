<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

$arComponentDescription = [
	'NAME'          =>  GetMessage('DESC_DETAIL'),
	'DESCRIPTION'   =>  GetMessage('DESC_DETAIL_DESC'),
	'ICON'          =>  '/images/news_detail.gif',
	'SORT'          =>  30,
	'CACHE_PATH'    =>  'Y',
	'PATH'          =>  [
		'ID'    =>  'content',
		'CHILD' =>  [
			'ID'    =>  'news',
			'NAME'  =>  GetMessage('DESC_NEWS'),
			'SORT'  =>  10,
			'CHILD' =>  [
				'ID' => 'news_cmpx',
			],
		],
	],
];