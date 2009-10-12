<?php
/**
 * RackSpace Cloud Service Manager Class
 * 
 * @author : Leevio Team (www.leevio.com)
 * @copyright : New BSD License
 * @since : Oct 12, 2009
 * @version : 1.0
 */
class RackAuth
{

    private $Username="";
    private $APIKey="";
    private $XStorageUrl;
    private $XStorageToken;
    private $XAuthToken;
    private $XCDNManagementUrl;
    private $XServerManagementUrl;
    public function __construct($Username, $APIKey)
    {

        if(!$Username || !$APIKey)
        throw new Exception('Username or Password cannot be empty');

        $this->Username=$Username;
        $this->APIKey= $APIKey;
    }
    public function auth()
    {

        $Response = Request::post("https://auth.api.rackspacecloud.com/v1.0",array("X-Auth-User"=>$this->Username, "X-Auth-Key"=>$this->APIKey),null,true);
        $Headers = Request::parseHeaders($Response);
        //print_r($Headers);
        if($Headers)
        {
            $this->XAuthToken = $Headers['X-Auth-Token'];
            $this->XStorageToken= $Headers['X-Storage-Token'];
            $this->XStorageUrl = $Headers["X-Storage-Url"];
            $this->XServerManagementUrl = $Headers['X-Server-Management-Url'];
            $this->XCDNManagementUrl = $Headers['X-CDN-Management-Url'];
            return true;
        }

    }

    function getXAuthToken()
    {
        return $this->XAuthToken;
    }

    function getXStorageUrl()
    {
        return $this->XStorageUrl;
    }

    function getXStorageToken()
    {
        return $this->XStorageToken;
    }

    function getXCDNManagementUrl()
    {
        return $this->XCDNManagementUrl;
    }

    function getXServerManagementUrl()
    {
        return $this->XServerManagementUrl;
    }

    function getUsername()
    {
        return $this->Username;
    }

    function getAPIKey()
    {
        return $this->APIKey;
    }
}

?>