<?php




/*
*	Custom functions by Amn-Negar
*	Author: M.R. Pishdad
*/
function refresh($req){		
	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);		
	$new_url = 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0]. '?'. http_build_query($req);		
		
	header('Location: '.$new_url);
}

function checkSize($path1 , $path2)		
{		
    $s1 = filesize($path1);
    $s2 = filesize($path2);	
    if ($s1 ==$s2)
    {return true;}else{return false;}
}

function checkProfileAuth ($UserProfiles , $aData , $custom_page , $sublink = 'index')
{
	foreach ($UserProfiles as $profile => $value) {
		if ($profile =='Administrator' && $value==true)
		{
			return $profile;
		}
		if ($value)
		{
			if (array_key_exists($custom_page, $aData))
			{
				if (array_key_exists($profile, $aData[$custom_page]))
				{
					if (array_key_exists($sublink, $aData[$custom_page][$profile]))
					{
						$tt = $aData[$custom_page][$profile][$sublink];
						if($tt)
						{
							return $profile;
						}
					}
				}
			}

		}
	}
	return false;
}

/*
*	Check if user IP matches the one in db or not
*
*/
function checkAuthUserIP($username, $userip )
{
	//get user from column user name
	$oUser = MetaModel::GetObjectByColumn('UserLogin' , 'user_name' , $username , false);

	if ($oUser == null)
	{
		$oNewUser = MetaModel::NewObject('UserLogin');
		$oNewUser->Set('user_name' , $username);
		$oNewUser->Set('ip' , $userip);
		$oNewUser->DBInsertNoReload();
		return true;
	}
	else
	{
		//get user ip from db
		if ($userip == $oUser->Get('ip'))
		{
			return true;
		} 
		else
		{
			if (file_exists('session_log.txt')){
				$fff = fopen("session_log.txt","r");
				$jData =  fread($fff, filesize('session_log.txt'));
				fclose($fff);
				$aData = json_decode($jData , 'true');
				$aData[] = "user = " . $username . " and previous IP of " . $oUser->Get('ip') . " got logout by the new IP of " . $userip . " at : ". date('d-M-Y h:i:s',time());
				$fff = fopen("session_log.txt","w");
				fwrite($fff,json_encode($aData));
				fclose($fff);
			}
			else
			{
				$aData[] = "user = " . $username . " and previous IP of " . $oUser->Get('ip') . " got logout by the new IP of " . $userip . " at : ". date('d-M-Y h:i:s',time());
				$fff = fopen("session_log.txt","w");
				fwrite($fff,json_encode($aData));
				fclose($fff);
			}
			
			return false;
		}
	}
}


// End if Amn Negar Custom Functions



require_once('../approot.inc.php');
require_once(APPROOT.'/application/application.inc.php');
require_once(APPROOT.'/application/itopwebpage.class.inc.php');
require_once(APPROOT.'/application/wizardhelper.class.inc.php');

require_once(APPROOT.'/application/startup.inc.php');

