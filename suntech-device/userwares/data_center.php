<?php

require_once 'Models/UserHW.php';
require_once 'Models/UserSW.php';


// get newValues

if ($method =='POST')
{
	$sClass = $request->request->get('Class');
	$sUsername = $request->request->get('Username');
	$jData = $request->request->get('Data');
}
elseif ($method =='GET') 
{
	$sClass = $request->query->get('Class');
	$sUsername = $request->query->get('Username');
	$jData = $request->query->get('Data');
}


//get new values from the input parameters
$newValues = json_decode($jData, true);


if ($sClass=='user_hardware')
{
	// get oldValues with defined username
	$oldValues = UserHW::where('username' , $sUsername)->get()->toArray();
	// here the values which are going to have deleted status will be specified
	foreach ($oldValues as $oldV)
	{
		// define whether if the record still exists or not
		$stillExists = 0;
		if(!$newValues=="")
		{

		foreach ($newValues as $newV) 
		{
			if (($newV['hardware_type']==$oldV['hardware_type'])&&($newV['serial_number']==$oldV['serial_number'])&&($newV['mac_id']==$oldV['mac_id']))
			{
				$stillExists =1;
			}	
		}

		}
		// if the old record does not exist the status would be updated to removed
		if ($stillExists == 0)
		{
			if ($oldV['status']=='a')
			{
				$id = $oldV['id'];
				$record = UserHW::find($id);
				$record->status = 'r';
				$record->save();

				echo $id . " status updated to removed";
				echo "<br/>";
			}
		}
		elseif ($stillExists ==1)
		{
			if ($oldV['status']=='r')
			{
				$id = $oldV['id'];
				$record = UserHW::find($id);
				$record->status = 'a';
				$record->save();

				echo $id . " status updated to 'added'";
				echo "<br/>";
			}
		}
	}

			 	
	// here the new values are going to be defined whether they have to be inserted or update the old ones.
	if(!$newValues=="")
	{	
	foreach ($newValues as $newV)
	{
		$exists = 0;
		foreach ($oldValues as $oldV)
		{
			
			if (($newV['hardware_type']==$oldV['hardware_type'])&&($newV['serial_number']==$oldV['serial_number'])&&($newV['mac_id']==$oldV['mac_id']))
			{
				$exists = 1;
				$id = $oldV['id'];

			}
		}

		
		if ($exists ==0)
		{
			//insert new

			$record = new UserHW;
			$record->username = $sUsername;
			$record->hardware_type = $newV['hardware_type'];
			$record->serial_number = $newV['serial_number'];
			$record->description = $newV['description'];
			$record->mac_id = $newV['mac_id'];
			$record->datetime = time();
			$record->status = 'a';
			$record->confirmed = 0;

			$record->save();
			echo "New item inserted";
			echo "<br/>";
		}
		else
		{
			//update with new datetime
			$record = UserHW::find($id);
			$record->datetime = time();
			$record->save();

			echo $id . " datetime updated";
			echo "<br/>";
		}
	}
	}
}
elseif ($sClass=='user_software') 
{
	// get oldValues with defined username
	$oldValues = UserSW::where('username' , $sUsername)->get()->toArray();

	// here the values which are going to have deleted status will be specified
	foreach ($oldValues as $oldV)
	{
		// define wheter if the record still exists or not
		$stillExists = 0;
		if(!$newValues=="")
		{	
		foreach ($newValues as $newV) 
		{
			if ($newV['software_title']==$oldV['software_title'])
			{$stillExists =1;}	
		}
		}

		// if the old record does not exist the status would be updated to removed
		if ($stillExists == 0)
		{
			$id = $oldV['id'];
			$record = UserSW::find($id);
			$record->status = 'r';
			$record->save();

			echo $id . " status updated to removed";
			echo "<br/>";
		}
	}

			 	
	// here the new values are going to be defined whether they have to be inserted or update the old ones.	
	if(!$newValues=="")
	{	
	foreach ($newValues as $newV)
	{
		$exists = 0;
		foreach ($oldValues as $oldV)
		{
			
			if ($newV['software_title']==$oldV['software_title'])
			{
				$exists = 1;
				$id = $oldV['id'];

			}
		}

		
		if ($exists ==0)
		{
			//insert new

			$record = new UserSW;
			$record->username = $sUsername;
			$record->software_title = $newV['software_title'];
			$record->description = $newV['description'];
			$record->datetime = time();
			$record->status = 'a';
			$record->confirmed = 0;

			$record->save();
			echo "New item inserted";
			echo "<br/>";
		}
		else
		{
			//update with new datetime
			$record = UserSW::find($id);
			$record->datetime = time();
			$record->save();

			echo $id . " datetime updated";
			echo "<br/>";
		}
	}
	}
}