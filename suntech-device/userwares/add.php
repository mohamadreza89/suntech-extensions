<?php

require_once('vendor/autoload.php');
require_once('../../conf/production/config-itop.php');
require_once('database.php');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$APPROOT = $request->getRequestUri();
$method = $request->getMethod();

switch ($method) {
	case 'GET':
		//load the form
	if (($request->query->get('Class')=="")||($request->query->get('Username')==""))
	{

	$response = new Response(
	    require_once('form.php'),
	    Response::HTTP_OK,
	    array('content-type' => 'text/html')
	);

	}else{

	$response = new Response(
	    require_once('data_center.php'),
	    Response::HTTP_OK,
	    array('content-type' => 'text/html')
	);
	}
		break;
	
	case 'POST' :
		//load the database edditing page
	$response = new Response(
	    require_once('data_center.php'),
	    Response::HTTP_OK,
	    array('content-type' => 'text/html')
	);
		break;
}

//$response->prepare($request);
//$response->send();
