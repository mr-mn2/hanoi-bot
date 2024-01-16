<?php
namespace App\Core;

class request
{
    private $route_parameters;
    private $request_type;
    private $update;

    public function __construct()
    {
        $this-> update = $this->getUpdate();
        $this-> request_type = $this->RequestType();

    }

    public function getUpdate()
    {
        $body = json_decode(file_get_contents('php://input'),true);
        return $body;
    }

    public function RequestType()
    {
        if (isset($this->update['message'])) {
            return 'message';
        }
        if (isset($this->update['callback_query'])) {
            return 'callback_query';
        }
    }
    public function getMessage()
    {
        if ($this->request_type == 'message') {
            return $this->update['message']['text'];
        }
        if ($this ->request_type == 'callback_query') {
            return $this->update['callback_query']['data'];
        }
    }
    public function getUserID()
    {
        if ($this->request_type == 'message') {
            return $this->update['message']['from']['id'];
        }
        if ($this ->request_type == 'callback_query') {
            return $this->update['callback_query']['from']['id'];
        }
    }
    public function getCallbackQueryID()
    {
        return $this->update['callback_query']['id'];
    }
    public function getMessageID()
    {
        return $this->update['message']['message_id'];
    }

    public function add_route_parameter($key, $value){
        $this->route_parameters[$key] = $value;
    }
    
    public function get_route_parameter($key){
        return $this->route_parameters[$key];
    }
    

}
