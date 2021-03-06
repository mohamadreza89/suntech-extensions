						<?php
//
// File generated by ... on the 2018-06-03T12:07:39+0000
// Please do not edit manually
//

/**
 * Classes and menus for suntech-general (version 1.0.0)
 *
 * @author      iTop compiler
 * @license     http://opensource.org/licenses/AGPL-3.0
 */


/**
 * Persistent classes for a CMDB
 *
 * @copyright   Copyright (C) 2010-2017 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */
class UserLogin extends cmdbAbstractObject
{
	public static function Init()
	{
		$aParams = array
		(
			'category' => 'bizmodel,searchable,structure',
			'key_type' => 'autoincrement',
			'name_attcode' => '',
			'state_attcode' => '',
			'reconc_keys' => array('user_name'),
			'db_table' => 'user_login',
			'db_key_field' => 'id',
			'db_finalclass_field' => 'finalclass',
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeString("user_id", array("allowed_values"=>null, "sql"=>'user_id', "default_value"=>'', "is_null_allowed"=>true, "depends_on"=>array(), "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeString("user_name", array("allowed_values"=>null, "sql"=>'user_name', "default_value"=>'', "is_null_allowed"=>true, "depends_on"=>array(), "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeString("ip", array("allowed_values"=>null, "sql"=>'ip', "default_value"=>'', "is_null_allowed"=>true, "depends_on"=>array(), "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeDateTime("login_time", array("allowed_values"=>null, "sql"=>'login_time', "default_value"=>'', "is_null_allowed"=>true, "depends_on"=>array(), "always_load_in_tables"=>true)));



		MetaModel::Init_SetZListItems('details', array (
  0 => 'login_time',
));
		MetaModel::Init_SetZListItems('standard_search', array (
  0 => 'login_time',
));
		MetaModel::Init_SetZListItems('list', array (
  0 => 'login_time',
));

	}




    protected function OnInsert()
  {
        parent::OnInsert();
    $this->Set('ip', $_SERVER['REMOTE_ADDR']);
    $this->Set('login_time', time());
  }

}