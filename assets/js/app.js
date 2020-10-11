function showDeleteModal(id){
        $("#delete_inventory_id").val(id);  
        $('#deleteModal').modal('show');
}

function printShiftLog(){
    window.print(); 
}

function showShiftLogParticulars(shift_log_id){
    $('#shift_log_particulars').html("Loading, Please Wait ...");
    //Do a ajax call.
    $.ajax({
     type: "POST",
     url: "shiftLogParticulars",
     data: {"shift_log_id":shift_log_id},
     success:function(response){
         $('#shift_log_particulars').html(response);
         $('#add_new_shift_log_particular').click(function(){
            var add_new_row=atob($('#add_new_row').val());
            $("#shift_log_particular_table").append(add_new_row); 
         });
     },
     error:function(error){
         $('#shift_log_particulars').html(error);
     }
    });
}

function shiftEndedLogParticulars(shift_log_id){
    $('#shift_log_particulars').html("Loading, Please Wait ...");
    //Do a ajax call.
    $.ajax({
     type: "POST",
     url: "shiftEndLogParticulars",
     data: {"shift_log_id":shift_log_id},
     success:function(response){
         $('#shift_log_particulars').html(response);
     },
     error:function(error){
         $('#shift_log_particulars').html(error);
     }
    });
}

$(document).ready(function(){

    
    $(function() {
        $("#updated_on_start,#updated_on_end,#created_on_start,#created_on_end,#updated_on,#created_on,#emp_dop,#emp_dob,#employee_dop,#employee_dob,#log_date,#shift_date").datepicker({dateFormat: "yy-mm-dd"}); 
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

    //Employee Operations.
    $("#add_emp_button").click(function(){
        $("#addEmployeeModal").modal("show"); 
    }); 

    $('.delete_emp_button').click(function(){
        $("#deleteEmployeeModal").modal('show'); 
        $("#delete_employee_id").val($(this).attr("employee-id")); 
    });

    $('.update_emp_button').click(function(){
        $("#updateEmployeeModal").modal('show');
        var emp_data=JSON.parse(atob($(this).attr('encoded-data')));       
        $("#update_employee_form #emp_name").val(emp_data.emp_name); 
        $("#update_employee_form #emp_mail").val(emp_data.emp_mail);
        $("#update_employee_form #emp_designation").val(emp_data.emp_designation);
        $("#update_employee_form #emp_dop").val(emp_data.emp_dop);
        $("#update_employee_form #emp_dob").val(emp_data.emp_dob);
        $("#update_employee_form #emp_blood_grp").val(emp_data.emp_blood_grp);
        $("#update_employee_form #emp_phone").val(emp_data.emp_phone); 
        $("#update_employee_form #emp_id").val(emp_data.emp_id);
    });

    $(".shift_logbook_form").submit(function(){
        $('#shift_log_playground').html("Loading, Please Wait ...");
        $('#shift_log_particulars').html("");
       //Do a ajax call.
       $.ajax({
        type: "POST",
        url: "searchEmployeeLog",
        data: {"log_date":$('#log_date').val(),"shift":$("#shift").val(),"emp_id":$("#emp_id").val()},
        success:function(response){
            $('#shift_log_playground').html(response);
            $("#delete_shift_log").on('click',function(){
               $("#delete_shiftlog_id").val($(this).attr('shift-log-id')); 
               $('#deleteShiftlogModal').modal('show'); 
            });

            $('#edit_shift_log').on('click',function(){
               showShiftLogParticulars($(this).attr('shift-log-id')); 
            });

            $('#shift_ended_log').on('click',function(){
               shiftEndedLogParticulars($(this).attr('shift-log-id'));
            });
            
            $('#add_shift_log').click(function(){
                $('#addShiftLogbookModal').modal('show'); 
            });
        },
        error:function(error){
            $('#shift_log_playground').html(error); 
        }
       });

       return false;
    });

    

});//Jquery Document Ready Container Ends Here.