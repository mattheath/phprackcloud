<?php
define("BACKUP_WEEKLY_DISABLED","DISABLED");
define("BACKUP_WEEKLY_SATURDAY","SATURDAY");
define("BACKUP_WEEKLY_SUNDAY","SUNDAY");
define("BACKUP_WEEKLY_MONDAY","MONDAY");
define("BACKUP_WEEKLY_TUESDAY","TUESDAY");
define("BACKUP_WEEKLY_WEDNESDAY","WEDNESDAY");
define("BACKUP_WEEKLY_THURSDAY","THURSDAY");
define("BACKUP_WEEKLY_FRIDAY","FRIDAY");


define("BACKUP_DAILY_DISABLED","DISABLED");
define("BACKUP_DAILY_0000_0200","H_0000_0200");
define("BACKUP_DAILY_0200_0400","H_0200_0400");
define("BACKUP_DAILY_0400_0600","H_0400_0600");
define("BACKUP_DAILY_0600_0800","H_0600_0800");
define("BACKUP_DAILY_0800_1000","H_0800_1000");
define("BACKUP_DAILY_1000_1200","H_1000_1200");
define("BACKUP_DAILY_1200_1400","H_1200_1400");
define("BACKUP_DAILY_1400_1600","H_1400_1600");
define("BACKUP_DAILY_1600_1800","H_1600_1800");
define("BACKUP_DAILY_1800_2000","H_1800_2000");
define("BACKUP_DAILY_2000_2200","H_2000_2200");
define("BACKUP_DAILY_2200_0000","H_2200_0000");

define("FLAVOR_256",1);
define("FLAVOR_512",2);
define("FLAVOR_1024",3);
define("FLAVOR_2048",4);
define("FLAVOR_4096",5);
define("FLAVOR_8192",6);
define("FLAVOR_15872",7);

define ("ERROR_304","Indicates that the requested resource's status has not changed since the specified If-Modified-Since date.");
define ("ERROR_400","There was a syntax error in the request. Do not repeat the request without adjusting the input.");
define ("ERROR_401","The X-Auth-Token is not valid or has expired. Re-authenticate to obtain a fresh token.");
define ("ERROR_403","Access is denied for the given request. Check your X-Auth-Token header. The token may have expired.");
define ("ERROR_404","The server has not found anything matching the Request URI.");
define ("ERROR_413","The server is refusing to process the request because the client request rate exceeds a configured limit for the given account and action type. The server will include a Retry-After header field to indicate that it is temporary and after what time the client MAY try again.");
define("ERROR_500","The server encountered an unexpected condition which prevented it from fulfilling the request.");

include_once("class.request.php");
include_once("class.rackauth.php");
include_once("class.rackcloudservice.php");
include_once("class.rackcloudserver.php");
include_once("class.rackcloudflavor.php");
include_once("class.rackcloudimage.php");
include_once("class.rackcloudbackup.php");
include_once("class.rackcloudsharedipgroups.php");
?>