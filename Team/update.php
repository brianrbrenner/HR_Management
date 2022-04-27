<?php 

$content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Team</h3>
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
                                    <select id = "team_members" multiple={true} style={ width:100px } class="form-control" aria-label="Default select example">
                                        <option selected></option>
                                    </select>                   
                                </div> 
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="button" class="btn btn-primary" onClick="UpdateTeam()" value="Update"></input>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
            </div>';

include('../master.php');
?>
<script>
$(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "../api/team/read_single.php?team_name=<?php echo $_GET['team_name']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#name').val(data['team_name']);
                $('#manager_id').val(data['manager_id']);
                $('#team_members').val(data['total_members']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function UpdateTeam(){
        $.ajax(
        {
            type: "POST",
            url: '../api/team/update.php',
            dataType: 'json',
            data: {
                team_name: <?php echo $_GET['team_name']; ?>,
                manager_id: $("#manager_id").val(),
                total_members: $("#team_members").val()      

            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Updated Team!");
                    window.location.href = '/HR/team';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>