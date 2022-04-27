<?php

// This file defines the structure of the form used to create a new manager
// as well as the function used to actually create that new entry

// Define the main content within the master.php file
$content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Manager</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputName1">New Team Members:</label>
                                <select id = "dept_opt" class="form-select" aria-label="Default select example">
                                    <option selected>None</option>
                                </select>                   
                            </div>

                        </div>
                        
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="button" class="btn btn-primary" onClick="AddEmployee()" value="Submit"></input>
                        </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
            </div>';
            
// Include the main layout for the page
include('../master.php');
?>
<script>
     $(document).ready(function(){
        $.ajax(
            {
                type: "POST",
                url:'../api/employee/create.php',
                dataType: 'json',
                data:{
                    action: "getDept"
                },
                success: function(data){
                    var response = "";
                    for (var dep in data)
                    {
                        response+= 
                        "<option value="+ data[dep].dept_name +">" + data[dep].dept_name + "</option>";
                    }
                    $(response).appendTo($("#dept_opt"));
                }

            }
        )
 
    
    });

  function AddEmployee(){
        $.ajax(
        {
            type: "POST",
            url: '../api/employee/create.php',
            dataType: 'json',
            data: {
                action: "create",
                name: $("#name").val(),
                department: $("#dept_opt").val(),
                phone: $("#phone").val(),
                email: $("#email").val(),      
                salary: $("#salary").val(),
            },
            error: function (result) {
                alert("heeii");
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Manager!");
                    window.location.href = '/HR_Management/Employee';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>
  function AddManager(){

        $.ajax(
        {
            type: "POST",
            url: '../api/manager/create.php',
            dataType: 'json',
            data: {
                name: $("#name").val(),
                phone: $("#phone").val(),        
                email: $("#email").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Manager!");
                    window.location.href = '/HR/manager';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>