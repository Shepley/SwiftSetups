<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<br>
<div class="container">
<?php

unset($_SESSION['delAccUsername']);
unset($_SESSION['delAccEmail']);
unset($_SESSION['delAccID']);

 if($_SESSION['createErrorUsername']) {
echo '<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Error creating account! </strong>That username is taken.
</div>';
  } elseif($_SESSION['createErrorEmailUsed']) {
echo '<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Error creating account! </strong>That email is in use.
</div>';
  } elseif($_SESSION['createErrorEmailDismatch']) {
echo '<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Error creating account! </strong>Those emails do no match.
</div>';
  } elseif($_SESSION['createSuccess']) {
echo '<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Success! </strong>Account "'.$_SESSION['username'].'" has been created and is awaiting activation.
</div>';
  } 

  if($_SESSION['editSuccess']) {
echo '<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Success! </strong>Account has been successfully edited.
</div>';
} elseif($_SESSION['editError']){
echo '<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Error editing account! </strong>That username is taken.
</div>';
	} 
if($_SESSION['delSuccess']) {
echo '<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Success! </strong>That account has been deleted. Did that feel good?
</div>';
} ?>
  <div class="well">
  <legend>Staff Manager</legend>
      <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#newStaff">
          <span class="glyphicon glyphicon-user l_5"></span>Create a new staff member
        </a>
      </h4>
    </div>
    <div id="newStaff" <?php if($_SESSION['createError']){
	echo 'class="panel-collapse collapse in"';
} else {
	echo 'class="panel-collapse collapse"';
} ?>>
      <div class="panel-body">
        <form class="form-horizontal" method="post" action="newstaffaction.php">
  <fieldset>
    <div <?php if($_SESSION['createErrorUsername']){
  echo 'class="form-group has-error"';
} else {
  echo 'class="form-group"';
} ?>>
      <label for="username" class="col-lg-2 control-label">Username</label>
      <div class="col-lg-10">
        <input type="text" name="username" class="form-control" placeholder="e.g: Billy" required>
      </div>
    </div>
    <div <?php if($_SESSION['createErrorEmail']){
  echo 'class="form-group has-error"';
} else {
  echo 'class="form-group"';
} ?>>
      <label for="email" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input type="email" name="email" class="form-control" placeholder="their@email.com" required>
      </div>
    </div>
    <div <?php if($_SESSION['createErrorEmail']){
  echo 'class="form-group has-error"';
} else {
  echo 'class="form-group"';
} ?>>
      <label for="confemail" class="col-lg-2 control-label">Confirm email</label>
      <div class="col-lg-10">
        <input type="email" name="email_conf" class="form-control" placeholder="Repeat their email address" required>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Permission level</label>
      <div class="col-lg-10">
      	<select class="form-control" name="permlevel" required>
          <option value="">Choose a permission level...</option>
          <option value="perm_staff">Support Agent</option>
          <option value="perm_admin">Administrator</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <input type="submit" class="btn btn-primary" value="Create">
      </div>
    </div>
  </fieldset>
