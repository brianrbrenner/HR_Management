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
                            <h3 class="box-title">Add Team</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" class="form-control" id="team_name" placeholder="Enter Name">
                            </div>
                            


                            <div class="form-group">
                            <label for="exampleInputName1">Department</label>
                            <select id = "man_opt" class="form-select" aria-label="Default select example">
                            </select>                   
                            </div>
                            
                        </div>
                        
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="button" class="btn btn-primary" onClick="AddTeam()" value="Submit"></input>
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
            url: "../api/team/read.php",
            dataType: 'json',
            data: {
                action: "getMan",
            },
            success: function(data){
                response = "";
                    for (var man in data)
                    {
                        response+= 
                                    "<option value="+ data[man].manager_id +">" + data[man].name + "</option>";
                        
                    }
                    
                    $(response).appendTo($("#man_opt"));
            },
            error: function(data){
                
            }

        }
    )


});





  function AddTeam(){

        $.ajax(
        {
            type: "POST",
            url: '../api/team/create.php',
            dataType: 'json',
            data: {
                action: "create",
                team_name: $("#team_name").val(),
                manager_id: $("#man_opt").val(),

            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    window.location.href = '/HR_Management/Team';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>