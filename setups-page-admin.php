<div class="container">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">Please enter an ID</h3>
      </div>
      <div class="panel-body">
        As an admin, you must choose a setup to view details, here is a list of all available setups:<br><br>
              <table class="table table-striped table-hover ">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Service ID</th>
                    <th>Name</th>
                    <th>Assigned to</th>
                    <th>View setup</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    include 'resources/database.php';
                    $getlist = mysqli_query($db,"SELECT * FROM setups WHERE status=1");
                    while($row = mysqli_fetch_array($getlist)){
                        echo ' <tr class="warning">
                                <td>'.$row['id'].'</td>
                                <td>'.$row['serviceid'].'</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['assigned'].'</td>
                                <td><a href="setups?id='.$row['uniquecode'].'"><span class="glyphicon glyphicon-arrow-right"></span></a></td>
                              </tr>';
                    }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
</div>