<?php

use PAMI\Message\Action\ActionMessage;
date_default_timezone_set('America/Buenos_Aires');
////////////////////////////////////////////////////////////////////////////////
// Mandatory stuff to bootstrap.
////////////////////////////////////////////////////////////////////////////////
require_once 'PAMI/Autoloader/Autoloader.php'; // Include PAMI autoloader.
\PAMI\Autoloader\Autoloader::register(); // Call autoloader register for PAMI autoloader.
require_once 'log4php/Logger.php';
use PAMI\Client\Impl\ClientImpl;
use PAMI\Listener\IEventListener;
use PAMI\Message\Event\EventMessage;
use PAMI\Message\Action\AGIAction;
use PAMI\Message\Event\NewextenEvent;
use PAGI\Application\PAGIApplication;
use PAGI\Client\AbstractClient;

require_once __DIR__.DIRECTORY_SEPARATOR.'/MyPAGIApplication.php';

class ListenerTest implements IEventListener
{
    private $_client;
    private $_id;
    private $_pamiOptions;
/*
    public function handle(ActionMessage $action){
    	static $nAction;
    	echo "Action:".$nAction++." ".$action->getName()." ".$event->getActionID()."\n";
    }
*/
    public function handle(EventMessage $event)
    {
    	static $nEvent;
    	echo "Event:".$nEvent++." ".$event->getName()." ".$event->getActionID()."<br>";
        if ($event instanceof \PAMI\Message\Event\AsyncAGIEvent) {
            if ($event->getSubEvent() == 'Start') {
            	//echo "AsyncEvent:".$event->getChannel()."<br>";
                switch($pid = pcntl_fork())
                {
                    case 0:
                        $logger = \Logger::getLogger(__CLASS__);
                        $this->_client = new ClientImpl($this->_pamiOptions);
                        $this->_client->open();
                        $agi = new \PAMI\AsyncAgi\AsyncClientImpl(array(
                            'pamiClient' => $this->_client,
                            'asyncAgiEvent' => $event
                        ));
                        $app = new MyPAGIApplication(array(
                            'pagiClient' => $agi
                        ));
                        $app->init();
                        $app->run();
                        //$agi->indicateProgress();
                        //$agi->answer();
                        //$agi->streamFile('welcome');
                        //$agi->playCustomTones(array("425/50","0/50"));
                        //sleep(5);
                        //$agi->indicateCongestion(10);
                        //$agi->hangup();
                        $this->_client->close();
                        echo "Application finished\n";
                        exit(0);
                        break;
                    case -1:
                        echo "Could not fork application\n";
                        break;
                    default:
                        echo "Forked Application\n";
                        break;
                }
            }
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