<?php
session_start(); //Session is required.
class InventoryDealer{

    private $db; //Needs to be encapsulated.
    private $total_records_in_one_page=10;
    public $conditional_inventory_count;
    function __construct(){
       $this->db=connectDB();
    }

    public function authenticateUser(){
        $login_data=array();
        if(isset($_POST['login_sub'])){
            $email=$this->db->real_escape_string($_POST['user_email']);
            $pass=$this->db->real_escape_string($_POST['user_password']); 
            $password=md5($pass); 
            $results=$this->db->query("SELECT * from users WHERE email='$email' AND password='$password'"); 
            if($results->num_rows > 0 ){
                while($row=$results->fetch_object()){
                   foreach($row as $key=>$val){
                      $_SESSION['user'][$key]=$val;
                   }
                }
                //Remember Me
                $cookie_validity=time()+(24*60*365); // Cookie for 1 year, either create or destroy.
                if($_POST['remember_me']=="yes"){
                    setcookie('nalco_inventory_email',$_POST['user_email'], $cookie_validity); 
                    setcookie('nalco_inventory_password',$_POST['user_password'],$cookie_validity);
                    setcookie('nalco_credential_cookie',"yes",$cookie_validity); 
                }
                else{
                    setcookie('nalco_inventory_email',"", -$cookie_validity); 
                    setcookie('nalco_inventory_password',"", -$cookie_validity);
                    setcookie('nalco_credential_cookie',"", -$cookie_validity);  
                }
                //Redirect.
                $loc=rootUrl("/system/inventory");
                $login_data['success']=true;
                $login_data['page_message']="Login Successfull !";
                $login_data['page_message_type']="alert alert-success";
                $_SESSION['isLoggedIn']=true;
                header("location:$loc");
            }
            else{
                $login_data['success']=true;
                $login_data['page_message']="Invalid Crendentials, please check with the Administrator to reset the password !";
                $login_data['page_message_type']="alert alert-danger";
                $_SESSION['isLoggedIn']=false;
            }
        }

        return $login_data; 
    }

    public function getAllInventories($inventory_type=""){
        $per_page=$this->total_records_in_one_page;
        $page=$_GET['page']*$per_page;
        
        if(isset($_POST['search_sub'])){
            $_SESSION['search_text']=$_POST['search_text']; 
            $_SESSION['location']=$_POST['location']; 
            $_SESSION['vendor']=$_POST['vendor']; 
            $_SESSION['entry_type']=$_POST['entry_type']; 
        }
        if(isset($_POST['reset_sub'])){
            unset($_SESSION['search_text']);  
            unset($_SESSION['location']); 
            unset($_SESSION['vendor']); 
            unset($_SESSION['entry_type']);
        }
        $sql="SELECT * FROM inventories LEFT JOIN locations ON inventories.location=locations.location_id LEFT JOIN vendors ON inventories.vendor=vendors.vendor_id ";
        if($_SESSION['search_text'] || $_SESSION['location'] || $_SESSION['vendor'] || $_SESSION['entry_type']){
            $sql.=" WHERE 1 AND "; 
        }
        $more_cond=array(); 
        if($_SESSION['search_text']){
            $st=$_SESSION['search_text'];
            $more_cond[]="(inventories.material_code LIKE '%$st%' OR inventories.description='%$st%' OR inventories.quantity='%$st%' OR inventories.type='%$st%' OR inventories.rack='%$st%' OR inventories.shelf='%$st%' OR inventories.remarks='%$st%' OR inventories.catalogue_no='%$st%')";
        }
        if($_SESSION['location']){
            $more_cond[]="inventories.location='{$_SESSION['location']}'";
        }
        if($_SESSION['vendor']){
            $more_cond[]="inventories.vendor='{$_SESSION['vendor']}'";
        }
        if($_SESSION['entry_type']){
            $more_cond[]="inventories.entry_type='{$_SESSION['entry_type']}'";
        }
        if(sizeof($more_cond)){
            $sql.=implode(" AND ", $more_cond);  
        }
        $for_count=$this->db->query($sql);
        $this->conditional_inventory_count=$for_count->num_rows;
        $sql.=" ORDER BY inventories.inventory_id DESC limit $page,$per_page";
        //echo $sql;
        $results=$this->db->query($sql);
        $data=array();

        while($row=$results->fetch_object()){
            $data[]=$row;
        }

        return $data;

    }

