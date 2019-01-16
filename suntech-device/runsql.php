<?php

/**
*
*  iTop config file
*/
include('../conf/production/config-itop.php');

/**
*
*  Constants
*/
$HOST = $MySettings['db_host'];
$USERNAME = $MySettings['db_user'];
$PASSWORD = $MySettings['db_pwd'];
$DATABASE = $MySettings['db_name'];
$ITOPROOT = $MySettings['app_root_url'];
$APPROOT = $_SERVER['REQUEST_URI'];

if (isset($_GET['usr'])&&isset($_GET['ld'])) {
    
    $username = $_GET['usr'];
    $last_date= $_GET['ld'];


    $con = mysqli_connect($HOST , $USERNAME , $PASSWORD , $DATABASE);
    mysqli_set_charset($con , "utf8");
    /*
    **
    **  MySQL scripts
    **
    */

    //$sql = "SELECT * FROM functionalci";

    
   $sql = "SELECT Now() as LastDateTime, 
priv_event.id,
priv_event.date,
priv_event.userinfo,
priv_event_email.to, 
priv_event_email.subject, 
priv_event_notification.trigger_id,
priv_event_notification.action_id,
priv_event_notification.object_id,
case 
  when priv_event_email.subject like '%P%' then 'Problem'
  when priv_event_email.subject like '%R%' then 'UserRequest'
  when priv_event_email.subject like '%I%' then 'Incident'
  when priv_event_email.subject like '%C%' then 'Change'
end as ticket_type
FROM db_suntech.priv_event_email 
join db_suntech.priv_event on db_suntech.priv_event_email.id = db_suntech.priv_event.id
join db_suntech.priv_event_notification on db_suntech.priv_event_email.id = db_suntech.priv_event_notification.id
where realclass ='EventNotificationEmail'";

    $sql .= " AND priv_event_email.to like '%". $username . "%'";
    $sql .= " AND date > '" . $last_date . "'";

    
    /*
    **
    ** Rest of the app
    **
    */
        
    $res = mysqli_query($con , $sql);
    
    $i=0;
    $out = array();
if (!$res == null){
    while ($row = mysqli_fetch_assoc($res)) {
        $out[$i++] = $row;
    }
	
	mysqli_free_result($res);
	
}else {
	$out = json_encode([]);
}
    
    echo json_encode($out);
    
    mysqli_close($con);
}else{
?>
<html>
<head>
    <meta charset="utf-8">
    <title>RunSQL</title>
</head>
<body>
    <form action="<?php echo $APPROOT; ?>" method="get">
        <div>
        <label>username :</label>
        <input type="text" name="usr" />
        </div>
        <div>
        <label>last date :</label>
        <input type="text" name="ld" />
        </div>
        <div>
        <input type="submit" />
        </div>
    </form>
</body>
</html>
<?php
}
?>