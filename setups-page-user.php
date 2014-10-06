<div class="container">
    <?php
    session_start();
    if($_SESSION['setups_req_success']){
    echo '<div class="alert alert-dismissable alert-success">
          <button type="button" class="close" data-dismiss="alert"></button>
          <strong>Request sent! </strong>Your request has been sent to your assigned staff member, you can view your current/past requests on the page below.
        </div>';
    }

    if($_SESSION['notes_saved']){
    echo '<div class="alert alert-dismissable alert-success">
          <button type="button" class="close" data-dismiss="alert"></button>
          <strong>Your notes have been saved!</strong>
        </div>';
    }

    if($_SESSION['req_empty']){
    echo '<div class="alert alert-dismissable alert-danger">
          <button type="button" class="close" data-dismiss="alert"></button>
          <strong>You cannot have an empty request!</strong> Please enter some information to let the staff know what you want.
        </div>';
    }

    unset($_SESSION['setups_req_success']);
    unset($_SESSION['notes_saved']);
    unset($_SESSION['req_empty']);
    ?>

  <div class="well">
      <legend>Setup #<?php echo $_GET['id']; ?></legend>
        <?php include 'resources/database.php';
        error_reporting(E_ALL);
        $setupprogress = mysqli_query($db,"SELECT * FROM setups WHERE uniquecode='".$_GET['id']."'");
        while($row = mysqli_fetch_array($setupprogress)){
          if($row['status'] = 1){
            echo '<div class="progress">
              <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                Setup in-progress
              </div>
            </div>';
          } elseif($row['status'] = 2){
            echo '<div class="progress">
              <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                Setup Complete
              </div>
            </div>';
          }
        }
      ?>
      <legend>Your details:</legend>
      <?php
      $getclientinfo = mysqli_query($db,"SELECT * FROM setups WHERE uniquecode='".$_GET['id']."'");
      while($row = mysqli_fetch_array($getclientinfo)){
        echo '<b>Name: </b>'.$row['name'].'<br>
        <b>Email: </b>'.$row['email'].'<br>
        <b>ServiceID: </b>'.$row['serviceid'].'<br>
        <b>Code: </b>'.$row['uniquecode'].'<br>';
      }
      ?>
  </div>
  <div class="row">
  	<div class="col-md-4">
  		<div class="well"><legend>Your setup details:</legend>
      <?php
      $getsetupinfo = mysqli_query($db,"SELECT * FROM setups WHERE uniquecode='".$_GET['id']."'");
      while($row = mysqli_fetch_array($getsetupinfo)){
        echo '<b>Version: </b>'.$row['mc_version'].'<br><br>
        <h4>Permission groups:</h4>
        <b>Group 1: </b>'.$row['perm1'].'<br>
        <b>Group 2: </b>'.$row['perm2'].'<br>
        <b>Group 3: </b>'.$row['perm3'].'<br>
        <b>Group 4: </b>'.$row['perm4'].'<br>
        <b>Group 5: </b>'.$row['perm5'].'<br>
        <b>Group 6: </b>'.$row['perm6'].'<br><br>
        <b>Server Software (jar) and plugins: </b>'.$row['mod_list'].'<br><br>
        <b>Additional info: </b>'.$row['additional'].'<br>';
      }
      ?>
      </div><br>
      <div class="well">
        <legend>Notes:</legend>
        <?php
          $get_setup_notes = mysqli_query($db, "SELECT * FROM setups WHERE uniquecode='".$_GET['id']."'") or die(mysqli_error($db));
          while($row = mysqli_fetch_array($get_setup_notes)){
            echo '<form class="form-horizontal" method="post" action="savenotes.php">
                    <div class="form-group">
                      <div class="col-lg-12">
                        <input type="hidden" name="notes_id" value="'.$_GET['id'].'">
                        <textarea class="form-control" rows="3" name="notes">'.$row['notes'].'</textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-success r_120" value="Save Notes">
                    </div>
                  </form>';
          }
        ?>
      </div>
  	</div>
  	<div class="col-md-7 pull-right">
  		<div class="well"><legend>Request something new on the server:</legend>
        <form action="newrequest.php" method="post">
        <input type="hidden" name="req_id" <?php echo 'value='.$_GET['id'].''?>>
      <?php
      $getsetupinfo = mysqli_query($db,"SELECT * FROM setups WHERE uniquecode='".$_GET['id']."'");
      while($row = mysqli_fetch_array($getsetupinfo)){
        echo '<input type="hidden" name="assigned" value="'.$row['reqhelpassigned'].'">
        <input type="hidden" name="serviceid" value="'.$row['serviceid'].'">';
      }
      ?>
        <div class="form-group">
          <div class="col-lg-12">
            <textarea class="form-control" rows="3" name="featureinfo"></textarea>
            <span class="help-block">Above, enter what you want to request or change and then click the submit button.</span>
          </div>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-success r_240" value="Send Request">
        </div>
        </form>
      <legend>Previous/Current Requests:</legend>
      <table class="table table-striped table-hover ">
        <thead>
          <th>ID</th>
          <th>Details</th>
          <th>Status</th>
        </thead>
      <tbody>
        <?php
          $get_setup_requests = mysqli_query($db, "SELECT * FROM requests WHERE setup_id='".$_GET['id']."'");
          while($row = mysqli_fetch_array($get_setup_requests)){
            if($row['status'] == 0){
              echo '<tr class="warning">';
            } elseif($row['status'] == 1){
              echo '<tr class="success">';
            } else {
              echo '<tr class="danger">';
            }

            echo '<td>'.$row['id'].'</td>
            <td>'.$row['details'].'</td>';

            if($row['status'] == 1){
              echo '<td><span class="glyphicon glyphicon-ok"></span></td></tr>';
            } elseif($row['status'] == 0) {
              echo '<td><span class="glyphicon glyphicon-send"></span></td></tr>';
            } else {
              echo '<td><span class="glyphicon glyphicon-lock"></span></td></tr>';
            }
          }
        ?>
      </tbody>
    </table>
    <span class="help-block"><span class="glyphicon glyphicon-send"></span> Sent<br>
    <span class="glyphicon glyphicon-ok"></span> Finished<br>
    <span class="glyphicon glyphicon-lock"></span> Rejected <small>(This could be because the request is too much, too much of a struggle or was not valid. If you think this is wrong, please submit a ticket and include the ID of the request).</small></span>
    </div>
  	</div>
  </div>
</div>