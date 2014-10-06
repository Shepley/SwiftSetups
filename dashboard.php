<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<br>
<div class="container">
  <?php 
  if($_SESSION['assign_success']){
    echo '<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>User assigned! </strong>The staff member <b>'.$_SESSION['assign_success_user'].'</b> has now been assigned to setup #'.$_SESSION['assign_success_id'].'
</div>';
  }
  if($_SESSION['req_success']){
    echo '<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Request sent! </strong> You have now requested for help for setup #'.$_SESSION['req_success_id'].'
</div>';
  }
  if($_SESSION['setup_complete']){
    echo '<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Setup completed! </strong>
</div>';
  }
  unset($_SESSION['assign_success']);
  unset($_SESSION['assign_success_user']);
  unset($_SESSION['assign_success_id']);
  unset($_SESSION['req_success']);
  unset($_SESSION['req_success_id']);
  unset($_SESSION['setup_complete']);
  ?>
  <div class="well">
      <legend>Dashboard - SwiftSetups</legend><br>
      <p>Welcome to SwiftSetups. Placeholder text.</p>
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#helpreq">
                <b>View setups requesting help</b> <div class="pull-right"><span class="badge"><?php include 'countsetups.php'; 
                echo $countreqsetups; ?></span></div>
              </a>
            </h4>
          </div>
          <div id="helpreq" class="panel-collapse collapse">
            <div class="panel-body">
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
                  $getlist = mysqli_query($db,"SELECT * FROM setups WHERE requestinghelp=1 AND status=1");
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
      </div>
  </div>
  <div class="row">
  	<div class="col-md-4">
  		<div class="well">
  			<b>Setups available:</b><br><br>
  			<div class="list-group">
  				<?php
          error_reporting(E_ALL);
  				include 'resources/database.php';
 				  $setup_available_list = mysqli_query($db, "SELECT * FROM setups WHERE status=0") or die(mysqli_error($db));
  				while($row = mysqli_fetch_array($setup_available_list)){

  					echo '<a href="#setup-'.$row['uniquecode'].'" class="list-group-item list-group-item-warning" role="tab" data-toggle="tab">'.$row['name'].' <br> '.$row['email'].' <br> '.$row['serviceid'].' </a>';

  				}

  				?>
			</div>
  			<b>Setups started:</b><br><br>
  			<div class="list-group">
          <?php

          $setup_started_list = mysqli_query($db, "SELECT * FROM setups WHERE status=1") or die(mysqli_error($db));
          while($row = mysqli_fetch_array($setup_started_list)){

            echo '<a href="#setup-'.$row['uniquecode'].'" class="list-group-item list-group-item-info" role="tab" data-toggle="tab"><b>Assigned to '.$row['assigned'].'<i></i><br><br>'.$row['name'].' <br> '.$row['email'].' <br> '.$row['serviceid'].' </a>';

          }

          ?>
			</div>
  			<b>Setups completed:</b><br>
  			  <?php

          $setup_started_list = mysqli_query($db, "SELECT * FROM setups WHERE status=2") or die(mysqli_error($db));
          while($row = mysqli_fetch_array($setup_started_list)){

            echo '<a class="list-group-item list-group-item-success"><b>Setup completed!<i></i><br><br>'.$row['name'].' <br> '.$row['email'].' <br> '.$row['serviceid'].' </a>';

          }

          ?>
  		</div>
  	</div>
  	<div class="col-md-7 pull-right">
  		<div class="well">
  			<div class="tab-content">
          <div class="tab-pane fade in active"><i><center>Please choose a setup from the left-hand menu to see more details...</center></i></div>
          <?php

          $setup_tabcontent_status0 = mysqli_query($db, "SELECT * FROM setups WHERE status=0") or die(mysqli_error($db));
          while($row = mysqli_fetch_array($setup_tabcontent_status0)){

            echo '<div class="tab-pane fade" id="setup-'.$row['uniquecode'].'">
              Setup #'.$row['id'].' (client <i>'.$row['clientid'].'</i> <b>|</b> service <i>'.$row['serviceid'].'</i>)
              <br><br><b>Name: </b><i>'.$row['name'].'</i>
              <br><br><b>Email: </b><i>'.$row['email'].'</i>
              <br><br><b>Minecraft Version: </b><i>'.$row['mc_version'].'</i>
              <br><br><b>Permission groups:</b><br>
              - '.$row['perm1'].'<br>
              - '.$row['perm2'].'<br>
              - '.$row['perm3'].'<br>
              - '.$row['perm4'].'<br>
              - '.$row['perm5'].'<br>
              - '.$row['perm6'].'<br>
              <br><b>Modpack/Plugin list: </b><i>'.$row['mod_list'].'</i>
              <br><br><b>Any additonal info: </b><i>'.$row['additional'].'</i><br><br>
              <form method="post" action="assignsetup.php">
              <input type="hidden" name="assignstaff" value="'.$_SESSION['sesh_username'].'">
              <input type="hidden" name="assignid" value="'.$row['id'].'">
              <input type="submit" class="btn btn-success" value="Assign to yourself">
              </form>
            </div>';

          }

          $setup_tabcontent_status1_reqhelp0 = mysqli_query($db, "SELECT * FROM setups WHERE status=1 AND requestinghelp=0") or die(mysqli_error($db));
          while($row = mysqli_fetch_array($setup_tabcontent_status1_reqhelp0)){

            echo '<div class="tab-pane fade" id="setup-'.$row['uniquecode'].'">
              Setup #'.$row['id'].' (client <i>'.$row['clientid'].'</i> <b>|</b> service <i>'.$row['serviceid'].'</i>)
              <br><br><b>Name: </b><i>'.$row['name'].'</i>
              <br><br><b>Email: </b><i>'.$row['email'].'</i>
              <br><br><b>Minecraft Version: </b><i>'.$row['mc_version'].'</i>
              <br><br><b>Permission groups:</b><br>
              - '.$row['perm1'].'<br>
              - '.$row['perm2'].'<br>
              - '.$row['perm3'].'<br>
              - '.$row['perm4'].'<br>
              - '.$row['perm5'].'<br>
              - '.$row['perm6'].'<br>
              <br><b>Modpack/Plugin list: </b><i>'.$row['mod_list'].'</i>
              <br><br><b>Any additonal info: </b><i>'.$row['additional'].'</i><br><br>
              <a href="/requesthelp" class="btn btn-warning">Request help</a>
              <a href="/completesetup" class="btn btn-success">Set as complete</a>
              <a href="/setups?id='.$row['uniquecode'].'" class="btn btn-info">View setup</a>
            </div>';
            $_SESSION['req_assigned'] = $row['assigned'];
            $_SESSION['req_id'] = $row['id'];
            $_SESSION['complete_id'] = $row['id'];


          }

          $setup_tabcontent_status1_reqhelp1 = mysqli_query($db, "SELECT * FROM setups WHERE status=1 AND requestinghelp=1") or die(mysqli_error($db));
          while($row = mysqli_fetch_array($setup_tabcontent_status1_reqhelp1)){

            echo '<div class="tab-pane fade" id="setup-'.$row['uniquecode'].'">
              Setup #'.$row['id'].' (client <i>'.$row['clientid'].'</i> <b>|</b> service <i>'.$row['serviceid'].'</i>)
              <br><br><b>Name: </b><i>'.$row['name'].'</i>
              <br><br><b>Email: </b><i>'.$row['email'].'</i>
              <br><br><b>Minecraft Version: </b><i>'.$row['mc_version'].'</i>
              <br><br><b>Permission groups:</b><br>
              - '.$row['perm1'].'<br>
              - '.$row['perm2'].'<br>
              - '.$row['perm3'].'<br>
              - '.$row['perm4'].'<br>
              - '.$row['perm5'].'<br>
              - '.$row['perm6'].'<br>
              <br><b>Modpack/Plugin list: </b><i>'.$row['mod_list'].'</i>
              <br><br><b>Any additonal info: </b><i>'.$row['additional'].'</i><br><br>
              <a class="btn btn-warning" disabled>You have already requested for help</a>
              <a href="/completesetup" class="btn btn-success">Set as complete</a>
              <a href="/setups?id='.$row['uniquecode'].'" class="btn btn-info">View setup</a>
            </div>';
            $_SESSION['complete_id'] = $row['id'];


          }
          ?>
		    </div>
  		</div>
  	</div>
  </div>
</div>