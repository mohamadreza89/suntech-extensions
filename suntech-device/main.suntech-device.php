<?php


/**
 * Implement this interface to add content to any iTopWebPage
 * 
 * There are 3 places where content can be added:
 * 
 * * The north pane: (normaly empty/hidden) at the top of the page, spanning the whole
 *   width of the page
 * * The south pane: (normaly empty/hidden) at the bottom of the page, spanning the whole
 *   width of the page
 * * The admin banner (two tones gray background) at the left of the global search.
 *   Limited space, use it for short messages
 * 
 * Each of the methods of this interface is supposed to return the HTML to be inserted at
 * the specified place and can use the passed iTopWebPage object to add javascript or CSS definitions
 *
 * @package     Extensibility
 * @api
 * @since 2.0  
 */
class SuntechDevice implements iPageUIExtension
{
	public function recurse_copy($src,$dst) {
	    $dir = opendir($src);
	    @mkdir($dst);
	    while(false !== ( $file = readdir($dir)) ) {
	        if (( $file != '.' ) && ( $file != '..' )) {
	            if ( is_dir($src . '/' . $file) ) {
	                $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
	            }
	            else {
	                copy($src . '/' . $file,$dst . '/' . $file);
	            }
	        }
	    }
	    closedir($dir);
	} 
		/**
	 * Add content to the North pane
	 * @param iTopWebPage $oPage The page to insert stuff into.
	 * @return string The HTML content to add into the page
	 */
	public function GetNorthPaneHtml(iTopWebPage $oPage)
    {
        //
        $text="";
        if (!file_exists('../webservices/userwares/list.php'))
        {
            $this->recurse_copy('../env-production/suntech-device/userwares' , '../webservices/userwares');
        }
        if (!file_exists('../webservices/runsql.php'))
        {
            copy('../env-production/suntech-device/runsql.php' ,'../webservices/runsql.php' );
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