    public function getInventoryDetail($id){
        $data=array();
        $sql="SELECT * FROM inventories WHERE inventory_id='$id'";
        $results=$this->db->query($sql);
        $data=array();
        while($row=$results->fetch_object()){
            return $row;
        }
        return $data; //Empty Data.
    }

    public function deleteInventoryDetails(){
        
        $return_data=array();
        if(isset($_POST['delete_inventory_sub'])){
           $update_sql="DELETE FROM inventories WHERE inventory_id='{$_POST['delete_inventory_id']}'";
            if($this->db->query($update_sql) === TRUE){
                $return_data['page_message']="Inventory Details Deleted Successfully !";
                $return_data['page_message_type']="alert alert-success";
            }
            else{
                $return_data['page_message']=$this->db->error;
                $return_data['page_message_type']="alert alert-danger"; 

            }

            return $return_data;
        }

        return $return_data;
    }

    public function updateInventoryDetails(){
        $return_data=array();
        if(isset($_POST['inventory_sub'])){
            $update_sql="UPDATE inventories SET";
            //Sanitize the whole post array
            $update=array(); 
            foreach($_POST as $key=>$value):
                $update[$key]=$this->db->real_escape_string($value);
                if($value and $key!="inventory_id"):
                    $update_sql.=" $key='$value',";
                endif;    
            endforeach;    
            $update_sql=rtrim($update_sql,","); 
            $update_sql.=" WHERE inventory_id='{$_POST['inventory_id']}'";
            if($this->db->query($update_sql) === TRUE){
                $return_data['page_message']="Inventory Details Updated Successfully !";
                $return_data['page_message_type']="alert alert-success";
            }
            else{
                $return_data['page_message']=$this->db->error;
                $return_data['page_message_type']="alert alert-danger"; 

            }

            return $return_data;
        }
    }
  
    public function insertInventoryDetails(){
        $return_data=array();
        if(isset($_POST['inventory_sub'])){
            $update_sql="INSERT INTO inventories SET";
            //Sanitize the whole post array
            $update=array(); 
            foreach($_POST as $key=>$value):
                $update[$key]=$this->db->real_escape_string($value);
                if($value and $key!="inventory_id"):
                    $update_sql.=" $key='$value',";
                endif;    
            endforeach;    
            $update_sql=rtrim($update_sql,","); 
            if($this->db->query($update_sql) === TRUE){
                $return_data['page_message']="Inventory Details Added Successfully !";
                $return_data['page_message_type']="alert alert-success";
            }
            else{
                $return_data['page_message']=$this->db->error;
                $return_data['page_message_type']="alert alert-danger"; 

            }

            return $return_data;
        }
    }


    public function setUpPagination($record_size,$next_page_no=0){
        
        $data=array(); 
        if($_REQUEST['page']==null || $_REQUEST['page']==0){
            $data['prev_link']="";
            if($record_size > ($this->total_records_in_one_page*$next_page_no) && $record_size > $this->total_records_in_one_page){
                $data['next_link']="<a class='page-link' href='".rootUrl("/system/inventory/?page=1")."'>Next >></a>";
            }
            else{
                $data['next_link']="";
            }
        }
        else{
            $page_no=$_REQUEST['page']; 
            $prev_page_no=$page_no-1;
            $next_page_no=$page_no+1;
            if($prev_page_no==0){
                $data['prev_link']="<a class='page-link' href='".rootUrl("/system/inventory")."'><< Prev</a>";
            }
            else{
                $data['prev_link']="<a class='page-link' href='".rootUrl("/system/inventory/?page=".$prev_page_no)."'><< Prev</a>";
            }
            if($record_size > ($this->total_records_in_one_page*$next_page_no) && $record_size > $this->total_records_in_one_page){
              $data['next_link']="<a class='page-link' href='".rootUrl("/system/inventory/?page=".$next_page_no)."'>Next >></a>";
            }
            else{
              $data['next_link']="";
            }
        }
        return $data;
    }

