<?php
namespace App;

use PubNub\PubNub;
use PubNub\Enums\PNStatusCategory;
use PubNub\Callbacks\SubscribeCallback;
use PubNub\PNConfiguration;

class PubnubConfig extends SubscribeCallback {
   
    // Variables
    protected $pubnub = '';
    protected $pnconf = '';

    // Initialization
    public function __construct($uuid) {
        $this->pnconf = new PNConfiguration();
        $this->pubnub = new PubNub($this->pnconf);
        $this->pnconf->setSubscribeKey("sub-c-669e63c0-8179-11e9-b157-42b7978df387");
        $this->pnconf->setPublishKey("pub-c-1447b25b-45d2-40f5-8444-59910045edfc");
        $this->pnconf->setSecretKey("sec-c-OTg0YTM0YjMtYWNkYi00Nzc5LWJlODgtMjFlNWY5ZTQwMjVj");
        $this->pnconf->setAuthKey($uuid);
    }

    // Override
    function status($pubnub, $status) {}
    function message($pubnub, $message) {}
    function presence($pubnub, $presence) {}

    // Publish a message to a channel
    public function publishMessage($message,$channel) {
        return $this->pubnub->publish()->channel($channel)->message($message)->sync();
    }
    
    // Grant Access (PAM)
    // Grant Access to Global Chat
    public function grantGlobal($uuid) {
       return $this->pubnub->grant()->read(true)->write(true)->channels("global","control")->authKeys($uuid);
    }   

    // Grant access to one on one chats
    public function grantOne($uuid1, $uuid2) {
        $channel = $uuid1."-".$uuid2;
        return $this->pubnub->grant()->read(true)->write(true)->channels($channel)->authKeys($uuid1, $uuid2);
    }

}
