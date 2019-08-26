<?php

namespace Sprint\Migration;

class Version20190803172932 extends Version
{
    protected $description = 'Список настроек';

    public function up()
    {
        $helper = $this->getHelperManager();

        
        $helper->Hlblock()->saveHlblock([
	        'NAME'          =>  'Settings',
	        'TABLE_NAME'    =>  'settings',
	        'LANG'          =>  [
		        'ru' => [
			        'NAME' => 'Настройки',
		        ],
		        'en' => [
			        'NAME' => 'Settings',
		        ],
	        ],
        ]);

        $helper->UserTypeEntity()->saveUserTypeEntity([
            'ENTITY_ID'         =>  'HLBLOCK_Settings',
            'FIELD_NAME'        =>  'UF_NAME',
            'USER_TYPE_ID'      =>  'string',
            'XML_ID'            =>  'UF_NAME',
            'SORT'              =>  '100',
            'MULTIPLE'          =>  'N',
            'MANDATORY'         =>  'Y',
            'SHOW_FILTER'       =>  'S',
            'SHOW_IN_LIST'      =>  'Y',
            'EDIT_IN_LIST'      =>  'Y',
            'IS_SEARCHABLE'     =>  'Y',
            'SETTINGS'          =>  [
                'SIZE'            =>  20,
                'ROWS'            =>  1,
                'REGEXP'          =>  '',
                'MIN_LENGTH'      =>  0,
                'MAX_LENGTH'      =>  0,
                'DEFAULT_VALUE'   =>  '',
            ],
            'EDIT_FORM_LABEL'   =>  [
                'en' => 'Name',
                'ru' => 'Название',
            ],
            'LIST_COLUMN_LABEL' =>  [
                'en' => 'Name',
                'ru' => 'Название',
            ],
            'LIST_FILTER_LABEL' =>  [
                'en' => 'Name',
                'ru' => 'Название',
            ],
            'ERROR_MESSAGE'     =>  [
                'en' => '',
                'ru' => '',
            ],
            'HELP_MESSAGE'      =>  [
                'en' => '',
                'ru' => '',
            ],
        ]);
        $helper->UserTypeEntity()->saveUserTypeEntity([
            'ENTITY_ID'         =>  'HLBLOCK_Settings',
            'FIELD_NAME'        =>  'UF_VALUE',
            'USER_TYPE_ID'      =>  'string',
            'XML_ID'            =>  'UF_VALUE',
            'SORT'              =>  '100',
            'MULTIPLE'          =>  'N',
            'MANDATORY'         =>  'Y',
            'SHOW_FILTER'       =>  'S',
            'SHOW_IN_LIST'      =>  'Y',
            'EDIT_IN_LIST'      =>  'Y',
            'IS_SEARCHABLE'     =>  'Y',
            'SETTINGS'          =>  [
                'SIZE'            =>  40,
                'ROWS'            =>  5,
                'REGEXP'          =>  '',
                'MIN_LENGTH'      =>  0,
                'MAX_LENGTH'      =>  0,
                'DEFAULT_VALUE'   =>  '',
            ],
            'EDIT_FORM_LABEL'   =>  [
                'en' => 'Value',
                'ru' => 'Значение',
            ],
            'LIST_COLUMN_LABEL' =>  [
                'en' => 'Value',
                'ru' => 'Значение',
            ],
            'LIST_FILTER_LABEL' =>  [
                'en' => 'Value',
                'ru' => 'Значение',
            ],
            'ERROR_MESSAGE'     =>  [
                'en' => '',
                'ru' => '',
            ],
            'HELP_MESSAGE'      =>  [
                'en' => '',
                'ru' => '',
            ],
        ]);
        $helper->UserTypeEntity()->saveUserTypeEntity([
	                'ENTITY_ID'         =>  'HLBLOCK_Settings',
	                'FIELD_NAME'        =>  'UF_SITE_ID',
	                'USER_TYPE_ID'      =>  'string',
	                'XML_ID'            =>  'UF_SITE_ID',
	                'SORT'              =>  '100',
	                'MULTIPLE'          =>  'N',
	                'MANDATORY'         =>  'N',
	                'SHOW_FILTER'       =>  'N',
	                'SHOW_IN_LIST'      =>  'Y',
	                'EDIT_IN_LIST'      =>  'Y',
	                'IS_SEARCHABLE'     =>  'N',
	                'SETTINGS'          =>  [
		                'SIZE'            =>  20,
		                'ROWS'            =>  1,
		                'REGEXP'          =>  '',
		                'MIN_LENGTH'      =>  0,
		                'MAX_LENGTH'      =>  0,
		                'DEFAULT_VALUE'   =>  's1',
	                ],
	                'EDIT_FORM_LABEL'   =>  [
		                'en' => 'Site ID',
		                'ru' => 'Идентификатор сайта',
	                ],
	                'LIST_COLUMN_LABEL' =>  [
		                'en' => 'Site ID',
		                'ru' => 'Идентификатор сайта',
	                ],
	                'LIST_FILTER_LABEL' =>  [
		                'en' => 'Site ID',
		                'ru' => 'Идентификатор сайта',
	                ],
	                'ERROR_MESSAGE'     =>  [
		                'en' => '',
		                'ru' => '',
	                ],
	                'HELP_MESSAGE'      =>  [
		                'en' => '',
		                'ru' => '',
	                ],
                ]);
        
    }

    public function down()
    {
        $helper = $this->getHelperManager();

        //your code ...
    }
}
