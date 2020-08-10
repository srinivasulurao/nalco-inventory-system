<?php View('header'); ?>
<div class='container-fluid'>    
<div class='col-md-2 sidebar-col' ><?php echo View('sidebar',$data); ?></div>
<!-- Code Content Will Go Here -->
<div class='col-md-10'>
    <h1>Locations <button class='btn btn-sm btn-primary' style='float:right;top: 17px;position: relative;' id='add_location_button' >Add New</button></h1><hr>
    <div class='<?php echo $data['page_message_type']; ?>'><?php echo $data['page_message']; ?></div>
<?php
 //debug($data);
 $trash_icon=rootUrl("/assets/images/trash.png");
 $edit_icon=rootUrl("/assets/images/edit.png"); 
?>
<!-- Table list from here -->
<table class='table' style='font-size:12px'>
<tr class='table-secondary'><th>Location ID</th><th>Location Name</th><th>Updated On</th><th>Created On</th><th>Edit</th><th>Delete</th></tr>
<?php
foreach($data['locations'] as $row):
    $updated_on=date("Y-m-d H:i A",strtotime($row->updated_on));
    $created_on=date("Y-m-d H:i A",strtotime($row->created_on)); 
    $edit="<a location-id='{$row->location_id}' location-name='{$row->location_name}' class='btn btn-info shadow-sm btn-sm update_location_button' style='color:white; cursor:pointer'><img src='$edit_icon' style='height:16px;width:16px'></a>";
    $delete="<a href='javascript:void(0)' class='btn btn-danger shadow-sm btn-sm delete_location_button' location-id='{$row->location_id}' style='color:white; cursor:pointer'><img src='$trash_icon' style='height:16px;width:16px'></a>";
    echo "<tr><td>{$row->location_id}</td><td><kbd>{$row->location_name}</kbd></td><td>{$updated_on}</td><td>{$created_on}</td><td>$edit</td><td>$delete</td></tr>";
endforeach;    
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
<div class="modal fade" id="deleteLocationModal" tabindex="-1" role="dialog" aria-labelledby="deletelocationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure, you want to delete this location? This action can't be undone.
      </div>
      <div class="modal-footer">
        <form method='post' action=''>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name='delete_location_sub' class="btn btn-danger">Yes Please</button>
            <input type='hidden' name='delete_location_id' id="delete_location_id" value='' />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addLocationModal" tabindex="-1" role="dialog" aria-labelledby="addlocationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method='post' action=''>
      <div class="modal-body">
            <label>location Name</label>
            <input type='text' class='form-control' name='location_name' id='location_name' required="required" />
      </div>
      <div class="modal-footer">
            <button type="submit" name='add_location_sub' class="btn btn-danger">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="updateLocationModal" tabindex="-1" role="dialog" aria-labelledby="updatelocationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method='post' action=''>
      <div class="modal-body">
            <label>location Name</label>
            <input type='text' class='form-control' name="update_location_name" id='update_location_name' required="required" />
      </div>
      <div class="modal-footer">
            <input type='hidden' name='update_location_id' id="update_location_id">
            <button type="submit" name='update_location_sub' class="btn btn-danger">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php View('footer'); ?>