<?php
//webserviceDialOut.php
include_once __DIR__.DIRECTORY_SEPARATOR.'../bll/DialOut.php';

function dialOut($number){
	if(!empty($number)) {
		//return "got $number";
		try {
			if(DialOut::Login()){
				//$channel="SIP/0123456781";
				$exten = "3344";  //extension of the AGI Sipmobile/PayBill.php
				$context = "internal";
				$priority = 1;

				$value = $number;
				if(!empty($value)){
					$pattern = '/^0[6,7]/';
					$res = preg_match($pattern, $value, $matches, PREG_OFFSET_CAPTURE);
					if($res == 1){
						//considere comme un numero de telephone
						$channel = "SIP/sipcomtrunk/".$value;
					}else{
						//considere comme extension interne 
						$channel = "SIP/".$value;
					}

					$aMsg = DialOut::Originate($channel, $exten, $context, $priority);
					if(strpos($aMsg,"Error") == false){
						return "Call ".$channel.", successful!\n";
						//return implode("\r\n",$aMsg);
					}else{
						return "Call ".$channel.", faild\n".$aMsg;
					}
				}
			}else{
				return "Login error\n";
			}
			DialOut::Logout();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
$server = new SoapServer("webserviceDialOut.wsdl");
$server->addFunction("dialOut");
$server->handle();
?>
