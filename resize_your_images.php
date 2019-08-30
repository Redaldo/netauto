<?php
/*###############################################################

- Create "images" folder  where to put your original images,
- Create "results" folder  to store resized images,
- Run "resizer.php",
- The script will automatically resize your images ,

###############################################################*/

$dir    = 'c:\xampp\htdocs\photo_resizer\images'; // <--- this is your directory images
$files = scandir($dir);
$allfiles = implode("~~~",$files);
$count = substr_count($allfiles,"~~~");

echo "<h1 style = 'color: blue'>Resizing result :</h1>";
 
for ($x=2;$x<=$count;$x++) {
	echo "<br> Image Resized  ".$x. " = " .$files[$x];
	$check_ext = substr($files[$x], -3);
	$check_ext = strtolower($check_ext);
    if ($check_ext=="jpg" || $check_ext=="jpeg" || $check_ext=="png") {
		$original_img = "images/".$files[$x];
		list($width, $height) = getimagesize($original_img);
		
		if ($width>$height) {
			//landscape mode
			$w_step1= 1000; // pixel widths you need
			$h_step1= 800; // pixel heights you need
		}
		else {
			//portrait mode
			$w_step1= 800; // pixel widths you need
			$h_step1= 1000; // pixel heights you need
		}
		
	    $dst_x=0;
		$dst_y=0;
		$src_x=0;
		$src_y=0;
		$dst_w = $w_step1;
		$dst_h = $h_step1;
		$src_w=$width;
		$src_h=$height;
		$results_image = imagecreatetruecolor($dst_w, $dst_h);
		if ($check_ext=="jpg" || $check_ext=="jpeg" ) {
			$src_image = imagecreatefromjpeg($original_img);	
		}
		else if ($check_ext=="png") {
			$src_image = imagecreatefrompng($original_img);	
		}
		
      	imagecopyresized($results_image, $src_image,
		$dst_x, $dst_y,
		$src_x, $src_y,
		$dst_w, $dst_h,
		$src_w, $src_h );
		// Output
		$namafile_results = "results/".$files[$x];
		imagejpeg($results_image,$namafile_results);
		imageDestroy($results_image);
    }
	
}