try
{

	$operation = utils::ReadParam('operation', '');
	$bPrintable = (utils::ReadParam('printable', 0) == '1');

	$oKPI = new ExecutionKPI();
	$oKPI->ComputeAndReport('Data model loaded');

	$oKPI = new ExecutionKPI();

	/*
	*	Code written by Saman AmnNegar
	*/

	if (isset($_SESSION['auth_user']))
	{
		if (!checkAuthUserIP($_SESSION['auth_user'] , $_SERVER['REMOTE_ADDR'] ))
		{
			unset($_SESSION['auth_user']);
		}
	}
	// end of saman code

	require_once(APPROOT.'/application/loginwebpage.class.inc.php');
	$sLoginMessage = LoginWebPage::DoLogin(); // Check user rights and prompt if needed
	$oAppContext = new ApplicationContext();

	$oKPI->ComputeAndReport('User login');

	$oP = new iTopWebPage(Dict::S('UI:WelcomeToITop'), $bPrintable);
	$oP->SetMessage($sLoginMessage);

	/*
	*	Codes written by Saman AmnNegar
	*	Author: M.R.Pishdad
	*/


	// update user ip or create new one
	if (isset($_SESSION['auth_user']))
	{
		$username = $_SESSION['auth_user'];
		$userip = $_SERVER['REMOTE_ADDR'];

		$oUser = MetaModel::GetObjectByColumn('UserLogin' , 'user_name' , $username , false);
		if ($oUser == null)
		{
			$oNewUser = MetaModel::NewObject('UserLogin');
			$oNewUser->Set('user_name' , $username);
			$oNewUser->Set('ip' , $userip);
			$oNewUser->DBInsertNoReload();
			
		}
		else
		{
			//get user ip from db
			if ($userip != $oUser->Get('ip'))
			{
				$oUser->Set('ip' , $userip);
				$oUser->DBUpdate();
			}
		}
	}


	//language detection
	$lan = Dict::GetUserLanguage();
	//end

		// getting user profiles
	$oUser = UserRights::GetUserObject();
	$aUserProfiles = array();
	if (!is_null($oUser))
	{
		$oProfileSet = $oUser->Get('profile_list');
		while ($oProfile = $oProfileSet->Fetch())
		{
			$aUserProfiles[$oProfile->Get('profile')] = true;
		}
	}






	/***************************************
	****************************************
	******* The Content Starts Here ********
	****************************************
	***************************************/

    ApplicationMenu::LoadAdditionalMenus();
    $menu = utils::ReadParam('menu', '');
    if ($menu != 'SearchUserRequests'){
    	$menu = 'UserRequest:'.$menu;
    }
    

        if (isset($aUserProfiles['Support Agent']))
        {
            if ((count($aUserProfiles) == 1) && ($aUserProfiles['Support Agent'] == true))
            {
                switch ($menu)
                {
                case 'OpenRequests':
                	$oMenuNode = ApplicationMenu::GetMenuNode(ApplicationMenu::GetMenuIndexById('UserRequest:' . $menu));
                    OQLMenuNode::RenderOQLSearch('SELECT UserRequest WHERE status NOT IN ("Closed") AND agent_id = :current_contact_id', $oMenuNode->GetLabel() , 'Menu_' . $oMenuNode->GetMenuId() , True, // Search pane
                    false, // Search open
                    $oP);
                    break;

                case 'EscalatedRequests':
	                $oMenuNode = ApplicationMenu::GetMenuNode(ApplicationMenu::GetMenuIndexById('UserRequest:' . $menu));
                    OQLMenuNode::RenderOQLSearch('SELECT UserRequest WHERE (status IN ("escalated_tto", "escalated_ttr") OR escalation_flag="yes") AND (agent_id = :current_contact_id)', $oMenuNode->GetLabel() , 'Menu_' . $oMenuNode->GetMenuId() , false, // Search pane
                    false, // Search open
                    $oP);
                    break;

                case 'SearchUserRequests':
 					$oMenuNode = ApplicationMenu::GetMenuNode(ApplicationMenu::GetMenuIndexById('UserRequest:OpenRequests'));
                    OQLMenuNode::RenderOQLSearch('SELECT UserRequest WHERE agent_id = :current_contact_id', $oMenuNode->GetLabel() , 'Menu_' . $oMenuNode->GetMenuId() , true, // Search pane
                    true, // Search open
                    $oP);

                    break;

                default:
                    //
                    break;
                }
            }
            else
            {
            	$oMenuNode = ApplicationMenu::GetMenuNode(ApplicationMenu::GetMenuIndexById($menu));
                $oMenuNode->RenderContent($oP, $oAppContext->GetAsHash());
                $oP->set_title($oMenuNode->GetLabel());
            }
        }
        else
        {
        	$oMenuNode = ApplicationMenu::GetMenuNode(ApplicationMenu::GetMenuIndexById($menu));
            $oMenuNode->RenderContent($oP, $oAppContext->GetAsHash());
            $oP->set_title($oMenuNode->GetLabel());
        }
    

    /***************************************
    ****************************************
    ******* The Content Ends Here ********
    ****************************************
    ***************************************/
    $oP->output();
}
catch(CoreException $e)
{
	require_once(APPROOT.'/setup/setuppage.class.inc.php');
	$oP = new SetupPage(Dict::S('UI:PageTitle:FatalError'));
	if ($e instanceof SecurityException)
	{
		$oP->add("<h1>".Dict::S('UI:SystemIntrusion')."</h1>\n");
	}
	else
	{
		$oP->add("<h1>".Dict::S('UI:FatalErrorMessage')."</h1>\n");
	}	
	$oP->error(Dict::Format('UI:Error_Details', $e->getHtmlDesc()));	
	$oP->output();

	if (MetaModel::IsLogEnabledIssue())
	{
		if (MetaModel::IsValidClass('EventIssue'))
		{
			try
			{
				$oLog = new EventIssue();
	
				$oLog->Set('message', $e->getMessage());
				$oLog->Set('userinfo', '');
				$oLog->Set('issue', $e->GetIssue());
				$oLog->Set('impact', 'Page could not be displayed');
				$oLog->Set('callstack', $e->getTrace());
				$oLog->Set('data', $e->getContextData());
				$oLog->DBInsertNoReload();
			}
			catch(Exception $e)
			{
				IssueLog::Error("Failed to log issue into the DB");
			}
		}

		IssueLog::Error($e->getMessage());
	}

	// For debugging only
	//throw $e;
}
catch(Exception $e)
{
	require_once(APPROOT.'/setup/setuppage.class.inc.php');
	$oP = new SetupPage(Dict::S('UI:PageTitle:FatalError'));
	$oP->add("<h1>".Dict::S('UI:FatalErrorMessage')."</h1>\n");	
	$oP->error(Dict::Format('UI:Error_Details', $e->getMessage()));
	$oP->output();

	if (MetaModel::IsLogEnabledIssue())
	{
		if (MetaModel::IsValidClass('EventIssue'))
		{
			try
			{
				$oLog = new EventIssue();
	
				$oLog->Set('message', $e->getMessage());
				$oLog->Set('userinfo', '');
				$oLog->Set('issue', 'PHP Exception');
				$oLog->Set('impact', 'Page could not be displayed');
				$oLog->Set('callstack', $e->getTrace());
				$oLog->Set('data', array());
				$oLog->DBInsertNoReload();
			}
			catch(Exception $e)
			{
				IssueLog::Error("Failed to log issue into the DB");
			}
		}

		IssueLog::Error($e->getMessage());
	}
}

