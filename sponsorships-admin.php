<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<?php session_start() ?>
<br>
<div class="container">
<?php if($_SESSION['sponsoraction_success_accepted']){
  echo '<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Hurray! </strong>You have just accepted an application. Aren\'t you kind?
</div>';
unset($_SESSION['sponsoraction_success_accepted']);
} 

 if($_SESSION['sponsoraction_success_denied']){
  echo '<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>How cruel! </strong>You just denied an application. How was that?
</div>';
unset($_SESSION['sponsoraction_success_denied']);
} 
?>
  <div class="well">
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#sponsoradmin">
                <span class="glyphicon glyphicon-list"></span> View current sponsorships
              </a>
            </h4>
          </div>
          <div id="sponsoradmin" class="panel-collapse collapse">
            <div class="panel-body">
              <table class="table table-striped table-hover ">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>More details</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                include 'resources/database.php';
                $applylist = mysqli_query($db, "SELECT * FROM sponsorships") or die(mysqli_error($db));
                while($row = mysqli_fetch_array($applylist)){

                  if($row['status'] == 0){
                    $_SESSION['sponsoremail'] = $row['email'];
                    $_SESSION['sponsoraction'] = 1;
                    echo '<tr class="active">
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['age'].'</td>
                    <td><a data-toggle="modal" href="#'.$row['id'].'"><span class="glyphicon glyphicon-folder-open"></span></a></td>
                    </tr>';
                  }

                  echo '<div class="modal fade" id="'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Sponsorship form #'.$row['id'].' - '.$row['name'].'</h4>
                                  </div>
                                  <div class="modal-body">
                                    <b>Name</b>: <i>'.$row['name'].'</i><br>
                                    <b>Email</b>: <i>'.$row['email'].'</i><br>
                                    <b>IGN</b>: <i>'.$row['ign'].'</i><br>
                                    <b>Age</b>: <i>'.$row['age'].'</i><br>
                                    <b>Country</b>: <i>'.$row['country'].'</i><br>
                                    <b>Server size</b>: <i>'.$row['size'].'</i><br>
                                    <b>Server location</b>: <i>'.$row['serverlocation'].'</i><br><br>
                                    <b>Why do they want a server?</b> <i>'.$row['why_requesting'].'</i><br>
                                    <b>Why should we choose them over someone else?</b> <i>'.$row['why_shouldwe'].'</i><br>
                                    <b>How will they promote Swift?</b> <i>'.$row['how_promote'].'</i><br>
                                    <b>Social links</b>: '.$row['social_links'].'<br>
                                  </div>
                                  <div class="modal-footer">
                                    <a href="/acceptsponsor"><button class="btn btn-success l_70">Accept</button></a>
                                    <a href="/denysponsor"><button class="btn btn-danger l_100">Deny</button></a>
                                    <button type="button" class="btn btn-default btn-sm l_125" aria-hidden="true" data-dismiss="modal">Cancel</button><br><br>
                                    <small>Once you choose to <i>Accept</i> or <i>Deny</i>; there is <b>no</b> going back. Make the correct choice!</small>
                                  </div>
                                </div>
                              </div>
                          </div>';
                    }
                ?>
                </tbody>
              </table> 
            </div>
          </div>
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#sponsorhist">
                <span class="glyphicon glyphicon-floppy-disk"></span> Previous sponsorships
              </a>
            </h4>
          </div>
          <div id="sponsorhist" class="panel-collapse collapse">
            <div class="panel-body">
              <table class="table table-striped table-hover ">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                include 'resources/database.php';
                $applylist = mysqli_query($db, "SELECT * FROM sponsorships") or die(mysqli_error($db));
                while($row = mysqli_fetch_array($applylist)){

                  if($row['status'] == 1){
                    echo '<tr class="success">
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['age'].'</td>
                    <td><span class="glyphicon glyphicon-ok"></span></td>
                    </tr>';
                  } elseif($row['status'] == 2){
                    echo '<tr class="danger">
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['age'].'</td>
                    <td><span class="glyphicon glyphicon-remove"></span></td>
                    </tr>';
                  }
                }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>