<?php
// Define the content which is displayed within the master.php file
  $content = '<div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                     <h3 class="box-title">Team List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="teams" class="table table-bordered table-hover">
                        <thead>
                          <tr> 
                              <th>Team Name</th>
                              <th>Manager</th>
                              <th>Team Members</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <tr>
                              <th>Team Name</th>
                              <th>Manager</th>
                              <th>Team Members</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                <!-- /.box -->
                </div>
              </div>';

  include('../master.php');
?>

<!-- Start of page script -->
<script>
  $(document).ready(function(){
    // On document load, perform get request to load all tuples in database
    $.ajax({
      // Type specifies type of request: in this case, we are using a get request
      // to get data from a database
      type: "GET",
      // url of file which specifies how to ge the data
      url: "../api/team/read.php",
      dataType: 'json',
      // upon success, this function creates tuples for each manager in the table 
      // and appends them to the response variable
      success: function(data) {
        var response="";
        for(var user in data){
          console.log(data[user]);
          response += 
            "<tr>"+
              "<td>"+data[user].team_name+"</td>"+
              "<td>"+data[user].manager_id+"</td>"+
              "<td>"+data[user].total_members+"</td>"+
              "<td><a href='update.php?team_name="+data[user].team_name+"'>Edit</a> | <a href='#' onClick=Remove('"+data[user].team_name+"')>Remove</a></td>"+
            "</tr>"
    
        }
        // appends the response to the the table whose id=manager
        $(response).appendTo($("#teams"));
      }

    });
  });

  // This function takes a parameter named id and updates the database by 
  // removing the manager record with the corresponding id
  function Remove(team_name){
    var result= confirm("Are you sure you want to delete the Team Record?");
    if (result == true) {
      $.ajax({
        // Post request used to update server's database
        type: "POST",
        // delete.php specifies how to perform the delete operation
        url: '../api/team/delete.php',
        dataType: 'json',
        data: {
          team_name: team_name
        },
        // if POST request fails
        error: function(result) {
          alert(result.responseText);
        },
        // If POST request succeeds
        success: function(result) {
          // if manager record was successfully removed, send message to browser
          // indicating such
          if (result['status'] == true) {
            alert("Successfully Removed Team!");
            window.location.href = '/HR/team';

          }
          // Otherwise, if it could not be deleted, print the message contained within
          // the deletion failure message
          else {
            alert(result['message']);
          }
        }
      });
    }
  }
</script>