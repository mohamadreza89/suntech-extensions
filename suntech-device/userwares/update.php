<?php

require_once('vendor/autoload.php');
require_once('../../conf/production/config-itop.php');
require_once('database.php');
require_once 'Models/UserHW.php';
require_once 'Models/UserSW.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

function is_valid($item)
{
	if (isset($item['id'])&&isset($item['confirmed']))
	{
		return true;
	}
	else{
		return false;
	}
}

function proccess($method , Request $request)
{
	if ($method =='POST')
	{
		$sClass = $request->request->get('Class');
		$jData = $request->request->get('Data');
	}
	elseif ($method =='GET') 
	{
		$sClass = $request->query->get('Class');
		$jData = $request->query->get('Data');
	}

	$aData = json_decode($jData , true);
	
	if ($sClass =='user_hardware')
	{
		foreach ($aData as $item) {
			if (is_valid($item))
			{
				$record = UserHW::find($item['id']);
				$record->confirmed = $item['confirmed'];
				$record->save();
			}
		}
		
	}
	elseif ($sClass =='user_software') 
	{
		foreach ($aData as $item) {
			if (is_valid($item))
			{
				$record = UserSW::find($item['id']);
				$record->confirmed = $item['confirmed'];
				$record->save();
			}
		}
	}

	$response = new Response(
	    'Database Updated Successfully',
	    Response::HTTP_OK,
	    array('content-type' => 'text/html')
	);

	return $response;
}



$request = Request::createFromGlobals();

$APPROOT = $request->getRequestUri();
$method = $request->getMethod();


if ($method =='POST')
{
	$response = proccess($method , $request);
}
else
{
	if(($request->query->get('Class')=="")||($request->query->get('Data')==""))
	{
		$response = new Response(
		    require_once('form.php'),
		    Response::HTTP_OK,
		    array('content-type' => 'text/html')
		);		
	}
	else
	{
		$response = proccess($method , $request);
	}

}

$response->prepare($request);
$response->send();
