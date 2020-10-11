<?php
echo "<form method='post' action=''>";
echo "<table class='table table-striped table-bordered' id='shift_log_particular_table'>";
echo "<tr><th>SL NO</th><th>Equipment Affected</th><th>Nature of Defect / Nature of Job Done</th><th width='12%'>Reporting Time</th><th width='12%'>Handover Time</th><th>Done By</th></tr>";
$user_dropdown='<option value="">--SELECT--</option>';

foreach($data['particulars'] as $particular){
    $equipment_affected="<input required='required' class='form-control' type='text' name='equipment_affected[]' value='{$particular->equipment_affected}'>";
    $nature="<input type='text' required='required' class='form-control' name='nature_job_defect[]' value='{$particular->nature_job_defect}'>";
    $prt=date("h:i A", strtotime($particular->reporting_time));
    $reporting_time="<input placeholder='Ex: 06:25 AM' required='required' class='form-control' type='text' name='reporting_time[]' value='$prt'>";
    $pht=date("h:i A", strtotime($particular->handover_time));
    $handover_time="<input  placeholder='Ex: 06:25 AM' required='required' class='form-control' type='text' name='handover_time[]' value='$pht'>";
    foreach($data['employees'] as $employee):
        $done_by_selected=($particular->emp_id==$employee->emp_id)?"selected='selected'":"";  
        $user_dropdown.="<option $done_by_selected value=\"{$employee->emp_id}\">{$employee->emp_name}</option>";
    endforeach;
    $log_particular_id="{$particular->log_particular_id}<input type='hidden' name='log_particular_id[]' value='{$particular->log_particular_id}' />";
    $done_by="<select required='required' name='done_by[]' class='form-control' type='emp_id'>$user_dropdown</select>";
    echo "<tr><td>$log_particular_id</td><td>$equipment_affected</td><td>$nature</td><td>$reporting_time</td><td>$handover_time</td><td>$done_by</td></tr>";
}
echo "</table>";
echo "<input type='hidden' value='{$data['shift_log_id']}' name='shift_log_id' id='shift_log_id'>";
echo "<br><button type='submit' name='end_shift_log_book' class='btn btn-info'>End Shift</button> &nbsp; <button type='submit' name='save_shift_log_particulars' class='btn btn-success'>Save</button>";
echo "<button id='add_new_shift_log_particular' type='button' class='btn btn-primary' style='float:right'>Add New</button>";

//We need to prepare for "Add New" functionality as well.
$add_new="<tr><td>New Entry<input type='hidden' name='log_particular_id[]' value='new' /></td>";
$add_new.="<td><input required='required' class='form-control' type='text' name='equipment_affected[]'></td>";
$add_new.="<td><input required='required' type='text' class='form-control' name='nature_job_defect[]'></td>";
$add_new.="<td><input  placeholder='Ex: 06:25 AM' required='required' class='form-control' type='text' name='reporting_time[]'></td>";
$add_new.="<td><input  placeholder='Ex: 06:25 AM' required='required' class='form-control' type='text' name='handover_time[]' ></td>";
$emp_dropdown="<option value=''>--SELECT--</option>";
foreach($data['employees'] as $employee):
    $emp_dropdown.="<option value=\"{$employee->emp_id}\">{$employee->emp_name}</option>";
endforeach;
$add_new.="<td><select required='required' name='done_by[]' class='form-control' type='emp_id'>$emp_dropdown</select></td></tr>";
echo "<input type='hidden' name='add_new_row' id='add_new_row' value='".base64_encode($add_new)."' />"; 

echo "</form>";
?>