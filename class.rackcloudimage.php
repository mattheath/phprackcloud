<?php
/**
 * RackSpace Cloud Image Manager
 * 
 * @author : Leevio Team (www.leevio.com)
 * @copyright : New BSD License
 * @since : Oct 12, 2009
 * @version : 1.0
 */
class RackCloudImage
{
    private $RackAuth;

    public function __construct(RackAuth $RackAuth)
    {
        $this->RackAuth = $RackAuth;
    }
    
    /**
     * list all fixed images and user created images. each image actually represents an os template
     * if detail set to true, it will return details about each images
     * 
     * @param bool $Detail
     * @return object
     */
    public function listImages($Detail = false)
    {
        if($Detail)
        $Url = "images/detail";
        else
        $Url = "images";

        $JsonResponse = Request::postAuthenticatedRequest($Url,$this->RackAuth);
        $Response = json_decode($JsonResponse);
        return $Response;
    }

    /**
     * return details about a specific image
     *
     * @param int $ImageId
     * @return object
     */
    public function getImageDetails($ImageId)
    {
        if($ImageId)
        {
            $JsonResponse = Request::postAuthenticatedRequest("images/{$ImageId}",$this->RackAuth);
            $Response = json_decode($JsonResponse);
            return $Response;
        }
    }
    
    /**
     * delete a user created image
     *
     * @param int $ImageId
     * @return void
     */
    public function deleteImage($ImageId)
    {
        if($ImageId)
        {
            $JsonResponse = Request::postAuthenticatedDeleteRequest("images/{$ImageId}",$this->RackAuth);
        }
    }
    
    /**
     * create image from a specific server. this image will be helpful later for creating new server with same settings. 
     *
     * @param int $ServerId
     * @param string $Name a human redable name to understand for later use 
     * @return object
     */
    public function createImage($ServerId, $Name)
    {
        if($ServerId && $Name)
        {
            $Request = array("image"=>array("serverId"=>$ServerId,"name"=>$Name));
            $JsonRequest = json_encode($Request);
            $JsonResponse = Request::postAuthenticatedRequest("images/{$ImageId}",$this->RackAuth, $JsonRequest);
            $Response = json_decode($JsonResponse);
            return $Response;
        }
    }
}