<?php
/**
 * RackSpace Cloud Flavor Manager
 * 
 * @author : Leevio Team (www.leevio.com)
 * @copyright : New BSD License
 * @since : Oct 12, 2009
 * @version : 1.0
 */
class RackCloudFlavor
{
    private $RackAuth;

    public function __construct(RackAuth $RackAuth)
    {
        $this->RackAuth = $RackAuth;
    }

    /**
     * list current flavors supported by rackspace cloud servers. if "detail" set to true, it will return
     * detaild spec about each flavor. 
     *
     * @param bool $Detail
     * @return object
     */
    public function listFlavors($Detail = false)
    {
        if($Detail)
        $Url = "flavors/detail";
        else
        $Url = "flavors";

        $JsonResponse = Request::postAuthenticatedRequest($Url,$this->RackAuth);
        $Response = json_decode($JsonResponse);
        return $Response;
    }

    /**
     * get details for a particular flavor by specifying it's id
     *
     * @param int $FlavorId
     * @return object
     */
    public function getFlavorDetails($FlavorId)
    {
        if($FlavorId)
        {
            $JsonResponse = Request::postAuthenticatedRequest("flavors/{$FlavorId}",$this->RackAuth);
            $Response = json_decode($JsonResponse);
            return $Response;
        }
    }
}
?>