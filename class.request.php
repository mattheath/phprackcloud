<?php
/**
 * RackSpace Cloud Request Processor
 * 
 * @author : Leevio Team (www.leevio.com)
 * @copyright : NEW BSD License
 * @since : Oct 12, 2009
 * @version : 1.0
 */
class Request
{
    public static $LastHTTPCode;
    /**
     * make a HTTP POST/GET call to rackspace cloud service. This object is used internall for all 
     * rackspace cloud objects in this package. 
     * 
     *
     * @param string $Url access point
     * @param array $Headers an associated Array of headers 
     * @param mixed $Extra extra POST data
     * @param bool $ReturnHeader 
     * @param bool $HTTPDelete used to perform a HTTP DELETE call
     * @return string Response 
     */
    public static function post($Url, $Headers, $Extra=null, $ReturnHeader=false,$HTTPDelete=false)
    {
        try{
            $c = curl_init($Url);
        }
        catch (Exception $e)
        {
            return false;
        }

        if($Headers){
            $_headers = array();
            foreach ($Headers as $key=>$value)
            {
                $_headers[] ="{$key}: {$value}";
            }
            curl_setopt($c,CURLOPT_HTTPHEADER,$_headers);
        }

        if($Extra)
        {
            echo "Post";
            echo $Extra;
            curl_setopt($c, CURLOPT_POST, 1);
            curl_setopt($c, CURLOPT_POSTFIELDS, $Extra);
        }
        
        if($HTTPDelete)
        {
            curl_setopt($c, CURLOPT_CUSTOMREQUEST, "DELETE");
        }



        if($ReturnHeader){
            curl_setopt($c,CURLOPT_HEADER, true);
            //curl_setopt($c, CURLINFO_HEADER_OUT, true);
        }

        curl_setopt($c,CURLOPT_URL,$Url);
        curl_setopt($c,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($c,CURLOPT_VERBOSE, true);
        curl_setopt($c,CURLOPT_RETURNTRANSFER, true);
        
        $Response = curl_exec($c);        
        $Info =curl_getinfo($c,CURLINFO_HTTP_CODE);
        self::$LastHTTPCode = $Info;
        curl_close($c);
        return $Response;
    }
    
    /**
     * This function is used to make a JSON post call to rackspace cloud service. 
     * internally used by all objects in this package. This function makes use of a 
     * authenticated RackAuth object. 
     * 
     * If you are planning to use a cached AuthToken, make sure to populate
     * a RackAuth object with at least AuthToken and XServerManagement Url. 
     *
     * @param string $Url (key part of the API access point)
     * @param RackAuth $RackAuth Authenticated RackAuth object
     * @param mixed $PostData
     * @return unknown
     */
    public function postAuthenticatedRequest($Url, RackAuth $RackAuth, $PostData=null)
    {
        $PostUrl = $RackAuth->getXServerManagementUrl()."/".$Url;
        $AuthToken  = $RackAuth->getXAuthToken();
        
        //echo $AuthToken;
        $Response = self::post($PostUrl, array("X-Auth-Token"=>$AuthToken,"Content-Type"=>"application/json"),$PostData);
        return $Response;
    }

     /**
     * This function is used to make a HTTP DELETE call to rackspace cloud service. 
     * internally used by all objects in this package. This function makes use of a 
     * authenticated RackAuth object. 
     * 
     * If you are planning to use a cached AuthToken, make sure to populate
     * a RackAuth object with at least AuthToken and XServerManagement Url. 
     *
     * @param string $Url (key part of the API access point)
     * @param RackAuth $RackAuth Authenticated RackAuth object
     * @return unknown
     */
    public function postAuthenticatedDeleteRequest($Url, RackAuth $RackAuth)
    {
        $PostUrl = $RackAuth->getXServerManagementUrl()."/".$Url;
        $AuthToken  = $RackAuth->getXAuthToken();
        
        //echo $AuthToken;
        $Response = self::post($PostUrl, array("X-Auth-Token"=>$AuthToken,"Content-Type"=>"application/json"),$PostData,false,true);
        return $Response;
    }
    
    /**
     * Parse Headers and return the parsed data as an associated Array
     *
     * @param string $Header
     * @return array associated array containing the headers
     */
    public  function parseHeaders( $Header )
    {
        $Headers= array();
        $Fields = explode("\r\n",trim($Header));
        foreach( $Fields as $Field ) {
            $FieldParts = explode(":",$Field);
            $_Header = array_shift($FieldParts);
            $Headers[$_Header] = trim(join(":",$FieldParts));
        }
        return $Headers;
    }

    /**
     * return error info about last calls
     *
     * @return string
     */
    function getLastError()
    {
        $LastHTTPCode = self::$LastHTTPCode;
        if($LastHTTPCode>=304)
        {
            $ErrorMessage = constant("ERROR_{$LastHTTPCode}");
            return $ErrorMessage;
        }
        else 
        return "";
    }
    
    /**
     * return last HTTP response code
     *
     * @return string
     */
    function getLastHTTPCode()
    {
        return self::$LastHTTPCode;
    }
}
?>