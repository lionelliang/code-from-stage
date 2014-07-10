<?php
//declare(ticks=1);

use PAMI\Message\Event\AsyncAGIEvent;
use PAMI\Message\Action\HangupAction;
use PAMI\Message\Event\NewchannelEvent;
use PAMI\Message\Event\DialEvent;
use PAMI\Message\Action\ActionMessage;

date_default_timezone_set('America/Buenos_Aires');
////////////////////////////////////////////////////////////////////////////////
// Mandatory stuff to bootstrap.
////////////////////////////////////////////////////////////////////////////////
require_once __DIR__.DIRECTORY_SEPARATOR.'PAMI/Autoloader/Autoloader.php'; // Include PAMI autoloader.
\PAMI\Autoloader\Autoloader::register(); // Call autoloader register for PAMI autoloader.
require_once __DIR__.DIRECTORY_SEPARATOR.'log4php/Logger.php';

use PAMI\Client\Impl\ClientImpl;
use PAMI\Listener\IEventListener;
use PAMI\Message\Event\EventMessage;
use PAMI\Message\Action\AGIAction;
use PAMI\Message\Event\NewextenEvent;

//require_once __DIR__ . 'MyPAGIApplication.php';

class ListenerTest implements IEventListener
{
    private $_client;
    private $_id;
    private $_pamiOptions;

    public function handle(EventMessage $event)
    {
		static $nEvent;
    	echo "Event:".$nEvent++." ".$event->getName()." ".$event->getActionID()."\n";
    	if($event instanceof DialEvent){
    		echo "dial:".$event->getChannel()."\n";
    	}
	    if($event instanceof NewchannelEvent){
		    	$channel=$event->getChannel();
		    	echo "Channel:".$channel."\t".$event->getCallerIDNum()."\t".$event->getChannelState()."\t".$event->getContext()."\t".$event->getExtension()."\n";
		    	//$command="EXEC ANSWER";
		    	//$response=$this->_client->send(new AGIAction($channel, $command));
		    	//$command="EXEC Dial(SIP/0123456780)";
		    	//$command="test_call.agi";
		    	/*
		    	$command="exec startmusiconhold";
		    	$response = $this->_client->send(new AGIAction($channel, $command));
		    	//$response=$this->_client->send(new HangupAction($channel));
		    	if ($response->isSuccess()) {
		    		echo "ok\n";
				}else{
					echo "failed:".$response->getMessage()."\n";
				}
				*/
				//use AsyncClientImpl
				//$this->_client = new ClientImpl($this->_pamiOptions);
				//$this->_client->open();
	    	}
    }
    public function run()
    {
        $this->_client->open();
    	while(true)
    	{
    	    usleep(1000);
    	    $this->_client->process();
            pcntl_wait($status);
    	}
    	$this->_client->close();
    }
    public function __construct(array $pamiOptions)
    {
        $this->_pamiOptions = $pamiOptions;
        $this->_client = new ClientImpl($pamiOptions);
        $this->_id = $this->_client->registerEventListener($this);
    }
}
////////////////////////////////////////////////////////////////////////////////
// Code STARTS.
////////////////////////////////////////////////////////////////////////////////
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
	$listener = new ListenerTest($options);
	$listener->run();
} catch (Exception $e) {
	echo $e->getMessage() . "\n";
}
////////////////////////////////////////////////////////////////////////////////
// Code ENDS.
////////////////////////////////////////////////////////////////////////////////