<?php



class PersianCal implements iPageUIExtension
{
	
    
    protected $MODULE_PATH = '../env-production/suntech-general';
    
    protected $DB_OBJECT_PATH = array(
        ('../env-production/suntech-general/dbobject.class.php'),
        '../core/dbobject.class.php'
    );
    protected $CMDB_ABSTRACT_PATH = array(
        '../env-production/suntech-general/cmdbabstract.class.inc.php',
        '../application/cmdbabstract.class.inc.php'
    );
    protected $PERSIAN_CAL = Array(
        '../env-production/suntech-general/PersianCalendar.php',
        '../application/PersianCalendar.php'
    
    );
    protected $UI_PATH = Array(
        '../env-production/suntech-general/UI.php',
        '../pages/UI.php'
    
    );

    protected $NICE_PATH = Array(
        '../env-production/suntech-general/nicewebpage.class.inc.php',
        '../application/nicewebpage.class.inc.php'
    
    );
    
    
    /**
	 * Add content to the North pane
	 * @param iTopWebPage $oPage The page to insert stuff into.
	 * @return string The HTML content to add into the page
	 */
	public function GetNorthPaneHtml(iTopWebPage $oPage)
    {
        $oUserContact = UserRights::GetContactOBject();
        $u = $oUserContact->Get('first_name').' '.$oUserContact->Get('name');
        //language detection
        $lan = Dict::GetUserLanguage();
        $oPage->add_ready_script(
<<<EOF
        newUser = "$u";
        lang = "$lan";

        $(document).ready(function(){
            newUser = "$u";
            lang = "$lan";

            setDim();
            setTimeout(setDim , 100);
        });
EOF
    );

        $oUserContact = UserRights::GetContactOBject();
        $org = $oUserContact->Get('org_id');
        $orgName = $oUserContact->Get('org_name');
        $oPage->add_ready_script(
<<<EOF
        var org = "$org";
        var orgName = "$orgName";
        function updateOrg(){
            $('#2_org_id').val(org);
            $('#label_2_org_id').val(orgName);
            $('#2_org_id').trigger('change');
        }

        $(document).ready(function(){
            var url_string = window.location.href;
            var url = new URL(url_string);
            var sclass = url.searchParams.get("class");
            var operation = url.searchParams.get("operation");
            if(sclass=='UserRequest'||sclass=='Change'||sclass=='NormalChange'||sclass=='RoutineChange'||sclass=='EmergencyChange'||sclass=='Problem'||sclass=='Communication'||sclass=='WarehouseDocument')
            {
                if(operation=='new'){
                    updateOrg();
                    //setTimeout(updateOrg);
                }
            }
            
        });
EOF
    );
        
        
        $oPage->add_linked_stylesheet($this->MODULE_PATH.'/css/kamadatepicker.css');
/*
        $oPage->add_linked_stylesheet($this->MODULE_PATH.'/cal/bootstrap-iso.css');
        $oPage->add_linked_stylesheet($this->MODULE_PATH.'/cal/jquery.Bootstrap-PersianDateTimePicker.css');
        */
        $text = "";
        
        
        // if the size of the files are equal there is no need to copy
        
        if (file_exists($this->DB_OBJECT_PATH[1]))
        {
            if (!self::checkSize($this->DB_OBJECT_PATH[0] ,$this->DB_OBJECT_PATH[1] ))
            {
                copy($this->DB_OBJECT_PATH[0] , $this->DB_OBJECT_PATH[1]);
            }            
        }

        
        
        if (file_exists($this->CMDB_ABSTRACT_PATH[1]))
        {
            if (!self::checkSize($this->CMDB_ABSTRACT_PATH[0] ,$this->CMDB_ABSTRACT_PATH[1] ))
            {
                copy($this->CMDB_ABSTRACT_PATH[0] , $this->CMDB_ABSTRACT_PATH[1]);
            }            
        }

        
        if (!file_exists($this->PERSIAN_CAL[1]))
        {
            if (file_exists($this->PERSIAN_CAL[0])) {
                copy($this->PERSIAN_CAL[0] , $this->PERSIAN_CAL[1]);
            }
            
        }

        if (file_exists($this->UI_PATH[1]))
        {
             if (!self::checkSize($this->UI_PATH[0] ,$this->UI_PATH[1] ))
            {
                copy($this->UI_PATH[0] , $this->UI_PATH[1]);
            }           
        }


        if (file_exists($this->NICE_PATH[1]))
        {
            if (!self::checkSize($this->NICE_PATH[0] ,$this->NICE_PATH[1] ))
            {
                copy($this->NICE_PATH[0] , $this->NICE_PATH[1]);
            }            
        }

        
        return $text;
    }
    
