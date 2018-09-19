<?php
	$cmd="qingcloud iaas describe-instances -f '/root/qingcloud_config.yaml'";
	exec($cmd,$result,$retcode);
	$response=implode(' ',$result);
	$ret = json_decode($response, true);
    #var_dump($ret["instance_set"][0]["vxnets"][0]["private_ip"]);
	foreach($ret["instance_set"] as $retset ){
		if( !empty($retset["vxnets"][0]["private_ip"]) ){
			echo $retset["vxnets"][0]["private_ip"]."\n";
		}
	}
	#var_dump($response);

?>