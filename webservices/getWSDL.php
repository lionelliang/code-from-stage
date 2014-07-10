<?php

require_once __DIR__.DIRECTORY_SEPARATOR."../Zend/Soap/AutoDiscover.php";
require_once __DIR__.DIRECTORY_SEPARATOR."../Zend/Soap/Server.php";
$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf' => true));
$loader->register();


class ValidationInfo{
	// data structure for Authentication complexeType 
     public $username;
     public $password;
 }

class webserviceFax {
	
	protected $username = "lionel";
	protected $password = "123456";
	protected $authenticated = false;

	public function getValidationInfo(){
		$authentication = new ValidationInfo();
		$authentication->username = "lionel";
		$authentication->password = "123456";
		return $authentication;
	}                 
	protected function checkAuth(){
        if($this->authentication->username !=$this->username || $this->authentication->password!=$this->password){ 
			 throw new SOAPFault("Nom: $username ou mots de pass: $password incorrect.", 401); 
		}else{
			return true;
		}
    }

    public function sendFax($number, $file){
    	//$this->checkAuth();
		return "fast $number $file";
	}

}

if(isset($_GET['wsdl'])) {
	$autodiscover = new Zend_Soap_AutoDiscover();
	$autodiscover->setClass('webserviceFax');
	//$autodiscover->setUri("http://192.168.0.20/sipcom/webservices/webserviceFax.php");
	$autodiscover->handle();
}else {
	$soap = new Zend_Soap_Server("http://192.168.0.20/sipcom/webservices/webserviceFax.php?wsdl");
	$soap->setClass('webserviceFax');
	$soap->handle();
}
?>