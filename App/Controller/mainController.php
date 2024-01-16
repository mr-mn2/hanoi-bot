<?php
namespace App\Controller;
use App\Telegram\telegramBot;
use App\Core\request;

class mainController {
    protected $telegram;
    protected $request;
    protected $honoi;
    public function __construct()
    {
        $this ->telegram = new telegramBot(TOKEN);
        $this ->request = new request();
    
    }
  
}