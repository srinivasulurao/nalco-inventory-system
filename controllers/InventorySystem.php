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

    public function employees(){
        $data=array();
        $add=$this->inventory_model->addEmployeeDetails();
        $delete=$this->inventory_model->deleteEmployeeDetails();
        $update=$this->inventory_model->updateEmployeeDetails(); 
        $data=array_merge($add,$delete,$update); 
        $data['active_link']="employees"; 
        $data['employees']=$this->inventory_model->getAllEmployees(); 
        View('employees',$data); 
    }

    public function shift_logbook(){
        $data=array();
        $add=$this->inventory_model->addNewShiftLogbook(); //Add a new shift log.
        $add_shift_particulars=$this->inventory_model->addShiftLogParticulars(); 
        $delete=$this->inventory_model->deleteShiftLog();
        $data=array_merge($add,$add_shift_particulars,$delete); 
        $data['active_link']="shift-logbook";
        $data['employees']=$this->inventory_model->getAllEmployees();
        View('shift-logbook',$data); 
    }

    public function searchEmployeeLog(){
        sleep(1); 
        $log_date=$_POST['log_date'];
        $shift=$_POST['shift'];
        $emp_id=$_POST['emp_id'];
        $checkLogAvailable=$this->inventory_model->checkShiftLogAvailability($emp_id,$shift,$log_date);
        if($checkLogAvailable['count'] > 0){
            echo "<table class='table table-striped table-bordered'>";
            $edit_logbook=($checkLogAvailable['data']->editable)?"<a href='javascript:void(0)' id='edit_shift_log' shift-log-id='{$checkLogAvailable['data']->shift_log_id}' class='btn btn-sm btn-primary'>Next Page</a>":"<a class='btn btn-info btn-sm' href='javascript:void(0)' shift-log-id='{$checkLogAvailable['data']->shift_log_id}' id='shift_ended_log'>Shift Ended</a>";
            $delete_logbook="<a href='javascript:void(0)' id='delete_shift_log' shift-log-id='{$checkLogAvailable['data']->shift_log_id}' class='btn btn-sm btn-danger'>Delete</a>";
            echo "<tr><th>Employee Name</th><th>Shift</th><th>Date</th><th colspan='2'>Action</th></tr>";
            echo "<tr><td>{$checkLogAvailable['data']->emp_name}</td><td>{$checkLogAvailable['data']->shift}</td><td>{$checkLogAvailable['data']->log_date}</td><td>$edit_logbook</td><td>$delete_logbook</td></tr>";
            echo "</table>";
        }
        else{
            echo "<div class='alert alert-danger'>No Shift Log found, click <a href='javascript:void(0)' id='add_shift_log'>here</a> to create one !</div>"; 
        }
    }

    public function shiftLogParticulars(){
        sleep(1); 
        $data=array();
        $data['shift_log_id']=$_POST['shift_log_id']; 
        $data['employees']=$this->inventory_model->getAllEmployees();
        $data['particulars']=$this->inventory_model->getShiftLogParticulars($_POST['shift_log_id']);
        View("edit-shift-log-particulars",$data); 
    }

    public function shiftEndLogParticulars(){
        sleep(1);
        $data=array();
        $data['shift_log_id']=$_POST['shift_log_id']; 
        $data['employees']=$this->inventory_model->getAllEmployees();
        $data['particulars']=$this->inventory_model->getShiftLogParticulars($_POST['shift_log_id']);
        View("view-shift-log-particulars",$data);
    }


}

?>