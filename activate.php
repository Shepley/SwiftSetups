<?php require 'overall.php';
unset($_SESSION['loggedIn']);
unset($_SESSION['permissionAdmin']);
unset($_SESSION['permissionStaff']);
$email = $_GET['email'];
$permlevel = $_GET['permlevel'];
$_SESSION['activateEmail'] = $email;
$_SESSION['acivatePermlevel'] = $permlevel;
?>
<br><br>
<div class="container">
  <div class="well">
    <center><legend>Activate Account</legend></center>
      <div class="r_150">
        <form class="form-horizontal" method="post" action="activateaccount.php">
            <div class="form-group">
                <div class="col-lg-10">
                    <div class="form-control"><?php echo $email ?></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10">
                    <input type="password" class="form-control" name="activatePassword" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10">
                    <input type="password" class="form-control" name="activateConfPassword" placeholder="Confirm your password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10">
                    <center><p class="text-info">You are an <i><?php 
                    if($permlevel == "200ceb26807d6bf99fd6f4f0d1ca54d4"){
                      echo 'Administrator';
                    } elseif($permlevel == "c04d26dd31d4e3941b8582e33ce69b17"){
                      echo 'Staff Member';
                    } else {
                      $_SESSION['activateInvalidURL'] = 1;
                      header("Location: /index");
                    }
                    ?></i></p></center>
                </div>
            </div>
            <div class="form-group">
              <div class="col-lg-10 r_350">
                <input type="submit" class="btn btn-primary" value="Activate">
              </div>
            </div>
        </form>
      </div>
  </div>
</div>