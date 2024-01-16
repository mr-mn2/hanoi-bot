<?php

define("BASE_PATH",__DIR__."/../"); 
define("BASE_URl","http://localhost/project/micro/"); 
include realpath(BASE_PATH."vendor/autoload.php");
include realpath(__DIR__."/config.php");
//$request =new App\Core\request();
include realpath(BASE_PATH."routes/web.php");
