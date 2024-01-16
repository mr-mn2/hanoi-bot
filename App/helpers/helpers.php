<?php
function site_url($uri =null){
    return HOST.$uri;
}
function asset_url($uri =null){
    return site_url("assets/").$uri;
}
function random_element($arr){
    shuffle($arr);
    return array_pop($arr);
}
function view($path,$params = []){
    extract($params);
    $path = str_replace('.','/',$path);
    include  BASE_PATH."views/$path.php"; 
}


function assets($path,$type,$params = []){
    extract($params);
    
    $path = str_replace('.','/',$path);
    return BASE_URl."assets/$path.$type";
}


function Storage($table){
    $path = str_replace('.','/',$table);
   
    return BASE_PATH."/Storage/$table.json";
}