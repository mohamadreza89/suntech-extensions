<?php



class SuntechTheme implements iPageUIExtension
{   
    protected $MODULE_PATH = '../env-production/suntech-theme';
    
    /**
	 * Add content to the North pane
	 * @param iTopWebPage $oPage The page to insert stuff into.
	 * @return string The HTML content to add into the page
	 */
	public function GetNorthPaneHtml(iTopWebPage $oPage)
    {
                
        //
    }
    
	/**
	 * Add content to the South pane
	 * @param iTopWebPage $oPage The page to insert stuff into.
	 * @return string The HTML content to add into the page
	 */
	public function GetSouthPaneHtml(iTopWebPage $oPage)
    {
        $oPage->add_linked_script($this->MODULE_PATH.'/js/myscript.js');
        $oPage->add_linked_stylesheet($this->MODULE_PATH.'/css/mystyle.css');
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

class SuntechThemePortal implements iPortalUIExtension
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

        $script = '';

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