<?php
include 'resources/database.php';
$id = $_GET['id'];
session_start();
?>
<div class="container">
<?php
$setupinfo = mysqli_query($db, "SELECT * FROM setups WHERE uniquecode='".$id."'") or die(mysqli_error($db));
 if($_SESSION['req_saved']){
    echo '<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Successfully replied to request!</strong>
</div>';
  unset($_SESSION['req_saved']);
  }
?>
  <div class="well">
      <legend>Setup #<?php while($row = mysqli_fetch_array($setupinfo)){ echo $row['id']; } ?></legend>
  </div>
  <div class="row">
  	<div class="col-md-4">
  		<div class="well"><legend>About this setup:</legend>
      <?php
      $setupinfo = mysqli_query($db, "SELECT * FROM setups WHERE uniquecode='".$id."'") or die(mysqli_error($db));
      while($row = mysqli_fetch_array($setupinfo)){
        echo '<b>Client Name: </b><i>'.$row['name'].'</i>
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
              <br><br><b>Any additonal info: </b><i>'.$row['additional'].'</i>';
      }
      ?></div>
<div class="well">
        <legend>Client Notes:</legend>
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
                      <input type="submit" class="btn btn-success" style="margin-left: 120px;" value="Save Notes">
                    </div>
                  </form>';
          }
        ?>
      </div>
  	</div>
  	<div class="col-md-7 pull-right">
      <div class="well">
        <legend>Setup Actions:</legend>
        <?php 
        $setupinfo = mysqli_query($db, "SELECT * FROM setups WHERE uniquecode='".$id."'") or die(mysqli_error($db));
        while($row = mysqli_fetch_array($setupinfo)){
          if($row['requestinghelp'] == 0){
            echo '<a href="/requesthelp" class="btn btn-warning">Request help</a>
            <a href="/completesetup" class="btn btn-success">Set as complete</a>
            <a href="/index" class="btn btn-info" style="margin-left: 190px;">Back to Dashboard</a>';
          } else {
            echo '<a class="btn btn-warning" disabled>You have already requested for help</a>
            <a href="/completesetup" class="btn btn-success">Set as complete</a>
            <a href="/index" class="btn btn-info" style="margin-left: 40px;">Back to Dashboard</a>';
          }

          $_SESSION['req_assigned'] = $row['assigned'];
          $_SESSION['req_id'] = $row['id'];
          $_SESSION['complete_id'] = $row['id'];
        } ?>
      </div>
      <div class="well">
        <legend>User Requests:</legend>
            <h4>Current Requests:</h4><br>
               <table class="table table-striped table-hover ">
                  <thead>
                    <th>ID</th>
                    <th>Details</th>
                    <th></th>
                    <th></th>
                  </thead>
                  <tbody>
                    <?php
                      $get_setup_requests = mysqli_query($db, "SELECT * FROM requests WHERE status=0 AND setup_id='".$_GET['id']."'");
                      while($row = mysqli_fetch_array($get_setup_requests)){
                        echo '<tr class="warning">';
                        echo '<td>'.$row['id'].'</td>
                        <td>'.$row['details'].'</td>';
                        echo '<td><a href="/acceptrequest"><span class="glyphicon glyphicon-ok"></span></a></td>';
                        echo '<td><a href="/declinerequest"><span class="glyphicon glyphicon-lock"></span></a></td></tr>';
                        $_SESSION['act_req_id'] = $row['id'];
                        $_SESSION['req_code'] = $_GET['id'];
                      }
                    ?>
                  </tbody>
                </table>
              <span class="help-block">Only press the finished button once you have finished a feature, do not press this to say that you approve of it. This is an indication for the client to know when it has been completed.</span>
            <br><h4>Past Requests:</h4>
            <table class="table table-striped table-hover ">
            <thead>
              <th>ID</th>
              <th>Details</th>
              <th>Status</th>
            </thead>
          <tbody>
            <?php
              $get_setup_requests = mysqli_query($db, "SELECT * FROM requests WHERE status=1 OR status=2 AND setup_id='".$_GET['id']."'");
              while($row = mysqli_fetch_array($get_setup_requests)){
                if($row['status'] == 1){
                  echo '<tr class="success">';
                } else {
                  echo '<tr class="danger">';
                }

                echo '<td>'.$row['id'].'</td>
                <td>'.$row['details'].'</td>';

                if($row['status'] == 1){
                  echo '<td><span class="glyphicon glyphicon-ok"></span></td></tr>';
                } else {
                  echo '<td><span class="glyphicon glyphicon-lock"></span></td></tr>';
                }
              }
            ?>
          </tbody>
        </table>
        <span class="help-block">
        <span class="glyphicon glyphicon-ok"></span> Finished<br>
        <span class="glyphicon glyphicon-lock"></span> Rejected</span>
      </div>
  	</div>
  </div>
</div>