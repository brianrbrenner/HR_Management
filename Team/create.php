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
                                <label for="exampleInputName1">Team Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Name">
                            </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Manager ID</label>
                                    <input type="text" class="form-control" id="manager_id" placeholder="Enter Manager ID">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Team Members</label>
                                    <select id = "team_members" multiple={true} defaultvalue={}style={ width:100px } class="form-control" aria-label="Default select example">
                                        <option selected></option>
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
  function AddTeam(){

        $.ajax(
        {
            type: "POST",
            url: '../api/team/create.php',
            dataType: 'json',
            data: {
                team_name: $("#name").val(),
                manager_id: $("#manager_id").val(),        
                total_members: $("#team_members").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Team!");
                    window.location.href = '/HR/team';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>