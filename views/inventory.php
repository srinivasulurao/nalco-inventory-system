<?php View('header'); ?>
<div class='container-fluid'>    
<div class='col-md-2 sidebar-col' ><?php echo View('sidebar',$data); ?></div>
<!-- Code Content Will Go Here -->
<div class='col-md-10'>
    <h1>Inventories <a class='btn btn-sm btn-primary' style='float:right;top: 17px;position: relative;right:6px;' href='<?php echo rootUrl('/system/add-inventory'); ?>'>Add New</a></h1><hr>
    <div class='<?php echo $data['page_message_type']; ?>'><?php echo $data['page_message']; ?></div>
<?php
 //debug($data);
 $trash_icon=rootUrl("/assets/images/trash.png");
 $edit_icon=rootUrl("/assets/images/edit.png"); 
?>
<!-- Search Box -->
<div class='alert alert-info'>
<form method='POST' action='' class='search_block' >
    <input type='text' class='form-control' style='width:200px' name='search_text' placeholder="Search" value='<?php echo $_SESSION['search_text']; ?>'>
    <select name='entry_type' style='width:200px' class='form-control'>
        <option value=''>-Select Entry Type -</option>
        <option value='IN' <?php echo ($_SESSION['entry_type']=="IN")?"selected='selected'":""; ?>>IN</option>
        <option value='OUT' <?php echo ($_SESSION['entry_type']=="OUT")?"selected='selected'":""; ?>>OUT</option>
    </select>
    <select name='vendor' id='vendor' class='form-control' style='width:200px'>
                <option value=''>- Select Vendor -</option>
                <?php
                foreach($data['vendors'] as $vendor){
                ?>
                    <option <?php echo ($_SESSION['vendor']==$vendor->vendor_id)?"selected='selected'":""; ?> value='<?php echo $vendor->vendor_id; ?>'><?php echo $vendor->vendor_name; ?></option>
                <?php     
                }
                ?>
    </select>    
    <select  name='location' id='location' class='form-control' style="width:200px">
                <option value=''>- Select Location -</option>
                <?php
                foreach($data['locations'] as $location){
                    $location_selected=($_SESSION['location']==$location->location_id)?"selected='selected'":"";
                    echo "<option value='{$location->location_id}' $location_selected>{$location->location_name}</option>";
                }
                ?>
    </select> 
    <button type='submit' name='search_sub' class='btn btn-success' style='margin-left:20px'>Search</button>
    <button type='submit' name='reset_sub' class='btn btn-primary'>Reset</button>

</form>
</div>

<!-- Table list from here -->
<table class='table' style='font-size:12px'>
<tr class='table-secondary'><th>SL No.</th><th>Material Code</th><th>Description</th><th>Type</th><th>Vendor</th><th>Location</th><th>Rack</th><th>Shelf</th><th>Catalogue No</th><th>Edit</th><th>Delete</th></tr>
<?php
foreach($data['inventory_list'] as $row):
    $updated_on=date("Y-m-d H:i A",strtotime($row->updated_on));
    $edit_link=rootUrl("/system/edit-inventory/".$row->inventory_id); 
    $edit="<a href='$edit_link' class='btn btn-info shadow-sm btn-sm' style='color:white; cursor:pointer'><img src='$edit_icon' style='height:16px;width:16px'></a>";
    $delete="<a onclick='showDeleteModal($row->inventory_id)' href='javascript:void(0)' class='btn btn-danger shadow-sm btn-sm' style='color:white; cursor:pointer'><img src='$trash_icon' style='height:16px;width:16px'></a>";
    echo "<tr><td>{$row->inventory_id}</td><td><kbd>{$row->material_code}</kbd></td><td>{$row->description}</td><td>{$row->type}</td><td>{$row->vendor_name}</td><td>{$row->location_name}</td><td>{$row->rack}</td><td>{$row->shelf}</td><td>$row->catalogue_no</td><td>$edit</td><td>$delete</td></tr>";
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Inventory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure, you want to delete this inventory detail? This action can't be undone.
      </div>
      <div class="modal-footer">
        <form method='post' action=''>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name='delete_inventory_sub' class="btn btn-danger">Yes Please</button>
            <input type='hidden' name='delete_inventory_id' id="delete_inventory_id" value='' />
        </form>
      </div>
    </div>
  </div>
</div>


<?php View('footer'); ?>