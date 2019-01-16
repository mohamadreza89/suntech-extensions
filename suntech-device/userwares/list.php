<?php

require_once('vendor/autoload.php');
require_once('../../conf/production/config-itop.php');
require_once('database.php');
require_once 'Models/UserHW.php';
require_once 'Models/UserSW.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$APPROOT = $request->getRequestUri();
$method = $request->getMethod();
$sClass = $request->query->get('Class');
if ($sClass=="")
{
	$response = new Response(
	    require_once('form_list.php'),
	    Response::HTTP_OK,
	    array('content-type' => 'text/html')
	);
}else{
if ($method =='GET')
{
	
	if ($sClass =='user_hardware')
	{
		$mac_id = $request->query->get('mac_id');
		$username = $request->query->get('username');
		$hardware_type = $request->query->get('hardware_type');
		$status = $request->query->get('status');
		$confirmed = $request->query->get('confirmed');
		$serial_number = $request->query->get('serial_number');
		$fromDateTime = $request->query->get('fromDateTime');
		$toDateTime = $request->query->get('toDateTime');

		$records = UserHW::all();
		$records = ($hardware_type)? $records->where('hardware_type',$hardware_type):$records;
		$records = ($mac_id)? $records->where('mac_id',$mac_id):$records;
		$records = ($status)? $records->where('status',$status):$records;
		$records = ($confirmed)? $records->where('confirmed',$confirmed):$records->where('confirmed',0);
		$records = ($serial_number)? $records->where('serial_number',$serial_number):$records;
		$records = ($fromDateTime)? $records->where('datetime','>=',$fromDateTime):$records;
		$records = ($toDateTime)? $records->where('datetime','<=',$toDateTime):$records;
		$records = ($username)? $records->where('username',$username):$records;

		$records = $records->toArray();

		// if($hardware_type !=""){
		// 	$records = $records->where('hardware_type',$hardware_type);
		// }
		

		//$records = UserHW::where('confirmed', 0)->get()->toArray();
	}
	elseif ($sClass =='user_software') 
	{
		
		$username = $request->query->get('username');
		$software_title = $request->query->get('software_title');
		$status = $request->query->get('status');
		$confirmed = $request->query->get('confirmed');
		$fromDateTime = $request->query->get('fromDateTime');
		$toDateTime = $request->query->get('toDateTime');

		$records = UserSW::all();
		$records = ($software_title)? $records->where('software_title',$software_title):$records;
		$records = ($status)? $records->where('status',$status):$records;
		$records = ($confirmed)? $records->where('confirmed',$confirmed):$records->where('confirmed',0);
		$records = ($fromDateTime)? $records->where('datetime','>=',$fromDateTime):$records;
		$records = ($toDateTime)? $records->where('datetime','<=',$toDateTime):$records;
		$records = ($username)? $records->where('username',$username):$records;

		$records = $records->toArray();
	}
	


	$data = json_encode($records);


	$response = new Response(
	    $data,
	    Response::HTTP_OK,
	    array('content-type' => 'application/json')
	);
}
}
$response->prepare($request);
$response->send();