<?php
/**
 * RackSpace Cloud Authentication Manager
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
        $this->Username=$Username;
        $this->APIKey= $APIKey;
    }
    public function auth()
    {

        if(!$$this->Username || !$this->APIKey)
        throw new Exception('Username or Password cannot be empty');

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

    function setXAuthToken($AuthToken)
    {
        $this->XAuthToken=$AuthToken;
    }

    function getXStorageUrl()
    {
        return $this->XStorageUrl;
    }
    function setXStorageUrl($Url)
    {
        $this->XStorageUrl = $Url;
    }

    function getXStorageToken()
    {
        return $this->XStorageToken;
    }

    function setXStorageToken($Url)
    {
        $this->XStorageToken=$Url;
    }

    function getXCDNManagementUrl()
    {
        return $this->XCDNManagementUrl;
    }
    
    function setXCDNManagementUrl($Url)
    {
        $this->XCDNManagementUrl=$Url;
    }

    function getXServerManagementUrl()
    {
        return $this->XServerManagementUrl;
    }
    
    function setXServerManagementUrl($Url)
    {
        $this->XServerManagementUrl=$Url;
    }

    function getUsername()
    {
        return $this->Username;
    }
    
    function setUsername($Username)
    {
        $this->Username=$Username;
    }

    function getAPIKey()
    {
        return $this->APIKey;
    }
    
    function setAPIKey($APIKey)
    {
        $this->APIKey=$APIKey;
    }
}

?>