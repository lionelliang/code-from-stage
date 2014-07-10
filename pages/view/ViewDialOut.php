<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/DialOut.php';

if(count($_GET) > 0) {
	try {
		if(DialOut::Login()){
			$exten = "3344";  		//extension of the AGI Sipmobile/PayBill.php
			$context = Variables::$strContext;
			$priority = 1;
			$aMsg = array();
			foreach ($_GET as $key => $value){
				if(!empty($value)){
					$pattern = '/^0[6,7]/';
					$res = preg_match($pattern, $value, $matches, PREG_OFFSET_CAPTURE);
					if($res == 1){
						//considere comme un numero de telephone
						$channel = Variables::$strTrunk.$value;
					}else{
						//considere comme extension interne 
						$channel = "SIP/".$value;
					}

					$aMsg[$value] = DialOut::Originate($channel, $exten, $context, $priority);
					if(strpos($aMsg[$value],"Error") == false){
						echo "Call ".$channel.", successful!\n";
						//echo implode("\r\n",$aMsg);		//info debug
					}else{
						echo "Call ".$channel.", faild\n".$aMsg[$value];
					}
				}
			}
		}else{
			echo "Login error\n";
		}
		DialOut::Logout();
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

