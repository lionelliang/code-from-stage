<?php
use PAMI\Message\Action\MeetmeListAction;
use PAMI\Message\Action\StatusAction;
use PAMI\Message\Action\OriginateAction;
use PAMI\Message\Action\HangupAction;
require_once 'PAMI/Autoloader/Autoloader.php'; // Include PAMI autoloader.
\PAMI\Autoloader\Autoloader::register(); // Call autoloader register for PAMI autoloader.
require_once 'log4php/Logger.php';
use PAMI\Message\Action\ReloadAction;
use PAMI\Client\Impl\ClientImpl;
use PAMI\Message\Action\AGIAction;

try {
	$options = array(
        'log4php.properties' => realpath(__DIR__) . DIRECTORY_SEPARATOR . 'log4php.properties',
        'host' => 'localhost',
        'port' => '5038',
        'username' => 'admin',
        'secret' => '123456',
        'connect_timeout' => '10000',
        'read_timeout' => '1000',
        'scheme' => 'tcp://' // try tls://
    );
	$pamiClient = new ClientImpl($options);
	$pamiClient->open();
	//$response = $pamiClient->send(new ReloadAction());
	//$command="EXEC startmusiconhold";
	//$command="EXEC stopmusiconhold";
	//$command="EXEC Dial(sip/0123456780)";
	//$channel="SIP/0123456781";
	$channel="SIP/sipcomdevtrunk/0143006375";
	$data = '/var/www/sipcom/data/fax/faxsending/fax.tif';
	//$cmmandeaction = new AGIAction($channel, $command);
	//$originateaction = new OriginateAction($channel);
	//$originateaction->setContext("incoming");
	//$originateaction->setPriority("1");
	//$originateaction->setData($data);
	//$originateaction->setExtension("send");
	
	//$statusAction = new StatusAction();
	$conference = "3345";
	$meetmeListAction = new MeetmeListAction($conference);
	$response = $pamiClient->send($meetmeListAction);
	if ($response->isSuccess()) {
	    echo "Ok!\n".$response->getMessage()."\n";
	    echo $response->getEvents();
	} else {
	    echo "Failed:".$response->getMessage()."\n";
	}

} catch (Exception $e) {
	echo $e->getTrace();
}

?>
