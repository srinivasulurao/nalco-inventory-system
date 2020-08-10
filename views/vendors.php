<?php View('header'); ?>
<div class='container-fluid'>    
<div class='col-md-2 sidebar-col' ><?php echo View('sidebar',$data); ?></div>
<!-- Code Content Will Go Here -->
<div class='col-md-10'>
    <h1>Vendors <button class='btn btn-sm btn-primary' style='float:right;top: 17px;position: relative;' id='add_vendor_button' >Add New</button></h1><hr>
    <div class='<?php echo $data['page_message_type']; ?>'><?php echo $data['page_message']; ?></div>
<?php
 //debug($data);
 $trash_icon=rootUrl("/assets/images/trash.png");
 $edit_icon=rootUrl("/assets/images/edit.png"); 
?>
<!-- Table list from here -->
<table class='table' style='font-size:12px'>
<tr class='table-secondary'><th>Vendor ID</th><th>Vendor Name</th><th>Updated On</th><th>Created On</th><th>Edit</th><th>Delete</th></tr>
<?php
foreach($data['vendors'] as $row):
    $updated_on=date("Y-m-d H:i A",strtotime($row->updated_on));
    $created_on=date("Y-m-d H:i A",strtotime($row->created_on)); 
    $edit="<a vendor-id='{$row->vendor_id}' vendor-name='{$row->vendor_name}' class='btn btn-info shadow-sm btn-sm update_vendor_button' style='color:white; cursor:pointer'><img src='$edit_icon' style='height:16px;width:16px'></a>";
    $delete="<a href='javascript:void(0)' class='btn btn-danger shadow-sm btn-sm delete_vendor_button' vendor-id='{$row->vendor_id}' style='color:white; cursor:pointer'><img src='$trash_icon' style='height:16px;width:16px'></a>";
    echo "<tr><td>{$row->vendor_id}</td><td><kbd>{$row->vendor_name}</kbd></td><td>{$updated_on}</td><td>{$created_on}</td><td>$edit</td><td>$delete</td></tr>";
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
<div class="modal fade" id="deleteVendorModal" tabindex="-1" role="dialog" aria-labelledby="deleteVendorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure, you want to delete this Vendor? This action can't be undone.
      </div>
      <div class="modal-footer">
        <form method='post' action=''>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name='delete_vendor_sub' class="btn btn-danger">Yes Please</button>
            <input type='hidden' name='delete_vendor_id' id="delete_vendor_id" value='' />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addVendorModal" tabindex="-1" role="dialog" aria-labelledby="addVendorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method='post' action=''>
      <div class="modal-body">
            <label>Vendor Name</label>
            <input type='text' class='form-control' name='vendor_name' id='vendor_name' required="required" />
      </div>
      <div class="modal-footer">
            <button type="submit" name='add_vendor_sub' class="btn btn-danger">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="updateVendorModal" tabindex="-1" role="dialog" aria-labelledby="updateVendorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method='post' action=''>
      <div class="modal-body">
            <label>Vendor Name</label>
            <input type='text' class='form-control' name="update_vendor_name" id='update_vendor_name' required="required" />
      </div>
      <div class="modal-footer">
            <input type='hidden' name='update_vendor_id' id="update_vendor_id">
            <button type="submit" name='update_vendor_sub' class="btn btn-danger">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php View('footer'); ?>