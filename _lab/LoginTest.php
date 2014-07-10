<?php
use PAMI\Message\Event\StatusEvent;
use PAMI\Message\Action\StatusAction;
declare(ticks=1);
include_once 'log4php/Logger.php';
include_once 'PAMI/Autoloader/Autoloader.php'; // Include PAMI autoloader.
\PAMI\Autoloader\Autoloader::register(); // Call autoloader register for PAMI autoloader.
use PAMI\Client\Impl\ClientImpl as PamiClient;
try
{
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
	$pamiClient = new PamiClient($options);
	$pamiClient->open();
	$pamiClient->registerEventListener(function (EventMessage $event){
		echo "get un StatusEvent";
		echo $event->getActionID();
	},
	function ($event) {
        return $event instanceof StatusEvent && $event->getSubEvent() == 'Begin';
	});
	$pamiClient->process();
	$pamiClient->send(new StatusAction());
	while(true){
    	    usleep(1000);
    	    $pamiClient->process();
            pcntl_wait($status);
    	}
	echo "Close the connection";
	$pamiClient->close();
} catch (Exception $e) {
	echo $e->getMessage() . "\n";
}
?>