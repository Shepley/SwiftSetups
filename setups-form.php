<div class="container">
<?php
  if($_SESSION['setup_error']){
    echo '<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Error! </strong>You have already submitted a setup for this service.
</div>'; 
  }
?>
<style>
/* hides the spin-button for firefox */
input[type=number] {
    -moz-appearance:textfield;
}
/* hides the spin-button for chrome*/
input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <div class="well">
  	<center><legend>Setups Form</legend></center>
      <form class="form-horizontal" autocomplete="off" method="post" action="submitsetup.php">
      <fieldset>
      	<div class="form-group">
      		<label class="control-label r_110">Your details</label><br>
      		<div class="col-lg-10">
      			<input type="name" name="name" class="form-control r_90" autocomplete="off" placeholder="Full Name" required>
      		</div>
        </div>
        <div class="form-group">
          <div class="col-lg-10">
            <input type="name" name="email" class="form-control r_90" autocomplete="off" placeholder="Email" value="<?php echo $_GET['email']; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-10">
            <input type="name" class="form-control r_90" autocomplete="off" placeholder="Order ID: <?php echo $_GET['sid']; ?>" required disabled>
            <input type="hidden" name="orderid" value="<?php echo $_GET['sid']; ?>">
            <input type="hidden" name="userid" value="<?php echo $_GET['uid']; ?>">
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-10">
            <input type="number" id="pincodelimit" class="form-control r_90" autocomplete="off" name="pincode" placeholder="Please enter a four digit security pin (you need to remember this)" required>
          </div>
          <script>
          var max_chars = 4;

          $('#pincodelimit').keydown( function(e){
              if ($(this).val().length >= 4) { 
                  $(this).val($(this).val().substr(0, max_chars));
              }
          });

          $('#pincodelimit').keyup( function(e){
              if ($(this).val().length >= 4) { 
                  $(this).val($(this).val().substr(0, max_chars));
              }
          });
          </script>
        </div>
        <div class="form-group">
          <label class="control-label r_110">Server details</label><br>
          <div class="col-lg-10">
            <input type="name" name="mc_version" class="form-control r_90" autocomplete="off" placeholder="Minecraft Version" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-10">
            <textarea type="name" name="mod_list" class="form-control r_90" autocomplete="off" placeholder="Give us a list of modpack or plugins" required></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label r_110">Permission groups</label><br>
          <div class="col-lg-3">
            <input type="name" name="perm1" class="form-control r_90" autocomplete="off" placeholder="Permission Group 1"><br>
            <input type="name" name="perm2" class="form-control r_90" autocomplete="off" placeholder="Permission Group 2"><br>
            <input type="name" name="perm3" class="form-control r_90" autocomplete="off" placeholder="Permission Group 3"><br>
            <input type="name" name="perm4" class="form-control r_90" autocomplete="off" placeholder="Permission Group 4"><br>
            <input type="name" name="perm5" class="form-control r_90" autocomplete="off" placeholder="Permission Group 5"><br>
            <input type="name" name="perm6" class="form-control r_90" autocomplete="off" placeholder="Permission Group 6"><br>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label r_110">Additional Info</label><br>
          <div class="col-lg-10">
            <textarea type="name" name="additional" class="form-control r_90" autocomplete="off" placeholder="Additional Items"></textarea>
          </div>
        </div>
      	<div class="form-group">
      			<input class="btn btn-success r_105" type="submit" value="Apply">
      	</div>
      </fieldset>
      </form>
  </div>
</div>
<?php
unset($_SESSION['setup_error']);
unset($_SESSION['ssetup_error_existing']);
?>