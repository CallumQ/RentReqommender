<?php
session_start();
?>
<?php
include 'connection.php';
############ Configuration ##############
$config["image_max_size"]               = 400; //Maximum image size (height and width)
$config["thumbnail_size"]               = 200; //Thumbnails will be cropped to 200x200 pixels

$config["destination_folder"]           = 'Image/propertyImages/'; //upload directory ends with / (slash)
 //upload directory ends with / (slash)
$config["upload_url"]                   = "Image/propertyImages/"; 
$config["quality"]                      = 100; //jpeg quality
$folder = "";
$rent = $_POST['rent'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$address3 = $_POST['address3'];
$postcode = $_POST['postcode'];
$rooms = $_POST['Rooms'];
$bathroom = $_POST['bathrooms'];
$type = $_POST['PropertyType'];
$landlordID = $_SESSION['accountID'];
$long = $_POST['longitude'];
$lat = $_POST['latitude'];
$fileName = [];
$lastID = 0;
if($_POST['desc'] == ''){
    $desc = "No description.";
    
}
else{
    $desc = $_POST['desc'];
    
}
if(isset($_POST['childfriendly'])){
    $childfriendly = 1;
    
}
else{
    $childfriendly = 0;
    
}

if(isset($_POST['furnished'])){
    $furnished = 1;
    
}
else{
    $furnished = 0;
    
}
if(isset($_POST['Garden'])){
    $garden = 1;
    
}
else{
    $garden = 0;
    
}

if(isset($_POST['disabled'])){
    $disabled = 1;
    
}
else{
    $disabled = 0;
    
}

if(isset($_POST['driveway'])){
    $driveway = 1;
    
}
else{
    $driveway = 0;
    
}
if(isset($_POST['smoker'])){
    $smoker = 1;
    
}
else{
    $smoker = 0;
    
}

if(isset($_POST['pet'])){
    $pet = 1;
    
}
else{
    $pet = 0;
    
}




if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    exit;  //try detect AJAX request, simply exist if no Ajax
}
$insertString = "INSERT INTO advert(pricePerMonth,address1,address2,address3,postcode,bedroom,bathrooms,description,childFriendly,furnsihed,garden,disabled,driveway,smoker,pet,propertyType,Longitude,Latitude,landlord_ID) VALUES($rent,'$address1','$address2','$address3','$postcode',$rooms,$bathroom,'$desc',$childfriendly,$furnished,$garden,$disabled,$driveway,$smoker,$pet,'$type',$long,$lat,$landlordID )";
echo $insertString;
$insertProperty =mysqli_query($con,$insertString);

    if($insertProperty){
        echo'success';}
else{
    
    echo' error';
}
$lastID = mysqli_insert_id($con);
$folder ="Image/propertyImages/".$lastID."/"; 
mkdir($folder); 
//count total files in array
$file_count = count($_FILES["__files"]["name"]);

if($file_count > 0){ //there are more than one file? no problem let's handle multiple files

    for ($x = 0; $x < $file_count; $x++){   //Loop through each uploaded file
    
        //if there's file error, display it
        if ($_FILES["__files"]['error'][$x] > 0) { 
            print get_upload_error($x);
            exit;
        }

        //Get image info from a valid image file
        $im_info = getimagesize($_FILES["__files"]["tmp_name"][$x]);
        if($im_info){
            $im["image_width"]  = $im_info[0]; //image width
            $im["image_height"] = $im_info[1]; //image height
            $im["image_type"]   = $im_info['mime']; //image type
        }else{
            die("Make sure image <b>".$_FILES["__files"]["name"][$x]."</b> is valid image file!");
        }
        
        //create image resource using Image type and set the file extension
        switch($im["image_type"]){
            case 'image/png':
                $img_res =  imagecreatefrompng($_FILES["__files"]["tmp_name"][$x]);
                $file_extension = ".png";
                break;
            case 'image/gif':
               $img_res = imagecreatefromgif($_FILES["__files"]["tmp_name"][$x]);     
               $file_extension = ".gif";
               break;
            case 'image/jpeg': 
            case 'image/pjpeg':
                $img_res = imagecreatefromjpeg($_FILES["__files"]["tmp_name"][$x]);
                $file_extension = ".jpg";
                break;
            default:
                $img_res = 0;
        }
        
        //set our file variables 
        $unique_id =  uniqid(); //unique id for random filename
        $new_file_name = $unique_id . $file_extension; 
        $destination_file_save = $folder . $new_file_name; //file path to destination folder
        array_push($fileName,$destination_file_save);

        if($img_res){
            ###### resize Image ########
            //Construct a proportional size of new image
            $image_scale    = min($config["image_max_size"]/$im["image_width"], $config["image_max_size"]/$im["image_height"]);
            $new_width      = ceil($image_scale * $im["image_width"]);
            $new_height     = ceil($image_scale * $im["image_height"]);
    
            //Create a new true color image
            $canvas  = imagecreatetruecolor($new_width, $new_height);
            $resample = imagecopyresampled($canvas, $img_res, 0, 0, 0, 0, $new_width, $new_height, $im["image_width"], $im["image_height"]);
            if($resample){
                $save_image = save_image_file($im["image_type"], $canvas, $destination_file_save, $config["quality"]);
                //save image
                if($save_image){
                    print '<img src="'.$config["upload_url"] . $new_file_name. '" />'; //output image to browser
                }
            }
            
            if(is_resource($canvas)){ 
              imagedestroy($canvas);  //free any associated memory 
            } 

            
            ###### Generate Thumbnail ########
            
            //Offsets 
            if( $im["image_width"] > $im["image_height"]){
                $y_offset = 0;
                $x_offset = ($im["image_width"] - $im["image_height"]) / 2;
                $s_size     = $im["image_width"] - ($x_offset * 2);
            }else{
                $x_offset = 0;
                $y_offset = ($im["image_height"] - $im["image_width"]) / 2;
                $s_size = $im["image_height"] - ($y_offset * 2);
            }
            
            //Create a new true color image
           
           
            
            
            
            
        }
        
    }
    foreach ($fileName as $image) {
        $insertimage =mysqli_query($con,("INSERT INTO advertpicture (advert_ID,advertPictureUrl) VALUES($lastID,'$image')"));

}
    
}
 
 //funcion to save image file
function save_image_file($image_type, $canvas, $destination, $quality){
    switch(strtolower($image_type)){
        case 'image/png': 
            return imagepng($canvas, $destination); //save png file
        case 'image/gif': 
            return imagegif($canvas, $destination); //save gif file                
        case 'image/jpeg': case 'image/pjpeg': 
            return imagejpeg($canvas, $destination, $quality);  //save jpeg file
        default: 
            return false;
    }
}

function get_upload_error($err_no){
    switch($err_no){
        case 1 : return 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
        case 2 : return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
        case 3 : return 'The uploaded file was only partially uploaded.';
        case 4 : return 'No file was uploaded.';
        case 5 : return 'Missing a temporary folder. Introduced in PHP 5.0.3';
        case 6 : return 'Failed to write file to disk. Introduced in PHP 5.1.0';
    }
}