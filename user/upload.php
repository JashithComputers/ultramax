<?php
include '../lib_security.php';

echo "<pre>test";
print_r($_REQUEST);
print_r($_FILES);
$uid = $_REQUEST['uid'];

$filename = $_FILES['idproof']['name'];

$target_dir = "/HLS/data/user/".$uid."/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
$target_file = $target_dir . basename($_FILES["idproof"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file = $target_dir . "idproof.".$imageFileType;
$target_file_jpg = $target_dir . "idproof.jpg";
// Check if image file is a actual image or fake image
if(true) {
    $check = getimagesize($_FILES["idproof"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check file size
if ($_FILES["idproof"]["size"] > 50*1024*1024) {
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
    if (move_uploaded_file($_FILES["idproof"]["tmp_name"], $target_file_jpg)) {
        echo "The file ". basename( $_FILES["idproof"]["name"]). " has been uploaded.";

	echo "<BR/>FILE TYPE: ".$imageFileType;


    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<h1>Photo uploaded</h1>



<?php 
function convertImage($originalImage, $outputImage, $quality=100)
{
    // jpg, png, gif or bmp?
    $exploded = explode('.',$originalImage);
    $ext = $exploded[count($exploded) - 1]; 

    if (preg_match('/jpg|jpeg/i',$ext))
        $imageTmp=imagecreatefromjpeg($originalImage);
    else if (preg_match('/png/i',$ext))
        $imageTmp=imagecreatefrompng($originalImage);
    else if (preg_match('/gif/i',$ext))
        $imageTmp=imagecreatefromgif($originalImage);
    else if (preg_match('/bmp/i',$ext))
        $imageTmp=imagecreatefrombmp($originalImage);
    else
        return 0;

    // quality is a value from 0 (worst) to 100 (best)
    imagejpeg($imageTmp, $outputImage, $quality);
    imagedestroy($imageTmp);

    return 1;
}
?>
