<?php

echo '<form action="parts/_cPass.php" method="POST">
<div class="form-group modalText">
<label for="exampleInputPassword1">Old Password</label>
<input type="password" class="form-control" id="oldPass" name="oldPass">
</div>
<div class="form-group modalText">
<label for="exampleInputPassword1">New Password</label>
<input type="password" class="form-control" id="newPass" name="newPass">
</div>
<div class="form-group modalText">
<label for="exampleInputPassword1">Confirm Password</label>
<input type="password" class="form-control" id="newCPass" name="newCPass">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
';

?>