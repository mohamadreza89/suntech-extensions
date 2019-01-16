<?php
/**
 * Localized data
 *
 * @copyright   Copyright (C) 2013 XXXXX
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

Dict::Add('EN US', 'English', 'English', array(
	// Dictionary entries go here
	'Menu:RiskMgmt'=>'Risk Management',




    //fieldsets
    'Risk:baseinfo'=>'General Information',
    'Risk:date'=>'Dates',
    'Risk:more'=>'More Information',
    'Risk:Riskinfo'=>'Risk Information',
    'Risk:details'=>'Risk Details',


    //portal captions
    'Brick:Portal:QuickNewRisk:Title'=>'New Risk',
    'Brick:Portal:Risk:Title'=>'Risks',
    'Brick:Portal:Risk:Title+'=>'Submited Risks',

    //fields
    'Class:Risk/Attribute:name' => 'Title',
	'Class:Risk/Attribute:name+' => '',
	'Class:Risk/Attribute:status' => 'Status',
	'Class:Risk/Attribute:status+' => '',
	'Class:Risk/Attribute:impact' => 'Impact',
	'Class:Risk/Attribute:impact+' => '',
	'Class:Risk/Attribute:occurrence-probability' => 'Occurrence Probability',
	'Class:Risk/Attribute:occurrence-probability+' => '',
	'Class:Risk/Attribute:priority' => 'Priority',
	'Class:Risk/Attribute:priority+' => '',
	'Class:Risk/Attribute:risk-response-strategy' => 'Risk Response Strategy',
	'Class:Risk/Attribute:risk-response-strategy+' => '',
	'Class:Risk/Attribute:description' => 'Description',
	'Class:Risk/Attribute:description+' => '',
	'Class:Risk/Attribute:service-impact' => 'Service Impact',
	'Class:Risk/Attribute:service-impact+' => '',
	'Class:Risk/Attribute:risk-area' => 'Risk Area',
	'Class:Risk/Attribute:risk-area+' => '',
	'Class:Risk/Attribute:symptoms' => 'Symptoms',
	'Class:Risk/Attribute:symptoms+' => '',
	'Class:Risk/Attribute:trigger' => 'Trigger',
	'Class:Risk/Attribute:trigger+' => '',
	'Class:Risk/Attribute:response-strategy' => 'Response Strategy',
	'Class:Risk/Attribute:response-strategy+' => '',
	'Class:Risk/Attribute:contingency-plan' => 'Contingency Plan',
	'Class:Risk/Attribute:contingency-plan+' => '',
	'Class:Risk/Attribute:change_list' => 'Change List',
	'Class:Risk/Attribute:change_list+' => 'All of the changes that are linked to this risk',
	'Class:Risk/Attribute:service_list' => 'Service List',
	'Class:Risk/Attribute:service_list+' => 'All of the services that are linked to this risk',

	//Menus
	'Menu:NewRisk'=>'New Risk',
	'Menu:NewRisk+'=>'',
	'Menu:SearchRisk'=>'Search Risk',
	'Menu:SearchRisk+'=>'',

	//values
	'Class:Risk/Attribute:impact/Value:1' => 'A department',
	'Class:Risk/Attribute:impact/Value:1+' => '',
	'Class:Risk/Attribute:impact/Value:2' => 'A service',
	'Class:Risk/Attribute:impact/Value:2+' => '',
	'Class:Risk/Attribute:impact/Value:3' => 'A person',
	'Class:Risk/Attribute:impact/Value:3+' => '',


	'Class:Risk/Attribute:priority/Value:1' => 'critical',
	'Class:Risk/Attribute:priority/Value:1+' => 'critical',
	'Class:Risk/Attribute:priority/Value:2' => 'high',
	'Class:Risk/Attribute:priority/Value:2+' => 'high',
	'Class:Risk/Attribute:priority/Value:3' => 'medium',
	'Class:Risk/Attribute:priority/Value:3+' => 'medium',
	'Class:Risk/Attribute:priority/Value:4' => 'low',
	'Class:Risk/Attribute:priority/Value:4+' => 'low',


	'Class:Risk/Attribute:occurrence-probability/Value:1' => 'critical',
	'Class:Risk/Attribute:occurrence-probability/Value:1+' => 'critical',
	'Class:Risk/Attribute:occurrence-probability/Value:2' => 'high',
	'Class:Risk/Attribute:occurrence-probability/Value:2+' => 'high',
	'Class:Risk/Attribute:occurrence-probability/Value:3' => 'medium',
	'Class:Risk/Attribute:occurrence-probability/Value:3+' => 'medium',
	'Class:Risk/Attribute:occurrence-probability/Value:4' => 'low',
	'Class:Risk/Attribute:occurrence-probability/Value:4+' => 'low',



	'Class:NormalChange/Attribute:risk_list' => 'Risk List',
	'Class:EmergencyChange/Attribute:risk_list' => 'Risk List',
	'Class:RoutineChange/Attribute:risk_list' => 'Risk List',
	'Class:Service/Attribute:risk_list' => 'Risk List',



));
?>