    public function getAllLocations(){
        $data=array();
        $results=$this->db->query("select * from locations");
        while($row=$results->fetch_object()){
            $data[]=$row;
        }
        return $data;
    }

    public function getAllVendors(){
        $data=array();
        $results=$this->db->query("select * from vendors");
        while($row=$results->fetch_object()){
            $data[]=$row;
        }
        return $data;
    }

    public function generateReport(){
        $data=array();
        $data['page_message_type']="";
        $data['page_message']="";
        try{
            if(isset($_POST['generate_report'])){ 
            $sql_query="SELECT * from inventories as i LEFT JOIN locations as l ON i.location=l.location_id LEFT JOIN vendors as v ON i.vendor=v.vendor_id";
            if($_POST['search_text'] || $_POST['location'] || $_POST['vendor'] || $_POST['created_on_start'] || $_POST['created_on_end'] || $_POST['updated_on_start'] || $_POST['updated_on_end'] || $_POST['entry_type']!="ALL"){
                $sql_query.=" WHERE 1 AND ";
            }
            $more_cond=array();
            if($_POST['search_text']){ 
                $st=$_POST['search_text'];
                $more_cond[]="(i.material_code LIKE '%$st%' OR i.description='%$st' OR i.quantity='%$st' OR i.type='%$st' OR i.rack='%$st' OR i.shelf='%$st' OR i.remarks='%$st' OR i.catalogue_no='%$st')";
            }
            if($_POST['location']){
                $more_cond[]="i.location='{$_POST['location']}'";
            }
            if($_POST['vendor']){
                $more_cond[]="i.vendor='{$_POST['vendor']}'";
            }
            if($_POST['entry_type']!="ALL"){
                $more_cond[]="i.entry_type='{$_POST['entry_type']}'";
            }
            if($_POST['created_on_start']){
                $created_on_start=strtotime($_POST['created_on_start']); 
                $more_cond[]="i.created_on > $created_on_start"; 
            }
            if($_POST['created_on_end']){
                $created_on_end=strtotime($_POST['created_on_end']); 
                $more_cond[]="i.created_on < $created_on_end"; 
            }
            if($_POST['updated_on_start']){
                $updated_on_start=strtotime($_POST['updated_on_start']); 
                $more_cond[]="i.updated_on > $updated_on_start"; 
            }
            if($_POST['updated_on_end']){
            $updated_on_end=strtotime($_POST['updated_on_end']); 
            $more_cond[]="i.updated_on < $updated_on_end"; 
            }

            $sql_query.=implode(" AND ", $more_cond); 
            $sql_query=rtrim($sql_query,"AND ");
            $sql_query.=" ORDER BY i.inventory_id";  
            //debug($sql_query); exit;
            $results=$this->db->query($sql_query);
            $xls_file_row=array("Inventory ID","Type","Material Code","Description","Quantity","Type","Vendor","Sub-Vendor","Location","Rack","Shelf","Remarks","Catalogue No","Updated On","Created On");
            $xls_file_text=implode("\t",$xls_file_row)."\n";//Always for a new line.
            $count=0;
            while($row=$results->fetch_object()){
                $report_row=array($row->inventory_id,$row->entry_type,$row->material_code,$row->description,$row->quantity,$row->type,$row->vendor_name,$row->sub_vendor,$row->location_name,$row->rack,$row->shelf,$row->remarks,$row->catalogue_no,$row->updated_on,$row->created_on); 
                $xls_file_text.=implode("\t",$report_row)."\n"; 
                $count++;
            }
            $report_file="/storage/reports/inventory_report_".time().".xls"; 
            $storage_file=getRootPath($report_file); 
            $fp=fopen($storage_file,"w+");
            fwrite($fp,$xls_file_text); 
            $data['page_message_type']="alert alert-success";
            $report_url=rootUrl($report_file); 
            $data['total_records']= $count;
            $data['page_message']="Report Generated Successfully, Click <a target='_blank' href='$report_url'>Here</a> to download !"; 
            }
        }
        catch(Exception $e){
            $data['page_message_type']="alert alert-danger";
            $data['page_message']="Error :".$e->getMessage()." @ Line No.".$e->getLine();
        }
        return $data;
    }

