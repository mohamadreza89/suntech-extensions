<?php
//
// iTop module definition file
//

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'suntech-general/1.0.0',
	array(
		// Identification
		//
		'label' => 'Suntech General',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'itop-tickets/2.4.0',
			'itop-request-mgmt/2.4.0',
			'itop-profiles-itil/2.4.0',
			'itop-config-mgmt/2.4.0',
			
		),
		'mandatory' => false,
		'visible' => true,
		//'installer' => 'SuntechGeneral',

		// Components
		//
		'datamodel' => array(
			'model.suntech-general.php',
            'main.suntech-general.php'
		),
		'webservice' => array(
			
		),
		'data.struct' => array(
			// add your 'structure' definition XML files here,
		),
		'data.sample' => array(
			// add your sample data XML files here,
		),
		
		// Documentation
		//
		'doc.manual_setup' => '', // hyperlink to manual setup documentation, if any
		'doc.more_information' => '', // hyperlink to more information, if any 

		// Default settings
		//
		'settings' => array(
			// Module specific settings go here, if any
			
		),
	)
);

class SuntechGeneral extends ModuleInstallerAPI
{

}


?>
