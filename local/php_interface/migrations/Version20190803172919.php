<?php

namespace Sprint\Migration;

class Version20190803172919 extends Version
{
    protected $description = 'Список метрик';

    public function up()
    {
        $helper = $this->getHelperManager();

        $helper->Hlblock()->saveHlblock([
	        'NAME'          =>  'Metrics',
	        'TABLE_NAME'    =>  'metrics',
	        'LANG'          =>  [
		        'ru' => [
			        'NAME' => 'Метрики',
		        ],
		        'en' => [
			        'NAME' => 'Metrics',
		        ],
	        ],
        ]);

        $helper->UserTypeEntity()->saveUserTypeEntity([
            'ENTITY_ID'         =>  'HLBLOCK_Metrics',
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
            'ENTITY_ID'         =>  'HLBLOCK_Metrics',
            'FIELD_NAME'        =>  'UF_SCRIPT',
            'USER_TYPE_ID'      =>  'string',
            'XML_ID'            =>  'UF_SCRIPT',
            'SORT'              =>  '100',
            'MULTIPLE'          =>  'N',
            'MANDATORY'         =>  'Y',
            'SHOW_FILTER'       =>  'N',
            'SHOW_IN_LIST'      =>  'Y',
            'EDIT_IN_LIST'      =>  'Y',
            'IS_SEARCHABLE'     =>  'N',
            'SETTINGS'          =>  [
                'SIZE'            =>  100,
                'ROWS'            =>  10,
                'REGEXP'          =>  '',
                'MIN_LENGTH'      =>  0,
                'MAX_LENGTH'      =>  0,
                'DEFAULT_VALUE'   =>  '',
            ],
            'EDIT_FORM_LABEL'   =>  [
                'en' => 'Script',
                'ru' => 'Скрипт',
            ],
            'LIST_COLUMN_LABEL' =>  [
                'en' => 'Script',
                'ru' => 'Скрипт',
            ],
            'LIST_FILTER_LABEL' =>  [
                'en' => 'Script',
                'ru' => 'Скрипт',
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
            'ENTITY_ID'         =>  'HLBLOCK_Metrics',
            'FIELD_NAME'        =>  'UF_ACTIVE',
            'USER_TYPE_ID'      =>  'boolean',
            'XML_ID'            =>  'UF_ACTIVE',
            'SORT'              =>  '100',
            'MULTIPLE'          =>  'N',
            'MANDATORY'         =>  'N',
            'SHOW_FILTER'       =>  'N',
            'SHOW_IN_LIST'      =>  'Y',
            'EDIT_IN_LIST'      =>  'Y',
            'IS_SEARCHABLE'     =>  'N',
            'SETTINGS'          =>  [
                'DEFAULT_VALUE'   =>  '1',
                'DISPLAY'         =>  'CHECKBOX',
                'LABEL'           =>  [
	                0 => 'Нет',
	                1 => 'Да',
                ],
                'LABEL_CHECKBOX'  =>  ' Да',
            ],
            'EDIT_FORM_LABEL'   =>  [
                'en' => 'Activity',
                'ru' => 'Активность',
            ],
            'LIST_COLUMN_LABEL' =>  [
                'en' => 'Activity',
                'ru' => 'Активность',
            ],
            'LIST_FILTER_LABEL' =>  [
                'en' => 'Activity',
                'ru' => 'Активность',
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
            'ENTITY_ID'         =>  'HLBLOCK_Metrics',
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