    ##################################################################
    //Vendor CRUD operations.
    #################################################################

    public function addVendorDetails(){
        $return_data=array();
        if(isset($_POST['add_vendor_sub'])){
            $vendor_name=$this->db->real_escape_string($_POST['vendor_name']);
            $time=date("Y-m-d H:i:s",time());
            $added=$this->db->query("INSERT INTO vendors SET vendor_name='$vendor_name', updated_on='$time', created_on='$time'");
            if($added=== TRUE){
                $return_data['page_message']="Vendor Details Added Successfully !";
                $return_data['page_message_type']="alert alert-success";
            }
            else{
                $return_data['page_message']=$this->db->error;
                $return_data['page_message_type']="alert alert-danger"; 

            }
        }
        return $return_data;
    }

    public function updateVendorDetails(){
        $return_data=array();
        if(isset($_POST['update_vendor_sub'])){
            $vendor_name=$this->db->real_escape_string($_POST['update_vendor_name']);
            $time=date("Y-m-d H:i:s",time());
            $vendor_id=$_POST['update_vendor_id']; 
            $added=$this->db->query("UPDATE vendors SET vendor_name='$vendor_name', updated_on='$time' WHERE vendor_id='$vendor_id'");
            if($added=== TRUE){
                $return_data['page_message']="Vendor Details Updated Successfully !";
                $return_data['page_message_type']="alert alert-success";
            }
            else{
                $return_data['page_message']=$this->db->error;
                $return_data['page_message_type']="alert alert-danger"; 

            }
        }
        return $return_data;
    }

    public function deleteVendorDetails(){
        $return_data=array();
        if(isset($_POST['delete_vendor_sub'])){
            $delete_vendor_id=$_POST['delete_vendor_id']; 
            $added=$this->db->query("DELETE from vendors WHERE vendor_id='$delete_vendor_id'");
            if($added=== TRUE){
                $return_data['page_message']="Vendor Details Deleted Successfully !";
                $return_data['page_message_type']="alert alert-success";
            }
            else{
                $return_data['page_message']=$this->db->error;
                $return_data['page_message_type']="alert alert-danger"; 

            }
        }
        return $return_data;
    }

    ##################################################################
    //Location CRUD operations.
    #################################################################

    public function addLocationDetails(){
        $return_data=array();
        if(isset($_POST['add_location_sub'])){
            $location_name=$this->db->real_escape_string($_POST['location_name']);
            $time=date("Y-m-d H:i:s",time());
            $added=$this->db->query("INSERT INTO locations SET location_name='$location_name', updated_on='$time', created_on='$time'");
            if($added=== TRUE){
                $return_data['page_message']="Location Details Added Successfully !";
                $return_data['page_message_type']="alert alert-success";
            }
            else{
                $return_data['page_message']=$this->db->error;
                $return_data['page_message_type']="alert alert-danger"; 

            }
        }
        return $return_data;
    }

    public function updateLocationDetails(){
        $return_data=array();
        if(isset($_POST['update_location_sub'])){
            $location_name=$this->db->real_escape_string($_POST['update_location_name']);
            $time=date("Y-m-d H:i:s",time());
            $location_id=$_POST['update_location_id']; 
            $added=$this->db->query("UPDATE locations SET location_name='$location_name', updated_on='$time' WHERE location_id='$location_id'");
            if($added=== TRUE){
                $return_data['page_message']="Location Details Updated Successfully !";
                $return_data['page_message_type']="alert alert-success";
            }
            else{
                $return_data['page_message']=$this->db->error;
                $return_data['page_message_type']="alert alert-danger"; 

            }
        }
        return $return_data;
    }


    public function deleteLocationDetails(){
        $return_data=array();
        if(isset($_POST['delete_location_sub'])){
            $delete_location_id=$_POST['delete_location_id']; 
            $added=$this->db->query("DELETE from vendors WHERE vendor_id='$delete_location_id'");
            if($added=== TRUE){
                $return_data['page_message']="Location Details Deleted Successfully !";
                $return_data['page_message_type']="alert alert-success";
            }
            else{
                $return_data['page_message']=$this->db->error;
                $return_data['page_message_type']="alert alert-danger"; 

            }
        }
        return $return_data;
    }

