<?php

namespace Sprint\Migration;


class Version20190803172932 extends Version
{

    protected $description = "Список настроек";

    public function up()
    {
        $helper = $this->getHelperManager();

        
        $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'Settings',
  'TABLE_NAME' => 'settings',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Настройки',
    ),
    'en' => 
    array (
      'NAME' => 'Settings',
    ),
  ),
));

                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Settings',
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_NAME',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'S',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'Y',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Name',
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Name',
    'ru' => 'Название',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Name',
    'ru' => 'Название',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Settings',
  'FIELD_NAME' => 'UF_VALUE',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_VALUE',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'S',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'Y',
  'SETTINGS' => 
  array (
    'SIZE' => 40,
    'ROWS' => 5,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Value',
    'ru' => 'Значение',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Value',
    'ru' => 'Значение',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Value',
    'ru' => 'Значение',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Settings',
  'FIELD_NAME' => 'UF_SITE_ID',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_SITE_ID',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => 's1',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Site ID',
    'ru' => 'Идентификатор сайта',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Site ID',
    'ru' => 'Идентификатор сайта',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Site ID',
    'ru' => 'Идентификатор сайта',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
));
        
            }

    public function down()
    {
        $helper = $this->getHelperManager();

        //your code ...
    }

}
