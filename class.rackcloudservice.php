<?php
/**
 * RackSpace Cloud Service Manager
 * 
 * @author : Leevio Team (www.leevio.com)
 * @copyright : NEW BSD License
 * @since : Oct 12, 2009
 * @version : 1.0
 */
class RackCloudService
{
    private $RackAuth;

    public function __construct(RackAuth $RackAuth)
    {
        $this->RackAuth = $RackAuth;
    }

    /**
     * return current limit and quota of calling rackspace cloud API. 
     * limits all verbs (PUT, DELETE, GET) will be returned. 
     * it will also return your maximum limit of RAM, IP and SharedIPGroups
     *
     * @return object
     */
    public function getLimits()
    {
        $Url = "limits";
        $JsonResponse = Request::postAuthenticatedRequest($Url,$this->RackAuth);
        /*$_Limits = json_decode($JsonResponse);
        $Limits = array();
        foreach ($_Limits->limits->rate as $_Rate)
        {
            $Limits[$_Rate->verb][$_Rate->unit] = array("Value"=>$_Rate->value,"Remaining"=>$_Rate->remaining,"ResetTime"=>$_Rate->resetTime,"Unit"=>$_Rate->unit);
        }

        $Limits['maxIPGroupMembers'] = $_Limits->limits->absolute->maxIPGroupMembers;
        $Limits['maxIPGroups'] = $_Limits->limits->absolute->maxIPGroups;
        $Limits['maxTotalRAMSize'] = $_Limits->limits->absolute->maxTotalRAMSize;

        return $Limits;*/
        $Response = json_decode($JsonResponse);
        return $Response;
    }

    /**
     * create a server. by default server will be created with FLAVOR_256 (1) and later you can resize the server.  
     * 
     * IMPORTANT - after successfully creating a server, this call will return admin username and password as a property "adminPass" 
     * of the returned object. please store that. it is a one time return. You will also receive an email with server admin username and password. 
     *
     * @param string $ServerName server identifier
     * @param int $ImageId pre configured OS templates or user created server images
     * @param int $FlavorId (from 1 to 7)
     * @param associated array $MetaData extra meta data
     * @return object
     */
    public function createServer($ServerName, $ImageId, $FlavorId=1, $MetaData)
    {
        $Request = array("server"=>array("name"=>$ServerName,
        "imageId"=>$ImageId,
        "flavorId"=>$FlavorId,
        "metadata"=>$MetaData
        )
        );
        $JsonRequest = json_encode($Request);
        $JsonResponse = Request::postAuthenticatedRequest("servers",$this->RackAuth,$JsonRequest);
        $Response = json_decode($JsonResponse);
        return $Response;
    }

    /**
     * list currently available servers in your cloud server account. please note that
     * deleted servers will not be returned. 
     *
     * @return object
     */
    public function listServers()
    {
        $JsonResponse = Request::postAuthenticatedRequest("servers",$this->RackAuth);
        $Response = json_decode($JsonResponse);
        return $Response;
    }

    /**
     * list details of a specific server. details include server IP (public and private), name, image, flavor and meta data. 
     *
     * @param int $ServerId
     * @return object
     */
    public function listServer($ServerId)
    {
        if($ServerId)
        {
            $JsonResponse = Request::postAuthenticatedRequest("servers/{$ServerId}",$this->RackAuth);
            $Response = json_decode($JsonResponse);
            return $Response;
        }
    }

    /**
     * delete a server instantly
     *
     * @param int $ServerId
     * @param bool $Confirm
     * @return void
     */
    public function deleteServer($ServerId, $Confirm=false)
    {
        if($ServerId && $Confirm)
        {
            $JsonResponse = Request::postAuthenticatedDeleteRequest("servers/{$ServerId}",$this->RackAuth);
        }
    }

    /**
     * list all IPs associated with this server
     *
     * @param int $ServerId
     * @return object
     */
    public function listServerIPs($ServerId)
    {
        if($ServerId)
        {
            $JsonResponse = Request::postAuthenticatedRequest("servers/{$ServerId}/ips",$this->RackAuth);
            $Response = json_decode($JsonResponse);
            return $Response;
        }
    }

    /**
     * return a list of all public IPs associated with this server. 
     *
     * @param int $ServerId
     * @return object
     */
    public function listServerPublicIPs($ServerId)
    {
        if($ServerId)
        {
            $JsonResponse = Request::postAuthenticatedRequest("servers/{$ServerId}/ips/public",$this->RackAuth);
            $Response = json_decode($JsonResponse);
            return $Response;
        }
    }
    
    /**
     * return a list of all private IPs associated with this server. 
     *
     * @param int $ServerId
     * @return object
     */
    public function listServerPrivateIPs($ServerId)
    {
        if($ServerId)
        {
            $JsonResponse = Request::postAuthenticatedRequest("servers/{$ServerId}/ips/private",$this->RackAuth);
            $Response = json_decode($JsonResponse);
            return $Response;
        }
    }


    /**
     * share a IP address for this server. Please refer to official API docs for more details. 
     * if ConfigureServer set as true, it will instantl configure the new server. For creating
     * a SharedIPGroup please use RackCloudSharedIpGroup object
     *
     * @param int $ServerId
     * @param int $IPGroupId SharedIPGroup Id
     * @param bool $ConfigureServer
     * @return object
     */
    public function shareIpAdderss($ServerId, $IPGroupId, $ConfigureServer=true)
    {
        if($ServerId)
        {
            $Request = array("shareIp"=>array("sharedIpGroupId"=>$IPGroupId,
            "configureServer"=>$ConfigureServer));
            $JsonRequest = json_encode($Request);

            $JsonResponse = Request::postAuthenticatedRequest("servers/{$ServerId}/ips/public/address",$this->RackAuth,$JsonRequest);
            $Response = json_decode($JsonResponse);
            return $Response;
        }
    }

    /**
     * Removes a server from a SharedIPGroup
     *
     * @param int$ServerId
     * @return void
     */
    public function unShareIpAdderss($ServerId)
    {
        if($ServerId)
        {
            $JsonResponse = Request::postAuthenticatedDeleteRequest("servers/{$ServerId}/ips/public/address",$this->RackAuth);
        }
    }
}
?>