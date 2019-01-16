<?php
/**
 * Localized data
 *
 * @copyright   Copyright (C) 2013 XXXXX
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

Dict::Add('FA IR', 'Persian', 'Persian', array(
	// Dictionary entries go here
	'Class:Ticket/Attribute:ip' => 'IP Address',
	'Class:Ticket/Attribute:start_date_temp' => 'Start Date',
	'Class:Ticket/Attribute:end_date_temp' => 'End Date',
	'Class:ApprovedChange/Attribute:approval_date_temp' => 'Approval Date',
	'Class:NormalChange/Attribute:acceptance_date_temp' => 'Acceptance Date',
	
	'Class:PhysicalDevice/Attribute:it_asset_number' => 'IT Asset number',
	'Class:Peripheral/Attribute:device_type' => 'Device Type',
	'Class:Peripheral/Attribute:device_type/Value:mouse' => 'Mouse',
	'Class:Peripheral/Attribute:device_type/Value:mouse+' => 'Mouse',
	'Class:Peripheral/Attribute:device_type/Value:keyboard' => 'Keyboard',
	'Class:Peripheral/Attribute:device_type/Value:keyboard+' => 'Keyboard',
	'Class:Peripheral/Attribute:device_type/Value:light_pen' => 'Light Pen',
	'Class:Peripheral/Attribute:device_type/Value:light_pen+' => 'Light Pen',
	'Class:Peripheral/Attribute:device_type/Value:scanner' => 'Scanner',
	'Class:Peripheral/Attribute:device_type/Value:scanner+' => 'Scanner',
	
	'Class:UserRequest/Attribute:request_type/Value:event' => 'Event',
	'Class:UserRequest/Attribute:request_type/Value:event+' => 'Event',
	'Class:UserRequest/Attribute:request_type/Value:weakness' => 'Weakness',
	'Class:UserRequest/Attribute:request_type/Value:weakness+' => 'Weakness',

	'Class:UserRequest/Attribute:resolving_duration' => 'زمان پاسخ (دقیقه)',
    
    'Class:Contract/Attribute:cost_currency/Value:rials' => 'ریال',
    'Class:Person/Attribute:national_code' => 'کد ملی',




    'Class:Server/Attribute:effective_life' => 'عمر مفید',
	'Class:PhysicalDevice/Attribute:effective_life' => 'عمر مفید',
	'Class:ConnectableCI/Attribute:effective_life' => 'عمر مفید',
	'Class:DatacenterDevice/Attribute:effective_life' => 'عمر مفید',
	'Class:NetworkDevice/Attribute:effective_life' => 'عمر مفید',



	'Class:Service/Attribute:urgency' => 'اولویت',
    'Class:Service/Attribute:urgency/Value:critical' => 'بحرانی',
    'Class:Service/Attribute:urgency/Value:high' => 'بالا',
    'Class:Service/Attribute:urgency/Value:medium' => 'معمولی',
    'Class:Service/Attribute:urgency/Value:low' => 'پایین',
));
?>
