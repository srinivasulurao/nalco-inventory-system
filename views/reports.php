<?php View('header'); ?>
<div class='container-fluid'>    
<div class='col-md-2 sidebar-col' ><?php echo View('sidebar',$data); ?></div>
<!-- Code Content Will Go Here -->
<div class='col-md-10'>
<h1>Generate Reports</h1><hr>
<div class='<?php echo $data['page_message_type']; ?>'><?php echo $data['page_message']; ?></div>
<form method='post' action=''>
    <div class='jumbotron report-jumbotron' style='padding:2rem 1rem;padding-bottom:60px'>
        <h5>Filters</h5><hr>
        <label>Search Text</label>
        <input type='text' class='form-control' name='search_text' value='<?php echo $_POST['search_text']; ?>'>
        <label>Update On</label>
        <input type='text' class='form-control' id="updated_on_start" value='<?php echo $_POST['updated_on_start']; ?>' name='updated_on_start'> -
        <input type='text' class='form-control' id="updated_on_end" value='<?php echo $_POST['updated_on_end']; ?>' name='updated_on_end'><br>

        <label>Entry Type</label>
        <select  name="entry_type" class='form-control'>
            <option value='ALL'>ALL</option>
            <option value='IN' <?php echo ($_POST['entry_type']=="IN")?"selected='selected'":""; ?> >IN</option>
            <option value='OUT' <?php echo ($_POST['entry_type']=="OUT")?"selected='selected'":""; ?> >OUT</option>
        </select>

        <label>Created On</label>
        <input type='text' class='form-control' id="created_on_start" name="created_on_start" value='<?php echo $_POST['created_on_start']; ?>' > -  
        <input type='text' class='form-control' id="created_on_end" name='created_on_end' value='<?php echo $_POST['created_on_start']; ?>' > 
        <br>
        
        <label>Vendor</label>
        <select name='vendor' id='vendor' class='form-control'>
                    <option value=''>--SELECT--</option>
                    <?php
                    foreach($data['vendors'] as $vendor){
                    ?>
                        <option <?php echo ($_POST['vendor']==$vendor->vendor_id)?"selected='selected'":""; ?> value='<?php echo $vendor->vendor_id; ?>'><?php echo $vendor->vendor_name; ?></option>
                    <?php     
                    }
                    ?>
        </select>    
        <label>Location</label>
        <select  name='location' id='location' class='form-control'>
                    <option value=''>--SELECT--</option>
                    <?php
                    foreach($data['locations'] as $location){
                        $location_selected=($_POST['location']==$location->location_id)?"selected='selected'":"";
                        echo "<option value='{$location->location_id}' $location_selected>{$location->location_name}</option>";
                    }
                    ?>
        </select>
    <br>
        <button id='reset_report_form' name="reset_report_form" type="button" class="btn btn-primary float-right"> Reset </button>
        <button name="generate_report" type="submit"  style='margin-right:10px;' class='btn btn-success float-right'>Search</button>
    </div><!-- Jumbotron ends here -->
</form><!-- Form ends here -->
<?php if($data['total_records']){
    echo "Total Records : ".$data['total_records']; 
}
?>
</div>



</div> <!-- Container fluid ends here -->
<?php View('footer'); ?>