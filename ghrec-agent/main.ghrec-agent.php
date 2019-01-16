<?php


class GhrecAgentUI implements iPageUIExtension
{
	/**
	 * Add content to the North pane
	 * @param iTopWebPage $oPage The page to insert stuff into.
	 * @return string The HTML content to add into the page
	 */
	public function GetNorthPaneHtml(iTopWebPage $oPage)
	{
		$appRoot = utils::GetAbsoluteUrlAppRoot();
		$url1 = $appRoot.'pages/exec.php?exec_module=ghrec-agent&exec_page=agent.php&menu=OpenRequests';
		$url2 = $appRoot.'pages/exec.php?exec_module=ghrec-agent&exec_page=agent.php&menu=EscalatedRequests';
		$url3 = $appRoot.'pages/exec.php?exec_module=ghrec-agent&exec_page=agent.php&menu=SearchUserRequests';
		$oPage->add_ready_script(
<<<EOF
		function updateRequestLinks(){
			$('#AccordionMenu_UserRequest_OpenRequests a').attr('href', "$url1");
			$('#AccordionMenu_UserRequest_EscalatedRequests a').attr('href', "$url2");
			$('#AccordionMenu_SearchUserRequests a').attr('href', "$url3");
		}
		$(document).ready(function(){
			function updateRequestLinks(){
			$('#AccordionMenu_UserRequest_OpenRequests a').attr('href', "$url1");
			$('#AccordionMenu_UserRequest_EscalatedRequests a').attr('href', "$url2");
			$('#AccordionMenu_SearchUserRequests a').attr('href', "$url3");
		}
			updateRequestLinks();
			setTimeout(updateRequestLinks,1000);
		});
EOF
		);

		


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


		if (isset($aUserProfiles['Support Agent']))
        {
            if ((count($aUserProfiles) == 1) && ($aUserProfiles['Support Agent'] == true))
            {
            	$menu = utils::ReadParam('menu', '');
            	if ($menu == 'OpenRequests' OR $menu == 'EscalatedRequests' OR $menu == 'SearchUserRequests'){

            	$oPage->add_ready_script(
<<<EOF
	function disableSearchFields(){
		$('#0search_agent_id').siblings().prop('disabled',true)
	}
	$(document).ready(function(){
		function disableSearchFields(){
			$('#0search_agent_id').siblings().prop('disabled',true)
		}
		disableSearchFields();
		setTimeout(disableSearchFields,1000);
	});
EOF
						);
            }
            }
        }

		
	}
	/**
	 * Add content to the South pane
	 * @param iTopWebPage $oPage The page to insert stuff into.
	 * @return string The HTML content to add into the page
	 */
	public function GetSouthPaneHtml(iTopWebPage $oPage)
	{
		//
	}
	/**
	 * Add content to the "admin banner"
	 * @param iTopWebPage $oPage The page to insert stuff into.
	 * @return string The HTML content to add into the page
	 */
	public function GetBannerHtml(iTopWebPage $oPage)
	{
		//
	}
}
