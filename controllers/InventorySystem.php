<?php
session_start();
class InventorySystem{
     private $inventory_model;
     public function __construct(){
         //Add all the required pre-requisites here.
         $this->manageLogging();
         loadModel('InventoryDealer');
         $this->inventory_model=new InventoryDealer();
     }

     public function manageLogging(){
        if($_SESSION['isLoggedIn']==null){
          header("location:".rootUrl("/user/login"));
        }
     }

     public function inventory(){
        $data=array();
        $data=$this->inventory_model->deleteInventoryDetails();
        $data['vendors']=$this->inventory_model->getAllVendors();
        $data['locations']=$this->inventory_model->getAllLocations();
        $data['active_link']='inventory'; 
        $data['inventory_list']=$this->inventory_model->getAllInventories(); 
        $pagination=$this->inventory_model->setUpPagination($this->inventory_model->conditional_inventory_count);
        $data=array_merge($data,$pagination); 
        View("inventory",$data);
    }

    public function add_inventory(){
        $data=array();
        $data=$this->inventory_model->insertInventoryDetails();
        $data['vendors']=$this->inventory_model->getAllVendors();
        $data['locations']=$this->inventory_model->getAllLocations();
        $data['active_link']="inventory";
        View("add-inventory",$data);
    }

    public function edit_inventory($id){
        $data=array();
        $data=$this->inventory_model->updateInventoryDetails();
        $data['inventory_details']=$this->inventory_model->getInventoryDetail($id); 
        $data['active_link']="inventory";
        $data['vendors']=$this->inventory_model->getAllVendors();
        $data['locations']=$this->inventory_model->getAllLocations();
        View("edit-inventory",$data);
    }

    public function vendors(){
        $data=array();
        $add=$this->inventory_model->addVendorDetails();
        $update=$this->inventory_model->updateVendorDetails();
        $delete=$this->inventory_model->deleteVendorDetails();
        $data=array_merge($data,$add,$update,$delete);
        $data['vendors']=$this->inventory_model->getAllVendors();
        $data['active_link']="vendors"; 
        View('vendors',$data); 
    }

    public function locations(){
        $data=array();
        $add=$this->inventory_model->addLocationDetails();
        $update=$this->inventory_model->updateLocationDetails();
        $delete=$this->inventory_model->deleteLocationDetails();
        $data=array_merge($data,$add,$update,$delete);
        $data['locations']=$this->inventory_model->getAllLocations();
        $data['active_link']="locations"; 
        View('locations',$data); 
    }

    public function reports(){
        $data=array();
        $data['vendors']=$this->inventory_model->getAllVendors();
        $data['locations']=$this->inventory_model->getAllLocations();
        $report_response=$this->inventory_model->generateReport(); 
        $data=array_merge($data,$report_response); 
        $data['active_link']="reports"; 
        View('reports',$data); 
    }

}

?>