    function getAllEmployees(){
        $return_data=array();
        $query=$this->db->query("SELECT * FROM employees",$this->db->con);
        while($rec=$query->fetch_object()){
            $return_data[]=$rec;
        }
        return $return_data; 
    }

    public function addEmployeeDetails(){
        $return_data=array();
        if(isset($_POST['add_employee_sub'])){
            $insert=array();
            foreach($_POST as $key=>$value):
                $insert[$key]=$this->db->real_escape_string($value);  
            endforeach; 
            $emp_dop=date("Y-m-d", strtotime($insert['emp_dop']));
            $emp_dob=date("Y-m-d", strtotime($insert['emp_dob'])); 
            $sql="INSERT INTO employees SET emp_name='{$insert['emp_name']}', emp_designation='{$insert['emp_designation']}', emp_dop='$emp_dop', emp_dob='$emp_dob', emp_blood_grp='{$insert['emp_blood_grp']}', emp_phone='{$insert['emp_phone']}', emp_mail='{$insert['emp_mail']}'";
            $added=$this->db->query($sql);
            if($added=== TRUE){
                $return_data['page_message']="Employee Details Deleted Successfully !";
                $return_data['page_message_type']="alert alert-success";
            }
            else{
                $return_data['page_message']=$this->db->error;
                $return_data['page_message_type']="alert alert-danger"; 

            }
        }
        return $return_data;
    }

    public function deleteEmployeeDetails(){
        $return_data=array();
        if(isset($_POST['delete_employee_sub'])){
              $delete=$this->db->query("DELETE FROM employees WHERE emp_id='{$_POST['delete_employee_id']}'");
              if($delete=== TRUE){
                $return_data['page_message']="Employee Details Deleted Successfully !";
                $return_data['page_message_type']="alert alert-success";
              }
              else{
                    $return_data['page_message']=$this->db->error;
                    $return_data['page_message_type']="alert alert-danger"; 

                }
        }
        return $return_data;
    }

    public function updateEmployeeDetails(){
        $return_data=array();
        if(isset($_POST['update_employee_sub'])){
            $update=array();
            foreach($_POST as $key=>$val){
                $update[$key]=$this->db->real_escape_string($val);
            }
            $emp_dop=date("Y-m-d", strtotime($update['emp_dop']));
            $emp_dob=date("Y-m-d", strtotime($update['emp_dob'])); 
            $sql="UPDATE employees SET emp_name='{$update['emp_name']}', emp_designation='{$update['emp_designation']}', emp_dop='$emp_dop', emp_dob='$emp_dob', emp_blood_grp='{$update['emp_blood_grp']}', emp_phone='{$update['emp_phone']}', emp_mail='{$update['emp_mail']}' WHERE emp_id='{$update['emp_id']}'";
            $update=$this->db->query($sql); 
            if($update=== TRUE){
                $return_data['page_message']="Employee Details Updated Successfully !";
                $return_data['page_message_type']="alert alert-success";
            }
            else{
                    $return_data['page_message']=$this->db->error;
                    $return_data['page_message_type']="alert alert-danger"; 

            }
        }

        return $return_data;
    }

    public function checkShiftLogAvailability($emp_id,$shift,$log_date){
        $return_data=array();
        $log_date=date("Y-m-d",strtotime($log_date));
        $sql="SELECT shift_logs.*,employees.emp_name FROM shift_logs LEFT JOIN employees ON shift_logs.emp_id=employees.emp_id WHERE shift_logs.log_date='{$log_date}' AND shift_logs.emp_id='$emp_id' AND shift_logs.shift='$shift'";
        $result=$this->db->query($sql);
        if($result->num_rows){
            $return_data['count']=1;
            $return_data['data']=$result->fetch_object();
        }
        else{
            $return_data['count']=0;
            $return_data['data']=0;
        }
        return $return_data;
    }

