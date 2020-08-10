<?php

class Users{
    private $inventory_model;
    public function __construct(){
        loadModel('InventoryDealer');
        $this->inventory_model=new InventoryDealer(); //Initialize the model.
    }

    public function index(){
        View("home"); 
    }

    public function login(){
        $data=$this->inventory_model->authenticateUser(); 
        View("login",$data); 
    }

    public function logout(){
        session_destroy();
        $url=rootUrl("/user/login");
        header("location:$url");
    }
    
}