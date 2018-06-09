 <?php
include '../lib_security.php';

/**
echo "<pre>test";
print_r($_REQUEST);
print_r($_FILES);
/**/

uploadFile('idproof');
echo "<br/>";
uploadFile('addressproof');

$uid = isset($_REQUEST['uid']) ? $_REQUEST['uid'] : 1;
$idProof = "/data/user/{$uid}/idproof.jpg";
$addressProof = "/data/user/{$uid}/addressproof.jpg";

function uploadFile($id)
{
	$uid = $_REQUEST['uid'];
	$target_dir = "/HLS/data/user/".$uid."/";
	if (!file_exists($target_dir)) {
	    mkdir($target_dir, 0777, true);
	}

	$target_file = $target_dir . basename($_FILES[$id]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$target_file = $target_dir . $id .$imageFileType;
	$target_file_jpg = $target_dir . $id .".jpg";
	// Check if image file is a actual image or fake image
	if(true) {
	    $check = getimagesize($_FILES[$id]["tmp_name"]);
	    if($check !== false) {
	        //echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check file size
	if ($_FILES[$id]["size"] > 50*1024*1024) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES[$id]["tmp_name"], $target_file_jpg)) {
	        //echo "The file ". basename( $_FILES["idproof"]["name"]). " has been uploaded.";

		//echo "<BR/>FILE TYPE: ".$imageFileType;
		echo $id . " Photo uploaded";


	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}
	return $uploadOk;
}

?>

<div id="userDetails">
  <h1>User Photos</h1>
  <label>ID Proof</label>
  <img class="img-id" src="<?php echo $idProof; ?>" atl="ID Proof Not Found" /> 
  <label>Address Proof</label>
  <img class="img-addr" src="<?php echo $addressProof; ?>" atl="Address Proof Not Found" /> 
</div>


<style>
  label {float:left;width:100%;margin-bottom:10px;}
  
  #userDetails img {
    float:left;
    max-width:100%;
    max-height:250px;
  }
</style>