<?php
function View($file_name,$data=array()){
    $view_path=getcwd()."/views/";
    $view_file=$view_path.$file_name.".php";
    if(file_exists($view_file)){
       include_once($view_file);
    }
    else{
        echo "View <code>$file_name</code> Doesn't Exists !"; 
    }
}

function greetings(){
    
    return "Welcome, {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']}"; 

}

function getRootPath($resource=""){
    $path=getcwd(); 
    return $path.$resource;
}


function rootUrl($resource=""){
    $url="http://".$_SERVER['HTTP_HOST'].str_replace("/index.php","",$_SERVER['SCRIPT_NAME']);
    return $url.$resource;
}

function debug($data){
    echo "<pre>";
    print_r($data); 
    echo "</pre>";
}

function connectDB(){
    global $db_config;
    $mysqli = new mysqli($db_config['host'],$db_config['user'],$db_config['password'],$db_config['database']);
    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
    else{
        return $mysqli;
    }
}

function loadModel($class_name){
   include_once(getcwd()."/models/$class_name".".php");
}


?>