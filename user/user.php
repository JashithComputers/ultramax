<?php
include '../lib_security.php';

$uid = isset($_REQUEST['uid']) ? $_REQUEST['uid'] : 1;
$idProof = "/data/user/{$uid}/idproof.jpg";
$addressProof = "/data/user/{$uid}/addressproof.jpg";
?>
<script src='//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>
<div>
  <h3>Upload User Proof Photos</h3>
  <form action="upload.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
    <input type="hidden" name="uid" value="<?php echo $uid;?>" />
    <label>ID Proof</label>
    <input type="file" name="idproof" />
    <label>Address Proof</label>
    <input type="file" name="addressproof" />
    <input type="submit" class="btn-submit" value="upload"/>
  </form>
</div>

<div id="userDetails">
  <h2>User Photos</h2>
  <label>ID Proof</label>
  <img class="img-id" src="<?php echo $idProof; ?>" atl="ID Proof Not Found" /> 
  <label>Address Proof</label>
  <img class="img-addr" src="<?php echo $addressProof; ?>" atl="Address Proof Not Found" /> 
</div>

<div id="progressHld">
   <div class="loader" style="margin: 0 auto;"></div>
  Uploading...
</div>

<script>
  
  function validateForm()
  {
    $(document).ready(function(){
      $("#progressHld").show();
    });
    return true;
  }

</script>

<style>
  form {float:left;width:100%;}
  label {float:left;width:100%;margin-bottom:10px;}
  input {
    float:left;
    width:100%;
  }
  
  .btn-submit {
    padding:2%;
    width:96%;
    background:#1A237E;
    color:#FFF;
    margin:10px 0;
    outline:0;
    border:0;
  }
  .btn-submit:hover {
    background:#3949AB;
  }
  
  #progressHld {position:fixed;top:0;left:0;width:100%;height:100%;background:#FFF;display:none;text-align:center;}
  
  .loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
  }

  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }
  
  #userDetails img {
    float:left;
    max-width:100%;
    max-height:150px;
  }

</style>