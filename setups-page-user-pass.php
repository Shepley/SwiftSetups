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
<div class="container">
  <?php
  if($_GET['e'] == 1){
    echo '<div class="alert alert-dismissable alert-danger">
    <button type="button" class="close" data-dismiss="alert"></button>
    <strong>Incorrect PIN!</strong> It seems that you have entered the incorrect PIN for this setup, please try again or contact us if you have forgotten your pin.
  </div>';
  }
  ?>
  <div class="well">
    <legend><center>Please enter your PIN</center></legend>
    <form class="form-horizontal" method="post"  autocomplete="off" action="setups-page-user-checkpass.php">
      <fieldset>
        <div class="form-group">
          <div class="col-lg-10">
            <input type="number" id="pincodelimit" class="form-control r_90" autocomplete="off" name="pincode" placeholder="Please enter your four digit security pin code" required>
            <input type="hidden" name="id" <?php echo 'value="'.$_GET['id'].'"'?>>
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
            <input class="btn btn-success r_500" type="submit" value="Unlock Setup">
        </div>
      </fieldset>
    </form>
  <span class="help-block"><small>Your setup will only be unlocked for one hour, after that, you will need to re-enter the PIN. Please note that by clicking "Unlock Setup"; you agree to the use of cookies on these pages. We do not store information about you in cookies.</small></span>
  </div>
</div>