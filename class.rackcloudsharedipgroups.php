<?php
/**
 * RackSpace Cloud Shared IP Group Manager
 * 
 * @author : Leevio Team (www.leevio.com)
 * @copyright : NEW BSD License
 * @since : Oct 12, 2009
 * @version : 1.0
 */
class RackCloudSharedIpGroups
{
    private $RackAuth;

    public function __construct(RackAuth $RackAuth)
    {
        $this->RackAuth = $RackAuth;
    }
    /**
     * return list of all shared ip groups
     *
     * @param int $Detail
     * @return object
     */
    public function listSharedIpGroups($Detail=false)
    {
        if($Detail)
        $Url = "shared_ip_groups/detail";
        else
        $Url = "shared_ip_groups";

        $JsonResponse = Request::postAuthenticatedRequest($Url,$this->RackAuth);
        $Response = json_decode($JsonResponse);
        return $Response;
    }

    /**
     * create a new shared ip group
     *
     * @param int $ServerId
     * @param string $Name a human redable name
     * @return object
     */
    public function createSharedIpGroup($ServerId, $Name)
    {
        $Request = array("sharedIpGroup"=>array("name"=>$Name,"server"=>$ServerId));
        $JsonRequest = json_encode($Request);
        $JsonResponse = Request::postAuthenticatedRequest("shared_ip_groups",$this->RackAuth);
        $Response = json_decode($JsonResponse);
        return $Response;
    }

    /**
     * return details of a specific shared IP group
     *
     * @param int $SharedIpGroupId
     * @return object
     */
    public function getSharedIpGroupDetails($SharedIpGroupId)
    {
        if($SharedIpGroupId){
            $JsonResponse = Request::postAuthenticatedRequest("shared_ip_groups/{$SharedIpGroupId}",$this->RackAuth);
            $Response = json_decode($JsonResponse);
            return $Response;
        }
    }
    
    /**
     * deletes a shared ip group
     *
     * @param int $SharedIpGroupId
     */
    public function deleteSharedIpGroup($SharedIpGroupId)
    {
        if($SharedIpGroupId){
            $JsonResponse = Request::postAuthenticatedDeleteRequest("shared_ip_groups/{$SharedIpGroupId}",$this->RackAuth);
        }
    }
}
?>