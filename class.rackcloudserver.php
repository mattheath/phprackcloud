<?php
/**
 * RackSpace Cloud Server Manager
 * 
 * @author : Leevio Team (www.leevio.com)
 * @copyright : New BSD License
 * @since : Oct 12, 2009
 * @version : 1.0
 */
class RackCloudServer
{
    private $RackAuth;

    public function __construct(RackAuth $RackAuth)
    {
        $this->RackAuth = $RackAuth;
    }

    /**
     * reboot a server. rebooting can be of SOFT or HARD reboot. default is SOFT
     * SOFT reboot is like sending kill signal to all processes
     * HARD reboot is like just plugging off  
     * 
     * @param int $ServerId
     * @param string $type either SOFT or HARD
     */
    public function rebootServer($ServerId,$type="SOFT")
    {
        if($ServerId){
            $Request = array("reboot"=>array("type"=>$type));
            $JsonRequest = json_encode($Request);
            Request::postAuthenticatedRequest("servers/{$ServerId}/action",$this->RackAuth,$JsonRequest);
        }
    }
    
    /**
     * rebuild a server from a specific imageId. imageId could be either default images supplied by 
     * rackspace cloud service, or a user created one. 
     *
     * @param int $ServerId
     * @param int $ImageId
     * @return void
     */
    public function rebuildServer($ServerId,$ImageId)
    {
        if($ServerId && $ImageId){
            $Request = array("rebuild"=>array("imageId"=>$ImageId));
            $JsonRequest = json_encode($Request);
            Request::postAuthenticatedRequest("servers/{$ServerId}/action",$this->RackAuth,$JsonRequest);
        }
    }
    
    /**
     * resize server to another flavor. flavors are pre configured VM specifications. 
     *
     * @param int $ServerId
     * @param const $FlavorId
     * @return  void
     */
    public function resizeServer($ServerId,$FlavorId=FLAVOR_512)
    {
        if($ServerId && $ImageId){
            $Request = array("resize"=>array("flavorId"=>$FlavorId));
            $JsonRequest = json_encode($Request);
            Request::postAuthenticatedRequest("servers/{$ServerId}/action",$this->RackAuth,$JsonRequest);
        }
    }
    
    /**
     * after making a resize call, please confirm the server resize by this API call. 
     * if no confirmation is sent to rackspace cloud, a "CONFIRMED" signal will 
     * automatically be considered after 24 hours. 
     *
     * @param int $ServerId
     * @return  void
     */
    public function confirmResizeServer($ServerId)
    {
        if($ServerId && $ImageId){
            $Request = array("confirmResize"=>true);
            $JsonRequest = json_encode($Request);
            Request::postAuthenticatedRequest("servers/{$ServerId}/action",$this->RackAuth,$JsonRequest);
        }
    }
    
    /**
     * to cancel a resize, use this API. make sure to call it before 24 hours
     *
     * @param int $ServerId
     * @return  void
     */
    public function revertResizeServer($ServerId)
    {
        if($ServerId && $ImageId){
            $Request = array("revertResize"=>true);
            $JsonRequest = json_encode($Request);
            Request::postAuthenticatedRequest("servers/{$ServerId}/action",$this->RackAuth,$JsonRequest);
        }
    }
}
?>