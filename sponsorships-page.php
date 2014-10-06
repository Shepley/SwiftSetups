<br>
<div class="container">
<?php
 if($_SESSION['submit_success']){
echo '<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Done! </strong>Your form has been submitted. Please wait up to a week for a reply. Good luck!
</div>';
  } elseif($_SESSION['submit_error']){
  	echo '<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Error! </strong>You have already sent an application.
</div>';
  } else {
    echo '<div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>So you know! </strong> Make sure to use an email you can access, as that is where you will find out if you are accepted or denied.
</div>';
  }
?>

  <div class="well">
  	<center><legend>Sponsorship form</legend></center>
      <form class="form-horizontal" autocomplete="off" method="post" action="submitsponsorship.php">
      <fieldset>
      	<div class="form-group">
      		<label class="control-label r_110">Your details</label><br>
      		<div class="col-lg-10">
      			<input type="name" name="name" class="form-control r_90" autocomplete="off" placeholder="Your full name" required>
      		</div>
      	</div>
      	<div class="form-group">
      		<div class="col-lg-10">
      			<input type="email" name="email" class="form-control r_90" autocomplete="off" placeholder="Your email address" required>
      		</div>
      	</div>
      	<div class="form-group">
      		<div class="col-lg-10">
      			<input type="text" name="ign" class="form-control r_90" autocomplete="off" placeholder="Your in-game name (Minecraft username)" required>
      		</div>
      	</div>
      	<div class="form-group">
      		<div class="col-lg-10">
      			<input type="number" name="age" class="form-control r_90" autocomplete="off" placeholder="Your age" required>
      		</div>
      	</div>
      	<div class="form-group">
      		<div class="col-lg-10">
      			<input type="text" name="country" class="form-control r_90" autocomplete="off" placeholder="Your country" required>
      		</div>
      	</div>
      	<br><label class="control-label r_90">Server details</label><br>
      	<div class="form-group">
      		<div class="col-lg-10">
      			<input type="name" name="size" class="form-control r_90" autocomplete="off" placeholder="What size server are you looking for?" required>
      		</div>
      	</div>
      	<div class="form-group">
      		<div class="col-lg-10">
      			<select class="form-control r_90" name="serverlocation" required>
  					<option value="">Choose a server location</option>
  					<option value="europe">Europe (France)</option>
  					<option value="usa">USA</option>
				</select>
      		</div>
      	</div>
      	<br><br><label class="control-label r_90">Convince us!</label><br>
      	<div class="form-group">
      		<div class="col-lg-10">
      			<textarea class="form-control r_90" rows="3" name="why-requesting" placeholder="Why are you requesting sponsorship?" required></textarea>
      		</div>
      	</div>
      	<div class="form-group">
      		<div class="col-lg-10">
      			<textarea class="form-control r_90" rows="3" name="why-shouldwe" placeholder="Why should we provide you with sponsorship and not someone else?" required></textarea>
      		</div>
      	</div>
      	<div class="form-group">
      		<div class="col-lg-10">
      			<textarea class="form-control r_90" rows="3" name="how-promote" placeholder="How do you intend on promoting Swift?" required></textarea>
      		</div>
      	</div>
      	<div class="form-group">
      		<div class="col-lg-10">
      			<label class="control-label r_90"><small><i>(optional)</i></small></label>
      			<textarea class="form-control r_90" rows="3" name="social-links" placeholder="Links to YouTube Channel / Website etc."></textarea>
      		</div>
      	</div><br>
      	<div class="form-group">
      		<div class="r_500">
      			<input class="btn btn-success" type="submit" value="Apply">
      		</div>
      	</div>
      </fieldset>
      </form>
    <small>Please note that by clicking <i>Apply</i>, you agree to advertising for SwiftMCHosting in the way stated above, <i>if</i> provided with a server.</small>
  </div>
</div>
<?php
unset($_SESSION['submit_success']);
unset($_SESSION['submit_error']);
?>