<?php
/**
 * RackSpace Cloud Backup Schedule Manager
 * 
 * @author : Leevio Team (www.leevio.com)
 * @copyright : New BSD License
 * @since : Oct 12, 2009
 * @version : 1.0
 */

class RackCloudBackup
{
    private $RackAuth;

    public function __construct(RackAuth $RackAuth)
    {
        $this->RackAuth = $RackAuth;
    }

    /**
     * return current backup schedules for a specific server id
     *
     * @param int $ServerId
     * @return object
     */
    public function listServerBackupSchedule($ServerId)
    {
        if($ServerId){
            $JsonResponse = Request::postAuthenticatedRequest("servers/{$ServerId}/backup_schedule",$this->RackAuth);
            $Response = json_decode($JsonResponse);
            return $Response;
        }
    }
    
    /**
     * create or update a backup policy for a server
     *
     * @param int $ServerId
     * @param const $WeeklyBackupPolicy [use constatnts start with BACKUP_WEEKLY..]
     * @param const $DailyBackupPolicy  [use constatnts start with BACKUP_DAILY..]
     * @return object
     */
    public function createBackupSchedule($ServerId,$WeeklyBackupPolicy=BACKUP_WEEKLY_DISABLED, $DailyBackupPolicy=BACKUP_DAILY_DISABLED)
    {
        if($ServerId){
            $Request = array("backupSchedule"=>array("enabled"=>true,
                                                                                "weekly"=>$WeeklyBackupPolicy,
                                                                                "daily"=>$DailyBackupPolicy));
            $JsonRequest = json_encode($Request);
            $JsonResponse = Request::postAuthenticatedRequest("servers/{$ServerId}/backup_schedule",$this->RackAuth, $JsonRequest);
            $Response = json_decode($JsonResponse);
            return $Response;
        }
    }
    
    /**
     * delete a previously created backup schedule
     *
     * @param int $ServerId
     */
    public function deleteBackupSchedule($ServerId)
    {
        if($ServerId){
            $JsonResponse = Request::postAuthenticatedDeleteRequest("servers/{$ServerId}/backup_schedule",$this->RackAuth);
        }
    }
}
?>