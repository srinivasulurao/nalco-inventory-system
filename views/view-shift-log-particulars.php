<?php
echo "<table class='table table-striped table-bordered'>";
echo "<tr><th>SL NO</th><th>Equipment Affected</th><th>Nature of Defect / Nature of Job Done</th><th width='12%'>Reporting Time</th><th width='12%'>Handover Time</th><th>Done By</th></tr>";
$user_dropdown='<option value="">--SELECT--</option>';
foreach($data['particulars'] as $particular){
    $equipment_affected=$particular->equipment_affected;
    $nature=$particular->nature_job_defect;
    $prt=date("h:i A", strtotime($particular->reporting_time));
    $reporting_time=$prt;
    $pht=date("h:i A", strtotime($particular->handover_time));
    $handover_time=$pht;
    foreach($data['employees'] as $employee):
        if($particular->emp_id==$employee->emp_id){
          $done_by=$employee->emp_name;  
          break;
        }
    endforeach;
    $log_particular_id=$particular->log_particular_id;
    echo "<tr><td>$log_particular_id</td><td>$equipment_affected</td><td>$nature</td><td>$reporting_time</td><td>$handover_time</td><td>$done_by</td></tr>";
}
echo "</table>";
?>
<button style='float:right' type="button" class='btn btn-sm btn-success' onclick="printShiftLog()">Print</button>