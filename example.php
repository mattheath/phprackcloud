<?php
include_once("class.rackcloudmanager.php");
$Auth = new RackAuth("<Username>","<ApiKey>");
$Auth->auth();

echo "<pre>";
$RCS = new RackCloudService($Auth);
$Limits = $RCS->getLimits();
print_r($Limits);
//$NewServer = $RCS->createServer("Gopsop2",2,1,array("My Server Name"=>"Gopssop 2"));


$Servers = $RCS->listServers();
echo Request::getLastError();
//$Server = $RCS->listServer(95872);
print_r($Servers);


//$ServerIps = $RCS->listServerIPs(95872);
//print_r($ServerIps);

//$ServerIps = $RCS->listServerPublicIPs(95872);
//print_r($ServerIps);

//$ServerIps = $RCS->listServerPrivateIPs(95872);
//print_r($ServerIps);
//$Result = $RCS->deleteServer(95872,true);

$RS = new RackCloudServer($Auth);
//$Result = $RS->rebootServer(95872);
//$Result = $RS->rebuildServer(95872,2);
//$Result = $RS->resizeServer(95872,FLAVOR_512);
//$Result = $RS->confirmResizeServer(95872);
//$Result = $RS->revertResizeServer(95872);

$RF = new RackCloudFlavor($Auth);
//$Result = $RF->listFlavors(true);
//$Result = $RF->getFlavorDetails(1);

$RI = new RackCloudImage($Auth);
//$Result = $RI->listImages(false);
//$Result = $RI->getImageDetails(3);
//print_r($Result);

$RB = new RackCloudBackup();
$RB->
?>