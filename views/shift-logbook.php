<?php View('header'); ?>
<div class='container-fluid'>    
<div class='col-md-2 sidebar-col' ><?php echo View('sidebar',$data); ?></div>
<!-- Code Content Will Go Here -->
<div class='col-md-10'>
    <h1>Shift Logbook </h1><hr>
    <div class='<?php echo $data['page_message_type']; ?>'><?php echo $data['page_message']; ?></div>

    <form method="post" action="" class='shift_logbook_form jumbotron'>
        <label>Date </label>
        <input type="text" name="log_date" id="log_date" class="form-control" required="required">
        <label>Shift </label>
        <select name="shift" id="shift" class="form-control" required="required">
            <option value=''>--Select Shift--</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        </select>
        <label>Employees</label>
        <select name='emp_id' id="emp_id" class="form-control" required="required">
            <option value="">--SELECT--</option>
            <?php 
            foreach($data['employees'] as $employee):
                echo "<option value=\"{$employee->emp_id}\">{$employee->emp_name}</option>";
            endforeach;    
            ?>
        </select>
        <button class="btn btn-info" type="submit">Search</button>
    </form>

    <div id="shift_log_playground"></div>
    <div id="shift_log_particulars"></div>


</div> <!-- Container fluid ends here -->

<!-- Delete Modal to be Shown Here -->
<div class="modal fade" id="deleteShiftlogModal" tabindex="-1" role="dialog" aria-labelledby="deleteShiftlogModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure, you want to delete this Shift Log? This action can't be undone.
      </div>
      <div class="modal-footer">
        <form method='post' action=''>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name='delete_shiftlog_sub' class="btn btn-danger">Yes Please</button>
            <input type='hidden' name='delete_shiftlog_id' id="delete_shiftlog_id" value='' />
        </form>
      </div>
    </div>
  </div>
</div>   

<!-- New Shift Log book form -->

<div class="modal fade" id="addShiftLogbookModal" tabindex="-1" role="dialog" aria-labelledby="addShiftLogbookModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Shift Logbook</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method='post' action=''>
      <div class="modal-body">
            <label>Employee Name</label>
            <select class='form-control' required='required' name='emp_id' id='emp_id'>
              <option value=''>--SELECT--</option>
              <?php 
              foreach($data['employees'] as $employee):
                  echo "<option value=\"{$employee->emp_id}\">{$employee->emp_name}</option>";
              endforeach;    
              ?>
            </select>
            <label>Shift</label>
            <select type='text' class='form-control' name='shift' id='shift' required='required'>
              <option value='A'>A</option>
              <option value='B'>B</option>
              <option value='C'>C</option>
            </select>
            <label>Shift Date</label>
            <input type='text' name='shift_date' id='shift_date' class='form-control' />

      </div>
      <div class="modal-footer">
            <button type="submit" name='add_shift_logbook_sub' class="btn btn-danger">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php View('footer'); ?>