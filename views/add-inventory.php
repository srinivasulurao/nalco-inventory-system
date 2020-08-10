<?php View('header'); ?>
<div class='container-fluid'>    
<div class='col-md-2 sidebar-col' ><?php echo View('sidebar',$data); ?></div>
<!-- Code Content Will Go Here -->
<div class='col-md-9'>
    <h1>Add New Inventory</h1><hr>
    <div class='<?php echo $data['page_message_type']; ?>'><?php echo $data['page_message']; ?></div>
<form method='post' action=''>
    <div class="row">
        <div class='col'>
            <label>Material Code</label>
            <input type='text' required='required' name='material_code' id='material_code' class='form-control'>
        </div>

        <div class='col'>
            <label>Location</label>
            <select  required='required' name='location' id='location' class='form-control'>
                <option value=''>--SELECT--</option>
                <?php
                foreach($data['locations'] as $location){
                    echo "<option value='{$location->location_id}' >{$location->location_name}</option>";
                }
                ?>
            </select>
        </div>

        <div class='col'>
            <label>Quantity</label>
            <input type='number' required='required'  name='quantity' id='quantity' class='form-control'>
        </div>
        <div class='col'>
            <label>Type</label>
            <input type='text'  required='required' name='type' id='type' class='form-control'>
        </div>

    </div>

    <div class="row">
        <div class='col'>
            <label>Vendor</label>
            <select  required='required' name='vendor' id='vendor' class='form-control'>
                <option value=''>--SELECT--</option>
                <?php
                foreach($data['vendors'] as $vendor){
                    echo "<option value='{$vendor->vendor_id}'>{$vendor->vendor_name}</option>";
                }
                ?>
            </select>    
        </div>
        <div class='col'>
            <label>Sub Vendor</label>
            <input type='text'  required='required' name='sub_vendor' id='sub_vendor' class='form-control'>
        </div>

        <div class='col'>
            <label>Rack</label>
            <input type='text' required='required'  name='rack' id='rack' class='form-control'>
        </div>
        <div class='col'>
            <label>Shelf</label>
            <input type='text'  required='required' name='shelf' id='shelf' class='form-control'>
        </div>
    </div>

    <div class="row">
        <div class='col'>
                <label>Description</label>
                <textarea class='form-control' required='required'  name='description' id='description'></textarea>
        </div>
        <div class='col'>
            <label>Remarks</label>
            <textarea  required='required' class='form-control' name='remarks' id='remarks'></textarea>
        </div>
    </div>

    

    <div class="row">
        <div class='col'>
            <label>Entry Type</label>
            <select type='text' name='entry_type' id='entry_type' class='form-control' required='required'>
                <option value=''>--SELECT--</option>
                <option value='IN'>IN</option>
                <option value='OUT'>OUT</option>
            </select>
        </div>
        <div class='col'>
            <label>Catalogue No</label>
            <input required='required' type='text' name='catalogue_no' id='catalogue_no' class='form-control'>
        </div>
        <div class='col'>
            <label>Updated On</label>
            <input placeholder="Ex: 2012-05-31 08:30 AM" required='required'  type='text' name='updated_on' id='updated_on' class='form-control'>
        </div>
        <div class='col'>
            <label>Created On</label>
            <input placeholder="Ex: 2012-05-31 08:30 AM" required='required' type='text' name='created_on' id='created_on' class='form-control'>
        </div>
    </div>

    <div class="row" style='margin:auto;margin-top:20px;width:200px'>
    <button class='btn btn-success' name='inventory_sub' type='submit' class='form-control'>SAVE</button> &nbsp;
    <a href='<?php echo rootUrl("/system/inventory"); ?>' class='btn btn-primary'>BACK</a>
    </div>
    
</form>

</div>

</div> <!-- Container fluid ends here -->
<?php View('footer'); ?>