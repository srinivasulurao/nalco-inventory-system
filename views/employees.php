<?php View('header'); ?>
<div class='container-fluid'>    
<div class='col-md-2 sidebar-col' ><?php echo View('sidebar',$data); ?></div>
<!-- Code Content Will Go Here -->
<div class='col-md-10'>
    <h1>Employee Database <button class='btn btn-sm btn-primary' style='float:right;top: 17px;position: relative;' id='add_emp_button' >Add New</button></h1><hr>
    <div class='<?php echo $data['page_message_type']; ?>'><?php echo $data['page_message']; ?></div>
<?php
 //debug($data);
 $trash_icon=rootUrl("/assets/images/trash.png");
 $edit_icon=rootUrl("/assets/images/edit.png"); 
?>
<!-- Table list from here -->
<table class='table' style='font-size:10px'>
<tr class='table-secondary'><th>SL NO.</th><th>Name</th><th>Grade/Designation</th><th>Date of Promotion</th><th>Date of Birth</th><th>Blood Group</th><th>Phone No.</th><th>Email Id</th><th>Edit</th><th>Delete</th></tr>
<?php
$emp_counter=0;
foreach($data['employees'] as $row):
    $dop=date("Y-m-d",strtotime($row->emp_dop));
    $dob=date("Y-m-d",strtotime($row->emp_dob)); 
    $encode_data=base64_encode(json_encode($row));
    $edit="<a encoded-data='$encode_data' class='btn btn-info shadow-sm btn-sm update_emp_button' style='color:white; cursor:pointer'><img src='$edit_icon' style='height:16px;width:16px'></a>";
    $delete="<a href='javascript:void(0)' class='btn btn-danger shadow-sm btn-sm delete_emp_button' employee-id='{$row->emp_id}' style='color:white; cursor:pointer'><img src='$trash_icon' style='height:16px;width:16px'></a>";
    echo "<tr><td>{$row->emp_id}</td><td><kbd>{$row->emp_name}</kbd></td><td>{$row->emp_designation}<td>{$dop}</td><td>{$dob}</td><td>{$row->emp_blood_grp}</td><td>{$row->emp_phone}</td><td>{$row->emp_mail}</td><td>$edit</td><td>$delete</td></tr>";
    $emp_counter++;
endforeach;    
   if($emp_counter==0){
       echo "<tr><td colspan='5'><font color='red'>Sorry, No Records found !</font></td></tr>"; 
   }
?>
</table>

<div class='pagination' style='margin:auto;width:200px'>
    <ul class='pagination' >
        <li class='page-item'><?php echo $data['prev_link']; ?></li>
        <li class='page-item'><?php echo $data['next_link']; ?></li>
    </ul>
</div>

</div>

</div> <!-- Container fluid ends here -->

<!-- Delete Modal to be Shown Here -->
<div class="modal fade" id="deleteEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="deleteEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure, you want to delete this Employee? This action can't be undone.
      </div>
      <div class="modal-footer">
        <form method='post' action=''>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name='delete_employee_sub' class="btn btn-danger">Yes Please</button>
            <input type='hidden' name='delete_employee_id' id="delete_employee_id" value='' />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method='post' action=''>
      <div class="modal-body" id="add_employee_form">
            <label>Employee Name</label>
            <input type='text' class='form-control' name='emp_name' id='emp_name' required="required" />
            <label>Email Address</label>
            <input type="email" class="form-control" name="emp_mail" id="emp_mail" required="required" />
            <label>Grade / Designation</label>
            <input type="text" class="form-control" name="emp_designation" id="emp_designation" required="required" />
            <label>Date of Promotion</label>
            <input type="text" class="form-control" name="emp_dop" id="employee_dop" required="required" />
            <label>Date of Birth</label>
            <input type="text" class="form-control" name="emp_dob" id="employee_dob" required="required" />
            <label>Blood Group</label>
            <input type="text" class="form-control" name="emp_blood_grp" id="emp_blood_grp" required="required" />
            <label>Phone Number</label>
            <input type="tel" class="form-control" name="emp_phone" id="emp_phone" required="required" />
            
      </div>
      <div class="modal-footer">
            
            <button type="submit" name='add_employee_sub' class="btn btn-danger">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="updateEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="updateEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method='post' action=''>
      <div class="modal-body" id="update_employee_form">
      <label>Employee Name</label>
            <input type='text' class='form-control' name='emp_name' id='emp_name' required="required" />
            <label>Email Address</label>
            <input type="email" class="form-control" name="emp_mail" id="emp_mail" required="required" />
            <label>Grade / Designation</label>
            <input type="text" class="form-control" name="emp_designation" id="emp_designation" required="required" />
            <label>Date of Promotion</label>
            <input type="text" class="form-control" name="emp_dop" id="emp_dop" required="required" />
            <label>Date of Birth</label>
            <input type="text" class="form-control" name="emp_dob" id="emp_dob" required="required" />
            <label>Blood Group</label>
            <input type="text" class="form-control" name="emp_blood_grp" id="emp_blood_grp" required="required" />
            <label>Phone Number</label>
            <input type="tel" class="form-control" name="emp_phone" id="emp_phone" required="required" />
            <input  type="hidden" name="emp_id" id="emp_id" value="" />
      </div>
      <div class="modal-footer">
            
            <button type="submit" name='update_employee_sub' class="btn btn-danger">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php View('footer'); ?>