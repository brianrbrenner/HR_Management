<?php
// This file defines the form that the user must fill out in order to view 
// employee salary information
$content = '
            <style>
            </style>
                <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Enter Admin Credentials</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputName1">Username</label>
                          <input type="text" class="form-control" id="username" placeholder="Enter admin username">
                        </div>
                    
                        <div class="form-group">
                          <label for="exampleInputphone">Password</label>
                          <input type="text" class="form-control" id="password" placeholder="Enter admin password">
                        </div>
                    
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="checkCredentials()" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('../master.php');
?>
<script>
    




    function checkCredentials(){
        $.ajax(
            {
                type: "POST",
                url:'../api/employee/credentialcheck.php',
                dataType: 'json',
                data:{
                    action: "credential_check",
                    username: $("#username").val(),
                    password: $("#password").val()
                },
                error: function (result) {
                    alert("Error");
                },
            success: function (result) {
                if (result == true) {
                    alert("Hello admin! Retrieving Salary Data");
                    window.location.href = '/HR_Management/Employee/readSalary.php';
                }
                else {
                    alert("Invalid Credentials");
                }
            }

        
    });
 
    
}


</script>
