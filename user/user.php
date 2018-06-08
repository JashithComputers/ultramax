<?php
include '../lib_security.php';

$uid = isset($_REQUEST['uid']) ? $_REQUEST['uid'] : 1;
?>
<h1>User Page</h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="uid" value="<?php echo $uid;?>" />
<input type="file" name="idproof" />
<input type="submit" value="upload"/>
</form>