    public function deleteShiftLog(){
        $return_data=array();
        if(isset($_POST['delete_shiftlog_sub'])){
            $delete=$this->db->query("DELETE FROM shift_logs WHERE shift_log_id='{$_POST['delete_shiftlog_id']}'");
            $delete_log_records=$this->db->query("DELETE FROM shift_log_particulars WHERE shift_log_id='{$_POST['delete_shiftlog_id']}'"); 
            if($delete=== TRUE && $delete_log_records === TRUE){
              $return_data['page_message']="Employee Shift Log Deleted Successfully !";
              $return_data['page_message_type']="alert alert-success";
            }
            else{
                  $return_data['page_message']=$this->db->error;
                  $return_data['page_message_type']="alert alert-danger"; 

              }
        }
        return $return_data;
    }

    public function getShiftLogParticulars($shift_log_id){
        $return_data=array();
        $sql="SELECT * FROM shift_log_particulars WHERE shift_log_id='$shift_log_id'";
        $results=$this->db->query($sql);
        while($rec=$results->fetch_object()){
            $return_data[]=$rec;
        }
        //debug($return_data); 
        return $return_data;
    }

    public function addShiftLogParticulars(){
        // debug($_POST); 
        $return_data=array();
        if(isset($_POST['save_shift_log_particulars'])):
            $shift_log_id=$_POST['shift_log_id']; 
            $row_count=sizeof($_POST['log_particular_id']);
            for($i=0;$i<$row_count;$i++){
               $log_particular_id=$_POST['log_particular_id'][$i];
               $equipment_affected=$_POST['equipment_affected'][$i];
               $nature_job_defect=$_POST['nature_job_defect'][$i];
               $reporting_time=date("H:i:s",strtotime($_POST['reporting_time'][$i]));
               $handover_time=date("H:i:s",strtotime($_POST['handover_time'][$i])); 
               $done_by=$_POST['done_by'][$i]; 
               if($log_particular_id != "new"){
                   //Update the existing the records.
                   $sql="UPDATE shift_log_particulars SET equipment_affected='$equipment_affected', nature_job_defect='$nature_job_defect', reporting_time='$reporting_time', handover_time='$handover_time', emp_id='$done_by' WHERE log_particular_id='$log_particular_id' AND shift_log_id='{$shift_log_id}'";
               }
               else{
                   $sql="INSERT INTO shift_log_particulars SET equipment_affected='$equipment_affected', nature_job_defect='$nature_job_defect', reporting_time='$reporting_time', handover_time='$handover_time', emp_id='$done_by', shift_log_id='{$shift_log_id}'";
               }
               $operation_success=$this->db->query($sql);
               if($operation_success===TRUE){
                   $return_data['page_message']="Employee Shift Log Particulars Updated Successfully !";
                   $return_data['page_message_type']="alert alert-success";
               }
               else{
                  $return_data['page_message']=$this->db->error; 
                  $return_data['page_message_type']="alert alert-danger";
                  break; // Come out of the loop.
               }
            }
        endif;    
        if(isset($_POST['end_shift_log_book'])){
                $shift_log_id=$_POST['shift_log_id'];
                $end_shift=$this->db->query("UPDATE shift_logs SET editable='0' WHERE shift_log_id='$shift_log_id'");
                if($end_shift===TRUE){
                    $return_data['page_message']="End Shift Confirmed Successfully !";
                    $return_data['page_message_type']="alert alert-success";
                }
                else{
                   $return_data['page_message']=$this->db->error;
                   $return_data['page_message_type']="alert alert-danger";
                }
        }
        return $return_data;
    }

    public function addNewShiftLogbook(){
        $return_data=array();
        if(isset($_POST['add_shift_logbook_sub'])){
            $insert=array();
           foreach($_POST as $key=>$val){
               $insert[$key]=$val;
           }
           $sql="INSERT INTO shift_logs SET shift='{$insert['shift']}', emp_id='{$insert['emp_id']}', log_date='{$insert['shift_date']}',editable='1'";
           $added=$this->db->query($sql);
           if($added===TRUE){
                $return_data['page_message']="New Shift Logbook Created Successfully, You can now particulars of the log book !";
                $return_data['page_message_type']="alert alert-success";
           }
           else{
                $return_data['page_message']=$this->db->error;
                $return_data['page_message_type']="alert alert-danger";
           }
        }
        return $return_data;
    }




}//Class ends here.