</form>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#editStaff">
          <span class="glyphicon glyphicon-pencil l_5"></span>Edit an existing staff member
        </a>
      </h4>
    </div>
    <div id="editStaff" <?php if($_SESSION['editError']){
	echo 'class="panel-collapse collapse in"';
} else {
	echo 'class="panel-collapse collapse"';
} ?>>
      <div class="panel-body">
        <table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Permission level</th>
      <th>Edit Account</th>
    </tr>
  </thead>
  <tbody>
  <?php
  include 'resources/database.php';
  $stafflist = mysqli_query($db, "SELECT * FROM users");
  while($row = mysqli_fetch_array($stafflist)){
  	if($row['permissionlevel'] == 1){
  		if($row['deleted'] == 1){
  			echo '<tr class="active">';
  		} else {
  			echo '<tr class="info">';
  		}
      	echo '<td>'.$row['id'].'</td>';
      	echo '<td>'.$row['username'].'</td>';
      	echo '<td>'.$row['email'].'</td>';
      	echo '<td>Support Agent</td>';
    if($row['master-acc'] == 1){
    	echo '<td><span class="glyphicon glyphicon-ban-circle"></span> Permission denied</td>';
	} elseif($row['deleted'] == 0){
  		echo '<td><a data-toggle="modal" href="#'.$row['id'].'"><span class="glyphicon glyphicon-cog"></span></a></td>';
  	} else {
  	echo '<td>Account awaiting deletion</td>';
  }
    	echo '</tr>';
  	}

  	if($row['permissionlevel'] == 2){
  		if($row['deleted'] == 1){
  			echo '<tr class="active">';
  		} else {
  			echo '<tr class="danger">';
  		}
    echo  '<td>'.$row['id'].'</td>';
    echo  '<td>'.$row['username'].'</td>';
    echo  '<td>'.$row['email'].'</td>';
    echo  '<td>Administrator</td>';
    if($row['master-acc'] == 1){
    	echo '<td><span class="glyphicon glyphicon-ban-circle"></span> Permission denied</td>';
	} elseif($row['deleted'] == 0){
  		echo '<td><a data-toggle="modal" href="#'.$row['id'].'"><span class="glyphicon glyphicon-cog"></span></a></td>';
  	} else {
  	echo '<td>Account awaiting deletion</td>';
  }
    echo '</tr>';
  	}

  	$_SESSION['editid'] = $row['id'];
  	$_SESSION['cur_username'] = $row['username'];


  	echo '<div class="modal fade" id="'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Editing user "'.$row['username'].'"</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="editstaffaction.php">
        	<div class="form-group col-lg-5">
        		<label class="control-label">New Username
        		<input class="form-control" type="text" name="edituser" placeholder="'.$row['username'].'">
        	</div>
        	<br><br><br><br>
        	<div class="form-group col-lg-5">
        	<label class="control-label">Permission level
        		<select class="form-control" name="editpermlevel">
          			<option value="">New permission level...</option>
          			<option value="perm_staff">Support Agent</option>
          			<option value="perm_admin">Administrator</option>
        		</select>
        	</div>
      </div>
      <br><br><br><br>
      <div class="modal-footer">
        <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <input type="submit" class="btn btn-success" value="Save changes">
      </div>
    </div>
    </form>
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
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#delStaff">
          <span class="glyphicon glyphicon-remove l_5"></span>Delete a staff member
        </a>
      </h4>
    </div>
    <div id="delStaff" class="panel-collapse collapse">
      <div class="panel-body">
        <legend>Choose a staff member to delete</legend><br>
        <ul class="list-group">
         <?php
  			include 'resources/database.php';
  			$stafflist = mysqli_query($db, "SELECT * FROM users");
 			 while($row = mysqli_fetch_array($stafflist)){
 			if($row['master-acc'] == 1){
        	echo '<a class="list-group-item"><span class="badge">'.$row['id'].'</span>'.$row['username'].'<small> ('.$row['email'].' - User can not be deleted)</small></a>';
 			} elseif($row['deleted'] == 1){
        	echo '<a class="list-group-item"><span class="badge">'.$row['id'].'</span>'.$row['username'].'<small> (User already in deletion process)</small></a>';
 			} else {
        	echo '<a data-toggle="modal" href="#del'.$row['id'].'" class="list-group-item">
    				<span class="badge">'.$row['id'].'</span>
    				'.$row['username'].'<small> ('.$row['email'].')</small>
  				</a>';

  			echo '<div class="modal fade" id="del'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  					<div class="modal-dialog">
    					<div class="modal-content">
      						<div class="modal-header">
        					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        					<h4 class="modal-title">Are you sure you want to delete account <b>'.$row['username'].'</b>?</h4>
      					</div>
      				<div class="modal-body">
        				<p>Are you sure you want to delete this user? This action <font color="red">cannot</font> be un-done.</p>
      				</div>
      				<div class="modal-footer">
      				<form method="post" action="confirmdelete">
      					<button aria-hidden="true" type="button" class="btn btn-default" data-dismiss="modal">No</button>
      					<input type="hidden" name="username" value="'.$row['username'].'">
      					<input type="hidden" name="email" value="'.$row['email'].'">
      					<input type="hidden" name="id" value="'.$row['id'].'">
        				<input type="submit" class="btn btn-danger" value="Yes, i\'m sure!">
        				</form>
      				</div>
    				</div>
  				</div>
				</div>';
			}
			} ?>
		</ul>
      </div>
    </div>
  </div>
</div>
  </div>
</div>

<?php unset($_SESSION['createError']);
unset($_SESSION['createErrorEmailUsed']);
unset($_SESSION['createErrorEmailDismatch']);
unset($_SESSION['createErrorUsername']);
unset($_SESSION['createSuccess']);
unset($_SESSION['editError']);
unset($_SESSION['editSuccess']);
unset($_SESSION['delSuccess']);
?>