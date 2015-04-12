<?php
namespace Starface;

use fXmlRpc\Transport\GuzzleBridge;
use GuzzleHttp\Client;
use Starface\Api\CallRequests;
use Starface\Api\Connection;
use Starface\Api\GroupRequests;
use Starface\Api\PhoneRequests;
use Starface\Api\Service;
use Starface\Api\UserStateRequests;

class StarFace
{
    private $id;
    private $authToken;
    private $baseUrl;
    /** @var bool */
    private $isLoggedIn = false;
    /** @var  \fXmlRpc\Client */
    private $client;
    /** @var \GuzzleHttp\Client */
    private $guzzle;

    public function __construct($id, $pass, $baseUrl)
    {
        $this->authToken = md5($id.'*'.$pass);
        $this->id = $id;
        $this->baseUrl = $baseUrl;
        $this->url = $this->baseUrl.'/xml-rpc?de.vertico.starface.user='.$this->id.'&de.vertico.starface.auth='.$this->authToken;

        $this->guzzle = new Client();
        $this->client = new \fXmlRpc\Client(
            $this->url,
            new GuzzleBridge($this->guzzle)
        );
    }

    /** @return \fXmlRpc\Client */
    private function getClient()
    {
        return $this->client;
    }

    /**
     * @return $this
     */
    public function login()
    {
        $this->isLoggedIn = (bool) $this->getConnectionApi()->login();
        return $this;
    }

    /**
     * @return $this
     */
    public function logout()
    {
        $this->isLoggedIn = !$this->getConnectionApi()->login();
        return $this;
    }

    /**
     * @return $this
     */
    public function keepAlive()
    {
        $this->getConnectionApi()->keepAlive();
        return $this;
    }

    /**
     * @return bool
     */
    public function isLoggedIn()
    {
        return (bool) $this->isLoggedIn;
    }

    /** @return Connection */
    protected function getConnectionApi()
    {
        return new Connection($this->getClient(), $this);
    }

    /** @return CallRequests */
    public function getCallApi()
    {
        return new CallRequests($this->getClient(), $this);
    }

    /** @return PhoneRequests */
    public function getPhoneApi()
    {
        return new PhoneRequests($this->getClient(), $this);
    }

    /** @return Service */
    public function getServiceApi()
    {
        return new PhoneRequests($this->getClient(), $this);
    }

    /** @return UserStateRequests */
    public function getUserStateApi()
    {
        return new UserStateRequests($this->getClient(), $this);
    }

    /** @return GroupRequests */
    public function getGroupApi()
    {
        return new GroupRequests($this->getClient(), $this);
    }
}
