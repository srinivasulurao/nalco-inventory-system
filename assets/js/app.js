function showDeleteModal(id){
        $("#delete_inventory_id").val(id);  
        $('#deleteModal').modal('show');
}

$(document).ready(function(){

    $(function() {
        $("#updated_on_start,#updated_on_end,#created_on_start,#created_on_end,#updated_on,#created_on").datepicker({dateFormat: "yy-mm-dd"}); 
    });

    //Vendor Operations.
    $("#add_vendor_button").click(function(){
        $("#addVendorModal").modal("show"); 
    }); 

    $('.delete_vendor_button').click(function(){
        $("#deleteVendorModal").modal('show'); 
        $("#delete_vendor_id").val($(this).attr("vendor-id")); 
    });

    $('.update_vendor_button').click(function(){
        $("#updateVendorModal").modal('show'); 
        $("#update_vendor_id").val($(this).attr("vendor-id")); 
        $("#update_vendor_name").val($(this).attr("vendor-name")); 
    });


    //Location Operations.
    $("#add_location_button").click(function(){
        $("#addLocationModal").modal("show"); 
    }); 

    $('.update_location_button').click(function(){
        $("#updateLocationModal").modal('show'); 
        $("#update_location_id").val($(this).attr("location-id")); 
        $("#update_location_name").val($(this).attr("location-name")); 
    });

    $('.delete_location_button').click(function(){
        $("#deleteLocationModal").modal('show'); 
        $("#delete_location_id").val($(this).attr("location-id")); 
    });

    $('#reset_report_form').click(function(){
     $("[name='location']").val('');
     $("[name='search_text']").val('');
     $("[name='vendor']").val('');
     $("[name='updated_on_start']").val('');
     $("[name='updated_on_end']").val('');
     $("[name='created_on_start']").val('');
     $("[name='created_on_end']").val('');
     $("[name='entry_type']").val('ALL');
        
    });



});//Jquery Document Ready Container Ends Here.