	/**
	 * Add content to the South pane
	 * @param iTopWebPage $oPage The page to insert stuff into.
	 * @return string The HTML content to add into the page
	 */
	public function GetSouthPaneHtml(iTopWebPage $oPage)
    {

        $oPage->add_linked_script($this->MODULE_PATH.'/js/kamadatepicker.js');
        $oPage->add_linked_script($this->MODULE_PATH.'/js/myscript.js');
/*
        $oPage->add_linked_script($this->MODULE_PATH.'/cal/calendar.js');
        $oPage->add_linked_script($this->MODULE_PATH.'/cal/jquery.Bootstrap-PersianDateTimePicker.js');
        $oPage->add_linked_script($this->MODULE_PATH.'/cal/bootstrap.min.js');
        $oPage->add_linked_script($this->MODULE_PATH.'/cal/loader.js');
*/
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
    
    protected static function checkSize($path1 , $path2)
    {
        $s1 = filesize($path1);
        $s2 = filesize($path2);
        
        
        if ($s1 ==$s2)
        {
            return true;
        }
        else
        {
            return false;    
        }
        
    }
}

class PersianCalPortal implements iPortalUIExtension
{

    /**
     * Returns an array of CSS file urls
     *
     * @param \Silex\Application $oApp
     * @return array
     */
    public function GetCSSFiles(\Silex\Application $oApp)
    {

        return array();


    }
    /**
     * Returns inline (raw) CSS
     *
     * @param \Silex\Application $oApp
     * @return string
     */
    public function GetCSSInline(\Silex\Application $oApp)
    {

        //


    }
    /**
     * Returns an array of JS file urls
     *
     * @param \Silex\Application $oApp
     * @return array
     */
    public function GetJSFiles(\Silex\Application $oApp)
    {

        return array();


    }
    /**
     * Returns raw JS code
     *
     * @param \Silex\Application $oApp
     * @return string
     */
    public function GetJSInline(\Silex\Application $oApp)
    {

        $script = '$(document).ready(function(){';
        $script .= 'var url = window.location.href;';
        $script .= 'var absRoot = url.substring(0, url.lastIndexOf(\'pages\'));';
        $script .='$(\'.logo a img\').attr(\'src\' , (absRoot  + \'/env-production/suntech-general/src/itop-logo-external-dark.png\'));';
        $script .='$(\'.logo a\').attr(\'href\' , \'http://www.samanitg.com\');';
        $script .='$(\'.logo a\').attr(\'target\' , \'_blank\');';
        $script .= '});';

        return $script;


    }
    /**
     * Returns raw HTML code to put at the end of the <body> tag
     *
     * @param \Silex\Application $oApp
     * @return string
     */
    public function GetBodyHTML(\Silex\Application $oApp)
    {

        //


    }
    /**
     * Returns raw HTML code to put at the end of the #main-wrapper element
     *
     * @param \Silex\Application $oApp
     * @return string
     */
    public function GetMainContentHTML(\Silex\Application $oApp)
    {

        //


    }
    /**
     * Returns raw HTML code to put at the end of the #topbar and #sidebar elements
     *
     * @param \Silex\Application $oApp
     * @return string
     */
    public function GetNavigationMenuHTML(\Silex\Application $oApp)
    {

        //


    }
}